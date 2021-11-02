@php
    $no = 1;
@endphp
@component('mail::message')


<style>
    .background{
background-color: #f2f4f6;
    }
    table{
        width: 100%;
        padding: 10px;
        border-collapse: collapse;
    }
    tr{
        border-bottom: 1px solid #e3e3e3;

    }
    td.tb-left{
        padding: 15px;

    }
    /* td.tb-right{
        text-align: right;
        padding: 10px;
    } */
    .center{
        text-align:center;
    }
    .d-flex{
        display: flex;
    }
    .justify-content-beetween{
        justify-content: space-between;
    }
    .text-bold{
        font-weight: bold;
    }
    .word-break{
        word-break:break-word;
    }
</style>
<p class="text-bold" style="color: black;">Hello, {{ $transaction->guest->name }}</p>
<span >Immediately make a payment for your transaction so you can enjoy the features that we have prepared. Here are your Transaction details.</span>

<div class="background" style="margin-top: 15px;">
<table>
    <tbody>
        <tr>
            <td class="tb-left d-flex justify-content-beetween"><span class="text-bold">Transaction Id</span> <span style="text-align: end" style="word-break">{{ $transaction->trx_id }}</span></td>
        </tr>
        <tr>
            <td class="tb-left d-flex justify-content-beetween"><span class="text-bold">Item Name</span> <span style="text-align: end" style="word-break">{{ $transaction->package->name }}</span></td>
        </tr>
        <tr>
            <td class="tb-left d-flex justify-content-beetween"><span class="text-bold">Price</span> <span style="text-align: end" style="word-break">@currency($transaction->package->price)</span></td>
        </tr>
        <tr>
            <td class="tb-left d-flex justify-content-beetween"><span class="text-bold">Status</span> <span style="text-align: end" style="word-break">{{ strtoupper($transaction->status) }}</span></td>
        </tr>
    </tbody>
</table>
</div>

<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
