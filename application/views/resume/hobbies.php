<?php

/*
 * Hobbies - sub view for hobbies section
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

print "<h3>Hobbies/Interests</h3>";

/*
 * Display list of hobbies
 */
print "<ul>";

foreach($hobbies as $d)
{
    print "<li>".$d->hobby."</li>";
}

print "</ul>";

?>