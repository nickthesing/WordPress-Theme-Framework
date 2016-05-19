/**
 * 	jQuery Font Selector Plugin 1.0
 *
 * 	http://www.somnia-themes.com
 * 	http://ww.66themes.net
 *
 * 	Copyright (c) 2012 SomniaThemes and 66Themes
 */

// Utility
if ( typeof Object.create !== 'function' ) {
	Object.create = function( obj ) {
		function F() {};
		F.prototype = obj;
		return new F();
	};
}

(function( $, window, document, undefined ) { 
	var FontSelector = {
		init: function( options, elem ) {
			var self = this;

			self.elem = elem;
			self.$elem = $( elem );

			self.GoogleWebFontUrl = "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDsc5GDA3L-9xhojEa8VU-P9HF-aR1F0JY";
			self.standardFonts = [
				"Arial", 
				"Arial Black", 
				"Helvetica", 
				"Helvetica Neue", 
				"Comic Sans MS", 
				"Courier New", 
				"Georgia", 
				"Impact", 
				"Lucida Console", 
				"Lucida Sans Unicode", 
				"Lucida Grande", 
				"Tahoma", 
				"Times New Roman", 
				"Trebuchet MS", 
				"Verdana"
			];

			self.options = $.extend( {}, $.fn.FontSelector.options, options)		

			self.appendStandardFonts();

			self.fetch().done(function ( results ) {
				self.buildFrag( results );

				self.display();
			});

			self.change();

			self.previewFont();
		},

		previewFont: function() {
			var self = this;

			var newFont = '<link href="http://fonts.googleapis.com/css?family=' + self.options.currentFont + '" rel="stylesheet" type="text/css">';
			$(self.options.previewContainer).append(newFont);
			$(self.options.previewContainer).css('font-family', self.options.currentFont);
		},

		change: function() {
			var self = this;

			self.$elem.on('change', function() {
				self.preview();
			});
		},

		fetch: function() {
			return $.ajax({
				url: this.GoogleWebFontUrl,
				dataType: "jsonp"
			})
		},

		appendStandardFonts: function( ) {
			var self = this;
			
			self.$elem.append('<option disabled="disabled">' + self.options.optionName + '</option>');

			$.each(self.standardFonts, function(key, val){
				return ( self.options.currentFont === val ) 
				? self.$elem.append('<option value="' + val + '" data-font-type="standard" selected>' + val + '</option>')
				: self.$elem.append('<option value="' + val + '" data-font-type="standard">' + val + '</option>');
			});

			self.$elem.append('<option disabled="disabled"> --- Google Web Fonts --- </option>');
		},

		buildFrag: function( results ) { 
			var self = this;
			self.fonts = $.map( results.items, function( font, i ) {
				return ( self.options.currentFont === font.family )
				?  $('<option selected ></option>').append ( font.family )[0]
				:  $('<option></option>').append( font.family )[0];
			});
		},

		preview: function( ) {
			var self = this;

			if ( self.options.preview === true) {
				if (self.$elem.find("option:selected").attr('data-font-type') == 'standard') {
					$(self.options.previewContainer).append(self.options.previewWrapElem).text(self.options.previewText).css('font-family', self.$elem.find("option:selected").text());
				}
				else { 
					$(self.options.previewContainer).find('link').remove();
					var newFont = '<link href="http://fonts.googleapis.com/css?family=' + self.$elem.find("option:selected").text() + '" rel="stylesheet" type="text/css">';
					$(self.options.previewContainer).append(newFont);
    			 	$(self.options.previewContainer).css('font-family', self.$elem.find("option:selected").text());
				}
			}
		},

		display: function() {
			var self = this;
			self.$elem.append( self.fonts );
		}
	};

	$.fn.FontSelector = function( options ){
		return this.each(function(){
			var fontselector = Object.create( FontSelector );

			fontselector.init( options, this );
		});
	};

	$.fn.FontSelector.options = {
		optionName: '--- Standard Web Fonts --- ',
		currentFont: 'Verdana',
		previewContainer: '',
		preview: true,
		previewWrapElem: '<h3></h3>',
		previewText: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'
	}
})( jQuery, window, document );
