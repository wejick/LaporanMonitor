<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nagios_model extends CI_Model {

	function __construct()
	{
		// open nagios database
		$this->db_nagios = $this->load->database('nagios',TRUE);
	}
	function get_service_detail()
	{
		$query = $this->db_nagios->query("SELECT
			ob.name1 AS host_name,
			ob.name2 AS service_description,
			nss.current_state,
			nss.output AS plugin_output,
			nss.status_update_time AS status_update_time,
			UNIX_TIMESTAMP(nss.last_state_change) AS last_state_change,
			UNIX_TIMESTAMP(nss.last_check) AS last_check,
			nss.notifications_enabled,
			UNIX_TIMESTAMP(nss.next_check) AS next_check,
			nss.perfdata AS performance_data		
		FROM
			nagios_servicestatus nss,
			nagios_objects ob,
			nagios_services ns
		WHERE
			ob.object_id = nss.service_object_id 
		AND
			ob.object_id = ns.service_object_id
			");
	}

}

/* End of file nagios_model.php */
/* Location: ./application/models/nagios_model.php */