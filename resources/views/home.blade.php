@extends('app')

@section('content')
<div class="container">
        <a href='{{{ route('NewPlayer') }}}'>Nouveau Joueur</a>
        <br />
        <a href='{{{ route('NewPartie') }}}'>Nouvelle Partie</a>
        
</div>
@endsection
