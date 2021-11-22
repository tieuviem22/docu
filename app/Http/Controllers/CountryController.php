<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Country;

class CountryController extends Controller
{
    //
    public function GetCountry() {
        $country = Country::all();
        return response() -> json($country); 
    }

    public function CreateCountry(Request $request) {
        date_default_timezone_set('America/New_York');
        // return $request;
        if(!$request->name_country || !$request->iso_code ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'you need to enter enough information',
                ]
            );
        }
        $country = Country::where('name_country', $request->name_country)->get();

        if(count($country) > 0 ){
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'name_offer already exist',
                ]
            );
        }
          
        $country = Country::where('iso_code', $request->iso_code)->get();

        if(count($country) > 0 ){
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'iso_code already exist',
                ]
            );
        }
          
        $newCountry = new Country;
        $newCountry->fill($request->all());
        $newCountry->save();


        $country = Country::where('name_country', $request->name_country)
        ->where('iso_code', $request->iso_code)
        ->get();

        if(count($country) <= 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Create offer failed',
                ]
            );
        }else {
            return response() -> json(
                [
                    'status' => 200,
                    'message' => 'Create offer success',
                ]
            );
        }

    }


    public function EditCountry(Request $request) {
        date_default_timezone_set('America/New_York');
        
        $country = Country::where('id',$request->id)->get();
        if(count($country) <= 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Not found country',
                ]
            );
        }



        $country[0]->update([
            'iso_code' => $request->iso_code,
            'name_country'=> $request->name_country,
        ]);

        $country = Country::where('iso_code', $request->iso_code)
        ->where('id', $request->id)
        ->where('name_country', $request->name_country)
        ->get();


        if(count($country) <= 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Update failed',
                ]
            );
        }else {
            return response() -> json(
                [
                    'status' => 200,
                    'message' => 'Update success',
                ]
            );
        }
    }

    public function DeleteCountry(Request $request) {
        $country = Country::where('id', $request->id)->get();
        if(count($country) < 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Not found country',
                ]
            );
        }
        $country[0]->delete();
        $country = Country::where('id', $request->id)
        ->get();
        if(count($country) > 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Delete failed',
                ]
            );
        }else {
            return response() -> json(
                [
                    'status' => 200,
                    'message' => 'Delete success',
                ]
            );
        }

    }
}
