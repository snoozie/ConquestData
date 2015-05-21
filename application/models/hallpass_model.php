<?php 
/*
 * Hall Pass model
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

class HallPass_model extends CI_Model{

    /**
     * call the parent construct
     */
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    /*
     * Get current pass for student from database
     */
    public function getCurrentPass($studentID)
    {
        //$DB1 = $this->load->database('default', TRUE);
        $DB2 = $this->load->database('hall_pass', TRUE);
        // Use for both new and changed passes. Change sql query to include added_time
        //$DB1 = $this->load->database('default', TRUE);
        //$DB2 = $this->load->database('hall_pass', TRUE); 
        $query_string = "SELECT * FROM `passes`, `teachers` WHERE student_id = ? and expiry_date >= NOW() AND start_date <= NOW() and teachers.access_code = passes.teacher AND Revoked = ? AND not_needed = ?";
        $query = $DB2->query($query_string, array($studentID, 'N', '0000-00-00 00:00:00')); 
        
        /*if(empty($query->result()))
        {
            $query_string2 = "SELECT * FROM `passes`, `teachers`, `added_time` WHERE student_id = ? and expiry >= NOW() "
                    . "and teachers.access_code = passes.teacher AND `added_time`.`pass_id` = `passes`.`pass_id` AND Revoked = ? AND not_needed = ?";
            $query2 = $this->db->query($query_string2, array($studentID, 'N', '0000-00-00 00:00:00')); 
            
            return $query2->result();
        }
        else {
            return $query->result();
        }*/
        return $query->result();
    }
    
    public function checkPass($studentID)
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        $query_string = "SELECT * FROM `passes`, `teachers` WHERE student_id = ? and expiry_date > NOW() AND start_date < NOW() and teachers.access_code = passes.teacher ORDER BY pass_id DESC LIMIT 1";
        
        $query = $DB2->query($query_string, array($studentID)); 

        return $query->result();
    }
	
    public function createPass($data)
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        $query_string = "SELECT * FROM `passes` WHERE student_id = ? and expiry_date < concat(CURDATE(), '11:59:00') AND start_date > CURDATE()";
        //$current_passes = $this->db->query("SELECT * FROM `passes` WHERE student_id = " .$data['student_id']. " and expiry_date < concat(CURDATE(), '11:59:00') AND start_date > CURDATE()");
        $current_passes = $DB2->query($query_string, array($data['student_id']));
        $num_passes = count($current_passes);
        if( $num_passes > 5)
        {
            //notify staff of more than 5 passes in one day
            
        }
        $start_date = new DateTime($data['start_date']);
        $expiry_date = new DateTime($data['expiry_date']);
        
        $pass = array('student_id' => $data['student_id'],
                            'start_date' => $start_date->format('Y-m-d H:i:s'),
                            'expiry_date' => $expiry_date->format('Y-m-d H:i:s'),
                            'area' => $data['area'],
                            'teacher' => $data['teacher']);
        
        if($DB2->insert('passes', $pass))
        {
            return true;
        }
        
        //return number of passes for analysis
        //return $num_passes;
    }
    
    /*
     * Add time to existing pass by inserting a new record into table
     * added_time that points to pass in table passes
     */
    public function addTime($data)
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        $expiry_date = new DateTime($data['expiry_date']);
        
        $pass = array('expiry' => $expiry_date->format('Y-m-d H:i:s'),
                            'teacher' => $data['teacher'],
                            'pass_id' => $data['pass_id'],
                            'notes' => $data['notes']);
        
        if($DB2->insert('added_time', $pass))
        {
            return true;
        }
    }
    
    public function getInterval($range = "")
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        $interval = "";
        if($range == "today")
        {
            $interval = " AND DATE(`start_date`) = CURDATE()";
        }
        else if($range == "week")
        {
            //$query .= " AND DATE(`start_date`) <= < NOW() - INTERVAL 1 WEEK";
            $interval = " AND WEEK(DATE(`start_date`)) = WEEK(NOW())";
        }
        
        else if($range == "month")
        {
            $interval = " AND MONTH(DATE(`start_date`)) = MONTH(NOW())";
        }
        
        else if($range == "year")
        {
            $interval = " AND YEAR(DATE(`start_date`)) = YEAR(NOW())";
        }
        
        return $interval;
    }
	// Get All Passes for a student
    public function getPasses($student_ID, $range = "")
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        $interval = $this->getInterval($range);
        
        $query = "SELECT p1.`student_id` as student,`start_date`, p1.`pass_id` as pass, `expiry_date`, `area`, `Revoked`,
		`students`.`first_name` AS s_FN, `students`.`last_name` AS s_LN, 
		`teachers`.`first_name` AS t_FN, `teachers`.`last_name` AS t_LN, 
        (select count(*) from passes p2  where p1.student_id = p2.student_id $interval) as count,
        (select count(*) from added_time where p1.pass_id = added_time.pass_id) as changes
		FROM passes p1, `students`, `teachers`
        WHERE students.student_id = p1.student_id AND teachers.access_code = p1.teacher AND students.student_id = '$student_ID'";
        $query .= $interval;
        $query .= " Group by p1.`student_id`,start_date, expiry_date "
                . "Order by start_date DESC, expiry_date, `students`.`first_name`, `students`.`last_name`";
     
        $result = $DB2->query($query);
        $passes = array();

        foreach($result->result() as $pass)
        {
            $start_date = new DateTime($pass->start_date);
            $expiry_date = new DateTime($pass->expiry_date);
            $passes[] = array('pass' => $pass->pass,'area' => $pass->area,
                            's_FN' => $pass->s_FN,'s_LN' => $pass->s_LN,
                            'start_date' => $start_date->format('Y-m-d H:i:s'),
                            'expiry_date' => $expiry_date->format('Y-m-d H:i:s'),
                            't_FN' => $pass->t_FN,'t_LN' => $pass->t_LN,
                            'count' => $pass->count,'changes' => $pass->changes,
                            'R' => $pass->Revoked);
        }
        
        return $passes;
    }
    
	/*
     * Get all pass details as well as number of passes so far for that day
     */
    public function getAllPasses($range = "")
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        /* @var $interval type */
        $interval = $this->getInterval($range);
        
        $query = "SELECT p1.`student_id` as student,`start_date`, p1.`pass_id` as pass, `expiry_date`, `area`, `Revoked`,
		`students`.`first_name` AS s_FN, `students`.`last_name` AS s_LN, 
		`teachers`.`first_name` AS t_FN, `teachers`.`last_name` AS t_LN, 
        (select count(*) from passes p2  where p1.student_id = p2.student_id $interval) as count,
        (select count(*) from added_time where p1.pass_id = added_time.pass_id) as changes
		FROM passes p1, `students`, `teachers`
        WHERE students.student_id = p1.student_id AND teachers.access_code = p1.teacher";
        $query .= $interval;
        $query .= " Group by p1.`student_id`,start_date, expiry_date "
                . "Order by start_date DESC, expiry_date, `students`.`first_name`, `students`.`last_name`";
      
        $result = $DB2->query($query);
        $passes = array();

        foreach($result->result() as $pass)
        {
            $start_date = new DateTime($pass->start_date);
            $expiry_date = new DateTime($pass->expiry_date);
            $passes[] = array('pass' => $pass->pass,'area' => $pass->area,
                            's_FN' => $pass->s_FN,'s_LN' => $pass->s_LN,
                            'start_date' => $start_date->format('Y-m-d H:i:s'),
                            'expiry_date' => $expiry_date->format('Y-m-d H:i:s'),
                            't_FN' => $pass->t_FN,'t_LN' => $pass->t_LN,
                            'count' => $pass->count,'changes' => $pass->changes,
                            'R' => $pass->Revoked);
        }
        
        return $passes;
    }
    
    public function getStudents($studentID = 0)
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        $query = "SELECT first_name, last_name, student_id from students";
        if($studentID > 0)
        {
            $query .= " WHERE student_id = $studentID";
        }
      
        $result = $DB2->query($query);
        $students = array();

        foreach($result->result() as $student)
        {
            $students[] = array('first_name' => $student->first_name,
                                'last_name' => $student->last_name,
                                'id' => $student->student_id);
        }
        
        return $students;
    }
    
    /**
     * Sends teacher details to user requesting code for confirmation on authentication.
     * 
     * @param type $code
     * @return type
     */
    public function checkCode($code, $user)
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        $query_string = "SELECT * FROM `teachers` WHERE access_code = ? AND user = ?";
        //$query = $this->db->query("SELECT * FROM `teachers` WHERE access_code = $code");
        $query = $DB2->query($query_string, array($code, $user));
        $name = "";
        $details = $query->result();
        foreach($query->result() as $teacher)
        {
            $name = $teacher->first_name . " " . $teacher->last_name;
        }
        return $details;
        //echo $name;
        //echo json_encode($details);
    }
    
    /**
     * Revoke pass
     * 
     * @param type $pass_id
     */
    public function revokePass($pass_id)
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        $data = array('Revoked' => 'Y');
        $where = "`passes`.`pass_id` = $pass_id";

        $result = $DB2->update('passes', $data, $where); 
        //$result = $this->db->query($query);
        return $result;
    }
    
    public function getPassChanges($pass_id)
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        $query_string = "SELECT `students`.`first_name` as s_fn,`students`.`last_name` as s_ln, `teachers`.`first_name` as t_fn,`teachers`.`last_name` as t_ln, `added_time`.`teacher`, `expiry`, `notes`, `expiry_date` "
                . "from `added_time`, `passes`, `students`, `teachers` "
                . "WHERE `passes`.`pass_id` = `added_time`.`pass_id` AND `added_time`.`teacher` = `teachers`.`access_code` AND `students`.`student_id` = `passes`.`student_id` AND `added_time`.`pass_id` = ?";
        
        $query = $DB2->query($query_string, array($pass_id));

        $details = $query->result();
        
        $passChanges = array();
        
        foreach($query->result() as $pass)
        {
            $passChanges = array('s_fn' => $pass->s_fn, 's_ln' => $pass->s_ln);
        }

        foreach($query->result() as $pass)
        {
            $passChanges[] = array('expiry' => $pass->expiry,
                                    'notes' => $pass->notes,
                            'expiry_date' => $pass->expiry_date,
                            't_fn' => $pass->t_fn, 't_ln' => $pass->t_ln);
        }
        
        return $passChanges;
    }
    
    public function not_needed($pass_id)
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        $datetime = new DateTime();
        
        $data = array('not_needed' => $datetime->format('Y-m-d H:i:s'));
        $where = "`passes`.`pass_id` = $pass_id";

        $result = $DB2->update('passes', $data, $where); 
        //$result = $this->db->query($query);
        return $result;
    }
    
    /**
     * Authentication for login system
     * 
     * @param type $username
     * @param type $password
     * @return int
     */
    public function authentication_student($username)
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        $query_string = "SELECT password, student_id from `students` WHERE `username` = ?";
        
        $query = $DB2->query($query_string, array($username));

        foreach($query->result() as $pass)
        {
            return array($pass->password, $pass->student_id);
        }
    }
    
    public function authentication_staff($user)
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        $query_string = "SELECT password, id, user from `teachers` WHERE `user` = ?";
        
        $query = $DB2->query($query_string, array($user));

        foreach($query->result() as $pass)
        {
            return array($pass->password, $pass->id);
        }
    }
    
    public function createStudent($data)
    {
        $DB2 = $this->load->database('hall_pass', TRUE);
        
        /*$pass = array('student_id' => $data['student_id'],
                            'start_date' => $start_date->format('Y-m-d H:i:s'),
                            'expiry_date' => $expiry_date->format('Y-m-d H:i:s'),
                            'area' => $data['area'],
                            'teacher' => $data['teacher']);
         * 
         */
        
        if($DB2->insert('students', $data))
        {
            return true;
        }
        
        //return number of passes for analysis
        //return $num_passes;
    }
}
