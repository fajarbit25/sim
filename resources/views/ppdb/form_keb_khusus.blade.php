<label for="anak_ke" class="col-sm-4 col-form-label">Berkebutuhan Khusus<span class="text-danger">*</span></label>
<div class="col-sm-8">
<div class="input-group mb-3">
    <button type="button" class="input-group-text" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="bi bi-plus"></i>
    </button>
    <div class="form-control">
        @foreach($khusus as $khs)
        <button type="button" class="btn btn-secondary btn-sm" onclick="delete_keb_khusus({{$khs->idsn}})" title="Hapus">{{$khs->special_needs}} <i class="bi bi-x-lg"></i></button>
        @endforeach
    </div>
</div>

<div class="form-text text-success fw-bold">
    Kebutuhan khusus yang disandang oleh peserta didik. Dapat dipilih lebih dari satu <br/>
    Klik tombol (+) untuk mengisi.
</div>
</div>


<!-- Modal Form Kebutuhan Khusus -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Kebutuhan Khusus</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-group mb-3">
        <label for="kebutuhan_khusus"> Pilih Jenis Kebutuhan Khusus</label>
        <select name="kebutuhan_khusus" id="kebutuhan_khusus" class="form-control">
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
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="segment" id="segment" value="siswa" required/>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
        <button type="button" class="btn btn-primary" onclick="add_keb_khusus()"><i class="bi bi-plus"></i> Tambahkan</button>
    </div>
    </div>
</div>
</div>
