<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Morilog\Jalali\Jalalian;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*  public function __construct()
      {
          $this->middleware('auth');
      }*/


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        Session::put('user_info', $user);
        Session::put('user_id', $user->user_id);

        $year = Jalalian::fromCarbon(Carbon::now())->getYear();

        $arr = array();
        $arr2 = array();
        for ($i = 1; $i <= 9; $i++) {

            $arr[] = \DB::table("student_class")->where("c_date", "like", $year . "-0" . $i . "%")->sum("c_payment");
            $arr2[] = \DB::table("expense")->where("pay_date", "like", $year . "-0" . $i . "%")->sum("amount");

        }
        //it is for student payment
        $arr[] = \DB::table("student_class")->where("c_date", "like", $year . "-10%")->sum("c_payment");
        $arr[] = \DB::table("student_class")->where("c_date", "like", $year . "-11%")->sum("c_payment");
        $arr[] = \DB::table("student_class")->where("c_date", "like", $year . "-12%")->sum("c_payment");

        json_encode($arr);

            //it is for expense data chart
        $arr2[] = \DB::table("expense")->where("pay_date", "like", $year . "-10%")->sum("amount");
        $arr2[] = \DB::table("expense")->where("pay_date", "like", $year . "-11%")->sum("amount");
        $arr2[] = \DB::table("expense")->where("pay_date", "like", $year . "-12%")->sum("amount");

        json_encode($arr2);


        return view('dashboard.home', compact("arr", "arr2"));
    }

    public function register(Request $request)
    {
        if ($request->isMethod("get")) {
            return view("layout.login.master");
        } else {
            $request->all();
        }
    }

    public function changeLanguage(Request $request)
    {
        $lang = $request->language;
        Session(['locale'=>$lang]);
       // echo Session::get('locale');exit();

        return redirect()->back();
    }

}
