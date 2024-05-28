<!-- Table with stripped rows -->
<table class="table datatable" id="dataTable">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Kelas</th>
        <th scope="col">Wali Kelas</th>
        <th scope="col">Jumlah Siswa</th>
        <th scope="col">Edit</th>
    </tr>
    </thead>
    <tbody>
    @foreach($kelas as $kls)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>
                {{$kls->tingkat.' '.$kls->kode_kelas}}
            </td>
            <td>{{$kls->first_name}}</td>
            <td>
                <span id="jumlahSiswa-{{$kls->idkelas}}"></span>
            </td>
            <td>
                <a href="#" class="btn btn-success btn-xs" onclick="edit({{$kls->idkelas}})" title="Edit">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
                <a href="/kelas/{{$kls->idkelas}}/siswa" class="btn btn-primary btn-xs" title="Edit">
                    <i class="bi bi-person-fill-add"></i> Add Siswa
                </a>
                <button type="button" class="btn btn-info btn-sm" onclick="modalNaikKelas({{$kls->idkelas}})">
                    <i class="bi bi-arrow-up-square-fill"></i> Naik Kelas
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $kelas->links() }}
<!-- End Table with stripped rows -->

<!-- Modal Add-->
<div class="modal fade" id="modalNaikKelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-arrow-up-square-fill"></i> Modul Naik Kelas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="form-group mb-3">
            <label for="formKelas">Nama Kelas</label>
            <input type="text" name="formKelas" id="formKelas" class="form-control" disabled/>
          </div>

          <div class="form-group mb-3">
            <label for="formJumlahSiswa">Jumlah Siswa</label>
            <input type="text" name="formJumlahSiswa" id="formJumlahSiswa" class="form-control" disabled/>
          </div>

          <div class="form-group mb-3">
            <label for="formWaliKelas">Wali Kelas</label>
            <input type="text" name="formWaliKelas" id="formWaliKelas" class="form-control" disabled/>
          </div>

          <div class="form-group mb-3">
            <label for="formNaikKelasTujuan">Kelas Tujuan</label>
            <select name="formNaikKelasTujuan" id="formNaikKelasTujuan" class="form-control">
                <option value="">--Pilih Kelas Tujuan--</option>
                @foreach($dataModalKelas as $dmk)
                    <option value="{{$dmk->idkelas}}">Kelas - {{$dmk->kode_kelas}}</option>
                @endforeach
                <option value="Tamat">Tamat/Lulus</option>
            </select>
          </div>

          <div class="alert alert-warning alert-dismissible fade show" role="alert" id="infoKelasTujuan">
            <strong>Alert!</strong> Data pada Kelas tujuan belum Dikosongkan!
            <button type="button" class="btn-close" id="closeNotifNaikKelas"></button>
          </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" name="formIdKelas" id="formIdKelas" required/>
          <button type="button" class="btn btn-secondary" id="closeModal" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
          <button type="button" class="btn btn-primary" id="btnProsesNaikKelas" onclick="prosesNaikKelas()"><i class="bi bi-check-lg"></i> Proses</button>
        </div>
      </div>
    </div>
</div>



<script>
    $(document).ready(function(){
        //Sembunyikan notif modal naik kelas
        $("#infoKelasTujuan").hide();

        //count siswa
        var url = "/kelas/jumlah-siswa/json";
        $.ajax({
            url:url,
            type:'GET',
            dataType:'json',
            success:function(data){
                $.each(data, function(index, item) {
                    // Buat ID unik untuk setiap span
                    var spanId = 'jumlahSiswa-' + item.id;

                    // // Set nilai span dengan nilai stock dari data
                    $('#' + spanId).text(item.jumlah_siswa);
            })
            }
        });
    });

    function modalNaikKelas(id)
    {
        var url = "/kelas/" + id + "/previewNaikKelas";

        //Load data from ajax
        $.ajax({
            url:url,
            type:'GET',
            success:function(data){
                $("#formIdKelas").val(data.kelasAwal.id);
                $("#formKelas").val(data.kelasAwal.kelas)
                $("#formJumlahSiswa").val(data.jumlahSiswa + ' Orang')
                $("#formWaliKelas").val(data.kelasAwal.wali)
            },
            error:function(){
                console.log('data count tidak ada')
            }
        });

        $("#modalNaikKelas").modal('show');
    }

    $("#formNaikKelasTujuan").change(function(){

        var id = $(this).val()
        var url = "/kelas/" + id + "/naikKelasTujuan";
        $.ajax({
            url:url,
            type:'GET',
            success:function(data){
                if(data.count != 0){
        
                    $("#infoKelasTujuan").show();//Tampilkan alert notifikasi
                    $("#btnProsesNaikKelas").attr('Disabled', true) //disabled tombol proses

                }else{

                    $("#infoKelasTujuan").hide();//Sembunyikan alert notifikasi
                    $("#btnProsesNaikKelas").attr('Disabled', false) //enable tombol proses
                    
                }
            },
            error:function()
            {
                console.log('data count tidak ada')
            }
        });
    });

    $("#closeNotifNaikKelas").click(function(){
        $("#infoKelasTujuan").hide();//Sembunyikan alert notifikasi
    });

    function prosesNaikKelas()
    {
        var url = "/kelas/naikKelas/process";
        var idKelasAwal = $("#formIdKelas").val();
        var idKelasTujuan = $("#formNaikKelasTujuan").val();

        $.ajax({
            url:url,
            type:'POST',
            cache:false,
            data:{
                asal:idKelasAwal,
                tujuan:idKelasTujuan,
            },
            success:function(response){
                if(response.status == 500){
                    /**Notifikasi */
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: response.message,
                    });

                    $("#infoKelasTujuan").hide();//Sembunyikan alert notifikasi
                    $("#btnProsesNaikKelas").attr('Disabled', false) //enable tombol proses

                }else if(response.status == 200){
                    loadTabel(); //load table siswa
                    $("#modalNaikKelas").modal('hide'); //sembunyikan modal
                    $("#infoKelasTujuan").hide();//Sembunyikan alert notifikasi
                    $("#btnProsesNaikKelas").attr('Disabled', false) //enable tombol proses

                    /**Notifikasi */
                    Swal.fire({
                        icon: 'success',
                        title: 'Congrats...',
                        text: response.message,
                    });
                }
            }
        });
    }
</script>