<div class="card-body profile-card pt-4 d-flex flex-column align-items-center text-center">
    {{-- <img src="{{asset('storage/photo-users/'.$guru->photo)}}" alt="Profile" class="rounded-circle"> --}}
    <img src="{{$guru->photo}}" alt="Profile" class="rounded-circle">
    <h2>{{$guru->first_name.' '.$guru->last_name}}</h2>
    <h3>{{$guru->kode_level.' '.$guru->nama_level}}</h3>
    <div class="social-links mt-2">
        <h3>{{$guru->nip}}</h3>
        {{-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> --}}
    </div>
</div>