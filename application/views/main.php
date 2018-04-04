<!DOCTYPE html>
<html>
<head>
  <title><?php echo SYSTEMNAME;?></title>

   <?php 

   // //echo loadJQuery();
   // echo loadBootstrap();
   // echo loadFontAwesome();
   ?>

   <link rel="stylesheet" href=<?php echo base_url().'media/css/main_style.css';?>> 

    <script type="text/javascript">
      
      $(document).ready(function(){

        $('#sign_in').click(function(){

          window.location.href = "<?php echo base_url('home/login')?>";

        });

      });


    </script>


</head>
<body>
<div class="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand sitename" href=<?php echo base_url('home/main')?>>Teether<span class="label label-success text-capitalize"></span></a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="nav navbar-nav navbar-right">
                <li><button type="button" id='sign_in' class="btn btn-success navbar-btn btn-circle">Sign in</button></li>
            </ul>
        </div>
      </div>
    </nav>
    <header class="header">
        <div class="container">
          <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <div class="content">
                  <div class="pull-middle">
                    <h1 class="page-header">Waiting long lines just to see the dentist?</h1>
                    <p class="lead">We got your back. Book at Teether now.</p>
                    <div class="panel panel-default">
                        <div class="panel-body">
                                <div class="input-group">
                                    <input type="" class="form-control" placeholder="Join us now!">
                                    <span class="input-group-btn">
                                      <a href=<?php echo base_url('home/register');?>><button class="btn btn-success btn-circle" >Sign up for free</button></a>
                                    </span>                        
                                </div>
                        </div>
                    </div>
                  </div>              
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1 text-center mt-100 mb-100">
                <div class="phone">
                    <img class="img-responsive img-rounded" src="<?php echo base_url('/media/images/endodonzia.jpg')?>">
                </div>
            </div>
          </div>
        </div>
    </header>
    <section class="section">
        <div class="container">
            <div class="row">
               <div class="col-md-4 col-md-offset-1 text-center mt-100 mb-100">
                    <div class="phone">
                        <img class="img-responsive img-rounded" src="<?php echo base_url('/media/images/booking.jpg')?>">
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <div class="content">
                        <div class="pull-middle">
                            <h2 class="h1 page-header">Discover more about features.</h2>
                            <ul class="media-list">
                              <li class="media">
                                  <span class="fa fa-calendar-check-o fa-2x text-success"> Easy.</span>
                                <div class="media-body">
                                  <h4 class="media-heading">Integrated with Google Maps. Search & Book.</h4>
                                </div>
                              </li>
                              <li class="media">
                                  <span class="fa fa-check fa-2x text-success"> Free.</span>
                                <div class="media-body">
                                  <h4 class="media-heading">No payment for creating an account.</h4>
                                </div>
                              </li>
                              <li class="media">
                                  <span class="fa fa-lock fa-2x text-success"> Secure.</span>
                                <div class="media-body">
                                  <h4 class="media-heading">Protecting your personal info.</h4>
                                </div>
                              </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-right">
                    <div class="content">
                        <div class="pull-middle">
                            <h4><strong>No more long lines.</strong></h4>
                            <p>No more hassle. No more waiting. Made easily by this app.</p>
                        </div>
                    </div>
                </div>
               <div class="col-md-4 col-md-offset-1 mt-100 mb-100">
                    <div class="phone">
                        <img class="img-responsive img-rounded" src="<?php echo base_url('/media/images/booking.png')?>">
                    </div>
                </div>
                <div class="col-md-3 col-md-offset-1">
                    <div class="content">
                        <div class="pull-middle">
                            <h4><strong>Book at your preferred dates.</strong></h4>
                            <p>See all the dates available at your favorite dental clinic. No need to call them, book online. Using only your device.</p><p> Sign up now!</p>
                            <a class="btn btn-success btn-circle" href="#">Sign up for free</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer text-center">
        <div class="container">
            <small>© Teether, 2017. All rights reserved.</small>
        </div>
    </footer>
</div>
</body>
</html>


