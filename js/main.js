jQuery.colorbox.settings.maxWidth  = '95%';
jQuery.colorbox.settings.maxHeight = '95%';

var resizeTimer;
function resizeColorBox()
{
	if (resizeTimer) clearTimeout(resizeTimer);
	resizeTimer = setTimeout(function() {
		if (jQuery('#cboxOverlay').is(':visible')) {
			jQuery.colorbox.load(true);
		}
	}, 300);
}

jQuery(window).resize(resizeColorBox);
window.addEventListener("orientationchange", resizeColorBox, false);

$(window).on('load', function() {
		$('#preloader .loader-wrapper').fadeOut('slow');
		$('#preloader').delay(350).fadeOut('slow');
	});
	
$(document).ready(function() {	

    $('.main-menu li').click( function(){ 
    var scroll_el = $(this).children().attr('href'); 
        if ($(scroll_el).length != 0) {  
        $('html, body').animate({ scrollTop:( $(scroll_el).offset().top - $('#sticky-header').height()) }, 500);         
        }
        return false;
    });

    $(".imgpop").colorbox();
	
	$('.btn-reg').click(function(e){
 	e.preventDefault(); 	
 	var el_name = this.id;
 	var el_form = '#' + el_name + '-form'; 		
 	var formData = $(el_form).serialize();
 	$.ajax({
		url: "mailform.php",
		type: "POST",
		data: formData,
		success:function(data){		
		var klass='';
		var klassr='';
		var responseData = jQuery.parseJSON(data);
		$(el_form + ' .alert').css('display','block');
			switch(responseData.status){
						case 'error':
							klass = 'alert-danger';
							klassr = 'alert-success';
						break;
						case 'success':							
							klass = 'alert-success';
							klassr = 'alert-danger';							
						break;
			}
				$(el_form + ' .alert').removeClass(klassr);	
				$(el_form + ' .alert').addClass(klass);
				$(el_form + ' .alert').text(responseData.message); 
				$(el_form + ' .form-control').val('');				
			}	
		});		
 	return false; 	
 }); 



	
	$('.carousel').carousel({
	  interval: 4500,	  	  
	  wrap: true
	});
	
	$('.owl-carousel').owlCarousel({
    loop:true,
	nav:false,	
	dots:false,
	autoplay:true,
	autoplayHoverPause:true,
	smartSpeed:1000,
    autoplayTimeout:3500,
    margin:10,	
    responsiveClass:true,
    responsive:{
        0:{
            items:2            
        },
        600:{
            items:3            
        },
        1000:{
            items:6,
            dots:true          
        }
    }
});
	
	$("#ui-to-top").hide(); 
	$(window).scroll(function(){
		if ($(this).scrollTop() > 150) {
			$('#ui-to-top').fadeIn();
		} else {
			$('#ui-to-top').fadeOut();
		}
	});
	$("#ui-to-top").click(function(e) {
		e.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "slow");
	return false;
	});
	
});