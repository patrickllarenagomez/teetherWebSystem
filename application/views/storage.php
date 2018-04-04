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
    
    <script type="text/javascript">
            $(document).ready(function(){
                $('#notif').fadeOut(3000);
                
                $(".isDelete").click(function(){
                
                if (confirm("Do you want to make this inactive?"))
                {
                    var code= $(this).attr('no');
                    window.location.href ="<?php echo base_url('admin/deleteStorage/')?>"+code;
                }
                else
                {
                    // do nothing
                }
                    });

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
                            Storage - To Date
                        </h1>
                    </div>
                    <div class="row">
                    <?php echo $this->session->flashdata('storage_notification');?>
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Table - Storage
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Storage Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $table;?>
                                    </tbody>
                                </table>
                            </div>
                            
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
