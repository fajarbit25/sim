$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    financeNotif()
    ppdbNotif()
});

function financeNotif()
{
    var url = "/finance/notif/json";

    $.ajax({
        url:url,
        type:'GET',
        contentType:false,
        processData:false,
        success:function(data){
            if(data.userLevel === '5'){
                if(data.countData !== 0){

                    $("#finance-notif-up").addClass("bi bi-" + data.countData + "-circle-fill text-success")
                    $("#finance-notif-down").addClass("bi bi-" + data.countData + "-circle-fill text-success")
                }
            }
        },
        error(){
            console.log('Data notif error!')
        }
    });
}

function ppdbNotif()
{
    var url = "/ppdb/notif/json";

    $.ajax({
        url:url,
        type:'GET',
        contentType:false,
        processData:false,
        success:function(data){
            if(data.countData !== 0){

                $("#ppdb-notif-up").addClass("bi bi-" + data.countData + "-circle-fill text-success")
                $("#ppdb-notif-down").addClass("bi bi-" + data.countData + "-circle-fill text-success")
            }
        },
        error(){
            console.log('Data notif error!')
        }
    });
}
