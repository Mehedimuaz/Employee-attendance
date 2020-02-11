<?php
/**
 * Created by PhpStorm.
 * User: mmuaz
 * Date: 5/15/17
 * Time: 5:00 PM
 */

namespace App\Http\Controllers;

use App\request_present;
use App\User;
use Illuminate\Support\Facades\View;
use StdClass;

class SupervisorHomeController extends Controller{
    public function index(){
        $dates = UtilityClass::get_dates();
        $next_day = UtilityClass::get_next_day();
        $employee = User::where('id', 4)->select('name')->first();
        $employee_name = $employee->name;
        $today = UtilityClass::get_today();
        $var1 = 0;
        $var2 = 0;
        $var3 = 0;
        $var4 = 0;
        $today1 = date('Y-m-d');
        $next_day1 = date('Y-m-d', strtotime('+1 day'));
        $attendance = request_present::where('request_date', $today1)->first();
        $request = request_present::where('request_date', $next_day1)->first();
        if(sizeof($attendance) == 0){
            $var1 = 0;
            $var3 = 0;
        }
        else if($attendance->confirm_present == 1){
            $var1 = 1;
            $var3 = 0;
        }
        else if($attendance->confirm_present == 0){
            $var1 = 0;
            $var3 = 1;
        }
        else if($attendance->confirm_present == -1){
            $var1 = -1;
            $var3 = 0;
        }


        if(sizeof($request) == 0){
            $var2 = 0;
            $var4 = 0;
        }
        else{
            if($request->request_present == 1){ //present request
                if($request->accepted == 1){
                    $var2 = 1;
                    $var4 = 0;
                }
                else{
                    $var2 = 0;
                    $var4 = 1;
                }
            }
            else{ //absent request
                if($request->accepted == 1){
                    $var2 = -1;
                    $var4 = 0;
                }
                else{
                    $var2 = 0;
                    $var4 = -1;
                }
            }
        }
        $data = array('dates' => $dates, 'next_day' => $next_day, 'employee_name' => $employee_name, 'today' => $today, 'var1' => $var1, 'var2' => $var2, 'var3' => $var3, 'var4' => $var4);
//        echo 'style="background-color: #D2691E !important;"';
        return View::make('SupervisorHome', compact('data'));
    }
}
