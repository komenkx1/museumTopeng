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
<span >Congratulations, your transaction has been successfully verified. Here are your ticket details. Show this email to the cashier.</span>

<div class="background" style="margin-top: 15px;">
<table>
    <tbody>
        <tr>
            <td class="tb-left d-flex justify-content-beetween"><span class="text-bold">Ticket Id</span> <span style="text-align: end" style="word-break">{{ $transaction->trx_id }}</span></td>
        </tr>
        <tr>
            <td class="tb-left d-flex justify-content-beetween"><span class="text-bold">Item Name</span> <span style="text-align: end" style="word-break">{{ $transaction->package->name }}</span></td>
        </tr>
        <tr>
            <td class="tb-left center" style="width: 100%">Feauture</td>
        </tr>
        @foreach ($transaction->package->feautures as $feauture)
        <tr>
            <td class="tb-left d-flex justify-content-beetween"><span class="text-bold">Feauture {{ $no++ }}</span> <span style="text-align: end" style="word-break">{{ $feauture->name }}</span></td>
        </tr>
     @endforeach
    </tbody>
</table>
</div>
<p style="margin-top: 10px;" class="text-bold">Augmented Reality Account. <br>
    <small style="font-weight:500; color:red">Note : Only for 24 hour.</small>
</p>
<div class="background">
    <table>
        <tbody>
            <tr>
                <td class="tb-left d-flex justify-content-beetween"><span class="text-bold">Username</span> <span style="text-align: end" style="word-break">{{ $account->username }}</span></td>
            </tr>
            <tr>
                <td class="tb-left d-flex justify-content-beetween"><span class="text-bold">Password</span> <span style="text-align: end" style="word-break">{{ $password }}</span></td>
            </tr>
        </tbody>
    </table>
    </div>
    <br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
