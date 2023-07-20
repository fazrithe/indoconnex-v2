var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
    select_multiple_generate_dropdown_ajax(
        "#data_categories",
        "Choose Items Categories",
        "mod_dropdown/general_multiple_dropdown/pbd_items_categories/id/data_name",
        data_output_result.data_categories
    );

    select_generate_dropdown_ajax(
        "#pbd_business_id",
        "Choose Business",
        "mod_dropdown/general_dropdown/pbd_business/id/data_name",
        data_output_result.pbd_business_id
    );

    select_generate_dropdown_ajax(
        "#country_id",
        "Choose Countries",
        "mod_dropdown/general_dropdown/loc_countries/id/name",
        data_output_result.country_id
    );

    select_generate_dropdown_ajax(
        "#state_id",
        "Choose States",
        "mod_dropdown/general_dropdown/loc_states/id/name",
        data_output_result.state_id,
        "#country_id"
    );

    select_generate_dropdown_ajax(
        "#city_id",
        "Choose City",
        "mod_dropdown/general_dropdown/loc_cities/id/name",
        data_output_result.city_id,
        "#state_id"
    );

    if (data_output_result.id !== '') {
        action_price_type(data_output_result.price_type);
        action_price_currency(data_output_result.price_currency);
    }
});

$('#section_currency').addClass('hidden');
$('#section_price_low').addClass('hidden');
$('#section_price_high').addClass('hidden');
$('#section_price_variant').addClass('hidden');

function action_price_currency(parameter_value) {
    if (parameter_value == 'IDR') {
        init_mask_money_idr();
    } else {
        init_mask_money_dollar();
    }
}

function action_price_type(parameter_value) {
    $('#section_currency').addClass('hidden');
    $('#section_price_low').addClass('hidden');
    $('#section_price_high').addClass('hidden');
    $('#section_price_variant').addClass('hidden');

    $('#section_price_low label').html('Price Low');


    $('[name="price_high"]').val(0);
    $('[name="price_high"]').val(0);

    if (parameter_value === '1') {
        /* Free */
        $('#section_price_low').addClass('hidden');
        $('#section_price_high').addClass('hidden');
        $('#section_price_variant').addClass('hidden');

        $('[name="price_low"]').val(0);
        $('[name="price_high"]').val(0);
    } else if (parameter_value === '2') {
        /* Fixed */
        $('#section_price_low label').html('Fixed Price');
        $('#section_currency').removeClass('hidden');
        $('#section_price_low').removeClass('hidden');
        $('#section_price_variant').addClass('hidden');
    } else if (parameter_value === '3') {
        /* Starting */
        $('#section_price_low label').html('Starting Price');
        $('#section_price_low').removeClass('hidden');
        $('#section_currency').removeClass('hidden');
        $('#section_price_variant').addClass('hidden');
    } else if (parameter_value === '4') {
        /* Ask for Price */
        $('#section_price_low').addClass('hidden');
        $('#section_price_high').addClass('hidden');
        $('#section_price_variant').addClass('hidden');

        $('[name="price_low"]').val(0);
        $('[name="price_high"]').val(0);
    } else if (parameter_value === '5') {
        /* Variant */
        $('#section_price_low').addClass('hidden');
        $('#section_price_high').addClass('hidden');

        $('#section_currency').removeClass('hidden');
        $('#section_price_variant').removeClass('hidden');

        $('[name="price_low"]').val(0);
        $('[name="price_high"]').val(0);
    }

}


function init_mask_money_idr() {
    $(".currency").maskMoney('destroy');
    $('.currency').maskMoney({
        allowNegative: false,
        thousands: '.',
        decimal: '',
        precision: '0'
    }).maskMoney('mask');
    $('.currency').attr('onclick', 'this.select()');
}

function init_mask_money_dollar() {
    $(".currency").maskMoney('destroy');
    $('.currency').maskMoney({
        allowNegative: false,
        thousands: ',',
        decimal: '.',
    }).maskMoney('mask');
    $('.currency').attr('onclick', 'this.select()');
}

