document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('.site-header');
    const onScroll = () => header?.classList.toggle('is-stuck', window.scrollY > 8);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    const product = document.querySelector('#product');
    const hint = document.querySelector('#amount-hint');
    const amount = document.querySelector('#amount');
    if (product && hint && amount) {
        const updateHint = () => {
            const option = product.selectedOptions[0];
            hint.textContent = option?.dataset.hint || '';
            if (option?.dataset.min) {
                amount.min = option.dataset.min;
            }
            if (option?.dataset.max) {
                amount.max = option.dataset.max;
            }
        };
        product.addEventListener('change', updateHint);
        updateHint();
    }

    document.querySelector('#show-sample-score')?.addEventListener('click', () => {
        const panel = document.querySelector('#sample-score');
        if (panel) {
            panel.hidden = false;
        }
    });

    document.querySelectorAll('[data-copy-target]').forEach((button) => {
        button.addEventListener('click', async () => {
            const value = document.querySelector(button.dataset.copyTarget)?.textContent?.trim();
            if (!value || !navigator.clipboard) {
                return;
            }
            await navigator.clipboard.writeText(value);
            const previous = button.textContent;
            button.textContent = 'Copied';
            setTimeout(() => {
                button.textContent = previous;
            }, 1600);
        });
    });

    const calc = document.querySelector('#calc');
    if (calc) {
        bindCalculator(calc);
    }
});

function bindCalculator(root) {
    const money = new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'INR',
        maximumFractionDigits: 0,
    });

    const read = (name) => Number(root.querySelector(`[data-field="${name}"]`)?.value || 0);

    const render = () => {
        const type = root.dataset.type;
        const amount = read('amount');
        const rate = read('rate');
        const months = read('months');
        const years = read('years');
        let primary = 0;
        let extra = 0;

        if (type === 'emi') {
            const n = months;
            if (amount <= 0 || n <= 0) {
                paint(root, null, null, null, 50);
                return;
            }
            const r = rate / 12 / 100;
            const emi = r === 0 ? amount / n : (amount * r * (1 + r) ** n) / ((1 + r) ** n - 1);
            const total = emi * n;
            primary = emi;
            extra = total - amount;
            paint(root, primary, extra, total, (amount / total) * 100);
            return;
        }

        if (type === 'sip') {
            const n = months;
            if (amount <= 0 || n <= 0) {
                paint(root, null, null, null, 50);
                return;
            }
            const i = rate / 12 / 100;
            const invested = amount * n;
            const value = i === 0 ? invested : amount * ((1 + i) ** n - 1) / i * (1 + i);
            primary = value;
            extra = value - invested;
            paint(root, primary, extra, invested, (invested / value) * 100);
            return;
        }

        if (amount <= 0 || years <= 0) {
            paint(root, null, null, null, 50);
            return;
        }
        const maturity = amount * (1 + rate / 100) ** years;
        extra = maturity - amount;
        paint(root, maturity, extra, amount, (amount / maturity) * 100);
    };

    const paint = (scope, primary, extra, total, baseShare) => {
        const set = (key, value) => {
            const node = scope.querySelector(`[data-result="${key}"]`);
            if (node) {
                node.textContent = value === null ? '—' : money.format(value);
            }
        };
        set('primary', primary);
        set('interest', extra);
        set('total', total);
        const bar = scope.querySelector('[data-bar="base"]');
        if (bar) {
            const share = Number.isFinite(baseShare) ? Math.min(100, Math.max(0, baseShare)) : 50;
            bar.style.flex = `0 0 ${share}%`;
        }
    };

    root.querySelectorAll('[data-range]').forEach((range) => {
        const field = root.querySelector(`[data-field="${range.dataset.range}"]`);
        if (!field) {
            return;
        }
        range.addEventListener('input', () => {
            field.value = range.value;
            render();
        });
        field.addEventListener('input', () => {
            range.value = field.value;
            render();
        });
    });

    render();
}
