<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cen_cont extends CI_Controller {

	public function index()
	{
		$data['title'] = "Sistem Pembuatan laporan Centreon";
		$this->load->view('monitor/header', $data);
		$this->load->view('monitor/monitor_index');
		$this->load->view('monitor/footer');
	}
	public function view_host()
	{
		$data['title'] = "Sistem Pembuatan laporan Centreon : Daftar Host";
		$this->load->model('centreon_model');
		$data['host'] = $this->centreon_model->get_host_list();
		$this->load->view('monitor/header', $data);
		$this->load->view('monitor/monitor_hostlist', $data);
		$this->load->view('monitor/footer');
	}
	public function view_host_log($date = FALSE)
	{
		//load helper
		$this->load->helper('form');
		// get posted variable from view
		if($date != FALSE)
		{
			$date = array("month","year");
			$date['month'] = $this->input->post('month');
			$date['year'] = $this->input->post('year');
		}
		var_dump($date);
		// load and call model function
		$this->load->model('centreon_storage_model');
		$data['host'] = $this->centreon_storage_model->get_host_log($date);
		$data['year'] = $this->centreon_storage_model->get_year_list();
		// view things
		$data['title'] = "Sistem Pembuatan laporan Centreon : Laporan Kondisi Host";
		$this->load->view('monitor/header', $data);
		$this->load->view('monitor/monitor_hostlog', $data);
		$this->load->view('monitor/footer');
	}
	public function view_log()
	{
		//load helper
		$this->load->helper('form');
		// load and call model function
		$this->load->model('centreon_storage_model');		
		$data['year'] = $this->centreon_storage_model->get_year_list();
		// get posted variable from view		
		if($this->input->post('month') !== FALSE)
		{
			$date = array("month","year");
			$date['month'] = $this->input->post('month');
			$date['year'] = $this->input->post('year');
			// get table from model
			$data['host_log'] = $this->centreon_storage_model->get_host_log($date);
		} else
		{
			$date = FALSE;
			$data['host_log'] = $this->centreon_storage_model->get_host_log();
		}
		// view things
		$data['title'] = "Sistem Pembuatan laporan Centreon : Laporan Kondisi Host";
		$this->load->view('monitor/header', $data);
		$this->load->view('monitor/monitor_hostlog', $data);
		$this->load->view('monitor/footer');
	}
	public function view_log_detail()
	{
		//load helper
		$this->load->helper('form');
		$this->load->helper('date');
		// load and call model function
		$this->load->model('centreon_storage_model');		
		$data['year'] = $this->centreon_storage_model->get_year_list();
		$temp = $this->centreon_storage_model->get_hostname_list();
		$data['host_name'] = array();
		// get inner array item
		foreach ($temp as $host) {
			array_push($data['host_name'], $host['host_name']);
		}
		// get posted variable from view		
		if($this->input->post('month') !== FALSE)
		{
			$info = array("month","year","host");
			$info['month'] = $this->input->post('month');
			$info['year'] = $this->input->post('year');
			$info['hostname'] = $this->input->post('hostname');
			// because I don't know how to easy way to set value at dropdown
			$info['hostname_list'] = $data['host_name'];
			// get table from model
			$data['host_log'] = $this->centreon_storage_model->get_host_log_detail($info);
			$data['empty'] = 0;
		} else
		{
			// set this variable to 1 for unselected form
			$data['empty'] = 1;
		}
		// view things
		$data['title'] = "Sistem Pembuatan laporan Centreon : Laporan Detail Kondisi Host";
		if($this->input->post('month') !== FALSE)
			$data['hostname'] = $info['hostname_list'][$info['hostname']];
		$this->load->view('monitor/header', $data);
		$this->load->view('monitor/monitor_hostdetail', $data);
		$this->load->view('monitor/footer');
	}
	public function view_svc_detail()
	{
		// view things
		$data['title'] = "Sistem Pembuatan Laporan Centreon : Laporan Detail Kondisi Service";
		$this->load->view('monitor/header', $data);
		$this->load->view('monitor/monitor_servicedetail', $data);
		$this->load->view('monitor/footer', $data);
	}
}
