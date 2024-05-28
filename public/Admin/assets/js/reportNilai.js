$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$("#btn-kelas").click(function(){
    $("#modalkelas").modal('show');
});

$("#btn-cari-kelas").click(function(){
    $("#btn-cari-kelas").attr('Disabled', true)
    $("#btn-cari-kelas").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var ta = $("#ta").val();
    var semester = $("#semester").val();
    var mapel = $("#mapel").val();
    var kelas = $("#kelas").val();

    var url = "/report_nilai/" + ta + "/" + semester + "/" + mapel + "/" + kelas;
    $("#table-report").load(url)
    console.log(url)
    /**Close */
    $("#btn-cari-kelas").attr('Disabled', false)
    $("#btn-cari-kelas").html('Cari')
    $("#modalkelas").modal('hide');
});

$("#btn-siswa").click(function(){
        $("#modalSiswa").modal('show');
});

$("#ssemester").change(function () {
    var ta = $("#sta").val();
    var semester = $("#ssemester").val()
    var url = "/nilai/" + ta + "/" + semester + "/json";

    // Membersihkan opsi sebelum menambahkan yang baru
    $("#skelas").empty();

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $("#skelas").append('<option value="0">--Pilih Kelas--</option>');
            for (var i = 0; i < data.length; i++) {
                $("#skelas").append('<option value="' + data[i].kelas + '">Kelas ' + data[i].kode_kelas + '</option>');
            }
        },
        error: function (error) {
            console.log('Error fetching classes:', error);
        }
    });
});

$("#sta").change(function () {
    var ta = $("#sta").val();
    var semester = $("#ssemester").val()
    var url = "/nilai/" + ta + "/" + semester + "/json";

    // Membersihkan opsi sebelum menambahkan yang baru
    $("#skelas").empty();

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $("#skelas").append('<option value="0">--Pilih Kelas--</option>');
            for (var i = 0; i < data.length; i++) {
                $("#skelas").append('<option value="' + data[i].kelas + '">Kelas ' + data[i].kode_kelas + '</option>');
            }
        },
        error: function (error) {
            console.log('Error fetching classes:', error);
        }
    });
});

$("#skelas").change(function(){
    var ta = $("#sta").val();
    var semester = $("#ssemester").val();
    var kelas = $("#skelas").val();
    var url = "/nilai/" + ta + "/" + semester + "/" + kelas + "/json";
    
    // Membersihkan opsi sebelum menambahkan yang baru
    $("#ssiswa").empty();

    $.ajax({
        url:url,
        type:'GET',
        dataType:'json',
        success:function(data){
            for (var i = 0; i < data.length; i++) {
                $("#ssiswa").append('<option value="' + data[i].id + '">' + data[i].nisn + ' - ' + data[i].name + '</option>');
            }
        },error:function(error){
            console.log('Error fetching classes:', error);
        }
    });
});

$("#btn-cari-siswa").click(function(){
    $("#btn-cari-siswa").attr('Disabled', true)
    $("#btn-cari-siswa").html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...')

    var ta = $("#sta").val();
    var semester = $("#ssemester").val();
    var kelas = $("#skelas").val();
    var siswa = $("#ssiswa").val();

    var url = "/nilai/" + ta + "/" + semester + "/" + kelas + "/" + siswa;
    $("#table-report").load(url);

    $("#btn-cari-siswa").attr('Disabled', false)
    $("#btn-cari-siswa").html('Cari');
    $("#modalSiswa").modal('hide');

});
