<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center  @if (Route::is('home'))header-transparent @endif">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo d-flex align-items-center">
            <img src="/assets/img/icon.png" alt="logo" class="me-2">
            <h6><a href="/"><span> SETIA DARMA HOUSE OF MASKS & PUPPETS</span></a></h6>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav id="navbar" class="navbar">

            @if (Route::is('home'))
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#event">Event</a></li>
                    {{-- <li><a class="nav-link scrollto" href="#pricing">Pricing</a></li> --}}
                    <li><a class="nav-link" href="#">Gallery</a></li>
                    <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
                    @auth
                        <li class="dropdown"><a
                                href="#"><span>{{ \Illuminate\Support\Str::limit(Auth::user()->name, 10, '...') }}</span>
                                <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a class="nav-link" href="{{ Route('admin.index') }}">Dashboard</a></li>
                                <li>
                                    <a class="nav-link" href="#" onclick="event.preventDefault();
                        document.getElementById('formLogoutMuseum').submit();">Logout</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a class="nav-link scrollto" href="{{ Route('login') }}">Login</a></li>

                    @endauth

                    <li class="dropdown"><a href="#"><span>Augmented Reality</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            @if (Auth::guard('augmentedRealities')->user())
                                <li><a class="nav-link" href="{{ Route('ArReader') }}">Start Augmented
                                        Reality</a></li>
                                <li>
                                    <a class="nav-link" href="#" onclick="event.preventDefault();
                           document.getElementById('formLogout').submit();">Logout</a>
                                </li>
                            @else
                                <li><a data-bs-toggle="modal" href=" #modalForm" role="button">Login</a></li>
                            @endif
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
            @else
                <ul>
                    <li><a class="nav-link scrollto" href="/">Home</a></li>
                    <li><a class="nav-link" href="#">Gallery</a></li>
                    <li class="dropdown"><a href="#" class="@if (Route::is('ArReader'))nav-link active @endif"><span>Augmented
                                Reality</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>

                            @if (Auth::guard('augmentedRealities')->user())
                                <li @if (Route::is('ArReader')) class="d-none" @endif><a class="nav-link"
                                        href="{{ Route('ArReader') }}">Start Augmented
                                        Reality</a></li>
                                <li>
                                    <a class="nav-link" href="#" onclick="event.preventDefault();
                        document.getElementById('formLogout').submit();">Logout</a>
                                </li>
                            @else
                                <li><a data-bs-toggle="modal" href=" #modalForm" role="button">Login</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            @endif
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<form action="{{ Route('ArReader.logout') }}" method="post" id="formLogout">
    @csrf
</form>

<form action="{{ Route('logout') }}" method="post" id="formLogoutMuseum">
    @csrf
</form>
