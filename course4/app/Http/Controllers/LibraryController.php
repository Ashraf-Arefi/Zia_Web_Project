<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\Book;
use App\Models\Library;

class LibraryController extends Controller
{

    public function index(){

            $books = \DB::table('library')
                ->Join('book', 'book.book_id', '=', 'library.book_id')
                ->get();
            return view("library.libraryList", compact("books"))->with('panel_title','لیست کتاب های موجود در کتابخانه');

    }
    public function create(Request $request){
        $book =Book::all()->where('status','!=','1');

        if ($request->isMethod('get')) {


            return view('library.createLibrary',compact('book'))->with('panel_title','ثبت کتاب به کتابخانه');

        } else {
            $book_id = $request->input("book_name");
            $quantity = $request->input("book_quantity");
            $lib = \DB::table('library')
                ->select('book_id')
                ->where('book_id', '=', $book_id)->get();


                if (count($lib) <= 0) {
                    $li = new Library();
                    $li->book_id =  $book_id;
                    $li->quantity = $quantity;

                    $li->save();
                } else {
                    \DB::table('library')
                        ->select('book_id')
                        ->where('book_id', '=', $book_id)
                        ->increment('quantity',$quantity);
                }

            return array(
                'content' => 'content',
                'url' => route('library.list')
            );

        }
    }

    public function update(Request $request,$id){

        $library=Library::find($id);
        $book =Book::all()->where('status','!=','1');


        if($request->isMethod('get')) {

            return view('library.createLibrary', compact('library', 'book'))->with(['panel_title' => 'ویرایش  کتابخانه ']);
        }else {


            $library->book_id = Input::get('book_name');
            $library->quantity = Input::get('book_quantity');


            $library->save();

            return array(
                'content' => 'content',
                'url' => route('library.list')
            );


            //Session::put('msg_status', 'fkjdkfgjdlgjdlkgjdkgjdl');
        }
    }
}
