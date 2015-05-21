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
?>


<?php

if(!empty($current_pass)) 
{
	?>
    <script>
        refresh();
    </script>
<?php
    
    foreach($current_pass as $d)
	{
		$var = $d->expiry_date;
        print "<input type='hidden' value='$d->student_id' id='student_id'/>";
        print "<input type='hidden' value='$d->pass_id' id='pass_id'/>";
        print "<div>";
		print "<span style='font-size: 25pt;'>Current Pass</span>";
		print "<span style='font-size: 25pt;'><hr /></span>";

        print "<div style='font-size: 25pt;'><span>Timer: </span><span id='timer'></span></div>";
        print "<div style='font-size: 25pt;'>Pass for " .$d->area ."<br/>Issued by " . $d->first_name. " ".$d->last_name. "</div>";
		print "</div>";
        ?>
        <div>
            <button type="button" id="not_needed">Pass Not Needed</button>
        </div>
<script type="text/javascript">
        time = <?php echo json_encode($var); ?>;
        </script>
        <?php
	}
}
else
{
	print "<div>";
	print "<span style='font-size: 25pt;'>No Passes</span>";
	print "<span style='font-size: 25pt;'><hr /></span>";
	print "</div>";
	print "<div>";

	print "<a id='give_pass' data-fancybox-type='iframe' href='/conquestdata/index.php/givepass' class='various btn btn-lg btn-default'>Give Pass</a>";
	print "</div>";
}
?>
        

