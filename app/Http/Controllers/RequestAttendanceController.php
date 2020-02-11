<?php
/**
 * Created by PhpStorm.
 * User: mmuaz
 * Date: 5/19/17
 * Time: 12:37 AM
 */
namespace App\Http\Controllers;

use App\request_present;
use App\User;
use Illuminate\Support\Facades\View;

class RequestAttendanceController extends Controller{
    public function attendance(){
        $hr = intval(date('H'));
        $min = intval(date('i'));
        $user = User::where('id', 2)->first();
        $last_time = explode(':', $user->last_time);
        $last_hr = intval($last_time[0]);
        $last_min = intval($last_time[1]);
        if($hr > $last_hr || ($hr == $last_hr && $min > $last_min)){
            $error = 'Time is over';
            return View::make('error', compact('error'));
        }
        $nextdaynum = strtotime('+1 day');
        $nextday = date('Y-m-d', $nextdaynum);
        request_present::where('request_date', $nextday)->delete();
        $present = new request_present();
        $present->employee_id = 4;
        $present->request_date = $nextday;
        $present->request_present = 1;
        $present->accepted = 0;
        $present->confirm_present = 0;
        $present->save();
        return redirect()->back();
    }

    public function absence(){
        $hr = intval(date('H'));
        $min = intval(date('i'));
        $user = User::where('id', 2)->first();
        $last_time = explode(':', $user->last_time);
        $last_hr = intval($last_time[0]);
        $last_min = intval($last_time[1]);
        if($hr > $last_hr || ($hr == $last_hr && $min > $last_min)){
            $error = 'Time is over';
            return View::make('error', compact('error'));
        }
        $nextdaynum = strtotime('+1 day');
        $nextday = date('Y-m-d', $nextdaynum);
        request_present::where('request_date', $nextday)->delete();
        $present = new request_present();
        $present->employee_id = 4;
        $present->request_date = $nextday;
        $present->request_present = -1;
        $present->accepted = 0;
        $present->confirm_present = 0;
        $present->save();
        return redirect()->back();
    }
}