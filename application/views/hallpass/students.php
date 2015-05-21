<?php

/*
 * Current Hall Pass
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

/*
 * Display hall pass
 */
$range = "All";

if($this->uri->segment(2) == true)
{    $range = $this->uri->segment(2);
}
?>
<script type="text/javascript" src="<?php echo base_url();?>js/javascript.js"></script>
<script>
    // Changing button colour
    $('#all_passes_button').css({"background-image": "linear-gradient(to bottom, #FFF 0%, #E0E0E0 100%)"});
    $('#all_passes_button').css({"background-color": ""});
    
    $('#students_button').css({"background-image": "none"});
    $('#students_button').css({"background-color": "#95A3E0"});
</script>
<!-- Top button navigation -->
<div style='padding-bottom: 10px;'>
    <div style="float: left; height: 2.6em;">
        <span class='heading'>Students</span>
    </div>
    <div style="float: right;">
        <a id='' href='' class='btn btn-default' onclick="" onmouseover="add('#basicModal', '/index.php/addStudent');" data-toggle="modal" data-target="#basicModal">Add A Student</a>
    </div>
    <div style="clear: both;"></div>
</div>
<?php
$first_name = "";
$last_name = "";
if(!empty($current_pass)) 
{
    print "<div class='personal_details' id='table'>";
	?> 
<!-- TOp headings with sorting features -->
	<div class="table_heading s_header header">
        <div style="width: 30%; height: 50px;">First Name 
            <button id="sort_sfn_asc" class='btn btn-xs btn-default'>&uarr;</button>
            <button id="sort_sfn_desc" class='btn btn-xs btn-default'>&darr;</button>
        </div>
        <div style="width: 30%; height: 50px;">Last Name
            <button id="sort_sln_asc" class='btn btn-xs btn-default'>&uarr;</button>
            <button id="sort_sln_desc" class='btn btn-xs btn-default'>&darr;</button>
        </div>
        
        <div div style="width: 40%;"></div>    
    </div>

	<?php
	print "<div id='sorting'>";
    foreach($current_pass as $d)
	{ 
        //$time_diff = time_diff($d['start_date'], $d['expiry_date']);
        $first_name = $d['first_name'];
        $last_name = $d['last_name'];
?> 
    <div id="item" style="clear: both; height: 35px;" class="s_header header item" sfname="<?=$d['first_name'];?>" slname="<?=$d['last_name'];?>">    

        
        <div style='background-color: #DEDFE3; border-bottom: 1px solid #95A3E0; width: 29%; height: 35px;'><?php print $d['first_name']; ?></div>
		<div style='background-color: #DEDFE3; border-bottom: 1px solid #95A3E0; width: 38%; height: 35px;'><?php print $d['last_name']; ?></div>
		<div style='background-color: #DEDFE3; border-bottom: 1px solid #95A3E0; width: 33%; height: 35px;'>
        <!--<div style='background-color: #8C709B; width: 43%; height: 35px;'>-->
            <a id='' href='' class='btn btn-xs staff_button' onclick="" onmouseover="add('#basicModal', '/index.php/givepass_popup/<?=$d['id'];?>');" data-toggle="modal" data-target="#basicModal">Give Pass</a>
            <a id='' href='' class='btn btn-xs staff_button' onclick="" onmouseover="add('#myModal', '/index.php/showPasses/<?=$d['id'];?>/year');" data-toggle="modal" data-target="#myModal">Passes</a>    
            <!--<a class="btn btn-xs btn-default"   onmouseover="">+ Time</a>-->
        </div>
    
    </div>
		<?php
	}
	print "</div></div>";
}
/*else
{
	print "<div>";
	print "<span style='font-size: 25pt;'>No Passes</span>";
	print "<span style='font-size: 25pt;'><hr /></span>";
	print "</div>";
	print "<div>";

	print "<a id='give_pass' data-fancybox-type='iframe' href='?page=GP' class='various btn btn-lg btn-default'>Give Pass</a>";
	print "</div>";
}*/

function time_diff($start, $end)
{
    /**
    * Working out minutes for pass
    */

    $start_date = new DateTime($start);
    $since_start = $start_date->diff(new DateTime($end));
    
    //echo $since_start->h.' hours<br>';
    //echo $since_start->i.' minutes<br>';
    return $since_start;
}
?>

<div class="modal fade" style="" href='/index.php/addStudent' id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog" style="width: 430px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--<h4 class="modal-title">Change Pass Issued at <span class='time_text'></span> for <span class='student_text'></span></h4>-->
            </div>
            <div class="modal-body">
                <div class="te"></div>   
            </div>
            <div class="modal-footer" style="padding: 0;">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" href='' role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 880px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <!--<h4 class="modal-title">Changes for Pass Issued at <span class='time_text'></span> for <span class='student_text'></span></h4>-->

            </div>
            <div class="modal-body"><div class="te"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

