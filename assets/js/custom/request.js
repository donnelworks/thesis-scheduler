function requestAjax(url, data = {}, ...config) {
	const { async = true, dataType = "json" } = config;
	return $.ajax({
		url: url,
		data: data,
		async: async,
		type: "POST",
		timeout: 60000,
		dataType: dataType,
	}).fail((jqXHR, textStatus, errorThrown) => {
		loadingScreenOff();

		if (textStatus === "error") {
			if (errorThrown === "Internal Server Error") {
				toast("error", "Error: " + errorThrown);
			} else if (errorThrown === "Not Found") {
				toast("error", "Error: Request " + errorThrown);
			} else {
				toast("error", "Request Error");
			}
		}

		if (textStatus === "timeout") {
			toast("error", "Request Timeout");
		}

		if (textStatus === "abort") {
			toast("error", "Request Aborted");
		}

		if (textStatus === "parsererror") {
			toast("error", "Request Parser Error");
		}
	});
}

function requestUploadAjax(url, data = {}) {
	return $.ajax({
		url: url,
		data: data,
		type: "POST",
		timeout: 60000,
		dataType: "json",
		cache: false,
		processData: false,
		contentType: false,
	}).fail((jqXHR, textStatus, errorThrown) => {
		loadingScreenOff();

		if (textStatus === "error") {
			if (errorThrown === "Internal Server Error") {
				toast("error", "Error: " + errorThrown);
			} else if (errorThrown === "Not Found") {
				toast("error", "Error: Request " + errorThrown);
			} else {
				toast("error", "Request Error");
			}
		}

		if (textStatus === "timeout") {
			toast("error", "Request Timeout");
		}

		if (textStatus === "abort") {
			toast("error", "Request Aborted");
		}

		if (textStatus === "parsererror") {
			toast("error", "Request Parser Error");
		}
	});
}
