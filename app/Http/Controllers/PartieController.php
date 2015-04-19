<?php namespace App\Http\Controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Request;
use App\Models\Partie;
use App\Models\Participation;

/**
 * Description of PartieController
 *
 * @author pmichel
 */
class PartieController extends Controller {
    
    public function index(){
        
    }
    
    public function create(){
        return view('partie.create');
    }
    
    public function show($id){
        $partie = Partie::find($id);
        return view('partie.show', ['partie' => $partie]);
        
        //$participations = Participation::where('partie_id', $partie->id)->with('player')->orderBy('diff');
    }
        
    public function store(){
        $partie = new Partie();
        $partie->lieu = Request::input('lieu');
        $partie->created_at = Request::input('created_at');
        $partie->save();
        
        $tabPlayers = Request::input('joueur_id');
        $tabCave = Request::input('cave');
        $tabResult = Request::input('resultat');
        
        for($i=0; $i<count($tabPlayers); $i++){
            if ($tabCave[$i]>0){
                $participation = new Participation();
                $participation->partie_id = $partie->id;
                $participation->player_id = $tabPlayers[$i];
                $participation->cave = $tabCave[$i];
                $participation->resultat = $tabResult[$i];
                $participation->setDiff();
                $participation->save();
            }
        }
        return redirect()->route('ShowPartie', ['id' => $partie->id]);
    }
    
    protected function jsFormat($html){
        $ret = json_encode($html);
        return substr($ret,1, -1);
    }
    
}
