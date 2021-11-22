<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Ipqs;

class IpqsController extends Controller
{
    //

    public function GetIpqs() {
        $ipqs = Ipqs::all();
        return response() -> json($ipqs); 
    }

    public function CreateIpqs(Request $request) {
        date_default_timezone_set('America/New_York');
        // return $request;
        if(!$request->api_key || !$request->date || !$request->error_status ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'you need to enter enough information',
                ]
            );
        }
        $ipqs = Ipqs::where('api_key', $request->api_key)->get();

        if(count($ipqs) > 0 ){
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'api_key already exist',
                ]
            );
        }
          
          
        $newIpqs = new Ipqs;
        $newIpqs->fill($request->all());
        $newIpqs->save();


        $ipqs = Ipqs::where('api_key', $request->api_key)
        ->where('error_status', $request->error_status)
        ->where('date', $request->date)
        ->get();

        if(count($ipqs) <= 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Create ipqs failed',
                ]
            );
        }else {
            return response() -> json(
                [
                    'status' => 200,
                    'message' => 'Create ipqs success',
                ]
            );
        }

    }


    public function EditIpqs(Request $request) {
        
        $ipqs = Ipqs::where('id',$request->id)->get();
        if(count($ipqs) <= 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Not found country',
                ]
            );
        }



        $ipqs[0]->update([
            'api_key' => $request->api_key,
            'error_status'=> $request->error_status,
            'date'=> $request->date,
        ]);

        $ipqs = Ipqs::where('api_key', $request->api_key)
        ->where('id', $request->id)
        ->where('error_status', $request->error_status)
        ->where('date', $request->date)
        ->get();


        if(count($ipqs) <= 0 ) {
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

    public function DeleteIpqs(Request $request) {
        $ipqs = Ipqs::where('id', $request->id)->get();
        if(count($ipqs) < 0 ) {
            return response() -> json(
                [
                    'status' => 404,
                    'message' => 'Not found country',
                ]
            );
        }
        $ipqs[0]->delete();
        $ipqs = Ipqs::where('id', $request->id)
        ->get();
        if(count($ipqs) > 0 ) {
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
