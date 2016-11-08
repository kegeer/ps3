<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Protocol;

class ProtocolController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());

        $data = $request->all();
        Protocol::create(array_only($data, ['procedure_id', 'name', 'description', 'content']));
        return response()->json([
            'success' => true
        ]);
    }
}
