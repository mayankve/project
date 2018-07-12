<!-- After login layout -->
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="route" content="{{ url('/') }}">
        <!-- favicon -->
        <link href="{{ url('images/logo.png') }}" rel="shortcut icon" type="image/vnd.microsoft.icon">
        <!-- Styles -->
        <link href="{{ URL::asset('css/jquery-ui.min.css') }}" media="screen" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/style.css') }}" media="screen" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" media="screen" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/bootstrap-theme.min.css') }}" media="screen" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/mode_image.css') }}" media="screen" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/jquery.timepicker.css') }}" media="screen" rel="stylesheet" type="text/css">
        <!-- Scripts -->
        <script type="text/javascript" src="{{ URL::asset('js/jquery-3.1.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/ckeditor.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/modernizr.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.waypoints.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/model_image.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
        <!-- Custom js for common functionality -->
        <script type="text/javascript" src="{{ URL::asset('js/custom/home.js') }}"></script>
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>
        <!-- font  -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet"> 
        <!-- font Awesome Cdn -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <style type="text/css">
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="img01">
        </div>
        <nav id="customNav" class="navbar navbar-default navbar-transparent navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/aat/public/"><img src="{{ url('images/logo.png') }}" alt="logo"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <!--------Cart Begin------->
                        <ul class="navbar-right cartbtn">
                        <li><a href="#" id="cart"><span class="cart-icon-btn">
                        <i class="fa fa-shopping-cart"></i> Cart </span>
                        <span class="badge mybadge">3</span></a></li>
                        `<div class="shopping-cart" style="display:none;">
                            <div class="shopping-cart-header">
                                <div class="cart_btn"><i class="fa fa-shopping-cart cart-icon"></i><span class="badge mybadge">3</span></div>
                                <div class="shopping-cart-total">
                                    <span class="lighter-text">Total:</span>
                                    <span class="main-color-text">$2,229.97</span>
                                </div>
                            </div> <!--end shopping-cart-header -->

                            <ul class="shopping-cart-items">
                                <li class="clearfix">
                                    <div>Ghana, Togo, Benin &amp; Morocco 2017</div>
                                </li>
                                <li class="clearfix">
                                    <span class="item-title">Airlines</span>
                                    <span class="item-name">Alaska Airlines</span>
                                    <span class="item-price">$564</span>
                                    <span class="item-quantity">Quantity: 02</span>
                                </li>
                                <li class="clearfix">
                                    <span class="item-title">Hotel</span>
                                    <span class="item-name">Blue</span>
                                    <span class="item-price">$564</span>
                                    <span class="item-quantity">Person: 02. Solo: Yes</span>
                                </li>
                                 <li class="clearfix">
                                    <span class="item-title">Addons</span>
                                    <span class="item-name">Addon Name</span>
                                    <span class="item-price">$564</span>
                                    <span class="item-quantity">Person: 02. Solo: Yes</span>
                                </li>
                                <li class="clearfix">
                                    <span class="item-title">Included Activities</span>
                                    <span class="item-name">Acitiviy name</span>
                                    <span class="item-price">$564</span>
                                    <span class="item-quantity">Person: 02. Solo: Yes</span>
                                </li>
                            </ul>
                            <a href="#" class="button">Checkout</a>
                        </div>
                    </ul>
                    <!--- Cart End------>
                    <!-- User profile -->
                    <!-- Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class=""><a href="{{url('/about') }}">About </a></li>
                        <li class="dropdown dropdown-hov">
                            <a href="{{url('/listtrip') }}">Trips <span class="caret"></span></a>
                            <ul class="dropdown-menu" style="display: none;">
                                @if(count($data['trips']) > 0))
                                @foreach($data['trips'] AS $trip)
                                <li><a href="{{url('tripview/'.$trip->trip_id)}}">{{$trip->name}}</a></li>
                                @endforeach      
                                @endif
                            </ul>
                        </li>
                        <li><a href="#"> Testimony </a></li>
                        <li><a href="{{url('/contact') }}"> Contact</a></li>
                        <?php
                        //  log(1);
                        $userId = Auth::id();
                        if (!isset($userId)) {
                            ?>
                        <li>
                        <a href="{{url('/login') }}"> <i class="fa fa-lock" aria-hidden="true"></i>Client login</a></li>
                        <?php } else{
                            ?> 
                            <li><a href="{{url('/dashboard') }}"> Dashboard</a></li>
                            <div class="user-profile">
                                <li class="dropdown dropdown-hov">
                                    <a class="user-img">
                                    <img src="/aat_zend/public/assets/profile_img/80d93e10f0653f507e7402dbb531a8a1.jpg" alt="tm-01" class="img-responsive model_image" style="max-width: 50px ;height: 50px ;"></a>
                                    <ul class="dropdown-menu" style="display: none;">
                                        <li><a href="{{ url('/dashboard') }}">View profile</a></li>
                                        <li><a href="{{ url('/changepassword') }}">Change password</a></li>
                                        <li><a href="{{ url('/logout') }}"> <i class="fa fa-lock" aria-hidden="true"></i> Logout </a></li>
                                    </ul>
                                </li>
                            </div>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="wrapper">
            <div class="alert-message"></div>
            <div class="deshboard_body">
                <!-- Sidebar -->
                <div class="navbar-default sidebar">
                    <div class="tab">
                        <div class="desh-fixed">
                            <h2><div class="hombtn"><i class="fa fa-home home-icon" aria-hidden="true"></i></div>Dashboard</h2>
                        </div> 
                        <ul class="nav tablist-menu" id="accordion1">
                            <li><a href="{{ url('/dashboard') }}" class="tablinks  active" id="my_information"><i class="fa fa-info-circle" aria-hidden="true"></i>My Information</a></li>
                            <li class="custom-panel"><a data-toggle="collapse" data-parent="#accordion1" href="#account_info" class="" aria-expanded="true"><i class="fa fa-info-circle" aria-hidden="true"></i>Traveler Information</a>
                                <ul id="account_info" class="sub-menu collapse trip-travelers" aria-expanded="true">
                                    <li> <a data-toggle="collapse" data-parent="#accordion1" href="#level23"  class="tablinks collapsed" aria-expanded="false">f</a>
                                        <ul id="level23" class="sub-menu sub-link collapse trip-travelers-list" aria-expanded="false">
                                            <li class='travelers'><a href="#" class="tablinks ">Maneesh</a></li>
                                            <li class='travelers'><a href="#" class="tablinks ">Vaishnavesh</a></li>
                                        </ul>
                                    </li>
                                    <li> 
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#level12"  class="tablinks collapsed" aria-expanded="false">Ghana, Togo, Benin & Morocco 2017</a>
                                        <ul id="level12" class="sub-menu sub-link collapse trip-travelers-list" aria-expanded="false">
                                            <li class='travelers'><a href="/aat_backup/public/dashboard/view-traveler/1" class="tablinks ">vaishnavesh3</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="custom-panel"><a data-toggle="collapse" data-parent="#accordion1" href="#my_trip">
                                    <i class="fa fa-plane" aria-hidden="true"></i>My Trips</a>
                                <ul id="my_trip" class="collapse sub-menu">
                                    @if(count($data['user_trips']) > 0))
                                    @foreach($data['user_trips'] AS $trip)
                                    <li><a href="{{url('mytripdesign/'.$trip->trip_id)}}" class="tablinks ">{{$trip->name}}</a></li>
                                    @endforeach      
                                    @endif
                                </ul>
                            </li>
                            <li><a href="{{ url('listtrip/') }}" class="tablinks " id="my_information"><i class="fa fa-list margin-bottom"></i>Trips</a></li>
                        </ul>
                        <!-- Brand link-->
                        <div class="brandlink">
                            <a href="http://www.africanamericantravelers.com" target="_blank">africanamericantravelers.com</a>
                        </div>
                    </div>
                </div>

                <!-- end Sidebar -->
                <!-- Page Content -->
                <div>
                    @yield('content')
                </div>
                <!-- Page Content -->
            </div>
            <footer class="footer footer-color-black">
                <div class="container">
                    <div class="col-md-2"> <div class="footer-logo"> <img src="{{ url('images/logo.png') }}" alt="logo"> </div> </div>
                    <div class="col-md-5"> 
                        <div class="footer-para"> Vestibulum tempor ipsum sed hendrerit iaculis. Proin vel scelerisque velit, non auctor velit. 
                            Curabitur convallis ultricies facilisis. Aenean rutrum arcu nec turpis ultrices ultricies. Vivamus ut bibendum ipsum.
                            Vivamus ut metus magna. Vivamus imperdiet id quam id sodales. 
                        </div> 
                    </div>
                    <div class="col-md-5">
                        <nav class="footer-navi">
                            <ul>
                                <li>
                                    <a target="_blank" href="#">
                                        About
                                    </a>|
                                </li>
                                <li>
                                    <a target="_blank" href="#">
                                        Trips
                                    </a>|
                                </li>
                                <li>
                                    <a target="_blank" href="#">
                                        Testimony 
                                    </a>|
                                </li>
                                <li>
                                    <a target="_blank" href="#">
                                        Blog 
                                    </a>|
                                </li> 
                                <li>
                                    <a target="_blank" href="#">
                                        Contact    
                                    </a>|
                                </li>
                                <li>
                                    <a target="_blank" href="#">
                                        Client Login    
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="clearfix"></div>
                        <div class="social-area">
                            <a class="btn btn-social btn-simple" href="#">
                                <i class="fa fa-twitter" aria-hidden="true"></i> Twitter
                            </a>
                            <a class="btn btn-social btn-simple" href="#">
                                <i class="fa fa-facebook" aria-hidden="true"></i> Facebook
                            </a>
                            <a class="btn btn-social btn-simple" href="#">
                                <i class="fa fa-envelope" aria-hidden="true"></i> Mail
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="copyright">
                        <p>Copyright &copy; 2017 africanamericantravelers.com. All Right Reserved</p>
                        <p><a href="#">Privacy Policy</a> | <a href="#">About Us</a> | <a href="#">FAQ</a> | <a href="#">Contact Support</a></p>
                    </div>
                </div>
            </footer>
        </div>
        <script>
$(document).ready(function () {
    $(".filter-button").click(function () {
        var value = $(this).attr('data-filter');
        if (value == "all")
        {
            $('.filter').show('1000');
        } else
        {
            $(".filter").not('.' + value).hide('3000');
            $('.filter').filter('.' + value).show('3000');
        }
    });

    if ($(".filter-button").removeClass("active")) {
        $(this).removeClass("active");
    }
    $(this).addClass("active");

    $(".filter-button2").click(function () {
        var value = $(this).attr('data-filter');
        if (value == "all")
        {
            $('.filter2').show('1000');
        } else
        {
            $(".filter2").not('.' + value).hide('3000');
            $('.filter2').filter('.' + value).show('3000');
        }
    });

    if ($(".filter-button2").removeClass("active2")) {
        $(this).removeClass("active2");
    }
    $(this).addClass("active2");

    $('#itemslider').carousel({interval: 3000});

    $('.carousel-showmanymoveone .item').each(function () {
        var itemToClone = $(this);

        for (var i = 1; i < 4; i++) {
            itemToClone = itemToClone.next();

            if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
            }

            itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-" + (i))
                    .appendTo($(this));
        }
    });

    $(".dropdown-hov").hover(function () {
        $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
        $(this).toggleClass('open');
        $('b', this).toggleClass("caret caret-up");
    },
            function () {
                $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            });
});

$("[rel='tooltip']").tooltip();

$('.thumbnail').hover(
        function () {
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function () {
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
);

// video
var vid = document.getElementById("bgvid");
var pauseButton = document.querySelector("#polina button");

if (window.matchMedia('(prefers-reduced-motion)').matches) {
    vid.removeAttribute("autoplay");
    vid.pause();
    pauseButton.innerHTML = "Paused";
}

function vidFade() {
    vid.classList.add("stopfade");
}

vid.addEventListener('ended', function ()
{
    // only functional if "loop" is removed 
    vid.pause();
    // to capture IE10
    vidFade();
});

var el = document.getElementById('pauseButton');
if (el) {
    pauseButton.addEventListener("click", function () {
        vid.classList.toggle("stopfade");
        if (vid.paused) {
            vid.play();
            pauseButton.innerHTML = "Pause";
        } else {
            vid.pause();
            pauseButton.innerHTML = "Paused";
        }
    })
}
        </script>
    </body>
</html>