<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{

    public function index(){

        $users=User::all()->where('status','=',0);

        return view('user.index',compact('users'))->with(['panel_title'=>'لیست کاربرها']);

    }
    public function create(Request $request){

        if($request->isMethod('get'))
            return view('user.form')->with(['panel_title'=>'ایجاد کاربر جدید']);
        else{
            $validator =Validator::make(Input::all(),[
                'name'=>'required',
                'username'=>'required|email',
                'password'=>'required|confirmed',

            ]);
            if($validator->fails()){


                return array(
                    'fail'=>true,
                    'errors'=>$validator->getMessageBag()->toArray(),

                );

            }

            $user =new User();
            $user->name=Input::get('name');
            $user->last_name=Input::get('last_name')?Input::get('last_name'):'';
            $user->username=Input::get('username');
            $user->password=bcrypt(Input::get('password'));
            $user->user_level=Input::get('user_level');

            $user->save();


        }
        return array(
            'content'=>'content',
            'url'=>route('user.list')
        );

    }

    public function editUserPublicInfo(Request $request,$id){

        $user=User::find($id);



        if($request->isMethod('get')) {

            return view('user.editUserPublicInfo', compact('user'))->with(['panel_title' => 'ویرایش  اطلاعات عمومی کاربر ']);
        }else {

            $rules=[];
            if(strtolower($user->username)!=strtolower(Input::get('username')))
                $rules+=['username'=>'required|alpha_dash|unique:users'];


            $validator =Validator::make(Input::all(),$rules);
            if($validator->fails()){


                return array('fail'=>true,
                    'errors'=>$validator->getMessageBag()->toArray());
            }

            $user->name = Input::get('name');
            $user->last_name = Input::get('last_name');
            $user->username = Input::get('username');
            $user->user_level = Input::get('user_level');


            $user->save();

            return array(
                'content' => 'content',
                'url' => route('user.list')
            );


            //Session::put('msg_status', 'fkjdkfgjdlgjdlkgjdkgjdl');
        }

    }

    public function editUserSecurityInfo(Request $request,$id){

        if($request->isMethod('get')) {
            $status=1;

            return view('user.editUserSecurityInfo', ['user' => User::find($id)],compact('status'))->with(['panel_title' => 'ویرایش اطلاعات امنییتی کاربر']);

        } else{


            $user =User::find($id);



            $password=$user->password;
            $old_password=$request->get('old-password');
            $rules=[];

            if(Input::get('password')!='')

                $rules+=['password'=>'confirmed'];

            $validator =Validator::make(Input::all(),$rules);
            if($validator->fails()){


                return array('fail'=>true,
                    'errors'=>$validator->getMessageBag()->toArray());
            }

            if(Hash::check($old_password, $password)){


                $user->user_level=Input::get('user_level');
                if(Input::get('password')!='')
                    $user->password = bcrypt(Input::get('password'));

                $user->save();

            }



            return array(
                'content'=>'content',
                'url'=>route('user.list')
            );



        }
    }



    public function delete($id){

        $user=User::find($id);
        $user->status=1;
        $user->save();
        return redirect('user');

    }

    public function doLogout(){
        Auth::logout();
        return redirect('/');
    }


}
/*
    public function index()
    {
        $users = User::all()->where('status', '<', 1);

        return view('user.index',compact('users'))->with('panel_title','لیست کاربران');
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))

            return view('user.form');
        else {
            $validator = Validator::make(Input::all(), [
                'name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'user_name' => 'required|email',
                'password' => 'required|max:10|min:5'
            ],[
                    'name.required' => 'وارد کردن نام الزامی میباشد!',
                    'user_name.required' => 'وارد کردن نام کاربری الزامی میباشد!',
                    'password.required' => 'وارد کردن رمز عبور الزامی میباشد!',
                    'password.max' => 'رمز عبور حد اکثر باید 10 کارکتر باشد',
                    'password.min' => 'رمز عبور حد اقل باید 5 کارکتر باشد'
                ]
                );
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }

            $user=new User();
            $user->name=Input::get('name');
            $user->last_name=Input::get('last_name');
            $user->user_name=Input::get('user_name');
            $user->password= bcrypt(Input::get('password'));
            $user->user_level=Input::get('level');
            $user->save();
            Session::put('msg_status', true);
            return array(
                'content' => 'content',
                'url' => route('user.list')
            );
        }

    }

    public function update(Request $request, $id)
    {
        $user=User::find($id);
        if($request->isMethod('get'))

            return view('user.form',compact('user'));
        else {
            $validator = Validator::make(Input::all(), [
                'name' => 'required',
                'user_name' => 'required',
                'password' => 'required|max:10|min:5'
            ],[
                    'name.required' => 'وارد کردن نام الزامی میباشد!',
                    'user_name.required' => 'وارد کردن نام کاربری الزامی میباشد!',
                    'password.required' => 'وارد کردن رمز عبور الزامی میباشد!',
                    'password.max' => 'رمز عبور حد اکثر باید 10 کارکتر باشد',
                    'password.min' => 'رمز عبور حد اقل باید 5 کارکتر باشد'
                ]
            );
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }

            $user=new User();
            $user->name=Input::get('name');
            $user->last_name=Input::get('last_name');
            $user->user_name=Input::get('user_name');
            $user->password=bcrypt(Input::get('password'));
            $user->user_level=Input::get('level');
            $user->save();
            Session::put('msg_status', true);
            return array(
                'content' => 'content',
                'url' => route('user.list')
            );
        }


    }

    public function delete($id)
    {
        if ($id && ctype_digit($id)) {
            $user = User::find($id)->where('user_id', $id)->update(['status' => 1]);
            return redirect('user.list');


        }

    }
}*/
