<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function apiResponse($result,$code=201){
        return response()->json($result,$code);
    }
}
