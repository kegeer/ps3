<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Batch;
use App\Sample;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::all();
        return response()->json([
            'data' => $batches
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $batch = Batch::create($data);

        return response()->json([
            'success' => true
        ]);
    }
    public function update(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);
        $batch->update($request->all());
        return response()->json([
            'success' => true
        ]);

    }
    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function samples($id)
    {
        $samples = Sample::where('batch_id', $id)->get();
        return response()->json([
            'data' => $samples
        ]);
    }
}
