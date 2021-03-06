<!-- Home layout -->
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
        <link href="{{ URL::asset('css/style.css') }}" media="screen" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('css/mode_image.css') }}" media="screen" rel="stylesheet" type="text/css">
        
        <!-- Scripts -->
        <script type="text/javascript" src="{{ URL::asset('js/jquery-3.1.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/ckeditor.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/modernizr.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.waypoints.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/model_image.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>

        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>

        <!-- font  -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet"> 
        <!-- font Awesome Cdn -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        
        <style>
        .error{
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
              <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('images/logo.png') }}" alt="logo"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
              <!-- User profile -->
              <!-- Navbar -->
              <ul class="nav navbar-nav navbar-right">
                  <li class=""><a href="{{url('/about') }}">About </a></li>
                  <li class="dropdown dropdown-hov">
                      <a href="javascript:void(0);">Trips <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                       @foreach ($tripLists as $trip)
                           <li><a href="{{ url('/trip/' . $trip->id) }}">{{ ucwords( strtolower( $trip->name ) ) }}</a></li>
                       @endforeach
                      </ul>
                  </li>
                  <li><a href="#"> Testimony </a></li>
                  <!--<li><a href="#!/"> Blog </a></li>-->
                  <li><a href="{{url('/contact') }}"> Contact</a></li>
                  <li ><a href="{{url('/login') }}"> <i class="fa fa-lock" aria-hidden="true"></i> Client Login </a></li>
              </ul>
          </div>
      </div>
     </nav>
     <div class="wrapper">
      <div class="alert-message"></div>

      <!-- Page Content -->
      <div>
          @yield('content')
      </div>
      <!-- Page Content -->

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
             }
             else
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
             }
             else
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

         $(".dropdown-hov").hover(function() {
             $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
             $(this).toggleClass('open');
             $('b', this).toggleClass("caret caret-up");                
         },
         function() {
             $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
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
     if(el){
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
            
    <!-- Server Response -->
    <div class="modal fade" id="server_response" tabindex="-1" role="dialog" data-backdrop="false" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <a style="width: 80px;" id="bt-modal-cancel" class="btn btn-success" href="javascript:void(0);" data-dismiss="modal">OK</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Server Response -->
  
    </body>
</html>