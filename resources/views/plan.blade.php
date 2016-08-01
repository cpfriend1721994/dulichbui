@extends('layouts.app')

@section('content')

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1IH2Fo0HQqasekPQWywUDYTLeq1eEsIE&libraries=places"></script>
<?php
  $fill=collect(['Create Plan',url('/plan_create').'/'.$id,url('/images/transparent.png')]);
  if($request->plan_id!=null) 
    $fill=collect(['Edit Plan',url('/plan_update').'/'.$request->plan_id,url('/uploads/plans/cover_photo').'/'.$request->cover_photo]);
?>
<div class="container">
<div class="col-md-12 section-gray" style="background-color:white">
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-md-11"><h4>{{$fill[0]}}</h4></div>
    <div class="col-sm-1" style="width:7%"></div>
    <div class="col-md-4">
    <form action="{{$fill[1]}}" method="POST" role="form" enctype="multipart/form-data">
    
      <input type="hidden" name="_token" value="{{csrf_token()}}">
    
      <div class="form-group">
        <label for="">Arrival Place</label>
        <input type="text" class="form-control" id="searchmap" value="{{$request->arrival_place}}" name="arrival_place">
      </div>
    

      <div class="form-group">
        <label for="">Stay Place</label>
        <input type="text" class="form-control" id="" value="{{$request->stay_place}}" name="stay_place">
      </div>
    

      <div class="form-group">
        <label for="">Stay Period</label>
        <input type="text" class="form-control" id="" value="{{$request->stay_period}}" name="stay_period">
      </div>
    
      <div class="form-group">
        <label for="">Activities</label>
        <input type="text" class="form-control" id="" value="{{$request->activities}}" name="activities">
      </div>

      <div class="form-group">
        <label for="">Vehicle</label>
        <input type="text" class="form-control" id="" value="{{$request->vehicle}}" name="vehicle">
      </div>

      <div class="form-group">
        <label for="">Running Period</label>
        <input type="text" class="form-control" id="" value="{{$request->period}}" name="period">
      </div>

      
    <input type="hidden" class="form-control input-sm" value="{{$request->lat}}" name="lat" id="lat">
    <input type="hidden" class="form-control input-sm" value="{{$request->lng}}" name="lng" id="lng">
    <input type="hidden" class="form-control" value="{{$request->plan_id}}" name="plan_id">
    <input type="hidden" class="form-control" value="{{$request->next_plan_id}}" name="next_plan_id">


    <div class="form-group">
      
      <label for="">Cover Photo @for ($i = 0; $i < 10; $i++) &emsp; @endfor
      </label>
      <label class="btn btn-default btn-file">
        Browse... <input name="cover_photo" type="file" style="display: none;" class="file-loading" onchange="readURL(this);" value="{{$request->cover_photo}}">
      </label>
      
      <br><br>
      
          <script type="text/javascript">
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function (e) {
                                                $('#plan_cover_photo').attr('src', e.target.result);
                                            }

                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
          </script>
          <img id="plan_cover_photo" src="{{$fill[2]}}" alt="" class="img-thumbnail" height="auto" width="100%"/> 
      
  </div> 
  <br><br>
        <a href="{{$fill[1]}}"> <button type="submit" class="btn btn-primary">  Submit </button> </a>
        <a href="{{url('tour')}}/{{$id}}" class="btn btn-primary">Cancel</a>
    </form>
        
    
</div>

    
        <div class="col-md-7">
                    <div id="map-canvas"></div>
                    
        </div>
        <script>
        var map = new google.maps.Map(document.getElementById('map-canvas'),{
            center:{
                lat:27.5,
                lng:85.3
            },
            zoom: 10
        });
        var marker = new google.maps.Marker({
            position: {
                lat:27.5,
                lng:85.3
            },
            map: map,
            draggable: true
        });
        var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
        google.maps.event.addListener(searchBox,'places_changed',function(){
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i, place;

            for (i=0; place=places[i];i++){
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);
            }
            map.fitBounds(bounds);
            map.setZoom(15);
        });

        google.maps.event.addListener(marker,'position_changed',function(){
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();

            $('#lat').val(lat);
            $('#lng').val(lng);
        });
    </script>

</div>
</div>    
</div>
   
@endsection