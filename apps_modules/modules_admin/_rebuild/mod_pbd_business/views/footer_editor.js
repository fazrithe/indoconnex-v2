
var CSRF_HASH = CSRF_JSON;

$('body').on('click', '.btn_dlp', function () {
    var iam = $(this);
    var parent = $(this).parent().parent().parent();
    var data_id = $(this).attr('data-id');

    Swal.fire({
        title: "Are you sure delete image ?",
        text: "Deleted data cannot be recovered!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                type: 'POST',
                url: BASE_URL + MODULE_URL + '/delete_image_process',
                data: 'id' + '=' + data_id + CSRF_HASH,
                dataType: 'JSON',
                timeout: 5000,
                success: function (response) {
                    if (response.status === 'success') {
                        iam.parent().parent().remove();
                        parent.append(''
                            + '<div class="fileinput fileinput-new" data-provides="fileinput" style="width: 100%;">'
                            + '<div class="fileinput-new thumbnail ratio ratio1-1">'
                            + '<img src="http://via.placeholder.com/600x600?text=Image+Not+Found" class="img-responsive" alt=""/>'
                            + '</div>'
                            + '<div class="fileinput-preview fileinput-exists thumbnail ratio ratio1-1">'
                            + '<img src="http://via.placeholder.com/600x600?text=Image+Not+Found" class="img-responsive" alt=""/>'
                            + '</div>'
                            + '<div>'
                            + '<span class="btn btn-flat btn-sm btn-primary btn-file">'
                            + '<span class="fileinput-new"><i class="fa fa-search"></i> Select Picture</span>'
                            + '<span class="fileinput-exists"><i class="fa fa-edit"></i> Change</span>'
                            + '<input type="file" name="__files[]" accept="image/x-png,image/gif,image/jpeg"/>'
                            + '</span>'
                            + '<a href="#" class="btn btn-flat btn-sm btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>'
                            + '</div>'
                            + '</div>');


                        Swal.fire(
                            response.title,
                            response.message,
                            'success'
                        );
                    } else {

                        Swal.fire(
                            response.title,
                            response.message,
                            'error'
                        );
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    Swal.fire(
                        AJAX_ERROR_TITLE,
                        AJAX_ERROR_MESSAGE,
                        'error'
                    );
                }
            });

        }
    });
});