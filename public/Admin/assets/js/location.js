$(document).ready(function(){
    console.log('ok');
    getProvinsi();
    loadAddress();
});

function loadAddress()
{
    var user_id = $("#user_id").val();
    var url = "/alamat/" + user_id + "/json";
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(response){
            $("#daPro").val(response.provinsi);
            $("#daKab").val(response.kota);
            $("#daKec").val(response.kec);
            $("#daKel").val(response.kel);

        }
    });

}

function getProvinsi()
{
    var url = "http://127.0.0.1:8000/address/provinces";

    //var url = "/api/province";
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(dataProvinsi){
            $("#provinsiList").html("<option>"+ "Pilih Provinsi" +"</option>");
            $.each(dataProvinsi, function (key, value){
                $("#provinsiList").append('<option value="'+ value.id +'">' + value.name +'</option>');
            });
        }
    });
}

$("#provinsi").change(function(){
    var idprov = $("#provinsi").val();
    var urlProvinsi = "http://127.0.0.1:8000/address/"+ idprov +"/province";
    var url = "http://127.0.0.1:8000/address/"+ idprov +"/regencies";
    // var urlProvinsi = "/api/" + idprov + "/province";
    // var url = "/api/" + idprov + "/regencies";
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(dataKabupaten){
            $("#kabupaten").html("<option> Pilih Kabupaten </option>");
            $.each(dataKabupaten, function(key, value){
                $("#kabupaten").append('<option value="'+ value.id +'">' + value.name +'</option>');
            });
        }
    });
    
    // Mengambil data Provinsi
    $.ajax({
        url:urlProvinsi,
        type:'GET',
        dataType:'json',
        success:function(daPro){
            $("#daPro").val(daPro.name);
        }
    });
});

$("#kabupaten").change(function(){
    var idKab = $("#kabupaten").val();
    var urlKabupaten = "http://127.0.0.1:8000/address/"+ idKab +"/regency";
    var url  = "http://127.0.0.1:8000/address/"+ idKab +"/districts";
    // var urlKabupaten = "/api/" + idKab + "/regency";
    // var url = "/api/" + idKab + "/districts";
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(dataKecamatan){
            $("#kecamatan").html("<option selected> Pilih Kecamatan </option>");
            $.each(dataKecamatan, function(key, value){
                $("#kecamatan").append('<option value="'+ value.id +'">' + value.name +'</option>');
            });
        }
    });

    // Megambil data kabupaten
    $.ajax({
        url:urlKabupaten,
        type:'GET',
        dataType:'json',
        success:function(daKab){
            $("#daKab").val(daKab.name);
        }
    });
});

$("#kecamatan").change(function(){
    var idKec = $("#kecamatan").val();
    var urlKecamatan = "http://127.0.0.1:8000/address/"+ idKec +"/district";
    var url  = "http://127.0.0.1:8000/address/"+ idKec +"/villages";
    // var urlKecamatan = "/api/" + idKec + "/district";
    // var url = "/api/" + idKec + "/villages";
    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(dataKelurahan){
            $("#kelurahan").html("<option selected> Pilih Kelurahan </option>");
            $.each(dataKelurahan, function(key, value){
                $("#kelurahan").append('<option value="'+ value.id +'">' + value.name +'</option>');
            });
        }
    });

    // Megambil data kecamatan
    $.ajax({
        url:urlKecamatan,
        type:'GET',
        dataType:'json',
        success:function(daKec){
            $("#daKec").val(daKec.name);
        }
    });
});

$("#kelurahan").change(function(){
    var idKel = $("#kelurahan").val();
    var urlKelurahan = "http://127.0.0.1:8000/address/"+ idKel +"/village";
    // var urlKelurahan = "/api/" + idKel + "/village";

    // Megambil data Kelurahan
    $.ajax({
        url:urlKelurahan,
        type:'GET',
        dataType:'json',
        success:function(daKel){
            $("#daKel").val(daKel.name);
        }
    });
});

