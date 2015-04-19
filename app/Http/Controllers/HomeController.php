<?php namespace App\Http\Controllers;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
        public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
            $participations = \App\Models\Participation::all();
            $players = \App\Models\Player::all();
                  
            foreach($players as $player){
                $c = $participations->where('player_id', $player->id);
                $tabPlayers[] = $player->nom.'('.count($c).')';
                $tabPlayersId[] = $player->id;
                $tabCaves[] = $c->sum('cave');
                $tabResultats[] = $c->sum('resultat');
                $tabDiff[] = $c->sum('diff');
            }
            
            $tabResult = new \Illuminate\Support\Collection();
            for($i=0; $i<count($tabPlayers); $i++){
                $tabResult->push(['player' => $tabPlayers[$i] , 'playerId' => $tabPlayersId[$i], 'cave' => $tabCaves[$i],
                'resultat' => $tabResultats[$i], 'benefice' => $tabDiff[$i]]);
            }
            
            $tabResult->sortByDesc('benefice');
            $ar = ['chart' => ['type' => 'column'], 
               'xAxis' => ['categories' => $tabPlayers],
               'title' => ['text' => 'Résultats d\'ensemble'],
               'series' => [
                   ['name' => 'Bénéfice', 'data' => $tabDiff],
                   ['name' => 'Caves', 'data' => $tabCaves],
                   ['name' => 'Résultat', 'data' => $tabResultats]
                ] 
              ];
            
            $json = json_encode($ar);
            return view('home', ['json' => $json, 'tabResult' => $tabResult]);
	}

}
