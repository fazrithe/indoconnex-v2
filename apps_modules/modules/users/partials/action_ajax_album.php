<script>

$(document).ready(function(){

    $('#photodeleteModal').on('show.bs.modal', function (sender) {
	    $photoid = $(sender.relatedTarget).data('photo-id');
        $("#photo-id").val($photoid);
    });

    $('#photoeditModal').on('show.bs.modal', function (sender) {
	    $photoid = $(sender.relatedTarget).data('photo-id');

        $("#edit-id").val($photoid);
        $("#edit-caption").val($('#caption-'+$photoid).text());
    });


});
</script>