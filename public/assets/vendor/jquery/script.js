$(document).ready(function() {
  $('.nav-link-collapse').on('click', function() {
    $('.nav-link-collapse').not(this).removeClass('nav-link-show');
    $(this).toggleClass('nav-link-show');
  });
});



//Read More Slide Down Script
$(document).ready(function(){

    $("#loadMore").on("click", function(){
        $(".overlay").toggleClass("display-none");
        $(".moreParagraphs").slideToggle(500);
    });

});





//Remove Placeholder Input Script
	    $(function() {
	        $('.form-control').focus(function() {
	            $(this).data('placeholder', $(this).attr('placeholder'))
	                .attr('placeholder', '');
	        }).blur(function() {
	            $(this).attr('placeholder', $(this).data('placeholder'));
	        });
	    });
		
		
		
  
    $('.toggle-btn').on('click', function(e) {
      $('.content-wrapper').toggleClass("drag-left"); //you can list several class names 
      e.preventDefault();
    });






//Accordion Script
$(document).ready(function(){
  //Add a minus icon to the collapse element that is open by default
  	$('.collapse.show').each(function(){
		$(this).parent().find(".fa").removeClass("fa-plus").addClass("fa-minus");
    });
      
  //Toggle plus/minus icon on show/hide of collapse element
	$('.collapse').on('shown.bs.collapse', function(){
		$(this).parent().find(".fa").removeClass("fa-plus").addClass("fa-minus");
	}).on('hidden.bs.collapse', function(){
		$(this).parent().find(".fa").removeClass("fa-minus").addClass("fa-plus");
	});       
});



//Table Scrollbar Script
(function($){
			$(window).on("load",function(){
			/*	
				$("#content-8").mCustomScrollbar({
					axis:"x",
					scrollButtons:{enable:true},
					theme:"3d",
					scrollbarPosition:"outside"
				});
				*/
			
			});
		})(jQuery);




// Add Cart Button Script
$(function(){
$('.filter-option-heading').on('click', function(){
    $('.filter-option-heading').toggleClass('img-open');

});
});

$('.filter-option-heading').click(function() {
    $('.filter-option-content').slideToggle('fast').addClass( "show" );
    return false;
});





//Quantity Product Script

$(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
            
            $('#quantity').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });
    
});


//Image Gallery Modal Script
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
//showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}