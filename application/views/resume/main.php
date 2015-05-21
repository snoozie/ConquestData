<?php
/*
 * Main - The main page that calls the different views
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

$personal_details = $personal_details;
$objectives = $objectives;
$skills = $skills;
$education = $education;
$experience = $experience;
$hobbies = $hobbies;
$references = $references;

?>
<div class="personal_details">
    <div style="float: left; width: 40%; padding: 20px;">
        <img src="<?php echo base_url();?>/images/photo.jpg" style="height: 120px;"></img>
    </div>
    <div style="float: right; width: 50%; padding-top: 20px; text-align: right;">
        <?php $this->load->view('resume/personal_details', $personal_details); ?>
    </div>
</div>

<?php

$this->load->view('resume/objectives', $objectives);
$this->load->view('resume/skills', $skills);
$this->load->view('resume/education', $education);
$this->load->view('resume/experience', $experience);
$this->load->view('resume/hobbies', $hobbies);
$this->load->view('resume/references', $references); 
