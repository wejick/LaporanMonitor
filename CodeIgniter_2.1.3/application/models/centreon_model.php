<?php
class Centreon_model extends CI_model
{
	function __construct()
	{
		$db = $this->load->database();
	}
	function get_host_list()
	{
		$query = $this->db->query("SELECT
   									 `host`.`host_id`
    								 , `host`.`host_name`
    								 , `host`.`host_address`
    								 , `command`.`command_name`
								 FROM
    								 `centreon2`.`host`
    								 INNER JOIN `centreon2`.`command` 
    								     ON (`host`.`command_command_id` = `command`.`command_id`);");
		return $query->result_array();
	}
}