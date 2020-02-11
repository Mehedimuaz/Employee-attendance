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

class EmployeeSettingsController extends Controller{
    public function index(){
        if(Auth::User()->user_type != 'employee'){
            $error = 'You do not have permission to access this page!';
            return View::make('error', compact('error'));
        }
        $user = User::where('id', Auth::User()->id)->first();
        $data = array('user' => $user);
        return View::make('EmployeeSettings', compact('data'));
    }
    public function update(Request $request){
        if(Auth::User()->user_type != 'employee'){
            $error = 'You do not have permission to access this page!';
            return View::make('error', compact('error'));
        }
        $user = User::where('id', Auth::User()->id)->first();
        if(!Hash::check($request->password, $user->password)){
            $error = 'Wrong Password!';
            return View::make('error', compact('error'));
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->new_password != NULL or $request->new_password1 != NULL){
            if($request->new_password != $request->new_password1){
                $error = 'New passwords do not match';
                return View::make('error', compact('error'));
            }
            else{
                $user->password = Hash::make($request->new_password);
            }
        }
        $user->save();
        return redirect()->back();
    }
}