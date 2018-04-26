<?php

class LoginModel extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    
    public function validation($username, $password)
    {
        $array = array('name' => $username, 'password' => $password);
        $query = $this->db->select('staffId, name, password, admin')->from('staff_info')->where($array)->get();
        return $query;
    }
}
