<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function showAdminName()
    {

        return 'Hicham El Kostali';
    }

    public function getIndex()
    {
        $data = [];

        $data['name'] = 'El Kostali Hicham';
        $data['age'] = 52;

       /* $obj = new \stdClass();

        $obj->gender = 'male';
        $obj->profession = 'developer';*/

        $_data = [];
        return view('welcome', $data /*compact('obj')*/, compact('_data'));
    }

    public function getLanding(){

        return view('landing');
    }
}
