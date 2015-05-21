var URL = window.location.protocol + "//" + window.location.host+"/index.php/";

$(document).ready(function() {
    
    
    
    if(window.location.href === URL + "projects")
    {
        $('body').attr('id', 'projects_site');
    }
    // lets push in a viewport 
    var vpw = (screen.width>=768)?'980':'device-width';
    $('head').prepend('<meta name="viewport" content="width='+vpw+'" />');
    
    var isMobile = window.matchMedia("only screen and (max-width: 760px)");

    var loc = document.location.pathname;
    $("li a.active").removeClass("active");
   
    $("li a[href*='"+loc+"']:first").addClass('active');
    
    $(".fancybox").fancybox({
        maxWidth: 960,
        maxHeight: 600,
        fitToView: false,
        width: '100%',
        height: '90%',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none',
        iframe: {
            scrolling: 'auto',
            preload: true
        },
        helpers: {
            title: {
                type: 'float'
            }
        },
        afterLoad: function () {
            $('.fancybox-iframe').contents().find('head').append('<link href="http://localhost/ConquestData/css/style.css" rel="stylesheet">');
        }
    });

    $('#menu-icon').on('click', function () {
        var display = $('nav:hover ul').css('display');
        if (display === 'none')
        {
            $('nav:hover ul').css('display', 'block');
        }
        else
        {
            $('nav:hover ul').css('display', 'none');
        }
    });
      
      
      $('#send_email').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            subject: {
                required: true
            },
            enquiry: {
                required: true
            }
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
            //$('#basicModal').css('height', '440px');
        },
        errorPlacement: function (error, element) {
            //error.insertBefore(element);
            error.insertAfter(element);

        }
      });
      
      
    /*$("#custom-website-arrow").on('click', function(){
        $('#custom-website-contents').slideToggle(function() {
        //$('#custom-website-contents').slideUp();
        $("a#custom-website-arrow").html('&#x25B2;');
    }, function () {
       // $('#custom-website-contents').slideDown();
        $("a#custom-website-arrow").html('&#x25BC;');
    });
    });*/
    
    /*
    $("#custom-website-arrow").on('click', function(){
        if( $(this).hasClass('active') )
        {
            $(this).html('&#x25B2;');
            $('#custom-website-contents').toggle('slow');
            if (!isMobile.matches) {
        //Conditional script here
                $('#image').toggle('slow');
            }
            
            $('#outer-custom-websites').css('height', '');
        }
        else
        {
            $(this).html('&#x25BC;');
            $('#custom-website-contents').toggle('slow', function(){
                $('#outer-custom-websites').css('height', '70px');
            });
            if (!isMobile.matches) {
        //Conditional script here
                $('#image').toggle('slow');
            }
            
        }
        $(this).toggleClass('active');
    });
    
    $("#applications-arrow").on('click', function(){
        if( $(this).hasClass('active') )
        {
            $(this).html('&#x25B2;');
            $('#applications-contents').toggle('slow');
            $('#outer-applications').css('height', '');
        }
        else
        {
            $(this).html('&#x25BC;');
            $('#applications-contents').toggle('slow', function(){
                $('#outer-applications').css('height', '70px');
            });
            
        }
        $(this).toggleClass('active');
    });
    
    $("#functionalities-arrow").on('click', function(){
        if( $(this).hasClass('active') )
        {
            $(this).html('&#x25B2;');
            $('#functionalities-contents').toggle('slow');
            $('#outer-functionalities').css('height', '');
        }
        else
        {
            $(this).html('&#x25BC;');
            $('#functionalities-contents').toggle('slow', function(){
                $('#outer-functionalities').css('height', '70px');
            });
            
        }
        $(this).toggleClass('active');
    });
    
    $("#technologies-arrow").on('click', function(){
        if( $(this).hasClass('active') )
        {
            $(this).html('&#x25B2;');
            $('#technologies-contents').toggle('slow');
            $('#outer-technologies').css('height', '');
        }
        else
        {
            $(this).html('&#x25BC;');
            $('#technologies-contents').toggle('slow', function(){
                $('#outer-technologies').css('height', '70px');
            });
            
        }
        $(this).toggleClass('active');
    });
    
    $("#projects-arrow").on('click', function(){
        if( $(this).hasClass('active') )
        {
            $(this).html('&#x25B2;');
            $('#projects-contents').toggle('slow');
            $('#outer-projects').css('height', '');
        }
        else
        {
            $(this).html('&#x25BC;');
            $('#projects-contents').toggle('slow', function(){
                $('#outer-projects').css('height', '70px');
            });
            
        }
        $(this).toggleClass('active');
    });
    */
    $('.website-arrow').each(function(){
       $(this).on('click', function(){
           
           var id = $(this).next('div').attr('id');
           var element = $(this).next('div').parentsUntil(".content-top", "[id^='outer']");

           //alert(element.attr('id'));
           if( $(this).hasClass('active') )
            {
                $(this).html('&#x25B2;');
                $(this).next("div").toggle('slow');

                element.css('height', '');
            }
            else
            {
                $(this).html('&#x25BC;');
                $(this).next("div").toggle('slow', function(){
                    element.css('height', '4.1em');
                });
                //alert($(this).parents().find("div[id^='outer']").attr('id'));
            }
            
            if(id === "custom-website-contents")
            {
                if (!isMobile.matches) 
                {
            //Conditional script here
                    $('#image').toggle('slow');
                }
            }
            
        $(this).toggleClass('active');
            //$(this).next("div").toggle('slow');
            //$(this).next("div").toggle('slow');
       });
    });
    
    /**
     * Projects Tab
     */
    
    //var projects = $('#projects').find('');
    
    $('.project').each(function() {
        $(this).hide();
        $(this).find('#hours').html($(this).find('#hours_total').contents());
    });
    
    $('.projects_tab').each(function() {
    // do something with each element, e.g. to hide them all:
        
        var id = $(this).attr('value');
        
        $(this).on('click', function(){
            $('.project').each(function() {
                $(this).hide();
            });
            $('#'+id).show();
        });
    });
    
    /*
     * Login for projects
     */
    $('#login').on('click', function(){
        
        $.ajax({ // ajax call starts
            
            type: "POST",
            url: URL + 'user_login', // JQuery loads serverside.php
            data: {
                username: $('#username').val(),
                password: $('#password').val()
            },
            dataType: 'json', // Choosing a JSON datatype
            success: function (data) // Variable data contains the data we get from serverside
            {
                if(data[0] === true)
                {
                    window.location = URL + "projects";
                }
                else
                {
                    alert("Incorrent username or password!");
                }
            }
        });
    });
    
    
    
    var currentPosition = 0;
  var slideWidth = 300;
  var slides = $('.slide');
  var numberOfSlides = slides.length;

  // Remove scrollbar in JS
  $('#slidesContainer').css('overflow', 'hidden');

  // Wrap all .slides with #slideInner div
  slides
    .wrapAll('<div id="slideInner"></div>')
    // Float left to display horizontally, readjust .slides width
	.css({
      'float' : 'left',
      'width' : slideWidth
    });

  // Set #slideInner width equal to total width of all slides
  $('#slideInner').css('width', slideWidth * numberOfSlides);

  // Insert controls in the DOM
  $('#slideshow')
    .prepend('<span class="control" id="leftControl">Clicking moves left</span>')
    .append('<span class="control" id="rightControl">Clicking moves right</span>');
  
  // Hide left arrow control on first load
  manageControls(currentPosition);
$('#rightControl').html('<i class="fa fa-angle-right fa-2x"></i>');
$('#leftControl').html('<i class="fa fa-angle-left fa-2x"></i>');
  // Create event listeners for .controls clicks
  $('.control')
    .bind('click', function(){
    // Determine new position
	currentPosition = ($(this).attr('id')=='rightControl') ? currentPosition+1 : currentPosition-1;
    
	// Hide / show controls
    manageControls(currentPosition);
    // Move slideInner using margin-left
    $('#slideInner').animate({
      'marginLeft' : slideWidth*(-currentPosition)
    });
  });

  // manageControls: Hides and Shows controls depending on currentPosition
  function manageControls(position){
    // Hide left arrow if position is first slide
	if(position==0){ $('#leftControl').hide() } else{ $('#leftControl').show() }
	// Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ $('#rightControl').hide() } else{ $('#rightControl').show() }
  }	
    
});

function add_time(){
        
        $.ajax({ // ajax call starts
            
            type: "POST",
            url: URL + 'projects_add', // JQuery loads serverside.php
            data: {
                project: $('#project').val(),
                description: $('#description').val(),
                start: $('#start').val(),
                end:$('#end').val()
            },
            dataType: 'json', // Choosing a JSON datatype
            success: function (data) // Variable data contains the data we get from serverside
            {
                if(data == true)
                {
                    window.location = URL + "projects";
                }
                else
                {
                    alert("Incorrent info");
                }
            }
        });
    }

