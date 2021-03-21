<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        $this->load->model('categories_model');
        
        $this->load->helper(array('form','url','email'));
    }
    
    function index(){
        redirect('categories/manage_categories');
        exit;
    }
    
    function manage_categories(){
        
        $data                       = array();
        
        $result_categories          = array();
        
        $condition                  = array();
        $condition['status']        = '1';
        $result_categories          = $this->categories_model->get_categories($condition);
        
        $data['result_categories']  = $result_categories;
        
        $this->load->view('templates/admin_header');
        $this->load->view('categories/manage_categories', $data);
        $this->load->view('templates/admin_footer');
    }
    
    function add_categories(){
        $data                       = array();
        $msg                        = '';
        
        if(($this->input->method() == 'post') AND !empty($this->input->post())){		
			if($this->input->post('submit')){
                $category_name	     = $this->input->post('category_name');
                if(empty($category_name)){
                    $msg = 'Enter the category name';
                } else {                    
                    $categories_data                    = array();
                    $categories_data['name']            = $category_name;
                    $categories_data['parent_id']       = 0;
                    $categories_data['status']          = '1';                     
                    
                    $check_categories                   = $this->categories_model->get_categories($categories_data);
                    if(count($check_categories) > 0){
                        $msg = 'Already exist';
                    } else {
                        $categories_data['created_date']    = date('Y-m-d H:i:s');
                        $categories_data['modified_date']   = date('Y-m-d H:i:s');
                        
                        $result_categories                  = $this->categories_model->insert_categories($categories_data);
                        if(count($result_categories) > 0){
                            redirect('categories/manage_categories');
                            exit;
                        }
                    }
                }
            }
        }
        
        $data['msg']                = $msg;
        $this->load->view('templates/admin_header');
        $this->load->view('categories/add_categories', $data);
        $this->load->view('templates/admin_footer');
    }
    
    function delete_categories($id = ''){
        if($id){
            $condition              = array();
            $condition['id']        = $id;
            $condition['status']    = '1';
            $check_categories       = $this->categories_model->get_categories($condition);
            if(count($check_categories) > 0){
                $categories_data                    = array();                
                $categories_data['status']          = '0';
                $categories_data['modified_date']   = date('Y-m-d H:i:s');
                
                $condition                          = array();
                $condition['id']                    = $id;                
                $result_categories                  = $this->categories_model->update_categories($categories_data, $condition);
                if($result_categories){
                    redirect('categories/manage_categories');
                    exit; 
                }
            }
        }
        
        exit;
    }
}
?>