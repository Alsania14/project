<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_pengajar;
use App\tb_users;
use App\Http\Controllers\LoginController;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {	
    	$tinker = tb_pengajar::all();
        return view('home',compact('tinker'));
    }

}
