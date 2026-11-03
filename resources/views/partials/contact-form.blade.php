@php
    $selectedTopic = old('topic', $topic ?? request('topic', 'general'));
@endphp
<form class="form-card" method="post" action="{{ route('contact.submit') }}">
    @csrf
    @include('partials.honeypot')
    @if ($errors->any())
        <div class="alert alert-warning" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row g-3">
        <div class="col-md-6">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" value="{{ old('name') }}" required maxlength="80">
        </div>
        <div class="col-md-6">
            <label for="email">Email</label>
            <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="120">
        </div>
        <div class="col-md-6">
            <label for="phone">Mobile</label>
            <input class="form-control" id="phone" name="phone" inputmode="numeric" value="{{ old('phone') }}" maxlength="10" placeholder="10 digits, optional">
        </div>
        <div class="col-md-6">
            <label for="company">Company</label>
            <input class="form-control" id="company" name="company" value="{{ old('company') }}" maxlength="80">
        </div>
        <div class="col-12">
            <label for="topic">Topic</label>
            <select class="form-select" id="topic" name="topic">
                @foreach (['general' => 'General', 'corporate' => 'Corporate', 'mutual-funds' => 'Mutual funds', 'careers' => 'Careers', 'grievance' => 'Grievance'] as $value => $label)
                    <option value="{{ $value }}" @selected($selectedTopic === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" required maxlength="1000">{{ old('message') }}</textarea>
        </div>
        <div class="col-12">
            <button class="btn btn-yellow" type="submit">Send message</button>
            <p class="fine mt-2 mb-0">We reply to the email address you enter.</p>
        </div>
    </div>
</form>
