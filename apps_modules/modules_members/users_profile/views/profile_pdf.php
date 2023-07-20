<html>
    <head>
        <title></title>
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
    </head>
<body>
    <table border="0" style="border-collapse: collapse;">
        <tr>
            <td width="230px" class="bg-light start align-center">
                <?php
                $INDCNX_ROOT = dirname(__DIR__, 4);
                $img = $INDCNX_ROOT. '\public\themes\user\images\placehold\user-1x1.png';

                if(!empty($users_profile->file_path) && !empty($users_profile->file_name_original)) {
                    $img = $INDCNX_ROOT. '/' . $users_profile->file_path . $users_profile->file_name_original;
                }
                // Echo out a sample image
                echo '<img src="' . $img . '" class="user-photo">';
                ?>
            </td>
            <td width="30px">

            </td>
            <td width="500px" class="start ">
                <h2 class="text-black fs-18 fw-bold"><?php echo $users_profile->name_first . ' ' . $users_profile->name_middle . ' ' . $users_profile->name_last ?></h2>
                <?php if(!empty($current_work)){
                    foreach($current_work as $value){
                        if($value['status']){
                ?>
                <span class="text-muted fs-12">Work at <?php echo $value['company']; echo ' ';?></span><br>
                <?php }}} ?>
                <?php   if(!empty($users->data_locations)){ ?>
                <span class="text-muted fs-12">From
                    <?php
                        $result = json_decode($users->data_locations);
                        foreach($result as $value){
                            echo $value->country_name;
                        }
                    ?>
                </span>
            <?php } ?><hr>
            </td>
        </tr>
        <tr >
            <td width="230px" class="bg-light ps-4">
                <span class="fs-14 fw-bold text-primary">Social Media & Link</span>
                <?php
                    if(!empty($users_profile->data_contact_website)){
                        $result = json_decode($users_profile->data_contact_website);
                        if(!empty($result)){
                            foreach($result as $value){
                                echo "<a class='fs-12 text-black' href='https://".$value->website."' target='_blank'>".$value->website."</a><br>";
                            }
                        }
                    } else {
                        echo "<span class='fs-12 text-black'>No websites and links</span><br>";
                    }

                    $result = json_decode($users_profile->data_contact_socialmedia);
                    if(!empty($result)){
                        $once = false;
                        foreach($result as $value){
                            if($once == false){

                                echo "Linkedin :<a href='https://".$value->linkedin."' target='_blank'>".$value->linkedin."</a><br>";

                                echo "Facebook :<a href='https://".$value->facebook."' target='_blank'>".$value->facebook."</a><br>";

                                echo "Instagram : <a href='https://".$value->instagram."' target='_blank'>".$value->instagram."</a><br>";
                                $once = true;
                            }
                        }
                    }
                    ?>
                    <br>
                    <?php
                    $result = json_decode($users_profile->data_contact_info);
                    if(!empty($result)){
                        echo "<h3 class='fs-14 fw-bold text-primary'>Contact Info</h3>";
                        $once = false;
                            foreach($result as $value){
                                if($once == false){

                                echo "Email :<a class='fs-12 text-black' href='mailto:".$value->email_contact."' target='_blank'>".$value->email_contact."</a><br>";
                                $once = true;
                            }
                        }
                    }
                ?>
            </td>
            <td width="30px">

            </td>
            <td width="500px">
                <?php
                if(!empty($works)){
                    echo "<span class='fs-14 fw-bold text-primary mb-2 mt-4'>Work Experience</span><br>";
                foreach($works as $value){
                ?>
                <?php echo $value['specialization'] ?><br>
                <?php echo $value['company'] ?><br>
                <?php echo $value['date_start'] ?> - <?php echo $value['date_end'] ?> . <?php echo $value['rangedate'] ?><br><br>
                <?php }} ?>
                <br>
                <?php
                if (!empty($educations)) {
                    echo "<span class='fs-14 fw-bold text-primary mb-2 mt-4'>Education</span><br>";
                foreach($educations as $value){
                ?>
                <?php echo $value['mayor'] ?><br>
                <?php echo $value['campus'] ?><br>
                <?php echo $value['date_start'] ?> - <?php echo $value['date_end'] ?> . <?php echo $value['rangedate'] ?><br><br>
                <?php }} ?>
                <br>
                <?php
                if(!empty($licenses)){
                    echo "<span class='fs-14 fw-bold text-primary mb-2 mt-4'>Licence</span><br>";
                foreach($licenses as $value){
                ?>
                <?php echo $value['study'] ?><br>
                <?php echo $value['school'] ?><br>
                <?php echo $value['date_start'] ?> - <?php echo $value['date_end'] ?> . <?php echo $value['rangedate'] ?><br><br>
                <?php }} ?>
                <br>
                <?php
                if (!empty($courses)) {
                    echo "<span class='fs-14 fw-bold text-primary mb-2 mt-4'>Course</span><br>";
                    foreach($courses as $value){
                ?>
                <?php echo $value['study'] ?><br>
                <?php echo $value['school'] ?><br>
                <?php echo $value['date_start'] ?> - <?php echo $value['date_end'] ?> . <?php echo $value['rangedate'] ?><br><br>
                <?php }} ?>
                <br>
                <?php
                if (!empty($volunteers)) {
                    echo "<span class='fs-14 fw-bold text-primary mb-2 mt-4'>Volunteer</span><br>";
                    foreach($volunteers as $value){
                ?>
                <?php echo $value['volunteer_name'] ?><br>
                <?php echo $value['date_start'] ?> - <?php echo $value['date_end'] ?> . <?php echo $value['rangedate'] ?><br><br>
                <?php }} ?>
            </td>
        </tr>
    </table>
</body>
</html>