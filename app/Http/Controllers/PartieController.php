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
        $participations = $partie->participations;
        $participations->load('player');
        $pCave = $participations->sum('cave')/100;
        $jsonCaves =  $this->jsFormat(view('partie.pieJSON', ['participations' => $participations,
                                                              'pCave' => $pCave, 
                                                              'titre' => 'Caves en %'])->render());
        
        return view('partie.show', ['partie' => $partie, 'jsonCaves' => $jsonCaves]);
        
        //$participations = Participation::where('partie_id', $partie->id)->with('player')->orderBy('diff');
    }
    
    public function showJSON($id){
        $participations = Participation::where('partie_id', $id)->with('player')->orderBy('diff', 'desc')->get();
                      
        $xAxis = [];
        $caveSerie = [];
        $resultSerie = [];
        $diffSerie = [];
        
        foreach($participations as $p){
            $xAxis[] = $p->player->nom;
            $caveSerie[] = intval($p->cave);
            $resultSerie[] = intval($p->resultat);
            $diffSerie[] = intval($p->diff);
        }
        
//        var_dump($xAxis);
//        var_dump($caveSerie);
//        var_dump($diffSerie);
//        dd($resultSerie);
        
        $ar = ['chart' => ['type' => 'column'], 
               'xAxis' => ['categories' => $xAxis],
               'series' => [
                   ['name' => 'différence', 'data' => $diffSerie],
                   ['name' => 'cave', 'data' => $caveSerie],
                   ['name' => 'résultat', 'data' => $resultSerie]
                ] 
              ];
        
        return response()->json($ar);
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
        
        return $this->show($partie->id);
    }
    
    protected function jsFormat($html){
        $ret = json_encode($html);
        return substr($ret,1, -1);
    }
    
}
