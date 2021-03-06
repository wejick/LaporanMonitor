<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Centreon_storage_model extends CI_Model {

	function __construct()
	{
		// multiple database handle mechanism
		$this->db_cent_store = $this->load->database('centreon_storage', TRUE);
		$this->db_cent = $this->load->database('default',TRUE);
	}
	
	// get time difference
	function diffku($start, $end)
	{
		$start = getdate($start);
		$end = getdate($end);

		$result = array(
			'sec' => $end['seconds'],
			'min' => $end['minutes'],
			'hour' => $end['hours'],
			'day' => $end['mday']-$start['mday'],
			'month' => $end['month']-$start['month'],
			'year' => $end['year']-$start['year']
		 );
		return $result;
	}
	// get hostname by id
	function get_host_name($id)
	{
		$query = $this->db_cent->query("SELECT
			host_name as name
			from `centreon2`.`host`
			WHERE host_id = ".$id
			);
		$result = $query->result_array();
		return $result[0]['name'];
	}
	// get id from hostname
	function get_host_id($hostname)
	{
		$query = $this->db_cent->query("SELECT
			host_id as id
			from `centreon2`.`host`
			WHERE `host_name` = "."'".$hostname."'"
			);
		$result = $query->result_array();
		return $result[0]['id'];
	}
	// get hostname list
	function get_hostname_list()
	{
		$query = $this->db_cent->query("SELECT
			host_name
			from `centreon2`.`host`
			INNER JOIN `centreon2`.`command` 
			ON `centreon2`.`host`.`command_command_id` = `centreon2`.`command`.`command_id`
			"
			);
		return $query->result_array();
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
			from `centreon2_storage`.`log_archive_host` ");
		$result = $query->result_array();
		// get year array
		$years = range(date('Y',$result[0]['start_date']), date('Y',$result[0]['end_date']));
		return $years;
	}
	/* get list of host log
		date is array of (month, year, hostname)
		month and year of date constraint
	*/
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
				  FROM `centreon2_storage`.`log_archive_host`
				  GROUP BY `host_id`");
			$result = array('host_log', 'begin_time', 'end_time' );
			$result['host_log'] = $query->result_array();
			$result['begin_time'] = "awal dilakukan monitoring";
			$result['end_time'] = "saat ini";

		} else 
		{
			$start_year = 2013; // this is usefull to interpret dropdown  value
			$begin_date = mktime(0,0,1,$date['month']+1,
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
				  FROM `centreon2_storage`.`log_archive_host` 
				  WHERE date_start >= ".$begin_date.
				  " AND date_end <= ".$end_date.
				  " GROUP BY `host_id`");
						$result = array('host_log', 'begin_time', 'end_time' );
			$result['host_log'] = $query->result_array();
			$result['begin_time'] = date('d-M-Y',$begin_date) ;
			$result['end_time'] = date('d-M-Y',$end_date);
		}
		/*
		- count total time of UP, Down, Unreachable and Undetermined event
		- add host_name
		*/		
		foreach ($result['host_log'] as &$host_item) {
			// count total time
			$temp = $this->diffku(0,$host_item['UP_T']);
			$host_item['UP_T'] = $temp;
			$temp = $this->diffku(0,$host_item['DOWN_T']);
			$host_item['DOWN_T'] = $temp;
			$temp = $this->diffku(0,$host_item['UNREACHABLE_T']);
			$host_item['UNREACHABLE_T'] = $temp;
			$temp = $this->diffku(0,$host_item['UNDETERMINED_T']);
			$host_item['UNDETERMINED_T'] = $temp;
			// push new array for hostname
			array_push($host_item, "hostname");
			// insert hostname
			$host_item['hostname'] = $this->get_host_name($host_item['host_id']);
		}
		//print_r($result['host_log']);
		return $result;
	}
	/*
		get host log detail
		info is array of (month, year, hostname)
		month and year of date constraint
		hostname of log
	*/
	function get_host_log_detail($info = FALSE)
	{
		/*
		Show related data of host
		UP_T is Total uptime
		DONW_T is Total downtime
		UNREACHABLE_T is Total unreachable time
		UNDETERMINED_T is Total time for uncategorized condition
		*/
		if($info === FALSE)
		{
			$result = NULL;
		} else
		{
			$start_year = 2013; // this is usefull to interpret dropdown  value
			$begin_date = mktime(0,0,1,$info['month']+1,
				1, intval($info['year'])+$start_year);
			$end_date = mktime(23,59,59,$info['month']+1,
				cal_days_in_month(CAL_GREGORIAN,$info['month']+1,$info['year']+$start_year),
				intval($info['year'])+$start_year);
			$id = $this->get_host_id($info['hostname_list'][$info['hostname']]);
			$query = $this->db_cent_store->query("SELECT
				host_id,
				`UPTimeScheduled` as UP_T,
				`DOWNTimeScheduled` as DOWN_T,
				`UNREACHABLETimeScheduled` as UNREACHABLE_T,
				`UNDETERMINEDTimeScheduled` as UNDETERMINED_T,
				`date_start`
				  FROM `centreon2_storage`.`log_archive_host` 
				  WHERE date_start >= ".$begin_date.
				  " AND date_end <= ".$end_date.
				  " AND `host_id` = ".$id);
			$result = array('host_log', 'begin_time', 'end_time' );
			$result['host_log'] = $query->result_array();
			$result['begin_time'] = date('d-M-Y',$begin_date) ;
			$result['end_time'] = date('d-M-Y',$end_date);
		}
		/*
		- count total time of UP, Down, Unreachable and Undetermined event
		- add host_name
		*/		
		foreach ($result['host_log'] as &$host_item) {
			// count total time
			$temp = $this->diffku(0,$host_item['UP_T']);
			$host_item['UP_T'] = $temp;
			$temp = $this->diffku(0,$host_item['DOWN_T']);
			$host_item['DOWN_T'] = $temp;
			$temp = $this->diffku(0,$host_item['UNREACHABLE_T']);
			$host_item['UNREACHABLE_T'] = $temp;
			$temp = $this->diffku(0,$host_item['UNDETERMINED_T']);
			$host_item['UNDETERMINED_T'] = $temp;
		}
		return $result;
	}
}

/* End of file centreon_storage_model.php */
/* Location: ./application/models/centreon_storage_model.php */