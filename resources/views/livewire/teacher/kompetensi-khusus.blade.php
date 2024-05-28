<div class="col-sm-12">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <form wire:submit.prevent="updateKompetensiKhusus">
        <input type="hidden" name="kompetensiKhususId" id="kompetensiKhususId" wire:model="user_id">

        <h5 class="my-3 fw-bold">Kompetensi Khusus</h5>

        <div class="row mb-3">
            <label for="punya_lisensi_kepsek" class="col-sm-4 col-form-label">Punya Lisensi Kepala Sekolah? <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                
                <select name="punya_lisensi_kepsek" id="punya_lisensi_kepsek" wire:model="punya_lisensi_kepsek"
                class="form-control @error('punya_lisensi_kepsek') is-invalid @enderror">
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>

                @error('punya_lisensi_kepsek')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="nuks" class="col-sm-4 col-form-label">NUKS </label>
            <div class="col-sm-8">
                <input type="text" name="nuks" id="nuks" wire:model="nuks"
                class="form-control @error('nuks') is-invalid @enderror" />
                @error('nuks')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="keahlian_lab" class="col-sm-4 col-form-label">Keahlian LAB </label>
            <div class="col-sm-8">
                <input type="text" name="keahlian_lab" id="keahlian_lab" wire:model="keahlian_lab"
                class="form-control @error('keahlian_lab') is-invalid @enderror" />
                @error('keahlian_lab')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="menangani_keb_khusus" class="col-sm-4 col-form-label">Mampu Menangani Kebutuhan Khusus <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                
                <select name="menangani_keb_khusus" id="menangani_keb_khusus" wire:model="menangani_keb_khusus"
                class="form-control @error('menangani_keb_khusus') is-invalid @enderror">
                    <option value="">--Pilih--</option>
                    <option value="Tidak">1.Tidak</option>
                    <option value="Netra (A)">2. Netra (A)</option>
                    <option value="Rungu (B)">3. Rungu (B)</option>
                    <option value="Grahita ringan (C)">4. Grahita ringan (C)</option>
                    <option value="Grahita Sedang (C1)">5. Grahita Sedang (C1)</option>
                    <option value="Daksa Ringan (D)">6. Daksa Ringan (D)</option>
                    <option value="Daksa Sedang (D1)">7. Daksa Sedang (D1)</option>
                    <option value="Laras (E)">8. Laras (E)</option>
                    <option value="Wicara (F)">9. Wicara (F)</option>
                    <option value="Tuna ganda (G)">10. Tuna ganda (G)</option>
                    <option value="Hiper aktif (H)">11. Hiper aktif (H)</option>
                    <option value="Cerdas Istimewa (i)">12. Cerdas Istimewa (i)</option>
                    <option value="Bakat Istimewa (J)">13. Bakat Istimewa (J)</option>
                    <option value=" Kesulitan Belajra (K)">14. Kesulitan Belajra (K)</option>
                    <option value="Narkoba (N)">15. Narkoba (N)</option>
                    <option value="Indigo (O)">16. Indigo (O)</option>
                    <option value="Down Sindrome (P)">17. Down Sindrome (P)</option>
                    <option value="Autis (Q)">18. Autis (Q)</option>
                </select>

                @error('menangani_keb_khusus')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="keahlian_braile" class="col-sm-4 col-form-label">Keahlian Braile <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                
                <select name="keahlian_braile" id="keahlian_braile" wire:model="keahlian_braile"
                class="form-control @error('keahlian_braile') is-invalid @enderror">
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>

                @error('keahlian_braile')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="keahlian_bhs_isyarat" class="col-sm-4 col-form-label">Keahlian Bahasa Isyarat <span class="text-danger">*</span> </label>
            <div class="col-sm-8">
                
                <select name="keahlian_bhs_isyarat" id="keahlian_bhs_isyarat" wire:model="keahlian_bhs_isyarat"
                class="form-control @error('keahlian_bhs_isyarat') is-invalid @enderror">
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>

                @error('keahlian_bhs_isyarat')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        
        <div class="mb-3 col-sm-12 text-end">
            <button class="btn btn-primary {{ $isClicked ? 'clicked' : '' }}" id="btnKompetensiKhusus" wire:click="AnimatedButton">
                <span class="spinner-border spinner-border-sm" aria-hidden="true" wire:loading></span> Update
            </button>
        </div>

    </form>

    @if (session()->has('message'))
        <!-- Flash Mesege -->
        
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Congrats...',
                text: "{{ session('message') }}",
            });
        </script>
        <!--/End Flash Mesege -->
    @endif

</div>

