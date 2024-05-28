<table class="table">
    <thead>
        <tr>
            <th>Id Transaksi</th>
            <th>Tanggal</th>
            <th>Tipe</th>
            <th>Jenis</th>
            <th class="text-end">Nominal</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mutasi as $mts)
        <tr>
            <td> <a href="/finance/{{$mts->kode_transaksi}}/invoice">#{{$mts->nomor_invoice}}</a> </td>
            <td>{{$mts->invoice_date}}</td>
            <td>{{$mts->jenis_transaksi}}</td>
            <td>{{$mts->tipe}}</td>
            <td class="text-end">{{number_format($mts->amount)}}</td>
            <td>
              @if($mts->invoice_status == 'PAID')<span class="badge bg-success">{{$mts->invoice_status}}</span>@endif
              @if($mts->invoice_status == 'UNPAID')<span class="badge bg-warning">{{$mts->invoice_status}}</span>@endif
              @if($mts->invoice_status == 'PENDING')<span class="badge bg-warning">{{$mts->invoice_status}}</span>@endif
              @if($mts->invoice_status == 'CANCELLED')<span class="badge bg-danger">{{$mts->invoice_status}}</span>@endif
            </td>
            <td>
              {{substr($mts->description, 0, 50)}}...xx
            </td>
            <td>
                <button type="button" class="btn btn-primary btn-xs" 
                onclick="modalViewMutasi('{{$mts->kode_transaksi}}', '{{$mts->invoice_date}}', '{{$mts->tipe}}', '{{$mts->jenis_transaksi}}',
                '{{$mts->amount}}', '{{$mts->invoice_status}}', '{{$mts->description}}')">
                    <i class="bi bi-eye"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>