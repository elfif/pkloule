@extends('app')

@section('content')
<div class="container">
    <div class="row col-xs-12">
        <h1>Liste des joueurs</h1>
        <ul>
            @foreach($players as $player)
            <li>
                <a href="{{{route('ShowPlayer', ['id' => $player->id])}}}">
                    {{{ $player->nom }}}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>



@endsection