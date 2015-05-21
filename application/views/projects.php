<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!--<div id="outer" style='padding: 0px 0px;'>-->
    <div id="projects" style="">
        <ul>
            <?php
            foreach($projects as $project)
            {
            ?>
            <li id="project_tab_<?= $project->id?>" value="project_<?= $project->id?>" class="projects_tab" onclick="$('#project_<?= $project->id?>').toggle(); $('#form_<?= $project->id?>').load('../index.php/projects_addtime/<?= $project->id?>');"><?= $project->name?></li>
            <?php
            }
            ?>
        </ul>
        
    </div>
    <?php
    foreach($projects as $project)
    {
        $hours = 0;
    ?>
    <div id="project_<?= $project->id?>" class="project">
        <h2><?= $project->name?></h2><p>Total Hours: <span id="hours"><?= $hours;?></span></p>
        <div id="form_<?= $project->id?>" style="height: 200px;"></div>
        <?php
        foreach($tasks as $task)
        {
            if($task->project == $project->id)
            {
                $hours += $task->hours;
                ?>
        <div id="task_<?= $task->id?>" style="border-top: 1px solid grey; padding: 5px;">
            <p><?= $task->description?></p>
            <p>Start: <?= $task->start?> | End:<?= $task->end?> | Hours: <?= $task->hours?></p>
        </div>
                <?php
                
            }
        }
        ?>
        <span id="hours_total"><?= $hours;?></span>
    </div>
            
    <?php
    }
    ?>
</div>

