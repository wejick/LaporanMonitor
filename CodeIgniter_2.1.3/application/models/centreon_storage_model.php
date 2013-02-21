<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Centreon_storage_model extends CI_Model {

	function __construct()
	{
		// multiple database handle mechanism
		$this->db_cent_store = $this->load->database('centreon_storage', TRUE);
	}
	// get list of host log
	function get_host_log($date = FALSE)
	{
		/*
		UP_A is How much host get up
		UP_T is Total uptime
		DOWN_A is How much host to get down
		DONW_T is Total downtime
		UNREACHABLE_A is How much host get unreachable
		UNREACHABLE_T is Total unreachable time
		UNDETERMINED_T is Total time for uncategorized condition
		*/
		if($date === FALSE)
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
			$result = array('host_log', 'begin_time', 'end_time' );
			$result['host_log'] = $query->result_array();
			$result['begin_time'] = "awal dilakukan monitoring";
			$result['end_time'] = "saat ini";
			return $result;
		} else 
		{
			$start_year = 2013; // this is usefull to interpret dropdown  value
			$begin_date = mktime(24,0,0,$date['month']+1,
				1, intval($date['year'])+$start_year);
			$end_date = mktime(23,59,59,$date['month']+1,
				cal_days_in_month(CAL_GREGORIAN,$date['month']+1,$date['year']+$start_year),
				intval($date['year'])+$start_year);
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
				  WHERE date_start >= ".$begin_date.
				  " AND date_end <= ".$end_date.
				  " GROUP BY `host_id`");
						$result = array('host_log', 'begin_time', 'end_time' );
			$result['host_log'] = $query->result_array();
			$result['begin_time'] = date('d-M-Y',$begin_date) ;
			$result['end_time'] = date('d-M-Y',$end_date);

			return $result;
		}
	}
	/*
	get list of monitored year, we will display full 12 month + years from this fuction
	at view
	*/
	function get_year_list()
	{
		$query = $this->db_cent_store->query("SELECT
			min(`date_start`) as start_date,
			max(`date_end`) as end_date
			from `log_archive_host` ");
		$result = $query->result_array();
		// get year array
		$years = range(date('Y',$result[0]['start_date']), date('Y',$result[0]['end_date']));
		return $years;
	}

}

/* End of file centreon_storage_model.php */
/* Location: ./application/models/centreon_storage_model.php */