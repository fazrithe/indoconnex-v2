<html>
    <head>
        <title></title>
    </head>
    <style>
        .text-black {
            color: #303030;
        }
        .text-muted {
            color: #6C6C6C;
        }
        .text-primary {
            color: #00355E;
        }
        .bg-light {
            background-color: #F2F4F8;
        }
        .fs-12 {
            font-size: 12px;
        }
        .fs-18 {
            font-size: 18px;
        }
        .fw-bold {
            font-weight: bold;
        }
        .fw-semi {
            font-weight: 600;
        }
        body {
            padding: 0px;
            margin: 0px;
        }
        .start {
            padding-top: 60px;
        }
        .align-center {
        }
        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }
        .ms-3 {
            margin-left: 15px;
        }
        .mb-2 {
            margin-bottom: 10px;
        }
        .mb-3 {
            margin-bottom: 15px;
        }
        .mt-4 {
            margin-bottom: 20px;
        }
        .ms-4 {
            margin-left: 20px;
        }
        .ps-4 {
            padding-left:20px;
        }
        hr {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .align-center {
            text-align: center;
        }

        .user-photo {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
<body>
<div class="container">
  <div class="row">
    <div class="col">
        <table border="0" style="border-collapse: collapse;">
            <tr>
                <td width="230px" class="bg-light start align-center">
                    <?php
                    $INDCNX_ROOT = dirname(__DIR__, 4);
                    $img = $INDCNX_ROOT. '\public\themes\user\images\placehold\user-1x1.png';

                    if(!empty($business->file_path) && !empty($business->file_name_original)) {
                        $img = $INDCNX_ROOT. '/' . $business->file_path . $business->file_name_original;
                    }
                    // Echo out a sample image
                    echo '<img src="' . $img . '" class="user-photo">';
                    ?>
                </td>
                <td width="30px">

                </td>
                <td width="500px" class="start ">
                    <span class="text-black fs-18 fw-bold"><?php echo $business->data_name ?></span>
                </td>
            </tr>
            <tr>
                <td width="230px" class="bg-light ps-4">
                <span class="fs-14 fw-bold text-primary">Contact Us</span>
                <p class='fs-12 text-black'>Email : <?php echo $business->bd_email ?></p>
                <p class='fs-12 text-black'>Telp. : <?php echo $business->bd_phone ?></p>
                </td>
                <td width="30px">

                </td>
                <td width="500px">
                <?php if(!empty($business->data_description)){ ?>
                <span class="fs-14 fw-bold text-primary">General Information</span>
                <span class='fs-12 text-black fw-semi'>About</span>
                <p class='fs-12 text-black'><?php echo $business->data_description ?></p>
                <?php } ?>
                <!-- <span class='fs-12 text-black fw-semi'>Business Type</span> -->
                <!-- <p></p> -->
                <?php if(!empty($business->bd_address)){ ?>
                <span class='fs-12 text-black fw-semi'>Address</span>
                <p><?php echo $business->bd_address ?></p>
                <?php } ?>
                <?php if(!empty($business->bd_address_zipcode)){ ?>
                <span class='fs-12 text-black fw-semi'>Post Code</span>
                <p class='fs-12 text-black'><?php echo $business->bd_address_zipcode ?></p>
                <?php } ?>
                <?php
                    if(!empty($value->data_locations)){
                    $locations =  json_decode($business->data_locations);
                        foreach($locations as $valuelocation){
                ?>
                <span class='fs-12 text-black fw-semi'>City</span>
                <p class='fs-12 text-black'><?php echo $valuelocation->city_name ?></p>
                <span class='fs-12 text-black fw-semi'>Country</span>
                <p class='fs-12 text-black'><?php echo $valuelocation->country_name ?></p>
                <?php }} ?>
                <?php if(!empty($business->bd_email)){ ?>
                <span class='fs-12 text-black fw-semi'>Email</span>
                <p class='fs-12 text-black'><?php echo $business->bd_email ?></p>
                <?php } ?>
                <?php if(!empty($business->bd_phone)){ ?>
                <span class='fs-12 text-black fw-semi'>Phone Number</span>
                <p class='fs-12 text-black'><?php echo $business->bd_phone ?></p>
                <?php } ?>
                    <?php
                    if($business->bd_hours_work == []){
                        echo "<span>Working Hour</span>";
                    $hours = json_decode($business->bd_hours_work);
                            foreach($hours as $key => $val){
                                foreach($val as $key1 => $val1){
                    ?>
                    <p><?php echo $key1 ?> <?php echo $val1->start ?> - <?php echo $val1->end ?> PM</p>
                    <?php  }}} ?>
                <?php foreach($facilities as $value){
                        if($business->data_facilities){
                            echo "<span class='fs-12 text-black fw-semi'>Facility</span>";
                            $result = json_decode($business->data_facilities);
                                foreach($result as $value_old){
                                    if($value_old== $value->id){
                                        echo "<p class='fs-12 text-black'> $value->data_name </p> </br>";
                                    }
                                }
                            }
                        }
                    ?>
                <?php if(!empty($business->bd_paymentmethod)){ ?>
                <span class='fs-12 text-black fw-semi'>Payment Method</span>
                <p class='fs-12 text-black'><?php echo $business->bd_paymentmethod ?></p>
                <?php } ?>
                </td>
            </tr>
        </table>
    </div>
  </div>
</div>
</body>
</html>