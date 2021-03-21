<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_orders_model extends CI_Model {
    
    function __construct(){  
		parent::__construct();  
	}
	
	//customer_orders...
	function insert_customer_orders($data){
		$result = array();
        if(count($data) > 0){			
            $this->db->insert('customer_orders', $data);			
			
            if($this->db->affected_rows() > 0){
				$id 		= $this->db->insert_id();
				$data['id'] = $id;
				$result 	= $data;
			}
		}
		return $result;
	}
	
	function update_customer_orders($data, $condition){
		$result = false;
        if((count($data) > 0) AND (count($condition) > 0)){
			if(isset($condition['id'])){
				$this->db->where('id', $condition['id']);
			}						
			$this->db->update('customer_orders', $data);
			
            if($this->db->affected_rows() > 0){
				$result = true;
			}
		}
		return $result;
	}
    
    function get_customer_orders($data){
		$result = array();
		if(count($data) > 0){
			$this->db->select('CustomerOrders.*');
            $this->db->from('customer_orders as CustomerOrders');			
			
			if(isset($data['status'])){
				$this->db->where('CustomerOrders.status', $data['status']);
			}
			if(isset($data['id'])){
				$this->db->where('CustomerOrders.id', $data['id']);
			}            
			
			$query		= $this->db->get();
            
            if($query->num_rows() > 0){
                $result = $query->result_array();
            }
		}		
		return $result;
	}
	
	//customer_order_items...
	function insert_customer_order_items($data){
		$result = array();
        if(count($data) > 0){			
            $this->db->insert('customer_order_items', $data);			
			
            if($this->db->affected_rows() > 0){
				$id 		= $this->db->insert_id();
				$data['id'] = $id;
				$result 	= $data;
			}
		}
		return $result;
	}
	
	function update_customer_order_items($data, $condition){
		$result = false;
        if((count($data) > 0) AND (count($condition) > 0)){
			if(isset($condition['id'])){
				$this->db->where('id', $condition['id']);
			}						
			$this->db->update('customer_order_items', $data);
			
            if($this->db->affected_rows() > 0){
				$result = true;
			}
		}
		return $result;
	}
    
    function get_customer_order_items($data){
		$result = array();
		if(count($data) > 0){
			$this->db->select('CustomerOrderItems.*');
            $this->db->from('customer_order_items as CustomerOrderItems');			
			
			if(isset($data['status'])){
				$this->db->where('CustomerOrderItems.status', $data['status']);
			}
			if(isset($data['id'])){
				$this->db->where('CustomerOrderItems.id', $data['id']);
			}
			if(isset($data['customer_orders_id'])){
				$this->db->where('CustomerOrderItems.customer_orders_id', $data['customer_orders_id']);
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