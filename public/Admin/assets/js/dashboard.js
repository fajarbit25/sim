$(document).ready(function(){
  var authLevel = $("#level-status").val();
  if(authLevel == 'PPDB'){
    $("#staticBackdrop").modal('show');
  }

  tableActivity()
});

function tableActivity()
{
  var url = "/dashboard/activity";
  $("#tableActivity").load(url)
}

//pagination function
function paginate(url)
{
    let link = '/dashboard/activity?page=' + url;
    $("#tableActivity").load(link);
}

function modalKelas()
{
  $("#modal-kelas").modal('show')
}

function modalGuru()
{
  $("#modal-guru").modal('show')
}

$("#btn-kelas").click(function(){
  var kelas = $("#kelas").val()
  var url = "/dashboard/" + kelas + "/activity/searchKelas";
  $("#tableActivity").load(url)
  $("#modal-kelas").modal('hide')
});

$("#btn-guru").click(function(){
  var guru = $("#guru").val()
  var url = "/dashboard/" + guru + "/activity/searchGuru";
  $("#tableActivity").load(url)
  $("#modal-guru").modal('hide')
});