<?php

/*
 * Education - sub view for education section
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

print "<h3>Education</h3>";

/*
 * Insert image depending on education using id from education table
 */

foreach($education as $d)
{
    $image = "";
    $title = "";
    switch($d->id)
    {
        case 1:
            $image = "bachelor_CS_graduation.png";
            $title = "<a class='fancybox' href='". base_url(). "images/$image'><b>".$d->title."</b></a>";
            break;
        case 2:
            $image = "master_Tech_graduation.jpg";
            $title = "<a class='fancybox' href='". base_url(). "images/$image'><b>".$d->title."</b></a>";
            break;
        default:
            $title = "<b>".$d->title."</b>";
            break;
    }

    /*
     * Display education details
     */

    print "<p>".$title." ".date("d/m/Y", strtotime($d->start))." - ".date("d/m/Y", strtotime($d->end))."</p>";
} 

?>
