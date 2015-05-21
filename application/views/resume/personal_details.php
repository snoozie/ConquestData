<?php

/*
 * Personal Details - sub view for personal details section
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

/*
 * Display personal details
 */
foreach($personal_details as $d)
{
    print "<span style='font-size: 25pt;'>".$d->name."</span></br>";
    print "<span style='padding: 4px;'>".$d->address."</span></br>";
    print "<span>Phone: ".$d->phone."</span></br>";
    print "<span>Email: ".$d->email."</span></br>";
}

?>
