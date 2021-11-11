  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Master Data</li>

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
        </li><!-- End AR Nav -->

        <li class="nav-item">
          <a class="nav-link @if (Route::is('admin.packages.*')) active @else collapsed @endif" href="{{ Route('admin.packages.index') }}">
              <i class="bi bi-box"></i>
              <span>Packages</span>
          </a>
      </li><!-- End Packages Nav -->

      <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.events.*')) active @else collapsed @endif" href="{{ Route('admin.events.index') }}">
          <i class="bi bi-calendar-event"></i>
            <span>Event</span>
        </a>
    </li><!-- End Event Nav -->
    <li class="nav-item">
      <a class="nav-link @if (Route::is('admin.gallery.*')) active @else collapsed @endif" href="{{ Route('admin.gallery.index') }}">
        <i class="bi bi-image"></i>
          <span>gallery</span>
      </a>
  </li><!-- End Gallery Nav -->
      <li class="nav-heading">Transaction Data</li>
      <li class="nav-item">
        <a class="nav-link @if (Route::is('admin.transactions.*')) active @else collapsed @endif" href="{{ Route('admin.transactions.index') }}">
            <i class="bi bi-box"></i>
            <span>Transaction</span>
        </a>
    </li><!-- End Transaction Nav -->
      </ul>

  </aside><!-- End Sidebar-->
