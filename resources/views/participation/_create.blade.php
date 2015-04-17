<div class="form-inline">
    <div class="col-sm-offset-2">
        <div class="form-group">
            <select name='{{{'joueur_id['.$nb.']'}}}' class='form-control'>
                @foreach(App\Models\Player::all() as $player)
                <option value='{{{ $player->id }}}'>{{{$player->nom}}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input name='{{{'cave['.$nb.']'}}}' id='{{{'cave'.$nb}}}' class='form-control' placeholder='cave' type="number">
        </div>

        <div class="form-group">
            <input name='{{{'resultat['.$nb.']'}}}' id='{{{'resultat'.$nb}}}' class='form-control' placeholder='résultat' type="number">
        </div>
        <div class="form-group">
            <h4 id='{{{'diff'.$nb}}}'><span  class="label label-default">0</span></h4>
        </div>
    </div>
</div>