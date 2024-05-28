$('#error-message').hide();

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    console.log('redd');
});

$("#btn-submit").click(function(){
    updateMaster()
});

function updateMaster()
{

    
    $("#btn-submit").attr('Disabled', true);
    $("#btn-submit").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...');

    var form = $("#formMaster")[0];
    var data = new FormData(form);
    var url = "/admin/ppdb/master";

    $.ajax({
        url:url,
        type:'POST',
        data:data,
        contentType:false,
        processData:false,
        success:function(response){
            /**Animasi */
            $("#btn-submit").attr('Disabled', false);
            $("#btn-submit").html('Update');
            /**Notifikasi */
            Swal.fire({
                icon:'success',
                title:'Congrats...',
                text: response.success,
            });

            $('#error-message').hide();
        },
        error: function(xhr, status, error) {
            $('#error-message').show();
            $('#error-message').html('');

            /**Animasi */
            $("#btn-submit").attr('Disabled', false);
            $("#btn-submit").html('Update');

            // Handle error response
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                var errors = xhr.responseJSON.errors;

                // Display validation errors
                $.each(errors, function(key, value) {
                    $('#error-message').append('<p><i class="bi bi-exclamation-circle"></i> ' + value + '</p>');
                });
            } else {
                // Log the entire response for debugging
                console.log(xhr.responseText);
                $('#error-message').html('<p>Error: Unable to process the request.</p>');
            }
        }
    });
}