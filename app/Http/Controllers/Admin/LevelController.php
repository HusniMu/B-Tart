<?php

namespace App\Http\Controllers\Admin;

use App\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::latest()->get();
        return view('admin.level.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.level.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|numeric',
            'harga' => 'required|numeric'
        ]);

        $level = new Level();
        $level->name = ucwords($request->name);
        $level->slug = \Str::slug($request->name);
        $level->harga = $request->harga;
        $level->save();
        Toastr::success('Level Successfully Saved', 'Success');
        return redirect()->back();
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
        $level = Level::find($id);
        return view('admin.level.edit', compact('level'));
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
        $this->validate($request, [
            'name' => 'required|numeric',
            'harga' => 'required|numeric'
        ]);

        $level = Level::find($id);
        $level->name = ucwords($request->name);
        $level->slug = \Str::slug($request->name);
        $level->harga = $request->harga;
        $level->save();
        $errors = Session::get('errors');
        Toastr::success('Level Successfully Updated', 'Success');
        return redirect()->route('admin.level.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Level::find($id)->delete();
        Toastr::success('Level Successfully Deleted', 'Success');
        return redirect()->back();
    }
}
