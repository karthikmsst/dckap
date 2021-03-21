<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        $this->load->model('categories_model');
		$this->load->model('products_model');
		$this->load->model('customer_orders_model');
        
        $this->load->helper(array('form','url','email'));
		$this->load->library(array('cart'));
    }

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->cart->destroy();
		
		$this->session->set_userdata('page', 1);
		
		$data 						= array();
		
		$cart_count					= count($this->cart->contents());
		
		$result_products          	= array();        
        $condition                  = array();
        $condition['status']        = '1';
        $result_products          	= $this->products_model->get_products_details($condition);
		
		$data['cart_count']  		= $cart_count; 
		$data['result_products']  	= $result_products;        
		
		$this->load->view('templates/header');        
		$this->load->view('welcome_message', $data);
        $this->load->view('templates/footer');
	}
	
	function add_to_cart(){
		$result					= '';
		$product_image          = '';
		if(($this->input->method() == 'post') AND !empty($this->input->post())){
			$product_id	     	= $this->input->post('product_id');
			$quantity	    	= $this->input->post('quantity');
			
			if($product_id AND $quantity){
				$condition              = array();
				$condition['id']        = $product_id;
				$condition['status']    = '1';
				$check_products       	= $this->products_model->get_products($condition);
				if(count($check_products) > 0){
					$condition              	= array();
					$condition['products_id']   = $product_id;
					$condition['status']    	= '1';
					$check_product_image    	= $this->products_model->get_product_images($condition);
					if(count($check_product_image) > 0){
						if($check_product_image[0]['image_path'] AND $check_product_image[0]['image_name']){
							$product_image			= base_url().''.$check_product_image[0]['image_path'].''.$check_product_image[0]['image_name'];
						}
					}
					
					
					$data = array(
						'id' 	=> $check_products[0]['id'],
						'name' 	=> $check_products[0]['product_name'],
						'image' => $product_image,
						'price' => $check_products[0]['price'],
						'qty' 	=> $quantity,
					);
					
					$this->cart->insert($data);
					
					$result = $this->_show_cart();
				}
			}		
		}
		
		echo $result;
	}
	
	function _show_cart(){
		$data 		= array();		
		
		$data['cart_data'] = $this->cart->contents();
		$this->load->view('show_cart', $data);
	}
	
	function load_cart(){ 
        echo $this->_show_cart();
    }
	
	function delete_cart(){
		$result					= '';
		$product_image          = '';
		if(($this->input->method() == 'post') AND !empty($this->input->post())){
			$row_id	     	= $this->input->post('row_id');
			
			if($row_id){
				$data = array(
					'rowid' => $row_id, 
					'qty' => 0, 
				);
				$this->cart->update($data);
				$result = $this->_show_cart();
			}
		}
		
		echo $result;
    }
	
	function update_cart(){
		$result					= '';
		$product_image          = '';
		if(($this->input->method() == 'post') AND !empty($this->input->post())){
			$row_id	     	= $this->input->post('row_id');
			$qty	     	= $this->input->post('qty');
			
			if($row_id){
				$data = array(
					'rowid' => $row_id, 
					'qty' => $qty, 
				);
				$this->cart->update($data);
				$result = $this->_show_cart();
			}
		}
		
		echo $result;
    }
	
	function checkout(){
		if(count($this->cart->contents()) == 0){
			redirect('welcome/index');
			exit;
		}
		
		$this->session->set_userdata('page', 2);		
		
		$data                       = array();
		$msg                        = '';
		
		$cart_count					= count($this->cart->contents());
		
		if(($this->input->method() == 'post') AND !empty($this->input->post())){		
			if($this->input->post('submit')){
                $name	     		= $this->input->post('name');
				$email	     		= $this->input->post('email');
				$phone_no	    	= $this->input->post('phone_no');
				$address	    	= $this->input->post('address');
				
                if(empty($name)){
                    $msg = 'Enter the name';
                }
				else if(empty($email)){
                    $msg = 'Enter the email';
                } else if(empty($phone_no)){
                    $msg = 'Enter the phone no';
                } else if(empty($address)){
                    $msg = 'Enter the address';
                } else {
					
					$customer_orders_data 					= array();
					$customer_orders_data['name'] 			= $name;
					$customer_orders_data['email'] 			= $email;
					$customer_orders_data['phone_no'] 		= $phone_no;
					$customer_orders_data['address'] 		= $address;
					$customer_orders_data['main_total'] 	= $this->cart->total();
					$customer_orders_data['status']      	= '1';
					$customer_orders_data['created_date']   = date('Y-m-d H:i:s');
					$customer_orders_data['modified_date']  = date('Y-m-d H:i:s');
					
					$result_customer_orders					= $this->customer_orders_model->insert_customer_orders($customer_orders_data);
					if(count($result_customer_orders) > 0){					
						foreach($this->cart->contents() as $key_cart_data => $val_cart_data){
							$customer_order_items_data 						= array();
							$customer_order_items_data['customer_orders_id']= $result_customer_orders['id'];
							$customer_order_items_data['item_id'] 			= $val_cart_data['id'];
							$customer_order_items_data['item_name'] 		= $val_cart_data['name'];
							$customer_order_items_data['item_qty'] 			= $val_cart_data['qty'];
							$customer_order_items_data['item_price'] 		= $val_cart_data['price'];
							$customer_order_items_data['item_total'] 		= $val_cart_data['subtotal'];
							$customer_order_items_data['item_img'] 			= basename($val_cart_data['image']);
							$customer_order_items_data['status']      		= '1';
							$customer_order_items_data['created_date']   	= date('Y-m-d H:i:s');
							$customer_order_items_data['modified_date']  	= date('Y-m-d H:i:s');
							
							$result_customer_order_items					= $this->customer_orders_model->insert_customer_order_items($customer_order_items_data);
						}
						
						$this->session->set_flashdata('order_msg', 'Your order placed successfully');
						
						$this->cart->destroy();
						redirect('welcome/index');
						exit;
						
					}
					
				}
			}
		}
		
		$data['cart_count']  		= $cart_count;
		
		$this->load->view('templates/header');  
		$this->load->view('check_out', $data);
        $this->load->view('templates/footer');
	}
}
