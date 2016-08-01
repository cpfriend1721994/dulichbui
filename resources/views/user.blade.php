@extends('layouts.app')

@section('content')

<?php
    $listOwn=$listTour->where('type','own')->where('user_id',Auth::id());
    $listFollow=$listTour->where('type','follow')->where('user_id',Auth::id());
    $listWaitjoin=$listTour->where('type','waitjoin')->where('user_id',Auth::id());
    $listJoin=$listTour->where('type','join')->where('user_id',Auth::id());
 ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0" style="background-image: url('../uploads/users/cover_photo/{{$id->cover_photo}}');background-size: cover;background-attachment:scroll;">
        	<div style="height:200px;" ></div>
        	<div class="row">
				<div class="col-md-4">
			        <img src="{{ url('/uploads/users/avatar_photo')}}/{{$id->avatar_photo}}" alt="Thumbnail Image" class="img-thumbnail">
				</div>
			</div>
			<div style="height:20px;" ></div>
        </div>

        <div class="col-md-12 col-md-offset-0 section-gray" style="min-height:450px">
			@if($id->id==Auth::id())
        	<div class="col-sm-9 col-sm-offset-0">
            @else
            <div class="col-sm-4 col-sm-offset-0"></div>
            <div class="col-sm-6 col-sm-offset-0">
            @endif
    	{{-- <ul class="nav nav-tabs"> --}}
		       <ul class="nav nav-pills ct-orange" >
		       	
			    <li class="active" ><a data-toggle="tab" href="#profile">Profile</a></li>
			    <li><a data-toggle="tab" href="#myplan">Own Tour</a></li>
			    <li><a data-toggle="tab" href="#myfollow">Follow Tour</a></li>
			    <li><a data-toggle="tab" href="#myjoin">Join Tour</a></li>
			    
			  </ul>
	  		</div>
            @if($id->id==Auth::id())
	  		<div class="col-sm-3 col-sm-offset-0" style="text-align:right">              
	  			<button class="btn btn-warning" data-toggle="modal" data-target="#myModal">Edit Profile</button>
                {{-- <a href="{{ url('/tour_create') }}" class="btn btn-warning">Create Plan</a> --}}
                <button class="btn btn-warning" data-toggle="modal" data-target="#myModal2">Create Tour</button>
	  		</div>
            @endif
       <div style="height:50px;" ></div>
	  		
	   <div class="tab-content">

		    <div id="profile" class="tab-pane fade in active">
		     <h1 class="text-center">{{$id->name}}</h1>
		     <h4><div class="col-sm-4"></div><div class="col-sm-2"><strong>Gender: </strong></div> <div class="col-sm-6">{{$id->gender}}</div></h4>
		     <br>
		     <h4><div class="col-sm-4"></div><div class="col-sm-2"><strong>Birthday: </strong></div> <div class="col-sm-6">{{$id->birthday}}</div></h4>
		     <br>
		     <h4><div class="col-sm-4"></div><div class="col-sm-2"><strong>Email: </strong></div> <div class="col-sm-6">{{$id->email}}</div></h4>
		     <br>
		     <h4><div class="col-sm-4"></div><div class="col-sm-2"><strong>Address: </strong></div> <div class="col-sm-6">{{$id->address}}</div></h4>
		     <div style="height:50px;" ></div>
		     {{-- <div class="col-sm-5"></div><div class="col-sm-2">
		     	<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                  Edit Profile
                </button>	
		     </div><div class="col-sm-5"></div> --}}
		     <div style="height:50px;" ></div>
		    </div>

		    <div id="myplan" class="tab-pane fade">
		      

<div style="height:20px;" ></div>
<div class="wrapper">
    <div class="fresh-table toolbar-color-red">
    <!--    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange                  
            Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
    -->
        
        <table id="fresh-table" class="table">
            @if($listOwn->count()!=0)
            <thead>
            	<th data-field="tour_name" data-sortable="true">Name</th>
            	<th data-field="start_time" data-sortable="true">Start Time</th>
            	<th data-field="start_place" data-sortable="true">Start Place</th>
            	<th data-field="user_max" data-sortable="true">Max Join User</th>
                <th data-field="status" data-sortable="true">Status</th>
            </thead>
            @endif
            <tbody>
            @foreach($listOwn as $row)
                <tr>
                	<td><a href="../tour/{{$row->id}}" color="black">{{$row->tour_name}}</a></td>
                	<td>{{$row->start_time}}</td>
                	<td>{{$row->start_place}}</td>
                	<td>{{$row->user_max}}</td>
                    <td>{{$row->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
</div>


		    </div>

		    <div id="myfollow" class="tab-pane fade">
		      <div style="height:20px;" ></div>
<div class="wrapper">
    <div class="fresh-table toolbar-color-azure">
    <!--    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange                  
            Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
    -->
        
        <table id="fresh-table2" class="table">
            @if(($listFollow->count()!=0)||($listWaitjoin->count()!=0))
            <thead>
                <th data-field="tour_name" data-sortable="true">Name</th>
                <th data-field="start_time" data-sortable="true">Start Time</th>
                <th data-field="start_place" data-sortable="true">Start Place</th>
                <th data-field="user_max" data-sortable="true">Max Join User</th>
                <th data-field="status" data-sortable="true">Status</th>
            </thead>
            @endif
            <tbody>
            @foreach($listFollow as $row)
                <tr>
                    <td><a href="../tour/{{$row->id}}" color="black">{{$row->tour_name}}</a></td>
                    <td>{{$row->start_time}}</td>
                    <td>{{$row->start_place}}</td>
                    <td>{{$row->user_max}}</td>
                    <td>{{$row->status}}</td>
                </tr>
            @endforeach
            @foreach($listWaitjoin as $row)
                <tr>
                    <td><a href="../tour/{{$row->id}}" color="black">{{$row->tour_name}}</a></td>
                    <td>{{$row->start_time}}</td>
                    <td>{{$row->start_place}}</td>
                    <td>{{$row->user_max}}</td>
                    <td>{{$row->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
</div>
		    </div>

		    <div id="myjoin" class="tab-pane fade">
		      <div style="height:20px;" ></div>
<div class="wrapper">
    <div class="fresh-table toolbar-color-green">
    <!--    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange                  
            Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
    -->
        
        <table id="fresh-table3" class="table">
            @if($listJoin->count()!=0)
            <thead>
                <th data-field="tour_name" data-sortable="true">Name</th>
                <th data-field="start_time" data-sortable="true">Start Time</th>
                <th data-field="start_place" data-sortable="true">Start Place</th>
                <th data-field="user_max" data-sortable="true">Max Join User</th>
                <th data-field="status" data-sortable="true">Status</th>
            </thead>
            @endif
            <tbody>
            @foreach($listJoin as $row)
                <tr>
                    <td><a href="../tour/{{$row->id}}" color="black">{{$row->tour_name}}</a></td>
                    <td>{{$row->start_time}}</td>
                    <td>{{$row->start_place}}</td>
                    <td>{{$row->user_max}}</td>
                    <td>{{$row->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
</div>
		    </div>
	  </div>
                        
			</div>
    </div>
</div>

                

                <!-- Modal Create Tour-->
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel2" >Create Tour</h4>
                      </div>
                      <div class="modal-body">
                      	 
                        <form action="{{url("tour_create")}}" method="POST" role="form" enctype="multipart/form-data">
                   		{{csrf_field()}}

                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">Tour Name</label>
                           <div class="col-md-8">
                                <input type="text" class="form-control" id="" placeholder="" value="" name="tour_name">
                           </div>
                       </div>
                       
                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">Start Time</label>
                           <div class="col-md-8">
                                <input type="datetime-local" class="form-control" id="" placeholder="" value="" name="start_time">
                           </div>
                       </div>
                       
                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">Start Place</label>
                           <div class="col-md-8">
                                <input type="text" class="form-control" id="" placeholder="" value="" name="start_place">
                           </div>
                       </div>

                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">Max Join User</label>
                           <div class="col-md-8">
                                <input type="text" class="form-control" id="" placeholder="" value="" name="user_max">
                           </div>
                       </div>
                       <label></label>
                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">
                           Cover Photo
                           <label class="btn btn-default btn-file">
                                    Browse... <input name="cover_photo" type="file" style="display: none;" class="file-loading" value="" placeholder="" onchange="readURL3(this);">
                                </label>
                           </label>
                           <div class="col-md-8" style="text-align:center">
                                <script type="text/javascript">
                                    function readURL3(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function (e) {
                                                $('#tour_cover_photo').attr('src', e.target.result);
                                            }

                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>
                                <img id="tour_cover_photo" src="../images/transparent.png" alt="" class="img-thumbnail" height="200" width="auto"/> 
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
                <!-- -->

                <!-- Modal Edit Profile-->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel" >Edit Profile</h4>
                      </div>
                      <div class="modal-body">
                         
                        <form action="{{url("user")}}/{{$id->id}}" method="POST" role="form" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="form-group">
                           <label for="" class="col-md-4 control-label">
                           Avatar Photo
                           <label class="btn btn-default btn-file">
                                    Browse... <input name="avatar_photo" type="file" style="display: none;" class="file-loading" value="{{$id->avatar_photo}}" placeholder="{{$id->avatar_photo}}" onchange="readURL(this);">
                                </label>
                           </label>
                           <div class="col-md-8" style="text-align:center">
                                <script type="text/javascript">
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function (e) {
                                                $('#avatar_photo').attr('src', e.target.result);
                                            }

                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>
                                <img id="avatar_photo" src="{{ url('/uploads/users/avatar_photo')}}/{{$id->avatar_photo}}" alt="Avatar" class="img-thumbnail" height="70" width="70"/>
                           </div>
                       </div> 
                       <label></label>
                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">
                           Cover Photo
                           <label class="btn btn-default btn-file">
                                    Browse... <input name="cover_photo" type="file" style="display: none;"class="file-loading" value="{{$id->cover_photo}}" placeholder="{{$id->cover_photo}}" onchange="readURL2(this);">
                                </label>
                           </label>
                           <div class="col-md-8" style="text-align:center">
                                <script type="text/javascript">
                                    function readURL2(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function (e) {
                                                $('#cover_photo').attr('src', e.target.result);
                                            }

                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>
                                <img id="cover_photo" src="{{ url('/uploads/users/cover_photo')}}/{{$id->cover_photo}}" alt="Cover" class="img-thumbnail" height="200" width="200"/> 
                           </div>
                       </div> 
                       <label></label>
                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">Name</label>
                           <div class="col-md-8">
                                <input type="text" class="form-control" id="" placeholder="{{$id->name}}" value="{{$id->name}}" name="name">
                           </div>
                       </div>
                       
                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">Address</label>
                           <div class="col-md-8">
                                <input type="text" class="form-control" id="" placeholder="{{$id->address}}" value="{{$id->address}}" name="address">
                           </div>
                       </div>
                       
                       <div class="form-group">
                           <label for="" class="col-md-4 control-label">Birthday</label>
                           <div class="col-md-8">
                                <input type="datetime-local" class="form-control" id="" placeholder="{{$id->birthday}}" value="{{$id->birthday}}" name="birthday">
                           </div>
                       </div>
                       
                       <div class="form-group">
                          <label for="" class="col-md-4 control-label">Gender</label>
                            <div class="col-md-8">
                              <select class="form-control" id="" name = "gender" placeholder="{{$id->gender}}" value="{{$id->gender}}">
                                <option name="male">male</option>
                                <option name="female">female</option>
                              </select>
                            </div>
                      </div>
                      <label></label>
                       <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" method="post">
                                     Update Profile
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
                <!-- -->
@endsection



