@extends('template.layout')
@section('main')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>SIMS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/tk/raport-mid-semester">Raport Mid Semester</a></li>
          <li class="breadcrumb-item"><a href="/tk/raport-mid-semester/penilaian">Penilaian</a></li>
          <li class="breadcrumb-item">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
 

    <section class="section">
        @livewire('tk.raport-mid.form')
    </section>
</main>

@endsection
