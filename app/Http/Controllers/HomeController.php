<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends AppBaseController
{
    public function home()
    {
        $categories = Category::where('status',1)->take(6)->get();

        return view('front.home',compact('categories'));
    }

    public function services()
    {
        $categories = Category::where('status',1)->get();

        return view('front.services',compact('categories'));
    }

    public function servicesCategory($category,$id)
    {
        $users = User::with('category')->where('category_id',$id)->get();
        $category = Category::where('id',$id)->first();

        return view('front.services-category',compact('users','category'));
    }

    public function servicesDetail($category,$id)
    {
        $user = User::where('id',$id)->first();
        $category = Category::where('name',$category)->first();
        $relatedHelpers = User::where('category_id',$category->id)->where('id','!=',$id)->get();
        $bookingTimes = User::BOOKING_TIMES;

        return view('front.services-details',compact('user','category','relatedHelpers','bookingTimes'));
    }

    public function frontUserProfile()
    {
        return view('front.my-account');
    }

    public function contactUs()
    {
        return view('front.contact-us');
    }
}
