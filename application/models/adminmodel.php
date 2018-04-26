<?php

class AdminModel extends CI_Model
{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getalldata($userid)
    {
        $query = $this->db->select('skill_rating.rateId, staff_info.name, skill_description.description, skill_rating.rating, skill_category.category')
        ->from('skill_rating')
        ->join('skill_description','skill_description.descriptionId = skill_rating.descriptionId')
        ->join('skill_category','skill_category.categoryId = skill_description.categoryId')
        ->join('staff_info','staff_info.staffId = skill_rating.staffId')
        ->where('staff_info.staffId',$userid)
        ->get();
        return $query->result();
    }
    
    public function update($rateId, $value)
    {
        $data = array(
        'rating' => $value
        );
        
        $array = array('rateId' => $rateId);
        $this->db->where($array);
        $this->db->update('skill_rating', $data);
    }
    
    public function userinsert($username, $password, $admin)
    {
        $data = array(
            'name' => $username,
            'password' => $password,
            'admin' => $admin
        );

        $this->db->trans_start();
        $this->db->insert('staff_info', $data);
        $last_id = $this->db->insert_id();
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) 
        {
            return false;
        } 
        else 
        {
            
            $this->userdescriptionaddition($last_id);
            return true;
        }
    }

    public function getstafflist()
    {
        $query = $this->db->get('staff_info');
        return $query->result();
    }
    
    public function userdescriptionaddition($last_id)
    {
        
        $query = $this->db->select('descriptionId')->from('skill_description')->get();
        $result = $query->result();
        for ($c = 0; $c < $query->num_rows(); $c++)
        {
            $data = array(
            'descriptionId' => $result[$c]->descriptionId,
            'staffId' => $last_id,
            'rating' => 0
                        );
            $this->db->insert('skill_rating', $data);
        }
        
    }
    
    public function getstaffdetail($id)
    {
        $query = $this->db->select('staff_info.staffId, skill_rating.rateId, staff_info.name, skill_description.description, skill_rating.rating, skill_category.category')
        ->from('skill_rating')
        ->join('skill_description','skill_description.descriptionId = skill_rating.descriptionId')
        ->join('skill_category','skill_category.categoryId = skill_description.categoryId')
        ->join('staff_info','staff_info.staffId = skill_rating.staffId')
        ->where('staff_info.staffId',$id)
        ->get();
        return $query->result();
    }
    
    public function getskill_list()
    {
        $query = $this->db->select('skill_description.description, skill_category.category')
        ->from('skill_description')
        ->join('skill_category','skill_category.categoryId = skill_description.categoryId')
        ->get();
        return $query->result();
    }
}
