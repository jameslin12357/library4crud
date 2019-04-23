<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AuthorController extends Controller
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
        $authors = DB::select('SELECT * FROM authors ORDER BY date_created DESC');
        $count = DB::table('authors')->count();
        $data = array(
            'authors' => $authors,
            'count' => $count,
            'title' => 'Authors'
        );
        return view('authors/index')->with($data);
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
            return view('authors/new')->with($data);
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
                'fname' => 'required|max:100',
                'lname' => 'required|max:100',
                'age' => 'required'
            ]);
            $fname = $request->input('fname');
            $lname = $request->input('lname');
            $age = $request->input('age');
            DB::table('authors')->insert(
                ['fname' => $fname, 'lname' => $lname, 'age' => $age]
            );
            return redirect('/authors')->with('success', 'Author created.');
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
            $author = DB::select('select * from authors where id = ?', array($id));
            if (empty($author)) {
                return view('404');
            }
            $data = array(
                'title' => 'Edit',
                'author' => $author
            );
            return view('authors/edit')->with($data);
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
            $author = DB::select('select * from authors where id = ?', array($id));
            if (empty($author)) {
                return view('404');
            } else {
                $validatedData = $request->validate([
                    'fname' => 'required|max:100',
                    'lname' => 'required|max:100',
                    'age' => 'required'
                ]);
                $fname = $request->input('fname');
                $lname = $request->input('lname');
                $age = $request->input('age');
                DB::table('authors')
                    ->where('id', $id)
                    ->update(['fname' => $fname, 'lname' => $lname, 'age' => $age]);
                return redirect('/authors')->with('success', 'Author edited.');

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
            $author = DB::select('select * from authors where id = ?', array($id));
            if (empty($author)) {
                return view('404');
            } else {
                DB::table('authors')->where('id', '=', $id)->delete();
                return redirect('/authors')->with('success', 'Author deleted.');
            }
        } else {
            return redirect('/');
        }
    }
}
