<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Plan;

use Auth;

use App\Link;

class PlanController extends Controller
{

    public function create(Request $request,$id)
    {
        //
        $this->checkOwn($id);
        $plan= new Plan();
        $plan->tour_id=$id;
        $plan->arrival_place=$request->arrival_place;
        $plan->stay_place=$request->stay_place;
        $plan->stay_period=$request->stay_period;
        $plan->activities=$request->activities;
        $plan->vehicle = $request->vehicle;
        $plan->period = $request->period;
        $plan->lat= $request->lat;
        $plan->lng=$request->lng;
        $plan->save();
        $coverPhoto = $request->cover_photo;
        if($coverPhoto!=null){
            $coverPhotoName = 'plan_'.$plan->id. '_'.time().'.'.$coverPhoto->getClientOriginalExtension();
            $coverPhoto->move(base_path() .'/public/uploads/plans/cover_photo/', $coverPhotoName);
            $plan->cover_photo=$coverPhotoName;
            $plan->save();
        }
        // insert plan next to the choosen plan
        if($request->next_plan_id!=null){
            $plan2= Plan::where('tour_id',$id)->get();
            $swapRow=null;
            $i=0;
            foreach($plan2 as $row){
                $swap=null;
                if(($row->id==$request->next_plan_id)&&($i==0)){
                    $swapRow=$plan;
                    $i=1;
                    continue;
                }
                if(($swapRow!=null)&&($i==1)){
                    $swap=$row;
                    $plan3=Plan::find($row->id);
                    $plan3->arrival_place=$swapRow->arrival_place;
                    $plan3->stay_place=$swapRow->stay_place;
                    $plan3->stay_period=$swapRow->stay_period;
                    $plan3->activities=$swapRow->activities;
                    $plan3->vehicle = $swapRow->vehicle;
                    $plan3->period = $swapRow->period;
                    $plan3->lat= $swapRow->lat;
                    $plan3->lng=$swapRow->lng;
                    $plan3->cover_photo=$swapRow->cover_photo;
                    $plan3->update();
                    $swapRow=$swap;
                }
            }
            return redirect('tour/'.$id);
        }
        // 
        $request = new Request();
        $request->_token=csrf_token();
        return view('plan')->with('id',$id)->with('request',$request);
    }

    public function show(Request $request)
    {
        //
        return view('plan')->with('id',$request->id)->with('request',$request);
    }

    public function update(Request $request,$id)
    {
        //
        $plan=Plan::find($request->plan_id);
        $this->checkOwn($plan->tour_id);
        $plan->arrival_place=$request->arrival_place;
        $plan->stay_place=$request->stay_place;
        $plan->stay_period=$request->stay_period;
        $plan->activities=$request->activities;
        $plan->vehicle = $request->vehicle;
        $plan->period = $request->period;
        $plan->lat= $request->lat;
        $plan->lng=$request->lng;
        $plan->update();
        $coverPhoto = $request->cover_photo;
        if($coverPhoto!=null){
            $coverPhotoName = 'plan_'.$plan->id. '_'.time().'.'.$coverPhoto->getClientOriginalExtension();
            $coverPhoto->move(base_path() .'/public/uploads/plans/cover_photo/', $coverPhotoName);
            $plan->cover_photo=$coverPhotoName;
            $plan->update();
        }
        return redirect('tour/'.$plan->tour_id);
    }

    public function destroy($id)
    {
        //
        $tour_id=Plan::find($id)->tour_id;
        $this->checkOwn($tour_id);
        $plan=Plan::find($id)->delete();
        return redirect('tour/'.$tour_id);
    }

    public function updatePhoto(Request $request,$id)
    {
        //
        $plan=Plan::find($request->id);
        $this->checkOwn($plan->tour_id);
        $coverPhoto = $request->cover_photo;
        if($coverPhoto!=null){
            $coverPhotoName = 'plan_'.$plan->id. '_'.time().'.'.$coverPhoto->getClientOriginalExtension();
            $coverPhoto->move(base_path() .'/public/uploads/plans/cover_photo/', $coverPhotoName);
            $plan->cover_photo=$coverPhotoName;
            $plan->update();
        }
        return redirect('tour/'.$plan->tour_id);
    }

    public function deletePhoto($id)
    {
        //
        $tour_id=Plan::find($id)->tour_id;
        $this->checkOwn($tour_id);
        $plan=Plan::find($id);
        $plan->cover_photo=null;
        $plan->update();
        return redirect('tour/'.$tour_id);
    }

    public function checkOwn($tour_id)
    {
        $rowOwn=Link::where('tour_id',$tour_id)->where('type','own')->where('user_id',Auth::id())->get();
        if($rowOwn->count()!=1) return redirect('home');
    }
}
