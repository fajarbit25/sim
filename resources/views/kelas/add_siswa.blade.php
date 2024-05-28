@extends('template.layout')
@section('main')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>SIMS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/kelas">Kelas</a></li>
          <li class="breadcrumb-item">{{$title}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">

      <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Belum Ada Kelas</h5>
                <div class="table-responsive" id="unalocated"></div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kelas {{$kelas->kode_kelas}}</h5>
                    <div class="table-responsive" id="alocated"></div>
                </div>
            </div>
        </div>
      </div>
      
    </section>
    
  </main><!-- End #main -->
  
  <input type="hidden" id="idkelas" value="{{$kelas->idkelas}}"/>
  <script type="text/javascript">
    $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      //load Table
      loadUnAlocated();
      loadAlocated();
    });

    function loadUnAlocated()
    {
        var url = "/kelas/siswaUnAlocated";
        $("#unalocated").load(url);
    }

    function loadAlocated()
    {
      var idkelas = $("#idkelas").val();
      var url = "/kelas/" + idkelas + "/siswaAlocated";
      $("#alocated").load(url);
    }

    //add to kelas
    function addToKelas(id)
    {
      var url = "/kelas/siswa/add";
      var idkelas = $("#idkelas").val();

      $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
          id:id,
          idkelas:idkelas,
        },success:function(){
          loadUnAlocated();
          loadAlocated();
        },error:function(){
          Swal.fire({
            icon:'warning',
            title:'Oops..',
            text:'Terjadi Kesalahan',
          });
        }
      });
    }

    //return from kelas
    function returnKelas(id)
    {
      var url = "/kelas/siswa/return";

      $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
          id:id,
        },success:function(){
          loadUnAlocated();
          loadAlocated();
        },error:function(){
          Swal.fire({
            icon:'warning',
            title:'Oops..',
            text:'Terjadi Kesalahan',
          });
        }
      });
    }

</script>
@endsection