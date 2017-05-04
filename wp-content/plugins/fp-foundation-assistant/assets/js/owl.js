
/***** Owl Carousel Settings *****/

jQuery(document).ready(function(){
   jQuery('.owl-carousel').each(function(){
	   var id = this.id;

	if (jQuery('.owl-carousel').hasClass('one-column')) {

	   	  jQuery('#'+id).owlCarousel({
		  autoplay: true,	
		  nav: true, 
		  loop: true, 
		  navText:["◀︎","▶︎"],  
	      autoplaySpeed: 1000,
	      smartSpeed: 1000,
	      navSpeed: 1000,
	      fluidSpeed: 1000,
	      autoplayHoverPause:true,
	      items:1,
	      responsive: {
		        0: {
		            items:1
		        },
		        600: {
		            items:1
		        },            
		        960: {
		            items:1
		        },
		        1200: {
		            items:1
		        }
	      }

	  	  });

	   } else if (jQuery('.owl-carousel').hasClass('two-columns')) {

	   	  jQuery('#'+id).owlCarousel({
		  autoplay: true,	
		  nav: true, 
		  loop: true, 
		  navText:["◀︎","▶︎"],  
	      autoplaySpeed: 1000,
	      smartSpeed: 1000,
	      navSpeed: 1000,
	      fluidSpeed: 1000,
	      autoplayHoverPause:true,
	      items:2,
	      responsive: {
		        0: {
		            items:1
		        },
		        600: {
		            items:1
		        },            
		        960: {
		            items:2
		        },
		        1200: {
		            items:2
		        }
	      }

	  	  });

	   } else if (jQuery('.owl-carousel').hasClass('three-columns')) {

	   	  jQuery('#'+id).owlCarousel({
		  autoplay: true,	
		  nav: true,  
		  loop: true, 
		  navText:["◀︎","▶︎"],  
	      autoplaySpeed: 1000,
	      smartSpeed: 1000,
	      navSpeed: 1000,
	      fluidSpeed: 1000,
	      autoplayHoverPause:true,
	      items:3,
	      responsive: {
		        0: {
		            items:1
		        },
		        600: {
		            items:1
		        },            
		        960: {
		            items:3
		        },
		        1200: {
		            items:3
		        }
	      }

	  	  });

	   } else if (jQuery('.owl-carousel').hasClass('four-columns')) {

	   	  jQuery('#'+id).owlCarousel({
		  autoplay: true,	
		  nav: true,  
		  loop: true, 
		  navText:["◀︎","▶︎"],  
	      autoplaySpeed: 1000,
	      smartSpeed: 1000,
	      navSpeed: 1000,
	      fluidSpeed: 1000,
	      autoplayHoverPause:true,
	      items:4,
	      responsive: {
		        0: {
		            items:1
		        },
		        600: {
		            items:1
		        },            
		        960: {
		            items:4
		        },
		        1200: {
		            items:4
		        }
	      }

	  	  });

	   } else if (jQuery('.owl-carousel').hasClass('five-columns')) {

	   	  jQuery('#'+id).owlCarousel({
		  autoplay: true,	
		  nav: true,  
		  loop: true, 
		  navText:["◀︎","▶︎"],  
	      autoplaySpeed: 1000,
	      smartSpeed: 1000,
	      navSpeed: 1000,
	      fluidSpeed: 1000,
	      autoplayHoverPause:true,
	      items:5,
	      responsive: {
		        0: {
		            items:1
		        },
		        600: {
		            items:1
		        },            
		        960: {
		            items:3
		        },
		        1200: {
		            items:5
		        }
	      }

	  	  });

	   } else if (jQuery('.owl-carousel').hasClass('six-columns')) {

	   	  jQuery('#'+id).owlCarousel({
		  autoplay: true,	
		  nav: true,  
		  loop: true, 
		  navText:["◀︎","▶︎"],  
	      autoplaySpeed: 1000,
	      smartSpeed: 1000,
	      navSpeed: 1000,
	      fluidSpeed: 1000,
	      autoplayHoverPause:true,
	      items:6,
	      responsive: {
		        0: {
		            items:1
		        },
		        600: {
		            items:1
		        },            
		        960: {
		            items:3
		        },
		        1200: {
		            items:6
		        }
	      }

	  	  });

	   } else { jQuery('#'+id).owlCarousel(); }

   });
});


