<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {
    public function user_login($table,$where=null) {
        $this->db->select();
        $this->db->from($table);
        // $this->db->join(USERS_PATIENT , USERS_PATIENT.'.user_id = '.$table.'.id', "inner");
        // $where .=' and '.USERS_PATIENT.'.email_verified = '. VERIFIED;
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function doctor_and_admin_login($table,$where=null) {
        $this->db->select();
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_password($table,$where=null,$data=null) {
            $this->db->select();
            $this->db->from($table);
            $this->db->where($where);
            $this->db->set($data);
           $query=$this->db->update();
           return $query;
    }
}