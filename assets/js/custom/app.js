// Toggle Password Type
$('[data-toggle="password"]').click(function () {
	let input = $(this).closest(".input-group").find("input");
	let inputId = input.attr("id");
	if ($(`#${inputId}`).prop("type") === "password") {
		$(`#${inputId}`).prop("type", "text");
		$('[data-toggle="password"] i').replaceWith(
			'<i class="fas fa-eye-slash"></i>'
		);
	} else {
		$(`#${inputId}`).prop("type", "password");
		$('[data-toggle="password"] i').replaceWith('<i class="fas fa-eye"></i>');
	}
});

// Tooltip
// $('.sidebar [data-toggle="tooltip"]').tooltip();
$(document).ready(function() {
	if ($("body").hasClass("sidebar-collapse")) {
		$('.sidebar [data-toggle="tooltip"]').tooltip("enable");
	} else {
		$('.sidebar [data-toggle="tooltip"]').tooltip("disable");
	}
});
$(document).on("click", '[data-widget="pushmenu"]', function () {
	if ($("body").hasClass("sidebar-collapse")) {
		$('.sidebar [data-toggle="tooltip"]').tooltip("enable");
	} else {
		$('.sidebar [data-toggle="tooltip"]').tooltip("disable");
	}
});

// Open Filter
$(document).on("click", ".btn-filter", function () {
	$("#formFilter").parent().slideToggle();
});
