@extends('admin/layouts/app',["title"=>"Transaction"])
@section('content')
    <main id="main" class="main">

        <div class="pagetitle d-flex justify-content-between">
            <div class="titile">
                <h1>Transaction Report</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ Route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item">Transacton Report</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->
        <div class="card p-5">
            @livewire('admin.transaction.transaction-table')

        </div>
    </main>
@endsection
