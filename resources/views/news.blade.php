@extends('template.layoutHome')
@section('main')
<main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Baca Berita</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li><a href="portfolio.html">Berita</a></li>
            <li>Baca Berita</li>
          </ol>
        </div>

      </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="">
                  <img src="{{asset('storage/photo-news/'.$berita->poster)}}" alt="IMG" style="width: 100%;">
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Informasi</h3>
              <ul>
                <li><strong>Judul</strong>: {{$berita->judul}}</li>
                <li><strong>Upload By</strong>: 
                  @if($berita->level == 1)
                    <span>Administrator</span>
                  @elseif($berita->level == 2)
                    <span>Kepala Sekolah</span>
                  @elseif($berita->level == 3)
                    <span>Staff/Guru</span>
                  @else
                    <span>Siswa</span>
                  @endif
                </li>
                <li><strong>Tanggal Posting</strong>: {{$berita->post_date}}</li>
              </ul>
            </div>
          </div>
          <div class="portfolio-description">
            <h2>{!!$berita->judul!!}</h2>
              {!!$berita->berita!!}
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->
  @endsection