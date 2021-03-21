<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        $this->load->model('categories_model');
		$this->load->model('products_model');
		$this->load->model('customer_orders_model');
        
        $this->load->helper(array('form','url','email'));
    }
    
    function index(){
        redirect('products/manage_products');
        exit;
    }
	
	function manage_products(){
        
        $data                       = array();
		$msg                        = '';
        
        $result_products          	= array();        
        $condition                  = array();
        $condition['status']        = '1';
        $result_products          	= $this->products_model->get_products_details($condition);
		
		
        $data['msg']  				= $msg;
        $data['result_products']  	= $result_products;        
        $this->load->view('templates/admin_header');
        $this->load->view('products/manage_products', $data);
        $this->load->view('templates/admin_footer');
    }
	
	function add_products(){
		$data                       = array();
		$msg                        = '';
		
		$result_categories          = array();        
        $condition                  = array();
        $condition['status']        = '1';
        $result_categories          = $this->categories_model->get_categories($condition);
		
		if(($this->input->method() == 'post') AND !empty($this->input->post())){		
			if($this->input->post('submit')){
                $category_id	     	= $this->input->post('category_id');
				$product_name	     	= $this->input->post('product_name');
				$product_price	    	= $this->input->post('product_price');
				$short_description	    = $this->input->post('short_description');
				$description	    	= $this->input->post('description');				
                if(empty($category_id)){
                    $msg = 'Select the category';
                }
				else if(empty($category_id)){
                    $msg = 'Enter the product name';
                } else if(empty($product_price)){
                    $msg = 'Enter the product price';
                } else {					
                    $products_data                    		= array();
                    $products_data['categories_id']   		= $category_id;
                    $products_data['product_name']       	= $product_name;
					$products_data['price']       			= $product_price;
					$products_data['short_description']     = $short_description;
					$products_data['description']     		= $description;
                    $products_data['status']          		= '1';                     
                    
                    $check_products                   		= $this->products_model->get_products($products_data);
                    if(count($check_products) > 0){
                        $msg = 'Already exist';
                    } else {
                        $products_data['created_date']    	= date('Y-m-d H:i:s');
                        $products_data['modified_date']   	= date('Y-m-d H:i:s');
                        
                        $result_products                  	= $this->products_model->insert_products($products_data);
                        if(count($result_products) > 0){
							if(count($_FILES) > 0){
								$this->load->library('upload'); //loading the library
								$imagePath = FCPATH.'assets/products/';
								$number_of_files_uploaded = count($_FILES['files']['name']);					
								if(count($number_of_files_uploaded) > 0){
									for ($i = 0; $i <  $number_of_files_uploaded; $i++) {
										$_FILES['userfile']['name']     = $_FILES['files']['name'][$i];
										$_FILES['userfile']['type']     = $_FILES['files']['type'][$i];
										$_FILES['userfile']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
										$_FILES['userfile']['error']    = $_FILES['files']['error'][$i];
										$_FILES['userfile']['size']     = $_FILES['files']['size'][$i];
										
										$config = array(
											'file_name'     => time(),
											'allowed_types' => 'jpg|jpeg|png|gif',
											'max_size'      => 3000,
											'overwrite'     => FALSE,
											'upload_path'	=> $imagePath
										);
										$this->upload->initialize($config);
										
										if($this->upload->do_upload()){
											$filename = $this->upload->data();
											
											$product_images_data 					= array();
											$product_images_data['products_id'] 	= $result_products['id'];
											$product_images_data['image_name']  	= $filename['file_name'];
											$product_images_data['image_path']  	= 'assets/products/';
											$product_images_data['status']      	= '1';
											$product_images_data['created_date']    = date('Y-m-d H:i:s');
											$product_images_data['modified_date']   = date('Y-m-d H:i:s');
											
											$result_product_images                  = $this->products_model->insert_product_images($product_images_data);
										}
									}
								}
							}
							
                            redirect('products/manage_products');
                            exit;
                        }
                    }
                }
            }
        }
        
        $data['result_categories']  = $result_categories;
		$data['msg']  				= $msg;
		$this->load->view('templates/admin_header');
        $this->load->view('products/add_products', $data);
        $this->load->view('templates/admin_footer');
	}
	
	function view_products($id){
		$data                       	= array();
		$result_products        		= array();
		
		
		if($id){
			$condition                  = array();
			$condition['id']        	= $id;
			$condition['status']        = '1';
			$result_products          	= $this->products_model->get_products_details($condition);			
			if(count($result_products) == 0){
				redirect('products/manage_products');
                exit; 
			} 
		} else {
			redirect('products/manage_products');
            exit;
		}
		
		$data['result_products']  = $result_products;
		
		$this->load->view('templates/admin_header');
        $this->load->view('products/view_products', $data);
        $this->load->view('templates/admin_footer');
	}
	
	function delete_products($id = ''){
        if($id){
            $condition              = array();
            $condition['id']        = $id;
            $condition['status']    = '1';
            $check_products       	= $this->products_model->get_products($condition);
            if(count($check_products) > 0){
                $products_data                    = array();                
                $products_data['status']          = '0';
                $products_data['modified_date']   = date('Y-m-d H:i:s');
                
                $condition                        = array();
                $condition['id']                  = $id;                
                $result_products               	  = $this->products_model->update_products($products_data, $condition);
                if($result_products){
                    redirect('products/manage_products');
                    exit; 
                }
            }
        }
        
        exit;
    }
	
	function manage_orders(){
		$data                       = array();
		
		$result_products          	= array();        
        $condition                  = array();
        $condition['status']        = '1';
        $result_customer_orders     = $this->customer_orders_model->get_customer_orders($condition);
		
		$data['result_customer_orders']  = $result_customer_orders;
		
		$this->load->view('templates/admin_header');
        $this->load->view('products/manage_orders', $data);
        $this->load->view('templates/admin_footer');
	}	
	
	function view_orders($id){
		$data                       	= array();
		$result_customer_orders        	= array();
		
		
		if($id){
			$condition                  = array();
			$condition['id']        	= $id;
			$condition['status']        = '1';
			$result_customer_orders     = $this->customer_orders_model->get_customer_orders($condition);
			if(count($result_customer_orders) == 0){
				redirect('products/manage_products');
                exit; 
			} 
		} else {
			redirect('products/manage_orders');
            exit;
		}
		
		$data['result_customer_orders']  = $result_customer_orders;
		
		$this->load->view('templates/admin_header');
        $this->load->view('products/view_orders', $data);
        $this->load->view('templates/admin_footer');
	}
}
?>