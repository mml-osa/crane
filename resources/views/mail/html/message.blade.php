@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
    <p>Please find below the details of a recent schedule from the website</p>
    <b>Full Name:</b> {{ $email->name ?? "" }}<br>
    <b>Email Address:</b> {{ $email->email ?? "" }}<br>
    <b>Phone Number:</b> {{ $email->phone ?? "" }}<br>
    <b>Schedule Date:</b> {{ $email->meetingDate ?? "" }}<br>
    <b>Additional Message:</b> {{ $email->message ?? "" }}<br>

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
