<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Http\Requests\OfferRequestUpdate;
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\LaravelLocalization;


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

    /*public function store(){

        Offer::create([
            'name' => 'offer2',
            'price' => '400',
            'details' => 'details of offer2',
        ]);
    }
    */

    public function create(){

        return view('offers.create');
    }

    public function store(OfferRequest $request){
        //Validate data before insert to database

        //$rules = $this -> getRules();
        //$message = $this -> getMessages();

       // $validator = Validator::make($request->all(), $rules, $message);

        //if($validator -> fails()){

            //return redirect()->back()->withErrors($validator)->withInputs($request->all());
        //}
        //insert

        Offer::create([
            'name_ar' => $request -> name_ar,
            'name_en' => $request -> name_en,
            'price' => $request -> price,
            'details_ar' => $request -> details_ar,
            'details_en' => $request -> details_en
        ]);
        return redirect()->back()->with(['success' => __('messages.Your Offer is include successfully')]);
    }

    public function getAllOffers(){

        $offers = offer::select('id',
            'price',
            'name_ar as name',
            'name_en as name',
            'details_ar as details',
            'details_en as details')->get();
            //'name_'.LaravelLocalization::getCurrentLocale().' as name',
            //'details_'.LaravelLocalization::getCurrentLocale().' as details')->get();//return collection

        return view('offers.all', compact('offers'));
    }

   public function editOffer($offer_id){

        //Offer::findOrFail($offer_id); donne la page ou not found

       $offer = Offer::find($offer_id); // search in given table id only
        if(!$offer){
            return redirect()->back();
        }
        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price') -> find($offer_id);
        return view('offers.edit', compact('offer'));

        return $offer_id;
   }

   public function updateOffer(OfferRequest $request, $offer_id){

        //update data
       //chek if offer exist
       $offer = Offer::find($offer_id);
       if(!$offer)
           return redirect()-> back();

       //update deta
       $offer->update($request->all());
           return redirect()->back()->with(['success' => __('messages.update successfully')]);

        /*  $offer->update([
              'name_ar'=> $request->name_ar,
              'name_en'=>$request->name_en,
              'price'=>$request->price,...
          ]);*/
   }

}
