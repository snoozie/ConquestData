var URL = "/index.php/";
var area_array = [];

var isTouchSupported = 'ontouchstart' in window;
var startEvent = isTouchSupported ? 'touchstart' : 'mousedown';
var moveEvent = isTouchSupported ? 'touchmove' : 'mousemove';
var endEvent = isTouchSupported ? 'touchend' : 'mouseup';

window.onload = function(){
            init(); 
        }
        function init(){
            var x = document.getElementsByTagName("input")[7];
            var style = window.getComputedStyle(x);
            console.log(style);
            
            if(style.webkitTextSecurity){
                //do nothing
            }else{
                x.setAttribute("type","password");
            }
        } 

$(document).ready(function () {
    /*
     *  Simple image gallery. Uses default settings
     */
    
    $('#area').hide();
    $('#text_area').hide();
    $('#array_area').hide();
    $("#range").val($('#expiry').val());
    $('#range').on(moveEvent, function(){
        var value = 0;
        value = parseInt($('#range').val());
        $('#expiry').val(value);
        
        calc_time(value); 
    });
    for(i = 1; i < 100; i++)
    {
        //numbers[i] = i + 1;
        $('#' + i).on('çlick', function(){
        alert($(this).text());
    });
    }
    
    
    $('#text_area').on('çhange', function(){
        var value = $('#text_area').val();
        var array = $('#array_area').val();
        
        $("#area").val(array + "," + value);
    });
    
    $('#array_area').on('çhange', function(){
        var value = $('#text_area').val();
        var array = $('#array_area').val();
        
        if(value !== "")
        {
            $("#area").val(array + "," + value);
            //alert($("#area").val());
        }
        else
        {
            $("#area").val(array);
            //alert($("#area").val());
        }
    });
    
    $(".add_button_colour").click(function () {
        $(this).toggleClass("pressed");
     });
    
    $(".area_colour").click(function () {
        $(this).toggleClass("pressed");
     });
    
    //$('#load').css({"height":screen.height});
    
    $('#not_needed').on('click', function(){
        $.ajax({ // ajax call starts
            
            type: "POST",
            url: URL + 'not_needed', // JQuery loads serverside.php
            data: {
                pass_id: $('#pass_id').val()
            },
            dataType: 'json', // Choosing a JSON datatype
            success: function (data) // Variable data contains the data we get from serverside
            {

            }
        });
    });
    
    $("#username").keyup(function(event){
        if(event.keyCode === 13){
            $("#login").click();
        }
    });
    
    $("#password").keyup(function(event){
        if(event.keyCode === 13){
            $("#login").click();
        }
    });
    
    $('#login').on('click', function(){
        
        $.ajax({ // ajax call starts
            
            type: "POST",
            url: URL + 'login', // JQuery loads serverside.php
            data: {
                username: $('#username').val(),
                password: $('#password').val(),
                type: $('#type').val()
            },
            dataType: 'json', // Choosing a JSON datatype
            success: function (data) // Variable data contains the data we get from serverside
            {
                if(data[0] === true)
                {
                    if(data[2] === "student")
                    {
                        window.location = URL + "givepass";
                    }
                    else
                    {
                        window.location = URL + "staffView";
                    }
                }
                else
                {
                    alert("Incorrent username or password!");
                }
            }
        });
    });
    $('#area').val($("#area_option").val());
    $("#area_option").change(function() {
        var val = $(this).val();
        $('#area').val(val);
        if (val === 'Other') {
            $('#area').show();
        } else {
            $('#area').hide();
        }
    }).change();
    
    $('#area').on('click', function(){
        $('#area').val("");
    });
    
    $('.fancybox').fancybox();
    
    
    
    $("#changePass").fancybox({
        maxWidth: 900,
        maxHeight: 600,
        minHeight: 130,
        //fitToView: true,
        width: '90%',
        height: '100%' ,
        autoSize: true,
        closeClick: true,
        openEffect: 'none',
        closeEffect: 'none',
        iframe: {
            scrolling: 'no',
        },
        helpers: {
            title: {
                type: 'float'
            }
        },
        onComplete : function(){
        //$.fancybox.update();
        $.fancybox.reposition();
    }
    });
    
    /**
     * Search functionality for filtering on student name
     */
    $('#search').keyup(function () {
       
        $('.item').hide().filter(function(){
       
            if($(this).attr('sfname').contains($('#search').val()))
            {
                //alert(value);
                return true;
            }
        
        }).show();
    });
    
    $('#datetimepicker1').datetimepicker({
        pickDate: false
    });

    $('#timer').countdown(time, function (event) {
        $(this).text(
                event.strftime('%H:%M:%S')
                );
    }).on('finish.countdown', function (event) {
        var pass_id = $('#pass_id').val();
        window.location = URL + "expired/" + pass_id;
    });

    /**
     * Validates and sends info for give pass
     */
    $('#send_pass').validate({
        rules: {
            access_code: {
                minlength: 4,
                required: true,
                number: true
            },
            expiry: {
                required: true,
                number: true
            },
            message: {
                minlength: 2,
                required: true
            }
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
            //$('#basicModal').css('height', '440px');
        },
        /*success: function (element) {
         
         //$('#basicModal').css('height', '330px');
         $('#access_code-error').removeClass('error');
         },*/
         
        errorPlacement: function (error, element) {
            //error.insertBefore(element);
            //error.insertAfter(element);
            error.appendTo("#error");
        },
        submitHandler: function (form) {

            $.ajax({ // ajax call starts

                type: "POST",
                url: URL + 'checkCode', // JQuery loads serverside.php
                data: {
                    access_code: $('#access_code').val(),
                    user: $('#user').val()
                },
                dataType: 'json', // Choosing a JSON datatype
                success: function (data) // Variable data contains the data we get from serverside
                {
                    $.post($(form).attr('action'),$(form).serializeArray());
                    /*
                    $.each(data, function (key, val) {
                        var conf = confirm("Are you " + val.first_name + " " + val.last_name + "?");

                        if (conf === true)
                        {
                            //return true;
                            
                            //form.submit();
                            
                            //$('.fancybox').fancybox().close();
                        }
                        else
                        {
                            return false;
                        }
                        return false;
                    });
                    */
                    //$('#basicModal').removeClass('in');
                    setInterval(
                    function ()
                    {
                        window.location = "/conquestdata/index.php/hallpass";
                    }, 2000
                    );
                    
                } 
            });
            
            return false;
            //
        }

    });
    
    /**
     * Creates Student
     * 
     **/
    
    $.validator.addMethod("dateFormat",
    function(value, element) {
        dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
        return value.match(dateformat);
    },
    "Please enter a date in the format dd-mm-yyyy.");
    
    $('#create_student').validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            dob: {
                required: true,
                dateFormat: true
            },
            user: {
                required: true
            },
            password: {
                required: true
            },
            password_verify: {
                required: true,
                equalTo: "#password"
            }
            
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
            //$('#basicModal').css('height', '440px');
        },
        /*success: function (element) {
         
         //$('#basicModal').css('height', '330px');
         $('#access_code-error').removeClass('error');
         },*/
         
        errorPlacement: function (error, element) {
            //error.insertBefore(element);
            error.insertAfter(element);
            //error.appendTo("#error");
        },
        submitHandler: function (form) {
            $.post($(form).attr('action'),$(form).serializeArray())
                    .done(function() {
                        location.reload();
                    });
            
 
            //location.reload();

        }
    });
    
    /**
     * Validates and adds time for the form add time
     * 
     * All popup forms
     */
    $('#form_popup').validate({
        rules: {
            access_code: {
                minlength: 4,
                required: true,
                number: true
            },
            user: {
                minlength: 2,
                required: true,
            },
            expiry: {
                required: true,
                number: true
            }
            

        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
            //$('#basicModal').css('height', '440px');
        },
        /*success: function (element) {
         
         //$('#basicModal').css('height', '330px');
         $('#access_code-error').removeClass('error');
         },*/
         
        errorPlacement: function (error, element) {
            //error.insertBefore(element);
            //error.insertAfter(element);
            error.appendTo("#error");
        },
        submitHandler: function (form) {

            $.ajax({ // ajax call starts

                type: "POST",
                url: URL + 'checkCode', // JQuery loads serverside.php
                data: {
                    access_code: $('#access_code').val(),
                    user: $('#user').val()
                },
                dataType: 'json', // Choosing a JSON datatype
                success: function (data) // Variable data contains the data we get from serverside
                {
                    $.each(data, function (key, val) {

                        $.post($(form).attr('action'),$(form).serializeArray())
                            .done(function() {
                            location.reload();
                        });
                    });
                    
                    // instead of redirect, popup closes
                    //$('#basicModal').removeClass('in');
                } 
            });
            
            return false;
            //
        }
    });

    $('#add_time').on('click', function () {

    });
    
    // Sorting students on staff page
    $('#sort_sfn_desc').on('click', function(){
        sorting('sfname', "desc");
    });
    
    $('#sort_sfn_asc').on('click', function(){
        sorting('sfname', "asc");
    });
    
    $('#sort_sln_desc').on('click', function(){
        sorting('slname', "desc");
    });
    
    $('#sort_sln_asc').on('click', function(){
        sorting('slname', "asc");
    });
    
    // Sorting teachers
    $('#sort_tfn_desc').on('click', function(){
        sorting('tfname', "desc");
    });
    
    $('#sort_tfn_asc').on('click', function(){
        sorting('tfname', "asc");
    });
    
    $('#sort_tln_desc').on('click', function(){
        sorting('tlname', "desc");
    });
    
    $('#sort_tln_asc').on('click', function(){
        sorting('tlname', "asc");
    });
    
    $('#sort_date_desc').on('click', function(){
        sorting('date', "desc");
    });
    
    $('#sort_date_asc').on('click', function(){
        sorting('date', "asc");
    });
    //$("#basicModal").find('.modal-body').load($('#basicModal').attr('href'));
    /* Use this to get the bloody bootstrap modal working */
    $('#myModal').on('shown.bs.modal', function(e){
        $(e.target).find('.modal-body').load($('#myModal').attr('href'));
      });
      
    /*$('#basicModal').on('shown.bs.modal', function(e){
        alert("here");
        $(e.target).find('.modal-body').load($('#basicModal').attr('href'));
      });
    */
    /*  
    $('#add_5').on('click', function(){add_time(5);});
    
    $('#add_10').on('click', function(){add_time(10);});
    
    $('#add_15').on('click', function(){add_time(15);});
    
    $('#add_20').on('click', function(){add_time(20);});
    */
    // have area value onload for less clicks
    if(window.location.pathname === URL + "givepass")
    {
        
    }
    
    $('#expiry').on("keyup", function() {
        //var value = $('#expiry').val();
        
        var minutes = 0;
        if($('#expiry').val().length > 0)
        {
            minutes = parseInt($('#expiry').val());

            var d = new Date();
            d.setMinutes(d.getMinutes() + minutes);

            //add time to bottom
            $('#calculated_time').text("Pass expires at : " + d.getHours() + ":" + d.getMinutes());
        }
        $("#range").val($('#expiry').val());
    });
});

function sorting(attribute, sort)
{
    // get array of elements
    var myArray = $("#table #sorting .s_header");

    // sort based on attribute
    myArray.sort(function (a, b) {

        // convert to integers from strings
        a = $(a).attr(attribute);
        //alert(a);

        b = $(b).attr(attribute);
        
        // compare
        if(sort === "desc")
        {
            if(a > b) {
                return 1;
            } else if(a < b) {
                return -1;
            } else {
                return 0;
            }
        }
        else if(sort === "asc" )
        {
            if(a < b) {
                return 1;
            } else if(a > b) {
                return -1;
            } else {
                return 0;
            }
        }
        
    });

    // put sorted results back on page
    //$("#table #sorting").append(myArray);
    $("#table #sorting").empty().append(myArray);
}

function sorting2(attribute,start, dest, sort)
{
    // get array of elements
    var myArray = $(start);
    // sort based on attribute
    myArray.sort(function (a, b) {

        // convert to integers from strings
        if(attribute == "date")
        {
        a = parseInt($(a).attr(attribute));
        //alert(a);

        b = parseInt($(b).attr(attribute));
        }
        else
        {
            a = $(a).attr(attribute);
        //alert(a);

        b = $(b).attr(attribute);
        }
        
        
        // compare
        if(sort === "desc")
        {
            if(a > b) {
                return 1;
            } else if(a < b) {
                return -1;
            } else {
                return 0;
            }
        }
        else if(sort === "asc" )
        {
            if(a < b) {
                return 1;
            } else if(a > b) {
                return -1;
            } else {
                return 0;
            }
        }
        
    });

    // put sorted results back on page
    //$("#table #sorting").append(myArray);
    $(dest).empty().append(myArray);
}

// Revoke pass
function revoke(id)
{
    $(document).ready(function () {
        
        $.ajax({ // ajax call starts

            type: "POST",
            url: URL + 'revokePass', // JQuery loads serverside.php
            data: {
                pass_id: id
            },
            dataType: 'json', // Choosing a JSON datatype
            success: function (data) // Variable data contains the data we get from serverside
            {
                if (data === true)
                {
                    alert("Pass is revoked.");
                }
                else
                {
                    alert("Pass unable to be revoked");
                }

            }
        });
    });
}

// Refreshes page every 30 seconds
function refresh()
{
    setInterval(
            function ()
            {
                getInfo();
            }, 30000
            );
}

// Checks whether pass is valid or not
function getInfo()
{
    $(document).ready(function () 
    {
        $.ajax({ // ajax call starts

            type: "POST",
            url: URL + 'checkPass', // JQuery loads serverside.php
            cache: false,
            data: {
                student_id: $('#student_id').val()
            },
            dataType: 'json', // Choosing a JSON datatype
            timeout: 5000,
            success: function (data) // Variable data contains the data we get from serverside
            {
                $.each(data, function (key, val) 
                {    
                    if (val.Revoked === 'Y')
                    {
                        alert("REVOKED!!!");
                        window.location = "/conquestdata/index.php/hallpass";
                    }
                    else if (val.not_needed !== '0000-00-00 00:00:00')
                    {
                        alert("Not Needed");
                        window.location = "/conquestdata/index.php/hallpass";
                    }
                });
            }
        });
    });
}

jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", (($(window).height() - this.outerHeight()) / 2) + $(window).scrollTop() + "px");
    this.css("left", (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + "px");
    return this;
};

//$('.modal').center(true);

//Popup for add time
function change(modal, href, time, student)
{
    $(modal).attr('href', href); 
    $('.time_text').html(time);
    $('.student_text').html(student);
}

// Popup for givepass
function add(modal, href)
{
    $(modal).attr('href', href); 
    $(modal).find('.modal-body').load(href);
    //$('#myModal').find('.modal-body').load(href);
}

// Adds time to expiry via buttons
function add_time(add_time)
{
    var minutes = parseInt($('#expiry').val());
    var total = minutes + add_time;
    
    $('#expiry').val(total);
    
    var minutes_time = parseInt($('#expiry').val());
    
    calc_time(minutes_time);
    
    $("#range").val($('#expiry').val());
}

// press time to expiry via buttons
function press_time(time)
{
    var minutes = $('#expiry').val();
    
    if($("#add_" + time).hasClass("pressed"))
    {
        //$('#expiry').val("");
        var total = parseInt(minutes) - parseInt(time);
        $('#expiry').val(total);
    }
    else
    {
        //alert(this.id);
        var total = parseInt(minutes) + parseInt(time);
        $('#expiry').val(total);
        
    }
    
    calc_time(total);
    
    $("#range").val($('#expiry').val());
}

function calc_time(total)
{
    var d = new Date();
    d.setMinutes(d.getMinutes() + total);
    var minutes;
    if(d.getMinutes < 10)
    {
        minutes = "0" + d.getMinutes();
    }
    else
    {
        minutes = "" + d.getMinutes();
    }
    var formatteddatestr = moment(d).format('h:mm a');
    //add time to bottom
    $('#calculated_time').text("Pass expires at " + formatteddatestr); 
}

function press_area(area)
{
    
    if($("#area_" + area).hasClass("pressed"))
    {
        if(area === "other")
        {
            $("#text_area").hide();
            $("#text_area").val("").trigger('change');
        }
        else
        {
            area_array.pop(area);

            $('#array_area').val(area_array).trigger('change');
        }
    }
    else
    {
        if(area === "other")
        {
            $("#text_area").show();
        }
        else
        {
            area_array.push(area);
        //alert(this.id);
        //var total = parseInt(minutes) + parseInt(time);
            $('#array_area').val(area_array).trigger('çhange');
        }
    }
}

function showPasses(type)
{
    var pass_types = ['all', 'year', 'month', 'week', 'today'];
    
    for	(index = 0; index < pass_types.length; index++) 
    {
        if(pass_types[index] !== type)
        {
            $('#' + pass_types[index] + '_passes').hide();
            $('#' + pass_types[index]).css({"background-image": "linear-gradient(to bottom, #FFF 0%, #E0E0E0 100%)"});
            $('#' + pass_types[index]).css({"background-color": ""});
        } 
    } 
    
    $('#sort_date_desc').on('click', function(){sorting2('date', '#table #' +type + '_passes .s_header', '#table #' +type + '_passes', 'desc');});
    $('#sort_date_asc').on('click', function(){sorting2('date', '#table #' + type + '_passes .s_header', '#table #' +type + '_passes', 'asc');});
    
    $('#' + type + '_passes').show();
    $('#' + type).css({"background-image": "none"});
    $('#' + type).css({"background-color": "#95A3E0"});
}

function swExample() {
    var numbers = {};
    for(i = 0; i < 100; i++)
    {
        numbers[i] = i;
    }
    //var numbers = { 0: 0, 1: 1, 2: 2, 3: 3, 4: 4, 5: 5, 6: 6, 7: 7, 8: 8, 9: 9 };
    SpinningWheel.addSlot(numbers, 'right', parseInt($('#expiry').val()));

    SpinningWheel.setChangeAction(boo);
    SpinningWheel.setCancelAction(cancel);
    SpinningWheel.setDoneAction(done);
    
    SpinningWheel.open();
    
}
function boo()
{
    var results = SpinningWheel.getSelectedValues();
	//alert('values:' + results.values.join(', ') + ' - keys: ' + results.keys.join(', '));
        
        $('#expiry').val(results.values).trigger('keyup');
}

function done() {
	var results = SpinningWheel.getSelectedValues();
	alert('values:' + results.values.join(', ') + ' - keys: ' + results.keys.join(', '));
        
        $('#expiry').val(results.values).trigger('keyup');
}

function cancel() {
	alert('cancelled!');
}
