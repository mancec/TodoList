@component('mail::message')
    # Alert

    The wind speed is {{$wind}} than 10m/s.



    {{ config('app.name') }}
@endcomponent
