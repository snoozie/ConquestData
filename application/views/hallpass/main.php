<?php
/*
 * Main - The main page that calls the different views
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */
?>
<?php

if(!empty($current_pass))
{
$data['current_pass'] = $current_pass;
    ?>

<div class="personal_details">
	<div style="">
		<?php $this->load->view('hallpass/current_pass', $data); ?>
	</div>
</div>

<?php
}
else
{
    ?>
<div class="personal_details">
	<div style="">
		<?php $this->load->view('hallpass/current_pass'); ?>
	</div>
</div>
<?php
}