<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Offer;

class OfferController extends Controller
{
    //
    public function GetOffer($status) {
        if($status == "active") {
            $offer = Offer::select('offers.id','offers.name_offer', 'networks.name_network', 'offers.url', 'countries.name_country','offers.country_id','offers.network_id', 'offers.status')
            ->leftJoin('networks','networks.id','=','offers.network_id')
            ->leftJoin('countries','countries.id','=','offers.country_id')
            ->where('offers.status', '=', '1')
            ->get();
        }
        else if($status == "disabled") {
            $offer = Offer::select('offers.id','offers.name_offer', 'networks.name_network', 'offers.url', 'countries.name_country','offers.country_id','offers.network_id', 'offers.status')
            ->leftJoin('networks','networks.id','=','offers.network_id')
            ->leftJoin('countries','countries.id','=','offers.country_id')
            ->where('offers.status', '=', '0')
            ->get();
        }
        else {
            $offer = Offer::select('offers.id','offers.name_offer', 'networks.name_network', 'offers.url', 'countries.name_country','offers.country_id','offers.network_id', 'offers.status')
            ->leftJoin('networks','networks.id','=','offers.network_id')
            ->leftJoin('countries','countries.id','=','offers.country_id')
            ->get();
        }
        return response() -> json($offer); 
    }
    // public function GetOfferActive() {
    //     $offer = Offer::select('offers.id','offers.name_offer', 'networks.name_network', 'offers.url', 'countries.name_country','offers.country_id','offers.network_id', 'offers.status')
    //     ->leftJoin('networks','networks.id','=','offers.network_id')
    //     ->leftJoin('countries','countries.id','=','offers.country_id')
    //     ->where('offers.status', '=', '1')
    //     ->get();
    //     return response() -> json($offer); 
    // }
    // public function GetOfferDisabled() {
    //     $offer = Offer::select('offers.id','offers.name_offer', 'networks.name_network', 'offers.url', 'countries.name_country','offers.country_id','offers.network_id', 'offers.status')
    //     ->leftJoin('networks','networks.id','=','offers.network_id')
    //     ->leftJoin('countries','countries.id','=','offers.country_id')
    //     ->where('offers.status', '=', '0')
    //     ->get();
    //     return response() -> json($offer); 
    // }

    public function CreateOffer(Request $request) {
        date_default_timezone_set('America/New_York');
        // return $request;
        if(!$request->name_offer || !$request->network_id || !$request->url || !$request->country_id || $request->status == -1) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'you need to enter enough information',
                ]
            );
        }
        $offer = Offer::where('name_offer', $request->name_offer)->get();

        if(count($offer) > 0 ){
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'name_offer already exist',
                ]
            );
        }
          
        $newOffer = new Offer;
        $newOffer->fill($request->all());
        $newOffer->save();


        $offer = Offer::where('name_offer', $request->name_offer)
        ->where('network_id', $request->network_id)
        ->where('url', $request->url)
        ->where('country_id', $request->country_id)
        ->where('status', $request->status)
        ->get();

        if(count($offer) <= 0 ) {
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


    public function EditOffer(Request $request) {
        
        $offer = Offer::where('id',$request->id)->get();
        if(count($offer) <= 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Not found offer',
                ]
            );
        }
        $offer[0]->update([
            'name_offer' => $request->name_offer,
            'network_id'=> $request->network_id,
            'url' => $request->url,
            'country_id' => $request->country_id,
            'status' => $request->status
        ]);

        $offer = Offer::where('name_offer', $request->name_offer)
        ->where('id', $request->id)
        ->where('network_id', $request->network_id)
        ->where('url', $request->url)
        ->where('country_id', $request->country_id)
        ->where('status', $request->status)
        ->get();


        if(count($offer) <= 0 ) {
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

    public function DeleteOffer(Request $request) {
        $offer = Offer::where('id', $request->id)->get();
        if(count($offer) < 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Not found offer',
                ]
            );
        }
        $offer[0]->delete();
        $offer = Offer::where('id', $request->id)
        ->get();
        if(count($offer) > 0 ) {
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
