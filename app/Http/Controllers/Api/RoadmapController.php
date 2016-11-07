<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roadmap;
use App\Pipeline;

class RoadmapController extends Controller
{
    public function index()
    {
    	$roadmaps = Roadmap::with('pipelines')->get();
    	return response()->json([
    		'data' => $roadmaps
		]);
    }

     public function store(Request $request)
    {
        $data = $request->only(['name', 'description']);
        $roadmap = Roadmap::create($data);

        $pipelines = $request->get('pipelines');
        foreach ($pipelines as $pipeline) {
        	$pdata = [];
            $pdata['step'] = $pipeline['step'];
        	$pdata['roadmap_id'] = $roadmap->id;
        	$pdata['procedure_id'] = $pipeline['procedure_id'];
        	$pdata['protocol_id'] = $pipeline['protocol_id'];
        	$pdata['time'] = $pipeline['time'];
        	Pipeline::create($pdata);
        }

        return response()->json([
            'success' => true
        ]);
    }
    public function update(Request $request, $id)
    {
        $roadmap = Roadmap::findOrFail($id);
        $roadmap->update($request->only(['name', 'description']));
        $roadmap->pipelines()->delete();
        $pipelines = $request->get('pipelines');
        // $roadmap->updateOrCreate($pipelines);
        // dd($pipelines);
        foreach ($pipelines as $pipeline) {
            Pipeline::create(array_merge($pipeline, ['roadmap_id' => $roadmap->id]));
        }
        return response()->json([
            'success' => true
        ]);

    }
    public function destroy($id)
    {
        $roadmap = Roadmap::findOrFail($id);
        $roadmap->pipelines()->delete();
        $roadmap->delete();
        return response()->json([
            'success' => true
        ]);
    }

}
