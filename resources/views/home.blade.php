@extends('layouts.app')

@section('content')


<div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:white">New Tour</h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        @foreach($listTourNew as $list)
            <div class="col-md-4 portfolio-item">
                <a href="../tour/{{$list->id}}">
                    <img class="img-responsive" src="{{ url('/uploads/tours/cover_photo')}}/{{$list->cover_photo}}" width="100%" alt="" style="max-height:200px;min-height:200px;">
                </a>
                <h3>
                    <a href="../tour/{{$list->id}}" style="color:white">{{$list->tour_name}}</a>
                </h3>
                <p>Max join user: {{$list->user_max}}</p>
            </div>
        @endforeach
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:white">Hot Tour</h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        @foreach($listTourHot as $list)
            <div class="col-md-4 portfolio-item">
                <a href="../tour/{{$list->id}}">
                    <img class="img-responsive" src="{{ url('/uploads/tours/cover_photo')}}/{{$list->cover_photo}}" width="100%" alt="" style="max-height:200px;min-height:200px;">
                </a>
                <h3>
                    <a href="../tour/{{$list->id}}" style="color:white">{{$list->tour_name}}</a>
                </h3>
                <p>Max join user: {{$list->user_max}}</p>
            </div>
        @endforeach
        </div>

    </div>
@endsection
