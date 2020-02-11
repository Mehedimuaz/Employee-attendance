<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use StdClass;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(Auth::User()->user_type == 'employee'){
            return redirect('/EmployeeHome');
        }
        else if(Auth::User()->user_type == 'supervisor'){
            return redirect('/SupervisorHome');
        }

        else if(Auth::User()->user_type == 'admin'){
            return redirect('/AdminHome');
        }
    }
}
