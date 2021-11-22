<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Click;
use Carbon\Carbon;

class ClickController extends Controller
{
    //
    public function GetClick($time) {
        $today = Carbon::today('America/New_York')->format('Y-m-d');
        $yesterday = Carbon::yesterday('America/New_York')->format('Y-m-d');
        $sevenDayAgo = Carbon::parse('7 day ago', 'America/New_York')->format('Y-m-d');
        $thisMonth = Carbon::parse('this month', 'America/New_York')->format('Y-m');
        $lastMonth = Carbon::parse('last month', 'America/New_York')->format('Y-m');


        if($time == "today")
        $click = Click::select('clicks.id', 'clicks.ip_address', 'clicks.sub1', 'clicks.time', 'offers.name_offer')
        ->leftJoin('offers','offers.id','=','clicks.offer_id')
        ->where("clicks.time", 'like' ,'%'.$today.'%')
        ->get();
        else if($time == "yesterday")
        $click = Click::select('clicks.id', 'clicks.ip_address', 'clicks.sub1', 'clicks.time', 'offers.name_offer')
        ->leftJoin('offers','offers.id','=','clicks.offer_id')
        ->where("clicks.time", 'like' ,'%'.$yesterday.'%')
        ->get();
        else if($time == "thismonth")
        $click = Click::select('clicks.id', 'clicks.ip_address', 'clicks.sub1', 'clicks.time', 'offers.name_offer')
        ->leftJoin('offers','offers.id','=','clicks.offer_id')
        ->where("clicks.time", 'like' ,'%'.$thisMonth.'%')
        ->get();
        else if($time == "lastmonth")
        $click = Click::select('clicks.id', 'clicks.ip_address', 'clicks.sub1', 'clicks.time', 'offers.name_offer')
        ->leftJoin('offers','offers.id','=','clicks.offer_id')
        ->where("clicks.time", 'like' ,'%'.$lastMonth.'%')
        ->get();
        else if($time == "last7day")
        $click = Click::select('clicks.id', 'clicks.ip_address', 'clicks.sub1', 'clicks.time', 'offers.name_offer')
        ->leftJoin('offers','offers.id','=','clicks.offer_id')
        ->where("clicks.time", '>=' ,$sevenDayAgo)
        ->where("clicks.time", '<=' ,$today)
        ->get();
        return response() -> json($click); 
    }
}
