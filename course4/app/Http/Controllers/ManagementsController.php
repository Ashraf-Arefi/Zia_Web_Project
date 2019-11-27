<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookcourse;
use App\Models\BookStudent;
use App\Models\Course;


use App\Models\CourseStudents;
use App\Models\Student;
use App\Models\Library;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;
use PhpParser\Builder\Class_;

class ManagementsController extends Controller
{
    public function indexClass()
    {
        $course = course::all()->where('status', '!=', 1);
        return view("manage.classAddManagement", compact("course"))->with('panel_title', 'راجسترکردن شاگردن به کلاس ');
    }

    public function classCreate(Request $request)
    {
        $validator = Validator::make(Input::all(), [

            'student_id' => 'required ',
            'class_id' => 'required',
            'class_fees' => 'required ',
            'class_payment' => 'required ',
            'bill_number' => 'required ',
            'class_discount' => 'required '

        ]);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }

        $fees = $request->input("class_fees");
        $payment = $request->input("class_payment");
        $discount = $request->input("class_discount");

        $borrow = ($fees - ($payment + $discount));

        if ($fees >= ($discount + $payment)) {
            $arr = [
                "class_id" => $request->input("class_id"),
                "student_id" => $request->input("student_id"),
                "c_payment" => $payment,
                "c_discount" => $discount,
                "c_borrow" => $borrow,
                "c_date" => Jalalian::fromCarbon(Carbon::now()),

                "bill_number" => $request->input('bill_number'),
                "status" => 0
            ];
            CourseStudents::create($arr);
            return array(
                'content' => 'content',
                'url' => route('management.classList')
            );
        }


    }

    public function classList()
    {
        $st_class = \DB::table('student_class as sc')
            ->join('student', 'student.st_id', '=', 'sc.student_id')
            ->join('class', 'class.class_id', 'sc.class_id')
            ->select('sc.st_cl_id', 'sc.c_payment', 'sc.c_discount', 'sc.c_borrow', 'sc.bill_number', 'sc.c_date',
                'student.first_name', 'class.class_name')
            ->where('sc.status', '!=', '1')->get();
        return view('manage.classAddManagementList', compact('st_class'))->with('panel_title', 'لیست مدیریت کلاس ها و شاگردان');
    }

    public function classUpdate(Request $request, $id)
    {

        $st_class = CourseStudents::find($id);
        $course = Course::all()->where('status', '!=', '1');


        if ($request->isMethod('get')) {
            return view('manage.classAddManagement', compact('st_class', 'course'))->with('panel_title', 'ویرایش مدیریت کلاس ها و شاگردان');

        } else {

            $st_class->bill_number = Input::get('bill_number');
            $st_class->class_id = Input::get('class_id');
            $st_class->student_id = Input::get('student_id');
            $st_class->c_payment = Input::get('class_payment');
            $st_class->c_discount = Input::get('class_discount');
            $st_class->c_borrow = Input::get('class_fees') - Input::get('class_payment');

            $st_class->save();

            return array(
                'content' => 'content',
                'url' => route('management.classList')
            );

        }
    }

    public function classDelete($id)
    {
        if ($id && ctype_digit($id)) {


            \DB::table("student_class")->where("st_cl_id", $id)->delete();

        }
        return redirect('management/classList');
    }

    public function classSearch($id)
    {

        $output = "";
        $courses = Student::where('st_id', 'like', '%' . $id . '%')->get();
        foreach ($courses as $course) {
            $output .= '<tr>' .
                '<td>' . $course->st_id . '</td>' .
                '<td>' . $course->first_name . '</td>' .
                '<td>' . $course->father_name . '</td>' .
                '<td>' . $course->phone .'</td>' .
                '</tr>';
        }
        return $output;

    }

    public function feesChoice($id)
    {
        $fees = \DB::table("class")
            ->where("class_id", $id)->select("fees")->first();
        return ($fees->fees);
    }


    public function barrowclass(Request $request)
    {
        $students = \DB::table('student_class')
            ->join('student', 'student.st_id', '=', 'student_class.student_id')->where("c_borrow", ">", "0")->get();

        if ($request->isMethod("get")) {
            return view("course_barrow.index", compact("students"))->with('panel_title', 'لیست قرض داری های کلاس');
        } else {

            if ($request->input("borrow") >= $request->input("mount")) {
                CourseStudents::where("st_cl_id", $request->input("id"))->update([
                    "c_borrow" => ($request->input("borrow") - $request->input("mount")),
                    "c_payment" => ($request->input("payment") + $request->input("mount"))
                ]);
                return array(
                    'content' => 'content',
                    'url' => route('barrowclass')
                );
            }
        }


    }

    //books part ....
    public function indexBook()
    {
        $book = Book::all()->where('status', "==", 0);
        return view("manage.bookAddManagement", compact("book"))->with('panel_title', 'تحویل کتاب به شاگردان');
    }

    public function bookCreate(Request $request)
    {

        $validator = Validator::make(Input::all(), [

            'student' => 'required ',
            'book_id' => 'required',
            'payment' => 'required ',
            'discount' => 'required ',
            'date' => 'required ',
            'total_payment' => 'required '


        ]);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }

        $total_payment = $request->input("total_payment");
        $payment = $request->input("payment");
        $discount = $request->input("discount");
        $quantity = $request->input("book_number");

        if ($total_payment >= ($discount + $payment)) {
            $arr = [
                "student_id" => $request->input("student"),
                "book_id" => $request->input("book_id"),
                "quantity" => $quantity,
                "payment" => $payment,
                "borrow" => $total_payment - ($payment + $discount),
                "discount" => $discount,
                "date" => $request->input("date"),
                "user_id" => Session::get('user_id'),
                "status" => 0
            ];
            //dd($arr);
            $book_number = $request->input("book_number");
            $libQuantity = \DB::table('library')->select('quantity')
                ->where('book_id', '=', $request->input("book_id"))->first();

            if ($libQuantity->quantity >= $book_number) {

                if (BookStudent::create($arr)) {

                    Library::where('book_id', $request->get('book_id'))->decrement('quantity', $book_number);
                }

                return array(
                    'content' => 'content',
                    'url' => route('management.bookAddManagementList')
                );
            } else {

                return array(
                    'fail' => true,
                    'errors' => "انجام نشد"

                );

            }


        }


    }

    public function bookAddManagementList()
    {

        $book_list = \DB::table('student_book as sb')
            ->join('book', 'book.book_id', '=', 'sb.book_id')
            ->join('student', 'student.st_id', '=', 'sb.student_id')
            ->select('book.book_name', 'student.first_name', 'sb.st_bk_id', 'sb.payment', 'sb.borrow', 'sb.discount', 'sb.quantity', 'sb.date')
            ->where('sb.status', '!=', '1')->get();

        return view('manage.bookAddmanagementList', compact('book_list'))->with('panel_title', 'لیست مدیریت کتاب ها و شاگردان');
    }

    public function bookSearch($id)
    {
        $output = "";
        $courses = Student::where('st_id', 'like', '%' . $id . '%')->get();

        foreach ($courses as $course) {
            $output .= '<tr>' .
                '<td>' . $course->st_id . '</td>' .
                '<td>' . $course->first_name . '</td>' .
                '<td>' . $course->father_name . '</td>' .
                "<td>' . $course->phone. '</td>" .
                '</tr>';
        }
        return $output;


    }

    public function bookPaymentChoice($id)
    {
        $book = \DB::table("book")
            ->select("book_id", "book_price")
            ->where("book_id", $id)->first();
        return ($book->book_price);
    }


    public function barrowbook(Request $request)
    {

        $students = \DB::table('student_book')
            ->join('student', 'student.st_id', '=', 'student_book.student_id')->where("borrow", ">", "0")->get();

        if ($request->isMethod("get")) {
            return view("book_borrow.index", compact("students"))->with('panel_title', 'لیست قرض داری کتاب ها');
        } else {

            if ($request->input("borrow") >= $request->input("mount")) {
                BookStudent::where("st_bk_id", $request->input("id"))->update([
                    "borrow" => ($request->input("borrow") - $request->input("mount")),
                    "payment" => ($request->input("payment") + $request->input("mount"))
                ]);
                return array(
                    'content' => 'content',
                    'url' => route('barrowbook')
                );
            }
        }
    }


    public function barrowBookUpdate(Request $request, $id)
    {

        $student_book = BookStudent::find($id);

        $book = Book::all()->where('status', '!=', '1');

        if ($request->isMethod('get')) {
            return view('manage.bookAddManagement', compact('book', 'student_book'))->with('panel_title', 'ویرایش مدیریت کتاب ها و شاگردان');

        } else {

            $student_book->student_id = Input::get('student');
            $student_book->book_id = Input::get('book_id');
            $student_book->payment = Input::get('payment');
            $student_book->borrow = Input::get('total_payment') - (Input::get('payment') + Input::get('discount'));
            $student_book->discount = Input::get('discount');


            $student_book->save();

            return array(
                'content' => 'content',
                'url' => route('management.bookAddManagementList')
            );

        }

    }

    public function barrowBookDelete($id)
    {

        if ($id && ctype_digit($id)) {


            \DB::table("student_book")->where("st_bk_id", $id)->update(['status' => '1']);

        }
        return redirect('management/bookAddManagementList');
    }

    public function report()
    {
        return view("student.report")->with('panel_title', 'گذارش عواید ');

    }

    public function report_data(Request $request)
    {
        if ($request->ajax()) {

            $output = '';
            $sum = 0;
            $data = array();
            $reason = $request->get('reason');
            $type = $request->get('type');
            $y = $request->get('year_r');
            $m = $request->get('month_r');
            $sd = $request->get('start_date');
            $ed = $request->get('end_date');

            if ($reason === 'class') {


                if ($type === 'day') {

                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }

                    $data = \DB::table('student_class')
                        ->select(\DB::raw('c_payment as py , c_date as d '))
                        ->where('c_date', $jdate)->get();
                    $sum = \DB::table('student_class')
                        ->select(\DB::raw('c_payment'))
                        ->where('c_date', $jdate)
                        ->sum('c_payment');


                } elseif ($type === 'week') {
                    $year = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $month = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $day = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $date = '';
                    if ($month < 10 && $day > 9) {
                        $date = $year . '-0' . $month . '-' . $day;
                    } elseif ($day < 10 && $month > 9) {
                        $date = $year . '-' . $month . '-0' . $day;

                    } elseif ($month < 10 && $day < 10) {
                        $date = $year . '-0' . $month . '-0' . $day;
                    }


                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();

                    $dayofweek = Jalalian::fromCarbon(Carbon::now())->getDayOfWeek();

                    switch ($dayofweek) {
                        case 0:
                            $jday = $jday;
                            break;
                        case 1:
                            $jday = $jday - 1;
                            break;
                        case 2:
                            $jday = $jday - 2;
                            break;
                        case 3:
                            $jday = $jday - 3;
                            break;
                        case 4:
                            $jday = $jday - 4;
                            break;
                        case 5:
                            $jday = $jday - 5;
                            break;
                        case 6:
                            $jday = $jday - 6;
                            break;

                    }
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }

                    $data = \DB::table('student_class')
                        ->select(\DB::raw('c_payment as py , c_date as d'))
                        ->whereBetween('c_date', [$jdate, $date])
                        ->get();

                    $sum = \DB::table('student_class')
                        ->select(\DB::raw('c_payment'))
                        ->whereBetween('c_date', [$jdate, $date])
                        ->sum('c_payment');

                } elseif ($type === 'month') {
                    $jmonth = $request->get('month_r');
                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();

                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $j = Jalalian::fromCarbon(Carbon::now())->getMonthDays();
                    $jmonth_day = (new Jalalian($jyear, $jmonth, $jday))->getMonthDays();


                    $start_month_date = '';
                    if ($jmonth < 10) {
                        $start_month_date = $jyear . '-0' . $jmonth . '-01';
                    } else {
                        $start_month_date = $jyear . '-' . $jmonth . '-01';
                    }
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }


                    $data = \DB::table('student_class')
                        ->select(\DB::raw('c_payment as py , c_date as d'))
                        ->whereBetween('c_date', [$start_month_date, $jdate])
                        ->get();

                    $sum = \DB::table('student_class')
                        ->select(\DB::raw('c_payment'))
                        ->whereBetween('c_date', [$start_month_date, $jdate])->sum("c_payment");

                } elseif ($type === 'year') {

                    $getyear = $request->get('year_r');
                    $yaer_date = explode('/', $getyear);
                    $final_year = $yaer_date[0];
                    $startfrom = $final_year . '-01-01';
                    $end = $final_year . '-12-30';

                    $data = \DB::table('student_class')
                        ->select(\DB::raw('c_payment as py , c_date as d'))
                        ->whereBetween('c_date', [$startfrom, $end])
                        ->get();


                    $sum = \DB::table('student_class')
                        ->select(\DB::raw('c_payment'))
                        ->whereBetween('c_date', [$startfrom, $end])
                        ->sum('c_payment');

                } elseif ($type === 'bt_date') {
                    if ($request->get('start_date') != '') {
                        $start_date = $request->get('start_date');
                        $end_date = $request->get('end_date');
                        $data = \DB::table('student_class')
                            ->select(\DB::raw('c_payment as py , c_date as d'))
                            ->whereBetween('c_date', [$start_date, $end_date])
                            ->get();

                        $sum = \DB::table('student_class')
                            ->select(\DB::raw('c_payment'))
                            ->whereBetween('c_date', [$start_date, $end_date])
                            ->sum('c_payment');
                    }
                }


            } else if ($reason === 'all') {

                if ($type === 'day') {

                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }


                    $sum = \DB::table('student_class')
                        ->select(\DB::raw('c_payment'))
                        ->where('c_date', $jdate)
                        ->sum('c_payment');

                    $sum += \DB::table('student_book')
                        ->select(\DB::raw('payment'))
                        ->where('date', $jdate)
                        ->sum('payment');

                    $sum += \DB::table('student_card')
                        ->select(\DB::raw('payment'))
                        ->where('date', $jdate)
                        ->sum('payment');
                } elseif ($type === 'week') {
                    $year = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $month = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $day = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $date = '';
                    if ($month < 10 && $day > 9) {
                        $date = $year . '-0' . $month . '-' . $day;
                    } elseif ($day < 10 && $month > 9) {
                        $date = $year . '-' . $month . '-0' . $day;

                    } elseif ($month < 10 && $day < 10) {
                        $date = $year . '-0' . $month . '-0' . $day;
                    }


                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();

                    $dayofweek = Jalalian::fromCarbon(Carbon::now())->getDayOfWeek();

                    switch ($dayofweek) {
                        case 0:
                            $jday = $jday;
                            break;
                        case 1:
                            $jday = $jday - 1;
                            break;
                        case 2:
                            $jday = $jday - 2;
                            break;
                        case 3:
                            $jday = $jday - 3;
                            break;
                        case 4:
                            $jday = $jday - 4;
                            break;
                        case 5:
                            $jday = $jday - 5;
                            break;
                        case 6:
                            $jday = $jday - 6;
                            break;

                    }
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }


                    $sum = \DB::table('student_class')
                        ->select(\DB::raw('c_payment'))
                        ->whereBetween('c_date', [$jdate, $date])
                        ->sum('c_payment');
                    $sum += \DB::table('student_book')
                        ->select(\DB::raw('payment'))
                        ->whereBetween('date', [$jdate, $date])
                        ->sum('payment');
                    $sum += \DB::table('student_card')
                        ->select(\DB::raw('payment'))
                        ->whereBetween('date', [$jdate, $date])
                        ->sum('payment');


                } elseif ($type === 'month') {
                    $jmonth = $request->get('month_r');
                    $month = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();

                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $j = Jalalian::fromCarbon(Carbon::now())->getMonthDays();
                    $jmonth_day = (new Jalalian($jyear, $jmonth, $jday))->getMonthDays();


                    $start_month_date = '';
                    if ($jmonth < 10) {
                        $start_month_date = $jyear . '-0' . $jmonth . '-01';
                    } else {
                        $start_month_date = $jyear . '-' . $jmonth . '-01';
                    }
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }


                    $sum = \DB::table('student_class')
                        ->select(\DB::raw('c_payment'))
                        ->whereBetween('c_date', [$start_month_date, $jdate])->sum("c_payment");
                    $sum += \DB::table('student_book')
                        ->select(\DB::raw('payment'))
                        ->whereBetween('date', [$start_month_date, $jdate])->sum('payment');

                    $sum += \DB::table('student_card')
                        ->select(\DB::raw('payment'))
                        ->whereBetween('date', [$start_month_date, $jdate])->sum('payment');
                } elseif ($type === 'year') {

                    $getyear = $request->get('year_r');
                    $yaer_date = explode('/', $getyear);
                    $final_year = $yaer_date[0];
                    $startfrom = $final_year . '-01-01';
                    $end = $final_year . '-12-30';


                    $sum = \DB::table('student_class')
                        ->select(\DB::raw('c_payment'))
                        ->whereBetween('c_date', [$startfrom, $end])
                        ->sum('c_payment');
                    $sum += \DB::table('student_book')
                        ->select(\DB::raw('payment'))
                        ->whereBetween('date', [$startfrom, $end])
                        ->sum('payment');
                    $sum += \DB::table('student_card')
                        ->select(\DB::raw('payment'))
                        ->whereBetween('date', [$startfrom, $end])
                        ->sum('payment');
                } elseif ($type === 'bt_date') {
                    if ($request->get('start_date') != '') {
                        $start_date = $request->get('start_date');
                        $end_date = $request->get('end_date');
                        $data = \DB::table('student_class')
                            ->select(\DB::raw('c_payment as py , c_date as d'))
                            ->whereBetween('c_date', [$start_date, $end_date])
                            ->get();

                        $sum = \DB::table('student_class')
                            ->select(\DB::raw('c_payment'))
                            ->whereBetween('c_date', [$start_date, $end_date])
                            ->sum('c_payment');

                        $sum += \DB::table('student_book')
                            ->select(\DB::raw('payment'))
                            ->whereBetween('date', [$start_date, $end_date])
                            ->sum('payment');
                        $sum += \DB::table('student_card')
                            ->select(\DB::raw('payment'))
                            ->whereBetween('date', [$start_date, $end_date])
                            ->sum('payment');
                    }
                }
            } //book get reports...
            else if ($reason === 'book') {

                if ($type === 'day') {

                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }

                    $data = \DB::table('student_book')
                        ->select(\DB::raw('payment as py , date as d'))
                        ->where('date', $jdate)->get();

                    $sum = \DB::table('student_book')
                        ->select(\DB::raw('payment'))
                        ->where('date', $jdate)
                        ->sum('payment');


                } elseif ($type === 'week') {
                    $year = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $month = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $day = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $date = '';
                    if ($month < 10 && $day > 9) {
                        $date = $year . '-0' . $month . '-' . $day;
                    } elseif ($day < 10 && $month > 9) {
                        $date = $year . '-' . $month . '-0' . $day;

                    } elseif ($month < 10 && $day < 10) {
                        $date = $year . '-0' . $month . '-0' . $day;
                    }


                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();

                    $dayofweek = Jalalian::fromCarbon(Carbon::now())->getDayOfWeek();

                    switch ($dayofweek) {
                        case 0:
                            $jday = $jday;
                            break;
                        case 1:
                            $jday = $jday - 1;
                            break;
                        case 2:
                            $jday = $jday - 2;
                            break;
                        case 3:
                            $jday = $jday - 3;
                            break;
                        case 4:
                            $jday = $jday - 4;
                            break;
                        case 5:
                            $jday = $jday - 5;
                            break;
                        case 6:
                            $jday = $jday - 6;
                            break;

                    }
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }

//                    DB::raw('count(*) as user_count, status')
                    $data = \DB::table('student_book')
                        ->select(\DB::raw('payment as py , date as d'))
                        ->whereBetween('date', [$jdate, $date])
                        ->get();
                    $sum = \DB::table('student_book')
                        ->select(\DB::raw('payment'))
                        ->whereBetween('date', [$jdate, $date])
                        ->sum('payment');


                } elseif ($type === 'month') {
                    $jmonth = $request->get('month_r');
                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();

                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $j = Jalalian::fromCarbon(Carbon::now())->getMonthDays();
                    $jmonth_day = (new Jalalian($jyear, $jmonth, $jday))->getMonthDays();


                    $start_month_date = '';
                    if ($jmonth < 10) {
                        $start_month_date = $jyear . '-0' . $jmonth . '-01';
                    } else {
                        $start_month_date = $jyear . '-' . $jmonth . '-01';
                    }
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }

                    $data = \DB::table('student_book')
                        ->select(\DB::raw('payment as py , date as d'))
                        ->whereBetween('date', [$start_month_date, $jdate])
                        ->get();

                    $sum = \DB::table('student_book')
                        ->select(\DB::raw('payment'))
                        ->whereBetween('date', [$start_month_date, $jdate])->sum('payment');

                } elseif ($type === 'year') {

                    $getyear = $request->get('year_r');
                    $yaer_date = explode('/', $getyear);
                    $final_year = $yaer_date[0];
                    $startfrom = $final_year . '-01-01';
                    $end = $final_year . '-12-30';

                    $data = \DB::table('student_book')
                        ->select(\DB::raw('payment as py , date as d'))
                        ->whereBetween('date', [$startfrom, $end])
                        ->get();

                    $sum = \DB::table('student_book')
                        ->select(\DB::raw('payment'))
                        ->whereBetween('date', [$startfrom, $end])
                        ->sum('payment');

                } elseif ($type === 'bt_date') {
                    if ($request->get('start_date') != '') {
                        $start_date = $request->get('start_date');
                        $end_date = $request->get('end_date');
                        $data = \DB::table('student_book')
                            ->select(\DB::raw('payment as py ,  date as d'))
                            ->whereBetween('date', [$start_date, $end_date])
                            ->get();

                        $sum = \DB::table('student_book')
                            ->select(\DB::raw('payment'))
                            ->whereBetween('date', [$start_date, $end_date])
                            ->sum('payment');

                    }
                }

            } //get card report
            else if ($reason === 'card') {

                if ($type === 'day') {

                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }

                    $data = \DB::table('student_card')
                        ->select(\DB::raw('payment as py , date as d'))
                        ->where('date', $jdate)->get();

                    $sum = \DB::table('student_card')
                        ->select(\DB::raw('payment'))
                        ->where('date', $jdate)
                        ->sum('payment');


                } elseif ($type === 'week') {
                    $year = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $month = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $day = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $date = '';
                    if ($month < 10 && $day > 9) {
                        $date = $year . '-0' . $month . '-' . $day;
                    } elseif ($day < 10 && $month > 9) {
                        $date = $year . '-' . $month . '-0' . $day;

                    } elseif ($month < 10 && $day < 10) {
                        $date = $year . '-0' . $month . '-0' . $day;
                    }


                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();

                    $dayofweek = Jalalian::fromCarbon(Carbon::now())->getDayOfWeek();

                    switch ($dayofweek) {
                        case 0:
                            $jday = $jday;
                            break;
                        case 1:
                            $jday = $jday - 1;
                            break;
                        case 2:
                            $jday = $jday - 2;
                            break;
                        case 3:
                            $jday = $jday - 3;
                            break;
                        case 4:
                            $jday = $jday - 4;
                            break;
                        case 5:
                            $jday = $jday - 5;
                            break;
                        case 6:
                            $jday = $jday - 6;
                            break;

                    }
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }

//                    DB::raw('count(*) as user_count, status')
                    $data = \DB::table('student_card')
                        ->select(\DB::raw('payment as py , date as d'))
                        ->whereBetween('date', [$jdate, $date])
                        ->get();
                    $sum = \DB::table('student_card')
                        ->select(\DB::raw('payment'))
                        ->whereBetween('date', [$jdate, $date])
                        ->sum('payment');


                } elseif ($type === 'month') {
                    $jmonth = $request->get('month_r');
                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();

                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $j = Jalalian::fromCarbon(Carbon::now())->getMonthDays();
                    $jmonth_day = (new Jalalian($jyear, $jmonth, $jday))->getMonthDays();


                    $start_month_date = '';
                    if ($jmonth < 10) {
                        $start_month_date = $jyear . '-0' . $jmonth . '-01';
                    } else {
                        $start_month_date = $jyear . '-' . $jmonth . '-01';
                    }
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }

                    $data = \DB::table('student_card')
                        ->select(\DB::raw('payment as py , date as d'))
                        ->whereBetween('date', [$start_month_date, $jdate])
                        ->get();

                    $sum = \DB::table('student_card')
                        ->select(\DB::raw('payment'))
                        ->whereBetween('date', [$start_month_date, $jdate])->sum('payment');

                } elseif ($type === 'year') {

                    $getyear = $request->get('year_r');
                    $yaer_date = explode('/', $getyear);
                    $final_year = $yaer_date[0];
                    $startfrom = $final_year . '-01-01';
                    $end = $final_year . '-12-30';

                    $data = \DB::table('student_card')
                        ->select(\DB::raw('payment as py , date as d'))
                        ->whereBetween('date', [$startfrom, $end])
                        ->get();

                    $sum = \DB::table('student_card')
                        ->select(\DB::raw('payment'))
                        ->whereBetween('date', [$startfrom, $end])
                        ->sum('payment');

                } elseif ($type === 'bt_date') {
                    if ($request->get('start_date') != '') {
                        $start_date = $request->get('start_date');
                        $end_date = $request->get('end_date');
                        $data = \DB::table('student_card')
                            ->select(\DB::raw('payment as py ,  date as d'))
                            ->whereBetween('date', [$start_date, $end_date])
                            ->get();

                        $sum = \DB::table('student_card')
                            ->select(\DB::raw('payment'))
                            ->whereBetween('date', [$start_date, $end_date])
                            ->sum('payment');

                    }
                }

            }

            $reu = $this->dataHtmlFormat($reason, $data, $sum);
            return response()->json($reu);


        }

    }

    public function dataHtmlFormat($reason, $data, $sum)
    {
        $output = "";
        $total_row = 0;
        if ($reason == 'all') {

            $output .= '
                <tr>
                    <td><span style="font-weight: bolder"> مجموع:</span></td>
                    <td><span style="font-weight: bolder"> ' . $sum . '</span></td>
                </tr>
                ';


        } else {

            if (count($data) > 0) {
                foreach ($data as $row) {
                    $output .= '
                                    <tr>
                                        <td>' . $row->py . '</td>
                                        <td>' . $row->d . '</td>
                                     </tr>
                                     ';
                }

                $output .= '
                <tr>
                    <td><span style="font-weight: bolder"> مجموع:</span></td>
                    <td><span style="font-weight: bolder"> ' . $sum . '</span></td>
                </tr>
                ';


            } else {
                $output = '
                               <tr>
                                 <td align="center" colspan="5">No Data Found</td>
                               </tr>';
            }
        }
        $data = array(
            'table_data' => $output,
            'total_data' => $total_row
        );

        //echo json_encode($data);
        return $data;

    }


}
