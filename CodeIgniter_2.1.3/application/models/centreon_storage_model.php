<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Centreon_storage_model extends CI_Model {

	function __construct()
	{
		$this->db_cent_store = $this->load->database('centreon_storage', TRUE);
	}
	function get_host_log()
	{
		$query = $this->db_cent_store->query("SELECT
			host_id,
			sum(`UPnbEvent`) as UP_A,
			sum(`UPTimeScheduled`) as UP_T,
			sum(`DOWNnbEvent`) as DOWN_A, 
			sum(`DOWNTimeScheduled`) as DOWN_T,
			sum(`UNREACHABLEnbEvent`) as UNREACHABLE_A, 
			sum(`UNREACHABLETimeScheduled`) as UNREACHABLE_T,
			sum(`UNDETERMINEDTimeScheduled`) as UNDETERMINED_T
			  FROM `log_archive_host`
			  GROUP BY `host_id`");
		return $query->result_array();
	}
	function get_month_list()
	{
		$query = $this->db_cent_store->query("SELECT
			min('date_start') as start_date,
			max('date_end') as end_date
			from `log_archive_host` ");
		$result = $query->result_array();
		$start_date = getdate($result['start_date']);
		$end_date = getdate($result['end_date']);
		$date_constraint = array(start_month, start_year, end_month, end_year);
		$date_constraint['start_month'] = $start_date['mon'];
		$date_constraint['start_year'] = $start_date['year'];
		$date_constraint['end_month'] = $end_date['mon'];
		$date_constraint['end_year'] = $start_date['year'];

		return $date_constraint;
	}

}

/* End of file centreon_storage_model.php */
/* Location: ./application/models/centreon_storage_model.php */