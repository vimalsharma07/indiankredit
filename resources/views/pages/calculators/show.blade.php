@extends('layouts.site')

@section('title', $calculator['name'])
@section('description', $calculator['text'])

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a><span>/</span>
                <a href="{{ route('calculators') }}">Calculators</a><span>/</span>
                <span>{{ $calculator['name'] }}</span>
            </nav>
            <h1>{{ $calculator['name'] }}</h1>
            <p class="lead-copy">{{ $calculator['text'] }} Illustrative maths only.</p>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="calc-layout" id="calc" data-type="{{ $calculator['type'] }}">
                <form class="form-card" onsubmit="return false;">
                    @foreach ($calculator['fields'] as $field)
                        <div class="calc-field">
                            <div class="calc-top">
                                <label for="field-{{ $field['name'] }}">{{ $field['label'] }}</label>
                                <input class="calc-number" id="field-{{ $field['name'] }}" data-field="{{ $field['name'] }}" type="number" min="{{ $field['min'] }}" max="{{ $field['max'] }}" step="{{ $field['step'] }}" value="{{ $field['value'] }}">
                            </div>
                            <input type="range" data-range="{{ $field['name'] }}" min="{{ $field['min'] }}" max="{{ $field['max'] }}" step="{{ $field['step'] }}" value="{{ $field['value'] }}" aria-label="{{ $field['label'] }} slider">
                        </div>
                    @endforeach
                    <noscript><p>Turn on JavaScript to run this calculator.</p></noscript>
                </form>
                <aside class="result-card">
                    <div class="result-row"><span>{{ $calculator['results']['primary'] }}</span><strong data-result="primary">—</strong></div>
                    <div class="result-row"><span>{{ $calculator['results']['interest'] }}</span><strong data-result="interest">—</strong></div>
                    <div class="result-row"><span>{{ $calculator['results']['total'] }}</span><strong data-result="total">—</strong></div>
                    <div class="split-bar" aria-hidden="true"><span data-bar="base"></span><span></span></div>
                    <p class="mb-0">A real loan, fund, or deposit can cost more or less than this. The rate is yours to type.</p>
                </aside>
            </div>
        </div>
    </section>
@endsection
