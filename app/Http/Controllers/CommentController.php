<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Comment;

use Auth;

class CommentController extends Controller
{

    public function index()
    {
        //
    }


    public function create(Request $request)
    {
        //Request include tour_id,user_id,comment_id,text,photo
        $comment= new Comment();
        $comment->tour_id=$request->tour_id;
        $comment->user_id=Auth::id();
        $comment->comment_id=$request->comment_id;
        $comment->text=$request->text;
        $comment->save();
        if($request->photo[0]!=null) $comment->photo='photo_'.$comment->id.'.txt';
        $comment->save();
        $photos = $request->photo;
        if($request->photo[0]!=null){
            $i=0;
            $collect= array();
            foreach($photos as $photo)
            {
                $photoName = 'photo'.$i.'_'.$comment->id.'.'.$photo->getClientOriginalExtension();
                $photo->move(base_path() .'/public/uploads/comments/photo/'. $comment->id . '/', $photoName);
                $collect[$i]=$photoName;
                $i++;
            }
            $string= serialize($collect);
            $myfile = fopen(base_path() .'/public/uploads/comments/photo_location'.'/'.$comment->photo, "w");
            fwrite($myfile, $string);
            fclose($myfile);
        }
        return redirect('tour/'.$request->tour_id);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
        $comment=Comment::find($id);
        if($comment->user_id!=Auth::id()) redirect('home');
        $comment->text=$request->text;
        $comment->update();
        return redirect('tour/'.$comment->tour_id);
    }


    public function destroy($id)
    {
        //
        $comment=Comment::find($id);
        if($comment->user_id!=Auth::id()) redirect('home');
        $tour_id=$comment->tour_id;
        $subComment=Comment::where('comment_id',$id)->get();
        $comment->delete();
        foreach($subComment as $row){
            $row->delete();
        }
        return redirect('tour/'.$tour_id);
    }
}
