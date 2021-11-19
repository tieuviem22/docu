<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Models\Offer;
use App\Models\Models\Click;
use App\Models\Models\Ipqs;
use App\Models\Models\Conversion;
use App\Models\Models\Country;
use App\Models\Models\Network;
use DateTime;



class GoController extends Controller
{
    //
    public function index(Request $request ,$offerid, $sub1) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
      
        //check ip
        if (!filter_var($request->ip(), FILTER_VALIDATE_IP)) {
            return response() -> json([
                'message' => "Not a valid IP address"
            ]);
        } 

        $result = [
            'offer_id' => $offerid,
            'sub1' => $sub1,
            'ip_address' => $request->ip(),
            'useragent' => $request->header('user-agent'),
            'click_time' => Carbon::now('Asia/Ho_Chi_Minh')

        ];

        // $sourceid = 11;
      


        $date1 = new DateTime($result["click_time"]);


        //check ip đã có truy cập vào offer tương ứng trong vòng 12 tiếng chưa
        $checkClick = Click::where('offer_id', $result['offer_id'])
            ->where('ip_address',$result['ip_address'] )->get();

            if(count($checkClick) > 0) {
                
                foreach($checkClick as $item) {
                    $date2 = new DateTime($item['time']);
                    $interval = $date1->diff($date2);
                    $hourClick = $interval->format('%H');
                    $dayClick = $interval->format('%d');
                    $montClick = $interval->format('%m');
                    $yearClick = $interval->format('%y');
                    if($dayClick == 0 && $montClick == 0 && $yearClick == 0 && $hourClick < 12) {
                        return response() -> json([
                            'message' => "ip accessed the offer within 12 hours"
                        ]); 
                    }
                }
            }
        
        
        //check đã có chuyển đổi đối với offer tương ứng trong vòng 30 ngày chưa
        $checkCoversion = Conversion::where('offer_id', $result['offer_id'])->get();

        if(count($checkClick) > 0) {
            foreach($checkCoversion as $item) {
                $date2 = new DateTime($item['time']);
                $interval = $date1->diff($date2);
                $hourClick = $interval->format('%H');
                $dayClick = $interval->format('%d');
                $montClick = $interval->format('%m');
                $yearClick = $interval->format('%y');
                if($dayClick < 30 && $montClick == 0 && $yearClick == 0) {
                    return response() -> json([
                        'message' => "conversion for the respective offer within 30 days"
                    ]); 
                }
            }
        }
        
        //check offer_id has offer ?

        $checkOfferId = Offer::where('id',$offerid)->get();
        if(count($checkOfferId) == 0 ) {
            return response() -> json([
                'message' => "Not found offer id in table offer"
            ]); 
        }

        //lưu thông tin người dùng vào bảng click
        $clickid = sha1(md5($result['ip_address'] . $result['offer_id'] . $result['sub1'] . $result['click_time']));
        $newClick = Click::create([
            'id' => (string)$clickid,
            'offer_id' => $result['offer_id'],
            'ip_address' => $result['ip_address'],
            'sub1' => $result['sub1'],
            'time' => $result['click_time'],
        ]);
        if($newClick) {
        }else {
            return response() -> json([
                'message' => "save failed"
            ]); 
        }

        //Lấy 1 key trong bảng IPQS
        $key = Ipqs::orderBy('date','desc')
            ->where('error_status','NOT LIKE',"%insufficient%")
            ->where('date', '<' , date('Y-m-d'))
            ->first();
        

        $response = file_get_contents('https://ipqsvx.com/ipq.php');
        $fraud_score =  json_decode($response)->fraud_score;
        $country_code = json_decode($response)->country_code;



        $getCountryCode = Offer::select('countries.iso_code')
        ->leftJoin('countries','offers.country_id','=','countries.id')
        ->where('offers.id', '=' ,1)->get();
        

        $iso_code =  $getCountryCode[0]->iso_code;
        if($fraud_score < 60 )
        {
            return response() -> json([
                'message' => "fraud_score > 60"
            ]); 
        }

        // return $iso_code.$country_code;
        if($iso_code !== $country_code) {
            return response() -> json([
                'message' => "iso_code khong trung nhau"
            ]); 
        }

        //get url offer  & check offer url has sourceid ?
        $getOfferUrl = Offer::where('id', $offerid)->get();
        if(count($getOfferUrl) > 0 ){
            $offerUrl = $getOfferUrl[0]->url;
        }else {
            return response() -> json([
                'message' => "offer url not found"
            ]);
        }
        $urlHasSourceId =  strpos($offerUrl,"sourceid",0) ? strpos($offerUrl,"sourceid",0) : -1;
      

        $getSourceId = Offer::select('networks.source_id')
        ->leftJoin('networks','networks.id','=','offers.network_id')
        ->where('offers.id', '=' ,1)->get();

        if(count($getSourceId) > 0) {
            $sourceid = $getSourceId[0]->source_id;
        }


        if($urlHasSourceId != -1) {
            $sourceid = 11;
            header('Location: https://adswapper.g2afse.com/click?pid='.$clickid.'&offer_id='.$result['offer_id'].'&sub1='.$result['sub1'].'&sub5='.$sourceid.'/');
            exit;
        }




        // return $getSourceId;


        
        
        // return response() -> json($clickid);
    }

}
