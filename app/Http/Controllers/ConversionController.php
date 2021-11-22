<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Conversion;
use Carbon\Carbon;


class ConversionController extends Controller
{
    //
    public function GetConversion($time) {
        $today = Carbon::today('America/New_York')->format('Y-m-d');
        $yesterday = Carbon::yesterday('America/New_York')->format('Y-m-d');
        $sevenDayAgo = Carbon::parse('7 day ago', 'America/New_York')->format('Y-m-d');
        $thisMonth = Carbon::parse('this month', 'America/New_York')->format('Y-m');
        $lastMonth = Carbon::parse('last month', 'America/New_York')->format('Y-m');



        // $conversion = Conversion::select('conversions.conversion_id', 'conversions.payout', 'conversions.time', 'conversions.click_id', 'offers.name_offer')
        // ->leftJoin('offers','offers.id','=','conversions.offer_id')
        // ->get();



        if($time == "today")
        $conversion = Conversion::select('conversions.conversion_id', 'conversions.payout', 'conversions.time', 'conversions.click_id', 'offers.name_offer')
        ->leftJoin('offers','offers.id','=','conversions.offer_id')
        ->where("conversions.time", 'like' ,'%'.$today.'%')
        ->get();
        else if($time == "yesterday")
        $conversion = Conversion::select('conversions.conversion_id', 'conversions.payout', 'conversions.time', 'conversions.click_id', 'offers.name_offer')
        ->leftJoin('offers','offers.id','=','conversions.offer_id')
        ->where("conversions.time", 'like' ,'%'.$yesterday.'%')
        ->get();
        else if($time == "thismonth")
        $conversion = Conversion::select('conversions.conversion_id', 'conversions.payout', 'conversions.time', 'conversions.click_id', 'offers.name_offer')
        ->leftJoin('offers','offers.id','=','conversions.offer_id')
        ->where("conversions.time", 'like' ,'%'.$thisMonth.'%')
        ->get();
        else if($time == "lastmonth")
        $conversion = Conversion::select('conversions.conversion_id', 'conversions.payout', 'conversions.time', 'conversions.click_id', 'offers.name_offer')
        ->leftJoin('offers','offers.id','=','conversions.offer_id')
        ->where("conversions.time", 'like' ,'%'.$lastMonth.'%')
        ->get();
        else if($time == "last7day")
        $conversion = Conversion::select('conversions.conversion_id', 'conversions.payout', 'conversions.time', 'conversions.click_id', 'offers.name_offer')
        ->leftJoin('offers','offers.id','=','conversions.offer_id')
        ->where("conversions.time", '>=' ,$sevenDayAgo)
        ->get();
        else if($time == "all")
        $conversion = Conversion::select('conversions.conversion_id', 'conversions.payout', 'conversions.time', 'conversions.click_id', 'offers.name_offer')
        ->leftJoin('offers','offers.id','=','conversions.offer_id')
        ->get();

        return response() -> json($conversion); 
    }
}
