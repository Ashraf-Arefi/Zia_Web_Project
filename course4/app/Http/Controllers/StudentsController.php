<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::all()->where('status', '<', 1);
        return view("student.index", compact("students"))->with('panel_title','لیست همه شاگردان');

    }



    public function showDetail($id)
    {
        $student = Student::find($id);
        return view("student.showDetail",compact("student"))->with('panel_title','جزئیات شاگردان');

    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {


            return view('student.form')->with('panel_title','ثبت شاگرد جدید');
            ;
        } else {

            if ($request->file("photo")){
                $photo_address = "image/".time().".".$request->file("photo")->getClientOriginalExtension();
                $request->file("photo")->move(public_path("image"),$photo_address);
            }else{

                $photo_address = "image/empty_profile.jpg";
            }
            if ($request->file("agreepaper")){
                $agree_address = "image/per_".time().".".$request->file("agreepaper")->getClientOriginalExtension();
                $request->file("agreepaper")->move(public_path("image"),$agree_address);


            }else{

                $agree_address = "image/agreement.jpg";
            }

            $arr = [
                "first_name" => $request->input("name"),
                "last_name" => $request->input("last_name"),
                "father_name" => $request->input("father_name"),
                "gender" => $request->input("gender"),
                "age" => $request->input("age"),
                "phone" => $request->input("phone"),
                "address" => $request->input("address"),
                "date" => $request->input("date"),
                "photo" => $photo_address,
                "agreement_paper" => $agree_address,
                "status" => 0,
            ];

            Student::create($arr);
            return array(
                'content' => 'content',
                'url' => route('student.list')
            );
        }
    }

    public function delete($id)
    {

        if ($id && ctype_digit($id)) {
            Student::find($id)->update(['status' => 1]);
            return redirect()->route("student.list");

        }
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if ($request->isMethod('get'))

            return view('student.form', compact('student'))->with('panel_title','ویرایش شاگرد');

        else {

            if ($request->file("photo")){
                $photo_address = "image/".time().".".$request->file("photo")->getClientOriginalExtension();
                $request->file("photo")->move(public_path("image"),$photo_address);
            }else{

                $photo_address = "image/empty_profile.jpg";
            }
            if ($request->file("agreepaper")){
                $agree_address = "image/per_".time().".".$request->file("agreepaper")->getClientOriginalExtension();
                $request->file("agreepaper")->move(public_path("image"),$agree_address);


            }else{

                $agree_address = "image/agreement.jpg";
            }

            $arr = [
                "first_name" => $request->input("name"),
                "last_name" => $request->input("last_name"),
                "father_name" => $request->input("father_name"),
                "gender" => $request->input("gender"),
                "age" => $request->input("age"),
                "phone" => $request->input("phone"),
                "address" => $request->input("address"),
                "date" => $request->input("date"),
                "photo" => $photo_address,
                "agreement_paper" => $agree_address,
                "status" => 0,
            ];
            Student::find($id)->update($arr);
            return array(
                'content' => 'content',
                'url' => route('student.list')
            );
        }

    }
    public function student($id)
    {
        $students = \DB::table('student_class')
            ->join('student', 'student.st_id', '=', 'student_class.student_id')
            ->join('class', 'class.class_id', '=', 'student_class.class_id')
            ->where("student_class.class_id", $id)
            ->get();

        return view("course.studentWithCertificate", compact("students"));

    }
    public function studentWithCertificate($id)
    {
        $students = \DB::table('student_class')
            ->join('student', 'student.st_id', '=', 'student_class.student_id')
            ->join('class', 'class.class_id', '=', 'student_class.class_id')
            ->where("student_class.class_id", $id)
            ->where('class.certificate','=','دارد')
            ->get();

        return view("course.studentWithCertificate", compact("students"));

    }
    public function studentWithNoCertificate($id)
    {
        $students = \DB::table('student_class')
            ->join('student', 'student.st_id', '=', 'student_class.student_id')
            ->join('class', 'class.class_id', '=', 'student_class.class_id')
            ->where("student_class.class_id", $id)
            ->where('class.certificate','=','ندارد')
            ->get();

        return view("course.studentWithNoCertificate", compact("students"));

    }




}
