/** BUTTON - ACTION REFRESH DATA TABLE */
$("#btn_widget").on("click", ".btn_rld", function () {
	table_refresh();
});

/** BUTTON - ACTION ADD DATA */
$("body").on("click", ".btn_add", function () {
	window.location.href = CURRENT_URL + "/add";
});

/** BUTTON - ACTION EDIT DATA */
$("body").on("click", ".btn_edt", function () {
	var data_id = $(this).parents("tr").find("input").eq(0).val();
	window.location.href = CURRENT_URL + "/edit/" + data_id;
});

$("body").on("click", ".btn_approve", function () {
	var data_id = $(this).parents("tr").find("input").eq(0).val();
	window.location.href = CURRENT_URL + "/approve/" + data_id;
});

$("body").on("click", ".btn_cancel", function () {
	var data_id = $(this).parents("tr").find("input").eq(0).val();
	window.location.href = CURRENT_URL + "/cancel/" + data_id;
});

$("body").on("click", ".btn_dtl", function () {
	var data_id = $(this).parents("tr").find("input").eq(0).val();
	window.location.href = CURRENT_URL + "/detail/" + data_id;
});


/** BUTTON - ACTION DELETE DATA */
$("#data_tables").on("click", ".btn_dlt", function () {
	//var data_id = $(this).attr("data-id");
	var data_id = $(this).parents("tr").find("input").eq(0).val();
	method_delete(data_id);
});

/** BUTTON - ACTION PRIVILEGES */
$("#data_tables").on("click", ".btn_privilege", function () {
	//var data_id = $(this).attr("data-id");
	var data_id = $(this).parents("tr").find("input").eq(0).val();
	window.location.href = CURRENT_URL + "/privileges/" + data_id;
});

/** BUTTON - ACTION STATUS UPDATE DATA */
$("#data_tables").on("click", ".btn_sts", function () {
	var data_id = $(this).parents("tr").find("input").eq(0).val();
	var data_status = $(this).attr("data-status");
	method_status(data_id, data_status);
});

/**ACTION BUTTON FOR DELETE PICTURE*/
$("body").on("click", ".btn_dlp", function () {
	var data_id = $(this).attr('data-id');
	method_picture_delete($(this), data_id);
});

/** BUTTON - ACTION STATUS UPDATE DATA */
$("body").on("click", ".btn_cbx", function () {
	var data_form = "#form-tbl";
	var data_status = $(this).attr("data-status");
	method_checkbox_status(data_form, data_status);
});

/** BUTTON - ACTION STATUS UPDATE DATA */
$("body").on("click", ".btn_cbd", function () {
	var data_form = "#form-tbl";
	method_checkbox_delete(data_form);
});

function table_refresh() {
	dataTableVar.ajax.reload();
}

function method_checkbox_delete(data_form) {
	if ($(' input[type="checkbox"]:checked').length === 0) {
		Swal.fire(
			AJAX_ERROR_TITLE,
			"Please select data with checkboxes before submit !",
			"error"
		);
	} else {
		Swal.fire({
			title: "Are you sure <strong>BATCH</strong> delete the data?",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete now!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: CURRENT_URL + "/delete_checkbox_process",
					type: "POST",
					data: $(data_form).serialize() + CSRF_HASH,
					timeout: 5000,
					dataType: "JSON",
					success: function (response) {
						if (response.status === "success") {
							Swal.fire(response.title, response.message, "success").then(
								function () {
									table_refresh();
									/* window.location.href = CURRENT_URL; */
								}
							);
						} else {
							Swal.fire(response.title, response.message, "error").then(
								function () {
									table_refresh();
									/* window.location.href = CURRENT_URL; */
								}
							);
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						Swal.fire(AJAX_ERROR_TITLE, AJAX_ERROR_MESSAGE, "error");
					},
				});
			}
		});
	}
}

function method_checkbox_status(data_form, data_status) {
	if ($(' input[type="checkbox"]:checked').length === 0) {
		Swal.fire(
			AJAX_ERROR_TITLE,
			"Please select data with checkboxes before submit !",
			"error"
		);
	} else {
		Swal.fire({
			title: "Are you sure <strong>BATCH</strong> update status the data?",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, update status now!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: CURRENT_URL + "/status_process_checkbox",
					type: "POST",
					data:
						$(data_form).serialize() +
						"&data_status=" +
						data_status +
						CSRF_HASH,
					timeout: 5000,
					dataType: "JSON",
					success: function (response) {
						if (response.status === "success") {
							Swal.fire(response.title, response.message, "success").then(
								function () {
									table_refresh();
									/* window.location.href = CURRENT_URL; */
								}
							);
						} else {
							Swal.fire(response.title, response.message, "error").then(
								function () {
									table_refresh();
									/* window.location.href = CURRENT_URL; */
								}
							);
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						Swal.fire(AJAX_ERROR_TITLE, AJAX_ERROR_MESSAGE, "error");
					},
				});
			}
		});
	}
}

function method_delete(parameter_id) {
	Swal.fire({
		title: "Are you sure delete the data?",
		text: "Deleted data cannot be recovered!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: CURRENT_URL + "/delete_process",
				type: "POST",
				data: "data_id=" + parameter_id + CSRF_HASH,
				timeout: 5000,
				dataType: "JSON",
				success: function (response) {
					if (response.status === "success") {
						Swal.fire(response.title, response.message, "success").then(
							function () {
								table_refresh();
								/* window.location.href = CURRENT_URL; */
							}
						);
					} else {
						Swal.fire(response.title, response.message, "error").then(
							function () {
								table_refresh();
								/* window.location.href = CURRENT_URL; */
							}
						);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					Swal.fire(AJAX_ERROR_TITLE, AJAX_ERROR_MESSAGE, "error");
				},
			});
		}
	});
}

function method_status(parameter_id, parameter_status) {
	Swal.fire({
		title: "Are you sure update status the data?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, update status now!",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: CURRENT_URL + "/status_process",
				type: "POST",
				data:
					"data_id=" +
					parameter_id +
					"&data_status=" +
					parameter_status +
					CSRF_HASH,
				timeout: 5000,
				dataType: "JSON",
				success: function (response) {
					if (response.status === "success") {
						Swal.fire(response.title, response.message, "success").then(
							function () {
								table_refresh();
								/* window.location.href = CURRENT_URL; */
							}
						);
					} else {
						Swal.fire(response.title, response.message, "error").then(
							function () {
								table_refresh();
								/* window.location.href = CURRENT_URL; */
							}
						);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					Swal.fire(AJAX_ERROR_TITLE, AJAX_ERROR_MESSAGE, "error");
				},
			});
		}
	});
}

function method_status_disable(parameter_id, parameter_status) {
	Swal.fire({
		title: "Are you sure update status disable the data?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, update status now!",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: CURRENT_URL + "/status_disable_process",
				type: "POST",
				data:
					"data_id=" +
					parameter_id +
					"&data_status=" +
					parameter_status +
					CSRF_HASH,
				timeout: 5000,
				dataType: "JSON",
				success: function (response) {
					if (response.status === "success") {
						Swal.fire(response.title, response.message, "success").then(
							function () {
								table_refresh();
								/* window.location.href = CURRENT_URL; */
							}
						);
					} else {
						Swal.fire(response.title, response.message, "error").then(
							function () {
								table_refresh();
								/* window.location.href = CURRENT_URL; */
							}
						);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					Swal.fire(AJAX_ERROR_TITLE, AJAX_ERROR_MESSAGE, "error");
				},
			});
		}
	});
}

function method_picture_delete(parameter_element) {
	/*
	var iam = $(this);
	var parent = $(this).parent().parent().parent();
	var data_id = $(this).attr("data-id");
	*/

	var iam = parameter_element;
	var parent = parameter_element.parent().parent().parent();
	var data_id = parameter_element.attr('data-id');
	var data_type = parameter_element.attr('data-type');

	Swal.fire({
		title: "Are you sure delete image ?",
		text: "Deleted data cannot be recovered!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: BASE_URL + MODULE_URL + "/delete_image_process",
					data: "id" + "=" + data_id + '&data_type=' + data_type + CSRF_HASH,
					dataType: "JSON",
					timeout: 5000,
					success: function (response) {
						if (response.status === "success") {
							/** remove image thumbnail preview */
							iam.parent().parent().remove();
							/** set new element image after remove */
							parent.append(
								"" +
								'<div class="fileinput fileinput-new" data-provides="fileinput" style="width: 100%;">' +
								'<div class="fileinput-new thumbnail ratio ratio1-1">' +
								'<img src="http://via.placeholder.com/600x600?text=Image+Not+Found" class="img-responsive" alt=""/>' +
								"</div>" +
								'<div class="fileinput-preview fileinput-exists thumbnail ratio ratio1-1">' +
								'<img src="http://via.placeholder.com/600x600?text=Image+Not+Found" class="img-responsive" alt=""/>' +
								"</div>" +
								"<div>" +
								'<span class="btn btn-flat btn-sm btn-primary btn-file">' +
								'<span class="fileinput-new"><i class="fa fa-search"></i> Select Picture</span>' +
								'<span class="fileinput-exists"><i class="fa fa-edit"></i> Change</span>' +
								'<input type="file" name="' + data_type + '[]" accept="image/x-png,image/gif,image/jpeg"/>' +
								"</span>" +
								'<a href="#" class="btn btn-flat btn-sm btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>' +
								"</div>" +
								"</div>"
							);

							Swal.fire(response.title, response.message, "success");
						} else {
							Swal.fire(response.title, response.message, "error");
						}
					}
					,
					error: function (jqXHR, textStatus, errorThrown) {
						Swal.fire(AJAX_ERROR_TITLE, AJAX_ERROR_MESSAGE, "error");
					}
					,
				});
			}
		}
	)
	;
}

function select_generate_dropdown_ajax(
	parameter_element_selector,
	parameter_element_placeholder,
	parameter_ajax_url,
	parameter_default_value,
	parameter_parent_extra
) {
	$(parameter_element_selector).empty().trigger("change");
	$(parameter_element_selector).select2({
		placeholder: parameter_element_placeholder,
		allowClear: true,
		ajax: {
			url: BASE_URL + parameter_ajax_url,
			dataType: "JSON",
			type: "post",
			delay: 250,
			data: function (params) {
				var data_parent = $(parameter_parent_extra).val() || "";
				return {
					q: params.term || "",
					p_n: parameter_parent_extra,
					p: data_parent
				};
			},
			processResults: function (data, params) {
				return {
					results: data.items,
				};
			},
			cache: true,
		},
		escapeMarkup: function (markup) {
			return markup;
		},
		minimumInputLength: 0,
		templateResult: formatRepo,
		templateSelection: formatRepoSelection,
	});

	if (parameter_default_value !== "") {
		$.ajax({
			type: "POST",
			url: BASE_URL + parameter_ajax_url + "?default=true",
			data: "data_id" + "=" + parameter_default_value + CSRF_HASH,
			dataType: "JSON",
			timeout: 5000,
			success: function (response) {
				if (!response.items) {
					/** if empty ignore process selected */
				} else {
					if (response.items.id !== "") {
						$(parameter_element_selector).append(
							$("<option>", {
								value: response.items.id,
								text: response.items.text,
							})
						);
						$(parameter_element_selector)
							.val(response.items.id)
							.trigger("change");
					}
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				Swal.fire(AJAX_ERROR_TITLE, AJAX_ERROR_MESSAGE, "error");
			},
		});
	}
}

function select_multiple_generate_dropdown_ajax(
	parameter_element_selector,
	parameter_element_placeholder,
	parameter_ajax_url,
	parameter_default_value
) {
	$(parameter_element_selector).empty().trigger("change");
	$(parameter_element_selector).select2({
		placeholder: parameter_element_placeholder,
		allowClear: true,
		tags: true,
		ajax: {
			url: BASE_URL + parameter_ajax_url,
			dataType: "JSON",
			type: "post",
			delay: 250,
			data: function (params) {
				return {
					q: params.term || "",
				};
			},
			processResults: function (data, params) {
				return {
					results: data.items,
				};
			},
			cache: false,
		},
		escapeMarkup: function (markup) {
			return markup;
		},
		minimumInputLength: 0,
		templateResult: formatRepo,
		templateSelection: formatRepoSelection,
	});

	if (
		parameter_default_value !== "" &&
		parameter_default_value !== undefined &&
		parameter_default_value !== null
	) {
		$.ajax({
			type: "POST",
			url: BASE_URL + parameter_ajax_url + "?default=true",
			data: "data_id" + "=" + parameter_default_value + CSRF_HASH,
			dataType: "JSON",
			timeout: 5000,
			success: function (response) {
				if (!response.items) {
					/** if empty ignore process selected */
				} else {
					if (response.items.length > 0) {
						var parameter_selected_id = [];
						$.each(response.items, function (key, value) {
							parameter_selected_id.push(value.id);
							$(parameter_element_selector).append(
								$("<option>", {
									value: value.id,
									text: value.text,
								})
							);
						});
						if (parameter_selected_id.length !== 0) {
							$(parameter_element_selector)
								.val(parameter_selected_id)
								.trigger("change");
						}
					}
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				Swal.fire(AJAX_ERROR_TITLE, AJAX_ERROR_MESSAGE, "error");
			},
		});
	}
}

function select_data_dropdown_to_element(
	parameter_element_selector,
	parameter_element_placeholder,
	parameter_ajax_url,
	parameter_default_value,
) {
	$.ajax({
		type: "POST",
		url: BASE_URL + parameter_ajax_url + "?default=true",
		data: "data_id" + "=" + parameter_default_value + CSRF_HASH,
		dataType: "JSON",
		timeout: 5000,
		success: function (response) {
			var element_data_text = '';
			if (!response.items) {
			} else {
				element_data_text = response.items.text;
				$(parameter_element_selector).html(element_data_text);
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			Swal.fire(AJAX_ERROR_TITLE, AJAX_ERROR_MESSAGE, "error");
		},
	});
}

function select_data_dropdown_to_element_multiple(
	parameter_element_selector,
	parameter_element_placeholder,
	parameter_ajax_url,
	parameter_default_value,
) {
	$.ajax({
		type: "POST",
		url: BASE_URL + parameter_ajax_url + "?default=true",
		data: "data_id" + "=" + parameter_default_value + CSRF_HASH,
		dataType: "JSON",
		timeout: 5000,
		success: function (response) {
			console.log(response);

			var element_data_text = '';
			if (!response.items) {
			} else {
				if (response.items.length > 0) {
					$.each(response.items, function (key, value) {
						element_data_text += value.text;
						if (key > 1) {
							element_data_text += ', ';
						}
					});
					$(parameter_element_selector).html(element_data_text);
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			Swal.fire(AJAX_ERROR_TITLE, AJAX_ERROR_MESSAGE, "error");
		},
	});
}

function formatRepo(repo) {
	var markup = repo.text;
	return markup;
}

function formatRepoSelection(repo) {
	if (typeof repo.text == "undefined") {
		return repo.text;
	}
	return repo.text;
}
