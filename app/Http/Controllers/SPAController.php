<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SPAController extends Controller
{

    /**
     * SPAController constructor.
     */
    public function __construct()
    {
    }


    public function index(Request $request)
    {
        return view("spa");
    }
}
