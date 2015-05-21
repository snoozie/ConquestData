<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<form id="student_login" method="post" action="login">	 
    <input type="hidden" name="type" id="type" value="student"/>
    <div class="form_row">
        <!--<div class="left"><label for="username">User Name: </label></div>-->
        <div class="login_right">
            <input type="text" id="username" name="username" class="form-control" placeholder="User Name" />
        </div>
    </div>

    <div class="form_row" id="teacher">
        <!--<div class="left"><label for="password">Password: </label></div>-->
        <div class="login_right" id="access">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password"  />
        </div>
    </div>
    <div id="error">
    </div>
    <div class="clear"></div>
    <div>
        <button class='btn btn-lg btn-default' type="button" id='login'>Login</button>
    </div>
</form>