<?php

class UserModel extends CI_Model
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
    
}
