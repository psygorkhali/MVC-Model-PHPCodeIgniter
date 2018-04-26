<?php

class LoginController extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('loginmodel');
        $this->load->helper('url');
        $this->load->library('session');
    }
    

    public function index()
    {
        //generate login form
        $this->load->view('loginform');
    }
    
    // check to see if the entered username and password is correct or not
    public function validation()
    {
        //getting the data from view form
        $username =  $this->input->post("username");
        $password =  $this->input->post("password");
        
        $check = $this->loginmodel->validation($username, $password);
        
        //check to see entered user is admin or normal user
        if ($check->num_rows())
        {
            //database operation to list all the rating of skills and pass it to the view
            
            
            if ( $check->row()->admin == 1)
            {
                
            
                $this->session->set_userdata('id',$check->row()->staffId);
                redirect('/admincontroller');
                
            } 
            else 
            {
                
                $this->session->set_userdata('id', $check->row()->staffId);
                redirect('/usercontroller');
//                echo $this->session->userdata('id');
                
            }

        }

        else
        {
            //redirect to the login page again with error message
            $data['error'] = "Either username or password is incorrect"; 
            $this->load->view('loginform', $data);
        }
        
    }
    

}
