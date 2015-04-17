<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;


/**
 * Description of ParticipationController
 *
 * @author pmichel
 */
class ParticipationController extends Controller {
    
    public function create($nb){
        $html = $this->jsFormat(view('participation._create', ['nb' => $nb])->render());
        //dd($html);
        $newUrl = route('NewParticipation', ['nb' => $nb+1]);
        $js = view('participation.createJs', ['html' => $html, 'url' => $newUrl]);
        $response = Response::make($js, 200);
        $response->header('Content-Type', 'application/javascript');
        return $response;
    }
    
    protected function jsFormat($html){
        $ret = json_encode($html);
        return substr($ret,1, -1);
    }
}
