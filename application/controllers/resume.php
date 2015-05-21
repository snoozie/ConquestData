<?php

/*
 * Resume controller
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

class resume extends CI_Controller {

    /**
     * call the parent construct
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * define new model and get Resume data
     */
    public function index() {

        $this->load->model('resume_model', '', TRUE);
        
        $this->load->helper('url');
        
        $personal_details = $this->resume_model->getPersonalDetails();
        $objectives = $this->resume_model->getObjectives();
        $skills = $this->resume_model->getSkills();
        $education = $this->resume_model->getEducation();
        $experience = $this->resume_model->getExperience();
        $hobbies = $this->resume_model->getHobbies();
        $references = $this->resume_model->getReferences();

        $data = array('title'=>"CV", 'personal_details' => $personal_details, 'objectives' => $objectives, 'skills' => $skills,
            'education' => $education, 'experience' => $experience, 'hobbies' => $hobbies, 'references' => $references);   
        
        $this->load->view('resume/header', $data);
        $this->load->view('resume/main', $data);
        $this->load->view('resume/footer', $data);
    }

}
