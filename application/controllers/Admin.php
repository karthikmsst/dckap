<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        
        $this->load->model('admin_model');
		
        $this->load->helper(array('form','url','email'));
		$this->load->library(array('cart'));
    }
    
    function index(){
        
        $data                       = array();
        $msg                        = '';        
        
        if(($this->input->method() == 'post') AND !empty($this->input->post())){		
			if($this->input->post('submit')){
                $username	     = $this->input->post('username');
                $password	     = $this->input->post('password');
                
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                
                if ($this->form_validation->run() == FALSE){
                   
                } else {
                    
                    $login_data             = array();
                    $login_data['username'] = $username;
                    $login_data['password'] = md5($password);
                    $login_data['status']   = '1';
                    $result_login           = $this->admin_model->get_admin_login($login_data);
                    if(count($result_login) > 0){                        
                        $this->session->set_userdata('user', $result_login[0]);
                        
                        redirect('categories/manage_categories');
                        exit;
                    } else {
                        $msg = 'Invaild username / password';
                    }                    
                }
            }
        }
        
        
        $data['msg'] = $msg;
        $this->load->view('login', $data);
    }
    
    function logout(){
        /*if(!$this->session->userdata('user')){
            
        }*/
        $this->session->unset_userdata('user');
        session_destroy();
        
        redirect('admin/index');
        exit;
    }
    
}    
?>