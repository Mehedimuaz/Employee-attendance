<?php
/**
 * Created by PhpStorm.
 * User: mmuaz
 * Date: 5/21/17
 * Time: 2:10 AM
 */

namespace App\Http\Controllers;

use App\request_present;
use App\User;

class HandleRequestController extends Controller{
    public function accept_attendance_request(){
        $next_day = date('Y-m-d',strtotime('+1 day'));
        $attendance = request_present::where('request_date', $next_day)->first();
        $attendance->accepted = 1;
        $attendance->save();
        return redirect()->back();
    }

    public function cancel_attendance_request(){
        $next_day = date('Y-m-d',strtotime('+1 day'));
        $attendance = request_present::where('request_date', $next_day)->first();
        $attendance->accepted = -1;
        $attendance->save();
        return redirect()->back();
    }

    public function handle_absence_request(){

    }

    public function make_attendance(){
        $today = date('Y-m-d');
        $admin = User::where('id', 2)->select('salary')->first();
        $attendance = request_present::where('request_date', $today)->first();
        $attendance->confirm_present = 1;
        $attendance->salary = $admin->salary;
        $attendance->save();
        return redirect()->back();
    }

    public function make_absence(){
        $today = date('Y-m-d');
        $attendance = request_present::where('request_date', $today)->first();
        $attendance->confirm_present = -1;
        $attendance->save();
        return redirect()->back();
    }

    public function revert_request(){
        $next_day = date('Y-m-d',strtotime('+1 day'));
        $attendance = request_present::where('request_date', $next_day)->first();
        $attendance->accepted = 0;
        $attendance->save();
        return redirect()->back();
    }

    public function revert_attendance(){
        $today = date('Y-m-d');
        $attendance = request_present::where('request_date', $today)->first();
        $attendance->confirm_present = 0;
        $attendance->save();
        return redirect()->back();
    }
}