<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nagios_model extends CI_Model {

	function __construct()
	{
		// open nagios database
		$this->db_nagios = $this->load->database('nagios',TRUE);
	}
	

}

/* End of file nagios_model.php */
/* Location: ./application/models/nagios_model.php */