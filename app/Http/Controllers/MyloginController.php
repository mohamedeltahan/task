<?php

namespace App\Http\Controllers;


use App\MyAuth;
use App\MyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;

class MyloginController extends Controller
{
    // this variable will used to hold current user
    public $my_user=null;
    public function register(Request $request){


        $user_date=$request->all();

        $user_date["password"]=Hash::make($request->password);
        $this->my_user=MyUser::create($user_date);

        //try to login user after its registeration
        return $this->login($request);



    }

    public function login (Request $request){
        //this will be null when i try to only login but if i login after registeration it will be my user
        if($this->my_user==null){
             //search by mail if its not admin
            $this->my_user=MyUser::where("email",$request->email)->first();
            //search by name if it is admin
            if($this->my_user==null){
                $this->my_user=MyUser::where("name",$request->email)->where("type","admin")->first();


            }
        }
        //initiate auth class
        $my_auth=new MyAuth($this->my_user);
        $login_response= $my_auth->login($request);
           //response is true if its authenticated
        if($login_response==true){

            return $this->home();

        }
        else{
           return "wrong credentials";

        }





    }
    //pass the id of the logged user to logout function so it can be determined the target user
    public function logout($id){
          $this->my_user=MyUser::find($id);
          $My_auth=new MyAuth($this->my_user);
          $My_auth->logout();
          return $this->home();

    }
//home function already know the current user as i stored it in global variable above
   public function home(){
        if(Session::has("admin_id") && $this->my_user->type=="admin"){
            return redirect()->route("view_all");
        }

       if(Session::has("user_id") && $this->my_user->type=="user") {
            return redirect()->route("my_profile");

       }
       else{
           return redirect()->route("login");

       }
   }
   // this function take the terget user id as parameter so i delete admin id and store user id then call home function to redirect it again
   public function login_as_user($id){

       MyAuth::switch_account($id);
       $this->my_user=MyUser::find($id);
       return $this->home();





   }
   //so after i logged in and put my data in session i now can view my profile based on it
   public function my_profile(){

       $user = \App\MyUser::find(Session::get("user_id"));
       return view('welcome',compact("user"));

   }
   public function view_all(){
       $users=\App\MyUser::all()->except(Session::get("admin_id"));
       $id=Session::get("admin_id");
       return view('view_all_users',compact("users","id"));
   }
}
