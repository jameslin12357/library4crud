<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BooklenderController extends Controller
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
        $bookslenders = DB::select('SELECT * FROM bookslenders ORDER BY date_created DESC');
        $count = DB::table('bookslenders')->count();
        $data = array(
            'bookslenders' => $bookslenders,
            'count' => $count,
            'title' => 'Bookslenders'
        );
        return view('bookslenders/index')->with($data);
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
            return view('bookslenders/new')->with($data);
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
                'date_returned' => 'required|max:100',
                'due_date' => 'required|max:100',
                'fine' => 'required',
                'book_id' => 'required',
                'lender_id' => 'required'
            ]);
            $date_returned = $request->input('date_returned');
            $due_date = $request->input('due_date');
            $fine = $request->input('fine');
            $book_id = $request->input('book_id');
            $lender_id = $request->input('lender_id');
            DB::table('bookslenders')->insert(
                ['date_returned' => $date_returned, 'due_date' => $due_date, 'fine' => $fine,'book_id' => $book_id,'lender_id' => $lender_id]
            );
            return redirect('/bookslenders')->with('success', 'Booklender created.');
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
            $booklender = DB::select('select * from bookslenders where id = ?', array($id));
            if (empty($booklender)) {
                return view('404');
            }
            $data = array(
                'title' => 'Edit',
                'booklender' => $booklender
            );
            return view('bookslenders/edit')->with($data);
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
            $booklender = DB::select('select * from bookslenders where id = ?', array($id));
            if (empty($booklender)) {
                return view('404');
            } else {
                $validatedData = $request->validate([
                    'date_returned' => 'required|max:100',
                    'due_date' => 'required|max:100',
                    'fine' => 'required',
                    'book_id' => 'required',
                    'lender_id' => 'required'
                ]);
                $date_returned = $request->input('date_returned');
                $due_date = $request->input('due_date');
                $fine = $request->input('fine');
                $book_id = $request->input('book_id');
                $lender_id = $request->input('lender_id');
                DB::table('bookslenders')
                    ->where('id', $id)
                    ->update(['date_returned' => $date_returned, 'due_date' => $due_date, 'fine' => $fine, 'book_id' => $book_id, 'lender_id' => $lender_id]);
                return redirect('/bookslenders')->with('success', 'Booklender edited.');

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
            $booklender = DB::select('select * from bookslenders where id = ?', array($id));
            if (empty($booklender)) {
                return view('404');
            } else {
                DB::table('bookslenders')->where('id', '=', $id)->delete();
                return redirect('/bookslenders')->with('success', 'Booklender deleted.');
            }
        } else {
            return redirect('/');
        }
    }
}
