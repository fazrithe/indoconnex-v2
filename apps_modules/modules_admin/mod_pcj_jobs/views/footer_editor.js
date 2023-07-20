var CSRF_HASH = CSRF_JSON;

$(document).ready(function () {
    select_generate_dropdown_ajax(
        "#users_id",
        "Choose Users",
        "mod_dropdown/general_dropdown/users/id/name_full",
        data_output_result.users_id
    );
    select_generate_dropdown_ajax(
        "#pbd_business_id",
        "Choose Business",
        "mod_dropdown/general_dropdown/pbd_business/id/data_name",
        data_output_result.pbd_business_id
    );
    select_generate_dropdown_ajax(
        "#jobs_types_id",
        "Choose Job Type",
        "mod_dropdown/general_dropdown/pcj_jobs_types/id/data_name",
        data_output_result.jobs_types_id
    );
    select_generate_dropdown_ajax(
        "#jobs_industries_id",
        "Choose Job Industries",
        "mod_dropdown/general_dropdown/pcj_jobs_industries/id/data_name",
        data_output_result.jobs_industries_id
    );
    select_generate_dropdown_ajax(
        "#jobs_experiences_id",
        "Choose Job Experiences",
        "mod_dropdown/general_dropdown/pcj_jobs_experiences/id/data_name",
        data_output_result.jobs_experiences_id
    );
    select_generate_dropdown_ajax(
        "#jobs_salary_period_id",
        "Choose Job Salar Periody",
        "mod_dropdown/general_dropdown/pcj_jobs_salary_period/id/data_name",
        data_output_result.jobs_salary_period_id
    );

    select_multiple_generate_dropdown_ajax(
        "#data_categories",
        "Choose Categories",
        "mod_dropdown/general_multiple_dropdown/pfe_articles_categories/id/data_name",
        data_output_result.data_categories
    );
});


function action_price_currency(parameter_value) {
    if (parameter_value == 'IDR') {
        init_mask_money_idr();
    } else {
        init_mask_money_dollar();
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

