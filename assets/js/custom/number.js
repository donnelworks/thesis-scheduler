// Load Number Input
function reloadNumberFormat(dec = 0) {
	$(".number").number(true, dec, ".", ",");
	$(".number").click(function () {
		$(this).select();
	});
	$(".number").blur(function () {
		if ($(this).val() == "") {
			$(this).val(0);
		}
	});
}

// Number Format Text
function number(number, dec = 0) {
	return $.number(number, dec, ".", ",");
}
