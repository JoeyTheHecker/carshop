<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="{{ URL::asset('images/RFShop-favicon.png') }}" type="image/png">

  <title>Authorize User Only</title>

  <link rel="stylesheet" href="{{ URL::asset('css/style.default.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/jquery.datatables.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-timepicker.min.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-fileupload.min.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/jquery.tagsinput.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/dropzone.css') }}" />
  <!-- override css -->
  <link rel="stylesheet" href="{{ URL::asset('css/override.css?v=1.1.1') }}" />
</head>

<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
    <div class="leftpanel">
        <div class="logopanel">
            <h1><img src="{{ URL::asset('images/toyota_resized.png') }}" title="" alt="" style="width: 100%;"></h1>
        </div><!-- logopanel -->
        <div class="leftpanelinner">
            <!-- This is only visible to small devices -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media userlogged">
                    <div class="media-body"><h4>{{ Auth::user()->name }}</h4></div>
                </div>
                <h5 class="sidebartitle actitle">Account</h5>
                <ul class="nav nav-pills nav-stacked nav-bracket mb30">
                    <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
                    <li><a href="#"><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
                    <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>
            <h5 class="sidebartitle p-10-15">Navigation</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket">
                <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="nav-parent"><a href="#"><i class="fa fa-truck"></i> Products</a>
                    <ul class="children" style="display: block;">
                        <li><a href="{{ url('/product#tab1') }}" data-hash="isActive">- Active</a></li>
                        <li><a href="{{ url('/product#tab2') }}" data-hash="isSold">- Sold</a></li>
                        <li><a href="{{ url('/product#tab3') }}" data-hash="isInactive">- Draft</a></li>
                        <li><a href="{{ url('/product#tab4') }}" data-hash="isDeleted">- Deleted</a></li>
                    </ul>
                </li>
                {{-- <li><a href="{{ url('/pricelists') }}"><i class="fa fa-download"></i> Price Lists</a></li>
                <li><a href="{{ url('/inquiry') }}"><i class="fa fa-pencil"></i> Inquiry</a></li>
                <li><a href="{{ url('/subscribers') }}"><i class="fa fa-folder"></i> Subscribers</a></li>

                <li class="nav-parent"><a href="#"><i class="fa fa-truck"></i>Bidder Accounts</a>
                    <ul class="children" style="display: block;">
                        <li><a href="{{ url('/bidder-accounts#tab1') }}" data-hash="isActive">- Pending</a></li>
                        <li><a href="{{ url('/bidder-accounts#tab2') }}" data-hash="isSold">- Approved</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/intent') }}"><i class="fa fa-book"></i> Bidder Lists</a></li>
                <li><a href="{{ url('/web/bidding') }}"><i class="fa fa-book"></i> Bidding Lists</a></li> --}}
                <li><a href="{{ url('/loi') }}"><i class="fa fa-folder-open-o"></i> LOI Lists</a></li>
                <!-- @if(Auth::user()->role_id == 0)
                    <li><a href="{{ url('/user') }}"><i class="fa fa-group"></i> User Management</a></li>
                @endif -->
                    {{-- <li><a href="{{ url('/user') }}"><i class="fa fa-group"></i> User Management</a></li> --}}
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> <span style="margin-left: 0px;">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div><!-- leftpanelinner -->
    </div><!-- leftpanel -->

    <div class="mainpanel">
        <div class="headerbar"><!--<a class="menutoggle"><i class="fa fa-bars"></i></a>-->
        <div class="header-right">
            <ul class="headermenu">
                <li>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="{{ url('/profile') }}"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div><!-- header-right -->
    </div><!-- headerbar -->

    @yield('content')

    </div><!-- mainpanel -->
</section>

<script src="{{ URL::asset('js/jquery-1.10.2.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery-ui-1.10.3.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-fileupload.min.js') }}"></script>
<script src="{{ URL::asset('js/modernizr.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.sparkline.min.js') }}"></script>
<script src="{{ URL::asset('js/toggles.min.js') }}"></script>
<script src="{{ URL::asset('js/retina.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.cookies.js') }}"></script>
<script src="{{ URL::asset('js/flot/flot.min.js') }}"></script>
<script src="{{ URL::asset('js/flot/flot.resize.min.js') }}"></script>
<script src="{{ URL::asset('js/morris.min.js') }}"></script>
<script src="{{ URL::asset('js/raphael-2.1.0.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.datatables.min.js') }}"></script>
<script src="{{ URL::asset('js/chosen.jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.tagsinput.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.maskedinput.min.js') }}"></script>
<script src="{{ URL::asset('js/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('js/custom.js') }}"></script>
@yield('javascript')
</body>
</html>
