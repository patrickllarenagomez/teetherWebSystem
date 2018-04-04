<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo SYSTEMNAME;?></title>
    <?php echo loadJQuery();?>
    <?php echo loadBootstrap();?>
    <?php echo loadFontAwesome();?>
    <?php echo loadCSS();?>
    <?php echo loadActiveMenuScript();?>
    <?php echo loadTableCSS();?>
    <script type="text/javascript" src="<?php echo base_url('media/js/'."jquery.mask.js")?>"></script>
    
     
    <script type="text/javascript">
        $(document).ready(function(){


            $('#price').mask('###,###,###.00', {reverse: true});

        });
    </script>

</head>
<body>
    
    <?php echo loadHeaderAndSide();?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
             <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <?php echo $action.' Service';?>
                        </h1>
                    </div>
                    <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Table - <?php echo $action?> Service
                        </div>
                        <div class="panel-body">
                            <?php echo $form;?>
                            
                        </div>
                    </div>
                </div>
            </div>
                </div> 

        <?php echo loadFooter();
              echo loadDesignScripts();
              echo loadTableScript();
        ?>

</body>
</html>
