$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#notifDanger").hide();
    $("#notifSuccess").hide();
    $("#btnLoadingTransaksi").hide();
    tableTransksi();
    tipeTransakti();
    formTipe();
});

function tableTransksi()
{
    var url = "/finance/transaction/table";
    $("#tableTransaksi").load(url);
}

function tipeTransakti()
{
    var url = "/finance/transaction/tipe";
    $("#tipeTransakti").load(url);
}

function formTipe()
{
    var url = "/finance/transaction/tipe/form";
    $("#formTipe").load(url);
}

function transaction()
{
    $("#btnLoadingTransaksi").show();
    $("#btnSubmitTransaksi").hide();

    var url = "/finance/transaction";
    var tipe = $("#tipe").val();
    var jenis = $("#jenis").val();
    var status = $("#status").val();
    var keterangan = $("#keterangan").val();

    /**Generate angka nominal */
    let amountAwal = $("#nominal").val();
    amountAwal = amountAwal.replace(/,/g, '');
    var amount = amountAwal;
    

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            tipe:tipe,
            jenis:jenis,
            status:status,
            keterangan:keterangan,
            amount:amount,
        }, success:function(response){
            $("#btnLoadingTransaksi").hide();
            $("#btnSubmitTransaksi").show();
            $("#textSuccess").html(response.success);
            $("#notifSuccess").show();
            $("#formTransaksi")[0].reset();
            tableTransksi();
        }, error:function(){
            $("#btnLoadingTransaksi").hide();
            $("#btnSubmitTransaksi").show();
            $("#textDanger").html('Something Wrong,...');
            $("#notifDanger").show();
            $("#formTransaksi")[0].reset();
            tableTransksi();
        }
    });
}

function tambahType()
{
    var url = "/finance/transaction/tipe";
    var tipe = $("#addTipe").val();

    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            tipe:tipe,
        },success:function(response){
            $("#textSuccess").html(response.success);
            $("#notifSuccess").show();
            tipeTransakti();
            formTipe();

        }, error:function(response){
            $("#notifDanger").show();
            $("#textDanger").html('Something Wrong,...');
            tipeTransakti();
            formTipe();
        }
    });
}

function deteleTipe(id)
{
    var url = "/finance/transaction/tipe/delete";
    $.ajax({
        url:url,
        type:'POST',
        cache:false,
        data:{
            idtt:id,
        }, success:function(response){
            $("#textSuccess").html(response.success);
            $("#notifSuccess").show();
            formTipe();
            tipeTransakti();
        }, error:function(){
            $("#textDanger").html('Something Wrong,...');
            $("#notifDanger").show();
            formTipe();
            tipeTransakti();
        }
    });
}

$(function(){
    $("#nominal").keyup(function(e){
      $(this).val(format($(this).val()));
    });
  });
  var format = function(num){
    var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) {
      parts = str.split(".");
      str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
      if(str[j] != ",") {
        output.push(str[j]);
        if(i%3 == 0 && j < (len - 1)) {
          output.push(",");
        }
        i++;
      }
    }
    formatted = output.reverse().join("");
    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
  };

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




