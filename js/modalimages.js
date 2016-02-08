$(document).ready(function() {	

	//select all the a tag with name equal to modal
	$('a[name=modal]').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		//var id = $(this).attr('href');
		var id = '#dialog';
		//var target = $(this).attr('href');
		$('#bigimage').attr('src',$(this).attr('href'));
		//alert($(this).attr('href'));
		//$(id).css('background-image', 'url(' + target + ')');

	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
		//alert('window height: ' + $(window).height() + '\ndocument height: ' +$(document).height())
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
		//alert('window height: ' + winH + '\nwindow width: ' + winW + '\nmodal height: ' + $(id).height() + '\nmodal width: ' + $(id).width())
              
    //alert("scrolltop: " + $(window).scrollTop()); 
    //alert("scrollleft: " + $(window).scrollLeft()); 

		var topmargin = winH/2-$(id).height()/2;
		//alert("topmargin: " + topmargin);
		topmargin += $(window).scrollTop();
		//alert("topmargin: " + topmargin);
		//Set the popup window to center
		$(id).css('top', topmargin );
		//$(id).css('top', ( winH/2-$(id).height()/2 ) + $(window).scrollTop() );
		$(id).css('left', winW/2-$(id).width()/2);
		$(id).css('display', '');

		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
		$(id).css('display', 'none');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			
	
});

