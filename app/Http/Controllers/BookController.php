<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = DB::select('SELECT * FROM books ORDER BY date_created DESC');
        $count = DB::table('books')->count();
        $data = array(
            'books' => $books,
            'count' => $count,
            'title' => 'Books'
        );
        return view('books/index')->with($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $level = Auth::user()->level;
        if ($level === 1){
            $data = array(
                'title' => 'Create'
            );
            return view('books/new')->with($data);
        } else {
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $level = Auth::user()->level;
        if ($level === 1){
            $validatedData = $request->validate([
                'title' => 'required|max:100',
                'description' => 'required|max:100',
                'isbn' => 'required',
                'length' => 'required',
                'author_id' => 'required',
                'category_id' => 'required',
                'publisher_id' => 'required'
            ]);
            $title = $request->input('title');
            $description = $request->input('description');
            $isbn = $request->input('isbn');
            $length = $request->input('length');
            $author_id = $request->input('author_id');
            $category_id = $request->input('category_id');
            $publisher_id = $request->input('publisher_id');
            DB::table('books')->insert(
                ['title' => $title, 'description' => $description, 'isbn' => $isbn,'length' => $length,'author_id' => $author_id,'category_id' => $category_id,'publisher_id' => $publisher_id]
            );
            return redirect('/books')->with('success', 'Book created.');
        } else {
            return redirect('/');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $level = Auth::user()->level;
        if ($level === 1){
            $book = DB::select('select * from books where id = ?', array($id));
            if (empty($book)) {
                return view('404');
            }
            $data = array(
                'title' => 'Edit',
                'book' => $book
            );
            return view('books/edit')->with($data);
        } else {
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $level = Auth::user()->level;
        if ($level === 1){
            $book = DB::select('select * from books where id = ?', array($id));
            if (empty($book)) {
                return view('404');
            } else {
                $validatedData = $request->validate([
                    'title' => 'required|max:100',
                    'description' => 'required|max:100',
                    'isbn' => 'required',
                    'length' => 'required',
                    'author_id' => 'required',
                    'category_id' => 'required',
                    'publisher_id' => 'required'
                ]);
                $title = $request->input('title');
                $description = $request->input('description');
                $isbn = $request->input('isbn');
                $length = $request->input('length');
                $author_id = $request->input('author_id');
                $category_id = $request->input('category_id');
                $publisher_id = $request->input('publisher_id');
                DB::table('books')
                    ->where('id', $id)
                    ->update(['title' => $title, 'description' => $description, 'isbn' => $isbn, 'length' => $length, 'author_id' => $author_id,'category_id' => $category_id,'publisher_id' => $publisher_id]);
                return redirect('/books')->with('success', 'Book edited.');

            }
        } else {
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $level = Auth::user()->level;
        if ($level === 1){
            $book = DB::select('select * from books where id = ?', array($id));
            if (empty($book)) {
                return view('404');
            } else {
                DB::table('books')->where('id', '=', $id)->delete();
                return redirect('/books')->with('success', 'Book deleted.');
            }
        } else {
            return redirect('/');
        }
    }
}
