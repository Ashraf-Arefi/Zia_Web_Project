<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = Room::all()->where('status', '<', 1);
        return view('room.index', compact('rooms'))->with('panel_title','لیست اطاق ها');
    }

    public function create(Request $request)
    {
        
        if($request->isMethod('get'))

            return view('room.form')->with('panel_title','ایجاد اطاق جدید');

        else {
            $validator = Validator::make(Input::all(), [
                'room_floor' => 'required|min:1',
                'room_name' => 'required |min:1'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }else{

                $room=new room();
                $room->room_floor=Input::get('room_floor');
                $room->room_name=Input::get('room_name');

                $room->save();
                return array(
                    'content' => 'content',
                    'url' => route('room.list')
                );

            }

        }
    }

    public function update(Request $request, $id)
    {
        $room=Room::find($id);

        if($request->isMethod('get'))

            return view('room.form',compact('room'));
        else {
            $validator = Validator::make(Input::all(), [

                'room_floor' => 'required',
                'room_name' => 'required'
            ]);
            if ($validator->fails()) {
                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray()
                );
            }
            if($request->get('id')){
                $data=[
                    'room_floor'=>$request->get('room_floor'),
                    'room_name'=>$request->get('room_name')
                ];

                Room::find($request->get('id'))->where('room_id',$request->get('id'))->update($data);

                return array(
                    'content' => 'content',
                    'url' => route('room.list')
                );
            }

            Session::put('msg_status', true);
        }
    }


    public function delete($id)
    {
        if ($id && ctype_digit($id)) {
           Room::find($id)->where('room_id', $id)->update(['status' => 1]);
            return redirect('room');
        }

    }

}
