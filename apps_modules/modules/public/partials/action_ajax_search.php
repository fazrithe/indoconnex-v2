<script>
    $('#tab-all').on('click',function(){
        $('.tab-pane').addClass('active');
    });

    $('#tab-business').on('click', function () {
        $('.tab-pane').removeClass('active');
        $('#business').addClass('active');
    })
    $('#tab-connection').on('click', function () {
        $('.tab-pane').removeClass('active');
        $('#connection').addClass('active');
    })
    $('#tab-product').on('click', function () {
        $('.tab-pane').removeClass('active');
        $('#product').addClass('active');
    })
    $('#tab-jobs').on('click', function () {
        $('.tab-pane').removeClass('active');
        $('#jobs').addClass('active');
    })
    $('#tab-community').on('click', function () {
        $('.tab-pane').removeClass('active');
        $('#community').addClass('active');
    })
    $('#tab-article').on('click', function () {
        $('.tab-pane').removeClass('active');
        $('#article').addClass('active');
    })

    $(".toPrice").each(function( index ) {
        $type = $(this).data('type');
        if(parseInt($type) == 2){
            $price = $(this).data('low');
            $currency =$(this).data('currency');
            $(this).text(formatNumber($price, $currency));
        }
    });
</script>

