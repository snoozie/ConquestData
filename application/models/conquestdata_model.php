<?php 
use \DateTime;

/*
 * Resume model
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

class conquestdata_model extends CI_Model{

    /**
     * call the parent construct
     */
    public function __construct(){
            parent::__construct();
            
            date_default_timezone_set('Australia/Melbourne');
    }
    
    public function sendEmail($from, $subject, $enquiry)
    {
        $DB1 = $this->load->database('conquest_data', TRUE);
        $date = date('Y-m-d H:i:s');
        $email = array('email' => $from,
                        'subject' => $subject,
                            'enquiry' => $enquiry,
                            'date' => $date);
        
        if($DB1->insert('emails', $email))
        {
            //send email to me for notification
            return true;
        }
    }
    
    public function getTasks($project_id)
    {
        $DB1 = $this->load->database('conquest_data', TRUE);
 
        $query_string = "SELECT * FROM `tasks` WHERE project = ?";
        $query = $DB1->query($query_string, array($project_id)); 
        
        return $query->result();
    }
    
    public function getProjects($client_id)
    {
        $DB1 = $this->load->database('conquest_data', TRUE);
 
        $query_string = "SELECT * FROM `projects` WHERE client = ?";
        $query = $DB1->query($query_string, array($client_id)); 
        
        return $query->result();
    }
    
    public function getProjectsTasks()
    {
        $DB1 = $this->load->database('default', TRUE);
 
        $query_string = "SELECT *, time_to_sec(timediff(end, start)) / 3600 as hours FROM `projects`, `tasks` WHERE `tasks`.`project` = `projects`.`id` order by start desc, end desc";
        $query = $DB1->query($query_string); 
        
        return $query->result();
    }
    
    public function getAllProjects()
    {
        $DB1 = $this->load->database('default', TRUE);
 
        $query_string = "SELECT * FROM `projects`";
        $query = $DB1->query($query_string); 
        
        return $query->result();
    }
    
    public function addTimeToProject($time)
    {
        $DB1 = $this->load->database('default', TRUE);
        
        $date = date('Y-m-d');
        
        $time['start'] = $date . " " .$time['start'];
        
        $time['end'] = $date . " " .$time['end'];
        
        if($DB1->insert('tasks', $time))
        {
            //send email to me for notification
            return true;
        }
    }
    
    public function authentication_user($user)
    {
        $DB1 = $this->load->database('default', TRUE);
        
        $query_string = "SELECT password, id, username from `user` WHERE `username` = ?";
        
        $query = $DB1->query($query_string, array($user));

        foreach($query->result() as $pass)
        {
            return array($pass->password, $pass->id);
        }
    }
}
