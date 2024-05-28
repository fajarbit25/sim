<label for="tipe"> <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-plus-circle"></i></a> Jenis Transaksi <span class="text-danger">*</span></label>
<select name="tipe" id="tipe" class="form-control">
    <optgroup label="Pilih Jenis Transaksi">
        @foreach($tipe as $tip)
        <option value="{{$tip->idtt}}">{{$loop->iteration.'. '.$tip->tipe}}</option>
        @endforeach
    </optgroup>
</select>