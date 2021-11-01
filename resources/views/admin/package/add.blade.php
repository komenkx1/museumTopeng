@extends('admin/layouts/app',["title"=>"Add Packages"])

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Add Packages</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ Route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ Route('admin.packages.index') }}">Packages</a></li>
                    <li class="breadcrumb-item active">Add Form</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="card mt-3">
                        <div class="card-body">

                       @livewire('admin.packages.add-form')

                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main><!-- End #main -->
@endsection
