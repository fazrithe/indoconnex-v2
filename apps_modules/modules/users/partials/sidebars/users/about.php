<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
<div class="col-md-3 d-none d-md-block">
    <div class="mb-4 p-4 rounded-3 msn-widget">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        <b>Hobby</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <div class="list-group mb-4">
                            <?php
                                foreach($list_hobby as $value){
                                    echo "<div  class='rounded-pill bg-light text-black p-2 m-2 align-items-center d-flex hobby-pill'> "
                                    .$value['name'] ?>
                                    <?php 
                                    if(!empty($checkusers_profile)) {
                                    echo
                                    "<a href='".base_url('user/profile/delete_hobby/'.$users->id.'/'.$value['hobby_id'].'/about')."' class='text-black close ms-auto'>&times;</a></div>";
                                    }else{
                                        echo "<a href='".base_url('user/profile/delete_hobby/'.$users->id.'/'.$value['hobby_id'].'/about')."' class=''>&times;</a></div>";
                                    }
                                }
                            ?>
                        </div>
                        <?php if(!empty($checkusers_profile)){ ?>
                        <a class="d-flex btn btn-danger btn-md align-self-center" href="#hobby" role="button" aria-expanded="false" aria-controls="hobby" data-bs-toggle="modal" data-bs-target="#modalHobbyabout">
                            + Add Hobby
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseTwo">
                        <b>Skill</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        <div class="list-group mb-4">
                            <?php
                                foreach($list_skill as $value){
                                    echo "<div class='rounded-pill bg-light text-black p-2 m-2 align-items-center d-flex hobby-pill'>"
                                    .$value['name']
                                    ?>
                                    <?php 
                                    if(!empty($checkusers_profile)) {
                                    echo
                                    "<a href='".base_url('user/profile/delete_skill/'.$users->id.'/'.$value['skill_id'].'/about')."' class='text-black close ms-auto'>&times;</a></div>";
                                }else{
                                    echo
                                    "<a href='".base_url('user/profile/delete_skill/'.$users->id.'/'.$value['skill_id'].'/about')."' class=''></a></div>";
                                }
                            }
                            ?>
                        </div>
                        <?php if(!empty($checkusers_profile)){ ?>
                        <a class="d-flex btn btn-danger btn-md align-self-center" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" data-bs-toggle="modal" data-bs-target="#modalSkillabout">
                        + Add Skill
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="d-flex d-md-none offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebar">
    <div class="offcanvas-header d-flex justify-content-evenly mb-3">
		<div class="d-flex flex-shrink-0 ms-auto text-right">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
    </div>
    <div class="offcanvas-body">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        <b>Hobby</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <div class="list-group mb-4">
                            <?php
                                foreach($list_hobby as $value){
                                    echo "<span class='rounded-pill bg-light text-black p-2 m-2 align-items-center d-flex hobby-pill'> "
                                    .$value['name']. "</span>"
                                    ?>
                                    <?php 
                                    if(!empty($checkusers_profile)) {
                                    echo
                                    "<a href='".base_url('user/profile/delete_hobby/'.$users->id.'/'.$value['hobby_id'].'/about')."' class='text-black close ms-auto'>&times;</a></span>";
                                }
                            }
                            ?>
                        </div>
                        <?php if(!empty($checkusers_profile)){ ?>
                        <a class="d-flex btn btn-danger btn-md align-self-center" href="#hobby" role="button" aria-expanded="false" aria-controls="hobby" data-bs-toggle="modal" data-bs-target="#modalHobbyabout">
                            + Add Hobby
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseTwo">
                        <b>Skill</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        <div class="list-group mb-4">
                            <?php
                                foreach($list_skill as $value){
                                    echo "<div class='rounded-pill bg-light text-black p-2 m-2 align-items-center d-flex hobby-pill'>"
                                    .$value['name']. "</span>"
                                    ?>
                                    <?php 
                                    if(!empty($checkusers_profile)) {
                                    echo
                                    "<a href='".base_url('user/profile/delete_skill/'.$users->id.'/'.$value['skill_id'].'/about')."' class='text-black close ms-auto'>&times;</a></div>";
                                }}
                            ?>
                        </div>
                        <?php if(!empty($checkusers_profile)){ ?>
                        <a class="d-flex btn btn-danger btn-md align-self-center" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" data-bs-toggle="modal" data-bs-target="#modalSkillabout">
                        + Add Skill
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 d-grid">
            <button type="button" class="btn btn-danger btn-lg">Follow</button>
        </div>
    </div>
</nav>
<?php $this->load->view($template['action_ajax_connection']); ?>
