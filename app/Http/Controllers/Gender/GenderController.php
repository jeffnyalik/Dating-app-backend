<?php

namespace App\Http\Controllers\Gender;

use App\Http\Controllers\Controller;
use App\Models\Gender\Gender;

use App\Http\Resources\Gender\GenderResource;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public function index(){
        $gender = GenderResource::collection(Gender::all());
        return response()->json($gender, 200);
    }
}
