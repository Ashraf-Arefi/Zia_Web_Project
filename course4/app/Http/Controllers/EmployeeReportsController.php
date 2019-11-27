<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SalaryPayment;
use App\Models\PercentageSalaryPayment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpParser\Builder\Class_;

class EmployeeReportsController extends Controller
{
    //this method show the employee borrow in a list from salary payment table
    public function index(){

        $salary = SalaryPayment::select('payment_id', 'payment_amount', 'payment_borrow', 'payment_date','payment_month','salary', 'first_name')
            ->Join('employee', 'employee.employee_id', '=', 'salary_payment.employee_id')
            ->where('payment_borrow', '>',0)->get();

        return view('employeereport.index',compact('salary'))->with(['panel_title'=>'پرداخت باقیات معاش کارمندان']);

    }

//this method insert static employee salary to salary payment table
    public function create(Request $request)
    {
        $course = Course::all()->where('status','!=',1);

        $employee = Employee::select('employee_id', 'salary', 'first_name','last_name')
            ->where('status', '==',0)
            ->where('salary_type','=','ثابت')
            ->get();

        $percentageEmployee = Employee::select('employee_id', 'salary', 'first_name','last_name')
            ->where('status', '==',0)
            ->where('salary_type','=','فیصدی')
            ->get();

        $hourlyEmployee = Employee::select('employee_id', 'salary', 'first_name','last_name')
            ->where('status', '==',0)
            ->where('salary_type','=','ساعتی')
            ->get();


        if ($request->isMethod('get'))
            return view('employeereport.form', compact('employee','percentageEmployee','hourlyEmployee','course'))->with('panel_title','پرداخت معاش کارمندان');
        else {

            //$empSalary = Input::get('salary');
            $validator = Validator::make(Input::all(), array(

                'employee_id' => 'required',
                'payment_amount' => 'required',
                'payment_month' => 'required',
                'payment_date' => 'required |min:1'

            ));
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            } else {

                $sp = new SalaryPayment();
                $sp->employee_id = Input::get('employee_id');
                $sp->payment_amount = Input::get('payment_amount');
                $sp->payment_borrow = (Input::get('salary') - Input::get('payment_amount'));
                $sp->payment_date = Input::get('payment_date');
                $sp->payment_month = Input::get('payment_month');
                $sp->user_id = Session::get('user_id');

                $sp->save();
                return array(
                    'content' => 'content',
                    'url' => route('employeereport.show_payed_salary')
                );
            }
        }

    }

//this method update salary payment table
    public function update(Request $request,$id){
        $salary=SalaryPayment::find($id);

        $employee = Employee::all()->where('status', '!=',1);


        if($request->isMethod('get'))

            return view('employeereport.update',compact('salary','employee'))->with(['panel_title'=>'ویرایش پرداخت معاش کارمند']);
        else {

            $validator = Validator::make(Input::all(), [

                'employee_id' => 'required',
                'payment_amount' => 'required',
                'payment_month' => 'required',
                'payment_date' => 'required'
            ]);
            if ($validator->fails()) {

                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }
            if ($request->get('id')) {
                $data = [
                    'payment_date' => $request->get('payment_date'),
                    'payment_month' => $request->get('payment_month'),
                    'payment_amount' => $request->get('payment_amount'),

                    'employee_id' => $request->get('employee_id'),
                    'user_id' => Session::get('user_id')

                ];

                SalaryPayment::find($request->get('id'))->where('payment_id', $request->get('id'))->update($data);

                return array(
                    'content' => 'content',
                    'url' => route('employeereport.list')
                );
            }
        }
    }
    //delete data from salary payment table
    public function delete($id)
    {
        if ($id && ctype_digit($id)) {
            SalaryPayment::find($id)->update(['status' => 1]);
            return redirect("employeereport/showPayedSalary");
        }
    }
//this method insert hourly salary to salary payment table
    public function hourlySalaryCreate(Request $request)
    {


        if ($request->isMethod('get'))
            return view('employeereport.form')->with('panel_title','پرداخت معاش کارمندان');
        else {

            //$empSalary = Input::get('salary');
            $validator = Validator::make(Input::all(), array(

                'h_employee_id' => 'required',
                'hour' => 'required',
                'present_day' => 'required',
                'h_total_salary' => 'required',
                'h_payment_amount' => 'required',
                'h_payment_month' => 'required',
                'h_payment_date' => 'required'

            ));
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            } else {

                $sp = new SalaryPayment();
                $sp->employee_id = Input::get('h_employee_id');
                $sp->payment_amount = Input::get('h_payment_amount');
                $sp->payment_borrow = (Input::get('h_total_salary') - Input::get('h_payment_amount'));
                $sp->payment_date = Input::get('h_payment_date');
                $sp->payment_month = Input::get('h_payment_month');
                $sp->user_id = Session::get('user_id');

                $sp->save();
                return array(
                    'content' => 'content',
                    'url' => route('employeereport.show_payed_salary')
                );
            }
        }

    }

    //this method read payed salary in list
    public function showPayedSalary()
    {
        $salary = SalaryPayment::select('payment_id', 'payment_amount','payment_borrow', 'payment_date','payment_month','salary', 'first_name','last_name')
            ->Join('employee', 'employee.employee_id', '=', 'salary_payment.employee_id')
            ->where('salary_payment.status', '==',0)->get();

        return view('employeereport.show_payed_salary',compact('salary'))->with(['panel_title'=>'لیست پرداخت معاشات کارمندان']);

    }

    //this method pay the reminded salary
    public function payment(Request $request,$id)
    {
        $salary=SalaryPayment::find($id);
        $employee = Employee::find($salary->employee_id);
        if($request->isMethod('get'))

            return view('employeereport.payment_form',compact('salary','employee'))->with(['panel_title'=>'پرداخت باقی معاش کارمند']);
        else{

            $validator=Validator::make(Input::all(),[
                'id' => 'required',
                'payment_amount' => 'required|min:1',
                'payment_month' => 'required',
                'payment_date' => 'required'
            ]);
            if($validator->fails()){

                return array(
                    'fail'=>true,
                    'errors'=>$validator->getMessageBag()->toArray()
                );
            }

            if (ctype_digit($request->get('id'))) {
                $payment = Input::get('payment_amount');
                if ($payment <= $salary->payment_borrow) {

                    $data = [
                        'payment_date' => $request->get('payment_date'),
                        'payment_month' => $request->get('payment_month'),
                        'payment_amount' => ($salary->payment_amount + $payment),
                        'payment_borrow' => ($salary->payment_borrow - $payment),
                        'user_id' => Session::get('user_id')

                    ];

                    SalaryPayment::find($request->get('id'))->where('payment_id', $request->get('id'))->update($data);

                    return array(
                        'content' => 'content',
                        'url' => route('employeereport.list')
                    );
                }
                else{

                }

            }

        }
    }

    //this method get static  employee salary from employee table
    public function getSalary($id)
    {
        $employee = \DB::table("employee")
            ->select("employee_id","salary")
            ->where("employee_id",$id)->first();
        return ($employee ->salary);
    }
    //this method get hourly  employee salary from employee table
    public function getHourlySalary($id)
    {
        $employee = \DB::table("employee")
            ->select("employee_id","salary")
            ->where("employee_id",$id)->first();
        return ($employee ->salary);
    }
//this method return teachers and class information to ajax function
    public function teachersPercentage($id)
    {
        $output = "";
        $c_payment = \DB::table('student_class as sc')
            ->join('class','class.class_id','=','sc.class_id')
            ->where('sc.class_id','=',$id)
            ->sum('c_payment');


        $c_discount = \DB::table('student_class as sc')
            ->join('class','class.class_id','=','sc.class_id')
            ->where('sc.class_id','=',$id)
            ->sum('c_discount');


        $c_borrow = \DB::table('student_class as sc')
            ->join('class','class.class_id','=','sc.class_id')
            ->where('sc.class_id','=',$id)
            ->sum('c_borrow');

        $course_percentage = \DB::table('student_class as sc')
            ->join('class','class.class_id','=','sc.class_id')
            ->where('class.class_id','=',$id)
            ->select('course_percentage')->get();


       
        $total = ($c_payment/100)*($course_percentage[0]->course_percentage) -($c_discount+$c_borrow);
        $total_payment = $c_payment -($c_discount+$c_borrow);


        $percentage = \DB::table('class_teacher as ct')
            ->join('class','class.class_id','=','ct.class_id')
            ->join('employee','employee.employee_id','ct.teacher_id')
            ->where('class.class_id', '=', $id)
            ->sum('employee.salary');



        $courses = \DB::table('class_teacher as ct')
            ->join('class','class.class_id','=','ct.class_id')
            ->join('employee','employee.employee_id','ct.teacher_id')
            ->select('employee.first_name','employee.last_name','class.class_name','employee.salary','ct.teacher_id as ctid')
            ->where('class.class_id', '=', $id)
            ->get();

        foreach ($courses as $key=>$course) {
            $output .= '<tr>' .
                '<td>' . ++$key . '</td>' .
                '<td>' . $course->first_name . ' ' . $course->last_name . '</td>' .
                '<td>' . $course->class_name . '</td>' .
                '<td>' . $course->salary . '</td>' .
                '<td>' . ($total_payment - $total) * $course->salary / $percentage . '</td>' .
                '</tr>';
        }
        //this section send teachers who related to selected class
        $teacher_id = "<option value=''>انتخاب کار مند</option>";

        foreach ($courses as $key=>$course) {
            $teacher_id .= '<option salary="' . ($total_payment-$total)*$course->salary/$percentage .'" id="'. $course->ctid . '" value="'.$course->ctid.'">' . $course->first_name . ' ' . $course->last_name . '</option>';
        }


        return array(

            "output" => $output,
            "teacher_id" => $teacher_id

        );
    }



    //this method get data from salary_payment table for paying the borrow
    public  function  getdata(Request  $request){
        $em=SalaryPayment::select('payment_amount','payment_borrow','payment_date')
            ->where('payment_date',$request->id)
            ->where('employee_id',$request->employeeId)->get();
        return response()->json($em);
    }

    //this method show percentage employee borrow in a list
    public function percentageBorrowList()
    {
        $pBorrow = \DB::table('percentage_salary_payment as psp')
            ->join('class','class.class_id','=','psp.class_id')
            ->join('employee','employee.employee_id','psp.employee_id')
            ->select('employee.first_name','employee.last_name','class.class_name','psp.payment_amount','psp.payment_borrow','psp.payment_date','psp.payment_month','psp.percentage_salary_payment_id as psp_id')
            ->where('psp.payment_borrow', '>', 0)
            ->where('psp.status', '!=', 1)
            ->get();

        return view('employeereport.percentageBorrowList',compact('pBorrow'))->with('panel_title','پرداخت باقیات معاش کارمندان');
    }
    //this method show percentage employee payed salary in a list
    public function showPayedPercentageSalary()
    {
        $pPayed = \DB::table('percentage_salary_payment as psp')
            ->join('class','class.class_id','=','psp.class_id')
            ->join('employee','employee.employee_id','psp.employee_id')
            ->select('employee.first_name','employee.last_name','class.class_name','psp.payment_amount','psp.payment_borrow','psp.payment_date','psp.payment_month','psp.percentage_salary_payment_id as psp_id')
            ->where('psp.payment_borrow', '=', 0)
            ->where('psp.status', '!=', 1)
            ->get();
        return view('employeereport.percentagePayedSalary',compact('pPayed'))->with('panel_title','لیست پرداخت معاشات کارمندان');

    }
    //this method pay the percentage employee reminded salary
    public function PayBorrow(Request $request)
    {
        $shop_pay = PercentageSalaryPayment::all()->where('status','!=',1);

        if ($request->isMethod('get')) {

            return view('customer.paybarrowform', compact( 'shop_pay'))->with(['panel_title' => 'ویرایش کرایه های باقی مانده']);
        }

        else {

            if ( $request->input("employee_salary") >=  ($request->input("payment") + $request->input("borrow")) ) {
                PercentageSalaryPayment::where("percentage_salary_payment_id", $request->input("employee_id"))->update([
                    "payment_borrow" => ($request->input("borrow") - $request->input("payment_amount")),
                    "payment_amount" => ($request->input("payment") + $request->input("payment_amount"))


                ]);
                return array(
                    'content' => 'content',
                    'url' => route('employeereport.percentageBorrowList')
                );

            }
        }

    }
    //this method insert data into percentage salary payment table
    public function percentageSalaryCreate(Request $request)
    {
        if ($request->isMethod('get'))
            return view('employeereport.form')->with('panel_title','پرداخت معاش کارمندان');
        else {

            //$empSalary = Input::get('salary');
            $validator = Validator::make(Input::all(), array(

                'p_class_id' => 'required',
                'p_employee_id' => 'required',
                'p_payment_amount' => 'required',
                'p_payment_month' => 'required',
                'p_payment_date' => 'required',


            ));
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            } else {

                $p = new PercentageSalaryPayment();
                $p->class_id = Input::get('p_class_id');
                $p->employee_id = Input::get('p_employee_id');
                $p->payment_amount = Input::get('p_payment_amount');
                $p->payment_borrow = (Input::get('salary_this_teacher')-Input::get('p_payment_amount'));
                $p->payment_date = Input::get('p_payment_date');
                $p->payment_month = Input::get('p_payment_month');
                $p->user_id = Session::get('user_id');

                $p->save();
                return array(
                    'content' => 'content',
                    'url' => route('employeereport.show_payed_salary')
                );
            }
        }

    }
    //this method edit percentage employee salary payment
    public function percentageSalaryUpdate(Request $request,$id)
    {
        $percentageSalary = PercentageSalaryPayment::find($id);
        $employee = Employee::select('employee_id','first_name','last_name')
            ->where('salary_type','=','فیصدی')
            ->where('status','!=',1)
            ->get();

        $class = Course::select('class_id','class_name')
            ->where('status','!=',1)
            ->get();

        if ($request->isMethod('get'))
            return view('employeereport.updatePercentageSalary',compact('percentageSalary','employee','class'))->with('panel_title','ویرایش معاش کارمندان(فیصدی)');
        else {

            //$empSalary = Input::get('salary');
            $validator = Validator::make(Input::all(), array(

                'p_class_id' => 'required',
                'p_employee_id' => 'required',
                'p_payment_amount' => 'required',
                'p_payment_month' => 'required',
                'p_payment_date' => 'required',


            ));
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            } else {


                $percentageSalary->class_id = Input::get('p_class_id');
                $percentageSalary->employee_id = Input::get('p_employee_id');
                $percentageSalary->payment_amount = Input::get('p_payment_amount');
                $percentageSalary->payment_borrow = (Input::get('p_percentage')-Input::get('p_payment_amount'));
                $percentageSalary->payment_date = Input::get('p_payment_date');
                $percentageSalary->payment_month = Input::get('p_payment_month');
                $percentageSalary->user_id = Session::get('user_id');

                $percentageSalary->save();
                return array(
                    'content' => 'content',
                    'url' => route('employeereport.showPayedPercentageSalary')
                );
            }
        }
    }

    public function percentageSalaryDelete($id)
    {
        if ($id && ctype_digit($id)) {
            PercentageSalaryPayment::find($id)->update(['status' => 1]);
            return redirect("employeereport/showPayedPercentageSalary");
        }
    }


}
