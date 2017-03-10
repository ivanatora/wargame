<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\BuildingType;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aOut = [];
        $aBuildingTypes = BuildingType::orderBy('order', 'asc')->get();
        $aOut['building_types'] = $aBuildingTypes;
        
        return view('homepage', $aOut);
    }
}
