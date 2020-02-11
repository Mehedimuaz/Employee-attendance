<?php
/**
 * Created by PhpStorm.
 * User: mmuaz
 * Date: 5/17/17
 * Time: 3:47 AM
 */
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class BasicSettingsController extends Controller{
    public function index(){
        $user = User::where('id', Auth::User()->id)->first();
        $data = array();
        $hour = 0;
        $minute = 0;
        $division = 0;
        $times = explode(':', $user->last_time);
//        $data['hour'] =
        return View::make('BasicSettings');
    }
    public function update(Request $request){
        $user = User::where('id', Auth::User()->id)->first();
        $hr = NULL;
        if(!Hash::check($request->password, $user->password)){
            $error = 'Wrong Password!';
            return View::make('error', compact('error'));
        }
        if($request->hour > 12 or $request->hour < 1){
            $error = 'Please enter correct hour value';
            return View::make('error', compact('error'));
        }
        if($request->division == 'AM'){
            if($request->hour == 12){
                $hr = 0;
            }
            else{
                $hr = $request->hour;
            }
        }
        else{
            if($request->hour == 12){
                $hr = $request->hour;
            }
            else {
                $hr = $request->hour + 12;
            }
        }
        if($hr < 10){
            $hr = '0'.$hr;
        }
        else{
            $hr = $hr.'';
        }

        $min = NULL;
        if($request->minute > 59 or $request->minute < 0){
            $error = 'Please enter correct minute value';
            return View::make('error', compact('error'));
        }
        $min = $request->minute;
        if($min < 10){
            $min= '0'.$min;
        }
        else{
            $min = $min.'';
        }

        if($request->new_password != NULL or $request->new_password1 != NULL){
            if($request->new_password != $request->new_password1){
                $error = 'New passwords do not match';
                return View::make('error', compact('error'));
            }
            else{
                $user->password = Hash::make($request->new_password);
            }
        }

        $user->last_time = $hr.':'.$min.':00';
        $user->salary = $request->salary;
        $user->save();
        return redirect()->back();
    }
}