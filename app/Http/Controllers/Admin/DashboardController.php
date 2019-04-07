<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
     //Dasboard
	public function dashboard(){
		return view('admin.dasboard');
	}
}
