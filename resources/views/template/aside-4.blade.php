<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#data-siswa" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-bounding-box"></i><span>Data Siswa</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="data-siswa" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/user/statistik">
              <i class="bi bi-circle"></i><span>Statistik</span>
            </a>
          </li>
          <li>
            <a href="/user/e-raport" disabled>
              <i class="bi bi-circle"></i><span>E Raport</span>
            </a>
          </li>
          <li>
            <a href="/user/report">
              <i class="bi bi-circle"></i><span>Data Konseling</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#pembayaran" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cash-coin"></i><span>Pembayaran</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="pembayaran" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/user/invoice">
              <i class="bi bi-circle"></i><span>Tagihan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="/siswa/profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->


    </ul>
</aside><!-- End Sidebar-->