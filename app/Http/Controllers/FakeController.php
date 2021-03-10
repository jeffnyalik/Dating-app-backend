<?php

namespace App\Http\Controllers;

use App\FakeModel;
use Illuminate\Http\Request;

class FakeController extends Controller
{
    public function index()
    {
        $res = FakeModel::all();
        return response()->json($res, 200);
    }
}
