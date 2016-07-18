<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Http\Requests\UserFormRequest;

use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $table=User::find($id);
        return view('user')->with("id",$table);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}

