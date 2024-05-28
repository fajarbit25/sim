$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //loadData
    setInterval(loadDataTable, 2000)
});

function loadDataTable()
{
    var url = "/absen/guru/today";
    $("#tableAbsenGuruToday").load(url);
}

/**Pagination */
function paginationPreviousPage(page)
{
    var prevPage = page-1;
    var url = "/absen/guru/report/table?page="+ prevPage;
    $("#tableAbsenGuruToday").load(url);
}
function paginationPage(page)
{
    var url = "/absen/guru/report/table?page="+ page;
    $("#tableAbsenGuruToday").load(url);
}
function paginationNext(page)
{
    var nextPage = page+1;
    var url = "/absen/guru/report/table?page="+ nextPage;
    $("#tableAbsenGuruToday").load(url);
}
/**End Pagination */