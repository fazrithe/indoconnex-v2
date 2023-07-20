<script> 
    $('.live-search').on('input', debounce(function(){
        $.ajax({
            url: "<?php echo site_url('users_dashboard/live_search');?>",
            method:"GET",
            data:{search: $(this).val()},
            dataType:"html",
        }).done(
            function (html) {
                $('#liveSearchContainer').html(html);
            }
        );	
    }, 750));
</script>