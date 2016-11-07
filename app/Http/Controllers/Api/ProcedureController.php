<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Procedure;

class ProcedureController extends Controller
{

	public function index()
	{
		$procedures = Procedure::all();
		return response()->json([
			'data' => $procedures
		]);
	}
    public function store(Request $request)
    {
        $procedure = Procedure::create($request->all());
		dd($procedure);
        return response()->json([
            'success' => true
        ]);
    }
}
