<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class SliderController extends Controller
{
    public function index()
    {
    	$this->AdminAuthCheck();
    	return view('add_slider');
    }


    public function save_slider(Request $request)
    {
    	$this->AdminAuthCheck();
    	$data=array();
    	$data['publication_status']=$request->publication_status;

       $image=$request->file('slider_image');

       if ($image) {
       	$image_name=str::random(20);
       	$ext=strtolower($image->getClientOriginalExtension());
       	$image_full_name=$image_name.'.'.$ext;
       	$upload_path='slider/';
        $image_url=$upload_path.$image_full_name;
        $success=$image->move($upload_path,$image_full_name);
        if ($success) {
        	$data['slider_image']=$image_url;

               	DB::table('tbl_slider')->insert($data);
               	Session::put('messege','Slider added successfully!!');
               	return Redirect::to('/add-slider');

               	}       	
       }
                
          $data['slider_image']='';
          DB::table('tbl_slider')->insert($data);

          Session::put('messege','Slider added successfully without image!!');
               	return Redirect::to('/add-slider');

    }


    public function all_slider()
    {
    	$this->AdminAuthCheck();
    	$all_slider=DB::table('tbl_slider')->get();

        $manage_slider=view('all_slider')
         ->with('all_slider',$all_slider);

         return view('admin_layout')
         ->with('all_slider',$manage_slider);

    }


 public function unactive_slider($slider_id)
    {
    	DB::table('tbl_slider')
	->where('slider_id',$slider_id)
	->update(['publication_status'=>0]);
	Session::put('messege','Slider Unactive successfully !!');

	return Redirect::to('/all-slider');
    }
    

    public function active_slider($slider_id)
    {
    	DB::table('tbl_slider')
	->where('slider_id',$slider_id)
	->update(['publication_status'=>1]);
	Session::put('messege','Slider active successfully !!');
      return Redirect::to('/all-slider');
    }


    public function delete_slider($slider_id)
    {
    	 $this->AdminAuthCheck();
    	 DB::table('tbl_slider')
        ->where('slider_id',$slider_id)
        ->delete();
        Session::put('messege','Slider deleted successfully !!');
        return Redirect::to('/all-slider');

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

}

