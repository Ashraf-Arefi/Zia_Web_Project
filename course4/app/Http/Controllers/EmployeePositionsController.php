<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\employeePosition;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class EmployeePositionsController extends Controller
{
    public function index()
    {


        $user = employeePosition::all()->where('status', '<', 1);

        return view('position.index',compact('user'))->with(['panel_title'=>'لیست مقام ها']);

    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))

            return view('position.form')->with(['panel_title'=>'ایجاد مقام جدید']);
        else {
            $validator = Validator::make(Input::all(), [
                'position_name' => 'required'

            ],[
                    'position_name.required' => 'وارد کردن مقام  الزامی میباشد!',

                ]
            );
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }
        }
        $name=$request->input('position_name');

        $recourd=DB::table('employee_position')->where('position_name',$name)->doesntExist();
        if ($recourd){
            $position = new employeePosition();
            $position->position_name = Input::get('position_name');

            $position->save();
            return array(

                'content' => 'content',
                'url' => route('position.create')
            );
            Session::put('msg_status', true);
        }
        return array(

            'content' => 'content',
            'url' => route('position.list')
        );

        Session::put('msg_status', 'jfskdjfksjfksjflskfjsk');


    }

    public function update(Request $request, $id)
    {

        $position=employeePosition::find($id);
        if($request->isMethod('get'))

            return view('position.form',compact('position'))->with(['panel_title'=>'ویرایش  مقام']);
        else {
            $validator = Validator::make(Input::all(), [
                'position_name' => 'required'

            ],[
                    'position_name.required' => 'وارد کردن مقام  الزامی میباشد!',

                ]
            );
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }


            $position->position_name=Input::get('position_name');

            $position->save();

            return array(

                'content' => 'content',
                'url' => route('position.list')
            );

            Session::put('msg_status', 'jfskdjfksjfksjflskfjsk');
        }


    }

    public function delete($id)
    {
        if ($id && ctype_digit($id)) {
            $user = employeePosition::find($id)->where('position_id', $id)->update(['status' => 1]);
            return redirect('position')->with('success','عملیه حذف با موفقیت انجام شد');


        }


    }
}
