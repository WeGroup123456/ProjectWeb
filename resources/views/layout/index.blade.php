<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <base href="{{ asset('') }}">
      <link rel="shortcut icon" href="images/favicon.png">
      <title>Welcome to FlatShop</title>
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
      <link href="css/font-awesome.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>
      <link href="css/sequence-looptheme.css" rel="stylesheet" media="all"/>
      <link href="css/style.css" rel="stylesheet">
      <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script><![endif]-->
   </head>
   <body id="home">
      <div class="wrapper">

         @include('layout.header')
          
         <div class="clearfix"></div>

         @yield('content')

         <div class="clearfix"></div>

         @include('layout.footer')

      </div>
      <!-- Bootstrap core JavaScript==================================================-->
     <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
     <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
     <script type="text/javascript" src="js/bootstrap.min.js"></script>
     <script type="text/javascript" src="js/jquery.sequence-min.js"></script>
     <script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
     <script defer src="js/jquery.flexslider.js"></script>
     <script type="text/javascript" src="js/script.min.js" ></script>
     <script src="js/snowstorm.js"></script>
     <script src="js/snowstorm-min.js"></script>
     <script type="text/javascript">
       snowStorm.snowCharacter = '❅';
       snowStorm.followMouse = false; 
       snowStorm.flakeWidth = 20; 
       snowStorm.flakeHeight = 20; 
       snowStorm.autoStart = true;
       snowStorm.animationInterval = 33;  
       snowStorm.vMaxX = 1;                 // Maximum X velocity range for snow
       thsnowStormis.vMaxY = 1;                 // Maximum Y velocity range for snow
       snowStorm.zIndex = 1000;                // CSS stacking order applied to each snowflake
     </script>
     @yield('script')
   </body>
</html>