<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Result;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::all();
        return response()->json([
            'data' => $results
        ]);
    }

    public function store(Request $request)
    {
        Result::create($requst->all());
        return response()->json([
            'success' => true
        ]);
    }
}
