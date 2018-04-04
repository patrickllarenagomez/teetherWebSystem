 <!DOCTYPE html>
 <html>
 <head>
  <title><?php echo SYSTEMNAME.' - Success!'; ?></title>
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
                  <h3><i class="fa fa-envelope fa-4x"></i></h3>
                  <h2 class="text-center">Success!</h2>
                  <div class="panel-body">
    
                  <p style="font-size:20px;color:#5C5C5C;">
            Thank you for registering on Teether! </p><p>We have sent you an email on <?php echo $email;?> with the confirmation
            Please go to your provided email to activate your account. Please check your inbox/spam folder.
             </p>

                    <div class="form-group">
                       <a href=<?php echo base_url('home/login')?>><button type="button" class="btn btn-lg btn-primary btn-block">Home</button</a>
                     </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
  </div>
</div>
 </body>
 </html>


 





