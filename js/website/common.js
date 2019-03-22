(function ($) {

	$(document).ready(function () {
		jQuery('.js-ShowLoginForm').click(function () {
			jQuery('#registerform').hide(500);
			jQuery(this).hide(500);
			jQuery('#loginform').show(500);
			jQuery('.js-ShowRegisterForm').show(500);
		});

		jQuery('.js-ShowRegisterForm').click(function () {
			jQuery('#loginform').hide(500);
			jQuery(this).hide(500);
			jQuery('#registerform').show(500);
			jQuery('.js-ShowLoginForm').show(500);
		});
	});

})(jQuery);