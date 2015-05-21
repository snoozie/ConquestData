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
//$range = "All";

if($this->uri->segment(2) == true)
{    
    //$range = $this->uri->segment(2);
}
$first_name = "";
$last_name = "";
foreach($all as $a)
{
    $first_name = $a['s_FN'];
    $last_name = $a['s_LN'];
    
    break;
}
?>

<script>
    $('#all_passes').hide();
    $('#year_passes').hide();
    $('#month_passes').hide();
    $('#week_passes').hide();
    $('#today_passes').hide();
    
    showPasses('<?= $range; ?>');
    //showPasses("today");
</script>
<!-- Top button navigation -->
<div style='padding-bottom: 10px;'>
    <span class='heading'>Passes - <?= $first_name. " " .$last_name;?></span>
    <div style="float: right; margin: 0 0 10px 10px;">

    <button class='btn btn-lg btn-default' id='today' onclick='showPasses("today");'>Today</button>
    <button class='btn btn-lg btn-default' id='week' onclick='showPasses("week");'>This Week</button>
    <button class='btn btn-lg btn-default' id='month' onclick='showPasses("month");'>This Month</button>
    <button class='btn btn-lg btn-default' id='year' onclick='showPasses("year");'>This Year</button>
    <button class='btn btn-lg btn-default' id='all' onclick='showPasses("all");'>All</button>

    </div>
</div>
<?php

if(!empty($all)) 
{
	?> 
    <div class='personal_details' id='table'>
<!-- Top headings with sorting features -->
	<div class="table_heading s_header header">
        <div style="width: 30%;">Pass
            <br/>
            <span style="font-weight: 400;">Date | Minutes
                <button id="sort_date_desc"  class='btn btn-xs btn-default'>&uarr;</button>
            <button id="sort_date_asc"  class='btn btn-xs btn-default'>&darr;</button>
            </span>
        </div>
        <div style="width: 30%;">Area</div>
        <div style="width: 40%;">Teacher
            <br/>
            <span style="font-weight: 400;">First Name 
            <button id="sort_tfn_desc" class='btn btn-xs btn-default'>&uarr;</button>
            <button id="sort_tfn_asc" class='btn btn-xs btn-default'>&darr;</button>
            | Last Name
            <button id="sort_tln_asc" class='btn btn-xs btn-default'>&uarr;</button>
            <button id="sort_tln_asc" class='btn btn-xs btn-default'>&darr;</button>
        </div>  
    </div>

	<!-- All Passes -->
    <?php
    // Passes tabs
    tab($all, 'all');
    
    tab($year, 'year');
    
    tab($month, 'month');

    tab($week, 'week');
    
    tab($today, 'today');
    ?>
	
    </div>
<?php
}
else
{
	?>
    <div>
	<span style='font-size: 25pt;'>No Passes</span>
	<span style='font-size: 25pt;'><hr /></span>
	</div>
	<div>

	<a id='give_pass' data-fancybox-type='iframe' href='?page=GP' class='various btn btn-lg btn-default'>Give Pass</a>
	</div>
    <?php
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

function tab($data, $type)
{
?>
	<div id='<?=$type;?>_passes' class='sorting'>
    <?php
    foreach($data as $d)
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
       
		<div style='background-color: #B4A3E3; width: 39%;'>
            <?php print date('d/m/Y H:i:s', strtotime($d['expiry_date'])) . " ". $time_diff->h . " hours " . $time_diff->i . " min"; ?>
            
            <?php if($d['R'] == 'Y'){?>
            <button class='btn btn-xs btn-default'>R</button>
            <?php } ?>
        </div>
		<div style='background-color: #CBCBF8; width: 25%;'><?php print $d['area']; ?></div>
		<div style='background-color: #B4A3E3; width: 36%;'><?php print $d['t_FN']." ".$d['t_LN']; ?></div>
    
    </div>
		<?php
	} ?>
	
    </div>
<?php
}
?>


