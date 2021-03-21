<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
    function __construct(){  
		parent::__construct();  
	}
    
    function get_admin_login($data){
		$result = array();
		if(count($data) > 0){
			$this->db->select('Admin.*');
            $this->db->from('admin as Admin');			
			
			if(isset($data['status'])){
				$this->db->where('Admin.status', $data['status']);
			}
			if(isset($data['id'])){
				$this->db->where('Admin.id', $data['id']);
			}
            if(isset($data['username'])){
				$this->db->where('Admin.username', strtolower($data['username']));
			}
            if(isset($data['password'])){
				$this->db->where('Admin.password', $data['password']);
			}
			
			$query		= $this->db->get();
            
            if($query->num_rows() > 0){
                $result = $query->result_array();
            }
		}		
		return $result;
	}
	
}
?>