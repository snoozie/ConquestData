<?php
/*
 * Current Hall Pass
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

/*
 * Give New Pass
 */

$id = "0";
$first_name = "";
$last_name = "";

if($this->uri->segment(2) != "")
{
    //$id = $this->input->get('id');
    $id = $this->uri->segment(2);
}

if(!empty($student_details))
{
    foreach($student_details as $student)
    {
        $first_name = $student['first_name'];
        $last_name = $student['last_name'];
    }
}

if($_SERVER['REQUEST_URI'] == "/index.php/givepass_popup/".$id)
{
?>
<!-- Reload javascript to reattach elements -->
<script type="text/javascript" src="<?php echo base_url();?>js/hallpass/javascript.js"></script>

<h3>Give Pass to <?=$first_name." ".$last_name;?></h3>
<?php 
}
else
{
?>

<script>
    /*$(function() {
        $('#expiry').spinner({
            min: 2,
            max: 20,
            step: 2
        });
        
        $('#expiry').mousewheel(function(event, delta) {
            loghandle(event, delta);
            return false; // prevent default
        });
    });*/
    
</script>
<h3>Give Pass</h3>
<?php
}
?>
<!--<script>
    $(document).ready(function () {
        var selectBox = document.getElementById("area_option");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        $('#area').val(selectedValue);

        $('#area_option').on('change', function(){
            var selectBox = document.getElementById("area_option");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            $('#area').val(selectedValue);
        });
    });
</script>-->

<?php
$warning = $this->session->userdata('warning');
if ($warning == "Passes")
{
    $this->session->unset_userdata('warning');
    ?>
    <div class="alert alert-warning" style="width: 100%;/*newly added*/" role="alert">
        <p style="position: relative; margin-left: 45%;">More than 5 passes</p>
    <?php
}

?>
</div>
<div style="border: 3px solid #95A3E0; border-radius: 6px;">
    <form id="<?php if($_SERVER['REQUEST_URI'] == "/index.php/givepass_popup/".$id){ echo "form_popup";}else{echo "send_pass";}?>" method="post" action="sendPass/<?= $id; ?>">	 
        <input type="hidden" id="device" name="device" class="form-control" value="website" />
        <div class="form_row">
            <div class="left"><label for="expiry">Time : </label></div>
            <div class="right">
                <input type="number" id="expiry" style="width: 130px; display: inline;" name="expiry" value="0" class="form-control" placeholder="Expiry" />
                
                <!--<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>-->
                <span>minutes</span>
                <!--<button style="margin-right: 2px;" type="button" class='btn btn-sml btn-default' onclick="$('#expiry').val('0');">Clear</button>-->
            </div>
        </div>
        <div class="form_row">
            <input type="range" step="1" min="0" max="100" id="range" style="" name="range" class="form-control"/>
        </div>
    
        <div class="form_row">
            <div class="left">
                <label for="area">Area: </label>

            </div>
            <div class="right">
                <button type="button" class='btn btn-xl add_button area_colour' id='area_library' onclick='press_area("library");'>Library</button>
                <button type="button" class='btn btn-xl add_button area_colour' id='area_locker' onclick='press_area("locker");'>Locker</button>
                <button type="button" class='btn btn-xl add_button area_colour' id='area_sickbay' onclick='press_area("sickbay");'>Sickbay</button>
                <button type="button" class='btn btn-xl add_button area_colour' id='area_other' onclick='press_area("other");'>Other</button>
                <!--<select class="form-control" id="area_option">
                    <option>Library</option>
                    <option>Locker</option>
                    <option>Sickbay</option>
                    <option>Toilet</option>
                    <option>Other</option>
                </select>-->
                <input type="text" id="array_area" name="array_area" class="form-control" placeholder="Area" />
                <input type="text" id="text_area" name="text_area" class="form-control" placeholder="Area" />
                <input type="text" id="area" name="area" class="form-control" placeholder="Area" />
            </div>
        </div>
        <div class="form_row" id="teacher">
            <div class="left"><label for="access_code">Staff Username: </label></div>
            <div class="right" id="access">
                <input type="text" inputmode="numeric" id="user" name="user" class="form-control" placeholder="User"  />
            </div>
        </div>
        <div class="form_row" id="teacher">
            <div class="left"><label for="access_code">Staff Code: </label></div>
            <div class="right" id="access">
                <input type="number" pattern="[0-9]*" inputmode="numeric" id="access_code" name="access_code" class="form-control" placeholder="Access Code"  />
            </div>

        </div>
        <div id="error">
        </div>
        <div class="clear"></div>
        <div>
            <button class='btn btn-lg btn-default' id='send_pass'>Send Pass</button>
        </div>
        <div>
            <span id="calculated_time"></span>
        </div>
    </form>
</div>


