<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use LaravelLocalization;


class OfferController extends Controller
{

    use OfferTrait;

    public function create()
    {
        //view form to add this offer
        return view('ajax_offers.create');
    }

    public function store(Request $request)
    {
        //save offer into DB using AJAX

        $file_name = $this->saveImage($request->photo, 'images/offers');
        //insert  table offers in database
         $offer = Offer::create([
            'photo' => $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,

        ]);
         if($offer) {
             return response()->json([
                 'status' => true,
                 'msg' => 'Offer include successfully',
             ]);
         }else
         {
             return response()->json([
                 'status' => false,
                 'msg' => 'Error try again',
             ]);
         }

    }

    public function all(){

             $offers = offer::select('id',
                'price',
                'photo',
                'name_ar as name',
                'name_en as name',
                'details_ar as details',
                'details_en as details')->get();
            //'name_'.LaravelLocalization::getCurrentLocale().' as name',
            //'details_'.LaravelLocalization::getCurrentLocale().' as details')->get();//return collection

            return view('ajax_offers.all', compact('offers')); //'offers' = $offers

    }

    public function delete(Request $request){

        $offer = Offer::find($request -> id);
        if(!$offer) {
            return response()->json([
                'status' => false,
                'msg' => 'Error try again',

            ]);
        }
        $offer ->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Offer deleted successfully',
            'id' => $request -> id,
        ]);
    }

    public function edit(Request $request){

        //Offer::findOrFail($offer_id); donne la page ou not found

        $offer = Offer::find($request -> offer_id); // search in given table id only
        if(!$offer){
            return response()->json([
                'status' => false,
                'msg' => 'Error try again',
                ]);
        }
        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price', 'photo')
            -> find($request -> offer_id);
        return view('ajax_offers.edit', compact('offer'));

        return $offer_id;
    }

    public function update(Request $request){

        //update data
        //chek if offer exist
        $offer = Offer::find($request -> offer_id);
        if(!$offer) {
            return response()->json([
                'status' => false,
                'msg' => 'Error try again',
            ]);
        }
        //update data
         $offer->update($request->all());

        return response()->json([
            'status' => true,
            'msg' => 'Offer update successfully',
        ]);
    }
}
