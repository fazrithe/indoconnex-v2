/*
 * PT. IMAJIKU CIPTA MEDIA
 * Copyright 2019-2020 IMAJIKU.
 * USE FOR GLOBAAL FUNCTIONS
 */

/* document ready */
$(document).ready(function () {
    /* SELECT2 GLOBAL */
    $('.select-mjk').select2({
        minimumResultsForSearch: Infinity,
        // dropdownParent: $('.select-mjk-box'),
        placeholder() {
            $(this).data('placeholder');
        },
    });

    function formatState(opt) {
        if (!opt.id) {
            return opt.text.toUpperCase();
        }

        const optimage = $(opt.element).attr('data-image');
        if (!optimage) {
            return opt.text.toUpperCase();
        }
        const $opt = $(
            `<span><img src="${optimage}" width="60px" /> ${opt.text.toUpperCase()}</span>`
        );
        return $opt;
    }

    $('#jobs-create-employer').select2({
        templateResult: formatState,
        templateSelection: formatState,
    });

    //  multiselect
    $('#business-create-categories').select2({
        multiple: true,
    });

    /* SELECT2 GLOBAL WITH SEARCH ACTIVED */
    $('.select-mjk-search-active').select2({
        minimumResultsForSearch: 3,
    });

    /* SELECT2 DROPDOWN COLOR HEX */
    function formatColor(value) {
        if (!value.id) return value.text; // to exclude optgroups
        return `<strong class='color-preview-hex ${value.id}'></strong>${value.text}`;
    }
    $('.select-color-hex').select2({
        templateResult: formatColor,
        templateSelection: formatColor,
        dropdownCssClass: 'select-color-hex',
        escapeMarkup(m) {
            return m;
        },
    });

    /* SELECT2 DROPDOWN COLOR IMAGE */
    function formatColorImage(color) {
        if (!color.id) {
            return color.text;
        }

        const baseUrl = './themes/images/icons/';
        const $color = $(
            `<span><img src="${baseUrl}/${color.element.value.toLowerCase()}.png" class="product-color" /> ${
                color.text
            }</span>`
        );

        return $color;
    }

    $('.select-color-img').select2({
        templateResult: formatColorImage,
        templateSelection: formatColorImage,
        dropdownCssClass: 'select-color-img',
    });

    /* SELECT2 DROPDOWN LANGUAGE */
    function formatState(state) {
        if (!state.id) {
            return state.text;
        }

        const baseUrl = './themes/images/icons/';
        const $state = $(
            `<span><img src="${baseUrl}/${state.element.value.toLowerCase()}.svg" class="img-flags" /> ${
                state.text
            }</span>`
        );

        return $state;
    }

    $('.select-language-img').select2({
        templateResult: formatState,
        templateSelection: formatState,
        minimumResultsForSearch: Infinity,
        dropdownCssClass: 'select-language-img',
    });

    /* SELECT2 DROPDOWN LANGUAGE WITH FLAGICON.CSS */

    function format(item, state) {
        if (!item.id) {
            return item.text;
        }
        const countryUrl = 'https://lipis.github.io/flag-icon-css/flags/4x3/';
        const stateUrl = 'https://oxguy3.github.io/flags/svg/us/';
        const url = state ? stateUrl : countryUrl;
        const img = $('<img>', {
            class: 'img-flag',
            src: `${url + item.element.value.toLowerCase()}.svg`,
        });
        const span = $('<span>', {
            text: ` ${item.text}`,
        });
        span.prepend(img);
        return span;
    }

    $('.language').select2({
        templateResult(item) {
            return format(item, false);
        },
        templateSelection(item) {
            return format(item, false);
        },
        minimumResultsForSearch: Infinity,
        dropdownCssClass: 'select-language-icon',
    });

    /* starting date survey */
    $('.startingdate').daterangepicker({
        parentEl: '#startingdatepicker',
        singleDatePicker: false,
        showDropdowns: true,
        drops: 'auto',
    });

    /* starting date survey add placeholder */
    $('.startingdate').val('');
    $('.startingdate').attr('placeholder', 'Select Date');

    /* FILTER SELECT VALUE WITH SHOW CONTENT */
    $('#sort-mydata').change(function () {
        $(this).parents().find('.show-mytitle').addClass('d-none');
        $(`#${$(this).val()}`).removeClass('d-none');
    });

    /* UPLOAD PHOTO or IMAGE */
    function fuploadphoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                $('#thisuphoto').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#uphoto').change(function () {
        fuploadphoto(this);
    });

    /* init input type files ( upload ) */
    bsCustomFileInput.init();

    /* FORM DATE */
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });
    $('.forbirthday').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxDate: moment().endOf('day'),
    });

    /* FILTER SELECT VALUE WITH SHOW CONTENT */
    $('#sort-mydata').change(function () {
        $(this).parents().find('.show-mytitle').addClass('d-none');
        $(`#${$(this).val()}`).removeClass('d-none');
    });

    $('#sort-mydata').change(function () {
        $(this).parents().find('.show-mycontent').addClass('d-none');
        $(`.${$(this).val()}`).removeClass('d-none');
    });

    /* ONLY NUMERIC */
    $('.only-numeric').bind('keypress', function (e) {
        const keyCode = e.which ? e.which : e.keyCode;
        if (!(keyCode >= 48 && keyCode <= 57)) {
            $();
            return false;
        }
        $();
    });

    /* RADIO/CHECKBOX VALUE WITH SHOW NEW INPUT TEXT */
    $('#form-input-other').css('display', 'none');
    $('.custom-control-input').click(function () {
        if ($("input[name='radio_input']:checked").val() == 'valother') {
            $('#form-input-other').slideDown('fast');
        } else {
            $('#form-input-other').slideUp('fast');
        }
    });

    /* RADIO/CHECKBOX CHOICE WHEN ANY INPUT DISABLED */
    $('input[name="radio_spesific"]').on('change', function () {
        if ($(this).prop('checked') && $(this).val() != 2)
            $('#choice-spesific [name="select_spesific"]').prop(
                'disabled',
                true
            );
        else
            $('#choice-spesific [name="select_spesific"]').prop(
                'disabled',
                false
            );
    });

    /* FORM VALIDATION */
    $('#form-login').validate({
        rules: {
            email: {
                required: true,
            },
            password: {
                required: true,
                minlength: 5,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    $('#form-login-checkout').validate({
        rules: {
            email: {
                required: true,
            },
            password: {
                required: true,
                minlength: 5,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    $('#form-forgot-password').validate({
        rules: {
            email: {
                required: true,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    $('#form-register').validate({
        rules: {
            email: {
                required: true,
            },
            verification: {
                required: true,
            },
            password: {
                required: true,
                minlength: 5,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    $('#form-reset-password').validate({
        rules: {
            password_new: {
                required: true,
                minlength: 5,
            },
            password_retype: {
                required: true,
                minlength: 5,
                equalTo: '[name="password_new"]',
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    $('#form-voucherapply').validate({
        rules: {
            voucherapply: {
                required: false,
                minlength: 3,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    $('#form-profile-edit').validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            gender: {
                required: true,
            },
            birthday: {
                required: true,
            },
            email: {
                required: true,
            },
            phone: {
                required: true,
                number: true,
                minlength: 6,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    $('#form-profile-password').validate({
        rules: {
            password: {
                required: true,
                minlength: 5,
            },
            password_new: {
                required: true,
                minlength: 5,
            },
            password_retype: {
                required: true,
                minlength: 5,
                equalTo: '[name="password_new"]',
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    $('#form-address-add').validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            address: {
                required: true,
            },
            province: {
                required: true,
            },
            city: {
                required: true,
            },
            sub_district: {
                required: true,
            },
            pos_code: {
                required: true,
                number: true,
                minlength: 4,
            },
            phone: {
                required: true,
                number: true,
                minlength: 6,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    $('#form-address-edit').validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            address: {
                required: true,
            },
            province: {
                required: true,
            },
            city: {
                required: true,
            },
            sub_district: {
                required: true,
            },
            pos_code: {
                required: true,
                number: true,
                minlength: 4,
            },
            phone: {
                required: true,
                number: true,
                minlength: 6,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    /* form pilih alamat */
    $('#form-address-choose').validate({
        rules: {
            address_choose: {
                required: true,
            },
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    /* form karir detail */
    $('#form-career').validate({
        rules: {
            phone: {
                required: true,
                number: true,
                minlength: 6,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    $('#form-subscribe').validate({
        rules: {
            email1: {
                required: true,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });
    $('#form-subscribe-two').validate({
        rules: {
            email2: {
                required: true,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });
    $('#form-subscribe-three').validate({
        rules: {
            email3: {
                required: true,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    /* form contact */
    $('#form-contact').validate({
        rules: {
            email: {
                required: true,
            },
        },
        submitHandler(form) {
            Swal.fire({
                title: 'Successfully sent!',
                text: 'Form has been submitted.',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
                showLoaderOnConfirm: true,
                customClass: {
                    container: 'swal-container-mjk',
                    popup: 'swal-popup-mjk',
                    header: 'swal-header-mjk',
                    title: 'swal-title-mjk',
                    closeButton: 'swal-close-button-mjk',
                    icon: 'swal-icon-success-mjk',
                    image: 'swal-image-mjk',
                    content: 'swal-content-mjk',
                    input: 'swal-input-mjk',
                    actions: 'swal-actions-mjk',
                    confirmButton: 'swal-confirm-button-mjk',
                    denyButton: 'swal-confirm-button-mjk',
                    cancelButton: 'swal-cancel-button-mjk',
                    footer: 'swal-footer-mjk',
                },
            }).then((result) => {
                form.submit();
            });
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    $('#form-contact-2').validate({
        rules: {
            email: {
                required: true,
            },
        },
        submitHandler(form) {
            Swal.fire({
                title: 'Successfully sent!',
                text: 'Form has been submitted.',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
                showLoaderOnConfirm: true,
                customClass: {
                    container: 'swal-container-mjk',
                    popup: 'swal-popup-mjk',
                    header: 'swal-header-mjk',
                    title: 'swal-title-mjk',
                    closeButton: 'swal-close-button-mjk',
                    icon: 'swal-icon-success-mjk',
                    image: 'swal-image-mjk',
                    content: 'swal-content-mjk',
                    input: 'swal-input-mjk',
                    actions: 'swal-actions-mjk',
                    confirmButton: 'swal-confirm-button-mjk',
                    denyButton: 'swal-confirm-button-mjk',
                    cancelButton: 'swal-cancel-button-mjk',
                    footer: 'swal-footer-mjk',
                },
            }).then((result) => {
                form.submit();
            });
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    /* form opening */
    $('#form-opening').validate({
        rules: {
            email: {
                required: true,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            label.addClass('error');
            element.parent().append(label);
        },
    });

    $('#form-cobasaja').validate({
        rules: {
            first_name: {
                required: true,
            },
            birthday: {
                required: true,
            },
            state: {
                required: true,
            },
        },
        submitHandler(form) {
            form.submit();
        },
        errorPlacement(label, element) {
            if (element.hasClass('error')) {
                label.insertAfter(element.parent().find('.error'));
            } else if (element.parent('.input-group').length) {
                label.insertAfter(element.parent());
            } else {
                label.insertAfter(element);
            }
        },
    });
});
