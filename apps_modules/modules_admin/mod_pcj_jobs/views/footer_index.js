var dataTableVar = null;
var rows_selected = [];
var editor = null;
var readyForDraw = true;
var CSRF_HASH = CSRF_JSON;
$(document).ready(function () {
	dataTableVar = $("#data_tables").DataTable({
		autoWidth: true,
		processing: true,
		deferRender: true,
		searchDelay: 500,
		ajax: {
			url: CURRENT_URL + "/" + "table",
			type: "POST",
			data: function (d) {
				d.filter_categories = $("#filter_categories").val();
			},
		},
		order: [[2, "asc"]],
		language: {
			processing:
				'<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
		},
		columnDefs: [
			{
				targets: 0,
				visible: true,
				orderable: false,
				render: function (data, type, row, meta) {
					/*  return meta.row + meta.settings._iDisplayStart + 1 +*/
					return (
						"" +
						'<input type="hidden" name="id" value="' +
						data +
						'">' +
						'<input type="checkbox" name="checkbox[]" value="' +
						data +
						'">'
					);
				},
			},
			{ targets: 1, orderable: false, visible: false },
		],
	});

	$("#filter_search").on("keyup", function () {
		dataTableVar.search(this.value).draw();
	});

	$("#filter_length").on("change", function () {
		dataTableVar.page.len($(this).val()).draw();
	});

	$("#filter_categories").on("change", function () {
		var value_element = $(this).val();
		if (value_element !== null) {
			table_refresh();
		}
	});

	/* HANDLE CLICK ON CHECKBOX */
	$("#data_tables tbody").on("click", 'input[type="checkbox"]', function (e) {
		var $row = $(this).closest("tr");
		/* Get row data */
		var data = dataTableVar.row($row).data();
		/* Get row ID */
		var rowId = data[0];
		/* Determine whether row ID is in the list of selected row IDs */
		var index = $.inArray(rowId, rows_selected);
		/* if checkbox is checked and row ID is not in list of selected row IDs */
		if (this.checked && index === -1) {
			rows_selected.push(rowId);
			/* Otherwise, if checkbox is not checked and row ID is in list of selected row IDs */
		} else if (!this.checked && index !== -1) {
			rows_selected.splice(index, 1);
		}
		if (this.checked) {
			$row.addClass("selected");
		} else {
			$row.removeClass("selected");
		}
		/* Update state of "Select all" control */
		updateDataTableSelectAllCtrl(dataTableVar);
		/* Prevent click event from propagating to parent */
		e.stopPropagation();
	});

	/* HANDLE CLICK ON "SELECT ALL" CONTROL */
	$('thead input[name="select_all"]', dataTableVar.table().container()).on(
		"click",
		function (e) {
			if (this.checked) {
				$('#data_tables tbody input[type="checkbox"]:not(:checked)').trigger(
					"click"
				);
			} else {
				$('#data_tables tbody input[type="checkbox"]:checked').trigger("click");
			}
			/* Prevent click event from propagating to parent */
			e.stopPropagation();
		}
	);

	/* HANDLE TABLE DRAW EVENT */
	dataTableVar.on("draw", function () {
		/* Update state of "Select all" control */
		updateDataTableSelectAllCtrl(dataTableVar);
	});

	select_generate_dropdown_ajax(
		"#filter_categories",
		"Search by Categories",
		"mod_dropdown/general_dropdown/pfe_articles_categories/id/data_name"
	);

	$("#filter_categories").on("select2:clearing", function (e) {
		table_refresh();
	});
});
