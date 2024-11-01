// Card Shadow when Scroll Add and Filter Button
document.addEventListener("scroll", function () {
	let header = $(".card .sticky-top");
	let headerTitle = $(".sticky-top .card-header");
	let headerPosition = header.offset().top;
	if (window.scrollY === headerPosition) {
		header.addClass("shadow-lg");
		headerTitle.prop("hidden", false);
	} else {
		header.removeClass("shadow-lg");
		headerTitle.prop("hidden", true);
	}
});