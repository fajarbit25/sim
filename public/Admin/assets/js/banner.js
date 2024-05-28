$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    loadBanner();
    tableBanner();
});

function loadBanner()
{
    var url = "/bannerCarousel";
    $("#carouselExampleIndicators").load(url);
}

function tableBanner()
{
    var url = "/tableBanner";
    $("#table-banner").load(url);
}

function modalupdate()
{
    $("#modalupdate").modal('show');
}

function uploadFoto()
{
    var form = $("#fotoForm")[0];
    var url = "/store_banner";
    var data = new FormData(form);

    $.ajax({
        url:url,
        type:'POST',
        data:data,
        processData:false,
        contentType:false,
        success:function(response){
            loadBanner();
            tableBanner();
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: 'Banner Has changed!',
            });
        }
    });
}

function deleteModal(id)
{
    Swal.fire({
        icon: 'warning',
        title: 'Are You Sure...',
        text: 'To Delete Banner?',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            deletedBanner(id);
            
        }
      })
}

function deletedBanner(id)
{
    var url = "/deleteBanner";
    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            idbanner:id,
        },success:function(response){
            loadBanner();
            tableBanner();
            Swal.fire(
                'Deleted!',
                response.success+'.!',
                'success'
            )
        }
    });
}


