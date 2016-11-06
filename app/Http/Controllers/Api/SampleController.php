<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sample;

class SampleController extends Controller
{
    public function store(Request $request)
    {
        Sample::create($request->all());
        return response()->json([
            'success' => true
        ]);
    }

    public function update(Request $requst, $id)
    {
        $sample = Sample::findOrFail($id);
        $sample->update($request->all());
        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        $sample = Sample::findOrFail($id);
        $sample->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
