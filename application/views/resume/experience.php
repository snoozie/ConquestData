<?php

/*
 * Experience - sub view for experience section
 *
 * @author Susan Theron
 * @version 1
 * @date November 3, 2014
 */

print "<h3>Experience</h3>";

/*
 * Display experience details
 */
foreach($experience as $d)
{
    print "<p><b>".$d->title."</b> ";
    
    /*
     * Insert website address depending on company
     */
    $website = "";
    switch($d->company)
    {
        case 'White Rhino':
            $website = "www.whiterhino.com.au";
            break;
        case 'RMIT':
            $website = "www.rmit.edu.au";
            break;
        case 'DigSilent Pacific':
            $website = "www.digsilent.com.au";
            break;
        case 'Casting Kids':
            $website = "www.castingkids.com.au";
            break;
        default:
            break;
    }
    if(strlen($d->company) > 0)
    {
        print "<b>at <a href='http://$website' target='_blank'>$d->company</a></b> ";
    }
    print date("d/m/Y", strtotime($d->start))." - ".date("d/m/Y", strtotime($d->end));
    if(strlen($d->work_type) > 0)
    {
        print "</br>$d->work_type";
    }
    print "</p>";
    $responsibility = json_decode($d->responsibilities);
    $achievements = json_decode($d->achievements);
    $technology = json_decode($d->technologies);
   
    print "<p>Responsibilities</p>";
    
    /*
     * Display responsibilities list
     */
    print "<ul>";
    
    foreach($responsibility->responsibilities as $r)
    {
        print "<li>";
        print $r;
        print "</li>";
    }
    
    print "</ul>";
    
    if(($achievements != null))
    {
        print "<p>Achievements</p>";
    
        /*
         * Display achievements list
         */
        print "<ul>";

        foreach($achievements->achievements as $a)
        {
            print "<li>";
            print $a;
            print "</li>";
        }

        print "</ul>";
    }
    
    
    print "<p>Technologies used:</p>";
    
    /*
     * Display Technologies list
     */
    print "<ul>";
    
    foreach($technology as $tech)
    {
        print "<li>";
        $technology_string = "";
        foreach($tech as $t)
        {
            //print $t.",";
            $technology_string .= $t.", ";
        }
        $character_mask = ", ";
        $technology_string = trim($technology_string, $character_mask);
        print $technology_string;
        print "</li>";
    }
    
    print "</ul>";
}
?>

