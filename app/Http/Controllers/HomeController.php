<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Comment;

class HomeController extends Controller
{
    function index(){
        $videos = Video::get();
        $data = [
            'videos'=>$videos,
        ];
        return view('video.index',$data);
    }

    function single($id){
        $video = Video::find($id);
        $video->views += 1;
        $video->save();
        $videos = Video::get();
        $data = [
            "video"=>$video,
            "videos"=>$videos,
        ];
        return view("video.single",$data);
    }

    function search(Request $request){
        $videos = Video::where('title','like','%'.$request->search.'%')->get();;
        $data = [
            "videos"=>$videos,
        ];
        return view('video.index',$data);
    }

    function filter(Request $request){
        $videos;
        switch($request->filter){
            case 1:
                $videos = Video::orderBy('created_at','desc')->get();
            break;
            case 2:
                $videos = Video::orderBy('created_at','asc')->get();
            break;
            case 3:
                $videos = Video::orderBy('views','desc')->get();
            break;
            case 4:
                $videos = Video::orderBy('views','asc')->get();
            break;
            default:
                $videos = Video::orderBy('created_at','desc')->get();
        }
        $data = [
            "videos"=>$videos,
        ];
        return view('video.index',$data);
    }

    function comment(Request $request){
        $video = Video::find($request->video_id);
        $video->comments()->create([
            'user_id'=>$request->user()->id,
            'text'=>$request->text
        ]);

        return redirect()->back();
    }

    function deleteComment($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back();
    }
}
