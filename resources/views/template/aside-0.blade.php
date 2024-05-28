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
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Data Dapodik</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/siswa')}}">
              <i class="bi bi-circle"></i><span>Data Siswa</span>
            </a>
          </li>
          <li>
            <a href="{{url('/guru')}}">
              <i class="bi bi-circle"></i><span>Data Guru Dan Staff</span>
            </a>
          </li>
          <li>
            <a href="{{url('/siswa/tracert-study')}}">
              <i class="bi bi-circle"></i><span>Tracert Study</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#nilai-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart-line"></i><span>Nilai Akademik</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="nilai-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

          @if(Auth::user()->campus_id == 2 || Auth::user()->level == 0)
          <li>
            <a href="{{url('/tk/daily/report')}}">
              <i class="bi bi-circle"></i><span>Laporan Harian</span>
            </a>
          </li>
          <li>
            <a href="{{url('/tk/rppm-diniyah')}}">
              <i class="bi bi-circle"></i><span>RPPM Diniyah</span>
            </a>
          </li>
          <li>
            <a href="{{url('/tk/raport-mid-semester')}}">
              <i class="bi bi-circle"></i><span>Raport Mid</span>
            </a>
          </li>
          <li>
            <a href="{{url('/tk/raport-semester')}}">
              <i class="bi bi-circle"></i><span>Raport Semester</span>
            </a>
          </li>
          @endif

          <li>
            <a href="{{url('/nilai/kaldik')}}">
              <i class="bi bi-circle"></i><span>Kalender Pendidikan</span>
            </a>
          </li>
          <li>
            <a href="{{url('/nilai/perangkat-pembelajaran')}}">
              <i class="bi bi-circle"></i><span>Perangkat Pembelajaran</span>
            </a>
          </li>
          <li>
            <a href="{{url('/nilai/report')}}">
              <i class="bi bi-circle"></i><span>Report</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#absenGuru-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-week"></i><span>Absensi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="absenGuru-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/absen/report')}}">
              <i class="bi bi-circle"></i><span>Siswa</span>
            </a>
          </li>
          <li>
            <a href="{{url('/absen/guru/report')}}">
              <i class="bi bi-circle"></i><span>Guru & Staff</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#admin-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-sliders"></i><span>Administrasi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="admin-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/campus')}}">
              <i class="bi bi-circle"></i><span>Data Sekolah</span>
            </a>
          </li>
          <li>
            <a href="{{url('/level')}}">
              <i class="bi bi-circle"></i><span>Level User</span>
            </a>
          </li>
          <li>
            <a href="{{url('/tahun_akademik')}}">
              <i class="bi bi-circle"></i><span>Tahun Akademik</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#ppdb-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-add"></i>PPDB</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="ppdb-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/admin/ppdb/master">
              <i class="bi bi-circle"></i><span>Master</span>
            </a>
          </li>
          <li>
            <a href="/admin/ppdb/new">
              <i class="bi bi-circle"></i><span>Calon Peserta Didik</span>
            </a>
          </li>
          <li>
            <a href="/admin/ppdb">
              <i class="bi bi-circle"></i><span>Diterima</span>
            </a>
          </li>
          <li>
            <a href="/admin/ppdb/rejected">
              <i class="bi bi-circle"></i><span>Ditolak</span>
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
          <li>
            <a href="/banner">
              <i class="bi bi-circle"></i><span>Banner</span>
            </a>
          </li>
          <li>
            <a href="/tim">
              <i class="bi bi-circle"></i><span>Our Team</span>
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