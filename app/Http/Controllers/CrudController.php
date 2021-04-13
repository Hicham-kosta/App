<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
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

    public function store(Request $request){
        //Validate data before insert to database

        $rules = $this -> getRules();
        $message = $this -> getMessages();


        $validator = Validator::make($request->all(), $rules, $message);

        if($validator -> fails()){

            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        //insert

        Offer::create([
            'name' => $request -> name,
            'price' => $request -> price,
            'details' => $request -> details,
        ]);
        return redirect()->back()->with(['success' => 'Votre offre est ajoutée']);
    }

    protected function getRules(){
        return $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
    }

    protected function getMessages(){

        return  $message = [
            'name.required' => __('messages.offer name required'),
            'name.unique' => __('messages.offer name exist'),
            'price.required' => __('messages.price required'),
            'price.numeric' => __('messages.price must be numeric'),
            'details.required' => __('messages.details required'),
        ];
    }

}
