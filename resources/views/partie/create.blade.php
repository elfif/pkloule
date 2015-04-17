@extends('app')

@section('content')

<h1>Nouvelle partie</h1>

<form action='{{{route('StorePartie')}}}' method='POST'>
    <div  class='form-horizontal'>
        <div class='form-group'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for='created_at' class='col-sm-2 control-label'> Date : </label>
            <div class='col-sm-4'>
                <input name="created_at" class="form-control" id="inputDate" type="date">
            </div>
        </div>
        
        <div class='form-group'>    
            <label for='lieu' class='col-sm-2 control-label'> Lieu : </label>
            <div class='col-sm-4'>
                <input name="lieu" class="form-control" id="inputLieu">
            </div>
            <br/>
        </div>
    </div>
    
    <div id="participants">
        @for ($nb = 0; $nb < 2; $nb++)
            @include('participation._create', ['nb' => $nb])
        @endfor
    </div>
    
    <div class="col-sm-offset-2">
        <div>
            <a id='NewParticipantLink' href="{{{ route('NewParticipation', ['nb' => '2']) }}}" data-remote="true" class='btn btn-success' role='button'>
                Nouveau joueur
            </a>
            <button type="submit" class="btn btn-warning">Valider</button>
        </div>   
    </div>
</form>

@endsection



