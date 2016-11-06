<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BatchController extends Controller
{
    public function index()
    {
        return view('batches.index');
    }

    public function samples($id)
    {
        return view('batches.samples.index', compact('id'));
    }
}
