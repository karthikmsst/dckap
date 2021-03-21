<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_model extends CI_Model {
    
    function __construct(){  
		parent::__construct();  
	}
    
    //products...
	function insert_products($data){
		$result = array();
        if(count($data) > 0){			
            $this->db->insert('products', $data);			
			
            if($this->db->affected_rows() > 0){
				$id 		= $this->db->insert_id();
				$data['id'] = $id;
				$result 	= $data;
			}
		}
		return $result;
	}
	
	function update_products($data, $condition){
		$result = false;
        if((count($data) > 0) AND (count($condition) > 0)){
			if(isset($condition['id'])){
				$this->db->where('id', $condition['id']);
			}						
			$this->db->update('products', $data);
			
            if($this->db->affected_rows() > 0){
				$result = true;
			}
		}
		return $result;
	}
    
    function get_products($data){
		$result = array();
		if(count($data) > 0){
			$this->db->select('Products.*');
            $this->db->from('products as Products');			
			
			if(isset($data['status'])){
				$this->db->where('Products.status', $data['status']);
			}
			if(isset($data['id'])){
				$this->db->where('Products.id', $data['id']);
			}
            if(isset($data['product_name'])){
				$this->db->where('Products.product_name', strtolower($data['product_name']));
			}
            if(isset($data['categories_id'])){
				$this->db->where('Products.categories_id', $data['categories_id']);
			}
			
			$query		= $this->db->get();
            
            if($query->num_rows() > 0){
                $result = $query->result_array();
            }
		}		
		return $result;
	}
    
    function get_products_details($data){
		$result = array();
		if(count($data) > 0){
			$this->db->select('Products.*, Categories.name as category_name');
            $this->db->from('products as Products');
            $this->db->join('categories as Categories', 'Categories.id = Products.categories_id AND Categories.status = "1"');	
			
			if(isset($data['status'])){
				$this->db->where('Products.status', $data['status']);
			}
			if(isset($data['id'])){
				$this->db->where('Products.id', $data['id']);
			}           
            if(isset($data['categories_id'])){
				$this->db->where('Products.categories_id', $data['categories_id']);
			}
			
			$query		= $this->db->get();
            
            if($query->num_rows() > 0){
                $result = $query->result_array();
            }
		}		
		return $result;
	}
    
    //product_images...
	function insert_product_images($data){
		$result = array();
        if(count($data) > 0){			
            $this->db->insert('product_images', $data);			
			
            if($this->db->affected_rows() > 0){
				$id 		= $this->db->insert_id();
				$data['id'] = $id;
				$result 	= $data;
			}
		}
		return $result;
	}
	
	function update_product_images($data, $condition){
		$result = false;
        if((count($data) > 0) AND (count($condition) > 0)){
			if(isset($condition['id'])){
				$this->db->where('id', $condition['id']);
			}						
			$this->db->update('product_images', $data);
			
            if($this->db->affected_rows() > 0){
				$result = true;
			}
		}
		return $result;
	}
    
    function get_product_images($data){
		$result = array();
		if(count($data) > 0){
			$this->db->select('ProductImages.*');
            $this->db->from('product_images as ProductImages');			
			
			if(isset($data['status'])){
				$this->db->where('ProductImages.status', $data['status']);
			}
			if(isset($data['id'])){
				$this->db->where('ProductImages.id', $data['id']);
			}            
            if(isset($data['products_id'])){
				$this->db->where('ProductImages.products_id', $data['products_id']);
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