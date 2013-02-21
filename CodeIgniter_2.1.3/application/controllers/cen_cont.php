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
	public function view_host_log()
	{
		$data['title'] = "Sistem Pembuatan laporan Centreon : Laporan Kondisi Host";
		$this->load->model('centreon_storage_model');
		$data['host'] = $this->centreon_storage_model->get_host_log();
		$data['year'] = $this->centreon_storage_model->get_year_list();
		$this->load->view('monitor/header', $data);
		$this->load->view('monitor/monitor_hostlog', $data);
		$this->load->view('monitor/footer');
	}
}
