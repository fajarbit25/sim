@extends('template.layout')
@section('main')
<main id="main" class="main">
    <!-- Table -->
    <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Buat Berita</h5>
            <div class="col-lg-12 mb-3 text-center" id="loadImage"></div>
            <form>

            <div class="mb-3">
                <label for="pesan" class="form-label">Deskripsi</label>
                <!-- Quill Editor Default -->
              <div class="quill-editor-default" id="pesan">{!!$info->pesan!!}</div>
            </div>

            <div class="mb-3 text-end">
                <button type="button" class="btn btn-success" onclick="updateInformasi()"><i class="bi bi-save"> Simpan </i></button>
            </div>

            </form>

          </div>
        </div>
      </div>
      <!-- End Table -->
</main>
<script type="text/javascript">
    $(document).ready(function(){
        console.log('ready');
    });

    // QuillEditor
    var quill = new Quill('#pesan', {
		theme: 'snow'
	});
    quill.on('text-change', function(delta, oldDelta, source) {
        document.querySelector("input[id='pesan']").value = quill.root.innerHTML;
    });
    // End QuillEditor


    function updateInformasi()
    {

        var token = $("meta[name='csrf-token']").attr("content");
        var idnews = $("#pesan").val();
        var url = "{{url('/admin/info/formulir')}}";

        var myEditor = document.querySelector('#pesan')
        var html = myEditor.children[0].innerHTML

        $.ajax({
            url:url,
            type:'POST',
            cache:false,
            data:{
                _token:token,
                pesan:html,
            },success:function(response){
                Swal.fire({
                    icon: 'success',
                    title: 'Congrats...',
                    text: response.success,
                });
            }, error:function(){
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Something wrong, cek koneksi anda!',
                });
            }
        });
    }
</script>

@endsection


