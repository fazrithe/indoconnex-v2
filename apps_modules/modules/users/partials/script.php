
<!-- end basic framework engine js -->

<!-- begin jquery extra -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- end jquery extra -->


<!-- START ADD ON / PLUGINS JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?php echo theme_user_locations(); ?>plugins/select2/dist/js/select2.min.js"></script>

<!-- fontawesom brand -->
<script src="<?php echo theme_user_locations(); ?>js/fa.js"></script>

<!-- lazyload -->
<script src="<?php echo theme_user_locations(); ?>js/lazyload.js"></script>

<script src="<?php echo theme_user_locations(); ?>js/toaster.js"></script>

<script src="<?php echo theme_user_locations(); ?>js/linker.js"></script>
<!-- datetime -->
<script src="<?php echo theme_user_locations(); ?>js/luxon.js"></script>

<!-- cropper -->
<script src="<?php echo theme_user_locations(); ?>js/exif.js"></script>
<script src="<?php echo theme_user_locations(); ?>js/croppie.js"></script>

<!-- typeahead -->
<script src="<?php echo theme_user_locations(); ?>js/jquery.typeahead.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?php echo theme_user_locations(); ?>plugins/equalize-height/src/jquery.equal-heights.js"></script>

<script src="<?php echo theme_user_locations(); ?>plugins/FitText/src/jquery.fittext.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.1/dist/sweetalert2.all.min.js"></script>

<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/3.0.0-beta.6/aos.js"></script>

<!-- begin plugin upload files -->
<script src="<?php echo theme_user_locations(); ?>js/clipboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<!-- end plugin upload files -->

<!-- begin plugin Leaflet Js -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<!-- end plugin Leaflet Js -->

<!-- begin plugin copy text -->
<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
<!-- end plugin copy text -->

<!-- begin plugin sly -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sly/1.6.1/sly.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<!-- end plugin sly -->

<script src="<?php echo theme_user_locations(); ?>plugins/scrolltofixed/jquery-scrolltofixed-min.js"></script>

<!-- chart -->
<script src="<?php echo theme_user_locations(); ?>js/chart/Chart.min.js"></script>
<!-- <script src="<?php echo theme_user_locations(); ?>js/chart/Covid.js"></script> -->

<!-- Flag -->
<script src="<?php echo theme_user_locations(); ?>js/countrySelect.js"></script>
<script>
    $("#country_selector").countrySelect({
		preferredCountries: ['au', 'id', 'us']
	});

    $("#country_selector").prop('readonly', 'readonly')
    var targetWidth = $(".country-select").width();
    $('.country-select .selected-flag').css("width", targetWidth);
    $('div.arrow').toggleClass('d-none');
</script>

<script src="<?php echo theme_user_locations(); ?>js/player.js"></script>
<script src="<?php echo theme_user_locations(); ?>js/Youtube.min.js"></script>

<!-- editor wygwys -->
<!-- <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script> -->

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<!-- END ADD ON / PLUGINS JS -->
<script>
    // Bs5Utils.defaults.toasts.position = 'bottom-right';
    // Bs5Utils.defaults.toasts.container = 'toast-container';
    // Bs5Utils.defaults.toasts.stacking = false;
    // Bs5Utils.registerStyle('indoconnex', {
    //     btnClose: ['text-muted'],
    //     main: ['bg-white',],
    //     border: []
    // });

    // const bs5Utils = new Bs5Utils();

</script>
<!-- begin basic js in local -->
<script src="<?php echo theme_user_locations(); ?>js/main.js"></script>
<script src="<?php echo theme_user_locations(); ?>js/main-form-validation.js"></script>
<script src="<?php echo theme_user_locations(); ?>js/main-chart.js"></script>
<script src="<?php echo theme_user_locations(); ?>js/main.min.js"></script>
<script src="<?php echo theme_user_locations(); ?>js/jquery.maskMoney.js"></script>
<script type="text/javascript">
    function init_mask_money(currency) {
        document.getElementById('price-num-price').value = '';
        if(currency == 'IDR'){
            $("#price-num-price").maskMoney('destroy');
            $('#price-num-price').maskMoney({
            allowNegative: false,
            thousands: '.',
            decimal: '',
            precision: '0'
            }).maskMoney('mask');
            $('#price-num-price').attr('onclick', 'this.select()');
        }else{
            $("#price-num-price").maskMoney('destroy');
            $('#price-num-price').maskMoney({
                allowNegative: false,
                thousands: ',',
                decimal: '.',
            }).maskMoney('mask');
            $('#price-num-price').attr('onclick', 'this.select()');
        }
    }

    function inputprice(){
        var inputVal = document.getElementById('price-num-price').value;
        var inputRep = inputVal.replace(/[^\w\s]/gi, '');
        document.getElementById('price-num-price_copy').value = inputRep;
    }

    function init_mask_money_jobs(currency) {
        document.getElementById('job-min-salary').value = '';
        document.getElementById('job-max-salary').value = '';
        if(currency == 'IDR'){
            //salaray min
            $("#job-min-salary").maskMoney('destroy');
            $('#job-min-salary').maskMoney({
            allowNegative: false,
            thousands: '.',
            decimal: '',
            precision: '0'
            }).maskMoney('mask');
            $('#job-max-salary').attr('onclick', 'this.select()');
            //salary max
            $("#job-max-salary").maskMoney('destroy');
            $('#job-max-salary').maskMoney({
            allowNegative: false,
            thousands: '.',
            decimal: '',
            precision: '0'
            }).maskMoney('mask');
            $('#job-max-salary').attr('onclick', 'this.select()');
        }else{
            $("#job-min-salary").maskMoney('destroy');
            $('#job-min-salary').maskMoney({
                allowNegative: false,
                thousands: ',',
                decimal: '.',
            }).maskMoney('mask');
            $('#job-min-salary').attr('onclick', 'this.select()');

            $("#job-max-salary").maskMoney('destroy');
            $('#job-max-salary').maskMoney({
                allowNegative: false,
                thousands: ',',
                decimal: '.',
            }).maskMoney('mask');
            $('#job-max-salary').attr('onclick', 'this.select()');
        }
    }

    function inputsalary_min(){
        var inputVal = document.getElementById('job-min-salary').value;
        var inputRep = inputVal.replace(/[^\w\s]/gi, '');
        document.getElementById('job-min-salary-copy').value = inputRep;
    }

    function inputsalary_max(){
        var inputVal = document.getElementById('job-max-salary').value;
        var inputRep = inputVal.replace(/[^\w\s]/gi, '');
        document.getElementById('job-max-salary-copy').value = inputRep;
    }

</script>

<!-- slick slide -->
<script src="<?php echo theme_user_locations(); ?>js/carousel.js"></script>
<script>
	$(document).ready(function() {
    	$('.js-example-basic-multiple').select2({
			allowClear: true,
			language: "id",
            // dropdownParent: $('.modal.show')
            placeholder: 'Please Select',
		});
        $('#business-create-type').select2({
			placeholder: "Please Select",
			allowClear: true,
			language: "id"
		});

        $('body').on('shown.bs.modal', '.modal', function() {
            $(this).find('.js-example-basic-multiple').each(function() {
                var dropdownParent = $(document.body);
                if ($(this).parents('.modal.show').length !== 0)
                    dropdownParent = $(this).parents('.modal.show');
                $(this).select2({
                    dropdownParent: dropdownParent,
                    allowClear: true,
	        		language: "id",
                    placeholder: 'Please Select'
                });
            });

            $(this).find('.js-businessSelector').each(function() {
                var dropdownParent = $(document.body);
                if ($(this).parents('.modal.show').length !== 0)
                    dropdownParent = $(this).parents('.modal.show');
                $(this).select2({
                    templateResult: businessFormat,
                    templateSelection: businessFormat,
					dropdownParent: dropdownParent,
                    dropdownAutoWidth: true,
                    width: '100%',
                    theme: "business",
                    placeholder: 'Search'
                });

                function businessFormat(option){
                    if (!option.id) {
                        return option.text;
                    }
                    var optimage = $(option.element).data('image');
                    if(!optimage){
                        return option.text;
                    } else {
                        var $option = $(
                            '<span><img src="' + optimage + '" width="23px" class="me-auto img-circle" /> ' + option.text + '</span>'
                        );
                    return $option;
                    }
                }
            });

			$(this).find('.company').each(function() {
				var dropdownParent = $(document.body);
				if ($(this).parents('.modal.show').length !== 0)
					dropdownParent = $(this).parents('.modal.show');
				$(this).select2({
					theme: "bootstrap5",
					dropdownParent: dropdownParent,
					placeholder: "-Select Company-",
					ajax: {
						url: '<?php echo base_url();?>user/setting/search',
						dataType: 'json',
						delay: 250,
						processResults: function (data) {
							return {
								results: data
							};
						},
						cache: true,
					},
					tags: true
				});
			});
			$(this).find('.education').each(function() {
				var dropdownParent = $(document.body);
				if ($(this).parents('.modal.show').length !== 0)
					dropdownParent = $(this).parents('.modal.show');
				$(this).select2({
					theme: "bootstrap5",
					dropdownParent: dropdownParent,
					placeholder: '-Select Education-',
					ajax: {
						url: '<?php echo base_url();?>user/setting/searcheducation',
						dataType: 'json',
						delay: 250,
						processResults: function (data) {
							return {
								results: data
							};
						},
						cache: true
					},
					tags: true
				});
			});
			$(this).find('.license').each(function() {
				var dropdownParent = $(document.body);
				if ($(this).parents('.modal.show').length !== 0)
					dropdownParent = $(this).parents('.modal.show');
				$(this).select2({
					theme: "bootstrap5",
					dropdownParent: dropdownParent,
					placeholder: '-Select License-',
					ajax: {
						url: '<?php echo base_url();?>user/setting/searchlicense',
						dataType: 'json',
						delay: 250,
						processResults: function (data) {
							return {
								results: data
							};
						},
						cache: true
					},
					tags: true
				});
			});
			$(this).find('.course').each(function() {
				var dropdownParent = $(document.body);
				if ($(this).parents('.modal.show').length !== 0)
					dropdownParent = $(this).parents('.modal.show');
				$(this).select2({
					theme: "bootstrap5",
					dropdownParent: dropdownParent,
					placeholder: '-Select Course-',
					ajax: {
						url: '<?php echo base_url();?>user/setting/searchcourse',
						dataType: 'json',
						delay: 250,
						processResults: function (data) {
							return {
								results: data
							};
						},
						cache: true
					},
					tags: true
				});
			});

			$(this).find('.hobby').each(function() {
				var dropdownParent = $(document.body);
				if ($(this).parents('.modal.show').length !== 0)
					dropdownParent = $(this).parents('.modal.show');
				$(this).select2({
                    theme: "bootstrap5",
                    placeholder: '-Select Hobby-',
					dropdownParent: dropdownParent,
                    ajax: {
                        url: '<?php echo base_url();?>user/setting/searchhobby',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    },
                    tags: true
                });
			});
			$(this).find('.skill').each(function() {
				var dropdownParent = $(document.body);
				if ($(this).parents('.modal.show').length !== 0)
					dropdownParent = $(this).parents('.modal.show');
				$(this).select2({
                    theme: "bootstrap5",
                    placeholder: '-Select Skill-',
					dropdownParent: dropdownParent,
                    ajax: {
                        url: '<?php echo base_url();?>user/setting/searchskill',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    },
                    tags: true
                });
			});
			$(this).find('.community-category').each(function() {
				var dropdownParent = $(document.body);
				if ($(this).parents('.modal.show').length !== 0)
					dropdownParent = $(this).parents('.modal.show');
                $(this).select2({
                    theme: "bootstrap5",
                    placeholder: '-Select Category-',
					dropdownParent: dropdownParent,
                    ajax: {
                        url: '<?php echo base_url();?>community/categories/all',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    },
                    tags: true
                });
			});
        });
	});
</script>
<script>
    $('.company').select2({
		theme: "bootstrap5",
        placeholder: '-Select Company-',
        ajax: {
            url: '<?php echo base_url();?>user/setting/search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
		tags: true
    });
	$('.education').select2({
		theme: "bootstrap5",
        placeholder: '-Select Education-',
        ajax: {
            url: '<?php echo base_url();?>user/setting/searcheducation',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
		tags: true
    });
	$('.license').select2({
		theme: "bootstrap5",
        placeholder: '-Select License-',
        ajax: {
            url: '<?php echo base_url();?>user/setting/searchlicense',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
		tags: true
    });
	$('.course').select2({
		theme: "bootstrap5",
        placeholder: '-Select Course-',
        ajax: {
            url: '<?php echo base_url();?>user/setting/searchcourse',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
		tags: true
    });
	$('.article-category').select2({
		theme: "bootstrap5",
        placeholder: '-Select Category-',
        ajax: {
            url: '<?php echo base_url();?>articles/categories/all',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
		tags: true
	});
	$('.community-category').select2({
		theme: "bootstrap5",
        placeholder: '-Select Category-',
        ajax: {
            url: '<?php echo base_url();?>community/categories/all',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
		tags: true
	});
    $('.hobby').select2({
        theme: "bootstrap5",
        placeholder: '-Select Hobby-',
        ajax: {
            url: '<?php echo base_url();?>user/setting/searchhobby',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        tags: true
    });

    $('.skill').select2({
        theme: "bootstrap5",
        placeholder: '-Select Skill-',
        ajax: {
            url: '<?php echo base_url();?>user/setting/searchskill',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        tags: true
    });
</script>
<script>
    // $editor = document.getElementById('editor');
    // if($editor !== 'undefined' && $editor !== null){
    //     var quill = new Quill('#editor', {
    //         modules: {
    //             toolbar: [
    //                 ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    //                 ['blockquote', 'code-block', 'link'],

    //                 [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    //                 [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    //                 [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
    //                 [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
    //                 [{ 'direction': 'rtl' }],                         // text direction

    //                 [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
    //                 [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

    //                 [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    //                 [{ 'font': [] }],
    //                 [{ 'align': [] }],

    //                 ['clean'],                                         // remove formatting button
    //             ]
    //         },
    //         placeholder: 'Compose an epic...',
    //         theme: 'snow'
    //     });
    //     quill.on('text-change', function(delta, oldDelta, source) {
    //         document.getElementById("contents").value = quill.root.innerHTML;
    //     });
    // }

    $('#summernote').summernote({
        // callbacks: {
        //     onPaste: function (e) {
        //         if (document.queryCommandSupported("insertText")) {
        //             var text = $(e.currentTarget).html();
        //             var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

        //             setTimeout(function () {
        //                 document.execCommand('insertText', false, bufferText);
        //             }, 10);
        //             e.preventDefault();
        //         } else { //IE
        //             var text = window.clipboardData.getData("text")
        //             if (trap) {
        //                 trap = false;
        //             } else {
        //                 trap = true;
        //                 setTimeout(function () {
        //                     document.execCommand('paste', false, text);
        //                 }, 10);
        //                 e.preventDefault();
        //             }
        //         }

        //     }
        // },
        // placeholder: 'Write your content here',
        tabsize: 2,
        height: 300,
        toolbar: [
          ['style', ['style']],
        //   ['fontsize', ['fontsize']],
          ['font', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
        //   ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
        //   ['insert', ['link', 'picture', 'video']],
          ['insert', ['link', 'video']],
        //   ['insert', ['link']],
            ['height', ['height']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    jQuery('i.note-recent-color').each(function(){
        jQuery(this).attr('style','background-color: transparent;');
    });

	$.ajax({
		url: "https://geolocation-db.com/jsonp",
		jsonpCallback: "callback",
		dataType: "jsonp",
		success: function( location ) {
			weather(location.city);
			document.getElementById('city-name').innerHTML = location.city;
			document.getElementById('country-name').innerHTML = location.country_name;
		}
	});
function weather(city){
const api_url = 
		"https://api.weatherapi.com/v1/current.json?key=7433957386ca40f887395321213012&q="+city+"&aqi=no";
        // "https://api.openweathermap.org/data/2.5/weather?q="+city+"&appid=c5e475d96e3198fb65ae19a77252259f";
        
        fetch(api_url)
        .then((resp) => resp.json())
        .then(function(data) {
        document.getElementById('clouds').innerHTML= (Math.round(data.current.temp_c * 100) / 100).toLocaleString();
		$('#clouds-img').attr('src', ''+data.current.condition.icon);
        })
        .catch(function(error) {
        console.log(error);
        });
}

const api_url_currency_usd = 
        "https://exchange-rates.abstractapi.com/v1/live?api_key=8ac7e47fa3674a89a34520b008ca7fa7&base=USD&target=IDR";
        
        fetch(api_url_currency_usd)
        .then((resp) => resp.json())
        .then(function(data) {
		document.getElementById('currency-usd').innerHTML= (Math.round(data.exchange_rates.IDR * 100) / 100).toLocaleString();
        })
        .catch(function(error) {
        console.log(error);
        });

const api_url_currency_aud = 
        "https://exchange-rates.abstractapi.com/v1/live?api_key=582eafeb050f45e4bfc58a864e7a4bc9&base=AUD&target=IDR";
        
        fetch(api_url_currency_aud)
        .then((resp) => resp.json())
        .then(function(data) {
			console.log(data);
		document.getElementById('currency-aud').innerHTML= (Math.round(data.exchange_rates.IDR * 100) / 100).toLocaleString();
        })
        .catch(function(error) {
        console.log(error);
        });


    $(document).ready(function(){
      $(".wrapperanimate").delay(1000).fadeOut();
    })
	
</script>
<script>
			$(document).ready(function(){
                $.ajax({
                    url     : '<?php echo base_url();?>user/session/online',
                    dataType: 'html',
                    type    : 'GET',
                    success : function(data){
                        console.log("Session success");
                    }
                });
            });
			$(window).on('unload', function () {
                jQuery.ajax({
					url     : '<?php echo base_url();?>user/session/offline',
                    dataType: 'html',
                    type    : 'GET',
                    success : function(data){
						console.log("Session success");
                    }
                });
            });
         
</script>
