<x-app-layout>
    <div class="px-5 py-5 p-lg-0 bg-surface-secondary">
        <div class="d-flex justify-content-center">
            <div class=" side-hero col-lg-5 col-xl-4 p-12 p-xl-20 position-fixed start-0 top-0 h-screen overflow-y-hidden bg-primary d-none d-lg-flex flex-column">
                <!-- Logo -->
                <a class="d-block" href="#">
                    <img src="https://preview.webpixels.io/web/img/logos/clever-light.svg" class="h-10" alt="...">
                </a>
                <!-- Title -->
                <div class="mt-32 mb-20 shadow card glassmorph p-3">
                    <h1 class="ls-tight font-bolder display-6 mb-5">
                        Register Here! If Youu have Account Before, Please Login
                    </h1>
                    <p class="text-dark fw-bold">
                        Please Input Your Biodata Here
                    </p>
                </div>
                <!-- Circle -->
                <div class="w-56 h-56 bg-orange-500 rounded-circle position-absolute bottom-0 end-20 transform translate-y-1/3"></div>
            </div>
            <div class="col-12 col-md-9 col-lg-7 offset-lg-5 border-left-lg min-h-lg-screen d-flex flex-column justify-content-center py-lg-16 px-lg-20 position-relative">
                <div class="row">
                    <div class="col-lg-10 col-md-9 col-xl-6 mx-auto ms-xl-0">
                        <div class="mt-10 mt-lg-5 mb-6 d-flex align-items-center d-lg-block">
                            <span class="d-inline-block d-lg-block h1 mb-lg-6 me-3">👋</span>
                            <h1 class="ls-tight font-bolder h2">
                                {{ __('Create an account') }}
                            </h1>
                        </div>
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-5">
                                <label class="form-label" for="name">{{ __('Name') }}</label>
                                <input id="name" placeholder="Ex : Jhon Doe" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="phone">{{ __('Phone') }}</label>
                                <input id="phone" placeholder="Ex : 6281225***" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="gender">{{ __('Gender') }}</label>
                                <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror"  required autocomplete="gender" autofocus>
                                <option value="" selected disabled hidden>Select Your Gender</option>
                                <option value="male" @if(old('gender') == 'male') selected @endif>Male</option>
                                <option value="female" @if(old('gender') == 'female') selected @endif>Female</option>
                                <option value="custom" @if(old('gender') == 'custom') selected @endif>Custom</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" placeholder="Ex : example@gmail.com"  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="file_verification_url">{{ __('Identity File') }}</label>
                                <input id="file_verification_url" type="file" class="form-control @error('file_verification_url') is-invalid @enderror" name="file_verification_url" value="{{ old('file_verification_url') }}" required autocomplete="file_verification_url" autofocus>

                                @error('file_verification_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="password">{{ __('Password') }}</label>
                                <input id="password" placeholder="Input your password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" placeholder="Re-Type your password"  type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success w-full">
                                    {{ __('Sign up') }}
                                </button>
                            </div>
                        </form>
                        <div class="my-6">
                            <small>{{ __('Already have an account?') }}</small>
                            <a href="{{ route('login') }}" class="text-success text-sm font-semibold">{{ __('Sign in') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>