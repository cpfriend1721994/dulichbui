<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Tour;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tour= Tour::orderBy('id','desc')->paginate(9);
        $tour2= Tour::leftJoin('links','links.tour_id','=','tours.id')->selectRaw('tours.*,count(links.user_id) AS `count`')->groupBy('tours.id')->orderBy('count','desc')->paginate(9);
        return view('home')->with('listTourNew',$tour)->with('listTourHot',$tour2);

    }
}
