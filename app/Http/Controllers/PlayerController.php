<?php namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Participation;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PlayerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $players = Player::all();
            return view('player.index', ['players' => $players]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return view('player.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
            $player = new Player();
            $player->nom = $request->input('nom');
            $player->save();
            
            return redirect('home');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $player = Player::find($id);
            $participations = Participation::where('player_id', $player->id)->with('partie')->orderBy('created_at')->get();
            
            return view('player.show', ['player' => $player, 'participations' => $participations]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
