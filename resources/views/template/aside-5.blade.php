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
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cash-coin">
            </i>Catatan Keuangan &nbsp; <i id="finance-notif-up"></i>
          </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/keuangan">
              <i class="bi bi-circle"></i><span>Keuangan</span>
            </a>
          </li>
          <li>
            <a href="/finance/transaction">
              <i class="bi bi-circle"></i><span>Transaksi</span>
            </a>
          </li>
          <li>
            <a href="/finance/mutasi">
              <i class="bi bi-circle"></i><span>Mutasi</span>
            </a>
          </li>
          
          <li>
            <a href="/finance/confirm">
              <i class="bi bi-circle"></i>
              <span>Konfirmasi</span> &nbsp; <span id="finance-notif-down"></span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#invoice-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-receipt"></i> Tagihan &nbsp; <i id="finance-notif-up"></i>
          </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="invoice-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/finance/payment-master">
              <i class="bi bi-circle"></i><span>Database Siswa</span>
            </a>
          </li>
          <li>
            <a href="/finance/payment-unpaid">
              <i class="bi bi-circle"></i><span>Belum Terbayar</span>
            </a>
          </li>
          <li>
            <a href="/finance/payment-history">
              <i class="bi bi-circle"></i><span>Riwayat</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#setting-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear-wide-connected"></i> Setting &nbsp; <i id="finance-notif-up"></i>
          </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="setting-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/finance/api-setting">
              <i class="bi bi-circle"></i><span>Api Setting</span>
            </a>
          </li>
          <li>
            <a href="/finance/potongan-tagihan">
              <i class="bi bi-circle"></i><span>Potongan Tagihan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->


      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#homepage" data-bs-toggle="collapse" href="#">
          <i class="bi bi-house-gear"></i>Homepage</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="homepage" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/berita">
              <i class="bi bi-circle"></i><span>Berita</span>
            </a>
          </li>
        </ul>
      </li><!-- End Homepage Nav -->

      

      <li class="nav-item">
        <a class="nav-link collapsed" href="/profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

    </ul>
</aside><!-- End Sidebar-->