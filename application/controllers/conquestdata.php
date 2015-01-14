<?php

/*
 * Resume controller
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

class conquestdata extends CI_Controller {

    /**
     * call the parent construct
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * define new model and get Resume data
     */
    public function index() 
    {
		$this->load->helper('url');

        $this->load->model('conquestdata', '', TRUE);

        //$current_pass = $this->HallPass_model->getCurrentPass(1);

        $data = array('page_title'=>"Conquest Data");   
        
        $this->load->view('header');
        $this->load->view('main', $data);
        $this->load->view('footer');

    }
    
    public function about_us()
    {
        $this->load->helper('url');

        $this->load->model('conquestdata', '', TRUE);

        //$current_pass = $this->HallPass_model->getCurrentPass(1);

        $data = array('page_title'=>"Conquest Data");   
        
        $this->load->view('header');
        $this->load->view('about_us', $data);
        $this->load->view('footer');
    }
    
    public function contact()
    {
        $this->load->helper('url');

        $this->load->model('conquestdata', '', TRUE);

        //$current_pass = $this->HallPass_model->getCurrentPass(1);

        $data = array('page_title'=>"Conquest Data");   
        
        $this->load->view('header');
        $this->load->view('contact', $data);
        $this->load->view('footer');
    }

}
