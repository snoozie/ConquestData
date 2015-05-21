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
<script type="text/javascript" src="<?php echo base_url();?>js/hallpass/javascript.js"></script>
<script>
    // Changing button colour
    $('#students_button').css({"background-image": "linear-gradient(to bottom, #FFF 0%, #E0E0E0 100%)"});
    $('#students_button').css({"background-color": ""});
    
    $('#all_passes_button').css({"background-image": "none"});
    $('#all_passes_button').css({"background-color": "#95A3E0"});
    
    var string = "";
    string = "<?=$range;?>";
    var str = string.toLowerCase();
    showPass(str);
</script>
<!-- Top button navigation -->
<div style='padding-bottom: 10px;'>
    <span class='heading'>Passes - <?= $range;?></span>
    <div style="float: right; margin: 0 0 10px 10px;">

    <button class='btn btn-lg btn-default' id='today' onclick='$("#load").load("/index.php/staff/today");'>Today</button>
    <button class='btn btn-lg btn-default' id='week' onclick='$("#load").load("/index.php/staff/week");'>This Week</button>
    <button class='btn btn-lg btn-default' id='month' onclick='$("#load").load("/index.php/staff/month");'>This Month</button>
    <button class='btn btn-lg btn-default' id='year' onclick='$("#load").load("/index.php/staff/year");'>This Year</button>
    <button class='btn btn-lg btn-default' id='all' onclick='$("#load").load("/index.php/staff");'>All</button>
    <div style="margin: 4px 0 4px 4px; float: right; padding: 4px 0 4px 4px;">
        <div class="left" style="width: 60px;"><label for="search">Search: </label></div>
                <div style="float: right;">
                    <!--<input type="text" id="area" name="notes" class="form-control" placeholder="Notes" />-->
                    <input type="text" id="search" name="nearch" class="form-control" placeholder="Search"  />
                </div>
        </div>
    </div>
</div>
<?php

if(!empty($current_pass)) 
{
    print "<div class='personal_details' id='table'>";
	?> 
<!-- Top headings with sorting features -->
	<div class="table_heading s_header header">
        <div style="width: 24%;">Student 
            <br/>
            <span style="font-weight: 400;">First Name 
            <button id="sort_sfn_asc" class='btn btn-xs btn-default'>&uarr;</button>
            <button id="sort_sfn_desc" class='btn btn-xs btn-default'>&darr;</button>
            | Last Name
            <button id="sort_sln_asc" class='btn btn-xs btn-default'>&uarr;</button>
            <button id="sort_sln_desc" class='btn btn-xs btn-default'>&darr;</button>
            </span>
        </div>
        <div style="width: 33%;">Pass
            <br/>
            <span style="font-weight: 400;">Date | Minutes
            <button id="sort_date_asc" class='btn btn-xs btn-default'>&uarr;</button>
            <button id="sort_date_desc" class='btn btn-xs btn-default'>&darr;</button>
            </span>
        </div>
        <div style="width: 16%;">Area</div>
        <div style="width: 24%;">Teacher
            <br/>
            <span style="font-weight: 400;">First Name 
            <button id="sort_tfn_asc" class='btn btn-xs btn-default'>&uarr;</button>
            <button id="sort_tfn_desc" class='btn btn-xs btn-default'>&darr;</button>
            | Last Name
            <button id="sort_tln_asc" class='btn btn-xs btn-default'>&uarr;</button>
            <button id="sort_tln_desc" class='btn btn-xs btn-default'>&darr;</button>
        </div>
        <div div style="width: 3%;"></div>    
    </div>

	<?php
	print "<div id='sorting'>";
    foreach($current_pass as $d)
	{ 
        $time_diff = time_diff($d['start_date'], $d['expiry_date']);
        
        if(strtotime($d['expiry_date']) > strtotime(date("Y-m-d H:i:s")))
        {
    ?>    
    <div id="item" style="clear: both; height: 35px;" class="s_header header item" sfname="<?=$d['s_FN'];?>" slname="<?=$d['s_LN'];?>" area="<?=$d['area'];?>" date="<?=strtotime($d['expiry_date']);?>" tfname="<?=$d['t_FN'];?>" tlname="<?=$d['t_LN'];?>">    
        <?php }else{ ?>
        <div id="item" style="clear: both; height: 35px; color: #7B7B8A;" class="s_header header item" sfname="<?=$d['s_FN'];?>" slname="<?=$d['s_LN'];?>" area="<?=$d['area'];?>" date="<?=strtotime($d['expiry_date']);?>" tfname="<?=$d['t_FN'];?>" tlname="<?=$d['t_LN'];?>">
        <?php } ?>
        <div style="width:0px; margin: 0; padding: 0;"><input type="hidden" id="pass_id" value="<?php print $d['pass']; ?>"/></div>
        
        <div style='background-color: #DEDFE3; width: 24%;'><?php print $d['s_FN']." ".$d['s_LN']; ?></div>
		<div style='background-color: #DEDFE3; width: 33%;'>
            <?php print date('d/m/Y H:i:s', strtotime($d['expiry_date'])) . " ". $time_diff->h . " hours " . $time_diff->i . " min"; ?>
            
            <!-- Indicator button for change of record -->
        
            <?php if($d['changes'] > 0){ ?>
            <!--<button id="changePass" class='btn btn-xs btn-default' data-fancybox-type='iframe' href='/hall_pass/index.php/passChanges/<?php print $d['pass']; ?>'>C</button>-->
            <a class='btn btn-xs btn-default' data-toggle="modal" onmouseover="change('#myModal','/conquestdata/index.php/passChanges/<?php print $d['pass']; ?>', '<?php print date('d/m/Y H:i:s', strtotime($d['expiry_date']))?>', '<?php print $d['s_FN']." ".$d['s_LN']; ?>');" data-target="#myModal" >C</a>
            <?php } ?>
            
            <!-- Indicator button for more than 5 passes in a day -->
                
            <?php if($d['count'] > 5){?>
            <button class='btn btn-xs' style='color: #150D26; background-color: #9E9BD1; cursor: default;' title='More than 5 passes'>!</button>
            <?php } ?>
            <?php if($d['R'] == 'Y'){?>
            <button class='btn btn-xs btn-default'>R</button>
            <?php } ?>
        </div>
        <div style='background-color: #DEDFE3; width: 16%;' title="<?php print $d['area']; ?>"><?php print $d['area']; ?></div>
		<div style='background-color: #DEDFE3; width: 24%;'><?php print $d['t_FN']." ".$d['t_LN']; ?></div>
		<div style='background-color: #8C709B; width: 3%;'>
            <a id='revoke' title='Revoke Pass' href='#' class='btn btn-xs btn-default' onclick="revoke(<?php print $d['pass']; ?>);">X</a>

            <!--a class="btn btn-xs btn-default" data-toggle="modal" data-target="#basicModal"  onmouseover="change('#basicModal', '/conquestdata/index.php/changePass/<?php print $d['pass']; ?>', '<?php print date('d/m/Y H:i:s', strtotime($d['expiry_date']))?>', '<?php print $d['s_FN']." ".$d['s_LN']; ?>');">+ Time</a>-->
        </div>
    
    </div>
		<?php
	}
	print "</div></div>";
}
else
{
	print "<div>";
	print "<span style='font-size: 25pt;'>No Passes</span>";
	print "<span style='font-size: 25pt;'><hr /></span>";
	print "</div>";
	print "<div>";

	print "</div>";
}

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

<div class="modal fade" style="" href='' id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Change Pass Issued at <span class='time_text'></span> for <span class='student_text'></span></h4>

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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" href='' role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Changes for Pass Issued at <span class='time_text'></span> for <span class='student_text'></span></h4>

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

