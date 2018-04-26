<?php

class DownloadModel extends CI_Model
{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getratingdata($userid)
    {
        $query = $this->db->select('staff_info.name, skill_description.description, skill_rating.rating, skill_category.category')
        ->from('skill_rating')
        ->join('skill_description','skill_description.descriptionId = skill_rating.descriptionId')
        ->join('skill_category','skill_category.categoryId = skill_description.categoryId')
        ->join('staff_info','staff_info.staffId = skill_rating.staffId')
        ->where('staff_info.staffId',$userid)
        ->order_by('skill_category.category', 'DESC')
        ->order_by('skill_description.description', 'DESC')
        ->get();
        return $query->result();
    }
    
    public function getcategorydata()
    {
        $query = $this->db->select('skill_category.category, COUNT(skill_description.description) AS numskill')
            ->from('skill_category')
            ->join('skill_description','skill_description.categoryId = skill_category.categoryId')
            ->group_by('skill_category.category')
            ->order_by('skill_category.category', 'DESC')
            ->get();
        
        return $query;
            
    }
    
    
    
}
