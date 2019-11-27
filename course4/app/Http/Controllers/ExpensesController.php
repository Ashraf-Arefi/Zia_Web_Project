<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Expense;
use App\Models\Reason_Pay;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\Facades\DataTables;

class ExpensesController extends Controller
{


    public function index()
    {
        $expenses = Expense::select("expense_id", "title", "amount", "pay_date", "currency", "description", "first_name", "last_name")
            ->join('expense_reason', 'expense_reason.expense_reason_id', '=', 'expense.expense_reason_id')
            ->join('employee', 'employee.employee_id', '=', 'expense.employee_id')
            ->where("expense.status", "!=", "1")->get();

        return view('expense.index', compact('expenses'))->with('panel_title', 'لیست مصارف');
    }

    public function create(Request $request)
    {
        $reasons = Reason_Pay::all()->where('status', '!=', 1);
        $employees = Employee::select('first_name', 'last_name', 'phone', 'employee_id')->where('status', '!=', 1)->get();

        if ($request->isMethod('get'))
            return view('expense.form', compact('reasons', 'employees'))->with('panel_title', 'ثبت مصارف ');
        else {

            $validator = Validator::make(Input::all(), [
                'title' => 'required',
                'amount' => 'required',
                'currency' => 'required',
                'pay_date' => 'required'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            } else {


                $ex = new Expense();
                $ex->expense_reason_id = Input::get('title');
                $ex->description = Input::get('description');
                $ex->amount = Input::get('amount');
                $ex->currency = Input::get('currency');
                $ex->pay_date = Input::get('pay_date');
                $ex->employee_id = Input::get('employee');
                $ex->user_id = Session::get('user_id');
                $ex->save();
                return array(
                    'content' => 'content',
                    'url' => route('expense.list')
                );

            }
        }
    }


    public function update(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $expense = Expense::find($id);
            $reasons = Reason_Pay::all();
            $employees = Employee::select('employee_id', 'first_name', 'last_name')
                ->where('status', '!=', 1)->get();
            return view('expense.form', compact('expense', 'reasons', 'employees'))->with('panel_title', 'ویرایش مصرف ');

        } else {
            $validator = Validator::make(Input::all(), [
                'title' => 'required',
                'amount' => 'required',
                'currency' => 'required',
                'pay_date' => 'required'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }
            $ex = Expense::find($id);
            $ex->expense_reason_id = Input::get('title');
            $ex->description = Input::get('description');
            $ex->amount = Input::get('amount');
            $ex->currency = Input::get('currency');
            $ex->pay_date = Input::get('pay_date');
            $ex->employee_id = Input::get('employee');;
            $ex->user_id = Session::get('user_id');
            $ex->save();
            return array(
                'content' => 'content',
                'url' => route('expense.list')
            );
            //Session::put('msg_status', true);
        }
    }

    public function delete($id)
    {
        if ($id && ctype_digit($id)) {
            Expense::find($id)->where('expense_id', $id)->update(['status' => 1]);
            return redirect('expense');
        }

    }

    public function report()
    {
        $reason_pays = Reason_Pay::all();
        return view('expense.report', compact('reason_pays'))->with('panel_title', 'گذارشات مصارف به زمانهای مختلف');

    }

    public function report_data(Request $request)
    {
        if ($request->ajax()) {

            $final_sum = 0.0;
            $final_data = array();

            $output = '';
            $reason = $request->get('reason');
            $type = $request->get('type');
            $y = $request->get('year');


            // reason_pay
            if ($reason === 'all') {

                if ($type === 'day') {

                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();

                    $date = '';
                    if (intval($jmonth )< 10 && intval($jday )> 9) {
                        $date= $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif (intval($jday) < 10 && intval($jmonth )> 9) {
                        $date = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif (intval($jmonth) < 10 && intval($jday) < 10) {
                        $date = $jyear . '-0' . $jmonth . '-0' . $jday;
                    }

                    $data = DB::table('expense')
                        ->select('amount', 'currency', 'pay_date')
                        ->where('pay_date', $date)
                        ->get();

                    $sum = DB::table('expense')
                        ->where('pa y_date', $date)
                        ->sum('amount');

                    $final_sum = $sum;
                    $final_data = $data;

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


                    $data = DB::table('expense')
                        ->select('amount', 'currency', 'pay_date')
                        ->whereBetween('pay_date', [$jdate, $date])
                        ->get();


                    $sum = DB::table('expense')
                        ->whereBetween('pay_date', [$jdate, $date])
                        ->sum('amount');

                    $final_data = $data;
                    $final_sum = $sum;
                }
                elseif ($type === 'month') {
                    $jmonth = $request->get('month_r');
                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();

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
                    $data = \DB::table('expense')
                        ->select('amount', 'currency', 'pay_date')
                        ->whereBetween('pay_date', [$start_month_date, $jdate])
                        ->get();


                    $sum = \DB::table('expense')
                        ->whereBetween('pay_date', [$start_month_date, $jdate])
                        ->sum('amount');
                    $final_data = $data;
                    $final_sum = $sum;

                } elseif ($type === 'year') {

                    $getyear = $request->get('year_r');
                    $yaer_date = explode('/', $getyear);
                    $final_year = $yaer_date[0];
                    $startfrom = $final_year . '-01-01';
                    $end = $final_year . '-12-30';
                    $data = \DB::table('expense')
                        ->select('amount', 'currency', 'pay_date')
                        ->whereBetween('pay_date', [$startfrom, $end])
                        ->get();

                    $sum = \DB::table('expense')
                        ->whereBetween('pay_date', [$startfrom, $end])
                        ->sum('amount');
                    $final_data = $data;
                    $final_sum = $sum;

                } elseif ($type === 'bt_date') {
                    if ($request->get('start_date') != '') {
                        $start_date = $request->get('start_date');
                        $end_date = $request->get('end_date');
                        $data = DB::table('expense')
                            ->select('amount', 'currency', 'pay_date')
                            ->whereBetween('pay_date', [$start_date, $end_date])
                            ->get();

                        $sum = DB::table('expense')
                            ->whereBetween('pay_date', [$start_date, $end_date])
                            ->sum('amount');
                        $final_data = $data;
                        $final_sum = $sum;

                    }

                }


                $total_row = count($final_data);

                $dataOut = array(
                    'table_data' => $final_data,
                    'total_data' => $total_row,
                    'sum' => $final_sum
                );

                //echo json_encode($data);
                return response()->json($dataOut);


            }//after all expense data
            else {
                if (ctype_digit($reason)) {

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

                        $data = DB::table('expense')
                            ->select('amount', 'currency', 'pay_date')
                            ->where('expense_reason_id', $reason)
                            ->where('pay_date', $jdate)
                            ->get();


                        $sum = DB::table('expense')
                            ->where('expense_reason_id', $reason)
                            ->where('pay_date', $jdate)
                            ->sum('amount');


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


                        $data = DB::table('expense')
                            ->select('amount', 'currency', 'pay_date')
                            ->whereBetween('pay_date', [$jdate, $date])
                            ->where('expense_reason_id', $reason)
                            ->get();


                        $sum = DB::table('expense')
                            ->whereBetween('pay_date', [$jdate, $date])
                            ->where('expense_reason_id', $reason)
                            ->sum('amount');


                    } elseif ($type === 'month') {
                        $get_month = $request->get('month_r');
                        if (ctype_digit($get_month)) {
                            $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                            $jmonth = $get_month;
                            $jday = '1';
                            $start_date = '';
                            if ($jmonth < 10 && $jday > 9) {
                                $start_date = $jyear . '-0' . $jmonth . '-' . $jday;
                            } elseif ($jday < 10 && $jmonth > 9) {
                                $start_date = $jyear . '-' . $jmonth . '-0' . $jday;

                            } elseif ($jmonth < 10 && $jday < 10) {
                                $start_date = $jyear . '-0' . $jmonth . '-0' . $jday;
                            }
                            // end date
                            $end_date = '';
                            $end_day = '30';
                            if ($jmonth < 10 && $end_day > 9) {
                                $end_date = $jyear . '-0' . $jmonth . '-' . $end_day;
                            } elseif ($end_day < 10 && $jmonth > 9) {
                                $end_date = $jyear . '-' . $jmonth . '-0' . $end_day;

                            } elseif ($jmonth < 10 && $end_day < 10) {
                                $end_date = $jyear . '-0' . $jmonth . '-0' . $end_day;
                            }

                            $data = DB::table('expense')
                                ->select('amount', 'currency', 'pay_date')
                                ->where('expense_reason_id', $reason)
                                ->whereBetween('pay_date', [$start_date, $end_date])
                                ->get();


                            $sum = DB::table('expense')
                                ->where('expense_reason_id', $reason)
                                ->whereBetween('pay_date', [$start_date, $end_date])
                                ->sum('amount');


                        } elseif ($type === 'year') {

                            $getyear = $request->get('year_r');
                            $yaer_date = explode('/', $getyear);
                            $final_year = $yaer_date[0];
                            $startfrom = $final_year . '-01-01';
                            $end = $final_year . '-12-30';
                            $data = DB::table('expense')
                                ->select('amount', 'currency', 'pay_date')
                                ->where('expense_reason_id', $reason)
                                ->whereBetween('pay_date', [$startfrom, $end])
                                ->get();


                            $sum = DB::table('expense')
                                ->where('expense_reason_id', $reason)
                                ->whereBetween('pay_date', [$startfrom, $end])
                                ->sum('amount');


                        } elseif ($type === 'bt_date') {
                            if ($request->get('start_date') != '') {
                                $start_date = $request->get('start_date');
                                $end_date = $request->get('end_date');
                                $data = DB::table('expense')
                                    ->select('amount', 'currency', 'pay_date')
                                    ->where('expense_reason_id', $reason)
                                    ->whereBetween('pay_date', [$start_date, $end_date])
                                    ->get();

                                $sum = DB::table('expense')
                                    ->where('expense_reason_id', $reason)
                                    ->whereBetween('pay_date', [$start_date, $end_date])
                                    ->sum('amount');


                            }

                        }

                    }
                }


                $total_row = count($data);

                $dataOut = array(
                    'table_data' => $data,
                    'total_data' => $total_row,
                    'sum' => $sum
                );

                //echo json_encode($data);
                return response()->json($dataOut);


            }
          
        }

    }
}
