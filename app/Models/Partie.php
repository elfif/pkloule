<?php namespace App\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 * Description of Partie
 *
 * @author pmichel
 */
class Partie extends \Illuminate\Database\Eloquent\Model {

    public function participations(){
        return $this->hasMany('App\Models\Participation');
    }
    
    public function getJsonPlayersChart(){
        $participations = Participation::where('partie_id', $this->id)->with('player')->orderBy('diff', 'desc')->get();
                      
        $xAxis = [];
        $caveSerie = [];
        $resultSerie = [];
        $diffSerie = [];
        
        foreach($participations as $p){
            $xAxis[] = view('player._simpleLink', ['player' => $p->player])->render();
            $caveSerie[] = intval($p->cave);
            $resultSerie[] = intval($p->resultat);
            $diffSerie[] = intval($p->diff);
        }
        
        $ar = ['chart' => ['type' => 'column'], 
               'xAxis' => ['categories' => $xAxis, 'labels' => ['useHTML' => true]],
               'title' => ['text' => 'Résultats d\'ensemble'],
               'series' => [
                   ['name' => 'Bénéfice', 'data' => $diffSerie],
                   ['name' => 'cave', 'data' => $caveSerie],
                   ['name' => 'résultat', 'data' => $resultSerie]
                ] 
              ];
        
        return json_encode($ar);
    }
    
    public function getJsonCavesChart(){
        
        $participations = Participation::where('partie_id', $this->id)->with('player')->orderBy('cave', 'desc')->get();
        $percentCave = $participations->sum('cave')/100;
        $serie=[];
                
        foreach($participations as $p){
            $nameUrl = view('player._simpleLink', ['player' => $p->player])->render();
            $serie[] = [$nameUrl.' '.$p->cave.'€' , round($p->cave/$percentCave, 2)];
        }
        
        $ar = ['chart' => ['plotBackgroundColor' => null, 'plotBorderWidth' => null, 'plotShadow' => null],
               'title' => ['text' => 'Répartition des caves ('.$participations->sum('cave').'€)'],
               'series' => [[
                   'type' => 'pie', 
                   'name' => 'Caves',
                   'data' => $serie
                ]]
              ];
        return json_encode($ar);
    }
    
    public function getJsonRésultatsChart(){
        $participations = Participation::where('partie_id', $this->id)
                            ->where('resultat', '>', 0)
                            ->with('player')->orderBy('resultat', 'desc')->get();
        $percentResult = $participations->sum('resultat')/100;
        $serie=[];
                
        foreach($participations as $p){
            $nameUrl = view('player._simpleLink', ['player' => $p->player])->render();
            $serie[] = [$nameUrl.' '.$p->resultat.'€' , round($p->resultat/$percentResult, 2)];
        }
        
        $ar = ['chart' => ['plotBackgroundColor' => null, 'plotBorderWidth' => null, 'plotShadow' => null],
               'title' => ['text' => 'Répartition des gains ('.$participations->sum('resultat').'€)'],
               'series' => [[
                   'type' => 'pie', 
                   'name' => 'Resultat',
                   'data' => $serie
                ]]
              ];
        return json_encode($ar);
    }
}
