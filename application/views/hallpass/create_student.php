<?php
/*
 * Current Hall Pass
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

/*
 * Add Student
 */

if($_SERVER['REQUEST_URI'] == "/conquestdata/index.php/addStudent")
{
?>
<!-- Reload javascript to reattach elements -->
<script type="text/javascript" src="<?php echo base_url();?>js/hallpass/javascript.js"></script>
<?php 
}
?>
<h3>Add a Student</h3>
</div>
<div style="border: 3px solid #95A3E0; border-radius: 6px;">
    <form id="create_student" method="post" action="createStudent">	 
        <input type="hidden" id="device" name="device" class="form-control" value="website" />
        <div class="form_row">
            <div class="left"><label for="first_name">First Name: </label></div>
            <div class="right">
                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name"  />
            </div>
        </div>
        <div class="form_row">
            <div class="left"><label for="last_name">Last Name: </label></div>
            <div class="right">
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name"  />
            </div>
        </div>
        <div class="form_row">
            <div class="left"><label for="dob">Date Of Birth: </label></div>
            <div class="right">
                <input type="text" id="dob" name="dob" class="form-control" placeholder="dd/mm/yy"  />
            </div>
        </div>
        <div class="form_row">
            <div class="left"><label for="username">Username: </label></div>
            <div class="right">
                <input type="text" id="user" name="user" class="form-control" placeholder="User"  />
            </div>
        </div>
        <div class="form_row">
            <div class="left"><label for="password">Password: </label></div>
            <div class="right">
                <input type="password" id="password" name="password" class="form-control" />
            </div>
        </div>
        <div class="form_row">
            <div class="left"><label for="password_verify">Retype Password: </label></div>
            <div class="right">
                <input type="password" id="password_verify" name="password_verify" class="form-control" />
            </div>
        </div>
    
        <div id="error">
        </div>
        <div class="clear"></div>
        <div style="float: right; padding: 4px 0;">
            <button class='btn btn-md btn-default' id='add_student'>Submit</button>
        </div>
    </form>
</div>


