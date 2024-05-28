@extends('template.layoutHome')
@section('main')
 
<section id="hero">
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      @foreach($banner as $bnr)
      <div class="carousel-item @if($loop->iteration == 1) active @endif">
        <img src="{{asset('storage/home-banner/'.$bnr->foto)}}" class="d-block w-100" alt="banner">
      </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</section>

  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon text-tk"><i class="bi bi-balloon-heart"></i></div>
              <h4 class="title"><a href="https://tkit.iqis.sch.id">TK<span class="text-tk">IT</span></a></h4>
              <p class="description">
                TK Islam Terpadu Ibnul Qayyim Islamic School
              </p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon text-sd"><i class="bi bi-people"></i></div>
              <h4 class="title"><a href="https://sdit.iqis.sch.id">SD<span class="text-sd">IT</span></a></h4>
              <p class="description">SD Islam Terpadu Ibnul Qayyim Islamic School</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon text-smp"><i class="bi bi-book-half"></i></div>
              <h4 class="title"><a href="https://smpit.iqis.sch.id">SMP<span class="text-smp">IT</span></a></h4>
              <p class="description">SMP Islam Terpadu Ibnul Qayyim Islamic School</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon text-sma"><i class="bi bi-mortarboard"></i></div>
              <h4 class="title"><a href="https://smkit.iqis.sch.id">SMK<span class="text-sma">IT</span></a></h4>
              <p class="description">SMK Islam Terpadu Ibnul Qayyim Islamic School</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Featured Services Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <h3>Cari Tahu <span>Tentang Kami</span></h3>
          <P>
            Mencetak Generasi Muslim yang Shalih, Hafizh dan Terampil
          </P>
          <p>
            Yayasan Pendidikan Islam Ibnul Qayyim Islamic School berdakwah di masyarakat melalui jalur pendidikan formal dengan jenjang mulai dari TK, SD, SMP, sampai SMK yang berlandaskan prinsip Ahlussunnah Wal Jamaah
          </p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="{{url('Home/assets/img/about-2.png')}}" class="img-fluid" alt="" style="width:100%; heigth:100%">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <h3>
              “Mukmin yang kuat lebih baik dan lebih dicintai Allah Azza wa Jalla daripada mukmin yang lemah …” 
            </h3>
            <p class="fst-italic">
              (Hadist shahih riwayat Imam Muslim dan lainnya)
            </p>
            <p>
              Sebuah hadits yang mulia dari Rasulullah shallallahu ‘alaihi wa sallam dimana ulama menjelaskan bahwa barangsiapa yang mengerjakan amal-amal shalih dengan benar, memperbaiki dirinya dengan ilmu yang bermanfaat dan amal shalih, juga memperbaiki orang lain dengan saling menasehati dalam kebenaran dan kesabaran, maka dia adalah Mukmin yang kuat. Dalam diri orang seperti ini terdapat tingkatan iman yang paling tinggi. Siapa yang belum sampai pada tingkatan ini, maka dia adalah Mukmin yang lemah.<br/>
              Inilah yang memotivasi kami untuk terus menguatkan barisan kaum muslimin melalui jalur pendidikan. Karena hanya dengan pendidikan yang sesuai dengan tuntunan Rasulullah shallallahu ‘alaihi wa sallam saja kaum muslimin dapat meraih kemuliaannya di sisi Allah Azza wa Jalla.<br/>
              Setelah berpengalaman selama 7 tahun mengusung pendidikan Islami yang berkualitas berbasis Sekolah Dasar, maka pada tahun 2018 kami melanjutkan tahapan pendidikan yang lebih tinggi berbasis Sekolah Menegah Pertama. Alhamdulillah dengan izin Allah Tabaraka wa Ta’ala Ibnul Qayyim Islamic School terus mendapat respon positif dari masyarakat sejak berdirinya hingga hari ini.<br/>
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{$count_siswa}}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Siswa</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="bi bi-journal-richtext"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{$count_guru}}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Guru Dan Pegawai</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-people"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{$count_campus}}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Sekolah</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Fasilitas</h2>
          <h3>Check our <span>Fasilitas</span></h3>
          <p>Fasilitas sekolah sangat berperang penting untuk  menunjang aktivitas belajar mengajar disekolah.</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-buildings"></i></div>
              <h4><a href="">Gedung Dan Halaman Sekolah</a></h4>
              <p>Terdapat Gedung Dan Halaman Sekolah yang luas, bersih, dan asri.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-building-check"></i></div>
              <h4><a href="">Ruang Kelas Yang Nyaman</a></h4>
              <p>Ruang Kelas Yang Nyaman akan membuat siswa lebih betah untuk belajar.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-mortarboard"></i></div>
              <h4><a href="">Tenaga Profesional</a></h4>
              <p>Kami menhadirkan tenaga yang ahli dibidang nya. untuk menghasilkan kualitas belajar mengajar lebih baik.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-shop"></i></div>
              <h4><a href="">Kantin Bersih</a></h4>
              <p>Kesehatan lingkungan sangat berpengaruh, termasuk Fasilitas kantin sekolah juga hari tetap terjaga kebersihan nya.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-thermometer-snow"></i></div>
              <h4><a href="">Laboratorium</a></h4>
              <p>Laboratorium lengkap, agar siswa dapat berkreasi dan berinovasi dengan bebas.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-shield-check"></i></div>
              <h4><a href="">Keamanan</a></h4>
              <p>Keamanan 24 jam, untuk menjamin keselamatan siswa saat berada dilingkungan sekolah.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Team</h2>
          <h3>Our Hardworking <span>Team</span></h3>
          <p>Staf dan pengurus Yayasan Ibnul Qayyim Islamic School Makassar.</p>
        </div>

        <div class="row">
          @foreach($team as $tim)
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="member-img">
                <img src="{{asset('storage/our-tim/'.$tim->foto)}}" class="img-fluid" alt="">
                <div class="social">
                  <a target="_blank" href="{{$tim->twitter}}"><i class="bi bi-twitter"></i></a>
                  <a target="_blank" href="{{$tim->fb}}"><i class="bi bi-facebook"></i></a>
                  <a target="_blank" href="{{$tim->ig}}"><i class="bi bi-instagram"></i></a>
                  <a target="_blank" href="{{$tim->linked}}"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>{{$tim->nama}}</h4>
                <span>{{$tim->jabatan}}</span>
              </div>
            </div>
          </div>
          @endforeach

        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Berita</h2>
          <h3>Berita <span>Terkini</span></h3>
          <p>Ikuti berita terbaru tetang Ibnul Qayyim Islamic School Makassar.</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Semua</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
          @foreach ($news as $item)
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="{{asset('storage/photo-news/'.$item->poster)}}" class="img-fluid" alt="IMG">
            <div class="portfolio-info">
              <h4><i class="bi bi-newspaper"></i> {{$item->judul}}</h4>
              <p><i class="bi bi-calendar-week"></i> {{$item->post_date}}</p>
              <a href="{{asset('storage/photo-news/'.$item->poster)}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="{{$item->judul}}"><i class="bx bx-plus"></i></a>
              <a href="{{url('/news').'/'.$item->idnews.'/read'}}" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
          @endforeach

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Kontak</h2>
          <h3><span>Hubungi Kami</span></h3>
          <p>Jangan segan untuk menguhubungi kami melalui kontak yang telah disediakan.</p>
        </div>

        <div class="row">

        <div class="row col-lg-6" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-12 ">
            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1052.593057285752!2d119.52824285052118!3d-5.093664471271525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefb98cf06e587%3A0xe048f9722d2bde85!2sSDIT%20Ibnul%20Qayyim%20Makassar!5e0!3m2!1sen!2sid!4v1694280581845!5m2!1sen!2sid" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
          </div>

        </div>

        <div class="row col-lg-6" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <p>
                {{$contact->campus_alamat}}<br/> 
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email</h3>
              <p>{{$contact->email_campus}}</p>
            </div>
          </div>

          <div class="col-lg-6 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Contact</h3>
              <p>	{{$contact->campus_contact}} </p>
            </div>
          </div>

        </div>
      </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  @endsection
