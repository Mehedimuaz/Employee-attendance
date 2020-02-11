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

class EmployeeHomeController extends Controller{
    public function index(){
        $dates = UtilityClass::get_dates();
        $next_day = UtilityClass::get_next_day();
        $supervisor = User::where('id', 3)->select('name')->first();
        $supervisor_name = $supervisor->name;
        $today = UtilityClass::get_today();
        $days = UtilityClass::get7days();
        $next_day1 = date('Y-m-d', strtotime('+1 day'));
        $var1 = 0;
        $var2 = 0;
        $var3 = 0;
        $attendance = request_present::whereDate('request_date', $next_day1)->first();
        if(sizeof($attendance) != 0){
            if($attendance->request_present == 1){
                if($attendance->accepted == 1){
                    $var1 = 1;
                }
                else if($attendance->accepted == 0){
                    $var2 = 1;
                }
                else{
                    $var1 = -1;
                }
            }
            else{
                if($attendance->accepted == 1){
                    $var1 = -1;
                }
                else if($attendance->accepted == 0){
                    $var2 = -1;
                }
                else{
                    $var1 = -1;
                }
            }
        }
        $data = array('days' => $days, 'dates' => $dates, 'today' => $today, 'next_day' => $next_day, 'supervisor_name' => $supervisor_name, 'var1' => $var1, 'var2' => $var2, 'var3' => $var3);
        return View::make('EmployeeHome', compact('data'));
    }
}
