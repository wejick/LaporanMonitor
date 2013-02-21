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
}
