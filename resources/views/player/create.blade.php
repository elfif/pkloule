@extends('app')

@section('content')

<h1>Nouveau Joueur</h1>

<form action='{{{route('StorePlayer')}}}' method='POST' class='form-horizontal'>
    <div class='form-group'>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for='nom' class='col-sm-2 control-label'> Nom : </label>
        <div class='col-sm-4'>
            <input name="nom" class="form-control" id="inputNom" placeholder="Nom">
        </div>
        <br/><br/>
        
        <div class="col-sm-offset-2 col-sm-4">
          <button type="submit" class="btn btn-warning">Créer !!</button>
        </div>
    </div>
</form>

@endsection



