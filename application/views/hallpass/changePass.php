<?php
/*
 * Current Hall Pass
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

/*
 * Change Pass
 */
?>
<!-- Reload javascript to reattach elements -->
<script type="text/javascript" src="<?php echo base_url();?>js/javascript.js"></script>
<?php

if($this->uri->segment(2) == true)
{    $pass_id = $this->uri->segment(2);
}

?>

<div id="panel" style="border: 1px solid blue; margin: 8px; padding: 8px; border-radius: 6px; height: auto;">
    <!--<div style="background-color: rgb(200, 201, 218); width: 100%; height: 40px;">
        <span style="font-weight: 600; font-size: 30px;">Change Pass</span>
    </div>-->
    <hr style="height: 2px; background-color: rgb(93, 119, 149); width: 100%; margin: 0px 0px 4px; padding: 0px;">
    <form id="form_popup" method="post" action="/hall_pass/index.php/addTime">
        <input type="hidden" id="pass_id" name="pass_id" class="form-control" value="<?= $pass_id; ?>" />
        <input type="hidden" id="device" name="device" class="form-control" value="website" />
        <input type="hidden" id="pass_expiry" name="pass_expiry" class="form-control" value="website" />
        <div class="form_row">
            <div class="left"><label for="expiry">Expiry Time: </label></div>
            <div class="input-group date" id='datetimepicker1'>
                <input type="text" id="expiry" name="time" class="form-control" placeholder="Expiry" />
                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
            </div>
        </div>
        <!--
        <div class="form_row">
            <div class="left"><label for="area">Area: </label></div>
            <div class="right">
                <input type="text" id="area" name="area" class="form-control" placeholder="Area" />
            </div>
        </div>
        -->

        <div class="form_row">
            <div class="left"><label for="notes">Notes: </label></div>
            <div class="right">
                <!--<input type="text" id="area" name="notes" class="form-control" placeholder="Notes" />-->
                <textarea class="form-control" name="notes" rows="5" id="notes"></textarea>
            </div>
        </div>

        <div class="form_row" id="teacher">
            <div class="left"><label for="access_code">Teacher Access Code: </label></div>
            <div class="right" id="access">
                <input type="password" id="access_code" name="access_code" class="form-control" placeholder="Access Code"  />
            </div>

        </div>
        <div id="error">
        </div>
        <div class="clear"></div>
        <div>
            <button class='btn btn-lg btn-default' id='send_pass'>Change Pass</button>
        </div>
    </form>
</div>



