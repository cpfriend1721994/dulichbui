<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="../images/backpack.png" />
    <title>Đi Bụi</title>


    {{--  --}}

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <link href="../bootstrap3/css/bootstrap.css" rel="stylesheet" />
    <link href="../bootstrap3/css/font-awesome.css" rel="stylesheet" />

    <link href="../assets/css/get-shit-done.css" rel="stylesheet" />
    <link href="../assets/css/demo.css" rel="stylesheet" />

    {{-- <link href="../login-register.css" rel="stylesheet" />
    <script src="../login-register.js" type="text/javascript"></script> --}}

    <link href="../assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
    {{-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'> --}}
    <link href="../roboto.css" rel='stylesheet' type='text/css'>
    <link href='../css/rotating-card.css' rel='stylesheet' />


    {{--  --}}



</head>
<body id="app-layout">

{{--  --}}

<div id="navbar-full" class='blurred-container'>
<div class="img-src" style="background-image: url('../assets/img/cover_4.jpg')"></div>
  <div class='img-src blur' style="background-image: url('../assets/img/cover_4_blur.jpg')"></div>
    <div id="navbar">
    <!--
        navbar-default can be changed with navbar-ct-blue navbar-ct-azzure navbar-ct-red navbar-ct-green navbar-ct-orange
        -->
        <nav class="navbar navbar-ct-nnmt94 navbar-transparent navbar-fixed-top" role="navigation">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <a class="navbar-brand" href="{{url('/')}}">Du Lịch Bụi</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="">
              <ul class="nav navbar-nav">
                <li>
                    <a href="javascript:void(0);" data-toggle="search" class="hidden-xs"><i class="fa fa-search"></i></a>
                </li>
              </ul>
               <form class="navbar-form navbar-left navbar-search-form" role="search">
                 <div class="form-group">
                      <input type="text" value="" class="form-control" placeholder="Search...">
                 </div>
              </form>
              <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        
                        <li><a href="{{ url('/register') }}">Register</a></li>
                        <li><a href="{{ url('/login') }}" class="btn">Login</a></li>
                        
                        {{-- <li><a data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register</a></li>
                        <li><button class="btn btn-square btn-default" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Login</button></li> --}}
                    @else
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                <li><a href="{{ url('/user/') }}/{{ Auth::id()}}"><i class="fa fa-btn fa-user"></i> User Information</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                              </ul>
                        </li>
                        <li>
                          <div class="navbar-nnmt">
                            <a href="{{ url('/user/') }}/{{ Auth::id()}}"><img src="{{ url('/uploads/users/avatar_photo')}}/{{Auth::user()->avatar_photo}}" alt="Circle Image" class="img-circle" height="40" width="40"></a>
                            </div>
                        </li>
                    @endif
                </ul>

            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

<div style="height:100px;" ></div>
<div id="carousel">
    <div id="carousel-example-generic" class="carousel slide gsdk-transition" data-ride="carousel">
      <!-- Indicators -->
      {{-- <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol> --}}

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <div class="motto">
                    <div>Connect</div>
                    <div class="border">People</div>
                </div>
        </div>
        <div class="item">
          <div class="motto">
                    <div>Make</div>
                    <div class="border">Plans</div>
                </div>
        </div>
        <div class="item">
          <div class="motto">
                    <div>Share</div>
                    <div class="border">Feelings</div>
                </div>
        </div>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="fa fa-angle-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="fa fa-angle-right"></span>
      </a>
    </div>
</div>
<div style="height:10px;" ></div>                


    </div><!--  end navbar -->


</div> <!-- end menu-dropdown -->


{{--  --}}


{{-- modal login/register --}}

<div style="overflow:hidden;" class="modal fade login" id="loginModal">
              <div class="modal-dialog login animated">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login</h4>
                    </div>
                    <div class="modal-body">  
                        <div class="box">
                             <div class="content">
                                {{-- <div class="social">
                                    <a class="circle github" href="/auth/github">
                                        <i class="fa fa-github fa-fw"></i>
                                    </a>
                                    <a id="google_login" class="circle google" href="/auth/google_oauth2">
                                        <i class="fa fa-google-plus fa-fw"></i>
                                    </a>
                                    <a id="facebook_login" class="circle facebook" href="/auth/facebook">
                                        <i class="fa fa-facebook fa-fw"></i>
                                    </a>
                                </div>
                                <div class="division">
                                    <div class="line l"></div>
                                      <span>or</span>
                                    <div class="line r"></div>
                                </div> --}}
                                <div class="error"></div>
                                <div class="form loginBox">
                                    <form method="post" action="{{ url('/login') }}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input id="email" class="form-control" type="email" placeholder="Email" name="email" value="{{ old('email') }}">
                                    <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                    <input class="btn btn-default btn-login" type="button" value="Login" onclick="loginAjax()">
                                    </form>
                                </div>
                             </div>
                        </div>
                        <div class="box">
                            <div class="content registerBox" style="display:none;">
                             <div class="form">
                                <form method="post" html="{:multipart=>true}" data-remote="true" action="{{ url('/register') }}" accept-charset="UTF-8">
                                {{ csrf_field() }}
                                <input id="name" type="text" class="form-control" placeholder="Name" name="name">
                                <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                                <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation">
                                <input class="btn btn-default btn-register" type="submit" value="Create account" name="commit">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="forgot login-footer">
                            <span>Looking to 
                                 <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
                        </div>
                        <div class="forgot register-footer" style="display:none">
                             <span>Already have an account?</span>
                             <a href="javascript: showLoginForm();">Login</a>
                        </div>
                    </div>        
                  </div>
              </div>
          </div>

    </div>

{{--  --}}
    @yield('content')

{{--  --}}

    <script src="../jquery/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/js/jquery-1.11.2.min.js"></script>
    <script src="../bootstrap3/js/bootstrap.js" type="text/javascript"></script>
    <script src="../assets/js/gsdk-checkbox.js"></script>
    <script src="../assets/js/gsdk-radio.js"></script>
    <script src="../assets/js/gsdk-bootstrapswitch.js"></script>
    <script src="../assets/js/get-shit-done.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap-table.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script type="text/javascript">
        var $table = $('#fresh-table'),
            $alertBtn = $('#alertBtn'), 
            full_screen = false,
            window_height;
            
        $().ready(function(){
            
            window_height = $(window).height();
            table_height = window_height - 20;
            
            
            $table.bootstrapTable({
                toolbar: ".toolbar",

                showRefresh: true,
                search: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                striped: true,
                sortable: true,
                height: table_height,
                pageSize: 25,
                pageList: [25,50,100],
                
                formatShowingRows: function(pageFrom, pageTo, totalRows){
                    //do nothing here, we don't want to show the text "showing x of y from..." 
                },
                formatRecordsPerPage: function(pageNumber){
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });
            
            window.operateEvents = {
                'click .like': function (e, value, row, index) {
                    alert('You click like icon, row: ' + JSON.stringify(row));
                    console.log(value, row, index);
                },
                'click .edit': function (e, value, row, index) {
                    alert('You click edit icon, row: ' + JSON.stringify(row));
                    console.log(value, row, index);    
                },
                'click .remove': function (e, value, row, index) {
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: [row.id]
                    });
            
                }
            };
            
            $alertBtn.click(function () {
                alert("You pressed on Alert");
            });
        
            
            $(window).resize(function () {
                $table.bootstrapTable('resetView');
            });    
        });
        

        function operateFormatter(value, row, index) {
            return [
                '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
                    '<i class="fa fa-heart"></i>',
                '</a>',
                '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
                    '<i class="fa fa-edit"></i>',
                '</a>',
                '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
                    '<i class="fa fa-remove"></i>',
                '</a>'
            ].join('');
        }

    </script>
        <div class='blurred-container navbar navbar-fixed-bottom' style="height:90px">
            <div style="height:55px"></div>
            <div class="container text-left">
                <b style="color:white">Copyright &copy 2016 NNMT. All Rights Reserved.</b>
                <a href="#"><small style="color:white" class="fa fa-lg fa-skype pull-right">  </small></a>
                <a href="#"><small style="color:white" class="fa fa-lg fa-google-plus pull-right">  </small></a>
                <a href="#"><small style="color:white" class="fa fa-lg fa-linkedin pull-right">  </small></a>
                <a href="#"><small style="color:white" class="fa fa-lg fa-twitter pull-right">  </small></a>
                <a href="#"><small style="color:white" class="fa fa-lg fa-facebook pull-right">  </small></a>
                <a href="#"><small style="color:white" class="fa fa-lg fa-github pull-right">  </small></a>
            </div>
        </div>
{{--  --}}
    
</body>
</html>
