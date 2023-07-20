/*
 * PT. IMAJIKU CIPTA MEDIA
 * Copyright 2019-2020 IMAJIKU.
 * USE FOR GLOBAL FUNCTIONS
 */

/* ---------- CATEGORY: FIRST LOAD ----------- */
/* load welcome dialog first */
if ($.cookie('pop') === null) {
    $('#welcomedialog2').modal('show');
}

/* ---------- CATEGORY: SCROLL TOP ----------- */
/* begin.scroll back to top */
function scrollFunction() {
    if (document.getElementById('backtotop') !== null) {
        if (
            document.body.scrollTop > 300 ||
            document.documentElement.scrollTop > 300
        ) {
            document.getElementById('backtotop').classList.add('active');
        } else {
            document.getElementById('backtotop').classList.remove('active');
        }
    }
}

/* When the user clicks on the button, scroll to the top of the document */
function topFunction() {
    $('html, body').animate({ scrollTop: 0 }, 1200, 'linear');
}
/* end.scroll back to top */

function myheaders() {
    if (navheader !== null) {
        if (window.pageYOffset > sticky) {
            navheader.classList.add('sticky');
        } else {
            navheader.classList.remove('sticky');
        }
    }
}

/* header scroll */
window.onscroll = function () {
    myheaders();
    scrollFunction();
};

window.onresize = function () {
    $('body').removeClass('disablescrollbar');
};

var navheader = document.getElementById('headertop');

const hasNav = document.getElementById('navbar');

if ($(hasNav).length > 0) {
    var sticky = navheader.offsetTop;
} else {
    var sticky = null;
}

/* ---------- CATEGORY: DOC READY----------- */
$(document).ready(function () {
    /* ---------- CATEGORY: PRELOADER----------- */

    $('.preload-mjk').fadeOut(1200, function () {
        $(this).addClass('loading');
    });

    /* ---------- CATEGORY: NAVBAR----------- */

    /* disable scrollbar when showing mainmenu resposive */
    $('.finebody').click(function (e) {
        e.preventDefault();
        $(this).parents().find('body').toggleClass('disablescrollbar');
    });

    /* search */
    $('.button-search').on('click', function (event) {
        event.stopPropagation();
        $(this).parents().find('#search-body').addClass('open');
        $('#search-body input[type="search"]').focus();
    });
    $('.search-body').on('click keyup', function (event) {
        event.stopPropagation();
        if (
            event.target === this ||
            event.target.className === 'close' ||
            event.keyCode === 27
        ) {
            $(this).parents().find('#search-body').removeClass('open');
        }
    });
    $('.search-body .close , .wrapper').on('click', function (event) {
        $(this).parents().find('#search-body').removeClass('open');
    });

    /* extra condition for navbar submenu in responsive */
    $('.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('show');
        $(this).parent().toggleClass('show');
    });

    /* ---------- CATEGORY: BANNER ----------- */

    /* Set banner image to default image when image src is empty */
    $('.banner-box > figure > img').each(function () {
        if ($(this).attr('src') === '') {
            $(this).attr('src', './themes/images/global/banner-default.jpg');
        }
    });

    /* ---------- CATEGORY: EQUAL HEIGHT ----------- */

    /* equal height */
    $('.eqh').equalHeights();
    $('.eqh-title').equalHeights();
    $('.eqh-img').equalHeights();
    $('.eqh-desc').equalHeights();
    $('.eqh-h3').equalHeights();
    $('.eqh-h4').equalHeights();
    $('.eqh-p').equalHeights();

    /* equal height product */
    $('.eqh-card-product-box').equalHeights();
    $('.eqh-card-product').equalHeights();
    $('.eqh-card-product-img').equalHeights();
    $('.eqh-card-product-desc').equalHeights();
    $('.eqh-card-product-h3').equalHeights();
    $('.eqh-card-product-p').equalHeights();

    /* equal height news */
    $('.eqh-card-news-box').equalHeights();
    $('.eqh-card-news').equalHeights();
    $('.eqh-card-news-img').equalHeights();
    $('.eqh-card-news-desc').equalHeights();
    $('.eqh-card-news-h3').equalHeights();
    $('.eqh-card-news-p').equalHeights();

    /* ---------- CATEGORY: FILTER ----------- */

    /* Open menu filter vertical responsive */
    /* FILTER SIDEBAR PRODUCT */
    $('.button-fine-filter').on('click', function (e) {
        e.preventDefault();
        $(this).parents().find('.filter-vertical-box').toggleClass('open');
        $(this).parents().find('body').addClass('disablescrollbar');
        $(this).parents('html').toggleClass('disablescrollbar');
    });

    $('.filter-vertical-box .close').on('click', function (e) {
        e.preventDefault();
        $(this).parents().find('.filter-vertical-box').removeClass('open');
        $(this).parents().find('body').removeClass('disablescrollbar');
        $(this).parents('html').removeClass('disablescrollbar');
    });

    /* FILTER SORT PRODUCT */
    $('.button-fine-filter-sort').on('click', function (e) {
        e.preventDefault();
        $(this).parents().find('.filter-horizontal-box').toggleClass('open');
        $(this).parents().find('body').addClass('disablescrollbar');
        $(this).parents('html').toggleClass('disablescrollbar');
    });

    $('.filter-horizontal-box .close').on('click', function (e) {
        e.preventDefault();
        $(this).parents().find('.filter-horizontal-box').removeClass('open');
        $(this).parents().find('body').removeClass('disablescrollbar');
        $(this).parents('html').removeClass('disablescrollbar');
    });

    /* Show all/less in filter vertical */
    $('.list-menu .see-all').on('click', function (e) {
        e.preventDefault();
        $(this).closest('.list-menu').toggleClass('open-list');
    });

    /* ---------- CATEGORY: CART ----------- */

    /* cart quantyty input */
    const quantitiy = 0;
    $('.sn-quantity-plus').click(function (e) {
        e.preventDefault();
        $(this)
            .siblings('input')
            .val(parseInt($(this).siblings('input').val()) + 1);
    });

    $('.sn-quantity-minus').click(function (e) {
        e.preventDefault();
        if (parseInt($(this).siblings('input').val()) > 0) {
            $(this)
                .siblings('input')
                .val(parseInt($(this).siblings('input').val()) - 1);
        }
    });

    /* quick cart sidebar - open hide */
    $('.button-addtocart').on('click', function (e) {
        e.preventDefault();
        $(this).parents().find('.cart-quick-group-box').toggleClass('open');
        $(this).parents().find('body').addClass('disablescrollbar');
        $(this).parents('html').toggleClass('disablescrollbar');
    });

    $('.js-action-close-quick, .cart-quick-group-overlay').on(
        'click',
        function (e) {
            e.preventDefault();
            $(this).parents().find('.cart-quick-group-box').removeClass('open');
            $(this).parents().find('body').removeClass('disablescrollbar');
            $(this).parents('html').removeClass('disablescrollbar');
        }
    );

    /* quick cart - delete item product */
    $('.js-action-delete-quick').on('click', function (e) {
        e.preventDefault();
        $(this)
            .parents('li')
            .fadeOut(400, function () {
                $(this).remove();

                if ($('.js-cart-list-quick li').children().length === 0) {
                    $('.js-empty-quick').addClass('show');
                }
            });
    });
    if ($('.js-cart-list-quick li').children().length === 0) {
        $('.js-empty-quick').addClass('show');
    }

    if ($('.js-cart-list-simple li').children().length === 0) {
        $('.js-empty-simple').addClass('show');
    }

    /* cart - delete voucher info box */
    $('.delete-voucher-input-desc').on('click', function (e) {
        e.preventDefault();
        $(this)
            .parent('.voucher-input-desc')
            .fadeOut(400, function () {
                $(this).removeClass('show');
            });
    });

    /* dashboard address - delete item address */
    $('.delete-item-address').on('click', function (e) {
        e.preventDefault();
        $(this)
            .parents('li')
            .fadeOut(400, function () {
                $(this).remove();

                if ($('.address-list li').children().length === 0) {
                    $('.address-empty').addClass('show');
                }
            });
    });
    if ($('.address-list li').children().length === 0) {
        $('.address-empty').addClass('show');
    }

    /* dashboard - order history - cart button more */
    $('.button-product-list-more').on('click', function (e) {
        e.preventDefault();
        const thebtn = $('.button-product-list-more');
        const iam = this;

        $(this).parent().toggleClass('show');

        if ($(this).parent().hasClass('show')) {
            $(this).children().find('span').html('Tutup');
        } else {
            $(this).children().find('span').html('Lihat');
        }
    });

    /* ---------- CATEGORY: JUMP TO ----------- */
    $(".js-anchor[href^='#']").on('click', function (event) {
        event.preventDefault();
        if (this.hash !== '') {
            const { hash } = this;
            $('html,body').animate(
                { scrollTop: $(hash).offset().top - 80 },
                500
            );
        }
    });

    /* ---------- CATEGORY: DATATABLES ----------- */

    // $('#parentcollapsez').on('shown.bs.collapse', function () {
    //     $.each($.fn.dataTable.tables(true), function () {
    //         $(this).DataTable().columns.adjust().draw();
    //     });
    // });

    /* Datatable fixed */
    // $('#datatable-fixed').DataTable({
    //     scrollY: '300px',
    //     scrollX: true,
    //     scrollCollapse: true,
    //     info: false,
    //     autoWidth: false,
    //     paging: false,
    //     columnDefs: [
    //         /* { width:"200px", targets:"_all"}, */
    //         { orderable: true, className: 'reorder', targets: 0 },
    //         { orderable: false, targets: '_all' },
    //     ],
    //     fixedColumns: {
    //         leftColumns: 1,
    //         heightMatch: 'none',
    //     },
    //     /* colReorder:true,
 	// 	responsive:true,
 	// 	colReorder: {
 	// 		order: [ 4, 3, 2, 1, 0, 5, 6 ]
 	// 	} */
    // });

    /* Datatables Setia */
    // $('#datatable-2').DataTable({
    //     responsive: true,
    //     autoWidth: false,
    //     ordering: false,
    //     searching: true,
    //     paging: true,
    //     info: true,
    //     // "dom": '<"wrapper"tlipf>'
    // });

    /* Kondisi delete objek menggunakan sweet alert */

    $('.js-sa-delete').on('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure to delete this file?',
            text: 'Once deleted, you will not be able to see this file anymore!',
            icon: 'warning',
            showCancelButton: true,
            showCloseButton: true,
            allowOutsideClick: false,
            customClass: {
                container: 'swal-container-mjk',
                popup: 'swal-popup-mjk',
                header: 'swal-header-mjk',
                title: 'swal-title-mjk',
                closeButton: 'swal-close-button-mjk',
                icon: 'swal-icon-warning-mjk',
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
            if (result.isConfirmed) {
                $(this)
                    .parents()
                    .closest('.card-product-simple-box')
                    .parent('li')
                    .remove();
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    icon: 'success',
                    showConfirmButton: false,
                    // timer: 1500,
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
                });
            } else if (result.dismiss) {
                Swal.fire({
                    title: 'Cancelled!',
                    text: 'Your file is safe.',
                    icon: 'error',
                    showConfirmButton: false,
                    // timer: 1500,
                    customClass: {
                        container: 'swal-container-mjk',
                        popup: 'swal-popup-mjk',
                        header: 'swal-header-mjk',
                        title: 'swal-title-mjk',
                        closeButton: 'swal-close-button-mjk',
                        icon: 'swal-icon-cancel-mjk',
                        image: 'swal-image-mjk',
                        content: 'swal-content-mjk',
                        input: 'swal-input-mjk',
                        actions: 'swal-actions-mjk',
                        confirmButton: 'swal-confirm-button-mjk',
                        denyButton: 'swal-confirm-button-mjk',
                        cancelButton: 'swal-cancel-button-mjk',
                        footer: 'swal-footer-mjk',
                    },
                });
            }
        });
    });

    /* ---------- CREATE A MAP ----------- */

    const mapexist = document.getElementById('maps');
    const mapAltexist = document.getElementById('maps');
    if ($(mapexist, mapAltexist).length > 0) {
        /* add layer */
        const mbAttr =
            'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
        const mbUrl =
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiY29iYXBldGEiLCJhIjoiY2theHA2dnZvMGFheDJxb2Z1ZndrNmx4dSJ9.-UQVpNKVgLmjW1yW37T7ag';

        /* content popup */

        const title = '<h4>Title</h4>';
        const list =
            "<ul class''><li>lorem</li><li>lorem</li><li>lorem</li><li>lorem</li></ul>";
        const image =
            "<img src='https://cdn.pixabay.com/photo/2017/01/06/23/03/sunrise-1959227_960_720.jpg' alt='image'/>";
        const video =
            "<a class='fancybox-video preview-video' href='https://www.youtube.com/watch?v=BlGHLlG8WkE' rel=video' data-fancybox='https://www.youtube.com/watch?v=BlGHLlG8WkE' data-caption='Lorem ipsum dolor sit amet, consectetur adipisicing elit'><img class='img-fluid' src='https://i.ytimg.com/vi/BlGHLlG8WkE/maxresdefault.jpg' alt=''/></a>";
        const content1 = `<div class='leaflet-content-box'><div class='leaflet-content-text'>${title}</div><div class='leaflet-content-image'>${video}</div></div>`;
        const content2 = `<div class='leaflet-content-box'><div class='leaflet-content-text'>${title}</div><div class='leaflet-content-image'>${image}</div></div>`;
        const content3 = `<div class='leaflet-content-box'><div class='leaflet-content-text'>${title}${list}</div></div>`;

        const customOptions = {
            className: 'popupCustom',
        };

        /* multipe marker */
        const cities = L.layerGroup();

        const city1 = L.marker([-7.7380066, 110.3800078, 15])
            .bindPopup(content1, customOptions)
            .addTo(cities);
        const city2 = L.marker([-7.7341783, 110.3754673, 17])
            .bindPopup(content2, customOptions)
            .addTo(cities);
        const city3 = L.marker([-7.7337638, 110.3817063, 17])
            .bindPopup(content3, customOptions)
            .addTo(cities);

        const towns = L.layerGroup();

        const town1 = L.marker([-6.298617321152653, 106.63259151605179, 15])
            .bindPopup(content1, customOptions)
            .addTo(towns);
        const town2 = L.marker([-6.2999161551069545, 106.6362617821835, 17])
            .bindPopup(content2, customOptions)
            .addTo(towns);
        const town3 = L.marker([-6.2948055810033035, 106.62366965162217, 17])
            .bindPopup(content3, customOptions)
            .addTo(towns);

        /* custom layers */
        const streets = L.tileLayer(mbUrl, {
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr,
        });
        var satellite = L.tileLayer(mbUrl, {
            id: 'mapbox/satellite-v9',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr,
        });
        var grayscale = L.tileLayer(mbUrl, {
            id: 'mapbox/light-v9',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr,
        });

        const streets2 = L.tileLayer(mbUrl, {
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr,
        });
        var satellite = L.tileLayer(mbUrl, {
            id: 'mapbox/satellite-v9',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr,
        });
        var grayscale = L.tileLayer(mbUrl, {
            id: 'mapbox/light-v9',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr,
        });

        var maps = L.map('maps', {
            center: [-7.7337638, 110.3817063, 17],
            zoom: 16,
            layers: [streets, cities],
            scrollWheelZoom: false,
        });

        var mapsAlt = L.map('mapsAlt', {
            center: [-6.298617321152653, 106.63259151605179, 17],
            zoom: 16,
            layers: [streets2, towns],
            scrollWheelZoom: false,
        });

        const baseLayers = {
            Streets: streets,
            Satellite: satellite,
            Grayscale: grayscale,
        };

        const overlays = {
            Cities: cities,
        };

        /* add input controls */
        L.control.layers(baseLayers, overlays).addTo(maps);
        L.control.layers(baseLayers, overlays).addTo(mapsAlt);
    } else {
        var maps = null;
        var mapsAlt = null;
    }

    /* Countdown Timer */

    function getTimeRemaining(endtime) {
        const t = endtime - new Date().getTime();
        // var t = Date.parse(endtime) - Date.parse(new Date());
        // if (t<0) { return false; }
        const seconds = Math.floor((t / 1000) % 60);
        const minutes = Math.floor((t / 1000 / 60) % 60);
        const hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        const days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
            total: t,
            days,
            hours,
            minutes,
            seconds,
        };
    }
    function initializeClock(id, endtime) {
        const clock = document.getElementById(id);
        const daysClass = clock.querySelector('.days');
        const hoursClass = clock.querySelector('.hours');
        const minutesClass = clock.querySelector('.minutes');
        const secondsClass = clock.querySelector('.seconds');
        function updateClock() {
            const t = getTimeRemaining(endtime);
            if (t) {
                daysClass.innerHTML = t.days;
                hoursClass.innerHTML = `0${t.hours}`.slice(-2);
                minutesClass.innerHTML = `0${t.minutes}`.slice(-2);
                secondsClass.innerHTML = `0${t.seconds}`.slice(-2);
            } else {
                clearInterval(timeinterval);
            }
        }

        updateClock();
        var timeinterval = setInterval(updateClock, 1000);
    }

    const hasCountdown = document.getElementById('openingCountdown');

    if ($(hasCountdown).length > 0) {
        var deadline = Date.parse('Aug 30, 2021');
        initializeClock('openingCountdown', deadline);
    } else {
        var deadline = null;
    }

    /* ---------- ANIMATE ON SCROLL ---------- */

    AOS.init({
        delay: 150,
        duration: 1800,
        mirror: false,
        once: true,
    });

    /* ---------- HORIZONTAL SCROLL SLY ---------- */

    const frame = $('.scrolling-menu-mjk-frame');
    const wrap = frame.parent();

    frame.sly({
        horizontal: 1,
        itemNav: 'centered',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        startAt: 1,
        scrollBar: wrap.find('.menu-sly-scrollbar'),
        scrollBy: 1,
        speed: 300,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        dragHandle: 1,
        dynamicHandle: 1,
        clickBar: 1,
        prevPage: wrap.find('.nav-horimenu-prev'),
        nextPage: wrap.find('.nav-horimenu-next'),
    });

    $(window).on('resize', function () {
        frame.sly('reload');
    });

    $('#parentcollapsez').on('shown.bs.collapse', function () {
        const selectedTab = $(this).attr('href');
        if ($((selectedTab == '#scrollinghorizontal')).length) {
            frame.sly('reload');
        }
    });

    /* Generate PDF */

    $('#generatereport').click(function () {
        const htmlElement = document.getElementById('tablebasic');
        html2pdf(htmlElement);
    });

    $('#generatereportcards').click(function () {
        const htmlElement2 = document.getElementById('cardreports');

        const optionElement2 = {
            filename: 'contoh-pdf-2.pdf',
        };
        html2pdf(htmlElement2, optionElement2);
    });

    $('#generatereportcarts').click(function () {
        const htmlElement3 = document.getElementById('cartreports');

        const optionElement3 = {
            filename: 'contoh-pdf-3.pdf',
        };
        html2pdf(htmlElement3, optionElement3);
    });

    /* Filter Fixed */

    if (typeof($('.footer').offset()) !== "undefined") {
        $('.btn-filter-mobile-box').scrollToFixed({
            bottom: 0,
            limit: $('.footer').offset().top,
        });
    }

    /* button loading process */

    $('.btn-loading').on('click', function () {
        const button = $(this);
        const dataLoading = $(this).attr('data-loading-text');
        if ($(this).html() !== dataLoading) {
            button.data('original-text', $(this).html());
            button.html(dataLoading);
        }
        setTimeout(function () {
            button.html(button.data('original-text'));
        }, 3000);
    });
});

const container = document.getElementById('article-editor');
if(typeof(container) !== 'undefined' && container !== null){
    const toolbarOptions = [
        [{ 'font': [] }],
        ['bold', 'italic', 'underline', 'strike'],// toggled buttons
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'align': [] }],
        ['blockquote','link'],
    ];
    const quillOptions = {
        modules: {
            'toolbar': toolbarOptions,
        },
        placeholder: 'Compose an epic...',
        readOnly: false,
        theme: 'snow'
      };
    const articleEditor = new Quill(container, quillOptions);
}

/**
* Execute a function given a delay time
* 
* @param {type} func
* @param {type} wait
* @param {type} immediate
* @returns {Function}
*/
var debounce = function (func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

