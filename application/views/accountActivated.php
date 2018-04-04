 <!DOCTYPE html>
 <html>
 <head>
  <title><?php echo SYSTEMNAME.'- Success!'; ?></title>
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

    <script type="text/javascript">
        var count = 6;
        var redirect = "<?php echo base_url('home/login')?>";
         
        function countDown()
        {
            var timer = document.getElementById("timer");
            if(count > 0){
                count--;
                timer.innerHTML = "Redirecting you to log in page in "+count+" seconds.";
                setTimeout("countDown()", 1000);
            }
            else
            {
                window.location.href = redirect;
            }
        }
    </script>


 </head>
 <body>

 <div class="form-gap"></div>
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-check-circle fa-4x"></i></h3>
                  <h2 class="text-center">Success!</h2>
                  <div class="panel-body">
                  
                   <?php if($isActivated == 1){?>
               <p style="font-size:20px;color:#5C5C5C;">
                   Hi <?php echo $fullname?>
                   Your account is now activated! You may now log in by clicking the button below.
               </p>
                <?php }else{?>
               <p style="font-size:20px;color:#5C5C5C;">
                   Hi <?php echo $fullname?>
                   Your account is already activated! You may now log in by clicking the button below.
               </p>
                 <?php }?>
                 <span id="timer"><script type="text/javascript">countDown();</script></span>
                    <div class="form-group">
                       <a href=<?php echo base_url('home/login')?>><button type="button" class="btn btn-lg btn-primary btn-block">Login</button</a>
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