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
        <!-- Table -->
        <div class="col-lg-12">
            
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><span>News |</span> Berita Terbaru</h5>
                <a href="{{url('/tim/add')}}" class="btn btn-primary btn-sm" ><i class="bi bi-plus-square"></i> Add New team</a>
                <!-- Table with stripped rows -->
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Jabatan</th>
                      <th scope="col">Twitter</th>
                      <th scope="col">Facebook</th>
                      <th scope="col">Instagram</th>
                      <th scope="col">Linked</th>
                      <th scope="col" colspan="3">Manage</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($team as $tim)
                    <tr>
                        <td> {{$loop->iteration}} </td>
                        <td> {{$tim->nama}} </td>
                        <td> {{$tim->jabatan}} </td>
                        <td> {{$tim->twitter}} </td>
                        <td> {{$tim->fb}} </td>
                        <td> {{$tim->ig}} </td>
                        <td> {{$tim->linked}} </td>
                        <td>
                            <!-- Button trigger modal -->
                            <a href="/tim/{{$tim->idteam}}/edit" class="btn btn-outline-success btn-xs" style="white-space: nowrap;">Manage <i class="bi bi-arrow-right"></i></a>
                            
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
  
              </div>
            </div>
          </div>
          <!-- End Table -->
      </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" alt="foto"/>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </div>
    @endsection