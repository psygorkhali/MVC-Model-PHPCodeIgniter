<?php

class AdminController extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('adminmodel');
        $this->load->helper('url');
        $this->load->library('session');
    }
    
    public function index()
    {
        $userid = $this->session->userdata('id');
        $data['staffs'] = $this->adminmodel->getalldata($userid);
        $this->load->view('admin_skill_list',$data);
    }
    

    public function update()
    {
        $rateId = $this->uri->segment(3);
        $value = $_POST['rate'];
        $this->adminmodel->update($rateId, $value );
        $data['staffs'] = $this->adminmodel->getalldata($this->session->userdata('id'));
        $this->load->view('admin_skill_list',$data);
    }

    
    public function userinsert()
    {
        //getting the data from view form
        $admin = $_POST['optradio'];
        $username =  $this->input->post("username");
        $password =  $this->input->post("password");
        $status = $this->adminmodel->userinsert($username, $password, $admin);
        if ($status)
        {
            
            $this->index();  
        }
        else
        {
            
        }
        
        
    }
    
    public function stafflist()
    {
        $data['staffs'] = $this->adminmodel->getstafflist();
        $this->load->view('staff_list',$data);
    }
    
    public function staffdetail()
    {
        $staffId = $this->uri->segment(3);
        $data['staffs'] = $this->adminmodel->getstaffdetail($staffId);
        $this->load->view('view_skill_list', $data);
    }
    
    public function skill_list()
    {
        $data['skills'] = $this->adminmodel->getskill_list();
        $this->load->view('category_list',$data);
    }
}
