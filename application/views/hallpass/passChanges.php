
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
print "<div class='personal_details'>";

if(!empty($pass_changes)) 
{

    print "<div style='font-weight: 600; font-size: 20px; text-align: center; background: none repeat scroll 0% 0% #3D84A5;'>".$pass_changes['s_fn']." ".$pass_changes['s_ln']."</div>";

    ?>
	<div class="table_heading pop_header header"><div>Pass</div><div>Notes</div><div>teacher</div></div>
	<?php
    
	for($i = 0; $i < count($pass_changes) - 2; $i++)
	{ 
        print "<div class='header pop_header item'>";

        $time_diff = time_diff($pass_changes[$i]['expiry_date'], $pass_changes[$i]['expiry']);
    ?>    
		<div style='background-color: #CBCBF8; ' class="header item pop_header">
            <?php print date('H:i:s', strtotime($pass_changes[$i]['expiry_date'])) . " ". $time_diff->h . " hours " . $time_diff->i . " min"; ?>
            
        </div>
    
        <div style='background-color: #B4A3E3;' class="header item">
            <?php print $pass_changes[$i]['notes']; ?> &nbsp;
            <hr style="background-color: #AA6FC5; height: 1px; margin: 0px; margin-top: 10px; border: 0px;"/>
        </div>
        <div style='background-color: #B4A3E3;' class="header item">
            <?php print $pass_changes[$i]['t_fn'] . " " . $pass_changes[$i]['t_ln']; ?> &nbsp;
            <hr style="background-color: #AA6FC5; height: 1px; margin: 0px; margin-top: 10px; border: 0px;"/>
        </div>
    </div>
		<?php
	}
	
}
print "</div>";

function datesToMinutes($start, $end)
{
    /**
    * Working out minutes for pass
    */

    $ts1 = strtotime($start);
    $ts2 = strtotime($end);

    $minutes_diff = ($ts2 - $ts1) / 60;
    
    return $minutes_diff;
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
