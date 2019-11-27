<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Score;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class GiveScoresController extends Controller
{
    public function index()
    {
        $giveScore = \DB::table('student_score as sc')
            ->join('student', 'student.st_id', '=', 'sc.student_id')
            ->join('class', 'class.class_id', '=', 'sc.class_id')
            ->select('student.first_name', 'student.last_name', 'class.class_name', 'sc.midterm_exam', 'sc.final_exam', 'sc.score_id')
            ->where('sc.status', '!=', 1)->orderByDesc('sc.student_id')
            ->paginate(2);

        return view("course.pagination", compact('giveScore'))->with('panel_title', 'لیست نمرات شاگردان');
    }

    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $giveScore = \DB::table('student_score as sc')
                ->join('student', 'student.st_id', '=', 'sc.student_id')
                ->join('class', 'class.class_id', '=', 'sc.class_id')
                ->select('student.first_name', 'student.last_name', 'class.class_name', 'sc.midterm_exam', 'sc.final_exam', 'sc.score_id')
                ->where('sc.status', '!=', 1)->orderByDesc('sc.student_id')
                ->paginate(2);

            return view('course.studentScoreList', compact('giveScore'))->with('panel_title', 'لیست نمرات شاگردان');

        }
    }

    public function create(Request $request)
    {

        if ($request->isMethod('get')) {
            $student = \DB::table('student')
                ->select('first_name', 'last_name', 'st_id')
                ->where('status', '!=', 1)
                ->get();

            $class = \DB::table('class as sc')
                ->select('class_name', 'class_id')
                ->where('status', '!=', 1)
                ->get();

            return view('course.giveScoreForm', compact('student', 'class'))->with('panel_title', 'ثبت نمرات شاگردان');
        } else {

            $student_id = $request->input('student_name');
            $class_id = $request->input('class');
            $class_score = $request->input('score');
            $exam_type = $request->input('exam_type');

            $sc = new Score();
            if ($exam_type == 'امتحان نصف کتاب') {

                $sc->student_id = $student_id;
                $sc->class_id = $class_id;
                $sc->midterm_exam = $class_score;
                $sc->final_exam = 0;

                $sc->save();

            } else

                \DB::table('student_score')
                    ->where('final_exam', '=', 0)
                    ->where('student_id', '=', $student_id)
                    ->where('class_id', '=', $class_id)
                    ->update(['final_exam' => ($class_score)]);
        }
        return array(
            'content' => 'content',
            'url' => route('giveScore.create')
        );

    }

    public function delete($id)
    {
        if ($id && ctype_digit($id)) {
            Score::find($id)->update(['status' => 1]);
            return redirect("giveScore");
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $student = Student::all()->where('status', '!=', 1);
            $class = Course::all()->where('status', '!=', 1);
            $score = Score::find($id);

            return view('course.updateStudentScore', compact('student', 'class', 'score'))->with('panel_title', 'ویرایش نمرات شاگردان');
        } else {
            $validator = Validator::make(Input::all(), [
                'student_name' => 'required',
                'class' => 'required ',
                'midterm_score' => 'required ',
                'final_score' => 'required ',

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
                "midterm_exam" => $request->input("midterm_score"),
                "final_exam" => $request->input("final_score"),


            ];


            Score::find($id)->where('score_id', $id)->update($arr);


            return array(
                'content' => 'content',
                'url' => route('giveScore.list')
            );
        }
    }
}
