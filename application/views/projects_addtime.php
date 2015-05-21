<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<div style="height: 200px; width: 700px;">
    <form id="add_time" method="post" action="" style="height: 190px;">	 
        <input type="hidden" id="project" name='project' value="<?= $project_id; ?>"/>
        <div style="width: 600px;">
                <div style="width: 100px; float: left; padding-top: 6px;">
                    <label for="description">Description: </label>
                </div>
                <div>
                    <textarea id="description" name="description" class="form-control" placeholder="Description"></textarea>
                    
                </div>
            </div>

        <div style="width: 50%;">
                <div style="width: 20%; float: left; padding-top: 6px;">
                    <label for="start">Start: </label>
                </div>
                <div style="width: 70%; float: left;">
                    <input type="text" id="start" name="start" class="form-control" placeholder="Start"  />
                </div>
            </div>
        <div style="width: 50%; float: right;">
                <div style="width: 20%; float: left; padding-top: 6px;">
                    <label for="end">End: </label>
                </div>
                <div style="width: 80%;">
                    <input type="text" id="end" name="end" class="form-control" placeholder="End"  />
                </div>
            </div>
            <div>
                <button type='button' style="float: right;" class='btn btn-lg btn-default' onclick="add_time();" id='submit_time'>Add Time</button>
            </div>
        </form>
    </div>
