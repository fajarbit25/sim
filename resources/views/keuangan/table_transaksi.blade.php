<table class="table">
    <thead>
        <tr>
            <th>Id Transaksi</th>
            <th>Tanggal</th>
            <th>Tipe</th>
            <th>Jenis</th>
            <th class="text-end">Nominal</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mutasi as $mts)
        <tr>
            <td> <a href="/finance/{{$mts->kode_transaksi}}/invoice">#{{$mts->nomor_invoice}}</a> </td>
            <td>{{$mts->invoice_date}}</td>
            <td>{{$mts->tipe_transaksi}}</td>
            <td>{{$mts->jenis_transaksi}}</td>
            <td class="text-end">{{number_format($mts->amount)}}</td>
            <td>
              @if($mts->invoice_status == 'Paid')<span class="badge bg-success">{{$mts->invoice_status}}</span>@endif
              @if($mts->invoice_status == 'Unpaid')<span class="badge bg-warning">{{$mts->invoice_status}}</span>@endif
              @if($mts->invoice_status == 'Pending')<span class="badge bg-warning">{{$mts->invoice_status}}</span>@endif
              @if($mts->invoice_status == 'Cancelled')<span class="badge bg-danger">{{$mts->invoice_status}}</span>@endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>