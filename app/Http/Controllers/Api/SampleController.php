<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sample;
use App\Client;

class SampleController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->get('clients'));
        $clients = $request->get('clients');
        // dd($clients);   
        if (!empty($clients)) {
            foreach ($clients as $client) {
                $data = array_only($client, ['source', 'name', 'gender', 'age', 'height', 'weight', 'disease', 'disease_history']);
                if (!empty($data)) {
                    $newClient = Client::create($data);
                    foreach ($client['samples'] as $sample) {
                        $sdata = array_only($sample, ['batch_id', 'ori_num', 'py_num', 'sample_weight', 'sample_time']);
                        Sample::create(array_merge($sdata, ['client_id' => $newClient->id]));
                    }
                    return response()->json([
                        'success' => true
                    ]);
                }
            }
        }

        return abort();

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
