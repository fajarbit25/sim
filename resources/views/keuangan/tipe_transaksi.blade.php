@foreach($tipe as $tp)
<div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <span id="textDanger">{{$loop->iteration.'. '.$tp->tipe}}</span>
    <button type="button" onclick="deteleTipe({{$tp->idtt}})" class="btn-close"></button>
</div>
@endforeach