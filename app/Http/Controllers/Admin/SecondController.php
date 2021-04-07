<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class SecondController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth')->except('second2');

    }

    public function  showString1(){

        return 'show string1';
    }
    public function showString2(){

        return 'show string2';
    }
    public function showString3(){

        return 'show string3';
    }
    public function showString4(){

        return 'show string4';
    }

}
