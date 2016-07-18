<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tour;

use App\Link;

use Auth;

class TourController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $tour = new Tour();
        
        $tour->tour_name = $request->tour_name;
        $tour->start_time = $request->start_time;
        $tour->start_place = $request->start_place;
        $tour->user_max = $request->user_max;
        $tour->save();

        $link= new Link();
        $link->user_id = Auth::user()->id;
        $link->tour_id = $tour->id;
        $link->type = "own";
        $link->save(); 

        $coverPhoto = $request->cover_photo;
        if($coverPhoto!=null){
            $coverPhotoName = 'cover_'.$tour->id. '_'.time().'.'.$coverPhoto->getClientOriginalExtension();
            $coverPhoto->move(base_path() .'/public/uploads/tours/cover_photo/', $coverPhotoName);
            $tour->cover_photo=$coverPhotoName;
            $tour->save();
        }
        
    return redirect('user/'.Auth::user()->id);    
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
        $tour=Tour::find($id);
        $link = Link::join('users', 'links.user_id', '=', 'users.id')->select('*')->where('tour_id',$id)->get();
        return view('tour')->with("id",$tour)->with("userTour",$link);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
        $tour = Tour::find($id); 
        $tour->tour_name = $request->tour_name;
        $tour->start_time = $request->start_time;
        $tour->start_place = $request->start_place;
        $tour->user_max = $request->user_max;
        $tour->save();
        $coverPhoto = $request->cover_photo;
        if($coverPhoto!=null){
            $coverPhotoName = 'cover_'.$tour->id. '_'.time().'.'.$coverPhoto->getClientOriginalExtension();
            $coverPhoto->move(base_path() .'/public/uploads/tours/cover_photo/', $coverPhotoName);
            $tour->cover_photo=$coverPhotoName;
            $tour->save();
        }   
        return redirect('tour/'.$id);
    }

    public function destroy($id)
    {
        //
        $link= new Link();
        $rowOwn=$link->where('tour_id',$id)->where('type','own')->where('user_id',Auth::id())->get();
        if($rowOwn->count()!=1) return redirect('home');
        $row=$link->where('tour_id',$id)->delete();
        $tour=Tour::find($id)->delete();
        return redirect('user/'.Auth::id());
    }


    /*ALL LINKS TABLE CONTROLLER*/

    public function createLink(Request $request)
    /*Request include 'tour_id' and 'type' = {'waitjoin','follow'}*/
    {
        $link= new Link();
        if(($request->type == 'waitjoin') || ($request->type == 'follow'))
        {
            if($link->where('user_id',Auth::id())->where('tour_id',$request->tour_id)->count() == 0)
            {
                $link->user_id=Auth::id();
                $link->tour_id=$request->tour_id;
                $link->type=$request->type;
                $link->save();
                return redirect('tour/'.$request->tour_id);
            }
            
        }
        return redirect('home');
    }

    public function deleteLink(Request $request)
    /*Request include 'tour_id' and 'type' != own*/
    {
        if($request->type=='own') return redirect('home');
        $link= new Link();
        $row=$link->where('tour_id',$request->tour_id)->where('type',$request->type)->where('user_id',Auth::id())->get();
        foreach ($row as $row1) {
            $row1->delete();
        }
        return redirect('user/'.Auth::id());
    }

    public function updateLink(Request $request)
    /*Request include 'tour_id' and 'type' = {'join','waitjoin','follow'}*/
    {
        $link= new Link();
        $newType=$request->type;
        if($request->type=='join'){
            $row=$link->where('tour_id',$request->tour_id)->where('type','join')->where('user_id',Auth::id())->get();
            $newType='follow';
        }
        if($request->type=='waitjoin'){
            $row=$link->where('tour_id',$request->tour_id)->where('type','waitjoin')->where('user_id',Auth::id())->get();
            $newType='follow';
        }
        if($request->type=='follow'){
            $row=$link->where('tour_id',$request->tour_id)->where('type','follow')->where('user_id',Auth::id())->get();
            $newType='waitjoin';
        }
        if($newType==$request->type) return redirect('home');
        foreach ($row as $row1){
            $row1->type=$newType;
            $row1->update();
        }
        return redirect('tour/'.$request->tour_id);
    }

     public function updateLinkByOwn(Request $request)
    /*Request include 'tour_id' and 'user_id' and 'choose'={agree,disagree,unjoin}*/
    {
        $link= new Link();
        $rowOwn=$link->where('tour_id',$request->tour_id)->where('type','own')->where('user_id',Auth::id())->get();
        if($rowOwn->count()!=1) return redirect('home');
        if($request->choose='unjoin'){
            $row=$link->where('tour_id',$request->tour_id)->where('type','join')->where('user_id',$request->user_id)->get();
            if($row->count()==1){
                foreach ($row as $row1){
                        $row1->type='follow';
                        $row1->update();
                    }
            }
        }
        else{
            $row=$link->where('tour_id',$request->tour_id)->where('type','waitjoin')->where('user_id',$request->user_id)->get();
            
            if($row->count()==1){
                if($request->choose=='agree'){
                    foreach ($row as $row1){
                        $row1->type='join';
                        $row1->update();
                    }
                }
                if($request->choose=='disagree'){
                    foreach ($row as $row1){
                        $row1->type='follow';
                        $row1->update();
                    }
                }
            }
        }
    }
}
