 <!DOCTYPE html>
 <html>
 <head>
   <title><?php echo SYSTEMNAME;?> - Forgot Password</title>
   <script src="<?php echo base_url();?>media/js/jquery-2.1.3.min.js"></script>
    <link rel='stylesheet prefetch' href=<?php echo base_url('media/css/font-awesome-4.7.0/css/font-awesome.min.css')?>>
    <link rel="stylesheet" type="text/css" href=<?php echo base_url().'media/css/bootstrap.min.css'?>>
    <script type="text/javascript" src=<?php echo base_url().'media/js/bootstrap.min.js';?>></script>

    <style>

    .form-gap {
    padding-top: 70px;
    }
   body {
  background-image: url("../images/bg.jpg");
  background-size: cover;
    }
    </style>
 </head>
 <body>

 <div class="form-gap"></div>
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <?php echo $form;?>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
  </div>
</div>
 </body>
 </html>


 