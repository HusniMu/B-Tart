<?php

namespace App\Http\Controllers\Admin;

use App\Hiasan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class HiasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hiasans = Hiasan::latest()->get();
        return view('admin.hiasan.index', compact('hiasans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hiasan.create');
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
            'name' => 'required|min:1|unique:hiasans',
            'harga' => 'required|numeric'
        ]);

        $hiasan = new Hiasan();
        $hiasan->name = ucwords($request->name);
        $hiasan->slug = \Str::slug($request->name);
        $hiasan->harga = $request->harga;
        $hiasan->save();
        Toastr::success('Hiasan Successfully Saved', 'Success');
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
        $hiasan = Hiasan::find($id);
        return view('admin.hiasan.edit', compact('hiasan'));
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
            'name' => 'required|min:1|unique:hiasans',
            'harga' => 'required|numeric'
        ]);

        $hiasan = Hiasan::find($id);
        $hiasan->name = ucwords($request->name);
        $hiasan->slug = \Str::slug($request->name);
        $hiasan->harga = $request->harga;
        $hiasan->save();
        $errors = Session::get('errors');
        Toastr::success('Hiasan Successfully Updated', 'Success');
        return redirect()->route('admin.hiasan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hiasan::find($id)->delete();
        Toastr::success('Hiasan Successfully Deleted', 'Success');
        return redirect()->back();
    }
}
