<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		if($this->isLoggedIn()){
			$rolecode = $this->session->userdata('rolecode');
			if ($rolecode == PATIENT) {
				redirect(base_url('test_results/breast'));
			} else if($rolecode == MEDICPRAC){
				redirect(base_url('manage_patients'));
			} else if($rolecode == FACILITY_ADMIN){
				redirect(base_url('admin_dashboard'));
			}

			redirect(base_url('test_results/breast'));
		}
		$roles = $this->common_model->getAll(ROLES, ['is_obsolete' => 0], '', '', 'id,rolecode,rolename');
		if (!empty($roles)) {
			foreach ($roles as $key => $role) {
				$data[$role->rolecode.'_role'] = $role; 
			}
		}

		$data['genders'] = $this->common_model->getAll(GENDER, ['is_obsolete' => 0], '', '', 'id,gender');
		$data['facilities'] = $this->common_model->getAll(FACILITY, ['is_obsolete' => 0], '', '', 'id,facility_name');
		$data['ethnicities'] = $this->common_model->getAll('m_ethnicity');
		$data['content'] 	= 'home';
		$data['is_footer'] 	= true;
		$this->load->view('layout/main', $data);
	}
}
