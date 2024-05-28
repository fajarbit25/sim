@extends('template/layout')
@section('main')
<!-- Id User Definition -->
<input type="hidden" name="user_id" id="user_id" value=""/>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>SIMS</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/siswa">Siswa</a></li>
        <li class="breadcrumb-item">{{$title}}</li>
        </ol>
    </nav>
  </div><!-- End Page Title -->
  <div class="row">
    <div class="col-lg-8">
        <!-- Default Card -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Absensi</h5>

            <ol class="list-group list-group">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                  <div class="ms-2 me-auto">
                    <div class="fw-bold">Masuk</div>
                  </div>
                  <span class="badge bg-success rounded-pill">10 hari</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                  <div class="ms-2 me-auto">
                    <div class="fw-bold">Izin</div>
                  </div>
                  <span class="badge bg-warning rounded-pill">05 hari</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                      <div class="fw-bold">Alfa</div>
                    </div>
                    <span class="badge bg-danger rounded-pill">03 hari</span>
                  </li>
              </ol>

        </div>
        </div><!-- End Default Card -->
    </div>

    <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Progres Semester</h5>

            <!-- Doughnut Chart -->
            <canvas id="doughnutChart" style="max-height: 124px;"></canvas>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#doughnutChart'), {
                  type: 'doughnut',
                  data: {
                    labels: [
                      'Sisa',
                      'Berjalan'
                    ],
                    datasets: [{
                      label: 'Semester',
                      data: [20, 40],
                      backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)'
                      ],
                      hoverOffset: 4
                    }]
                  }
                });
              });
            </script>
            <!-- End Doughnut CHart -->

          </div>
        </div>
      </div>

    <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Nilai Siswa</h5>

            <!-- Line Chart -->
            <canvas id="lineChart" style="max-height: 260px;"></canvas>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#lineChart'), {
                  type: 'line',
                  data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [
                    {
                      label: 'Pelajaran',
                      data: [35, 19, 25, 55, 20, 30, 40],
                      fill: false,
                      borderColor: 'rgb(75, 192, 192)',
                      tension: 0.1
                    },
                    {
                      label: 'B. Asing',
                      data: [65, 59, 80, 81, 56, 55, 45],
                      fill: false,
                      borderColor: 'rgb(220, 20, 60)',
                      tension: 0.1
                    },
                    {
                      label: 'Tahfidz',
                      data: [30, 55, 70, 85, 40, 30, 20],
                      fill: false,
                      borderColor: 'rgb(19, 100, 0)',
                      tension: 0.1
                    },
                    {
                      label: 'Ekskul',
                      data: [20, 45, 60, 75, 30, 20, 10],
                      fill: false,
                      borderColor: 'rgb(253, 215, 3)',
                      tension: 0.1
                    }
                    ]
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              });
            </script>
            <!-- End Line CHart -->

          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <!-- Default Card -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Siswa</h5>

            <p>
                <strong>NIS : </strong> {{$siswa->nip}} <br/>
                <strong>Nama :</strong> {{$siswa->first_name.' '.$siswa->last_name}} <br/>
                <strong>Jenis Kelamin : </strong> {{$siswa->gender}} <br/>
                <strong>Kelas :</strong> {{$rooms->kode_kelas}} <br/>
                <strong>Tempat. Tgl Lahir :</strong> {{$siswa->tempat_lahir}}, {{$siswa->tanggal_lahir}} <br/>
                <strong>Email : </strong> {{$siswa->email}} <br/>
                <strong>Phone : </strong> {{$siswa->phone}} <br/>
                <strong>Alamat : </strong> {{$siswa->address}}
            </p>

          </div>
        </div><!-- End Default Card -->
      </div>

      <div class="col-lg-12">
        <!-- Default Card -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nilai</h5>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai Rata-Rata</th>
                            <th>Nilai Ujian Sekolah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Pendidikan Agama Dan Budi Pekerti</td>
                            <td>88</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Pendidikan Pancasila Dan Kewarganegaraan</td>
                            <td>85</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Bahasa Indonesia</td>
                            <td>85</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Matematika</td>
                            <td>75</td>
                            <td>0</td>
                        </tr>
                        <tr>
                          <th colspan="2">Rata-Rata</th>
                          <th>85.2</th>
                          <th>0.0</th>
                      </tr>
                    </tbody>
                    
                </table>
            </div>

          </div>
        </div><!-- End Default Card -->
      </div>
      
    </div>
</main>
@endsection