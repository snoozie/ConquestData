<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div id="outer" style='padding: 0px 0px;'>
    <div style="width: auto; width: 400px; margin: 0 auto; padding-bottom: 4px;">
        <h3 style="border: 0;">Track time spent on your project!</h3>
    </div>
    <div style="width: auto;">
        <form id="user_login" method="post" action="login" style="width: 370px; margin: 0 auto;">	 
            <div style="clear: both;">
                <div style="padding: 10px 0; width: 100px; float: left;"><label for="username">Username: </label></div>
                <div style="width: 270px; float: right; padding: 5px 0;">
                    <input type="text" id="username" name="username" class="form-control" placeholder="User" />
                </div>
            </div>

            <div style="clear: both;">
                <div style="padding: 10px 0; width: 100px; float: left;"><label for="password">Password: </label></div>
                <div style="width: 270px; float: right; padding: 5px 0;">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password"  />
                </div>
            </div>
            <div id="error">
            </div>
            <div class="clear"></div>
            <div style="float: right; padding: 5px 0;">
                <button type='button' style="float: right;" class='btn btn-lg btn-default' id='login'>Login</button>
            </div>
        </form>
    </div>
</div>