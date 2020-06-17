<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    //
    public function getIndex(){
    	return view('admin.dashboard.index');
    }
}
