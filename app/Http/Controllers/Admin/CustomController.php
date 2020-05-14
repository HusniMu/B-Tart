<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Category;
use App\CustomOrder;
use App\Hiasan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Level;
use App\Notifications\NewPostNotify;
use App\Subscriber;
use App\Topping;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CustomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customs = CustomOrder::all();
        return view('admin.custom.index', compact('customs'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CustomOrder $custom)
    {
        // return view('admin.custom.show', compact('custom'));
        return dd($custom);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomOrder $custom)
    {

        if (Storage::disk('public')->exists('custom/' . $custom->image)) {
            Storage::disk('public')->delete('custom/' . $custom->image);
        }
        $custom->categories()->detach();
        $custom->tags()->detach();
        $custom->toppings()->detach();
        $custom->hiasans()->detach();
        $custom->levels()->detach();
        $custom->delete();

        Toastr::success('Custom Order Successfully Deleted', 'Success');
        return redirect()->back();
    }
}
