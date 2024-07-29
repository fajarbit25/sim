<div class="col-sm-12">
    <div class="row">
        <!--  Card -->
        <div class="col-xxl-12 col-md-12">
            <div class="card info-card sales-card">

              <div class="card-body mt-3">

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-exclamation-circle-fill fs-2 text-warning"></i>
                  </div>
                  <div class="ps-3">
                    <h6 class="fs-1 fw-bold text-warning">{{$dataKonseling->sum('point')}}/100</h6>
                    <span class="text-success small pt-1 fw-bold">Point Pelannggaran Siswa</span> 
                  </div>
                </div>
              </div>

            </div>
        </div><!-- End  Card -->

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Data Pelanggaran Siswa</h3>
                    
                    <div class="list-group">
                        @if($dataKonseling)
                        @foreach($dataKonseling as $items)
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action" wire:click="mainModal({{$items->id}})">
                          <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                <span class="text-success fw-bold">Poin :</span>
                                <span class="text-danger fw-bold">{{$items->point}}</span>
                            </h5>
                            <small class="text-body-secondary">{{substr($items->tanggal, 0, 10)}}</small>
                          </div>
                          <p class="mb-1">{{$items->pelanggaran}}.</p>
                          <small class="text-body-secondary fst-italic">{{$items->ket}}.</small>
                        </a>
                        @endforeach
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="mainModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="mainModalLabel">Detail Pelanggaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($detailKonseling)
                    <div class="col-12">
                        <img src="{{asset('storage/konseling/'.$detailKonseling->foto)}}" alt="..." style="max-width: 100%;">
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <span class="col-4 fw-bold">Point</span>
                                <span class="col-8 fw-bold text-danger">: {{$detailKonseling->point}}</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <span class="col-4 fw-bold">Pelanggaran</span>
                                <span class="col-8">: {{$detailKonseling->pelanggaran}}</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <span class="col-4 fw-bold">Tanggal & Waktu</span>
                                <span class="col-8">: {{$detailKonseling->tanggal}}</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <span class="col-4 fw-bold">Keterangan</span>
                                <span class="col-8">: {{$detailKonseling->ket}}</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <span class="col-4 fw-bold">Dibuat Oleh</span>
                                <span class="col-8">: {{$guru}}</span>
                            </div>
                        </li>
                      </ul>
                      @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('mainModal', function () {
                $('#mainModal').modal('show')
            }); //membuka modal


            Livewire.on('closeModal', function () {
                $('#mainModal').modal('hide')
            }); //menutup modal

            Livewire.on('showAlert', function (data) {
                if(data.type === 200){
                    var icons = 'success'
                }else if(data.type === 500){
                    var icons = 'warning'
                }
                Swal.fire({
                    icon: icons,
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    </script>
    @endpush

</div>
