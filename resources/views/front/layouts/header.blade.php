 <!-- ======= Header ======= -->
 <header id="header" class="fixed-top d-flex align-items-center header-transparent">
     <div class="container d-flex align-items-center justify-content-between">

         <div class="logo d-flex align-items-center">
             <img src="assets/img/icon.png" alt="" class="me-2">
             <h6><a href="index.html"><span> SETIA DARMA HOUSE OF MASKS AND PUPPETS</span></a></h6>
             <!-- Uncomment below if you prefer to use an image logo -->
             <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
         </div>

         <nav id="navbar" class="navbar">
             

             @if (Route::is("ArReader"))
                <ul>
                    <li>
                        <a class="nav-link" href="#" onclick="event.preventDefault();
                        document.getElementById('formLogout').submit();">Logout</a>
                                             
                                            </li>
                </ul>
              @else
              <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#event">Event</a></li>
                {{-- <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
         <li><a class="nav-link scrollto" href="#team">Team</a></li> --}}
                
                <li class="dropdown"><a href="#"><span>Augmented Reality</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                     @if (Auth::guard('augmentedRealities')->user())
                     <li><a class="nav-link"  href="{{ Route("ArReader") }}">Start Augmented Reality</a></li>
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
             @endif
             <i class="bi bi-list mobile-nav-toggle"></i>
         </nav><!-- .navbar -->

     </div>
 </header><!-- End Header -->

 <form action="{{ Route("ArReader.logout") }}" method="post" id="formLogout">
    @csrf
</form>
