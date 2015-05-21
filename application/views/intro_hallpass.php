<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div style="font-size: .7em;">
    <div style="width: 770px; float: left;">
        <div style="width: 70px; float: left; height: auto;">
            <img alt='hall pass logo' src="<?= "http://".$_SERVER["HTTP_HOST"];?>/images/HallPass_logo.png" style="width: 60px;"/>
        </div>
        <div style="width: 250px; float: left;">
            <h1 style="margin: 12px 0px 0px;">Hall Pass</h1>
        </div>
    </div>
    
    <div style="float: left; width: 720px;">
        <p> Hall Pass is a new way to keep track of passes handed out to school students. Centralised to a school,
            a staff member can login to view which student has been given a pass and for how long. </p>
        <p>Students can also use their smartphone to check how much time they have left before they are due back in class.</p>
        <p>This website has been created using HTML5, CSS3, JQuery and MySQL.</p>
    </div>
    <div id="image" style="float: left; padding-right: 2px;">
        <img src="<?= "http://".$_SERVER["HTTP_HOST"];?>/images/hallpass_screenie_staff.png" alt="hall pass staff screenshot" style="width: 750px; border: 1px solid #95A3E0;"/>
        <div class="caption">Staff Page</div>
    </div>
    <div id="image" style="clear: right; width: 170px;">
        <img src="<?= "http://".$_SERVER["HTTP_HOST"];?>/images/hallpass_screenie_student.png" alt="hall pass student screenshot" style="width: 170px; border: 1px solid #95A3E0;"/>
        <div style="width: 170px; float: right;" class="caption">Student Page</div>
    </div>
    
    <div style="clear: left; width: 750px;">
        <p>Visit the <a href="staffView" target="_blank">admin</a> page to take a test drive.</p>
        <p>Visit the <a href="hallpass">student</a> page on your mobile to try the pass.</p>
        <p>Mobile versions for the student page will be available soon.</p>
    </div>
    
</div>

