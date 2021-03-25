<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Http\Resources\Lookup\CountryResource;
use App\Models\Country\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(){
        $country = CountryResource::collection(Country::all());
        return response()->json($country);
    }
}
