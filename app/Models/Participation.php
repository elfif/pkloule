<?php namespace App\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Participation
 *
 * @author pmichel
 */
class Participation extends \Illuminate\Database\Eloquent\Model {
    
    public function player(){
        return $this->belongsTo('App\Models\Player');
    }
    
    public function partie(){
        return $this->belongsTo('App\Models\Partie');
    }
    
    public function setDiff(){
        $this->diff = $this->resultat - $this->cave;
    }
}
