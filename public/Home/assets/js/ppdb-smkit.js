$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".register").hide();
});

function register()
{
    $(".register").show();
    $(".login").hide();
}

function login()
{
    $(".register").hide();
    $(".login").show();
}