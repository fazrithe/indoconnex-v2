<script>
    $(document).ready(function(){
        var csrfName = $(".txt_csrfname").attr("name"); // Value specified in $config['csrf_token_name']
        var csrfHash = $(".txt_csrfname").val(); // CSRF hash
        $('.btn-favourite').click( function (params) {
            $contentId = $(this).data('content-id');
            $contentType =$(this).data('content-type');
			$status = $(this).hasClass('active');
            $.ajax({
                type  : 'POST',
                url   : '<?php echo site_url('favourite/store');?>',
                async : true,
                data: {
                    id: $contentId,
                    type: $contentType,
                    [csrfName]: csrfHash
                },
                dataType : 'json',
            }).done( function (params) {
				$icon = 'bookmark_remove';
				$color = 'text-orange';
				$feed = 'removed from';
				if ($status) {
					$feed = 'added to';
					$icon = 'bookmark_added';
					$color = 'text-atlantis';
				}
                bs5Utils.Toast.show({
                    type: 'indoconnex',
                    icon: '<span class="material-icons-round '+$color+' md-14 me-2">'+$icon+'</span>',
                    title: 'Success',
                    subtitle: 'now',
                    content: $contentType+' has been '+$feed+' Favourite.',
                    buttons: [

                    ],
                    delay: 5000,
                    dismissible: true
                });
            }).fail( function (params) {
                bs5Utils.Toast.show({
                    type: 'indoconnex',
                    icon: `<span class="material-icons-round text-orange md-14 me-2">cancel</span>`,
                    title: 'Error',
                    subtitle: 'now',
                    content: 'Something went wrong! Please Try Again',
                    buttons: [

                    ],
                    delay: 5000,
                    dismissible: true
                });
            });
        });
    });
</script>
