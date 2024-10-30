(function ($) {
	$.fn.datatable = function (props) {
		var table = $(this).DataTable({
			ajax: {
				url: props.url,
				type: "POST",
				data: props.data,
				dataSrc: props.dataSrc,
			},
			rowId: props.rowId,
			columns: props.columns,
			order: props.order,
			rowReorder: {
				enable: props?.rowReorder?.enable ?? false,
				selector: props?.rowReorder?.selector ?? "td:first-child",
				update: props?.rowReorder?.update ?? false,
				dataSrc: props?.rowReorder?.dataSrc,
				snapX: true,
			},
			paging: props.paging,
			rowGroup: props.rowGroup,
			select: props.select,
			pageLength: props.pageLength.length ?? 25,
			bInfo: props.info,
			fixedHeader: {
				header: false,
				footer: true,
			},
			responsive: {
				details: {
					type: "column",
					target: props?.responsive?.target ?? 0,
					renderer: function (api, rowIdx, columns) {
						var data = `<div class="row justify-content-center">
                            <div class="col-md-8">
                              <div class="card rounded-lg shadow-none border">
                                <div class="card-body dt-detail-list">
                                    ${$.map(columns, function (col, i) {
																			return col.hidden
																				? `<div class="row dt-detail-item py-2">
                                          <div class="col-md-6">
                                            <strong>${col.title}</strong>
                                          </div>
                                          <div class="col-md-6">
                                            ${col.data}
                                          </div>
                                        </div>`
																				: ``;
																		}).join("")}
                                </div>
                              </div>
                            </div>
                          </div>`;
						return data;
					},
				},
			},
			processing: true,
			serverSide: true,
			searching: false,
			lengthChange: props?.pageLength.lengthChange ?? false,
			oLanguage: {
				sProcessing: "Loading...",
				sInfo:
					'<span class="text-gray"><em>_START_ s/d _END_ dari _TOTAL_ data</em></span>',
				sEmptyTable:
					props.emptyTable ?? '<span class="text-gray">Tidak Ada Data</span>',
				sInfoEmpty: "0 data",
				sLengthMenu: '<span style="padding-left: 1.25rem;">_MENU_ Baris / Halaman</span>',

			},
			rowCallback: props.rowCallback,
		});

		// Handle Prevent Enter Key for Submit in Form Filter
		$(props.formFilter).keydown(function (event) {
			return event.key != "Enter";
		});

		// Filter
		$(".filter-data").click(function (e) {
			e.stopPropagation();
			e.preventDefault();
			table.draw();
		});

		// Reset Filter
		$(".reset-filter-data").click(function (e) {
			e.preventDefault();
			var filterForm = $(this).data("filter-form");
			var periodForm = $(this).data("periode-form");
			if (periodForm) {
				setPeriode(periodForm, false);
			}
			$(filterForm).trigger("reset");
			$(".select-filter").each(function (i, el) {
				$(this)
					.val($(this).find("option:first-child").val())
					.trigger("change.select2");
			});
			table.draw();
		});

		// Methods
		this.rowTotal = function () {
			return table.data().count();
		};

		return this;
	};
})(jQuery);
