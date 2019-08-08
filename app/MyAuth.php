<?php


namespace App;

use App\MyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MyAuth
{    public  $logged_user;

     function __construct($logged_user){

          $this->logged_user=$logged_user;

    }

    public function login(Request $request){
         if($this->logged_user!=null && Hash::check($request->password,$this->logged_user->password)){
             if($this->logged_user->type=="admin"){

                 Session::put("admin_id",$this->logged_user->id);

             }
             else{
                 Session::put("user_id",$this->logged_user->id);

             };

             return true;
         }
         //mail not found or password wrong
         return false;

    }
    public function logout(){

        if(Session::has("admin_id") && $this->logged_user->type=="admin"){
            Session::forget("admin_id");

        }

        if(Session::has("user_id") && $this->logged_user->type=="user") {
            Session::forget("user_id");

        }

    }

    public static function switch_account($id){


         Session::forget("admin_id");
         Session::put("user_id",$id);

    }





}