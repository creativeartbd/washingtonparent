window.EStrap = (function (window, document, $, undefined) {
	'use strict';

	var app = {
		init: function () {			
			$(window).on('scroll', app.handleSticky);
			//$(window).on('load', app.alignModal);
			//$(window).on('resize', app.alignModal); 
			$('.hamburger-btn').on('click', app.toggleNavDrawer);
			$('.nav-drawer-close').on('click', app.closeNavDrawer);
			$('.explore-search-box').on('click', app.exploreSearchBox);
			$('.explore-mobile-search-box').on('click', app.exploreMobileSearchBox);			
			$('.sticky-mobile-search-box').on('click', app.exploreStickySearchBox);						
			$('.print-page').on('click', app.printPage);
			$('.send-message').on('click', app.sendMessage);
			$('.click-to-copy').on('click', app.copyLink);
			$('.modal').on('shown.bs.modal', app.alignModal); 
			$('#header-dropdown-opener').on('click', app.openDirectoryDropdown);
		},


		handleSticky:function () {
			if ($(window).scrollTop() > 1) {
				$('.header').addClass('sticky-header');
				$('.sticky-contents').parent().removeClass().addClass('col-md-12');
				$('body').css({'padding-top': '70px'});
			} else if ($(window).scrollTop() < 1) {
				$('body').css({'padding-top': '0px'});
				$('.header').removeClass('sticky-header');
				$('.sticky-contents').parent().removeClass().addClass('col-md-4');
				$('.sticky-event-contents').parent().removeClass().addClass('col-md-12');
			}
		},


		exploreStickySearchBox: function(){
			$('.search-form').toggleClass('displayBlock'); 
		},
		exploreMobileSearchBox: function(){
			$('.search-form').fadeToggle('slow');
		},
		exploreSearchBox: function() {
			$(this).next( $('form') ).fadeToggle('slow');
		},
		openDirectoryDropdown: function() {
			$('.category-dropdown').fadeToggle('slow');
		},
		alignModal: function(){
			$('#newsletterModal').modal();
			var modalDialog = $(this).find('.modal-content');			
			var minus =  $(window).height() - modalDialog.height();
			var devided = minus / 2;
			modalDialog.css('margin-top', Math.max(0, devided - 97 ) );
			var height = $(window).height();
			var dialog = modalDialog.height();
			console.log( height );
			console.log( dialog );
			console.log( Math.max( 0, height - dialog / 2 ) );
		},		

		toggleNavDrawer:function () {
			var $nav_drawer = $('#nav-drawer');
			$nav_drawer.toggleClass('open');
		},
		closeNavDrawer:function () {
			var $nav_drawer = $('#nav-drawer');
			$nav_drawer.removeClass('open');
		},
		printPage: function() {			
			window.print();				
		},
		sendMessage: function (e) {
			e.preventDefault();
			var postTitle = $(this).data('title');
			window.open('mailto:your@email.com?subject=Share Post&body="' + postTitle + '"');
		},
		copyLink: function () {
			var elem = $(this).data('link');

			var $temp = $('<input id="pastebin">');
			$('body').append($temp);
			$temp.val(elem).select();

			try {
				document.execCommand('copy');
				$temp.remove();
				window.alert('Copied current URL to clipboard!');
			} catch (err) {
				window.alert('unable to copy text');
			}
		}
	};

	$(document).ready(app.init);
	return app;
})(window, document, jQuery);
