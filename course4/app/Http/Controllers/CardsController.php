<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Student;
use App\Models\StudentCard;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CardsController extends Controller
{
    public function index()
    {
        $cards = \DB::table('card')
            ->join('department','department.department_id','=','card.department_id')
            ->select('card.card_id','card.card_name','card.card_price','department.department_name')
            ->where('card.status','!=',1)->get();

        return view('card.index', compact('cards'))->with('panel_title','لیست کارت ها');
    }

    public function create(Request $request)
    {
        $departments = Department::all();
        if ($request->isMethod('get'))

            return view('card.form', compact('departments'))->with('panel_title','ثبت کارت جدید');

        else {
            $validator = Validator::make(Input::all(), [

                'card_name' => 'required |min:2',
                'card_price' => 'required|min:1'

            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            } else {

                $card = new Card();
                $card->card_name = Input::get('card_name');
                $card->card_price = Input::get('card_price');
                $card->department_id = Input::get('department');

                $card->save();
                return array(
                    'content' => 'content',
                    'url' => route('card.list')
                );
            }
        }
    }

    public function update(Request $request, $id)
    {

        $card=Card::find($id);

        $departments =Department::all()->where('status','!=',1);

        if($request->isMethod('get'))


            return view('card.form',compact('card','departments'));
        else {
            $validator = Validator::make(Input::all(), [

                'card_name' => 'required',
                'card_price' => 'required',
                'department' => 'required'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }
            if($request->get('id')){
                $data=[
                    'card_name'=>$request->get('card_name'),
                    'card_price'=>$request->get('card_price'),
                    'department_id'=>$request->get('department')
                ];

                Card::find($request->get('id'))->where('card_id',$request->get('id'))->update($data);

                return array(
                    'content' => 'content',
                    'url' => route('card.list')
                );
            }

            Session::put('msg_status', true);
        }
    }

    public function delete($id)
    {
        if ($id && ctype_digit($id)) {
            Card::find($id)->where('card_id', $id)->update(['status' => 1]);
            return redirect('card');

        }
    }


    public function studentCardList()
    {
        $student_card= \DB::table('student_card as st')
            ->join('card','card.card_id','=','st.card_id')
            ->join('student','student.st_id','=','st.student_id')
            ->select('st.student_card_id','st.payment','st.date','card.card_name','student.first_name','student.last_name')
            ->where('st.status','!=',1)->get();
        return view('card.studentCardList',compact('student_card'))->with('panel_title','لیست کارتهای شاگرادان');
    }

    public function studentCardCreate(Request $request)
    {
        $card = Card::all()->where('status','!=',1);
        $student = Student::all()->where('status','!=',1);
        if ($request->isMethod('get')){
            return view('card.studentCardForm',compact('card','student'))->with('panel_title','تحویل کارت به شاگرد');
        }
        else{
            $validator = Validator::make(Input::all(),[
                'card' => 'required',
                'student' => 'required',
                'payment' => 'required',
                'date' => 'required'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            } else {

                $st = new StudentCard();
                $st->card_id = Input::get('card');
                $st->student_id = Input::get('student');
                $st->payment = Input::get('payment');
                $st->date = Input::get('date');

                $st->save();


                return array(
                    'content' => 'content',
                    'url' => route('card.studentCardList')
                );

            }
        }
    }
    public function getCardNumber($id)
    {


        $card_price = \DB::table("card")->where("card_id",$id)->select("card_price")->first();

        return ($card_price->card_price);
    }

    public function studentCardDelete($id){
        if($id && ctype_digit($id)){


            \DB::table("student_card")->where("student_card_id",$id)->delete();

        }
        return redirect('card/studentCardList');
    }


    public function studentCardUpdate(Request $request,$id){

        $studentCard= StudentCard::find($id);
        $student = Student::all()->where('status','!=',1);
        $card = Card::all()->where('status','!=',1);

        if ($request->isMethod('get')) {

            return view('card.studentCardForm', compact('studentCard','card','student'))->with('panel_title', 'ویرایش کارت های شاگردان');

        }else{
            $validator = Validator::make(Input::all(), [
                'card' => 'required',
                'student' => 'required',
                'payment' => 'required',
                'date' => 'required'


            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }

            $studentCard->card_id = Input::get('card');
            $studentCard->student_id = Input::get('student');
            $studentCard->payment = Input::get('payment');
            $studentCard->date = Input::get('date');

            $studentCard->save();


            return array(
                'content' => 'content',
                'url' => route('card.studentCardList')
            );
        }


    }
}