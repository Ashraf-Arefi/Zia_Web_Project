<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SalaryPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Request $request){

        $salary = SalaryPayment::select('payment_id', 'payment_amount', 'payment_borrow', 'payment_date','salary','salary_type', 'first_name')
            ->Join('employee', 'employee.employee_id', '=', 'salary_payment.employee_id')
            ->where('payment_borrow', '>',0)->get();

        return view('employeereport.index',compact('salary'))->with(['panel_title'=>'پرداخت معاش کارمندان']);

    }
    public function create(Request $request)
    {
        $employee = Employee::all()->
            where('status','==',0);

        if ($request->isMethod('get'))
            return view('employeereport.form', compact('employee'));
        else {
            $validator = Validator::make(Input::all(), [

                'payment_amount' => 'required',
                'payment_month' => 'required',
                'payment_date' => 'required'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            } else {

                $sp = new SalaryPayment();
                $sp->payment_date = Input::get('payment_date');
                $sp->payment_amount = Input::get('payment_amount');
                $sp->payment_borrow = 0;
                $sp->employee_id = Input::get('employee_id');
                $sp->user_id = Session::get('user_id');

                $sp->save();
                return array(
                    'content' => 'content',
                    'url' => route('expense.list')
                );

            }


        }
    }


    public function update(Request $request,$id){
        $employee=Employee::find($id);
        $salary=SalaryPayment::find($id);
        if($request->isMethod('get'))

            return view('employeereport.form',compact('salary','employee'))->with(['panel_title'=>'']);
        else{

            $validator=Validator::make(Input::all(),[

            ]);
            if($validator->fails()){

                return array(
                    'fail'=>true,
                    'errors'=>$validator->getMessageBag()->toArray()
                );
            }

            $bar= $salary->payment_amount=Input::get('payment_amount');

            $salary->decrement('payment_borrow',$bar);
            $salary->increment('payment_amount',$bar);
            $salary->save();
            return array(

                'content'=>'content',
                'url'=>route('company.list')
            );
            Session::put('msg_status', true);

        }
    }
    public function delete($id)
    {
        $company=Employee::ٍfind($id);
        $company->status=0;
        $company->save();
        return redirect()->route('employee.list');

    }

    public  function  getdata(Request  $request){
        $em=SalaryPayment::select('payment_amount','payment_borrow','payment_date') ->where('payment_date',$request->id)
            ->where('employee_id',$request->employeeId)->get();
        return response()->json($em);
    }
}
