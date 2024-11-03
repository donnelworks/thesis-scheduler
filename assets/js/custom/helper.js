// Reload DataTable
function reloadDatatable(table) {
	$(table)
		.DataTable()
		.one("draw", function () {
			$(table).DataTable().columns.adjust().responsive.recalc();
		})
		.ajax.reload(null, false);
}

// Toast
function toast(type, message) {
	toastr.options.timeOut = 5000;
	if (type === "success") {
		toastr.success(message);
	}
	if (type === "error") {
		toastr.error(message);
	}
}

// On Loading Element
function loadingElementOn(el) {
	$(el).LoadingOverlay("show", {
		background: "rgba(0, 0, 0, 0)",
		image: "",
		imageAnimation: "2s rotate_right",
		fontawesome: "fas fa-circle-notch fa-spin",
		fontawesomeColor: "#FF7A59",
		fontawesomeAutoResize: false,
		fontawesomeResizeFactor: 0.5,
	});
}

// Off Loading Element
function loadingElementOff(el) {
	$(el).LoadingOverlay("hide", true);
}

// On Loading Screen
function loadingScreenOn() {
	$.LoadingOverlay("show", {
		background: "rgba(0, 0, 0, 0.3)",
		image: "",
		imageAnimation: "2s rotate_right",
		fontawesome: "fas fa-circle-notch fa-spin",
		fontawesomeColor: "#FFFFFF",
		fontawesomeAutoResize: false,
		fontawesomeResizeFactor: 0.5,
	});
}

// Off Loading Screen
function loadingScreenOff() {
	$.LoadingOverlay("hide");
}

// Form Validation
function formValidation(validation) {
	$.each(validation, function (key, value) {
		var el = $('[name="' + key + '"]');
		el.closest(".form-control")
			.removeClass("is-invalid")
			.addClass(value.length > 0 ? "is-invalid" : "");
		el.closest(".form-group").find(".invalid-message").remove();
		el.parents(".form-group").append(value);
	});
}

// Remove Mark Invalid Validation
function removeInvalidValidation() {
	$(".form-control").removeClass("is-invalid");
	$(".invalid-message").remove();
	$(".invalid-upload").remove();
}

// Debounce
function debounce(func, delay) {
	let timeoutId;
	return function (...args) {
		if (timeoutId) {
			clearTimeout(timeoutId);
		}
		timeoutId = setTimeout(() => {
			func.apply(this, args);
		}, delay);
	};
}

// Periode
function setPeriode(el, autoFill, config = {}) {
	const options = {
		showDropdowns: true,
		autoUpdateInput: autoFill ? true : false,
		startDate: new Date(),
		endDate: new Date(),
		locale: {
			format: "DD-MM-YYYY",
			separator: " s/d ",
			applyLabel: "Terapkan",
			cancelLabel: "Reset",
			fromLabel: "Dari",
			toLabel: "Sampai",
			weekLabel: "M",
			daysOfWeek: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
			monthNames: [
				"Januari",
				"Februari",
				"Maret",
				"April",
				"Mei",
				"Juni",
				"Juli",
				"Agustus",
				"September",
				"Oktober",
				"November",
				"Desember",
			],
			firstDay: 1,
		},
	};

	if (config.maxSpan) {
		options.maxSpan = { days: config.maxSpan };
	}

	$(el).daterangepicker(options);

	$(el).on("apply.daterangepicker", function (ev, picker) {
		$(this).val(
			picker.startDate.format("DD-MM-YYYY") +
				" s/d " +
				picker.endDate.format("DD-MM-YYYY")
		);
	});

	$(el).on("cancel.daterangepicker", function (ev, picker) {
		$(this).val("");
		$(this).data("daterangepicker").setStartDate(new Date());
		$(this).data("daterangepicker").setEndDate(new Date());
	});
}

// Date Time
function dateTime(value, type, sep = "", lang = "id") {
	let monthId = [
		"",
		"Jan",
		"Feb",
		"Mar",
		"Apr",
		"Mei",
		"Jun",
		"Jul",
		"Agt",
		"Sep",
		"Okt",
		"Nov",
		"Des",
	];
	let monthEn = [
		"",
		"Jan",
		"Feb",
		"Mar",
		"Apr",
		"May",
		"Jun",
		"Jul",
		"Aug",
		"Sep",
		"Oct",
		"Nov",
		"Dec",
	];
	let monthIdFull = [
		"",
		"Januari",
		"Februari",
		"Maret",
		"April",
		"Mei",
		"Juni",
		"Juli",
		"Agustus",
		"September",
		"Oktober",
		"November",
		"Desember",
	];
	let monthEnFull = [
		"",
		"January",
		"February",
		"March",
		"April",
		"May",
		"June",
		"July",
		"August",
		"September",
		"October",
		"November",
		"December",
	];

	let fullDate = value?.split(" ")[0];
	let fullTime = value?.split(" ")[1];

	let date = fullDate?.split("-")[2];
	let month = fullDate?.split("-")[1];
	let year = fullDate?.split("-")[0];
	let hour = fullTime?.split(":")[0];
	let minute = fullTime?.split(":")[1];
	let second = fullTime?.split(":")[2];

	// Date Time String Full
	if (type === "datetime-string-full") {
		return (
			date +
			sep +
			(lang === "id"
				? monthIdFull[Math.abs(month)]
				: monthEnFull[Math.abs(month)]) +
			sep +
			year +
			" " +
			fullTime
		);
	}
	// Date Time String
	if (type === "datetime-string") {
		return (
			date +
			sep +
			(lang === "id" ? monthId[Math.abs(month)] : monthEn[Math.abs(month)]) +
			sep +
			year +
			" " +
			fullTime
		);
	}
	// Date Time Number
	if (type === "datetime-number") {
		return date + sep + month + sep + year + " " + fullTime;
	}
	// Date String Only Full
	if (type === "date-string-full") {
		return (
			date +
			sep +
			(lang === "id"
				? monthIdFull[Math.abs(month)]
				: monthEnFull[Math.abs(month)]) +
			sep +
			year
		);
	}
	// Date String Only
	if (type === "date-string") {
		return (
			date +
			sep +
			(lang === "id" ? monthId[Math.abs(month)] : monthEn[Math.abs(month)]) +
			sep +
			year
		);
	}
	// Date Number Only
	if (type === "date-number") {
		return date + sep + month + sep + year;
	}
	// Month Only Full
	if (type === "month-full") {
		return lang === "id"
			? monthIdFull[Math.abs(value)]
			: monthEnFull[Math.abs(value)];
	}
	// Month Only
	if (type === "month") {
		return lang === "id" ? monthId[Math.abs(value)] : monthEn[Math.abs(value)];
	}
	// Time Full
	if (type === "time-full") {
		return fullTime;
	}
	// Time
	if (type === "time") {
		return hour + sep + minute;
	}
}

// Form to Object
function formObject(form) {
	const result = form.reduce((acc, curr) => {
		acc[curr.name] = curr.value;
		return acc;
	}, {});

	return result;
}

// Random String
function randomString(length) {
	let result = "";
	const characters =
		"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	const charactersLength = characters.length;
	for (let i = 0; i < length; i++) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
	}

	return result;
}

// nl2br
function nl2br(str, replaceMode, isXhtml) {
	let breakTag = isXhtml ? "<br />" : "<br>";
	let replaceStr = replaceMode ? "$1" + breakTag : "$1" + breakTag + "$2";
	return (str + "").replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
}
