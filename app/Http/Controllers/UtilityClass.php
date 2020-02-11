<?php
/**
 * Created by PhpStorm.
 * User: mmuaz
 * Date: 5/18/17
 * Time: 12:59 AM
 */
namespace App\Http\Controllers;

use App\request_present;
use App\User;
use StdClass;

class UtilityClass extends Controller{
    public static function get_dates(){
        $today = date('Y-m-d');
        $numtoday = strtotime($today);
        $employee = User::where('id', 4)->first();
        $start_date = date_format($employee->created_at, 'Y-m-d');
        $newdate = strtotime($start_date);
        $numcurrdate = $newdate;
        $dates = array();
        while($numcurrdate <= $numtoday){
            $temp = new StdClass();
            $temp->day = date('j', $numcurrdate);
            $temp->month = date('n', $numcurrdate) - 1;
            $temp->year = date('Y', $numcurrdate);
            $attendance = request_present::whereDate('request_date', date('Y-m-d', $numcurrdate))
                ->where('confirm_present', 1)
                ->first();
            if(sizeof($attendance) != 0){
                $temp->value = 35;
            }
            else{
                $temp->value = -25;
            }
            $numcurrdate = strtotime('+1 day', $numcurrdate);
            array_push($dates, $temp);
        }
        return $dates;
    }

    public static function get7days(){
        $days = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $months = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $days1 = array();
        $today = date('Y-m-d');
        $admin = User::where('id', 2)->first();
        $last_paid = $admin->last_paid;
        $last_paid_num = strtotime('+1 day', strtotime($last_paid));
        $numtoday = strtotime($today);
        $last_monday = strtotime('last Monday');

        if(date('N', $numtoday) != 1){
            $currdate = min($last_monday, $last_paid_num);
            while($currdate < $numtoday){
                $temp = new StdClass();
                $temp->full_date = date('Y-m-d', $currdate);
                $temp->daynum = date('j', $currdate);
                $temp->day = $days[intval(date('w', $currdate))];
                $temp->month = $months[date('n', $currdate) - 1];
                $temp->year = date('Y', $currdate);
                $currdate = strtotime('+1 day', $currdate);
                $attendance = request_present::whereDate('request_date', $temp->full_date)
                    ->where('request_present', 1)
                    ->where('confirm_present', 1)
                    ->where('paid', true)
                    ->first();
                if(sizeof($attendance) != 0){
                    $temp->salary = '$ '.$attendance->salary;
                    $temp->value = $attendance->salary;
                }
                else{
                    $temp->salary = 'FALTA';
                    $temp->value = 0;
                }
                array_push($days1, $temp);
//                echo $temp->full_date.' '.$temp->salary.'\n';
            }
        }
        return $days1;
    }

    public static function get_next_day(){
        $next_day = new StdClass();
        $days = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $months = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $curtime = strtotime('+1 day'); //strtotime('+6 hour', time());
        $next_day->day = $days[date('w', $curtime)];
        $next_day->daynum = date('d', $curtime);
        $next_day->month = $months[date('n', $curtime) - 1];
        $next_day->year = date('Y', $curtime);

        return $next_day;
    }
    public static function get_today(){
        $today = new StdClass();
        $days = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $months = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $curtime = time(); //strtotime('+6 hour', time());
        $today->day = $days[date('w', $curtime)];
        $today->daynum = date('d', $curtime);
        $today->month = $months[date('n', $curtime) - 1];
        $today->year = date('Y', $curtime);

        return $today;
    }

}