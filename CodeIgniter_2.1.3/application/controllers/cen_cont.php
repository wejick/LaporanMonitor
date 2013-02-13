<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cen_cont extends CI_Controller {

	public function index()
	{
		$this->load->model('centreon_model');
		$data[host] = $this->centreon_model->get_host_list();
		$this->load->view('monitor/monitor_index', $data);
	}
}
