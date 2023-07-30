<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      @if (Auth::user()->role == 'admin'|| Auth::user()->role == 'pakar')
      <li class="nav-item">
        <a class="nav-link " href="/Admin/Dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <!-- End Profile Page Nav -->
      @if(Auth::user()->role !== 'pakar')
      <li class="nav-item">
        <a class="nav-link collapsed" href="/Admin/Data_Admin">
          <i class="bi bi-menu-button-wide"></i><span>Data Admin</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="/Profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      @endif<!-- End Components Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="/Admin/Data_Diagnosa">
          <i class="bi bi-menu-button-wide"></i><span>Data Diagnosa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/Admin/Data_Penyakit">
          <i class="bi bi-journal-text"></i><span>Data Penyakit</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
       
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed"  href="/Admin/Data_Gejala">
          <i class="bi bi-layout-text-window-reverse"></i><span>Data Gejala</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      </li><!-- End Tables Nav -->
      @endif
      @if(Auth::user()->role !== 'pakar')
      <li class="nav-item">
        <a class="nav-link collapsed"  href="/Admin/Rule">
          <i class="bi bi-bar-chart"></i><span>Basis Pengetahuan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/Admin/Artikel">
          <i class="bi bi-gem"></i><span> Data Artikels</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link collapsed" href="/logout">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->
     
     
    </ul>

  </aside><!-- End Sidebar-->
