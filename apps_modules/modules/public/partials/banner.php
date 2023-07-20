<!-- banner -->
<div class="bg-image d-flex hero-guest mt-4" id="particles-js" style="
	background-image: url('<?php if(!empty($banner->file_path)){ echo base_url() . $banner->file_path . $banner->file_name_original; }?>');
	background-size: cover;
	  background-repeat: no-repeat;
  "
>
<div class="container" style="padding-left: 5%; padding-top: 5%">
	<div class="row">
		<div class="col-12 text-<?php if(!empty($banner->data_align)){ if($banner->data_align == 'right'){ echo "end";}else{ echo $banner->data_align; }} ?>">
			<h4 class="text-white typewrite"  data-period="2000" data-type='[ "<?php if(!empty($banner->data_name)){ echo $banner->data_name; }?>", "<?php if(!empty($banner->data_name)){ echo $banner->data_name; }?>"]'><?php if(!empty($banner->data_name)){ echo $banner->data_name; }?></h4>
			<h2 class="text-white"><?php if(!empty($banner->data_name_sub)){echo $banner->data_name_sub; }?></h2>
			<p class="text-white fst-italic"><?php if(!empty($banner->data_name)){ echo $banner->data_description; }?>
			</p>
		</div>
	</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/1.1.1/typed.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
<script>
	var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };

</script>
<script>
	if (screen && screen.width > 780) {
  		document.write('<script type="text/javascript" src="<?php echo theme_user_locations(); ?>plugins/particles-js/particles.js"><\/script>');
		  document.write('<script type="text/javascript" src="<?php echo theme_user_locations(); ?>plugins/particles-js/demo/js/app.js"><\/script>');
	}
</script>
