$(document).ready(function () {
	$('[data-toggle="offcanvas"]').click(function () { $('.row-offcanvas').toggleClass('active') });
	$('body').tooltip({ selector: '[data-toggle="tooltip"]' });
});