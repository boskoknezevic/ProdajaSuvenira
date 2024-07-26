<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ad;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        $all_ads = new Ad();

        if(isset(request()->cat))
        {
            $all_ads = Ad::whereHas('category', function($query){
                $query->whereName(request()->cat);
            });
        }
        
        if(isset(request()->type)) 
        {
            $type = (request()->type == 'lower') ? 'asc' : 'desc';
            $all_ads = $all_ads->orderBy('price', $type);
        }
        $all_ads = $all_ads->get();
        $categories = Category::all();
        return view('welcome', compact('categories', 'all_ads'));
    }

    public function singleAd($id)
    {
        $singleAd = Ad::find($id);
        return view('singleAd', compact('singleAd'));
    }

    public function sendMessage(Request $request, $id)
    {
        $ad = Ad::find($id);
        $ad_owner = $ad->user;

        $new_msg = new Message();
        $new_msg->text = $request->msg;
        $new_msg->sender_id = $ad_owner->id;
        $new_msg->receiver_id = $ad_owner->id;
        $new_msg->ad_id = $ad->id;

        $new_msg->save();

        return redirect()->back()->with('message', 'Message sent!');
    }
}
