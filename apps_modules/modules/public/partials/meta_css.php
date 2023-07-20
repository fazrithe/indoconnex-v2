
<!-- Preconnects -->
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel='preconnect' href='https://cdnjs.cloudflare.com' crossorigin>
<link rel='preconnect' href='https://cdn.jsdelivr.net' crossorigin>
<link rel='preconnect' href='https://unpkg.com' crossorigin>

<!-- begin import register css -->
<link rel="stylesheet" href="<?php echo theme_user_locations(); ?>css/styles.css"/>
<link rel="stylesheet" href="<?php echo theme_user_locations(); ?>css/public.css"/>
<!-- end import register css -->

<!-- flag country -->
<link rel="stylesheet" href="<?php echo theme_user_locations(); ?>css/countrySelect.css">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<!-- bootstrap icon -->
<link rel="stylesheet" href="<?php echo theme_user_locations(); ?>css/mdi.css"/>
<link rel="stylesheet" href="<?php echo theme_user_locations(); ?>css/tiny-slider.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" integrity="sha512-6qkvBbDyl5TDJtNJiC8foyEVuB6gxMBkrKy67XpqnIDxyvLLPJzmTjAj1dRJfNdmXWqD10VbJoeN4pOQqDwvRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- begin basic framework engine js -->
<script src="<?php echo theme_user_locations(); ?>js/app.js"></script>
<style>
		.wrapperanimate{
    width:200px;
    height:60px;
    position: absolute;
    left:50%;
    top:50%;
    transform: translate(-50%, -50%);
}
.circle{
    width:20px;
    height:20px;
    position: absolute;
    border-radius: 50%;
    background-color: #c9182d;
    left:15%;
    transform-origin: 50%;
    animation: circle .5s alternate infinite ease;
}

@keyframes circle{
    0%{
        top:60px;
        height:5px;
        border-radius: 50px 50px 25px 25px;
        transform: scaleX(1.7);
    }
    40%{
        height:20px;
        border-radius: 50%;
        transform: scaleX(1);
    }
    100%{
        top:0%;
    }
}
.circle:nth-child(2){
    left:45%;
    animation-delay: .2s;
}
.circle:nth-child(3){
    left:auto;
    right:15%;
    animation-delay: .3s;
}
.shadow{
    width:20px;
    height:4px;
    border-radius: 50%;
    background-color: rgba(0,0,0,.5);
    position: absolute;
    top:62px;
    transform-origin: 50%;
    z-index: -1;
    left:15%;
    filter: blur(1px);
    animation: shadow .5s alternate infinite ease;
}

@keyframes shadow{
    0%{
        transform: scaleX(1.5);
    }
    40%{
        transform: scaleX(1);
        opacity: .7;
    }
    100%{
        transform: scaleX(.2);
        opacity: .4;
    }
}
.shadow:nth-child(4){
    left: 45%;
    animation-delay: .2s
}
.shadow:nth-child(5){
    left:auto;
    right:15%;
    animation-delay: .3s;
}
.wrapperanimate span{
    position: absolute;
    top:75px;
    font-family: 'Lato';
    font-size: 20px;
    letter-spacing: 12px;
    color: #c9182d;
    left:15%;
}

/* X-Small devices (portrait phones, less than 576px) */
@media (min-width: 576px) {
    .hero-guest-text { 
        max-width: 100%;
    }
}

/* Small devices (landscape phones, less than 768px) */
@media (min-width: 768px) {
    .hero-guest-text { 
        max-width: 100%;
    }
}

/* Medium devices (tablets, less than 992px) */
@media (min-width: 992px) {
    .hero-guest-text { 
        max-width: 100%;
    }
}

/* Large devices (desktops, less than 1200px) */
@media (min-width: 1200px) {
    .hero-guest-text { 
        max-width: 50%;
    }
}

/* X-Large devices (large desktops, less than 1400px) */
@media (min-width: 1400px) {
    .hero-guest-text { 
        max-width: 50%;
    }
}
.loader {  
  border: 20px solid #f3f3f3;  
  position:absolute;  
  left:43%;  
  border-radius: 50%;  
  border-top: 20px solid purple;  
  width: 150px;  
  height: 150px;  
  animation: spin 2s linear infinite;  
}  
</style>
<!-- end basic framework engine js -->
