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
        	<div style="height:60px;" ></div>
        </div>
    </div>
</div>

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
                                    Browse... <input name="cover_photo" type="file" style="display: none;"class="file-loading" value="{{$id->cover_photo}}" placeholder="{{$id->cover_photo}}" onchange="readURL4(this);">
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
                                     Create Tour
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
