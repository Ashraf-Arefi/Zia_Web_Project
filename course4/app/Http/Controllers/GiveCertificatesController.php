<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Certificate;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class GiveCertificatesController extends Controller
{
    public function index(){
       $giveCertificate = \DB::table('certificate')
           ->join('student','student.st_id','=','certificate.student_id')
           ->join('class','class.class_id','=','certificate.class_id')
           ->select('student.first_name','student.last_name','certificate.date','class.class_name','certificate.payment','certificate.description','certificate.certificate_id')
           ->where('certificate.status','!=',1)
           ->get();
        return view("course.givedCertificateList", compact('giveCertificate'))->with('panel_title', 'لیست مدرک های داده شده');
    }
    public function create(Request $request)
    {
        if ($request->isMethod('get')){
            $student = \DB::table('student_class as sc')
                ->join('student','student.st_id','=','sc.student_id')
                ->join('class','class.class_id','=','sc.class_id')
                ->select('student.first_name','student.last_name','student.st_id')
                ->where('class.certificate','=','دارد')
                ->where('student.status','!=',1)
                ->get();

            $class = \DB::table('student_class as sc')
                ->join('class','class.class_id','=','sc.class_id')
                ->select('class.class_name','class.class_id')
                ->where('class.certificate','=','دارد')
                ->where('class.status','!=',1)
                ->get();


            return view('course.giveCertificateForm',compact('student','class'))->with('panel_title','ثبت مدارک شاگردان');
        }
        else{
            $validator = Validator::make(Input::all(), [
                'student_name' => 'required',
                'class' => 'required ',
                'payment' => 'required ',
                'givedCertificate_date' => 'required ',
                'description' => 'required ',


            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }
            $arr = [
                "student_id" => $request->input("student_name"),
                "class_id" => $request->input("class"),
                "payment" => $request->input("payment"),
                "description" => $request->input("description"),
                "date" => $request->input("givedCertificate_date"),

            ];

            Certificate::create($arr);



            return array(
                'content' => 'content',
                'url' => route('giveCertificate.create')
            );
        }
    }

    public function update(Request $request,$id)
    {

        if ($request->isMethod('get')){
           $certificate = Certificate::find($id);
           $student = Student::all()->where('status','!=',1);
           $class = Course::all()->where('status','!=',1);

            return view('course.giveCertificateForm',compact('certificate','student','class'))->with('panel_title','ویرایش مدارک شاگردان');
        }
        else{
            $validator = Validator::make(Input::all(), [
                'student_name' => 'required',
                'class' => 'required ',
                'payment' => 'required ',
                'givedCertificate_date' => 'required ',
                'description' => 'required ',


            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }
            $arr = [
                "student_id" => $request->input("student_name"),
                "class_id" => $request->input("class"),
                "payment" => $request->input("payment"),
                "description" => $request->input("description"),
                "date" => $request->input("givedCertificate_date"),

            ];


            Certificate::find($id)->where('certificate_id', $id)->update($arr);



            return array(
                'content' => 'content',
                'url' => route('giveCertificate.list')
            );
        }
    }

    public function delete($id)
    {
        if ($id && ctype_digit($id)) {
            Certificate::find($id)->update(['status' => 1]);
            return redirect("giveCertificate");
        }
    }
}
