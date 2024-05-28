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
                <a href="{{url('/addNews')}}" class="btn btn-primary btn-sm"><i class="bi bi-plus-square"></i> Buat Berita</a>
                <!-- Table with stripped rows -->
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Judul</th>
                      <th scope="col">Posted By</th>
                      <th scope="col">Status</th>
                      <th scope="col" colspan="3">Manage</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($news as $news)
                    <tr>
                      <th scope="row">{{$loop->iteration}}</th>
                      <td>{{$news->post_date}}</td>
                      <td>{{$news->judul}}</td>
                      <td>{{$news->first_name.' '.$news->last_name}}</td>
                      <td>
                        @if($news->posted == 0)
                        <span class="badge text-bg-warning">Draft</span>
                        @else
                        <span class="badge text-bg-info">Posted</span>
                        @endif
                      </td>
                      <td>
                        <a href="/berita/{{$news->idnews}}/edit"  class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                      </td>

                      <td>
                        @if($news->posted == 0)
                        <button type="button" class="btn btn-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#modalDeleter"><i class="bi bi-trash"></i> Hapus</i></button>
                        <!-- Modal Posting -->
                          <div class="modal fade" id="modalDeleter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-triangle"></i> <strong>Comfirm!</strong></h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <strong>Apakah anda ingin menghapus berita?</strong>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{url('/news/delete')}}" method="POST">
                                        @csrf
                                        <input type="hidden" id="idnews" value="{{$news->idnews}}" name="idnews"/>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
                                        <button type="submit" class="btn btn-danger" ><i class="bi bi-trash"></i> Hapus</button>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endif
                      </td>

                      <td>
                        @if($news->posted == 0)
                        <button type="button" class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#modalPosting"><i class="bi bi-send-check"></i> Posting</i></button>
                        <!-- Modal Posting -->
                          <div class="modal fade" id="modalPosting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-triangle"></i> <strong>Comfirm!</strong></h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <strong>Apakah anda ingin memposting berita?</strong>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{url('/news/posts')}}" method="POST">
                                        @csrf
                                        <input type="hidden" id="idnews" value="{{$news->idnews}}" name="idnews"/>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
                                        <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Posting</button>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        @else
                        <button type="button" class="btn btn-secondary btn-sm"  data-bs-toggle="modal" data-bs-target="#modalTakeDown"><i class="bi bi-arrow-return-left"></i> Take Down</i></button>
                        <!-- Modal Posting -->
                          <div class="modal fade" id="modalTakeDown" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-triangle"></i> <strong>Comfirm!</strong></h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <strong>Tarik Berita Ini?</strong>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{url('/news/takeDown')}}" method="POST">
                                        @csrf
                                        <input type="hidden" id="idnews" value="{{$news->idnews}}" name="idnews"/>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
                                        <button type="submit" class="btn btn-success"><i class="bi bi-arrow-return-left"></i> Tarik</button>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endif
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
    @endsection