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
    
</head>
<body>
    
    <?php echo loadHeaderAndSide();?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
             <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Stocks Log - To Date
                        </h1>
                    </div>
                    <div class="row">
                    <?php echo $this->session->flashdata('stockslog_notification');?>
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Table - Stocks Log
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Stocks Name</th>
                                            <th>Qty. Used ( - ) / Qty. Added </th>
                                            <th>Storage</th>
                                            <th>Date Added</th>
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
              echo loadTableScript();
              echo loadDesignScripts();
        ?>
</body>
</html>
