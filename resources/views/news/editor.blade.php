@extends('template.layout')
@section('main')
<main id="main" class="main">
    <!-- Table -->
    <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Buat Berita</h5>
            <div class="col-lg-12 mb-3 text-center" id="loadImage"></div>
            <form method="" action="" enctype="multipart/form-data" id="photoForm">
                @csrf
            <div class="mb-3">
                <label for="photo" class="form-label">Gambar</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="photo"  id="photo" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <button class="btn btn-outline-secondary" onclick="uploadImage()" type="button" id="inputGroupFileAddon04">Upload</button>
                </div>
            </div>
            </form>
            <form>
            <input type="hidden" id="idnews" name="idnews"/>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="berita" class="form-label">Deskripsi</label>
                {{-- <textarea class="form-control" name="berita" id="berita" rows="6"></textarea> --}}
                <!-- Quill Editor Default -->
              <div class="quill-editor-default" id="berita">{!!$news->berita!!}</div>
            </div>

            <div class="mb-3 text-end">
                <a href="/berita" class="btn btn-warning"><i class="bi bi-arrow-left"></i> Kembali</i></a>
                <button type="button" class="btn btn-success" onclick="saveNews()"><i class="bi bi-save"> Save Draft</i></button>
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
        loadValue();
        loadImage();
    });

    // QuillEditor
    var quill = new Quill('#berita', {
		theme: 'snow'
	});
    quill.on('text-change', function(delta, oldDelta, source) {
        document.querySelector("input[id='berita']").value = quill.root.innerHTML;
    });
    // End QuillEditor

    function loadValue()
    {
        var url = "{{url('/news/loadValue')}}";
        $.ajax({
            url:url,
            type:'GET',
            dataType:'JSON',
            success: function(response){
                $("#judul").val(response.judul);
                $("#berita").val(response.berita);
                $("#idnews").val(response.idnews);
                $("#idnews-posting").val(response.idnews);
            }
        });
    }

    function saveNews()
    {

        var token = $("meta[name='csrf-token']").attr("content");
        var judul = $("#judul").val();
        var idnews = $("#idnews").val();
        var idnewsPosting = $("#idnews-posting").val();
        var url = "{{url('/news')}}";

        var myEditor = document.querySelector('#berita')
        var html = myEditor.children[0].innerHTML

        $.ajax({
            url:url,
            type:'POST',
            cache:false,
            data:{
                _token:token,
                judul:judul,
                berita:html,
                idnews:idnews,
            },success:function(response){
                loadValue();

                Swal.fire({
                    icon: 'success',
                    title: 'Congrats...',
                    text: 'News Has been Saved!',
                });
            }
        });
    }

    function loadImage()
    {
        var url = "{{('/news/loadImage')}}";
        $("#loadImage").load(url);
    }

    function uploadImage()
    {
        var form = $("#photoForm")[0];
        var url = "{{url('/news/uploadImageNew')}}";
        var data = new FormData(form);
        $.ajax({
            url:url,
            type:'POST',
            data:data,
            processData:false,
            contentType:false,
            success:function(response){
                loadValue();
                loadImage();
                Swal.fire({
                    icon: 'success',
                    title: 'Congrats...',
                    text: 'Image Has changed!',
                });

            }
        });
    }
</script>

@endsection


