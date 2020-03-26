<?php

namespace App\Http\Controllers\Admin;

use App\Topping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class ToppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toppings = Topping::latest()->get();
        return view('admin.topping.index', compact('toppings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.topping.create');
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
            'name' => 'required|min:1|unique:toppings',
            'harga' => 'required|numeric'
        ]);

        $topping = new Topping();
        $topping->name = ucwords($request->name);
        $topping->slug = \Str::slug($request->name);
        $topping->harga = $request->harga;
        $topping->save();
        Toastr::success('Topping Successfully Saved', 'Success');
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
        $topping = Topping::find($id);
        return view('admin.topping.edit', compact('topping'));
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
            'name' => 'required|min:1|unique:toppings',
            'harga' => 'required|numeric'
        ]);

        $topping = Topping::find($id);
        $topping->name = ucwords($request->name);
        $topping->slug = \Str::slug($request->name);
        $topping->harga = $request->harga;
        $topping->save();
        $errors = Session::get('errors');
        Toastr::success('Topping Successfully Updated', 'Success');
        return redirect()->route('admin.topping.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Topping::find($id)->delete();
        Toastr::success('Topping Successfully Deleted', 'Success');
        return redirect()->back();
    }
}
