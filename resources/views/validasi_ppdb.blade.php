@extends('template.layoutHome')
@section('main')
<main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>{{$title}}</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li><a href="portfolio.html">Berita</a></li>
            <li>Validasi Data PPDB IQIS</li>
          </ol>
        </div>

      </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-12">
            <div class="portfolio-info">
              <h3>Yayasan Pendidikan Islam Ibnul Qayyim</h3>
              <span class="text-success fw-bold">Hasil Validasi Kartu Pendaftaran PPDB SMKIT Ibnul Qayyim</span><br/>
              Nomor Pendaftaran : <span class="text-success fw-bold">{{$ppdb->nomor_pendaftaran}}</span>
              <table class="table table-bordered mt-3">
                <thead class="table-light">
                  <tr>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Lokasi Pendaftaran</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$ppdb->nisn}}</td>
                        <td>{{$ppdb->first_name}}</td>
                        <td>{{$ppdb->gender}}</td>
                        <td>{{$ppdb->lokasi_pendaftaran}}</td>
                    </tr>
                </tbody>
              </table>
              <div class="alert alert-success mt-5">
                <span class="fw-bold">Description :</span><br/>
                Data diatas Adalah benar dan tercatat dalam database kami. .
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->
@endsection