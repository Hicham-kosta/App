<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(){

    }

    public function getOffers(){

        return Offer::get(); // Ne donne que les $fillable

        //return Offer::select('id', 'name')->get();
    }

    public function store(){

        Offer::create([
            'name' => 'offer2',
            'price' => '400',
            'details' => 'details of offer2',
        ]);
    }

}
