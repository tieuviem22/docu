<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Network;

class NetworkController extends Controller
{
    //
    public function GetNetwork($status) {
        if($status == "disabled")
        $network = Network::where('status', '=', '0')->get();
        else if( $status == "active")
        $network = Network::where('status', '=', '1')->get();
        else 
        $network = Network::all();
        return response() -> json($network); 
    }

    public function CreateNetwork(Request $request) {
        date_default_timezone_set('America/New_York');
        // return $request;
        if(!$request->name_network || !$request->temp_url || !$request->source_id || !$request->status  ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'you need to enter enough information',
                ]
            );
        }
        $network = Network::where('name_network', $request->name_network)->get();

        if(count($network) > 0 ){
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'name_network already exist',
                ]
            );
        }
          
        $newNetwork = new Network;
        $newNetwork->fill($request->all());
        $newNetwork->save();


        $network = Network::where('name_network', $request->name_network)
        ->where('source_id', $request->source_id)
        ->where('temp_url', $request->temp_url)
        ->where('status', $request->status)
        ->get();

        if(count($network) <= 0 ) {
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


    public function EditNetwork(Request $request) {
        
        
        date_default_timezone_set('America/New_York');

        $network = Network::where('id',$request->id)->get();
        if(count($network) <= 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Not found network',
                ]
            );
        }



        $network[0]->update([
            'name_network' => $request->name_network,
            'source_id'=> $request->source_id,
            'temp_url'=> $request->temp_url,
            'status'=> $request->status,
        ]);

        $network = Network::where('name_network', $request->name_network)
        ->where('source_id', $request->source_id)
        ->where('temp_url', $request->temp_url)
        ->where('status', $request->status)
        ->get();


        if(count($network) <= 0 ) {
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

    public function DeleteNetwork(Request $request) {
        $network = Network::where('id', $request->id)->get();
        if(count($network) < 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Not found country',
                ]
            );
        }
        $network[0]->delete();
        $network = Network::where('id', $request->id)
        ->get();
        if(count($network) > 0 ) {
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
