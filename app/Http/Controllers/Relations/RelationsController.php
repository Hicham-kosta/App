<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation(){

        $user = \App\User::with(['phone' => function($q){
            $q -> select('code', 'phone', 'user_id');
        }])->find(8); // all data

        //$phone = $user -> phone; // data of phone

        return response() -> json($user);
    }
}
