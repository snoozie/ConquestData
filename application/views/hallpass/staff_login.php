<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<form id="staff_login" method="post" action="login">	 
    <input type="hidden" name="type" id="type" value="staff"/>
    <div class="form_row">
        <div class="left"><label for="area">Username: </label></div>
        <div class="right">
            <input type="text" id="username" name="username" class="form-control" placeholder="User" />
        </div>
    </div>

    <div class="form_row" id="teacher">
        <div class="left"><label for="access_code">Password: </label></div>
        <div class="right" id="access">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password"  />
        </div>
    </div>
    <div id="error">
    </div>
    <div class="clear"></div>
    <div class="form_row">
        <button type='button' style="float: right;" class='btn btn-lg btn-default' id='login'>Login</button>
    </div>
</form>