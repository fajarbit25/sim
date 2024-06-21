<div class="card">
    <div class="card-body">
    
        <h5 class="card-title"><span><i class="bi bi-funnel"></i></span> Filter</h5>
                                
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id Transaksi</th>
                        <th>Tanggal</th>
                        <th>Tipe</th>
                        <th>Jenis</th>
                        <th>Saldo Awal</th>
                        <th>Nominal</th>
                        <th>Saldo Akhir</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mutasi as $mts)
                    <tr>
                        <td class="fw-bold">{{$mts->nomor_invoice}}</td>
                        <td>{{$mts->invoice_date}}</td>
                        <td>{{$mts->tipe_transaksi}}</td>
                        <td>{{$mts->jenis_transaksi}}</td>
                        <td>{{number_format($mts->saldo_awal)}}</td>
                        <td>{{number_format($mts->amount)}}</td>
                        <td>{{number_format($mts->saldo_akhir)}}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-xs" 
                            onclick="modalViewMutasi('{{$mts->kode_transaksi}}', '{{$mts->invoice_date}}', '{{$mts->tipe_transaksi}}', '{{$mts->jenis_transaksi}}',
                            '{{$mts->amount}}', '{{$mts->invoice_status}}', '{{$mts->description}}')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </table>
        </div>
    </div>
</div>
