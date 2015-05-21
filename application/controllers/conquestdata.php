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
        
        // To use sessions
        $this->load->library('session');
    }

    /**
     * define new model and get Resume data
     */
    public function index() 
    {
		$this->load->helper('url');

        $this->load->model('conquestdata_model', '', TRUE);

        //$current_pass = $this->HallPass_model->getCurrentPass(1);

        $data = array('title'=>"HOME");   
        
        $this->load->view('header', $data);
        $this->load->view('main', $data);
        $this->load->view('footer');

    }
    
    public function about_us()
    {
        $this->load->helper('url');

        $this->load->model('conquestdata_model', '', TRUE);

        //$current_pass = $this->HallPass_model->getCurrentPass(1);

        $data = array('title'=>"About Us");   
        
        $this->load->view('header', $data);
        $this->load->view('about_us', $data);
        $this->load->view('footer');
    }
    
    public function services()
    {
        $this->load->helper('url');

        $this->load->model('conquestdata_model', '', TRUE);

        //$current_pass = $this->HallPass_model->getCurrentPass(1);

        $data = array('title'=>"Services");   
        
        $this->load->view('header', $data);
        $this->load->view('services', $data);
        $this->load->view('footer');
    }
    
    public function pricing()
    {
        $this->load->helper('url');

        $this->load->model('conquestdata_model', '', TRUE);

        //$current_pass = $this->HallPass_model->getCurrentPass(1);

        $data = array('title'=>"Costing");   
        
        $this->load->view('header', $data);
        $this->load->view('pricing', $data);
        $this->load->view('footer');
    }
    
    public function contact()
    {
        $this->load->helper('url');

        $this->load->model('conquestdata_model', '', TRUE);

        //$current_pass = $this->HallPass_model->getCurrentPass(1);

        $data = array('title'=>"Contact");   
        
        $this->load->view('header', $data);
        $this->load->view('contact', $data);
        $this->load->view('footer');
    }

    public function email()
    {
        $config = Array(
            'protocol' => 'smtp',
            //'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_host' => 'vmcp28.digitalpacific.com.au',
            'smtp_port' => 465,
            //'smtp_user' => 'stheron08@gmail.com', // change it to yours
            'smtp_user' => 'susan.theron@conquestdata.com.au',
            //'smtp_pass' => 'lillyElf_66', // change it to yours
            'smtp_pass' => 'II6vD0nvAiX',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        
        $this->load->library('email'); // Note: no $config param needed
        $this->load->helper('url');
        
        $from = $this->input->post("email");
        $subject = $this->input->post("subject");
        $enquiry = $this->input->post("enquiry");
        
        $this->email->set_newline("\r\n");

        // Set to, from, message, etc.
        
        $this->load->model('conquestdata_model', '', TRUE);

        $return = $this->conquestdata_model->sendEmail($from, $subject, $enquiry);
        if($return)
        {
            $this->email->from($from);
            $this->email->to('stheron08@gmail.com');
            $this->email->subject($subject);
            $this->email->message($enquiry);
            if($this->email->send())
            {
                redirect('/contact', 'refresh');
            }
            else
           {
            show_error($this->email->print_debugger());
           }
            
            //$result = $this->email->send($from, $subject, $enquiry);
        }
    }
        
    public function faq()
    {
        $this->load->helper('url');

        $this->load->model('conquestdata_model', '', TRUE);

        //$current_pass = $this->HallPass_model->getCurrentPass(1);

        $data = array('title'=>"FAQ");   
        
        $this->load->view('header', $data);
        $this->load->view('faq', $data);
        $this->load->view('footer');
    }
    
    public function projects()
    {
        $this->load->helper('url');

        $this->load->model('conquestdata_model', '', TRUE);
        
        if($this->session->userdata('logged_in') == true)
        {
            $student_id = $this->session->userdata('student_id');
        }
        else
        {
            redirect('/projects_login', 'refresh');
        }

        $projects = $this->conquestdata_model->getAllProjects();
        $tasks = $this->conquestdata_model->getProjectsTasks();

        $data = array('title'=>"Projects", 'projects' => $projects, 'tasks' => $tasks);   
        
        $this->load->view('header', $data);
        $this->load->view('projects', $data);
        $this->load->view('footer');
    }
    
    public function projects_login()
    {
        $this->load->helper('url');
        
        $this->load->model('conquestdata_model', '', TRUE);

        //$current_pass = $this->HallPass_model->getStudents();
        
        if($this->session->userdata('logged_in') == true)
        {
            redirect('/projects', 'refresh');
        }
        
        $data = array('page_title'=>"Conquest Data");  
        
        $this->load->view('header');
        $this->load->view('projects_login', $data);
        $this->load->view('footer');
    }
    
    public function projects_addtime($project_id)
    {
        $this->load->helper('url');
        
        $this->load->model('conquestdata_model', '', TRUE);

        //$current_pass = $this->HallPass_model->getStudents();
        
        /*if($this->session->userdata('logged_in') == true)
        {
            redirect('/projects', 'refresh');
        }*/
        
        $data = array('page_title'=>"Conquest Data", 'project_id' => $project_id);  
        
        //$this->load->view('header');
        $this->load->view('projects_addtime', $data);
        //$this->load->view('footer');
    }
    
    public function projects_add()
    {
        $this->load->helper('url');
        
        $this->load->model('conquestdata_model', '', TRUE);
        
        $project = $this->input->post("project");
        $description = $this->input->post("description");
        $start = $this->input->post("start");
        $end = $this->input->post("end");
        
        $time = array('project' => $project,
                        'description' => $description,
                        'start' => $start,
                        'end' => $end);
        
        $result = $this->conquestdata_model->addTimeToProject($time);
        
        echo $result;
    }
    
    public function intro_hall_pass()
    {
        $this->load->view('intro_hallpass');
    }
    
    public function intro_project_cost_report()
    {
        $this->load->view('intro_projectcostreport');
    }
    
    public function intro_casting_kids()
    {
        $this->load->view('intro_castingkids');
    }

    public function info()
    {
        $this->load->helper('url');
        
        $this->load->view('info');
    }
    
    public function login()
    {
        $this->load->helper('url');
        
        $this->load->model('conquestdata_model', '', TRUE);

        // use sha2 and salt (first 4 letters of name)
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        
        //$pass = password_hash($password, PASSWORD_BCRYPT);
        $result = $this->conquestdata_model->authentication_user($username);
        $this->session->set_userdata('user_id', $result[1]);
        
        $this->session->set_userdata('logged_in', true);
        
        echo json_encode(array(password_verify($password, $result[0]), $result[1]));
        //echo json_encode($teacher);
    }
    
    public function logout()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        $type = "";
        
        if($this->session->userdata('student_id'))
        {
            $this->session->unset_userdata('student_id');
            
            $type = "student";
        }
        else if($this->session->userdata('staff_id'))
        {
            $this->session->unset_userdata('staff_id');
            
            $type = "staff";
        }
        
        if($this->session->userdata('logged_in'))
        {
            $this->session->unset_userdata('logged_in');
        }
        
        if($type == "student")
        {
            header("location: student_login");
        }
        else if($type == "staff")
        {
            header("location: staff_login");
        }
    }
}
