<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_ads = Ad::all();
        return view('home', compact('all_ads'));
    }

    public function addDeposit()
    {
        return view('home.addDeposit');
    }

    public function storeDeposit(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'deposit'=> 'required|max:4'
        ],
        [
            'deposit.max'=>'Can\'t add more than 9999 at once!'
        ]);

        $user->deposit = $user->deposit + $request->deposit;
        $user->save();

        return redirect(route('home.addDeposit'))->with('message', 'Deposit added.');
    }

    public function newAd()
    {
        $categories = Category::all();
        return view('home.newAd', compact('categories'));
    }

    public function storeAd(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'price'=>'required',
            'image1'=>'mimes:png,jpg,jpeg',
            'image2'=>'mimes:png,jpg,jpeg',
            'image3'=>'mimes:png,jpg,jpeg',
            'category'=>'required'
        ]);

        if(request()->hasFile('image1')){
            $image1 = request()->file('image1');
            $image1_name = time().'1.'.$image1->extension();
            $image1->move(public_path('ad_images'), $image1_name);
        }

        if(request()->hasFile('image2')){
            $image2 = request()->file('image2');
            $image2_name = time().'2.'.$image2->extension();
            $image2->move(public_path('ad_images'), $image2_name);
        }

        if(request()->hasFile('image3')){
            $image3 = request()->file('image3');
            $image3_name = time().'3.'.$image3->extension();
            $image3->move(public_path('ad_images'), $image3_name);
        }

        Ad::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'price'=>$request->price,
            'image1'=>(isset($image1_name)) ? $image1_name : null,
            'image2'=>(isset($image2_name)) ? $image2_name : null,
            'image3'=>(isset($image3_name)) ? $image3_name : null,
            'user_id'=>Auth::user()->id,
            'category_id'=>$request->category
        ]);

        return redirect(route('home'))->with('message', 'Ad added');
    }

    public function singleAd($id)
    {
        $singleAd = Ad::find($id);
        return view('home.singleAd', compact('singleAd'));
    }

    public function showMessage()
    {
        $messages = Message::where('receiver_id', auth()->user()->id)->get();
        return view('home.showMessage', compact('messages'));
    }

    public function replyMessage()
    {
        $sender_id = request()->sender_id;
        $ad_id = request()->ad_id;

        $messages = Message::where('sender_id', $sender_id)->where('ad_id', $ad_id)->get();

        return view('home.replyMessage', compact('sender_id', 'ad_id', 'messages'));
    }

    public function storeReply(Request $request)
    {
        $sender = User::find($request->sender_id);
        $ad = Ad::find($request->ad_id);

        $store_msg = new Message();
        $store_msg->text = $request->msg;
        $store_msg->sender_id = Auth::user()->id;
        $store_msg->receiver_id = $sender->id;
        $store_msg->ad_id = $ad->id;

        $store_msg->save();

        return redirect()->back()->with('msg', 'Reply sent!');
    }
}
