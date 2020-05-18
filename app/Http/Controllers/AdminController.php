<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\User;
use Auth;

class AdminController extends Controller
{
    function index(){
        return view('admin.index');
    }

    function profile($id){
        $user = User::find($id);
        if($user != Auth::user()){
            return redirect()->back();
        }
        $data = [
            "user"=>$user
        ];
        return view('admin.profile',$data);
    }

    function search(Request $request,$id){
        $user = User::find($id);
        $user->videos = Video::where('title','like','%'.$request->search.'%')->get();
        $data = [
            "user"=>$user,
        ];
        return view('admin.profile',$data);
    }

    function follow(Request $request){
        $user = User::find($request->user_id);
        $followed = User::find($request->user()->id);
        $user = $user->followers()->create([
            'followed_id'=>$followed->id,
        ]);
        return redirect()->back();
    }

    function addImage(Request $request){
        $user = $request->user();
        $file = $request->file('image')->store('images');
        if($file){
            $user->image = $file;
            $user->save();
            return redirect()->back();
        }
        return redirect()->back();
    }
}
