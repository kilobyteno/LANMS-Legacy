@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => Setting::get('WEB_PROTOCOL').'://'.Setting::get('WEB_DOMAIN')])
            {{ Setting::get('WEB_NAME') }}
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
            @lang('mail.global.youreceived')<br><a href="{{ Setting::get('WEB_PROTOCOL').'://'.Setting::get('WEB_DOMAIN') }}">{{ Setting::get('WEB_NAME') }}</a><br><br>
            &copy; {{ date('Y') }} {{ Setting::get('WEB_NAME') }}. @lang('mail.global.copyright')
        @endcomponent
    @endslot
@endcomponent
