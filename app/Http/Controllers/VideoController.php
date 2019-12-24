<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use Storage;

class VideoController extends Controller
{
    function index(){
        $videos = Video::paginate(9);
        $data = [
            'videos'=>$videos,
        ];
        return view('admin.video.index',$data);
    }

    function single($id){
        $video = Video::find($id);
        $data = [
            "video"=>$video,
        ];
        return view("admin.video.single",$data);
    }
    
    function create(Request $request){
        if($request->isMethod('get')){
            return view('admin.video.create');
        }else if($request->isMethod('post')){
            $this->validate($request,[
                'title'=>'required',
                'description'=>'required',
                'thumbnail'=>'required|image',
                'video'=>'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
                ]);

            $file = $request->file('video')->store('videos');
            $thumbnail = $request->file('thumbnail')->store('thumbnails');
            if($file && $thumbnail){
                $video = $request->user()->videos()->create([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'thumbnail'=>$thumbnail,
                    'file'=>$file
                ]);

                if($video){
                    return redirect()->route('videos.index');
                }else{
                    return redirect()->back();
                }
            }else{
                return redirect()->back();
            }

        }
    }

    function update(Request $request,$id){
        if($request->isMethod('get')){
            $video = Video::find($id);
            $data = [
                'video' => $video,
            ];
            return view('admin.video.update',$data);
        }else if($request->isMethod('post')){
            $video = Video::find($id);

            $this->validate($request,[
                'title'=>'required',
                'description'=>'required',
                'thumbnail'=>'required|image',
            ]);

            $thumbnail = $request->file('thumbnail')->store('thumbnails');

            if($thumbnail){
                Storage::delete($video->thumbnail);
                
                $video = $video->update([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'thumbnail'=>$thumbnail,
                ]);

                if($video){
                    return redirect()->route('videos.index');
                }else{
                    return redirect()->back();
                }
            }else{
                return redirect()->back();
            }
        }
    }

    function delete($id){
        $video = Video::findOrFail($id);
        $file = Storage::delete($video->file);
        if($file){
            $video->delete();
        }
        return redirect()->route('videos.index');
    }

    function search(Request $request){
        $videos = new Video();
        $videos = $videos->where('title','like','%'.$request->search.'%')->paginate(9);
        $data = [
            "videos"=>$videos,
        ];
        return view('admin.video.index',$data);
    }
}
