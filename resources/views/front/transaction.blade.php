@extends('front.layouts.app')
@section('contents')


    <main id="main">
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Transaction Form</h2>
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li>Transaction Form</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs Section -->

        <section class="form p-3">
            <div class="container">
                <form action="{{ Route("home.transaction.checkout") }}" method="post" role="form" class="p-3 my-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 card shadow rounded-md p-4">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="mb-2" for="name">Name</label>
                                    <input type="text" name="name" value="{{ old("name") }}" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Your Name"
                                        required>
                                        @error('name')
                                        <span class="invalid-feedback"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <label class="mb-2" for="email">Email</label>
                                    <input type="email" value="{{ old("email") }}" class="form-control @error("email") is-invalid @enderror" name="email" id="email"
                                        placeholder="Your Email" required>
                                        @error('email')
                                        <span class="invalid-feedback"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2" for="nation">Country</label>
                                <select name="country" id="countries" class="form-control">
                                    <option value="" disabled selected>Select Your Nation</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->code }}">{{ $country->name }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2" for="province">Province</label>
                                <select name="province" disabled id="provinces" class="form-control">
                                    <option value="" disabled selected>Select Your Province</option>
                                    
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2" for="city">City</label>
                                <input type="text" class="form-control" name="city" id="city"
                                        placeholder="Your City" required>
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2" for="address">Address</label>
                                <textarea class="form-control @error("address") is-invalid @enderror" name="address" rows="5" placeholder="Your Address"
                                    required>{{ old("address") }}</textarea>
                                    @error('address')
                                    <span class="invalid-feedback"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2" for="phone">Phone</label>
                                <input type="number" name="phone" value="{{ old("phone") }}" class="form-control @error("phone") is-invalid @enderror" placeholder="Your Phone Number">
                                @error('phone')
                                <span class="invalid-feedback"><small>{{ $message }}</small></span>
                            @enderror
                            </div>
                        </div>
                        <div class="d-lg-none my-3">
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <!-- ======= Package Section ======= -->
                            <section id="pricing" class="pricing p-0">
                                <div class="container mt-3">

                                    <div class="section-title p-0" data-aos="fade-up">
                                        <h2>Package</h2>
                                        <p style="font-size: 30px">Your Package</p>
                                    </div>

                                    <div class="row" data-aos="fade-left">
                                        <div class="col-lg-12 col-md-6 my-2 mx-auto">
                                            <div class="box" data-aos="zoom-in" data-aos-delay="100">
                                                <h3>{{ $package->name }}</h3>
                                                <div class="detail" style="overflow: hidden; height:160px">
                                                    <h4><sup></sup> @currency($package->price)</h4>
                                                    <ul class="m-0">
                                                        @foreach ($package->feautures as $feautures)
                                                            <li>{{ $feautures->name }}</li>
                                                        @endforeach
                                                    </ul>


                                                    {{-- <a class="read-more @if ($package->feautures->count() <= 4) d-none @endif" href="javascript:void(0)"> See All</a> --}}
                                                </div>
                                                <div class="m-0 p-0" style="height:10px">
                                                    <a class="read-more @if ($package->feautures->count() <= 3) d-none @endif"
                                                        href="javascript:void(0)">Show more</a>
                                                    <a class="read-less d-none" href="javascript:void(0)">Read Less</a>
                                                </div>
                                                <div class="btn-wrap">
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </section><!-- End Pricing Section -->
                            <div class="container">
                                <hr>
                            </div>
                            <section id="payment_method" class="payment_method p-0">
                                <div class="container mt-3">

                                    <div class="section-title p-0" data-aos="fade-up">
                                        <h2>Payment</h2>
                                        <p style="font-size: 30px">Payment Method</p>
                                    </div>

                                    <div class="row" data-aos="fade-left">
                                        <div class="col-lg-12 col-md-6 my-2 mx-auto">
                                            <div class="card p-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                        id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Transfer (Bank Transfer, E-Money, Etc.)
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                        id="flexRadioDefault2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        COD
                                                    </label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success my-3 w-100">Processes
                                                Payment</button>

                                        </div>


                                    </div>

                                </div>
                            </section><!-- End Pricing Section -->
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main><!-- End #main -->
@endsection

@section('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $(".read-more").on("click", function() {
                var detail = $(this).parent().prev(".detail");
                var currentHeight = detail.css("height");
                $(this).next(".read-less").removeClass("d-none");
                $(this).addClass("d-none");
                detail.css("height", "auto");
                var animateHeight = detail.css("height");
                detail.css("height", currentHeight);

                detail.animate().animate({
                    height: animateHeight
                }, 200).addClass("expand");
            });

            $(".read-less").on("click", function() {
                var detail = $(this).parent().prev(".detail");
                var currentHeight = detail.css("height"); //store current heght
                $(this).prev(".read-more").removeClass("d-none");
                $(this).addClass("d-none");
                detail.css("height", "auto"); //set height to auto
                var animateHeight = detail.css("height"); //store auto height
                detail.css("height", currentHeight);
                detail.animate({
                    height: "160"
                }, 200).removeClass("expand");


            });

            $(document).ready(function() {
                $('#countries').select2();
                $('#provinces').select2();

                $(document).on("change", "#countries", function(e) {
                    // e.preventDefault()
                    var code = $(this).val();

                    $.ajax({
                        url: "{{ Route('home.transaction.filter.province') }}",
                        type: "post",
                        dataType: "json",
                        data: {
                            code: code
                        },
                        success: function(data) {
                         $('#provinces').removeAttr("disabled");

                            province_body = "";
                            // province_body += "<option value='' selected disabled> Select Your Province </option>";
                            for (var key in data) {
                                province_body += "<option value=" + data[key]["name"] +
                                    ">" + data[key]["name"] + "</option>";
                                $('#provinces').html(province_body);
                            }
                            console.log(data);
                        }
                    })
                });

            });
        });
    </script>
@endsection
