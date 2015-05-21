<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<style>

</style>
<div style="float: left; width: 10%; height: 100%; clear: both;">
    <button id="all_passes_button" type="button" class="btn btn-default" style="width: 100%;" onclick="$('#load').load('/index.php/staff');">All Passes</button>
    <button id="students_button" type="button" class="btn btn-default" style="width: 100%;" onclick="$('#load').load('/index.php/students');">Students</button>
</div>
<div style="float: right; width: 90%; padding-left: 4px; background-color: #D5C9E1; display: block;" id="load"></div>