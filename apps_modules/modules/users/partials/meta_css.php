
<!-- Preconnects -->
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel='preconnect' href='https://cdnjs.cloudflare.com' crossorigin>
<link rel='preconnect' href='https://cdn.jsdelivr.net' crossorigin>
<link rel='preconnect' href='https://unpkg.com' crossorigin>
<link rel='preconnect' href='https://cdn.datatables.net' crossorigin>

<!-- begin import register css -->
<link rel="stylesheet" href="<?php echo theme_user_locations(); ?>css/styles.css"/>
<!-- end import register css -->

<!-- flag country -->
<link rel="stylesheet" href="<?php echo theme_user_locations(); ?>css/countrySelect.css">

<link rel="stylesheet" href="<?php echo theme_user_locations(); ?>css/tiny-slider.css">

<link rel="stylesheet" href="<?php echo theme_user_locations(); ?>css/croppie.css">

<link rel="stylesheet" href="<?php echo theme_user_locations(); ?>css/typeahead.css">

<link rel="stylesheet" href="<?php echo theme_user_locations(); ?>css/vjs.css">

<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<!-- bootstrap icon -->
<link rel="stylesheet" href="<?php echo theme_user_locations(); ?>css/mdi.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" integrity="sha512-6qkvBbDyl5TDJtNJiC8foyEVuB6gxMBkrKy67XpqnIDxyvLLPJzmTjAj1dRJfNdmXWqD10VbJoeN4pOQqDwvRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- <link href="<?php echo theme_user_locations(); ?>css/editor.css" rel="stylesheet"> -->

<link rel="stylesheet" type="text/css" href="<?php echo theme_user_locations(); ?>js/chart/Chart.min.css">
<!-- begin basic framework engine js -->
<script src="<?php echo theme_user_locations(); ?>js/app.js"></script>
<!-- slick slide -->
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<style>
    .slick-prev:before,
    .slick-next:before {
      color: black;
    }

  /* The message box is shown when the user clicks on the password field */
  #message {
    display:none;
    background: #f1f1f1;
    color: #000;
    position: relative;
  }

  #message p {
    font-size: 14px;
  }

  /* Add a green text color and a checkmark when the requirements are right */
  .valid {
    color: green;
  }

  .valid:before {
    position: relative;
    left: -35px;
  }

  /* Add a red text color and an "x" icon when the requirements are wrong */
  .invalid {
    color: red;
  }

  .invalid:before {
    position: relative;
    left: -35px;
  }

  /* Mobile View HORIZONTAL SCROLLBAR */
  .custom-horizontal-scrollbar {
    color: #303030;
    display: flex;
    flex-wrap: nowrap;
    overflow-x:scroll;
    overflow-y:hidden;
    /* Firefox */
    scrollbar-width: 0px;
    scrollbar-width: none;
  }
  /* Chrome */
  .custom-horizontal-scrollbar::-webkit-scrollbar {
    display: block;
    height: 0px;
  } 
  .custom-horizontal-scrollbar::-webkit-scrollbar-thumb {
    background-color: #000000;
    height:10px;
  }
  .custom-horizontal-scrollbar::-webkit-scrollbar-track {
    background-color: #ee0202;
    height:10px;
  }

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

.status-circle {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background-color: grey;
  border: 2px solid white;
  bottom: 0;
  right: 0;
  position: absolute;
}

.image_outer_container{
  margin-top: auto;
  margin-bottom: auto;
  border-radius: 50%;
  position: relative;
}

.image_inner_container img{
  height: 50px;
  width: 50px;
  border-radius: 50%;
  border: 5px solid white;
}

.image_outer_container .green_icon{ 
  position: absolute;
  right: 2px;
  bottom: 2px;
  height: 15px;
  width: 15px;
	border: 2px solid white;
  border-radius: 50%;
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

/* Live Search */
.container--narrow {
  max-width: 732px;
}

.avatar-tiny {
  width: 24px;
  height: 24px;
  border-radius: 12px;
  margin-right: 4px;
  position: relative;
  top: -1px;
}


</style>
