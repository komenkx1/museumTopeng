  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">


          <li class="nav-item">
            <a class="nav-link  @if (Route::is('admin.index')) active @else collapsed @endif" href="{{ Route('admin.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

          <li class="nav-item">
            <a class="nav-link @if (Route::is('admin.augmented-reality.*')) active @else collapsed @endif" href="{{ Route('admin.augmented-reality.index') }}">
                <i class="bi bi-card-image"></i>
                <span>Aumented Reality Source</span>
            </a>
        </li><!-- End Dashboard Nav -->

      </ul>

  </aside><!-- End Sidebar-->
