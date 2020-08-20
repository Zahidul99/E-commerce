<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Cart;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


class SuperAdminController extends Controller
{
  
    public function index()
    {
       $this->AdminAuthCheck();
        return view('admin_dashboard');
    
    }

     public function admin_logout()
    {
    	Session::flush();
    	return Redirect::to('/admin');
    }

    public function AdminAuthCheck()
    {
    	$admin_id=Session::get('admin_id');
    	if ($admin_id) {
    		return;
    	}
    	else{
    		return Redirect::to('/admin')->send();
    	}
    }

    public function customer_logout()
    {
        Session::flush();
        return Redirect::to('/');
    }
    
    public function customer_login(Request $request)
    {
         $customer_email=$request->customer_email;
         $password=md5($request->password);
         $result=DB::table('tbl_customer')
                ->where('customer_email',$customer_email)
                ->where('password',$password)
                ->first();



                if ($result) {
                     Session::put('customer_id',$result->customer_id);
                     return Redirect::to('/');
                           
                           }

                else{
                     return Redirect::to('/login-check');
                }



    }


}
