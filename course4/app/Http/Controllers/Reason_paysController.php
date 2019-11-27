<?php

namespace App\Http\Controllers;

use App\Models\Reason_Pay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class Reason_paysController extends Controller
{
    public function index()
    {
        $reason_pays =Reason_Pay::all()->where('status', '<', 1);
        return view('reason_pay.index',compact('reason_pays'))->with(['panel_title'=>'لیست علت مصارف']);

    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))

            return view('reason_pay.form')->with('panel_title','ثبت علت مصارف ');
        else {

            $validator = Validator::make(Input::all(), [
                "title" => "required",

            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }
            $reason= new Reason_Pay();
            $reason->title=Input::get('title');
            $reason->save();
            return array(
                'content' => 'content',
                'url' => route('reason_pay.list')
            );
            Session::put('msg_status', true);
        }

    }
/*
    public function search(Request $request)
    {
        return Reason_Pay:: select('title')->where('title', 'LIKE', '%'.$request->q.'%')->get();

    }

    public function live_search(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query != '')
            {
                $data =Reason_Pay::select('title')
                    ->where('title', 'like', '%'.$query.'%')

                    ->orderBy('id', 'desc')
                    ->get();


            }
            else
            {
                $data = Reason_Pay::all()
                    ->orderBy('id', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output .= '
        <tr>
         <td>'.$row->id.'</td>
         <td>'.$row->title.'</td>
         
        </tr>
        ';
                }
            }
            else
            {
                $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);


    }
        
    }*/

    public function get_data()
    {
         $reasons=Reason_Pay::all();
         return view('management.reason_pay.List',compact('reasons'));
        /**
        $reson =Reason_Pay::all();
        return DataTables::of($reson)->addColumn('action',function ($reson){
            return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> show</a>'
                .'<a onclick="editForm('.$reson->reason_pay_id.')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                '<a onclick="deleteData('. $reson->reason_pay_id.')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i>Delete </a>';

        })->make(true);
         * */

    }



    public function store(Request $request)
    {

            $this->validate($request, [
                'title' => 'required'
            ], [
                'title.required' => 'وارد کردن نوع یا از بابت مصارف الزامی میباشد'
            ]);
           if($request->ajax()){
               $res =Reason_Pay::create($request->all());
               $r =$this->find($res->id);

               return response($r);
           }

        /**

        $data=[
            'title'=>$request->input('title')
        ];
        $reason =Reason_Pay::create($data);
        if($reason instanceof Reason_Pay){
            return redirect()->route('management.reason_pay.list');
        }
**/
    }
    /*public function find($id){
        return Reason_Pay::find($id);
    }*/

    public function edit($id)
    {
        $reason_pay=Reason_Pay::find($id);
        return view('management.reason_pay.edit',compact('reason_pay'));
    }

    public function update(Request $request,$id)
    {

        $reason_pay=Reason_Pay::find($id);

        if($request->isMethod('get'))

            return view('reason_pay.form',compact('reason_pay'));

        else {
            $validator = Validator::make(Input::all(), [
                "title" => "required "

            ]);

            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }
            $data=[
                'title'=>$request->get('title')
            ];

            Reason_Pay::find($id)->where('expense_reason_id',$id)->update($data);
            Session::put('msg_status', true);
        }

    }

    public function delete($id)
    {
        if ($id && ctype_digit($id)) {
             Reason_Pay::find($id)->where('expense_reason_id', $id)->update(['status' => 1]);
            return redirect('reason_pay');


        }
        }
        /**
       if ($reason_pay_id && ctype_digit($reason_pay_id)){
           $user_item =Reason_Pay::find($reason_pay_id)->where('id', $reason_pay_id)->update(['status' => 1]);
           return redirect()->route('management.reason_pay.list')->with('success', 'یک ایتم ازنوع مصارف مورد نظر با موفقیت حذف گردید');

       }
         * */


}
