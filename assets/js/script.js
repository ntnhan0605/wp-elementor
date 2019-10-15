jQuery(document).ready(function($) {
	var $header = $('#header');
	var $main = $('#main');
	var headerHeight = $header.innerHeight();
	var mainMargin = $header.find('.header-top').innerHeight();
	$main.css('margin-top', headerHeight + 'px');
	$(window).on('scroll', function() {
		var scrollTop = $(window).scrollTop();
		if (scrollTop < mainMargin) {
			$header.css('top', '-' + scrollTop + 'px');
		} else {
			$header.css('top', '-' + mainMargin + 'px');
		}
	});

});