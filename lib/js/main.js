jQuery(document).ready(function () {
	jQuery('[data-toggle=offcanvas]').click(function () {
		jQuery('.row-offcanvas').toggleClass('active');
	});
	jQuery('[data-toggle=tooltip]').tooltip();
	jQuery("#product-same").owlCarousel();	
    jQuery(".ebook-top-recent-1").owlCarousel({
        items : 4,
        itemsCustom : false,
        itemsDesktop : [1199, 4],
        itemsDesktopSmall : [979, 4],
        itemsTablet : [768, 3],
        itemsTabletSmall : false,
        itemsMobile : [479, 1],
        singleItem : false,
        itemsScaleUp : false,
        pagination : true,
        paginationNumbers : true
    });
    jQuery(".ebook-top-recent-2").owlCarousel({
        items : 4,
        itemsCustom : false,
        itemsDesktop : [1199, 4],
        itemsDesktopSmall : [979, 4],
        itemsTablet : [768, 3],
        itemsTabletSmall : false,
        itemsMobile : [479, 1],
        singleItem : false,
        itemsScaleUp : false,
        pagination : true,
        paginationNumbers : true
    });

	jQuery("#video-top-recent").owlCarousel({
		items : 3,
        itemsCustom : false,
        itemsDesktop : [1199, 3],
        itemsDesktopSmall : [979, 3],
        itemsTablet : [768, 2],
        itemsTabletSmall : false,
        itemsMobile : [479, 1],
        singleItem : false,
        itemsScaleUp : false,
        pagination : true,
        paginationNumbers : true
	});
});
jQuery(window).load(function() {
    jQuery('#slider').nivoSlider({
        effect: 'fade'
    });
    jQuery('#slider-home').nivoSlider({
        effect: 'fade',
        directionNav: true,
        controlNav: true,
        pauseOnHover: true,
        prevText: '',
        nextText: ''
    });
});