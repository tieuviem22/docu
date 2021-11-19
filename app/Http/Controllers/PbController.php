<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Models\Conversion;
use App\Models\Models\Click;

class PbController extends Controller
{
    //
    public function index(Request $request,$click_id, $payout) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        //get offer_id from click table

        $getClickInfo = Click::where("id",$click_id)->get();
        if(count($getClickInfo) !== 0) {
            $offer_id =  $getClickInfo[0]->offer_id;
        }else {
            return response() -> json([
                'message' => "click_id not found table click"
            ]); 
        } 
        
        $result = [
            'click_id' => $click_id,
            'payout' => $payout,
            'offer_id' => $offer_id,
            'ip_address' => $request->ip(),
            'useragent' => $request->header('user-agent'),
            'click_time' => Carbon::now('Asia/Ho_Chi_Minh')
        ];

         //check ip
         if (!filter_var($request->ip(), FILTER_VALIDATE_IP)) {
            return response() -> json([
                'message' => "Not a valid IP address"
            ]);
        } 

        //create conversion_id
        $conversion_id = sha1(md5($result['click_id'] . $result['payout'] . $result['click_time']));
      
        //check click_id    
        $checkClickIdTableConversion = Conversion::where("click_id",$result['click_id'])->get();
        
        if(count($checkClickIdTableConversion) > 0) {
            return response() -> json([
                'message' => "Click_id already exist table converstion"
            ]);
        }
        

        $newConversion = Conversion::create([
            'id' => (string)$conversion_id,
            'offer_id' =>(int)$result['offer_id'],
            'click_id' => $result['click_id'],
            'payout' => $result['payout'],
            'time' => $result['click_time'],
        ]);

        if($newConversion) {
        }else {
            return response() -> json([
                'message' => "save failed a new conversion"
            ]); 
        }

        return response() -> json([
            'status' => 200,
            'message' => "done pbcontroller"
        ]); 


    }
}
