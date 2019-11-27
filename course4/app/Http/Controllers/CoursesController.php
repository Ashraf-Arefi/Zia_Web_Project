<?php

namespace App\Http\Controllers;

use App\Models\ClassTeacher;
use App\Models\Course;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Room;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    public function index()
    {
        ;
        $courses = \DB::table('class_teacher as ct')
            ->join('class', 'class.class_id', '=', 'ct.class_id')
            ->join('employee', 'employee.employee_id', '=', 'ct.teacher_id')
            ->select('class.class_name', 'employee.first_name', 'employee.last_name', 'class.room_name', 'class.start_time', 'class.start_date', 'class.end_time', 'class.class_status', 'class.class_id')
            ->where('class.certificate', '=', 'ندارد')
            ->where('class.status', '!=', 1)->paginate(5);
        return view("course.index", compact("courses", 'employee'))->with('panel_title', 'لیست همه کلاس ها(بدون مدرک)');
    }

    public function certificateClass()
    {

        $courses = \DB::table('class_teacher as ct')
            ->join('class', 'class.class_id', '=', 'ct.class_id')
            ->join('employee', 'employee.employee_id', '=', 'ct.teacher_id')
            ->select('class.class_name', 'employee.first_name', 'employee.last_name', 'class.room_name', 'class.start_time', 'class.start_date', 'class.end_time', 'class.class_status', 'class.class_id')
            ->where('class.certificate', '=', 'دارد')
            ->where('class.status', '!=', 1)->paginate(2);

        return view("course.classWihtCertificatePagination", compact("courses"));
    }

    public function getCertificateClass(Request $request)
    {
        if ($request->ajax()) {
            $courses = \DB::table('class_teacher as ct')
                ->join('class', 'class.class_id', '=', 'ct.class_id')
                ->join('employee', 'employee.employee_id', '=', 'ct.teacher_id')
                ->select('class.class_name', 'employee.first_name', 'employee.last_name', 'class.room_name', 'class.start_time', 'class.start_date', 'class.end_time', 'class.class_status', 'class.class_id')
                ->where('class.certificate', '=', 'دارد')
                ->where('class.status', '!=', 1)->paginate(2);

            return view("course.classWithCertificateList", compact("courses"))->with('panel_title', 'لیست همه کلاس ها(با مدرک)');
        }
    }


    public function filterClass($id)
    {
        $data = "";
        $output = "";
        switch ($id) {

            case 0:
                $data = Course::all()->where('status', '!=', 1);;
                break;
            case 1:
                $data = Course::where('class_status', "==", 1)->get();
                break;
            case 2:
                $data = Course::where('class_status', "==", 2)->get();
                break;
            case 3:
                $data = Course::where('class_status', "==", 3)->get();
                break;

        }

        //return view("course.index", compact("courses"));

        $total_row = $data->count();
        if ($total_row > 0) {
            //  $request->session()->regenerate();
            foreach ($data as $course) {
                $output .= '
        <tr>
         <td>' . $course->subject["subject_name"] . '</td>
         <td>' . $course->employee["first_name"] . " " . $course->employee["last_name"] . '</td>
         <td>' . $course->room["room_name"] . '</td>
         <td>' . $course->start_time . '</td>
                <td>' . $course->start_date . '</td>
                <td>' . $course->end_date . '</td>
                <td>
                    <select class="form-control class_status" id_row="' . $course->class_id . ' " name="class_status" >
                        <option value="0">حالت کلاس</option>
                        <option value="1">درحال جریان</option>
                        <option value="2">درحال ختم</option>
                        <option value="3">ختم شده</option>
                    </select>
                </td>
                 <td >

                    <a href="javascript:ajaxLoad(\'route(\'course.student\',$course->class_id)}}\')" class="btn btn-info btn-xs" id="show_student">نمایش شاگردان</a>
                    <a href="javascript:ajaxLoad(\'{{route(\'course.update\',$course->class_id)}}\')" class="glyphicon glyphicon-edit btn btn-success btn-xs" id="edit_course"></a>
                    <a href="javascript:if(confirm(\'Do you want delete this record?\'))ajaxDelete(\'{{route(\'course.delete\',$course->class_id)}}\',\'{{csrf_token()}}\')" class="glyphicon glyphicon-trash btn btn-danger btn-xs" id="delete_coures"></a>
                </td>

        </tr>
         ';
            }


        } else {
            $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';

        }
        $data = array(
            'table_data' => $output,
            'total_data' => $total_row
        );

        //echo json_encode($data);
        return response()->json($data);


    }


    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $employees = Employee::select('employee_id', 'first_name', 'last_name')
                ->where('status', '!=', '1')->get();
            $subjects = Subject::all()->where('status', '!=', '1');
            $rooms = Room::all()->where('status', '!=', '1');
            $department = Department::all()->where('status', '!=', '1');


            return view('course.form', compact("subjects", "rooms", "employees", "department"))->with('panel_title', 'ایجاد کلاس جدید');

        } else {
            $validator = Validator::make(Input::all(), [
                'subject' => 'required',
                'room' => 'required ',
                'employee' => 'required ',
                'start_time' => 'required ',
                'end_time' => 'required ',
                'fees' => 'required ',
                'course_percentage' => 'required ',
                'class_status' => 'required ',
                'certificate' => 'required ',
                'start_date' => 'required '

            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            } else {
                $ex = new Course();

                $ex->subject_id = Input::get('subject');
                $ex->room_name = Input::get('room');
                $ex->start_time = (date("H:i:s", strtotime($request->input("start_time"))));
                $ex->end_time = (date("H:i:s", strtotime($request->input("end_time"))));
                $ex->fees = Input::get('fees');
                $ex->course_percentage = Input::get('course_percentage');
                $ex->class_name = Input::get('class_name');
                $ex->certificate = Input::get('certificate');
                $ex->class_status = Input::get('class_status');
                $ex->start_date = Input::get('start_date');


            }

            if ($ex->save()) {
                $employee_id = Input::get("employee");

                $count = count($employee_id);

                for ($i = 0; $i < $count; $i++) {


                    $cT = new ClassTeacher();
                    $cT->teacher_id = $employee_id[$i];
                    $cT->class_id = $ex->class_id;


                    $cT->save();

                }
            }
            return array(
                'content' => 'content',
                'url' => route('course.create')
            );
        }

    }


    public function delete($id)
    {
        if ($id && ctype_digit($id)) {
            Course::find($id)->update(['status' => 1]);
            return redirect("course");
        }
    }


    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $cT = ClassTeacher::find($id);

        if ($request->isMethod('get')) {
            $employees = Employee::all();


            $subjects = Subject::all()->where('status', '!=', '1');
            $class = Course::all()->where('class_status', '!=', '1');
            $rooms = Room::all()->where('status', '!=', '1');
            $departments = Department::all()->where('status', '!=', '1');
            $course = Course::find($id);

            $class_teacher = \DB::table('class_teacher as ct')
                ->join('class', 'class.class_id', '=', 'ct.class_id')
                ->join('employee', 'employee.employee_id', '=', 'ct.teacher_id')
                ->select('ct.teacher_id')
                ->where('class.class_id', '=', $id)->get()->toArray();


            return view('course.form', compact('departments', 'rooms', 'subjects', 'employees', 'course', 'class', 'class_teacher'))->with('panel_title', 'ویرایش کلاس ');
        } else {

            $validator = Validator::make(Input::all(), [

                'subject' => 'required',
                'employee' => 'required',
                'room' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'fees' => 'required',
                'start_date' => 'required',
                'certificate' => 'required',
                'class_status' => 'required'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            } else {

                $course->subject_id = Input::get('subject');
                $course->room_name = Input::get('room');
                $course->start_time = (date("H:i:s", strtotime($request->input("start_time"))));
                $course->end_time = (date("H:i:s", strtotime($request->input("end_time"))));
                $course->fees = Input::get('fees');
                $course->course_percentage = Input::get('course_percentage');
                $course->class_name = Input::get('class_name');
                $course->certificate = Input::get('certificate');
                $course->class_status = Input::get('class_status');
                $course->start_date = Input::get('start_date');

                if ($course->save()) {
                    $employee_id = Input::get("employee");
                    //dd($employee_id);
                    $count = count($employee_id);

                    for ($i = 0; $i < $count; $i++) {

                        $cT->teacher_id = $employee_id[$i];
                        $cT->class_id = $course->class_id;
                        dd($employee_id[$i]);
                        $cT->save();

                    }
                }
                return array(
                    'content' => 'content',
                    'url' => route('course.certificateClass')
                );

            }


        }

    }

    public function change_status(Request $request)
    {
        //dd($request);
        $id_row = 2;
        $id = 1;

        if ($id && ctype_digit($id)) {
            switch ($id_row) {
                case 0:
                    Course::find($id_row)->update(['class_status' => 0]);
                    break;
                case 1:
                    Course::find($id_row)->update(['class_status' => 1]);
                    break;
                case 2:
                    Course::find($id_row)->update(['class_status' => 2]);
                    break;
                case 3:
                    Course::find($id_row)->update(['class_status' => 3]);
                    break;
            }
            return redirect("course");
        }
    }


}
