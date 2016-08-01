@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0" style="background-image: url('../uploads/tours/cover_photo/{{$id->cover_photo}}');background-size: cover;background-attachment:scroll;">
        	<div style="height:200px;" ></div>
        	<div class="row">
				<div class="col-md-2">
				{{-- <div class="col-md-1" style="width:2px"></div> --}}
					<?php
					$userTourOwn= $userTour->where('type','own');
					?>
					@foreach($userTourOwn as $own)
					
			<div class="card-container" style="height:auto">
                <div class="card" style="height:auto">
                    <div class="front">
                        <img src="{{ url('/uploads/users/avatar_photo')}}/{{$own->avatar_photo}}" alt="Thumbnail Image" class="img-thumbnail" >
                    </div> <!-- end front panel -->
                    <div class="back">
                        {{-- <div class="header">
                            
                        </div> --}}
                        <div class="navbar">
                        	<h6 class="motto">{{$own->name}}</h6>
                            <p style="text-align:center"><a href="{{ url('/user/') }}/{{$own->user_id}}"><font style="color:orange">See Profile</font></a></p>
                        	<div style="height:1px;" ></div>
                        	<div class=" footer" style="background:none">
                        		<a href="#"><small class="fa fa-lg fa-skype pull-center">  </small></a>
				                <a href="#"><small class="fa fa-lg fa-google-plus pull-center">  </small></a>
				                <a href="#"><small class="fa fa-lg fa-linkedin pull-center">  </small></a>
				                <a href="#"><small class="fa fa-lg fa-twitter pull-center">  </small></a>
				                <a href="#"><small class="fa fa-lg fa-facebook pull-clenter">  </small></a>
                        	</div>
			                
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div>
			        @endforeach
				</div>
				<div id="carousel-example-generic2" class="carousel slide gsdk-transition" data-ride="carousel">
				<div class="col-md-1" style="width:3%;margin-left:1%;">
				<div style="height:200px;"></div>
					<a class="left carousel-control" href="#carousel-example-generic2" data-slide="prev">
        				<span class="fa fa-angle-left"></span>
      				</a>
				</div>
				<div class="col-md-8" style="width:71.5%;margin-left:1%;">

				<div style="height:79px;"></div>
				<?php
					$num=0;
          $number=0;
          $RouteNumber=0;
					$userTourJoin=$userTour->where('type','join');
				?>				
				      <div class="carousel-inner">
				      	
				      	<div class="item active">
					      	<ul class="list-inline">
								@foreach($userTourJoin as $row)
								    <a href="{{ url('/user/') }}/{{$row->user_id}}" data-toggle="tooltip" title="{{$row->name}}"><img src="{{ url('/uploads/users/avatar_photo')}}/{{$row->avatar_photo}}" alt="Thumbnail Image" class="img-thumbnail" height=10.5% width=10.5%></a>
								    <?php
								     $num=$num+1;
								    ?>
								    @if($num%9==0)
								    </ul>
								    </div>
								    <div class="item">
								    <ul class="list-inline">
								    @endif
								 @endforeach
							 
							 </ul>
						 </div>
						 
				      	</div>
				    </div>
					</div>
					<div class="col-md-1" style="width:3%">
					<div style="height:200px;"></div>
						<a class="right carousel-control" href="#carousel-example-generic2" data-slide="next">
        					<span class="fa fa-angle-right"></span>
    					</a>
					</div>
			</div>	
        </div>
        <?php
        	$fill=collect(['unfollow ','join tour','follow tour','#777777','/link_create','waitjoin','/link_create','follow']);
        	$checkType=null;
        	if(Auth::user() && ($userTour->where('user_id',Auth::id())->count()==1)) $checkType=$userTour->where('user_id',Auth::id())->first()->type;
        	if($checkType=='follow') $fill=collect(['followed ','join tour','unfollow tour','#34ACDC','/link_update','follow','/link_delete','follow']);
        	if($checkType=='waitjoin') $fill=collect(['followed ','cancel joining tour','unfollow tour','#40dbb2','/link_update','waitjoin','/link_delete','waitjoin']);
        	if($checkType=='join') $fill=collect(['joined ','unfollow tour','unjoin tour','#4cd964','/link_delete','join','/link_update','join']);
        	if($checkType=='own') $fill=collect(['owner ',' modify this tour',' delete this tour','#FF3B30']);
          $ownThisTour=0;
          if(Auth::user() && ($userTour->where('user_id',Auth::id())->where('tour_id',$id->id)->where('type','own')->count()==1)) $ownThisTour=1;
        ?>

        <div class="col-md-12 col-md-offset-0 section-gray">
        	<div class="col-md-2">
        		<ul class="nav" style="margin-left:15%">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		            	<h6 style="color:{{$fill[3]}}">{{$fill[0]}}<small style="color:{{$fill[3]}}">&#9660;</small></h6>
		            </a>
		            <ul class="dropdown-menu" style="text-align:center">
		            	@if($checkType!='own')
		            	<li>
		            		<form id="form_link1" action="{{$fill[4]}}" method="post" role="form">
					        	{{csrf_field()}}
					        	<input type="hidden" value="{{$id->id}}" name="tour_id">
					        	<input type="hidden" value="{{$fill[5]}}" name="type">
					        </form> 
					        <a href="javascript:{}" onclick="document.getElementById('form_link1').submit(); return false;">{{$fill[1]}}</a>           		
		            	</li>
		            	<li>
		            		<form id="form_link2" action="{{$fill[6]}}" method="post" role="form">
					        	{{csrf_field()}}
					        	<input type="hidden" value="{{$id->id}}" name="tour_id">
					        	<input type="hidden" value="{{$fill[7]}}" name="type">
					        </form> 
					        <a href="javascript:{}" onclick="document.getElementById('form_link2').submit(); return false;">{{$fill[2]}}</a>           		
		            	</li>
		            	@else
		            	<li style="text-align:left"><a href="#modifyTourModal" data-toggle="modal"><i class="glyphicon glyphicon-edit"></i>{{$fill[1]}}</a></li>
		            	<li style="text-align:left"><a href="#deleteTourModal" data-toggle="modal"><i class="glyphicon glyphicon-trash"></i>{{$fill[2]}}</a></li>
		            	@endif
		            </ul>
				</ul>
        	</div>
        	<div class="col-md-7"></div>
        	<?php
					$userTourFollow=$userTour->where('type','follow');
					$userTourWaitjoin=$userTour->where('type','waitjoin');
					$countOwn=$userTour->where('type','own')->where('tour_id',$id->id)->where('user_id',Auth::id())->count();
				?>
			<div class="col-md-1">
        		<ul class="nav navbar-nav" data-toggle="modal" data-target="#requestModal" style="cursor:pointer; text-align:center">
        			@if($userTourWaitjoin->count() && ($countOwn==1))
					<h6 style="color:#40dbb2">{{$userTourWaitjoin->count()}}<br>request</h6>
					@endif
				</ul>
        	</div>
        	<div class="col-md-1">
        		<ul class="nav navbar-nav" data-toggle="modal" data-target="#followModal" style="cursor:pointer; text-align:center">
        			@if($userTourFollow->count())
					<h6 style="color:#34ACDC">{{$userTourFollow->count()}}<br>follower</h6>
					@endif
				</ul>
        	</div>
        	<div class="col-md-1">
        		<ul class="nav navbar-nav" data-toggle="modal" data-target="#joinModal" style="cursor:pointer; text-align:center">
        			@if($userTourJoin->count())
					<h6 style="color:#4cd964">{{$userTourJoin->count()}}<br>joiner</h6>
					@endif
				</ul>
        	</div>
			<h1 style="text-align:center">{{$id->tour_name}}</h1>
		    <h4><div class="col-sm-3"></div><div class="col-sm-3"><strong>Start Time: </strong></div> <div class="col-sm-4">{{$id->start_time}}</div></h4>
		    <br>
		    <h4><div class="col-sm-3"></div><div class="col-sm-3"><strong>Start Place: </strong></div> <div class="col-sm-4">{{$id->start_place}}</div></h4>
		    <br>
		    <h4><div class="col-sm-3"></div><div class="col-sm-3"><strong>Max Join User: </strong></div> <div class="col-sm-4">{{$id->user_max}}</div></h4>
		    <br>
		    <h4><div class="col-sm-3"></div><div class="col-sm-3"><strong>Status: </strong></div> <div class="col-sm-4">{{$id->status}}</div></h4>
		    <br>
        <div style="height:60px"></div>
        </div>



        <div style="height:30px"></div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4 section-gray" id="right-panel" style="height:500px;background-color:#FFEE77;padding-top:20px;">
              <h3 style="margin-left:3%">Plan Detail</h3>
              <div id="directions-panel" style="height:380px;margin-top:20px;padding:20px;overflow:scroll;overflow-x:hidden;overflow-y:auto"></div>
              <div style="position:absolute; bottom:0;margin-bottom:2px">
                @if($ownThisTour==1)
                <form action="{{ url('/plan') }}" method="POST" role="form">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="{{$id->id}}">
                  <button type="submit" class="btn btn-success" style="border: none"><i class="glyphicon glyphicon-plus"></i>&nbsp;ADD PLACE</button>
                  @if($listPlan->last()!=null)
                  <a href="{{url('/plan_destroy').'/'.$listPlan->last()->id}}" class="btn btn-danger" style="border: none"><i class="glyphicon glyphicon-trash"></i>&nbsp;DELETE LAST PLACE</a>
                  @endif
                </form>
                @endif
              </div>
            </div>
            <div class="col-md-8" id="map" style="height:500px"></div>

    
     <script>
     var rou_te = Array([],[]);
     var i= 0;
    </script>

    @foreach ($listPlan as $list)
    <script>
    rou_te[i]= [{{$list->lat}},{{$list->lng}},'{{$list->arrival_place}}'];
    i++;
    </script>
<?php 
  $RouteNumber++;
?>
{{-- Modal Plan --}}
<div class="modal modal-sm fade" id="route{{$RouteNumber}}" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="height:auto;background-color:#FFEE77;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Route Detail</h3>
      </div>
      <div class="modal-body">          
          <div class="row" style="padding:20px;">
            <h5><strong style="color:#34ACDC">Stay Place: </strong>{{$list->stay_place}}</h5>
            <br>
            <h5><strong style="color:#34ACDC">Stay Period: </strong>{{$list->stay_period}}</h5>
            <br>
            <h5><strong style="color:#FF3B30">Activities: </strong>{{$list->activities}}</h5>
            <br>
            <h5><strong style="color:#4cd964">Vehicle: </strong>{{$list->vehicle}}</h5>
            <br>
            <h5><strong style="color:#4cd964">Running Period: </strong>{{$list->period}}</h5>
            <br>
            
            @if($ownThisTour)
            <div class="col-md-10">
              <div class="col-md-7" style="width:75%">
                <form action="{{url('/plan')}}" method="POST" role="form">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="{{$id->id}}">
                  <input type="hidden" name="plan_id" value="{{$list->id}}">
                  <input type="hidden" name="arrival_place" value="{{$list->arrival_place}}">
                  <input type="hidden" name="stay_place" value="{{$list->stay_place}}">
                  <input type="hidden" name="stay_period" value="{{$list->stay_period}}">
                  <input type="hidden" name="activities" value="{{$list->activities}}">
                  <input type="hidden" name="vehicle" value="{{$list->vehicle}}">
                  <input type="hidden" name="period" value="{{$list->period}}">
                  <input type="hidden" name="cover_photo" value="{{$list->cover_photo}}">
                  <input type="hidden" name="lat" value="{{$list->lat}}">
                  <input type="hidden" name="lng" value="{{$list->lng}}">
                  <button type="submit" class="btn btn-primary" style="border: none"><i class="glyphicon glyphicon-edit"></i>&nbsp;EDIT ROUTE</button>
                  <a href="{{url('/plan_destroy').'/'.$list->id}}" class="btn btn-danger" style="border: none"><i class="glyphicon glyphicon-trash"></i>&nbsp;DELETE ROUTE</a>
                </form>
              </div>
              <div class="col-md-3" style="width:25%">
                <form action="{{ url('/plan') }}" method="POST" role="form">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="{{$id->id}}">
                  <input type="hidden" name="next_plan_id" value="{{$list->id}}">
                  <button type="submit" class="btn btn-success" style="border: none"><i class="glyphicon glyphicon-plus"></i>&nbsp;INSERT NEXT ROUTE</button>
                </form>
              </div>
            </div>
            @endif
            
          </div>      
      </div>
    </div>
  </div>
</div>
{{-- Modal Plan Cover Photo--}}
<div class="modal modal-sm fade" id="route_cover{{$RouteNumber}}" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content">
  
    @if($list->cover_photo==null)
    <img id="plan_cover_photo" src="#" style="display: none;" width="700px" height="auto">
    <div class= "section-gray" style="width:700px;text-align:center;">
      <h4>No cover photo upload for this place</h4>
      @if($ownThisTour)
      <form action="{{url('/plan_update_photo')}}/{{$list->id}}" method="POST" role="form" enctype="multipart/form-data">
      {{csrf_field()}}
      <input class="form-control" type="hidden" name="id" value="{{$list->id}}">
      <label class="btn btn-default btn-file">Add Image...
        <input class="form-control" name="cover_photo" type="file" style="display: none;" class="file-loading" onchange="readURL5(this);" value="{{$list->cover_photo}}">
      </label>
      <button id="button_plan_photo" type="submit" class="btn btn-primary" method="post" style="display: none;">Submit</button>
      </form>
      @endif
    <script type="text/javascript">
      function readURL5(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#plan_cover_photo').attr('src', e.target.result);
                  $('#plan_cover_photo').attr('style', null);
                  $('#button_plan_photo').attr('style', null);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
    </script>  
    </div>
    @else
    <img src="{{ url('/uploads/plans/cover_photo')}}/{{$list->cover_photo}}" width="700px" height="auto">
    <div class= "section-gray" style="width:700px;text-align:center;"><h4>{{$list->arrival_place}}</h4>
    @if($ownThisTour)
    <a href="{{url('/plan_delete_photo').'/'.$list->id}}" class="btn btn-danger">Delete Photo</a>
    @endif
    </div>
    @endif    
  
  </div>
  </div>
</div>
     @endforeach   
          </div>
        </div>

        @if(Auth::user())
        <div class="col-md-12 col-md-offset-0 section-gray" style="padding: 0px 0;margin-top:25px;background-color:white;">
          <div style="height:10px"></div> 
          <div class="row">
            <div class="col-md-1">
              <img src="{{ url('/uploads/users/avatar_photo')}}/{{Auth::user()->avatar_photo}}" class="img-circle" width="80px" height="80px" style="margin-left:10%">
            </div>
            <div class="col-md-11">
            <form id="commentForm" action="{{url("comment_create")}}" method="POST" role="form" enctype="multipart/form-data">
            {{csrf_field()}}
              <textarea form="commentForm" type="text" rows="10" placeholder="What's on your mind ???" class="form-control" name="text" accept-charset="UTF-8" style="border: none;overflow:hidden;resize: none;outline: none;width:99%"></textarea>
              <input type="hidden" value="{{$id->id}}" name="tour_id">
              <input type="hidden" value="" name="comment_id">
              <p style="text-align:right;margin-right:5%;">
                <small>
                  <label class="btn btn-primary" style="border:none">IMAGES
                    <input id="dvFileUpload" name="photo[]" type="file" class="file-loading" style="display:none" multiple="multiple" />
                  </label>
                  <button class="btn btn-success" style="border:none" type="submit" method="post">POST
                  </button>
                </small>
              </p>
            </form>
            </div>
            <div class="col-md-1" style="width:3%"></div>
            <div id="dvPreview" class="col-md-11" style="overflow:scroll;overflow-y: hidden;overflow-x: auto;white-space:nowrap;" ></div>
          </div>
            <div style="height:10px"></div>
        </div>
        @endif
<script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: {lat: 41.85, lng: -87.65}
        });
        directionsDisplay.setMap(map);
        calculateAndDisplayRoute(directionsService, directionsDisplay);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
        for (var j = 1; j <i-1; j++) {
            waypts.push({
              location: new google.maps.LatLng(rou_te[j][0],rou_te[j][1]),
              //stopover: true
          });
        }

        directionsService.route({
          origin: new google.maps.LatLng(rou_te[0][0],rou_te[0][1]),
          destination:  new google.maps.LatLng(rou_te[i-1][0],rou_te[i-1][1]),
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: google.maps.TravelMode.DRIVING
        }, function(response, status) {
          if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              var routeSegment2 = routeSegment +1;
              summaryPanel.innerHTML += '<a href="#" data-toggle="modal" data-target="#route' + routeSegment +'"><font color="#34ACDC"><b>Route Segment ' + routeSegment +
                  '</b></font></a><br>';
              summaryPanel.innerHTML += '<a href="#" style="color:black" data-toggle="modal" data-target="#route_cover' + routeSegment +'"><b>' + rou_te[i][2] + ' <font color="#FF3B30">to</font></b></a> ';
              summaryPanel.innerHTML += '<a href="#" style="color:black" data-toggle="modal" data-target="#route_cover' + routeSegment2 +'"><b>' +rou_te[i+1][2] + '</b></a><br>';
              summaryPanel.innerHTML += '<font color="#4cd964"><b>' + route.legs[i].distance.text + '<b></font>' + '<br><br>';
            }
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1IH2Fo0HQqasekPQWywUDYTLeq1eEsIE&callback=initMap&libraries=places">
    </script>
        @foreach($comment->where('comment_id',0) as $cmt)
        {{-- Fisrt layer --}}
        <div style="height:25px"></div>
        <div class="col-md-12 col-md-offset-0 section-gray" style="background-color:white">
          <div class="row" style="margin-top:10px">
            <div class="col-md-0"></div>
            <div class="col-md-1">
              <img src="{{ url('/uploads/users/avatar_photo')}}/{{$cmt->avatar_photo}}" class="img-circle" height="70px" width="70px" style="margin-left:10%">
            </div>
            <div class="col-md-11">
              <a href="{{url("user")}}/{{$cmt->user_id}}" style="color:black"><small><b>{{$cmt->name}}</b></small></a>
              <p><small><font style="color:gray">{{$cmt->created_at}}</font>
                @if($cmt->user_id==Auth::id())
                <a href="#" data-toggle="modal" data-target="#modifyCommentModal{{$cmt->id}}">&emsp;EDIT</a>
                <a href="../comment_destroy/{{$cmt->id}}">&emsp;DELETE</a>
                {{-- modal modify of comment --}}
                <div class="modal fade" id="modifyCommentModal{{$cmt->id}}" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                      </div>
                      <div class="modal-body">                       
                        <form action="../comment_update/{{$cmt->id}}" method="POST" role="form" enctype="multipart/form-data">
                      {{csrf_field()}}
                       <div class="form-group">
                          <input type="text" class="form-control" id="" placeholder="{{$cmt->text}}" value="{{$cmt->text}}" name="text" style="border:none">
                       </div>
                      <div class="form-group" style="text-align:center">
                        <button type="submit" class="btn btn-primary" method="post">Edit</button>
                      </div>
                   </form>
                      </div>
                      <div class="modal-footer">
                       
                      </div>
                    </div>
                  </div>
                </div>
                {{--  --}}
                @endif
              </small></p>
              <p><small>{{$cmt->text}}</small></p> 
              @if($cmt->photo!=null)
                <?php
                  $myfile2 = fopen(base_path() .'/public/uploads/comments/photo_location'.'/'.$cmt->photo, "r");
                  $string2=fread($myfile2,filesize(base_path() .'/public/uploads/comments/photo_location'.'/'.$cmt->photo));
                  $collectPhoto=unserialize($string2);
                  fclose($myfile2);
                ?>
                <div id="dvPreview" class="col-md-11" style="overflow:scroll;overflow-y: hidden;overflow-x: auto;white-space:nowrap;" >
                @foreach($collectPhoto as &$photoCmt)
                <img src="{{ url('/uploads/comments/photo').'/'.$cmt->id.'/'.$photoCmt}}" style="margin-bottom:10px;height:auto;width:100px;margin-left:1%;">
                @endforeach
                </div>
              @endif
            </div>
          </div>
        </div>

        {{--  --}}
        @foreach($comment->where('comment_id',$cmt->id) as $cmt2)
        <div class="col-md-12 col-md-offset-0 section-gray" style="background-color:white">
          <div class="row" style="margin-top:10px">
            <div class="col-md-1"></div>
            <div class="col-md-1">
              <img src="{{ url('/uploads/users/avatar_photo')}}/{{$cmt2->avatar_photo}}" class="img-circle" height="70px" width="70px" style="margin-left:10%">
            </div>
            <div class="col-md-10">
              <a href="{{url("user")}}/{{$cmt2->user_id}}" style="color:black"><small><b>{{$cmt2->name}}</b></small></a>
              <p><small><font style="color:gray">{{$cmt->created_at}}</font>
                @if($cmt2->user_id==Auth::id())
                <a href="#"  data-toggle="modal" data-target="#modifyCommentModal{{$cmt2->id}}">&emsp;EDIT</a>
                <a href="../comment_destroy/{{$cmt2->id}}">&emsp;DELETE</a>
                {{-- modal modify of comment --}}
                <div class="modal fade" id="modifyCommentModal{{$cmt2->id}}" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                      </div>
                      <div class="modal-body">                       
                        <form action="../comment_update/{{$cmt2->id}}" method="POST" role="form" enctype="multipart/form-data">
                      {{csrf_field()}}
                       <div class="form-group">
                          <input type="text" class="form-control" id="" placeholder="{{$cmt2->text}}" value="{{$cmt2->text}}" name="text" style="border:none">
                       </div>
                      <div class="form-group" style="text-align:center">
                        <button type="submit" class="btn btn-primary" method="post">Edit</button>
                      </div>
                   </form>
                      </div>
                      <div class="modal-footer">
                       
                      </div>
                    </div>
                  </div>
                </div>
                {{--  --}}
                @endif
              </small></p>
              <p><small>{{$cmt2->text}}</small></p>
              @if($cmt2->photo!=null)       
                <?php
                  $myfile2 = fopen(base_path() .'/public/uploads/comments/photo_location'.'/'.$cmt2->photo, "r");
                  $string2=fread($myfile2,filesize(base_path() .'/public/uploads/comments/photo_location'.'/'.$cmt2->photo));
                  $collectPhoto=unserialize($string2);
                  fclose($myfile2);
                ?>
                <div id="dvPreview" class="col-md-10" style="overflow:scroll;overflow-y: hidden;overflow-x: auto;white-space:nowrap;" >
                @foreach($collectPhoto as &$photoCmt)
                <img src="{{ url('/uploads/comments/photo').'/'.$cmt2->id.'/'.$photoCmt}}" style="margin-bottom:10px;height:auto;width:100px;margin-left:1%;">
                @endforeach
                </div>
              @endif            
            </div>
          </div>
        </div>
        @endforeach
        {{--  --}}
        {{-- Comment form for Second comment --}}
        <script language="javascript" type="text/javascript">
        $(function () {
            $("#dvFileUpload{{$cmt->id}}").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#dvPreview{{$cmt->id}}");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "margin-bottom:10px;height:auto;max-height:100px;width:100px;margin-left:1%;");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });
    </script> 
        <div class="col-md-12 col-md-offset-0 section-gray" style="padding: 0px 0;background-color:white;">
          <div style="height:10px"></div>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-1">
              <img src="{{ url('/uploads/users/avatar_photo')}}/{{Auth::user()->avatar_photo}}" class="img-circle" width="70px" height="70px" style="margin-left:10%">
            </div>
            <div class="col-md-10">
            <form id="commentForm{{$cmt->id}}" action="{{url("comment_create")}}" method="POST" role="form" enctype="multipart/form-data">
            {{csrf_field()}}
              <textarea form="commentForm{{$cmt->id}}" type="text" rows="3" placeholder="   Reply this comment" class="form-control section-gray" name="text" accept-charset="UTF-8" style="border: none;overflow:hidden;resize: none;outline: none;width:98%"></textarea>
              <input type="hidden" value="{{$id->id}}" name="tour_id">
              <input type="hidden" value="{{$cmt->id}}" name="comment_id">
              <p style="text-align:right;margin-right:5%;">
                <small>
                  <label class="btn btn-primary" style="border:none">IMAGES
                    <input id="dvFileUpload{{$cmt->id}}" name="photo[]" type="file" class="file-loading" style="display:none" multiple="multiple" />
                  </label>
                  <button class="btn btn-success" style="border:none" type="submit" method="post">REPLY
                  </button>
                </small>
              </p>
            </form>
            </div>
            <div class="col-md-1" style="width:3%"></div>
            <div id="dvPreview{{$cmt->id}}" class="col-md-11" style="overflow:scroll;overflow-y: hidden;overflow-x: auto;white-space:nowrap;" ></div>
          </div>
            <div style="height:10px"></div>
        </div>
        {{--  --}}
        @endforeach






















{{--                                           All Modal                                             --}}


{{-- modal delete/modify of owner --}}
<div class="modal modal-sm fade" id="deleteTourModal" role="dialog">
	<div class="modal-dialog" style="width:22%;text-align:center;">
		<div class="modal-content">
			<div class="modal-body">
   				<p>Are you sure to delete this tour ?</p>
   				<a href="../tour_destroy/{{$id->id}}" class="btn btn-primary" role="button">Yes</a>
  				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modifyTourModal" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modify Tour</h4>
                      </div>
                      <div class="modal-body">
                      	 
                        <form action="../tour_update/{{$id->id}}" method="POST" role="form" enctype="multipart/form-data">
                   		{{csrf_field()}}
          
                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">Tour Name</label>
                           <div class="col-md-8">
                                <input type="text" class="form-control" id="" placeholder="{{$id->tour_name}}" value="{{$id->tour_name}}" name="tour_name">
                           </div>
                       </div>
                       
                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">Start Time</label>
                           <div class="col-md-8">
                                <input type="datetime-local" class="form-control" id="" placeholder="{{$id->start_time}}" value="{{$id->start_time}}" name="start_time">
                           </div>
                       </div>
                       
                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">Start Place</label>
                           <div class="col-md-8">
                                <input type="text" class="form-control" id="" placeholder="{{$id->start_place}}" value="{{$id->start_place}}" name="start_place">
                           </div>
                       </div>

                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">Max Join User</label>
                           <div class="col-md-8">
                                <input type="text" class="form-control" id="" placeholder="{{$id->user_max}}" value="{{$id->user_max}}" name="user_max">
                           </div>
                       </div>
                       <label></label>
                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">
                           Cover Photo
                           <label class="btn btn-default btn-file">
                                    Browse... <input name="cover_photo" type="file" style="display: none;" class="file-loading" value="{{$id->cover_photo}}" placeholder="{{$id->cover_photo}}" onchange="readURL4(this);">
                                </label>
                           </label>
                           <div class="col-md-8" style="text-align:center">
                                <script type="text/javascript">
                                    function readURL4(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function (e) {
                                                $('#tour_cover_photo').attr('src', e.target.result);
                                            }

                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>
                                <img id="tour_cover_photo" src="{{ url('/uploads/tours/cover_photo')}}/{{$id->cover_photo}}" alt="" class="img-thumbnail" height="200" width="auto"/> 
                           </div>
                       </div>
                      <label></label>
                       <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" method="post">
                                     Modify Tour
                                </button>
                            </div>
                        </div> 
                   </form>
                      </div>
                      <div class="modal-footer">
                       
                      </div>
                    </div>
                  </div>
                </div>
            
{{-- model request/follow/joiner --}}
<div class="modal modal-sm fade" id="requestModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="height:500px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Request List</h4>
      </div>
      <div class="modal-body" style="height:400px;overflow-y: auto;">
      <input class="hidden" id ="csrf" value="{{ csrf_token() }}"/>
      <script src="../assets/js/jquery-1.11.2.min.js"></script>
          @foreach($userTourWaitjoin as $user)
              <script>
              var CSRF_TOKEN=$('#csrf').val();
              $(document).ready(function(){
                  $("#buttonA{{$user->user_id}}").click(function(){
                        $.ajax({
                          url: '/link_update_by_own', 
                          method:'post', 
                          data: {_token:CSRF_TOKEN, user_id:{{$user->user_id}}, tour_id:{{$id->id}}, choose:'agree'},
                          dataType: 'text',
                          success: function(result){
                            $("#divR{{$user->user_id}}").remove();
                          }
                        });
                        $("#requestModal").on('hidden.bs.modal', function () { location.reload() }); 
                      });
              });
              </script>
              <script>
              var CSRF_TOKEN=$('#csrf').val();
              $(document).ready(function(){
                  $("#buttonD{{$user->user_id}}").click(function(){
                        $.ajax({
                          url: '/link_update_by_own', 
                          method:'post', 
                          data: {_token:CSRF_TOKEN, user_id:{{$user->user_id}}, tour_id:{{$id->id}}, choose:'disagree'},
                          dataType: 'text',
                          success: function(result){
                            $("#divR{{$user->user_id}}").remove();
                          }
                        });
                        $("#requestModal").on('hidden.bs.modal', function () { location.reload() }); 
                      });
              });
              </script>
              <div id="divR{{$user->user_id}}" class="col-md-11" style="margin-top:2px;margin-bottom:2px;display: flex;align-items: center;justify-content: center;">
                <div class="col-md-2">
                  <a href="{{url("user")}}/{{$user->user_id}}"><img id="" src="{{ url('/uploads/users/avatar_photo')}}/{{$user->avatar_photo}}" alt="" class="img-thumbnail" height="48px" width="48px"></a>
                </div>
                <div class="col-md-5">
                  <a href="{{url("user")}}/{{$user->user_id}}" style="color:black"><p>{{$user->name}}</p></a>
                </div>
                <div class="col-md-2" style="margin-left:4%">
                  <a id="buttonA{{$user->user_id}}" href="javascript:{}" class="btn btn-success">Agree</a>
                </div>
                <div class="col-md-2" style="margin-left:4%">
                  <a id="buttonD{{$user->user_id}}" href="javascript:{}" class="btn btn-primary">Disagree</a>
                </div>
              </div>
          @endforeach
    </div>
  </div>
</div>
</div>

<div class="modal modal-sm fade" id="followModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="height:500px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Follow List</h4>
      </div>
      <div class="modal-body" style="height:400px;overflow-y: auto;">
          
          <div class="row">
              <div class="col-md-12" style="margin-top:2px;margin-bottom:2px;">
              
                <div class="row" style="display: flex;align-items: center;justify-content: center;">
                @foreach($userTourFollow as $user)
                  <div class="col-sm-2">
                    <a href="{{url("user")}}/{{$user->user_id}}"><img id="" src="{{ url('/uploads/users/avatar_photo')}}/{{$user->avatar_photo}}" alt="" class="img-thumbnail" height="48px" width="48px"/></a>
                  </div>
                  <div class="col-sm-4">
                    <a href="{{url("user")}}/{{$user->user_id}}" style="color:black"><p>{{$user->name}}</p></a>
                  </div>
                  <?php
                     $number=$number+1;
                    ?>
                @if($number%2==0) 
                </div>
                <div class="row" style="display: flex;align-items: center;justify-content: center;">
                @endif
                @endforeach
                </div>
                
              </div>
          </div>      
    </div>
  </div>
</div>
</div>

<div class="modal modal-sm fade" id="joinModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="height:500px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Join List</h4>
      </div>
      <div class="modal-body" style="height:400px;overflow-y: auto;">
      <input class="hidden" id ="csrf" value="{{ csrf_token() }}"/>
      <script src="../assets/js/jquery-1.11.2.min.js"></script>
          @foreach($userTourJoin as $user)
              <script>
              var CSRF_TOKEN=$('#csrf').val();
              $(document).ready(function(){
                  $("#buttonJ{{$user->user_id}}").click(function(){
                        $.ajax({
                          url: '/link_update_by_own', 
                          method:'post', 
                          data: {_token:CSRF_TOKEN, user_id:{{$user->user_id}}, tour_id:{{$id->id}}, choose:'unjoin'},
                          dataType: 'text',
                          success: function(result){
                            $("#divJ{{$user->user_id}}").remove();
                          }
                        });
                        $("#joinModal").on('hidden.bs.modal', function () { location.reload() });    
                      });
              });
              </script>
            <div id="divJ{{$user->user_id}}" class="row" style="display: flex;align-items: center;justify-content: center;">
                <div class="col-sm-2">
                  <a href="{{url("user")}}/{{$user->user_id}}"><img id="" src="{{ url('/uploads/users/avatar_photo')}}/{{$user->avatar_photo}}" alt="" class="img-thumbnail" height="48px" width="48px"/></a>
                </div>
                <div class="col-sm-6">
                  <a href="{{url("user")}}/{{$user->user_id}}" style="color:black"><p>{{$user->name}}</p></a>
                </div>
                <div class="col-sm-2">
                  <a id="buttonJ{{$user->user_id}}" href="javascript:{}" onclick="" class="btn btn-primary">Unjoin</a>
                </div>
              </div>  
          @endforeach
          
    </div>
  </div>
</div>
</div>
@endsection
