// Custom Sidemenu
$("[data-segment]").on("click", function (e) {
	// e.preventDefault();
	// e.stopPropagation();
	var sidemenuId = $(this).attr("data-segment");
	// Close Tooltip
	$('[data-toggle="tooltip"]').tooltip("hide");
	$(`#${sidemenuId}`).toggleClass("show");
	$('<div class="sidemenu-overlay"></div>')
		.appendTo("body")
		.hide()
		.fadeIn(300);
});
$(document).on("click", ".sidemenu-close, .sidemenu-overlay", function (e) {
	$(".sidemenu").removeClass("show");
	$(".sidemenu-overlay").remove();
});