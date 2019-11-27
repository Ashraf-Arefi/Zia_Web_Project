<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Department;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::select('book_id', 'book_name','book_edition', 'book_price', 'department_name')
            ->Join('department', 'department.department_id', '=', 'book.department_id')
            ->where('book.status', '!=',1)->get();
        return view("book.index", compact("books"))->with('panel_title','لیست کتاب ها');
    }

    public function create(Request $request)
    {

        if ($request->isMethod('get')) {

            $departments = Department::all()->where('status','!=0');
            return view('book.form', compact("departments"))->with('panel_title','ایجادکتاب جدید');

        } else {

            $arr = [

                "book_name" => $request->input("title"),
                "book_edition" => $request->input("version"),
                "payment" => $request->input("payment"),
                "department_id" => $request->input("department"),
                "book_price" => $request->input("payment"),
                "status" => 0,

            ];
            Book::create($arr);
            return array(
                'content' => 'content',
                'url' => route('book.list')
            );
        }



    }

    public function delete($id)
    {

        if ($id && ctype_digit($id)) {
            Book::find($id)->update(['status' => 1]);
            return redirect("book");

        }
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $departments = Department::all();

        if ($request->isMethod('get'))

            return view('book.form', compact('book', 'departments'))->with('panel_title','ویرایش کتاب');

        else {

            $arr = [

                "book_name" => $request->input("title"),
                "book_edition" => $request->input("version"),
                "department_id" => $request->input("department"),
                "book_price" => $request->input("payment"),


            ];
            Book::find($id)->update($arr);
            return array(
                'content' => 'content',
                'url' => route('book.list')
            );
        }

    }
}
