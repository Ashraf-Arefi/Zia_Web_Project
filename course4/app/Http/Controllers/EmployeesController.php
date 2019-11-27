<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{

    public function index()
    {
        $employees = Employee::all()->where('status', '!=', '1');
        return view("employee.index", compact("employees"))->with('panel_title','لیست همه کارمندان');

    }

    public function showDetail($id)
    {
        $employee = Employee::find($id);

        return view("employee.showDetail",compact("employee"))->with('panel_title','نمایش جزئیات کارمند');

    }

    public function show_agreement_paper($id)
    {
       $emp = Employee::find($id);

       $path = $emp->agreement_paper;
        return response()->download(public_path($path));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {

            $position = Position::all();
            return view('employee.form',compact("position"))->with('panel_title','راجسترکارمند جدید');

        } else {
            $validator = Validator::make(Input::all(), [

                'name' => 'required',
                'last_name' => 'required',
                'salary' => 'required',
                'phone' => 'required |min:10 |max:16',
                'email' => 'required |email',
                'come_date' => 'required ',
                'shift' => 'required'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            } else {
                if ($request->file("photo")) {
                    $photo_address = "image/" . time() . "." . $request->file("photo")->getClientOriginalExtension();
                    $request->file("photo")->move(public_path("image"), $photo_address);

                } else {

                    $photo_address = "image/empty_profile.jpg";
                }
                if ($request->file("agreepaper")  ) {
                    $agree_address = "image/per_" . time() . "." . $request->file("agreepaper")->getClientOriginalExtension();
                    $request->file("agreepaper")->move(public_path("image"), $agree_address);

                } else {

                    $agree_address = "image/agreement.jpg";
                }

                $arr = [
                    "first_name" => $request->input("name"),
                    "last_name" => $request->input("last_name"),
                    "position_id" => $request->input("position"),
                    "email" => $request->input("email"),
                    "salary_type" => $request->input("salary_type"),
                    "phone" => $request->input("phone"),
                    "salary" => $request->input("salary"),
                    "shift" => $request->input("shift"),
                    "hire_date" => $request->input("come_date"),
                    "gender" => $request->input("gender"),
                    "status" => $request->input("status"),
                    "address" => $request->input("address"),
                    "photo" => $photo_address,
                    "agreement_paper" => $agree_address,
                    "status" => 0
                ];

                Employee::create($arr);
                return array(
                    'content' => 'content',
                    'url' => route('employee.list')
                );
            }
        }
    }

    public function delete($id)
    {
        if ($id && ctype_digit($id)) {
            Employee::find($id)->update(['status' => 1]);

        }
        return redirect("employee");
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $position = Position::all();

        if ($request->isMethod('get'))

            return view('employee.form', compact('employee', 'position'))->with('panel_title','ویرایش کارمند');

        else {
            $validator = Validator::make(Input::all(), [

                'name' => 'required',
                'last_name' => 'required',
                'salary' => 'required',
                'phone' => 'required |min:10 |max:16',
                'email' => 'required |email',
                'come_date' => 'required ',
                'shift' => 'required'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }
            if ($request->file("photo")) {
                $photo_address = "image/" . time() . "." . $request->file("photo")->getClientOriginalExtension();
                $request->file("photo")->move(public_path("image"), $photo_address);

            } else {

                $photo_address = "image/empty_profile.jpg";
            }
            if ($request->file("agreepaper")  ) {
                $agree_address = "image/per_" . time() . "." . $request->file("agreepaper")->getClientOriginalExtension();
                $request->file("agreepaper")->move(public_path("image"), $agree_address);

            } else {

                $agree_address = "image/agreement.jpg";
            }


            $arr = [
                "first_name" => $request->input("name"),
                "last_name" => $request->input("last_name"),
                "position_id" => $request->input("position"),
                "email" => $request->input("email"),
                "salary_type" => $request->input("salary_type"),
                "phone" => $request->input("phone"),
                "salary" => $request->input("salary"),
                "shift" => $request->input("shift"),
                "hire_date" => $request->input("come_date"),
                "gender" => $request->input("gender"),
                "status" => $request->input("status"),
                "address" => $request->input("address"),
                "photo" => $photo_address,
                "agreement_paper" => $agree_address,
                "status" => 0,
            ];
            Employee::find($id)->update($arr);
            return array(
                'content' => 'content',
                'url' => route('employee.list')
            );
        }

    }
}
