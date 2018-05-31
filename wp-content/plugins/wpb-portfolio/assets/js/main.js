jQuery(function($){


	//portfolio selected category
	$('body').on('click','#wpb_fp_filter_select ul li', function(){
		$(this).parents('#wpb_fp_filter_select').find('#wpb-fp-sort-portfolio span').html($(this).html());
	});

	//portfolio sort
	$("#wpb_fp_filter_select").hover(function () {
	    $(".wpb_fp_filter_Select").slideToggle(200);
	});


	/**
	 * Mixitup trigger
	 */
	
	if ( $.isFunction($.fn.mixItUp) ) {
		$(".wpb_portfolio_area_mixitup").each(function(){
			var $self = $(this),
			$filt = $self.find("[data-filter]"),
			$mix  = $($self.data("mix"));

			$mix.mixItUp({ 
				animation: {
					duration: 1000,
					effects: 'fade stagger(34ms) translateY(10%) scale(0.01)',
					easing: 'cubic-bezier(0.6, -0.28, 0.735, 0.045)',
				},
				selectors: {
					filter: $filt,
				}
			});

		});
	}


	/**
	 * isotope trigger
	 */


	function enableIsotope() {
	  // for each container
	  $('.wpb_portfolio_area_isotope').each( function( i, gridContainer ) {
	    var $gridContainer = $( gridContainer );
	    // init isotope for container
	    var $grid = $gridContainer.find('.wpb_portfolio').imagesLoaded( function() {
	      $grid.isotope({
	        itemSelector: '.wpb-fp-item',
	      })
	    });
	    // initi filters for container
	    $gridContainer.find('.wpb-fp-filter').on( 'click', 'li', function() {
	      var filterValue = $( this ).attr('data-filter');
	      $grid.isotope({ filter: filterValue });
	    });
	  });
	    
	  $('.wpb-fp-filter').each( function( i, buttonGroup ) {
	    var $buttonGroup = $( buttonGroup );
	    $buttonGroup.on( 'click', 'li', function() {
	      $buttonGroup.find('.active').removeClass('active');
	      $( this ).addClass('active');
	    });
	  });

	};
	enableIsotope();



	/**
	 * Tooltipster trigger
	 */
	 
	if ( $.isFunction($.fn.tooltipster) ) {
		$('.filter').tooltipster({
		   animation: 'grow',
		   delay: 200,
		   theme: 'tooltipster-punk',
		   touchDevices: false,
		   trigger: 'hover',
		   minWidth: 40,
		});
	}
	
}); // Non conflict