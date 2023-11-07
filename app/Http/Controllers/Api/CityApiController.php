<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityApiController extends Controller
{
    public function get(Request $request , Country $country){
        return $country->cities;
    }
}
