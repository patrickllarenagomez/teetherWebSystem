<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
		
		if ( ! isset($this->db))
		{
			$this->load->database();
		}
    }
}

?>
