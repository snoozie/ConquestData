<?php

/*
 * Objectives - sub view for objectives section
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

print "<h3>Objectives</h3>";

$count = 0;

/*
 * Create new points array to show objectives list
 */
$points = array();
foreach($objectives as $d)
{
    if($count == 0)
    {
        echo "<p>".$d->objective."</p>";
    }
    else
    {
        $points[] = $d->objective;
    }

    $count++;
}

/*
 * Display objectives list
 */
print "<ul>";
foreach($points as $p)
{
    print "<li>".$p."</li>";
}
print "</ul>";

?>