<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->isLoggedIn()){
			redirect(base_url(''));
		}

		if (!($this->session->userdata('rolecode') == FACILITY_ADMIN || $this->session->userdata('rolecode') == SYSTEM_ADMIN)) {
			$this->session->set_flashdata('errors', "You don't have permission there.");
			redirect(base_url(''));
		}

		$this->load->model('common_model');
	}

	public function dashboard()
	{
		if ($this->session->userdata('rolecode') == SYSTEM_ADMIN) {
			$data['facility_count'] = $this->common_model->countRows(FACILITY);	
		}

		if ($this->session->userdata('rolecode') == FACILITY_ADMIN) {
			$is_superAdmin = 0;
			$sql = "SELECT fa.is_superadmin FROM ".USERS." as us LEFT JOIN ".FACILITY." as fa on us.facility_id = fa.id WHERE us.id = ".$this->current_user_id." and us.role_id = ".FACILITY_ADMIN_ROLE_ID." AND us.is_obsolete = " . NOT_OBSOLETE;

			$results = $this->common_model->raw_query($sql);

			if(!empty($results)){
				$result = array_shift($results);
				$is_superAdmin = $result['is_superadmin'];
			}

			if($is_superAdmin != 1){
			    $query['facility_id'] = $this->session->userdata('facility_id');
			}
		}

		$query['is_obsolete'] = NOT_OBSOLETE;
		$query['role_id'] = MEDICPRAC_ROLE_ID;
		$query['is_approve'] = APPROVE;
		$data['doctors_count'] = $this->common_model->countRows(USERS, $query);

		$query['is_approve'] = NOT_APPROVE;
		$data['pending_doctors_count'] = $this->common_model->countRows(USERS, $query);

		$data['content'] = 'admin/admin_dashboard';
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function manage_doctors($list_type)
	{
		$sql = "Select us.*, fa.facility_name from ". USERS ." as us Left Join ".FACILITY." as fa 
					ON us.facility_id = fa.id WHERE role_id = " . MEDICPRAC_ROLE_ID . " AND us.is_obsolete = " . NOT_OBSOLETE;

		if ($this->session->userdata('rolecode') == FACILITY_ADMIN) {

			$is_superAdmin = 0;
			$query = "SELECT fa.is_superadmin FROM ".USERS." as us LEFT JOIN ".FACILITY." as fa on us.facility_id = fa.id WHERE us.id = ".$this->current_user_id." and us.role_id = ".FACILITY_ADMIN_ROLE_ID." AND us.is_obsolete = " . NOT_OBSOLETE;

			$results = $this->common_model->raw_query($query);

			if(!empty($results)){
				$result = array_shift($results);
				$is_superAdmin = $result['is_superadmin'];
			}

			if( $is_superAdmin == 1){
				$sql = "Select us.*, fa.facility_name from ". USERS ." as us Left Join ".FACILITY." as fa 
					ON us.facility_id = fa.id WHERE role_id = " . MEDICPRAC_ROLE_ID . " AND us.is_obsolete = " . NOT_OBSOLETE;
			}else{
				$sql = "Select us.*, fa.facility_name from ". USERS ." as us Left Join ".FACILITY." as fa 
					ON us.facility_id = fa.id WHERE role_id = " . MEDICPRAC_ROLE_ID . " AND us.is_obsolete = " . NOT_OBSOLETE." AND us.facility_id = " . $this->session->userdata('facility_id');
			}

		}

		if ($list_type == 'doctors') {
			$sql .= " AND us.is_approve = " . APPROVE;
		} else if ($list_type == 'pending_doctors') {
			$sql .= " AND us.is_approve = " . NOT_APPROVE;
		}

		$data['doctors'] = $this->common_model->raw_query($sql);

		$data['content'] = 'admin/manage_doctors';
		$data['active'] = $list_type;
		$data['is_footer'] = false;
		$this->load->view('layout/main', $data);
	}

	public function manage_doctor_details($list_type, $id) {

		$sql = "Select us.*, fa.facility_name from ". USERS ." as us Inner Join ".FACILITY." as fa 
		ON us.facility_id = fa.id and us.id = ".$id." and us.role_id = ".MEDICPRAC_ROLE_ID;

		if ($this->session->userdata('rolecode') == FACILITY_ADMIN) {
			$sql .= " AND us.facility_id = " . $this->session->userdata('facility_id');
		}

		//$where = ['id' => $id, 'role_id' => MEDICPRAC_ROLE_ID];

		if ($list_type == 'doctors') {
			$sql .= " AND us.is_approve = " . APPROVE;
		} else if ($list_type == 'pending_doctors') {
			$sql .= " AND us.is_approve = " . NOT_APPROVE;
		}

		$data['doctor'] = $this->common_model->raw_query($sql);
		if(empty($data['doctor'])) {
			//$this->session->set_flashdata('errors','Not found the doctor.');
			log_message('info', 'Unexpected doctor id of '.$id.' given to admin/manage_doctor_details');
			redirect('admin/manage_doctors/doctors');	
		}
		$data['doctor'] = $data['doctor'][0];
		$data['content'] = 'admin/manage_doctor_details';
		$data['is_footer'] = false;
		$data['list_type'] = $list_type;
		$this->load->view('layout/main', $data);
	}

	public function approve_doctor() {
		if($this->input->post()) {
			$ids = $this->input->post('approve_doctor_ids');
			if (is_array($ids) && count($ids)) {
				$data['is_approve'] = APPROVE;
				$data['approved_by'] = $this->session->userdata('id');
				$data['approved_datetime'] = date('Y-m-d H:i:s');
				foreach ($ids as $id) {
					$this->common_model->update(USERS, array('id'=>$id),$data);
				}

				$response['message'] = "Approved successfully!";
				$response['success'] = true;
				echo json_encode($response); die();
			}			
		}

		$response['message'] = "Please select doctor to apprve.";
		$response['success'] = false;
		echo json_encode($response); die();
	}

	public function doctor_details_modal() {
		if($this->input->post()) {
			$id = $this->input->post('id');
			if ($id) {
				$sql = "Select us.*, fa.facility_name from ". USERS ." as us Inner Join ".FACILITY." as fa 
				ON us.facility_id = fa.id WHERE role_id = " . MEDICPRAC_ROLE_ID . " AND us.id = " . $id;

				if ($this->session->userdata('rolecode') == FACILITY_ADMIN) {
					$sql .= " AND us.facility_id = " . $this->session->userdata('facility_id');
				}

				$doctor = $this->common_model->raw_query($sql);
				if(empty($doctor)) {
					$response['message'] = "Not found doctor, please try again.";
					$response['success'] = false;
					echo json_encode($response); die();
				}
				$doctor = $doctor[0];

				$modal_content = '';
				$modal_content .= '<ul class="list-group list-group-flush">';
					$modal_content .= '<li class="list-group-item d-flex justify-content-between align-items-start"><span class="text-muted">Name : </span>' . $doctor['fname'] . '</li>';
					$modal_content .= '<li class="list-group-item d-flex justify-content-between align-items-start"><span class="text-muted">Eamil : </span>' . $doctor['email'] . '</li>';
					$modal_content .= '<li class="list-group-item d-flex justify-content-between align-items-start"><span class="text-muted">Contact Number : </span>' . $doctor['contact_number'] . '</li>';
					$modal_content .= '<li class="list-group-item d-flex justify-content-between align-items-start"><span class="text-muted">Registration Number : </span>' . $doctor['registration_number'] . '</li>';
					$modal_content .= '<li class="list-group-item d-flex justify-content-between align-items-start"><span class="text-muted">Facility Name : </span>' . $doctor['facility_name'] . '</li>';
				$modal_content .= '</ul>';

				$response['html_content'] = $modal_content;
				$response['success'] = true;
				echo json_encode($response); die();
			}			
		}
	}

	public function process_obsolete($list_type, $id) {

		$data['is_obsolete'] = OBSOLETE;
		$data['obsoleted_by'] = $this->session->userdata('id');
		$data['obsoleted_datetime'] = date('Y-m-d H:i:s');
		$this->common_model->update(USERS, array('id'=>$id),$data);

		$this->session->set_flashdata('success','Obsoleted the account.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function process_not_obsolete($list_type, $id) {

		$data['is_obsolete'] = NOT_OBSOLETE;
		$data['obsoleted_by'] = null;
		$data['obsoleted_datetime'] = null;
		$this->common_model->update(USERS, array('id'=>$id),$data);

		$this->session->set_flashdata('success','Active the account.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function datatable_info() {
		$draw = $this->input->get("draw");
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$columns = $this->input->get('columns');
		$order_info = $this->input->get('order');
        $order = $columns[$order_info[0]['column']]['data'];
		$dir   = $order_info[0]['dir'];

		$list_type = $this->input->get("list_type");

		$sql = "Select us.*, fa.facility_name from ". USERS ." as us Inner Join ".FACILITY." as fa 
		ON us.facility_id = fa.id WHERE role_id = " . MEDICPRAC_ROLE_ID . " AND us.is_obsolete = " . NOT_OBSOLETE;

		if ($this->session->userdata('rolecode') == FACILITY_ADMIN) {
			$sql .= " AND us.facility_id = " . $this->session->userdata('facility_id');
		}

		$where = ['role_id' => MEDICPRAC_ROLE_ID];
		if ($list_type == 'doctors') {
			$sql .= " AND us.is_approve = " . APPROVE;
		} else if ($list_type == 'pending_doctors') {
			$sql .= " AND us.is_approve = " . NOT_APPROVE;
		}

		$count_doctors = $this->common_model->count_rows_raw_query($sql);

		foreach ($columns as $column) {
			if ($column['search']['value'] != '') {
				$sql .= " AND " . $this->columnAlias($column['data']) . " LIKE '%" . $column['search']['value'] . "%'";
			}
		}

		$count_filtered_doctors = $this->common_model->count_rows_raw_query($sql);

		$sql .= " ORDER BY " . $this->columnAlias($order) . ' ' . $dir;
		$sql .= " LIMIT " . $length;
		$sql .= " OFFSET " . $start;

		$doctors = $this->common_model->raw_query($sql);

		$data = [];
		foreach ($doctors as $key => $doctor) {
			$doctor_data = [
				'fname' => '<span class="text-primary" onclick="modalDoctorDetail(event, ' . $doctor['id'] . ')">' . $doctor['fname'] . '</span>',
				'registration_number' => $doctor['registration_number'],
				'facility_name' => $doctor['facility_name'],
			];

			if ($list_type == 'doctors') {
				$doctor_data['view_or_approve_link'] = '<span class="text-primary" onclick="goToDoctorDetail(' . $doctor['id'] . ')"><ion-icon name="chevron-forward-outline"></ion-icon></span>';
			} else if ($list_type == 'pending_doctors') {
				$doctor_data['view_or_approve_link'] = '<input type="checkbox" class="approve-doctor" name="approve_doctor_ids[]" value="' . $doctor['id'] . '">';
			}

			$data[] = $doctor_data;
		}

		$result = array(
			"draw" => $draw,
			"recordsTotal" => $count_doctors,
			"recordsFiltered" => $count_filtered_doctors,
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}

	public function columnAlias($name) {
		$column = [
			'fname' => 'us', // us for users table
			'registration_number' => 'us',
			'facility_name' => 'fa', // fa for facilitt table
		];

		return $column[$name] . '.' . $name;
	}

}
