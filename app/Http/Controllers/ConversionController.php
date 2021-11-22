<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Conversion;


class ConversionController extends Controller
{
    //
    public function GetConversion() {
        $conversion = Conversion::select('conversions.id', 'conversions.payout', 'conversions.time', 'conversions.click_id', 'offers.name_offer')
        ->leftJoin('offers','offers.id','=','conversions.offer_id')
        ->get();
        return response() -> json($conversion); 
    }
}
