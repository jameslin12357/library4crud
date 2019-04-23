<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublisherController extends Controller
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
        $publishers = DB::select('SELECT * FROM publishers');
        $count = DB::table('publishers')->count();
        $data = array(
            'publishers' => $publishers,
            'count' => $count,
            'title' => 'Publishers'
        );
        return view('publishers/index')->with($data);
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
            return view('publishers/new')->with($data);
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
                'name' => 'required|max:100'
            ]);
            $name = $request->input('name');
            DB::table('publishers')->insert(
                ['name' => $name]
            );
            return redirect('/publishers')->with('success', 'Publisher created.');
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
            $publisher = DB::select('select * from publishers where id = ?', array($id));
            if (empty($publisher)) {
                return view('404');
            }
            $data = array(
                'title' => 'Edit',
                'publisher' => $publisher
            );
            return view('publishers/edit')->with($data);
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
            $publisher = DB::select('select * from publishers where id = ?', array($id));
            if (empty($publisher)) {
                return view('404');
            } else {
                $validatedData = $request->validate([
                    'name' => 'required|max:100'
                ]);
                $name = $request->input('name');
                DB::table('publishers')
                    ->where('id', $id)
                    ->update(['name' => $name]);
                return redirect('/publishers')->with('success', 'Publisher edited.');

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
            $publisher = DB::select('select * from publishers where id = ?', array($id));
            if (empty($publisher)) {
                return view('404');
            } else {
                DB::table('publishers')->where('id', '=', $id)->delete();
                return redirect('/publishers')->with('success', 'Publisher deleted.');
            }
        } else {
            return redirect('/');
        }
    }
}
