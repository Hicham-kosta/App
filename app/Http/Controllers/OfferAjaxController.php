<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;

class OfferAjaxController extends Controller
{
    use OfferTrait;
    public function create(){
        //view for add offer in DB

        return view('ajax_offers.create');
    }

    public function store(Request $request){

        //save offer in DB using AJAX
       // $file_name = $this -> saveImage($request -> photo, 'images/offers');

        //insert data

        Offer::create([
            //'photo' => $file_name,
            'name_ar' => $request -> name_ar,
            'name_en' => $request -> name_en,
            'price' => $request -> price,
            'details_ar' => $request -> details_ar,
            'details_en' => $request -> details_en
        ]);
    }
}
