<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\LaravelLocalization;
use App\Traits\OfferTrait;

class CrudController extends Controller
{
  use OfferTrait;
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

        //save photo in folder

        $file_name = $this -> saveImage($request -> photo, 'images/offers');

        //insert data

        Offer::create([
            'photo' => $file_name,
            'name_ar' => $request -> name_ar,
            'name_en' => $request -> name_en,
            'price' => $request -> price,
            'details_ar' => $request -> details_ar,
            'details_en' => $request -> details_en
        ]);
        return redirect()->back()
            ->with(['success' => __('messages.Your Offer is include successfully')]); //Session
        }


    public function getAllOffers(){

        $offers = offer::select('id',
            'price',
            'photo',
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
        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price', 'photo') -> find($offer_id);
        return view('offers.edit', compact('offer'));

        return $offer_id;
   }

   public function updateOffer(Request $request, $offer_id){

        //update data
       //chek if offer exist
       $offer = Offer::find($offer_id);
       if(!$offer)
           return redirect()-> back();
       //update deta
         // $offer->update($request->all());
           //return redirect()->back()->with(['success' => __('messages.update successfully')]);

          $offer->update([
              'name_ar'=> $request->name_ar,
              'name_en'=>$request->name_en,
              'price'=>$request->price,
              'photo'=>$request->photo,
              'details_ar' => $request->details_ar,
              'details_en' => $request->details_en
          ]);
        return redirect()->back()
            ->with(['success' => __('messages.update successfully')]); //Session
   }

   public function deleteOffer($offer_id){

        //check if offer exist
       $offer = Offer::find($offer_id);
       if(!$offer) {
           return redirect()->back()->with(['error' => __('messages.Offer not found')]); //Session
       }

       $offer ->delete();
       return redirect()->route('offers.all')
           ->with(['success'=>__('messages.Offer deleted successfully')]);
   }

   public function getVideo(){

        $video = Video::first();
        event(new VideoViewer($video));
       return view('youtube')->with('video', $video); // la variable video est passée à la page view
   }

}
