@extends('template.layout')
@section('main')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>SIMS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <section class="section">
      <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-binoculars"></i> {{$title}}</h5>
                <div>
                    @livewire('tracert-study.index')
                </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


  <!-- Modal Delete -->
  <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{url('/siswa/delete')}}" method="POST">
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel"><i class="bi bi-exclamation-triangle"></i> Alert!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h5>Yakin ingin menghapus data?</h5>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" id="id" required/>
            <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i> Ya</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Tidak</button>
          </div>
        </form>
      </div>
    </div>
  </div>


@endsection