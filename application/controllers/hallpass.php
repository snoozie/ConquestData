<?php

/*
 * Resume controller
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

class hallpass extends CI_Controller {

    /**
     * define new model and get Resume data
     */
    
    function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        
        date_default_timezone_set('Australia/Melbourne');
    }
    public function index()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        if($this->session->userdata('logged_in') == true)
        {
            $student_id = $this->session->userdata('student_id');
        }
        else
        {
            redirect('/student_login', 'refresh');
        }

        $current_pass = $this->HallPass_model->getCurrentPass($student_id);

        $data = array('page_title'=>"Hall Pass", 'login' => "Yes", 'current_pass' => $current_pass);   
        
        $this->load->view('hallpass/header', $data);
        $this->load->view('hallpass/main', $data);
        $this->load->view('hallpass/footer');
    }
    
    public function give_pass() 
    {

        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        $student_id = 0;
      
        if($this->session->userdata('logged_in') == true)
        {
            $student_id = $this->session->userdata('student_id');
        }
        else
        {
            redirect('/student_login', 'refresh');
        }

        $current_pass = $this->HallPass_model->getCurrentPass($student_id);

        $data = array('page_title'=>"Hall Pass", 'login' => "Yes", 'current_pass' => $current_pass);   
        
        $this->load->view('hallpass/header', $data);
        $this->load->view('hallpass/give_pass', $data);
        $this->load->view('hallpass/footer');

    }
    
    public function give_pass2() 
    {

        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        $student_id = 0;
      
        if($this->session->userdata('logged_in') == true)
        {
            $student_id = $this->session->userdata('student_id');
        }
        else
        {
            redirect('/student_login', 'refresh');
        }

        $current_pass = $this->HallPass_model->getCurrentPass($student_id);

        $data = array('page_title'=>"Hall Pass", 'login' => "Yes", 'current_pass' => $current_pass);   
        
        $this->load->view('hallpass/header', $data);
        $this->load->view('hallpass/give_pass2', $data);
        $this->load->view('hallpass/footer');

    }
    
    public function give_pass3() 
    {

        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        $student_id = 0;
      
        if($this->session->userdata('logged_in') == true)
        {
            $student_id = $this->session->userdata('student_id');
        }
        else
        {
            redirect('/student_login', 'refresh');
        }

        $current_pass = $this->HallPass_model->getCurrentPass($student_id);

        $data = array('page_title'=>"Hall Pass", 'login' => "Yes", 'current_pass' => $current_pass);   
        
        $this->load->view('hallpass/header', $data);
        $this->load->view('hallpass/give_pass3', $data);
        $this->load->view('hallpass/footer');

    }
    
    public function give_pass_popup($studentID = 0) 
    {

        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);

        // Get student details to make pass
        $student = $this->HallPass_model->getStudents($studentID);

        $data = array('page_title'=>"Hall Pass", 'student_details' => $student);   
        
        //$this->load->view('header');
        $this->load->view('hallpass/give_pass', $data);
        //$this->load->view('footer');

    }
    
    public function pass_expired($pass_id) 
    {
        $this->load->helper('url');
        
        $data = array('page_title'=>"Hall Pass", 'login' => "Yes", 'pass_id' => $pass_id);   
        
        $this->load->view('hallpass/header', $data);
        $this->load->view('hallpass/pass_expired', $data);
        $this->load->view('hallpass/footer');
    }
    
    /**
     * Uses form info to add more time to pass
     */
    public function add_time()
    {
        //$pass_id = $this->input->post("pass_id");
        $teacher = $this->input->post("access_code");
        $expiry = date('Y-m-d') . " " .$this->input->post("time");
        $notes = $this->input->post("notes");
        $pass_id = $this->input->post("pass_id");
        $device = $this->input->post("device");
        
        $this->load->helper('url');

        $this->load->model('HallPass_model', '', TRUE);
        
        $pass = array('pass_id' => $pass_id,
                                'expiry_date' => $expiry,
                                //'area' => $area, //should I include area when adding time.
                                'teacher' => $teacher,
                                'notes' => $notes);


        $return = $this->HallPass_model->addTime($pass);
        
        //exit;
        if($device == "mobile")
        {
            if($return == true)
            {
                echo "Yes";
            }
            else {
                echo "No";
            }
        }
        else {
            redirect('/index', 'refresh');
        }
        
    }
	
    /**
     * Get all passes for a particular range.
     * 
     * @param type $range
     */
    public function staff($range = "") 
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);

        $current_pass = $this->HallPass_model->getAllPasses($range);

        $data = array('page_title'=>"Hall Pass", 'current_pass' => $current_pass);  
        
        //$this->load->view('staff_header');
        $this->load->view('hallpass/staff', $data);
        //$this->load->view('footer');

    }
	
    public function sendPass($id = 0)
    {

        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);

        $start_date = date("Y-m-d H:i:s");
        $expiry = date("Y-m-d H:i:s");
              
        $currentDate = strtotime($expiry);
        $time = $this->input->post('expiry');
        $futureDate = $currentDate+(60*$time);
        $expiry_date = date("Y-m-d H:i:s", $futureDate);
        //$expiry_date = date('Y-m-d') . " " .$_POST['expiry'];
        $studentID = 1;
        if($id > 0)
        {
            $studentID = $id;
        }
        else{
            $studentID = $this->session->userdata('student_id');
        }
        
        $area = $this->input->post("area");
        $teacher = $this->input->post('access_code');
        $device = $this->input->post("device");
        $pass = array('student_id' => $studentID,
                                'start_date'=> $start_date,
                                'expiry_date' => $expiry_date,
                                'area' => $area,
                                'teacher' => $teacher);


        $result = $this->HallPass_model->createPass($pass);
        
        /**
         * Notify staff of more than 5 passes in one day
         */
        //if($num_passes > 4)
        //{
            //notification

           // $this->session->set_userdata('warning','Passes');
       // }
        if($device == "mobile")
        {
            if($return == true)
            {
                echo "Yes";
            }
            else {
                echo "No";
            }
        }
        else {
            redirect('/hallpass', 'refresh');
        }
        
        //$num_passes = 2;
        //redirect('/index', 'refresh');
        //echo "boo";
    }
    
    public function checkCode()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        $code = $this->input->post("access_code");
        $user = $this->input->post("user");
        
        $teacher = $this->HallPass_model->checkCode($code, $user);
        
        echo json_encode($teacher);
    }
    
    public function checkTime()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        $time = $this->input->post("time");
        
        
        
        $teacher = $this->HallPass_model->checkCode($code);
        
        echo json_encode($teacher);
    }
    
    public function checkPass()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        $studentID = $this->session->userdata('student_id');
        $current_pass = $this->HallPass_model->checkPass($studentID);
        
        echo json_encode($current_pass);
    }
    
    public function revokePass($pass_id = "")
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        if($pass_id == "")
        {
            $pass_id = $this->input->post("pass_id");
        }
        
        $current_pass = $this->HallPass_model->revokePass($pass_id);
        echo json_encode($current_pass);
    }
    
    /**
     * Loads up form to change pass
     * 
     */
    public function changePass()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);

        $current_pass = $this->HallPass_model->getCurrentPass(1);

        $data = array('page_title'=>"Hall Pass", 'current_pass' => $current_pass);   
        
        //$this->load->view('header');
        $this->load->view('hallpass/changePass', $data);
        //$this->load->view('footer');
    }
    
    public function passLog($pass_id)
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);

        $pass_changes = $this->HallPass_model->getPassChanges($pass_id);

        $data = array('page_title'=>"Hall Pass", 'pass_changes' => $pass_changes);   
        
        //$this->load->view('header');
        $this->load->view('hallpass/passChanges', $data);
        //$this->load->view('footer');
    }
    
    public function login()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);

        // use sha2 and salt (first 4 letters of name)
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $type = $this->input->post('type');
        
        //$pass = password_hash($password, PASSWORD_BCRYPT);
        if($type === "student")
        {
            $result = $this->HallPass_model->authentication_student($username);
            $this->session->set_userdata('student_id', $result[1]);
        }
        else if($type === "staff")
        {
            $result = $this->HallPass_model->authentication_staff($username);
            $this->session->set_userdata('staff_id', $result[1]);
            
        }
        
        $this->session->set_userdata('logged_in', true);
        
        echo json_encode(array(password_verify($password, $result[0]), $result[1], $type));
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
    
    public function post_login()
    {
        
    }
    
    public function login_check()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        // use sha2 and salt (first 4 letters of name)
        $username = "admin";
        $password = 'tMbPvtne6FA';
        
        $pass = password_hash($password, PASSWORD_BCRYPT);
        echo $pass; echo "</br>";
        $pass2 = $this->HallPass_model->authentication_student($username);
        $verify = password_verify($password, $pass2[0]);
        echo $verify;
    }
    
    public function getCurrentPass()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        //$user_id = $this->input->post("user_id");
        
        $user_id = 1;

        $current_pass = $this->HallPass_model->getCurrentPass($user_id);
        
        $pass = array();
        
        if(!empty($current_pass))
        {
            foreach($current_pass as $d)
            {
                $date = new DateTime();
                if($d->expiry_date < $date->format('Y-m-d H:i:s'))
                {
                    echo json_encode(array($d->pass_id, $d->expiry, $d->area, $d->first_name, $d->last_name));
                }
                else
                {
                    echo json_encode(array($d->pass_id, $d->expiry_date, $d->area, $d->first_name, $d->last_name));
                }
                
            }
        }
        else {
            echo "none";
        }
        
    }
    
    public function students()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);

        $current_pass = $this->HallPass_model->getStudents();
        
        //return $current_pass;
        $data = array('page_title'=>"Hall Pass", 'current_pass' => $current_pass);  
        
        //$this->load->view('staff_header');
        $this->load->view('hallpass/students', $data);
        //$this->load->view('footer');
    }
    
    public function staffView()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);

        //$current_pass = $this->HallPass_model->getStudents();
        
        //return $current_pass;
        //$data = array('page_title'=>"Hall Pass", 'current_pass' => $current_pass);  
        
        if($this->session->userdata('logged_in') == true)
        {
            $staff_id = $this->session->userdata('staff_id');
        }
        else
        {
            redirect('/staff_login', 'refresh');
        }
        
        $this->load->view('hallpass/staff_header');
        $this->load->view('hallpass/staffView');
        $this->load->view('hallpass/footer');
    }
    
    // Show all passes for a student
    public function showPasses($studentID, $range)
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);

        
        $all_passes = $this->HallPass_model->getPasses($studentID, "");
        $yearly_passes = $this->HallPass_model->getPasses($studentID, "year");
        $monthly_passes = $this->HallPass_model->getPasses($studentID, "month");
        $weekly_passes = $this->HallPass_model->getPasses($studentID, "week");
        $daily_passes = $this->HallPass_model->getPasses($studentID, "today");
        
        //return $current_pass;
        $data = array('page_title'=>"Hall Pass", 'all' => $all_passes, 'year' => $yearly_passes,
            'month' => $monthly_passes, 'week' => $weekly_passes, 'today' => $daily_passes, 'range' => $range);  
        
        //$this->load->view('staff_header');
        $this->load->view('hallpass/showPasses', $data);
        //$this->load->view('footer');
    }
    
    public function not_needed()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        $pass_id = $this->input->post("pass_id");

        $current_pass = $this->HallPass_model->not_needed($pass_id);
    }
    
    public function student_login()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);
        
        if($this->session->userdata('logged_in') == true)
        {
            redirect('/hallpass', 'refresh');
        }

        $current_pass = $this->HallPass_model->getStudents();
        
        //return $current_pass;
        $data = array('page_title'=>"Hall Pass", 'login' => "No", 'current_pass' => $current_pass);  
        
        $this->load->view('hallpass/header', $data);
        $this->load->view('hallpass/student_login', $data);
        $this->load->view('hallpass/footer');
    }
    
    public function staff_login()
    {
        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);

        $current_pass = $this->HallPass_model->getStudents();
        
        if($this->session->userdata('logged_in') == true)
        {
            redirect('/staffView', 'refresh');
        }
        
        //return $current_pass;
        $data = array('page_title'=>"Hall Pass", 'current_pass' => $current_pass);  
        
        $this->load->view('hallpass/staff_header');
        $this->load->view('hallpass/staff_login', $data);
        $this->load->view('hallpass/footer');
    }
    
    public function add_student() 
    {

        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);

        // Get student details to make pass
        //$student = $this->HallPass_model->getStudents($studentID);

        //$data = array('page_title'=>"Hall Pass", 'student_details' => $student);   
        
        //$this->load->view('header');
        $this->load->view('hallpass/create_student');
        //$this->load->view('footer');

    }
    
    public function create_student($id = 0)
    {

        $this->load->helper('url');
        
        $this->load->model('HallPass_model', '', TRUE);

        $dob = $this->input->post("dob");
        $dob_ = strtotime($dob);

        $dob_date = date("Y-m-d", $dob_);
        //$expiry_date = date('Y-m-d') . " " .$_POST['expiry'];
        $studentID = 1;
        if($id > 0)
        {
            $studentID = $id;
        }
        else{
            $studentID = $this->session->userdata('student_id');
        }
        
        $first_name = $this->input->post("first_name");
        $last_name = $this->input->post("last_name");
        $username = $this->input->post("user");
        $password = $this->input->post("password");
        $password_verify = $this->input->post("password_verify");
        
        if($password === $password_verify)
        {
            $pass = password_hash($password, PASSWORD_BCRYPT);
            //echo $pass; echo "</br>";
            //$pass2 = $this->HallPass_model->authentication_staff($username);
            //$verify = password_verify($password, $pass2[0]);
            
            $student = array('first_name' => $first_name,
                                'last_name'=> $last_name,
                                'dob' => $dob_date,
                                'username' => $username,
                                'password' => $pass);


            $result = $this->HallPass_model->createStudent($student);
            
            if($result == 1)
            {
                echo "1";

//header("refresh:1; url=/conquestdata/index.php/staffView");
                //echo '<meta http-equiv="refresh" content="1" />';
                //header("location: /conquestdata/index.php/staffView");
                //echo "<script type='text/javascript'>alert('here');parent.window.location.reload();</script>";
            }
            else
            {
                echo "Error";
            }
        }
        else
        {
            echo "Passwords dont match";
        }

    }

}
