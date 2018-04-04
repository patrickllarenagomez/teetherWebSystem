<?php  if( ! defined('BASEPATH')) exit('No direct script access allowed');
	if ( ! function_exists('sessionUserId'))
	{
		function sessionUserId()
		{
			$CI =& get_instance();

			$CI->load->library('session');
			$member = $CI->session->userdata('login_user');
			// check member session, if none we're done.
			if ($member)
			{
				if (isset($member[USER_ID]))
				{
					return $member[USER_ID];
				}
			}
			return 0;
		}
	}

	if ( ! function_exists('sessionPassword'))
	{
		function sessionPassword()
		{
			$CI =& get_instance();

			$CI->load->library('session');
			$member = $CI->session->userdata('login_user');
			// check member session, if none we're done.
			if ($member)
			{
				if (isset($member[USER_ID]))
				{
					return $member[PASSWORD];
				}
			}
			return 0;
		}
	}

	if ( ! function_exists('sessionUserLevel'))
	{
		function sessionUserLevel()
		{
			$CI =& get_instance();

			$CI->load->library('session');
			$member = $CI->session->userdata('login_user');
			// check member session, if none we're done.
			if ($member)
			{
				if (isset($member[USER_LEVEL]))
				{
					return $member[USER_LEVEL];
				}
			}
			return 0;
		}
	}

	if ( ! function_exists('encryptPassword'))
	{
		function encryptPassword($password)
		{
			$new_password = md5($password);

			return $new_password;
		}
	}

	if (!function_exists('filter_string'))
	{
		function filter_string($data)
		{
			return filter_var($data, FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
		}
	}

	if ( ! function_exists('encryptString'))
	{
		function encryptString($data)
		{
			$CI =& get_instance();
			$CI->load->library('encryption');
			$ciphertext = $CI->encryption->encrypt($data);
			return base64_encode($ciphertext);
		}
	}

	if ( ! function_exists('decryptString'))
	{
		function decryptString($data)
		{
			$CI =& get_instance();
			$CI->load->library('encryption');
			$ciphertext = $CI->encryption->decrypt(base64_decode($data));
			return $ciphertext;
		}
	}

	if ( ! function_exists('setupPagination'))
	{
		function setupPagination($p_config = NULL, $selectedOffset = DEFAULTOFFSET, $withOffset = TRUE, $paginationName = "dd_limit", $paginationID = "dd_limit")
		{
			$CI =& get_instance();
			$CI->load->library('pagination');
			$CI->load->helper('form');
			$Pagi = new CI_Pagination();

			// $p_config['full_tag_open'] = '<nav><ul class="pagination">';
			// $p_config['full_tag_close'] = '</ul></nav><!--pagination-->';
			$p_config['full_tag_open'] = '<ul style="margin-top: 0px; margin-bottom: 0px;" class="pager">';
			$p_config['full_tag_close'] = '</ul>';

			$p_config['num_tag_open'] = '<li class="">';
			$p_config['num_tag_close'] = '</li>';

			$p_config['first_link'] = '&laquo; First';
			$p_config['first_tag_open'] = '<li class="">';
			$p_config['first_tag_close'] = '</li>';

			$p_config['last_link'] = 'Last &raquo;';
			$p_config['last_tag_open'] = '<li class="">';
			$p_config['last_tag_close'] = '</li>';

			$p_config['next_link'] = 'Next &rarr;';
			$p_config['next_tag_open'] = '<li class="">';
			$p_config['next_tag_close'] = '</li>';

			$p_config['prev_link'] = '&larr; Previous';
			$p_config['prev_tag_open'] = '<li class="">';
			$p_config['prev_tag_close'] = '</li>';

			$p_config['cur_tag_open'] = '<li class="active"><a href="#">';
			$p_config['cur_tag_close'] = '</a></li>';

			$Pagi->initialize($p_config);
			$pp = '<div class="pull-right" style="margin-bottom:5px">'.$Pagi->create_links().'</div>';

			if($withOffset)
			{
				$offsetArray = array(10 => 10, 20 => 20, 50=>50, 100=>100, 200=>200);
				$dd = '<div class="pull-left" style="margin:5px">'.form_dropdown($paginationName, $offsetArray, $selectedOffset, 'id='.$paginationID.' class="pull-left"').'</div>';
			} else $dd = '';

			return $dd.$pp;
		}
	}

	if ( ! function_exists('showArray'))
	{
		function showArray($array)
		{
			echo "<pre>";
			print_r($array);
			echo "</pre>";
		}
	}

	if ( ! function_exists('createrFooter'))
	{
		function createFooter()
		{
			$footer = '<div id="footer">
					<div id="footer_info">
						<span>© Teether 2017</span></a>
					</div>
				</div>';
			return $footer;
		}
	}

	if ( ! function_exists('createHeader'))
	{
		function createHeader()
		{
			$header = '<div id="wrapper" class="active">  
    <div id="sidebar-wrapper">
        <ul id="sidebar_menu" class="sidebar-nav">
           <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="glyphicon glyphicon-align-justify"></span></a></li>
        </ul>
        <ul class="sidebar-nav" id="sidebar">
        <li><a href='.base_url('home/dashboard').' style="font-size:13.4px">Dashboard&nbsp;<span class="sub_icon glyphicon glyphicon-th"></span></a></li>
          <li><a href="#">Payroll<span class="sub_icon glyphicon glyphicon-usd"></span></a></li>
           <ul class="sidebar-nav">
           <li><a href='.base_url('home/records').'>Records<span class="sub_icon glyphicon glyphicon-list-alt"></span></a></li>
		   <li><a href="#">Monitoring</style><span class="sub_icon glyphicon glyphicon-eye-open"></span></a></li>
		   <li><a href='.base_url('home/clients').'>Clients</style><span class="sub_icon glyphicon glyphicon-folder-open"></span></a></li>
           </ul>
          <li><a href='.base_url('home/account').'>Accounts<span class="sub_icon glyphicon glyphicon-user"></span></a></li>
          <li><a href='.base_url('home/logout').'>Log Out<span class="sub_icon glyphicon glyphicon-log-out"></span></a></li>
        </ul>
      </div>';
    return $header;
		}
	}

	if ( ! function_exists('loadResources'))
	{
		function loadResources()
		{
			$resources ='<script type="text/javascript" src='.base_url().'media/js/jquery-2.1.3.min.js></script>
      			<link rel="stylesheet" type="text/css" href='.base_url().'media/css/bootstrap.min.css>
	  			<link rel="stylesheet" type="text/css" href='.base_url().'media/css/headside.css>
	  			<script type="text/javascript" src='.base_url().'media/js/bootstrap.min.js></script>
	  			<script type="text/javascript" src='.base_url().'media/js/jqueryUI/jquery-ui.js></script>
	  			<script type="text/javascript" src='.base_url().'media/js/jqueryUI/jquery-ui.min.js></script>
	  			<script type="text/javascript" src='.base_url().'media/js/chosen.jquery.js></script>
	  			<script type="text/javascript" src='.base_url().'media/js/chosen.jquery.min.js></script>
	  			<link rel="stylesheet" type="text/css" href='.base_url().'media/js/chosen.css>
	  			<link rel="stylesheet" type="text/css" href='.base_url().'media/js/chosen.min.css>
	  			<link rel="stylesheet" type="text/css" href='.base_url().'media/js/jqueryUI/jquery-ui.css>
	  			<script>
      			$(document).ready(function()
		      	{
		      		$("#menu-toggle").click(function(e) 
		      		{
		        		e.preventDefault();
		        		$("#wrapper").toggleClass("active");
					});
		      	});
      			</script>
	  			';
	  		return $resources;
      
		}
	}

	if( ! function_exists('createUserLevelDD'))
	{
		function createUserLevelDD($post)
		{
			if(sessionUserLevel() == SUPERADMIN)
			{
				$options = array(
				ADMIN => 'Admin',
				SUPERADMIN => 'Super Admin'
				);
			}
			else
			{
				$options = array(
				ADMIN => 'Admin',
				);
			}
							
			$levelDD = form_dropdown('dd_userLevel', $options, $post, 'id="dd_userLevel"'.'class="form-control"');

			return $levelDD;
		}
	}

	if ( ! function_exists('isActiveOrInactive'))
	{
		function isActiveOrInactive()
		{
			$array = array(

				INACTIVE => 'Inactive',
				ACTIVE => 'Active',

				);

			return $array;
		}
	}

	if ( ! function_exists('notifSuccess'))
	{
		function notifSuccess($message)
		{
			$notification = '<div class="col-md-12 col-sm-12" id="notif">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                           <p><span class="fa fa-check-square"></span>&nbsp;'.$message.'</p>
                        </div>
                    </div>
                    </div>';
			return $notification; 
		}
	}

	if ( ! function_exists('trim_text'))
	{
		function trim_text($input, $length, $ellipses = true, $strip_html = true) {
		    
		    if ($strip_html) {
		        $input = strip_tags($input);
		    }
		  
		    if (strlen($input) <= $length) {
		        return $input;
		    }
		  
		    $last_space = strrpos(substr($input, 0, $length), ' ');
		    $trimmed_text = substr($input, 0, $last_space);
		  
		    if ($ellipses) 
		    {
		        $trimmed_text .= '...';
		    }
		  
		    return $trimmed_text;
		}
	}

	if ( ! function_exists('createStorageDD'))
	{
		function createStorageDD($post)
		{	
			$CI =& get_instance();
			$storage = $CI->ADMIN->getActiveStorage();			
			$storageArr = array(

				'0' => "---",
				);

			foreach($storage as $stor)
				$storageArr[$stor[STORAGE_ID]] = $stor[STORAGE_NAME];

			$storageDD = form_dropdown('dd_storageDD', $storageArr, $post, 'id="dd_storage"'.'class="chosen chosenwidth"');
			return $storageDD;
		}
	}

	if ( ! function_exists('generateRandomString'))
	{
		function generateRandomString($length = 10) 
		{
	    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    	$charactersLength = strlen($characters);
	    	$randomString = '';
	    	for ($i = 0; $i < $length; $i++) 
	    	{
	    	    $randomString .= $characters[rand(0, $charactersLength - 1)];
	   	 	}

	    	return $randomString;
		}
	}


	if ( ! function_exists('loadJQUery'))
	{
		function loadJQuery()
		{
			$jquery = '<script src='.base_url().'media/js/jquery-2.1.3.min.js></script>';

			return $jquery;
		}
	}
    

	if ( ! function_exists('loadBootstrap'))
	{
		function loadBootstrap()
		{
			$bootstrap =  '<link rel="stylesheet" type="text/css" href='.base_url().'media/css/bootstrap.min.css>
    						<script type="text/javascript" src='.base_url().'media/js/bootstrap.min.js></script>';

    		return $bootstrap;
		}
	}

	if ( ! function_exists('loadFontAwesome'))
	{
		function loadFontAwesome()
		{
			$fa = '<link rel="stylesheet prefetch" href='.base_url("media/css/font-awesome-4.7.0/css/font-awesome.min.css").'>';

			return $fa;
		}
	}


	if( ! function_exists('loadActiveMenuScript'))
	{
		function loadActiveMenuScript()
		{
		
                $activeMenu = '<script type="text/javascript">
                $(document).ready(function(){

   		 		var url = window.location.pathname, 
       		 urlRegExp = new RegExp(url.replace(/\/$/,"") + "$"); 
        
        	$(".sidebar-collapse a").each(function(){
            if(urlRegExp.test(this.href.replace(/\/$/,""))){
                $(this).addClass("active-menu");
            		}
        		});

			});

                </script>';


		return $activeMenu;
		}
	}

	if ( ! function_exists('loadHeaderAndSide'))
	{
		function loadHeaderAndSide()
		{
			$headerAndSide = '<div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand sitename" href='.base_url().'>Teether</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        </li>
                        <li class="divider"></li>
                        <li><a href='.base_url('admin/logout').'><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="" href='.base_url('admin/dashboard').'><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a class="" href='.base_url('admin/appointments').'><i class="fa fa-desktop"></i> Appointments<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href='.base_url('admin/appointments').'>Clinic Appointments</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href='.base_url('admin/invoices').'><i class="fa fa-bar-chart-o"></i> Invoices<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href='.base_url('admin/invoices').'>Clinic Invoices</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href='.base_url('admin/stocks').'><i class="fa fa-edit"></i> Inventory<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href='.base_url('admin/stocks').'>Stocks</a>
                            </li>
                            <li>
                                <a href='.base_url('admin/addEditStock/'.encryptString('Add')).'>Add New Stock</a>
                            </li>
                            <li>
                                <a href='.base_url('admin/storage').'>Storage</a>
                            </li>
                            <li>
                                <a href='.base_url('admin/addEditStorage/'.encryptString('Add')).'>Add Storage</a>
                            </li>
                            <li>
                                <a href='.base_url('admin/stocksHistory').'>Stocks History</a>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a href='.base_url('admin/patients').'><i class="fa fa-user"></i> Patients<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href='.base_url('admin/patients').'>Patient Records</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="" href='.base_url('admin/service').'><i class="fa fa-th-list"></i> Services<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="" href='.base_url('admin/service').'>Services Offered</a>
                            </li>
                            <li>
                                <a href='.base_url('admin/addEditService/'.encryptString('Add')).'>Add Services</a>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>';

        return $headerAndSide;
		}
	}

	if ( ! function_exists('loadUserHeaderAndSide'))
	{
		function loadUserHeaderAndSide()
		{
			$headerAndSide = '<div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand sitename" href='.base_url().'>Teether</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        </li>
                        <li class="divider"></li>
                        <li><a href='.base_url('home/logout').'><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a class="" href='.base_url('home/appointments').'><i class="fa fa-desktop"></i> Appointments<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href='.base_url('home/appointments').'>My Appointments</a>
                            </li>
							<li>
                                <a href='.base_url('home/newAppointment').'>New Appointment</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href='.base_url('home/invoices').'><i class="fa fa-bar-chart-o"></i> Invoices<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href='.base_url('home/invoices').'>My Invoices</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href='.base_url('home/myProfile').'><i class="fa fa-user"></i> Profile<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href='.base_url('home/myProfile').'>My Profile</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>';

        return $headerAndSide;
		}
	}

	if( ! function_exists('loadFooter'))
	{
		function loadFooter()
		{
			$footer ='<footer><p>Teether, 2017. All right reserved.</p></footer>
                </div>
            </div> 
        </div>';

        	return $footer;

		}
	}

	if ( ! function_exists('loadDesignScripts'))
	{
		function loadDesignScripts()
		{
			$script = '
    		<script src='.base_url('media').'/js/jquery.metisMenu.js></script>
    		';

    		return $script;
    
		}
	}

	if ( ! function_exists('loadCSS'))
	{
		function loadCSS()
		{
			$css = '<link href='.base_url('media').'/css/bootstrap.css rel="stylesheet" />
    			<link href='.base_url('media').'/css/custom-styles.css rel="stylesheet" />';

    		return $css;
		}
	}

	if ( ! function_exists('loadTableScript'))
	{
		function loadTableScript()
		{
		   $tableScript = '<script src="'.base_url('media').'/js/dataTables/jquery.dataTables.min.js"></script>
		   <script type="text/javascript">
        	$(document).ready(function() {
			    var t = $("#dataTables-example").DataTable( {
			        "columnDefs": [ {
			            "searchable": false,
			            "orderable": false,
			            "targets": 0
			        } ],
			        "order": [[ 1, "asc" ]]
			    } );
			 
			    t.on( "order.dt search.dt", function () {
			        t.column(0, {search:"applied", order:"applied"}).nodes().each( function (cell, i) {
			            cell.innerHTML = i+1;
			        });
			    }).draw();
			});
			</script>
    		<script src='.base_url('media').'/js/custom-scripts.js></script>'
    		;

    		return $tableScript;
    	}
	}

	if ( ! function_exists('loadTableCSS'))
	{
		function loadTableCSS()
		{
			$tableCSS = '<link href="'.base_url('media').'/css/jquery.dataTables.min.css" rel="stylesheet">' ;

			return $tableCSS;
		}
	}

	if ( ! function_exists('format_date'))
	{
		function format_date($date)
		{
			$dateChanged = strtotime($date);
			$formattedDate = date('F d, Y', $dateChanged);

			return $formattedDate;
		}
	}

	if ( ! function_exists('loadDDScript'))
	{
		function loadDDScript()
		{
			$scripts = '<script type="text/javascript" src='.base_url().'media/js/chosen.jquery.js></script>
	  			<script type="text/javascript" src='.base_url().'media/js/chosen.jquery.min.js></script>
	  			<link rel="stylesheet" type="text/css" href='.base_url().'media/js/chosen.css>
	  			<link rel="stylesheet" type="text/css" href='.base_url().'media/js/chosen.min.css>';

	  		return $scripts;
		}
	}

	if ( ! function_exists('format_money'))
	{
		function format_money($money)
		{
			$formattedNum = number_format($money, 2);

			return $formattedNum;
		}
	}


?>