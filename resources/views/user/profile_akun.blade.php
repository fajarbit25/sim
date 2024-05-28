<div class="row mb-3">
    <label for="first_name" class="col-sm-4 col-form-label"><i class="bi bi-check-all"></i> Nama Lengkap<span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{$user->first_name}}" autocomplete="off" required>
      @error('first_name')<div class="form-text">{{$message}}</div>@enderror
    </div>
</div>
<div class="row mb-3">
    <label for="email" class="col-sm-4 col-form-label"><i class="bi bi-check-all"></i> Email<span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$user->email}}" autocomplete="off" required>
    </div>
    @error('email')<div class="form-text">{{$message}}</div>@enderror
</div>
<div class="row mb-3">
    <label for="phone" class="col-sm-4 col-form-label"><i class="bi bi-check-all"></i> Nomor HP<span class="text-danger">*</span></label>
    <div class="col-sm-8">
      <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="phone" value="{{$user->phone}}" autocomplete="off" required>
    </div>
    @error('phone')<div class="form-text">{{$message}}</div>@enderror
</div>
