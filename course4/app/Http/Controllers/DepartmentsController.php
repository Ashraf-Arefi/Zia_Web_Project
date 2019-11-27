<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DepartmentsController extends Controller
{
    public function index()
    {
        $department=Department::all()->where('status', '<', 1);

        return view('department.index', compact('department'))->with('panel_title','لیست دپارتمنت ها');
    }


    public function create(Request $request)
    {


        if($request->isMethod('get'))

            return view('department.form')->with('panel_title','ایجاد دپارتمنت');

        else {
            $validator = Validator::make(Input::all(), [

                'department_name' => 'required'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }else{

                $dep=new Department();
                $dep->department_name=Input::get('department_name');

                $dep->save();
                return array(
                    'content' => 'content',
                    'url' => route('department.list')
                );

            }

        }

    }

    public function update(Request $request, $id)
    {
        
        $department=Department::find($id);

        if($request->isMethod('get'))
            
            return view('department.form',compact('department'));
        else {
            $validator = Validator::make(Input::all(), [

                'department_name' => 'required'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }
            if($request->get('id')){
                $data=[
                    'department_name'=>$request->get('department_name')
                ];

                Department::find($request->get('id'))->where('department_id',$request->get('id'))->update($data);

                return array(
                    'content' => 'content',
                    'url' => route('department.list')
                );
            }

            Session::put('msg_status', true);
        }
    }

    public function delete($id)
    {

        if ($id && ctype_digit($id)) {
            $user = Department::find($id)->where('department_id', $id)->update(['status' => 1]);
            return redirect('department');


        }

    }


}
