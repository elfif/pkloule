<?php namespace App\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Player
 *
 * @author pmichel
 */
class Player extends Model{
    public function participations(){
        return $this->hasMany('App\Models\Participation');
    }
}
