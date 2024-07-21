/*window.pages = ['home', 'usage', 'usage', 'get', 'get', 'reference', 'reference', 'credits'];

function getURL() {
	return window.location.href.split('#').shift();
}

function getHash() {
	return window.location.hash.slice(1);
}
function checkHash(hash) {
	var hash = getHash(), k;
	if ((k=jQuery.inArray(hash, pages))!=-1) {
		jQuery('nav').children().each(function(index, value) { 
			if (jQuery(value).attr('href').indexOf(hash)!=-1) 
				jQuery(value).addClass('on');
			else 
				jQuery(value).removeClass('on');
		});
		return k+1;
	}
	return 1;
}*/

function setControllPos() {

	var view = jQuery('#magazine').turn('view');

	if (view[0]) jQuery('#previous').addClass('visible');
	else jQuery('#previous').removeClass('visible');

	if (view[1]) jQuery('#next').addClass('visible');
	else jQuery('#next').removeClass('visible');

}
function rotated() {
	return Math.abs(window.orientation)==90;
}

function isPhone() {
	return navigator.userAgent.match(/iPhone/i);
}

function resizeViewport() {
	jQuery('#viewport').css({width: jQuery(window).width(), height: (isPhone() && !rotated()) ? 1670 :  jQuery(document).height()});
}

function setScroll() {
	if (isPhone())
		window.scrollTo(0, (rotated()) ? jQuery('#magazine').offset().top-6 : 1);
}

function moveMagazine(page) {

	var that = jQuery('#magazine'),
		rendered = that.data().done,
		width = that.width(),
		pageWidth = width/2,
		total = that.data().totalPages,
		options = {duration: (!rendered) ? 0 : 600, easing: 'easeInOutCubic', complete: function(){ jQuery('#magazine').turn('resize');}};

		jQuery('#controllers').stop();

		if (page==total)
				jQuery('#shadow-page').fadeOut(0);

		if ((page==1 || page == total) && !rotated()) {

			var leftc = (jQuery(window).width()-width)/2,
				leftr = (jQuery(window).width()-pageWidth)/2, 
				leftd = (page==1)? leftr - leftc - pageWidth : leftr - leftc;

			jQuery('#controllers').animate({left: leftd}, options);
			
		} else {
			jQuery('#shadow-page').fadeOut('slow');
			jQuery('#controllers').animate({left: 0}, options);
		}
}

jQuery(function() {
	/* Turn events */
	jQuery('#magazine').
		bind('turn', function(e, page){
			moveMagazine(page);
		}).
		bind('turned', function(e, page, pageObj) {
			var rendered = jQuery(this).data().done;
			moveMagazine(page);
			if (!rendered) {
				jQuery('#controllers').fadeIn();
			} else {
				/*jQuery.each(pages, function(index, value) {
					if (page==index+1) {
						var newUrl = getURL() + '#' + value;
						window.location.href = newUrl;
						return false;
					}
				});*/
			}
			setControllPos();
			if (page==1) jQuery('#shadow-page').fadeIn('slow');
			else jQuery('#shadow-page').fadeOut((rendered) ? 'slow' : 0);
			setScroll();	
	 }).bind('start', function(e, page) {
		if (page==2)
			jQuery('#previous').hide();
		else if (page==jQuery(this).data().totalPages-1)
			jQuery('#next').hide();
	}).bind('end', function(e, page) {
		if (page!=1) 
			jQuery('#previous').show();
		if (page!=jQuery(this).data().totalPages-1)
			jQuery('#next').show();
	});

	/* Window events */
	jQuery(window).bind('keydown', function(e){
		if (e.keyCode==37)
			jQuery('#magazine').turn('previous');
		else if (e.keyCode==39)
			jQuery('#magazine').turn('next');
	})/*.bind('hashchange', function() {
			var page = checkHash();
			if (pages!=jQuery('#magazine').turn('page'))
			jQuery('#magazine').turn('page', page);
	})*/.bind('touchstart', function(e) {
		var t = e.originalEvent.touches;
		if (t[0]) touchStart = {x: t[0].pageX, y: t[0].pageY};
		touchEnd = null;
	}).bind('touchmove', function(e) {
		var t = e.originalEvent.touches, pos = jQuery('#magazine').offset();
		if (t[0].pageX>pos.left && t[0].pageY>pos.top && t[0].pageX<pos.left+jQuery('#magazine').width() && t[0].pageY<pos.top+jQuery('#magazine').height()) {
			if (t.length==1)
			e.preventDefault();
			if (t[0]) touchEnd = {x: t[0].pageX, y: t[0].pageY};
		}
	}).bind('touchend', function(e) {
		if (window.touchStart && window.touchEnd) {
			var that = jQuery('#magazine'),
				w = that.width()/2,
				d = {x: touchEnd.x-touchStart.x, y: touchEnd.y-touchStart.y},
				pos = {x: touchStart.x-that.offset().left, y: touchStart.y-that.offset().top};
			if (Math.abs(d.y)<100)
			 if (d.x>100 && pos.x<w)
				jQuery('#magazine').turn('previous');
			 else if (d.x<100 && pos.x>w)
				jQuery('#magazine').turn('next');
		}
	}).resize(function() {
		jQuery('#magazine').turn('resize');
		resizeViewport();
	});

	jQuery('#next').click(function(e) {
		jQuery('#magazine').turn('next');
		return false;

	});
	
	jQuery('#previous').click(function(e) {
		e.stopPropagation();
		jQuery('#magazine').turn('previous');
		return false;
	});
	
	/*jQuery('#magazine').children(':first').bind('flip', function() {
	}).find('p').fadeOut(0).fadeIn(2000);*/


	jQuery('body').bind('orientationchange', function() {
		resizeViewport();
		setScroll();
		moveMagazine(jQuery('#magazine').turn('page'));
	});

	/* Create internal instance */
	
	if (jQuery(window).width()<=1200)
		jQuery('body').addClass('x1024');
	
	jQuery('#magazine').turn({/*page: checkHash(), */gradients: !jQuery.isTouch, acceleration: false, elevation: 50});

	resizeViewport();

	setScroll();
});
