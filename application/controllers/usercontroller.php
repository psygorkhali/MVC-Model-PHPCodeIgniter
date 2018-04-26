<?php

class UserController extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('usermodel');
        $this->load->helper('url');
        $this->load->library('session');
    }
    
    public function index()
    {
        
        $userid = $this->session->userdata('id');
        $data['staffs'] = $this->usermodel->getalldata($userid);
        $this->load->view('skill_list',$data);
    }
    

    public function update()
    {
        $rateId = $this->uri->segment(3);
        $value = $_POST['rate'];
        $this->usermodel->update($rateId, $value );
        $data['staffs'] = $this->usermodel->getalldata($this->session->userdata('id'));
        $this->load->view('skill_list',$data);
        
    }
    

}
