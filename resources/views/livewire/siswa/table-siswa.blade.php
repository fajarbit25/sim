<div class="col-sm-12">
    <div class="row">
        <div class="row">

            <div class="col-lg-12">
    
              <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span>
                        Data Siswa
                    </h5>
                    <div class="col-lg-12 mb-3">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    @if(Auth::user()->level == 1)
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">
                                    <i class="bi bi-plus-lg"></i> New
                                    </button>
                                    @endif
                
                                    <a href="/siswa/excel" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-download"></i> Export
                                    </a>
                
                                    @if(Auth::user()->level == 1)
                                    <a href="/siswa/import" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-upload"></i> Import
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                
                            </div>

                        </div>
                      
                    </div>
                    <div class="table-responsive">
                        <!-- Table with stripped rows -->
                      <table class="table datatable" style="font-size: 12px">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIS/NISN</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">JK</th>
                            <th scope="col">Handphone</th>
                            <th scope="col">Email</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($dataSiswa as $sis)
                          <tr id="row">
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>
                              <a href="/siswa/{{$sis->id}}/show" class="fw-bold"> {{$sis->nis}} / {{$sis->nisn}}</a>
                            </td>
                            <td>{{$sis->first_name}}</td>
                            <td>
                              @if($sis->tingkat == 0)
                              - 
                              @else
                              {{$sis->tingkat.'.'.$sis->kode_kelas}}
                              @endif
                            </td>
                            <td>
                                @if($sis->gender == "Laki-laki") <span>L</span>
                                @elseif($sis->gender == "Perempuan") <span>P</span>
                                @else <span>Unknow</span>
                                @endif

                            </td>
                            <td>{{$sis->phone}}</td>
                            <td>{{$sis->email}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <!-- End Table with stripped rows -->
                    </div>
                </div>
              </div>
    
            </div>
          </div>
    </div>

    <!-- Modal New -->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <form method="POST" action="{{url('/siswa')}}">
                @csrf
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-plus-lg"></i> Data Siswa</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group mb-3">
                        <label for="nisn">NISN <span class="text-danger">*</span></label>
                        <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{old('nisn')}}" required autocomplete="off"/>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                          @error('nisn')
                            {{$message }}
                          @enderror
                        </div>                  
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3">
                        <label for="nis">NIPD/NIS <span class="text-danger">*</span></label>
                        <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" value="{{old('nis')}}" required autocomplete="off"/>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                          @error('nis')
                            {{$message }}
                          @enderror
                        </div>                  
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group mb-3">
                        <label for="first_name">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name')}}" required autocomplete="off"/>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                          @error('first_name')
                            {{$message }}
                          @enderror
                        </div>                  
                      </div>
                    </div>  
                    <div class="col-lg-6">
                      <div class="form-group mb-3">
                        <label for="email">Alamat Email <span class="text-danger">*</span></label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" required autocomplete="off"/>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                          @error('email')
                            {{$message }}
                          @enderror
                        </div>                  
                      </div>
                    </div> 
                    <div class="col-lg-6">
                      <div class="form-group mb-3">
                        <label for="phone">Nomor Handphone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}" required autocomplete="off"/>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                          @error('phone')
                            {{$message }}
                          @enderror
                        </div>                  
                      </div>
                    </div> 
                    <div class="col-lg-6">
                      <div class="form-group mb-3">
                        <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{old('tempat_lahir')}}" required autocomplete="off"/>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                          @error('tempat_lahir')
                            {{$message }}
                          @enderror
                        </div>                  
                      </div>
                    </div> 
                    <div class="col-lg-6">
                      <div class="form-group mb-3">
                        <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{old('tanggal_lahir')}}" required autocomplete="off"/>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                          @error('tanggal_lahir')
                            {{$message }}
                          @enderror
                        </div>                  
                      </div>
                    </div> 
                    <div class="col-lg-12">
                      <div class="form-group mb-3">
                        <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" value="{{old('gender')}}">
                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                          @error('gender')
                            {{$message }}
                          @enderror
                        </div>                  
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <span class="fw-bold fst-italic">Noted :</span><br/>
                        <span class="fst-italic">Untuk informasi login Orang Tua/Siswa gunakan detail sbb:</span> <br/>
                        <span class="fw-bold fst-italic">Username :</span><span class="fst-italic">"Alamat Email"</span> <br/>
                        <span class="fw-bold fst-italic">Password :</span><span class="fst-italic">"Tanggal Lahir"</span><br/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                  </button>
                </div>
              </form>
          </div>
        </div>
    </div>



</div>