$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#btnLoading").hide();
});

function filter()
{
    var jenis = $("#jenis").val();
    var mulai = $("#mulai").val();
    var sampai = $("#sampai").val();

    var url = "/finance/mutasi/filter?jenis=" +  jenis + "&mulai=" + mulai + "&sampai=" + sampai;

    $("#btnSubmit").hide();
    $("#btnLoading").show();

     $("#tableMutasi").load(url);

     $("#btnSubmit").show();
     $("#btnLoading").hide();
}   


function modalViewMutasi(kode, date, tipe, jenis, amount, status, description)
{
    $("#view-kode").text(': ' + kode)
    $("#view-tanggal").text(': ' + date)
    $("#view-tipe").text(': ' + tipe)
    $("#view-jenis").text(': ' + jenis)
    $("#view-status").text(': ' + status)
    $("#view-description").text(': ' + description)

    // Memformat jumlah ke dalam format mata uang Rupiah
    var formattedAmount = formatToRupiah(amount);
    $("#view-nominal").text(': ' + formattedAmount + ',-');

    $("#modal-transaksi").modal('show')
}

// Fungsi untuk memformat angka ke dalam format mata uang Rupiah
function formatToRupiah(amount) {
    // Gunakan metode toLocaleString() dengan style 'currency' dan currency 'IDR'
    return parseFloat(amount).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
}
