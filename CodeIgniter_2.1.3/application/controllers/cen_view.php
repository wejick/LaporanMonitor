<?php
class Centreon_view_host extends CI_controller 
{
	public __construct()
	{
		parent::__construct();
		$this->load->model('centreon_model');
	}
	public function view()
	{
		//$data[host] = $this->centreon_model->get_host_list();

		$this->load->view('monitor/monitor_index', $data);
	}
}