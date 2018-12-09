(function($) {	

	$.fn.materialCheckbox = function(options) {
		var $label = this.find('label[for]');
		this.each(function() {
			$('<span class="box" />').prependTo($label);
			$('<span class="check" />').prependTo($label);
			$('<span class="circle" />').prependTo($label);
		});
		
		return this;
	};
	
	$('.material-checkbox').materialCheckbox();

}(jQuery));