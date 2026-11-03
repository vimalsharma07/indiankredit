<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function product(string $key): View
    {
        $product = config('site.products.'.$key);
        abort_unless(is_array($product), 404);

        return view('pages.product', [
            'product' => $product,
            'key' => $key,
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function standards(): View
    {
        return view('pages.standards');
    }

    public function careers(): View
    {
        return view('pages.careers');
    }

    public function faq(): View
    {
        return view('pages.faq');
    }

    public function blog(): View
    {
        return view('pages.blog.index');
    }

    public function blogShow(string $slug): View
    {
        $post = collect(config('site.posts'))->firstWhere('slug', $slug);
        abort_unless(is_array($post), 404);

        return view('pages.blog.show', ['post' => $post]);
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function contactSubmit(Request $request): RedirectResponse
    {
        if ($request->filled('company_website')) {
            return back()->with('status', 'Thanks. We received your message.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['nullable', 'digits:10'],
            'company' => ['nullable', 'string', 'max:80'],
            'topic' => ['nullable', 'string', 'max:40'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        return back()->with('status', 'Message received. We will reply by email.');
    }

    public function apply(): View
    {
        return view('pages.apply');
    }

    public function applySubmit(Request $request): RedirectResponse
    {
        if ($request->filled('company_website')) {
            return redirect()->route('apply')->with('status', 'Application received. We will contact you on this mobile.');
        }

        $product = config('site.products.'.$request->input('product'));
        $min = is_array($product) ? $product['amount_min'] : 10;
        $max = is_array($product) ? $product['amount_max'] : 500000;

        $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'mobile' => ['required', 'digits:10'],
            'city' => ['required', 'string', 'max:60'],
            'product' => ['required', Rule::in($this->openProductKeys())],
            'amount' => ['required', 'integer', 'min:'.$min, 'max:'.$max],
        ]);

        return redirect()
            ->route('apply')
            ->with('status', 'Application received. We will contact you on this mobile.');
    }

    public function repayment(): View
    {
        return view('pages.repayment');
    }

    public function repaymentSubmit(Request $request): RedirectResponse
    {
        if ($request->filled('company_website')) {
            return back()->with('status', 'No payment was taken.');
        }

        $request->validate([
            'account' => ['required', 'string', 'max:30'],
            'mobile' => ['required', 'digits:10'],
        ]);

        return back()->with('status', 'Request received. Repayment details will be sent to this mobile.');
    }

    public function refer(): View
    {
        return view('pages.refer');
    }

    public function creditScore(): View
    {
        return view('pages.credit-score');
    }

    public function creditScoreSubmit(Request $request): RedirectResponse
    {
        if ($request->filled('company_website')) {
            return back()->with('status', 'Score request received. We will send the result to this mobile.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'mobile' => ['required', 'digits:10'],
        ]);

        return back()->with('status', 'Score request received. We will send the result to this mobile.');
    }

    public function corporate(): View
    {
        return view('pages.corporate');
    }

    public function calculators(): View
    {
        return view('pages.calculators.index');
    }

    public function calculator(string $slug): View
    {
        $calculator = config('site.calculators.'.$slug);
        abort_unless(is_array($calculator), 404);

        return view('pages.calculators.show', [
            'calculator' => $calculator,
            'slug' => $slug,
        ]);
    }

    public function legal(string $page): View
    {
        $document = config('site.legal.'.$page);
        abort_unless(is_array($document), 404);

        return view('pages.legal', ['document' => $document]);
    }

    public function sitemap(): View
    {
        return view('pages.sitemap');
    }

    /**
     * @return list<string>
     */
    private function openProductKeys(): array
    {
        return array_keys(array_filter(
            config('site.products'),
            fn (array $product): bool => empty($product['coming_soon'])
        ));
    }
}
