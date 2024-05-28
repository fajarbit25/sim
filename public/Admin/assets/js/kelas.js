$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    loadTabel();
});

function loadTabel()
{
    var url = "/kelas/load_tabel";
    $("#tabelKelas").load(url);
    $("#closeModal").click();
}

function saveKelas()
{
    var url = "/kelas";
    var kelas = $("#kelas").val();
    var wali = $("#wali").val();
    var tingkat = $("#tingkat").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        dataType:'json',
        data:{
            kelas:kelas,
            wali:wali,
            tingkat:tingkat,
        }, success:function(response){
            console.log(response.success);
            loadTabel();

        }
    });
}

function edit(id)
{
   var url = "/kelas/" + id + "/edit";
   $.ajax({
        url:url,
        type: 'GET',
        cache:false,
        dataType:'json',
        success:function(data){
            $("#kelasEdit").val(data.kode_kelas);
            $("#waliOld").val(data.first_name);
            $("#idkelas").val(data.idkelas);
            $("#tingkatEdit").val(data.tingkat);

            //open modal
            $('#modalEdit').modal('show');
            console.log(data.first_name);
        }
   });
}

function update()
{
    var url = "/kelas/update";
    var kelasEdit = $("#kelasEdit").val();
    var waliEdit = $("#waliNew").val();
    var idkelas = $("#idkelas").val();
    var tingkat = $("#tingkatEdit").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            kelasEdit:kelasEdit,
            waliEdit:waliEdit,
            idkelas:idkelas,
            tingkat:tingkat,
        }, success:function(response){
            console.log('updated'); 
            $("#modalEdit").modal('hide');
            loadTabel();
        }
    });
}

//pagination function
function paginate(url)
{
    let link = '/kelas/load_tabel?page=' + url;
    $("#tabelKelas").load(link);
}

//search function
function search()
{   
    let key = $("#key").val();
    key=key.replace(/ /g,"_");
    if(key==0){
        loadTabel();
    }else{
        url = "/kelas/" +  key + "/search";
        $("#tabelKelas").load(url);
    } 
    //console.log(key);
}

