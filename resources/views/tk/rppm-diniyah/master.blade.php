@extends('template.layout')
@section('main')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>SIMS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/tk/rppm-diniyah">RPPM Diniyah</a></li>
          <li class="breadcrumb-item">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        @livewire('tk.rppmdiniyah.master')
    </section>
</main>


@endsection
