<?php

/*
 * Resume model
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

class resume_model extends CI_Model{

    /**
     * call the parent construct
     */
    public function __construct(){
            parent::__construct();
    }
    
    /*
     * Get personal details from database
     */
    public function getPersonalDetails()
    {
        $DB = $this->load->database('resume', TRUE);
        
        $query = $DB->query("SELECT * FROM `personal details`");
        
        return $query->result();
    }
    
    /*
     * Get objectives from database
     */
    public function getObjectives()
    {
        $DB = $this->load->database('resume', TRUE);
        
        $query = $DB->query("SELECT * FROM `objectives`");
        
        return $query->result();
    }
    
    /*
     * Get skills from database
     */
    public function getSkills()
    {
        $DB = $this->load->database('resume', TRUE);
        
        $query = $DB->query("SELECT * FROM `skills`");
        
        return $query->result();
    }
    
    /*
     * Get education from database
     */
    public function getEducation()
    {
        $DB = $this->load->database('resume', TRUE);
        
        $query = $DB->query("SELECT * FROM `education`");
        
        return $query->result();
    }
    
    /*
     * Get experience from database
     */
    public function getExperience()
    {
        $DB = $this->load->database('resume', TRUE);
        
        $query = $DB->query("SELECT * FROM `experience` Order by `Start` DESC");
        
        return $query->result();
    }
    
    /*
     * Get hobbies from database
     */
    public function getHobbies()
    {
        $DB = $this->load->database('resume', TRUE);
        
        $query = $DB->query("SELECT * FROM `hobbies`");
        
        return $query->result();
    }
    
    /*
     * Get references from database
     */
    public function getReferences()
    {
        $DB = $this->load->database('resume', TRUE);
        
        $query = $DB->query("SELECT * FROM `references`");
        
        return $query->result();
    }

}
