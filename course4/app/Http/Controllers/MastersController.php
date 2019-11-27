<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MastersController extends Controller
{
    //
    public function index()
    {
        return view('management.master.index');
    }
}
