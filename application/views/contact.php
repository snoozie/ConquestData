<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<!--<div id="outer-contact-us" style=''>-->
    <div id="contact-us" style="padding: 0px;" class="clear">
        <h1>Contact Us</h1>
    
        <p>Email or call us to book an appointment for a discussion about your current or future website.</p>
        <p>Providing us with your email will ensure more communication and we will be able to get back to you faster.</p>

        <div class="contact_left">
        <div><h2>Email Us</h2></div>
        <div style="clear: both;"></div>
        <div id="email" style="border-right: 1px solid #808080;">
            <form id="send_email" method="post">
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Your Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" id="email" placeholder="example@domain.com">
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject" class="col-sm-2 control-label">Subject</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="subject" id="subject">
                    </div>
                </div>
                <div class="form-group">
                    <label for="enquiry" class="col-sm-2 control-label">Enquiry</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="enquiry" id="enquiry"></textarea>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                  </div>
                </div>
            </form>
        </div>
        </div>
        <div class="contact_right" style="height: 120px;">
            <div class="contact_address"><h2>Call Us</h2></div>
            <div id="address" style="" class="contact_address">
                <p>Phone: <a href="tel:+61 455187828">+61 455187828</a></p>
            </div>
        </div>
    </div>
</div>