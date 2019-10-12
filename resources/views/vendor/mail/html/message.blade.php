@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

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
            @lang('mail.global.youreceived')<br><a href="{{ config('app.url') }}">{{ config('app.name') }}</a><br>
            © {{ date('Y') }} {{ config('app.name') }}. @lang('mail.global.copyright')
        @endcomponent
    @endslot
@endcomponent
