<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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
        $categories = DB::select('SELECT * FROM categories ORDER BY date_created DESC');
        $count = DB::table('categories')->count();
        $data = array(
            'categories' => $categories,
            'count' => $count,
            'title' => 'Categories'
        );
        return view('categories/index')->with($data);
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
            return view('categories/new')->with($data);
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
                'name' => 'required|max:100',
                'description' => 'required|max:100'
            ]);
            $name = $request->input('name');
            $description = $request->input('description');
            DB::table('categories')->insert(
                ['name' => $name, 'description' => $description]
            );
            return redirect('/categories')->with('success', 'Category created.');
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
            $category = DB::select('select * from categories where id = ?', array($id));
            if (empty($category)) {
                return view('404');
            }
            $data = array(
                'title' => 'Edit',
                'category' => $category
            );
            return view('categories/edit')->with($data);
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
            $category = DB::select('select * from categories where id = ?', array($id));
            if (empty($category)) {
                return view('404');
            } else {
                $validatedData = $request->validate([
                    'name' => 'required|max:100',
                    'description' => 'required|max:100'
                ]);
                $name = $request->input('name');
                $description = $request->input('description');
                DB::table('categories')
                    ->where('id', $id)
                    ->update(['name' => $name, 'description' => $description]);
                return redirect('/categories')->with('success', 'Category edited.');

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
            $category = DB::select('select * from categories where id = ?', array($id));
            if (empty($category)) {
                return view('404');
            } else {
                DB::table('categories')->where('id', '=', $id)->delete();
                return redirect('/categories')->with('success', 'Category deleted.');
            }
        } else {
            return redirect('/');
        }
    }
}
