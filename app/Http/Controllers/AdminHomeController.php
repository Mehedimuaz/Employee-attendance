<?php
/**
 * Created by PhpStorm.
 * User: mmuaz
 * Date: 5/15/17
 * Time: 5:00 PM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\request_present;
use StdClass;
use App\User;

class AdminHomeController extends Controller{
    public function index(){
        $dates = UtilityClass::get_dates();
        $next_day = UtilityClass::get_next_day();
        $days = UtilityClass::get7days();
        $var2 = 0;
        $next_day1 = date('Y-m-d', strtotime('+1 day'));
        $request = request_present::where('request_date', $next_day1)->first();
        $employee = User::where('id', 4)->select('name')->first();
        $employee_name = $employee->name;
        if(sizeof($request) == 0){
            $var2 = 0;
        }
        else{
            if($request->request_present == 1){ //present request
                if($request->accepted == 1){
                    $var2 = 1;
                }
                else{
                    $var2 = 0;
                }
            }
            else{ //absent request
                if($request->accepted == 1){
                    $var2 = -1;
                }
                else{
                    $var2 = 0;
                }
            }
        }
        $data = array('days' => $days, 'next_day' => $next_day, 'dates' => $dates, 'var2' => $var2, 'employee_name' => $employee_name);
        return View::make('AdminHome', compact('data'));
    }

    public function pay_salary(){
        $today = strtotime(date('Y-m-d'));
        $start_day = strtotime('-7 day');
//        echo $today.' '.$start_day;
        while($start_day <= $today){
            $day = date('Y-m-d', $start_day);
            $start_day = strtotime('+1 day', $start_day);
//            echo $day;
            $attendance = request_present::whereDate('request_date', $day)->first();
            if(sizeof($attendance) != 0){
                $attendance->paid = true;
                $attendance->save();
            }

        }
        $user = User::where('id', '2')->first();
        $user->last_paid = date('Y-m-d');
        $user->save();
        return redirect()->back();
    }
}
