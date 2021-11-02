@extends('admin/layouts/app',["title"=>"Package"])
@section('content')
    <main id="main" class="main">

        <div class="pagetitle d-flex justify-content-between">
            <div class="titile">
                <h1>Add Packages</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ Route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item">Add Packages</li>
                    </ol>
                </nav>
            </div>
            <div class="btnAdd">
                <a class="btn btn-success" href="{{ Route('admin.packages.create') }}"><i class="bi bi-plus fw-bold"
                        style="font-size: 20px"></i></a>
            </div>

        </div><!-- End Page Title -->
        <div class="card p-5">
            @livewire('admin.packages.package-table')

        </div>
    </main>
@endsection
