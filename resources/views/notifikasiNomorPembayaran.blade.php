@component('mail::message')
<span style="text-align: center; font-weight:bold">Transaksi #{{ $transaction->session_ID }}</span> <br>

<span>Hello, {{ $transaction->guest->name }}. Immediately make a payment for your transaction so you can enjoy the features that we have prepared. Here are your Transaction details.</span><br>
<p>Detail :</p>
<ul>
    <li><span style="font-weight: bold">Nomor VA : </span><span style="text-align: center">{{ $transactionInfos["Va"] ?? "-" }}</span></li>
    <li><span style="font-weight: bold">Item : </span><span style="text-align: center">{{ $transaction->package->name }}</span></li>
    <li><span style="font-weight: bold">Harga : </span><span style="text-align: center">@currency($transactionInfos["Nominal"] ?? "-")</span></li>
</ul>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
