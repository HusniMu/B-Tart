<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
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
            'header' => 'required|min:3',
            'image' => 'required|mimes:jpeg,bmp,png,jpg'
        ]);
        // get form image
        $image = $request->file('image');
        $currentDate = Carbon::now()->toDateString();
        $slug = \Str::slug($request->header) . '-' . $currentDate . '-' . uniqid();
        if (isset($image)) {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            // check banner dir is exist
            if (!Storage::disk('public')->exists('banner')) {
                Storage::disk('public')->makeDirectory('banner');
            }
            // resize image banner and upload
            $banner = Image::make($image)->resize(1600, 479)->stream();
            Storage::disk('public')->put('banner/' . $imageName, $banner);
        } else {
            $imageName = "default.png";
        }

        $banner = new Banner();
        $banner->header = ucwords($request->header);
        $banner->paragraf = ucwords($request->paragraf);
        $banner->slug = $slug;
        $banner->image = $imageName;
        $banner->save();
        Toastr::success('Banner Successfully Saved', 'Success');
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
        $banner = Banner::find($id);
        return view('admin.banner.edit', compact('banner'));
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
            'header' => 'required|min:3',
            'image' => 'mimes:jpeg,bmp,png,jpg'
        ]);
        // get form image
        $image = $request->file('image');
        $currentDate = Carbon::now()->toDateString();
        $slug = \Str::slug($request->header) . '-' . $currentDate . '-' . uniqid();
        $banner = Banner::find($id);
        if (isset($image)) {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //////////////////banner
            // check banner banner dir is exist
            if (!Storage::disk('public')->exists('banner')) {
                Storage::disk('public')->makeDirectory('banner');
            }
            // delete old image
            if (Storage::disk('public')->exists('banner/' . $banner->image)) {
                Storage::disk('public')->delete('banner/' . $banner->image);
            }
            // resize image banner for banner and upload
            $bannerImage = Image::make($image)->resize(1600, 479)->stream();
            Storage::disk('public')->put('banner/' . $imageName, $bannerImage);
        } else {
            $imageName = $banner->image;
        }

        $banner->header = ucwords($request->header);
        $banner->paragraf = ucwords($request->paragraf);
        $banner->slug = $slug;
        $banner->image = $imageName;
        $banner->save();
        Toastr::success('Banner Successfully Updated', 'Success');
        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);

        if (Storage::disk('public')->exists('banner/' . $banner->image)) {
            Storage::disk('public')->delete('banner/' . $banner->image);
        }

        $banner->delete();
        Toastr::success('Banner Successfully Deleted', 'success');
        return redirect()->back();
    }
}
