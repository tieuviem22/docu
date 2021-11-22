<?php

namespace App\Http\Controllers;
use App\Models\Models\Vps;
use App\Models\Models\Offer;
use App\Models\Models\Country;
use App\Models\Models\Network;

use Illuminate\Http\Request;

class ManageController extends Controller
{
    //
    public function GetOffer() {
        $getOffer = Offer::select('id', 'name_offer')->get();
        return $getOffer;
    }
    public function GetCountry() {
        $getOffer = Country::select('id', 'name_country')->get();
        return $getOffer;
    }
    public function GetNetwork() {
        $getOffer = Network::select('id', 'name_network')->get();
        return $getOffer;
    }


    public function GetVps() {
        $vps = Vps::select('vps.id','vps.vps_name', 'vps.ip_address', 'vps.proxy', 'offers.name_offer', 'vps.offer_id')
        ->leftJoin('offers','offers.id','=','vps.offer_id')
        ->get();
        return response() -> json($vps); 
    }
    public function EditVps(Request $request) {
        date_default_timezone_set('America/New_York');
        
        $vps = Vps::where('id',$request->id)->get();
        if(count($vps) < 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Not found vps',
                ]
            );
        }
        
        $vps[0]->update([
            'ip_address' => $request->ip_address,
            'offer_id'=> $request->offer_id,
            'proxy' => $request->proxy,
            'vps_name' => $request->vps_name
        ]);

        $vps = Vps::where('id', $request->id)
        ->where('ip_address', $request->ip_address)
        ->where('offer_id', $request->offer_id)
        ->where('proxy', $request->proxy)
        ->where('vps_name', $request->vps_name)
        ->get();


        if(count($vps) <= 0 ) {
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
        // return response() -> json($vps);
    }
    public function DeleteVps(Request $request) {
        $vps = Vps::where('id', $request->id)->get();
        if(count($vps) < 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Not found vps',
                ]
            );
        }
        $vps[0]->delete();
        $vps = Vps::where('id', $request->id)
        ->get();
        if(count($vps) > 0 ) {
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
    public function CreateVps(Request $request) {
        date_default_timezone_set('America/New_York');
        if(!$request->offer_id || !$request->vps_name || !$request->proxy || !$request->ip_address) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'you need to enter enough information',
                ]
            );
        }
        $vps = Vps::where('vps_name', $request->vps_name)->get();

        if(count($vps) > 0 ){
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Vps_name already exist',
                ]
            );
        }
          
        $newVps = new Vps;
        $newVps->fill($request->all());
        $newVps->save();


        $vps = Vps::where('ip_address', $request->ip_address)
        ->where('offer_id', $request->offer_id)
        ->where('proxy', $request->proxy)
        ->where('vps_name', $request->vps_name)
        ->get();

        if(count($vps) <= 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Create failed',
                ]
            );
        }else {
            return response() -> json(
                [
                    'status' => 200,
                    'message' => 'Create success',
                ]
            );
        }

    }
}
