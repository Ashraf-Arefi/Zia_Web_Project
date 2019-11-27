<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SubjectsController extends Controller
{

    public function index()
    {
        $subjects = Subject::select('subject_id', 'subject_name', 'subject_payment', 'department_name')
            ->Join('department', 'department.department_id', '=', 'subject.department_id')
            ->where('subject.status', '<',1)->get();
        return view('subject.index', compact('subjects'))->with('panel_title','لیست مضامین');
    }

    public function create(Request $request)
    {
        $departments = Department::all();
        if ($request->isMethod('get'))

            return view('subject.form', compact('departments'))->with('panel_title','ثبت مضمون جدید');

        else {
            $validator = Validator::make(Input::all(), [
                'subject_name' => 'required',
                'subject_payment' => 'required',
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            } else {

                $subject = new Subject();
                $subject->subject_name = Input::get('subject_name');
                $subject->subject_payment = Input::get('subject_payment');
                $subject->department_id = Input::get('department');

                $subject->save();
                return array(
                    'content' => 'content',
                    'url' => route('subject.list')
                );
            }
        }
    }


    public function update(Request $request, $id)
    {

        $subject= Subject::find($id);
        $departments =Department::all();

        if($request->isMethod('get'))

            return view('subject.form',compact('subject','departments'));
        else {
            $validator = Validator::make(Input::all(), [

                'subject_name' => 'required',
                'subject_payment' => 'required',
                'department' => 'required'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }
           // dd($request->all());
            if($request->get('subject_id')){
                $data=[
                    'subject_name'=>$request->get('subject_name'),
                    'subject_payment'=>$request->get('subject_payment'),
                    'department_id'=>$request->get('department')
                ];

                Subject::find($request->get('subject_id'))->where('subject_id',$request->get('subject_id'))->update($data);

                return array(
                    'content' => 'content',
                    'url' => route('subject.list')
                );
            }

            Session::put('msg_status', true);
        }
    }

    
    public function delete($id)
    {
        if ($id && ctype_digit($id)) {
            Subject::find($id)->where('subject_id', $id)->update(['status' => 1]);
            return redirect('subject');
        }
    }
}
