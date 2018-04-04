<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Controller extends CI_Controller{
	private static $instance;

	function __construct()
	{
		parent::__construct();

		if(ENVIRONMENT == 'development')
			$this->output->enable_profiler(true);

		// $function = $this->uri->segment(2) != "commissionList";
		// if($function)
		// 	$this->session->unset_userdata('commissionListSession');

		// if($this->uri->segment(1) != "summarySessiony")
		// 	$this->session->unset_userdata('summarySession');

		date_default_timezone_set('Asia/Manila');

		// for testing only must remove this after testing
		// exec('date 05/27/2015');
		// echo date('Y-m-d');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

}

?>
