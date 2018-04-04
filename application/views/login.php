<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title><?php echo SYSTEMNAME;?></title>
  
    <link rel='stylesheet prefetch' href=<?php echo base_url('media/css/font-awesome-4.7.0/css/font-awesome.min.css')?>>
    <link rel="stylesheet" href=<?php echo base_url("media/css/log_style.css")?>>
    <script src="<?php echo base_url();?>media/js/jquery-2.1.3.min.js"></script>
    
</script>
</head>

<body>

<?php echo form_open(base_url('home/login'),'id="submitForm"');?>
  <div class="login-form">
     <h1 class="nav-brand">Teether</h1>
     <div class="form-group">
       <input type="text" class="form-control" placeholder="Username " name="txt_username" id="UserName">
       <i class="fa fa-user"></i>
     </div>
     <div class="form-group log-status">
       <input type="password" class="form-control" placeholder="Password" name="txt_password" id="Passwod">
       <i class="fa fa-lock"></i>
      <?php echo $form_error; ?>
     </div>
      <br>
      <a class="link" href="<?php echo base_url('home/forgotPassword')?>">Lost your password?</a>
      <a class="link" href="<?php echo base_url('home/register')?>" style="margin-right:65px">Join us now!</a>
     <button type="submit" class="log-btn" id="loginBtn">Log in</button>
   </div>
<?php echo form_close();?>

</body>
</html>
