<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Tour;

use App\Link;

use App\Http\Requests\UserFormRequest;

use Auth;

class UserController extends Controller
{

    public function show($id)
    {
        //
        $table=User::select('id','name','email','address','gender','birthday','avatar_photo','cover_photo')->find($id);
        $tour=Tour::join('links','links.tour_id','=','tours.id')->select('tours.id','tours.cover_photo','tours.tour_name','tours.start_time','tours.start_place','tours.user_max','tours.status','links.type','links.user_id')->get();
        return view('user')->with("id",$table)->with("listTour",$tour);
    }


    public function update(Request $request, $id)
    {
        $user=User::find($id);
        if ($user->id != Auth::id()) return redirect(url('/user/'.Auth::id()));
        $avatarPhoto = $request->avatar_photo;        
        if($avatarPhoto!=null){
            $avatarPhotoName = 'avatar_'.$id. '_'.time().'.'.$avatarPhoto->getClientOriginalExtension();
            $avatarPhoto->move(base_path() .'/public/uploads/users/avatar_photo/', $avatarPhotoName);
            $user->avatar_photo=$avatarPhotoName;
            $user->save();
        }
        $coverPhoto = $request->cover_photo;
        if($coverPhoto!=null){
            $coverPhotoName = 'cover_'.$id. '_'.time().'.'.$coverPhoto->getClientOriginalExtension();
            $coverPhoto->move(base_path() .'/public/uploads/users/cover_photo/', $coverPhotoName);
            $user->cover_photo=$coverPhotoName;
            $user->save();
        }            
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $user->address = $request->address;
        $user->save();
        return redirect('user/'.$id);
    }

}

