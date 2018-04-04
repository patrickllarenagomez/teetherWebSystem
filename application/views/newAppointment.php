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
    <script type="text/javascript" src=<?php echo base_url('media/zabuto/zabuto_calendar.js')?>></script>
    <script type="text/javascript" src=<?php echo base_url('media/zabuto/zabuto_calendar.min.js')?>></script>
    <link rel="stylesheet" href="<?php echo base_url('media/zabuto/zabuto_calendar.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('media/zabuto/zabuto_calendar.min.css')?>">
        <script type="text/javascript">
            $(document).ready(function(){
            var eventData = [
                {"date":"2018-01-01","badge":true,"title":"Example 1"},
                {"date":"2018-01-02","badge":true,"title":"Example 2"}
                            ];
                $("#my-calendar").zabuto_calendar({
                    data: eventData,
                    cell_border: true,
                    today: true,
                    show_days: false,
                    weekstartson: 0,
                    nav_icon: {
                      prev: '<i class="fa fa-chevron-circle-left"></i>',
                      next: '<i class="fa fa-chevron-circle-right"></i>'
                    }
                  });
                });


        </script>   
     
</head>
<body>
    
    <?php echo loadUserHeaderAndSide();?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
             <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            My Appointments
                        </h1>
                    </div>
                    <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Table - Appointments
                        </div>
                        <div class="panel-body" id="my-calendar">
                            
                            
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
