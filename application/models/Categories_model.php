<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories_model extends CI_Model {

	function __construct(){  
		parent::__construct();  
	}
    
    //categories...
	function insert_categories($data){
		$result = array();
        if(count($data) > 0){			
            $this->db->insert('categories', $data);			
			
            if($this->db->affected_rows() > 0){
				$id 		= $this->db->insert_id();
				$data['id'] = $id;
				$result 	= $data;
			}
		}
		return $result;
	}
	
	function update_categories($data, $condition){
		$result = false;
        if((count($data) > 0) AND (count($condition) > 0)){
			if(isset($condition['id'])){
				$this->db->where('id', $condition['id']);
			}						
			$this->db->update('categories', $data);
			
            if($this->db->affected_rows() > 0){
				$result = true;
			}
		}
		return $result;
	}
    
    function get_categories($data){
		$result = array();
		if(count($data) > 0){
			$this->db->select('Categories.*');
            $this->db->from('categories as Categories');			
			
			if(isset($data['status'])){
				$this->db->where('Categories.status', $data['status']);
			}
			if(isset($data['id'])){
				$this->db->where('Categories.id', $data['id']);
			}
            if(isset($data['name'])){
				$this->db->where('Categories.name', strtolower($data['name']));
			}
            if(isset($data['parent_id'])){
				$this->db->where('Categories.parent_id', $data['parent_id']);
			}
			
			$query		= $this->db->get();
            
            if($query->num_rows() > 0){
                $result = $query->result_array();
            }
		}		
		return $result;
	}
}