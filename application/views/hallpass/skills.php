<?php

/*
 * Skills - sub view for skills section
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */


print "<h3>Skills</h3>";

/*
 * Display skills table
 */
print "<table>";
foreach($data as $d)
{
    print "<tr>";
    print "<td>".$d->type."</td>";
    print "<td>".$d->skill."</td>";
    print "<tr>";
}
print "</table>";

?>