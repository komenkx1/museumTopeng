@component('mail::message')
# Introduction

<span>Hallo, {{ $transaction->guest->name }}. Segera lakukan Pembayaran </span>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
