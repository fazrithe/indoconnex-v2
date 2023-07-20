<!-- Modal -->

<div class="modal fade" id="modalExperience" role="dialog" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="Lable">Add Work Experience</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

            </button>
        </div>
        <form action="<?php echo base_url('user/profile/add_work/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
        <?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
        <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
        <input type="hidden" name="id" value="<?php echo $users->id ?>" />
        <input type="hidden" name="form" value="profile/setting" />
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Company</label><br>
                <select name="company" class="form-select company">
                <option>Add Company</option>
                <?php if(!empty($data_work_experiences)){
					foreach($data_work_experiences as $value){ ?>
                <option value="<?php echo $value->id ?>"><?php echo $value->data_name ?></option>
                <?php }} ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Specialization</label>
                <input tyle="text" name="specialization" class="form-control" placeholder="Programmer" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Join Date</label>
                <div class="hstack d-flex">
                    <input type="text" name="date_start" id="datepicker" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                    <label class="mx-2">to</label>
                    <input type="text" name="date_end" id="datepicker2" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="current" class="form-check-input current">
                    <label class="form-check-label" for="current1">I currently work here</label>
                </div>
            </div>
        </div>
        <div class="modal-footer border-top">
        <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-danger" value="Save">
        </div>
        </form>
        </div>
    </div>
</div>

    <div class="modal fade" id="modalExperienceabout" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Add Work Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
            <form action="<?php echo base_url('user/profile/add_work/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="form" value="about" />
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Company</label><br>
                    <select name="company" class="form-select company">
                    <?php if(!empty($data_work_experiences)){
						foreach($data_work_experiences as $value){ ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->data_name ?></option>
                    <?php }} ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Specialization</label>
                    <input tyle="text" name="specialization" class="form-control" placeholder="Programmer" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Join Date</label>
                    <div class="hstack d-flex">
                        <input type="text" name="date_start" id="datepicker5" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        <label class="mx-2">to</label>
                        <input type="text" name="date_end" id="datepicker6" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                    </div>
                </div>
                <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="current" class="form-check-input current" id="current2">
                    <label class="form-check-label" for="current2">I currently work here</label>
                </div>
                </div>
            </div>
            <div class="modal-footer border-top">
            <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Save">
            </div>
            </form>
            </div>
        </div>
    </div>

    <?php
	if(!empty($works)) {
    foreach($works as $value){
        $experience_id  = $value['id'];
        $sp             = $value['specialization'];
        $date_start     = $value['date_start'];
        $date_end       = $value['date_end'];
        $status         = $value['status'];
    ?>
    <div class="modal fade" id="modal_edit_experience<?php echo $experience_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Edit Work Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/edit_work/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="experience_id" value="<?php echo $experience_id?>" />
            <input type="hidden" name="form" value="profile/setting" />
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Specialization</label>
                    <input tyle="text" name="specialization" value="<?php echo $sp ?>" class="form-control" placeholder="Programmer" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Join Date</label>
                    <div class="hstack d-flex">
                        <input type="text" name="date_start" value="<?php echo $date_start ?>" id="datepicker3" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        <label class="mx-2">to</label>
                        <input type="text" name="date_end" value="<?php echo $date_end ?>" id="datepicker4" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                    </div>
                </div>
                <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="current" class="form-check-input current" id="current3" <?php echo ($status == 1 ? ' checked' : ''); ?>>
                    <label class="form-check-label" for="current3">I currently work here</label>
                </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Update">
            </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit_experience_about<?php echo $experience_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Edit Work Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/edit_work/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="experience_id" value="<?php echo $experience_id?>" />
            <input type="hidden" name="form" value="about" />
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Specialization</label>
                    <input tyle="text" name="specialization" value="<?php echo $sp ?>" class="form-control" placeholder="Programmer" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Join Date <?php echo $status ?></label>
                    <div class="hstack d-flex">
                        <input type="text" name="date_start" value="<?php echo $date_start ?>" id="datepicker7" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        <label class="mx-2">to</label>
                        <input type="text" name="date_end" value="<?php echo $date_end ?>" id="datepicker8" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                    </div>
                </div>
                <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" name="current" class="form-check-input current" id="current4" <?php echo ($status == 1 ? ' checked' : ''); ?>>
                    <label class="form-check-label" for="current4">I currently work here</label>
                </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Update">
            </div>
            </form>
            </div>
        </div>
    </div>
    <?php }} ?>

    <?php
	if(!empty($works)) {
    foreach($works as $value){
        $experience_id  = $value['id'];
        $company_name   = $value['company'];
    ?>
    <div class="modal fade" id="modal_delete_experience<?php echo $experience_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
					<h3 class="modal-title" id="myModalLabel">Delete Work Experience</h3>
				</div>
				<form action="<?php echo base_url('user/profile/delete_work/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="form" value="profile/setting" />
					<div class="modal-body">
						<p>Are you sure you want to delete <b><?php echo $company_name;?></b></p>
					</div>
					<div class="modal-footer border-top">
						<input type="hidden" name="experience_id" value="<?php echo $experience_id;?>">
						<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
						<button class="btn btn-danger">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <div class="modal fade" id="modal_delete_experience_about<?php echo $experience_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="Lable">Delete Work Experience</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

					</button>
				</div>
				<form action="<?php echo base_url('user/profile/delete_work/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="form" value="about" />
					<div class="modal-body">
						<p>Are you sure you want to delete <b><?php echo $company_name;?></b></p>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="experience_id" value="<?php echo $experience_id;?>">
						<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
						<button class="btn btn-danger">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php }} ?>

	<div class="modal fade" id="modalHobby" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Add Hobby</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="<?php echo base_url('user/profile/add_hobby/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="form" value="profile/setting" />
            <div class="modal-body">
                <div class="mb-3">
                <select class="hobby w-100 form-select" name="hobbies[]" multiple="multiple" required></select>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Save">
            </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalHobbyprofile" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Add Hobby</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/add_hobby/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="form" value="profile/post" />
            <div class="modal-body">
                <div class="mb-3">
                <select class="hobby w-100 form-select" name="hobbies[]" multiple="multiple">
                    <?php
					if(!empty($hobby)){
						foreach($hobby as $value){
                        	echo "<option value='$value->id'>$value->data_name</option>";
                        }
					}
                    ?>
                </select>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Save">
            </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalHobbyabout" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Add Hobby</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/add_hobby/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="form" value="about" />
            <div class="modal-body">
                <div class="mb-3">
                <select class="hobby w-100 form-select" name="hobbies[]" multiple="multiple">
                    <?php
					if(!empty($hobby)){
						foreach($hobby as $value){
                            echo "<option value='$value->id'>$value->data_name</option>";
                        }
					}
                    ?>
                </select>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Save">
            </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSkill" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="Lable">Add Skill</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

					</button>
				</div>
				<form action="<?php echo base_url('user/profile/add_skill/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="form" value="profile/setting" />
				<div class="modal-body">
					<div class="mb-3">
					<select class="skill w-100 form-select" name="skills[]" multiple="multiple">
						<?php
						if(!empty($skill)){
							foreach($skill as $value){
								echo "<option value='$value->id'>$value->data_name</option>";
							}
						}
						?>
					</select>
					</div>

				</div>
				<div class="modal-footer border-top">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
					<input type="submit" class="btn btn-danger" value="Save">
				</div>
				</form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSkillprofile" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="Lable">Add Skill</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

					</button>
				</div>
				<form action="<?php echo base_url('user/profile/add_skill/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="form" value="profile/post" />
				<div class="modal-body">
					<div class="mb-3">
					<select class="skill w-100 form-select" name="skills[]" multiple="multiple">
						<?php
						if(!empty($skill)){
							foreach($skill as $value){
								echo "<option value='$value->id'>$value->data_name</option>";
							}
						}
						?>
					</select>
					</div>
				</div>
				<div class="modal-footer border-top">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancssel</button>
					<input type="submit" class="btn btn-danger" value="Save">
				</div>
				</form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSkillabout" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="Lable">Add Skill</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

					</button>
				</div>
				<form action="<?php echo base_url('user/profile/add_skill/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="form" value="about" />
				<div class="modal-body">
					<div class="mb-3">
					<select class="skill w-100 form-select" name="skills[]" multiple="multiple">
						<?php
						if(!empty($skill)){
							foreach($skill as $value){
								echo "<option value='$value->id'>$value->data_name</option>";
							}
						}
						?>
					</select>
					</div>
				</div>
				<div class="modal-footer border-top">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
					<input type="submit" class="btn btn-danger" value="Save">
				</div>
				</form>
            </div>
        </div>
    </div>

    <!-- //Education -->
    <div class="modal fade" id="modalEducation" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="Lable">Add Education</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

					</button>
				</div>
				<form action="<?php echo base_url('user/profile/add_education/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="form" value="profile/setting" />
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Campus</label><br>
						<select name="campus" class="form-select education w-100">
						<?php if(!empty($data_educations)){
							foreach($data_educations as $value){ ?>
							<option value="<?php echo $value->id ?>"><?php echo $value->data_name ?></option>
						<?php }} ?>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Mayor</label>
						<input tyle="text" name="mayor" class="form-control" placeholder="Teknik Informatika" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Sign Date</label>
                        <div class="hstack d-flex">
                        <input type="text" name="date_start" id="datepicker9" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        <label class="mx-2">to</label>
                        <input type="text" name="date_end" id="datepicker10" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        </div>
					</div>
				</div>
				<div class="modal-footer border-top">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
					<input type="submit" class="btn btn-danger" value="Save">
				</div>
				</form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEducationabout" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="Lable">Add Education</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

					</button>
				</div>
				<form action="<?php echo base_url('user/profile/add_education/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
					<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
					<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
					<input type="hidden" name="id" value="<?php echo $users->id ?>" />
					<input type="hidden" name="form" value="about" />
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label">Campus</label><br>
							<select name="campus" class="form-select education">
							<?php if(!empty($data_educations)){
								foreach($data_educations as $value){ ?>
							<option value="<?php echo $value->id ?>"><?php echo $value->data_name ?></option>
							<?php }} ?>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Mayor</label>
							<input tyle="text" name="mayor" class="form-control" placeholder="Teknik Informatika" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Sign Date</label>
                            <div class="hstack d-flex">
                            <input type="text" name="date_start" id="datepicker13" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                            <label class="mx-2">to</label>
                            <input type="text" name="date_end" id="datepicker14" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                            </div>
						</div>
					</div>
					<div class="modal-footer border-top">
						<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
						<input type="submit" class="btn btn-danger" value="Save">
					</div>
				</form>
            </div>
        </div>
    </div>

    <?php
	if(!empty($educations)) {
    foreach($educations as $value){
        $education_id   = $value['id'];
        $mayor          = $value['mayor'];
        $date_start     = $value['date_start'];
        $date_end       = $value['date_end'];
    ?>
    <div class="modal fade" id="modal_edit_education<?php echo $education_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="Lable">Edit Education</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

					</button>
				</div>
				<form action="<?php echo base_url('user/profile/edit_education/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
					<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
					<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
					<input type="hidden" name="id" value="<?php echo $users->id ?>" />
					<input type="hidden" name="education_id" value="<?php echo $education_id?>" />
					<input type="hidden" name="form" value="profile/setting" />
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label">Mayor</label>
							<input tyle="text" name="mayor" value="<?php echo $mayor ?>" class="form-control" placeholder="Programmer" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Sign Date</label>
                            <div class="hstack d-flex">
                            <input type="text" name="date_start" value="<?php echo $date_start ?>" id="datepicker11" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                            <label class="mx-2">to</label>
                            <input type="text" name="date_end" value="<?php echo $date_end ?>" id="datepicker12" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                            </div>
						</div>
					</div>
					<div class="modal-footer border-top">
						<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
						<input type="submit" class="btn btn-danger" value="Update">
					</div>
				</form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit_education_about<?php echo $education_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Edit Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/edit_education/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="education_id" value="<?php echo $education_id?>" />
            <input type="hidden" name="form" value="about" />
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Mayor</label>
                    <input tyle="text" name="mayor" value="<?php echo $mayor ?>" class="form-control" placeholder="Programmer" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sign Date</label>
                    <div class="hstack d-flex">
                        <input type="text" name="date_start" value="<?php echo $date_start ?>" id="datepicker31" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        <label class="mx-2">to</label>
                        <input type="text" name="date_end" value="<?php echo $date_end ?>" id="datepicker32" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Update">
            </div>
            </form>
            </div>
        </div>
    </div>
    <?php }} ?>

    <?php
	if(!empty($educations)) {
    foreach($educations as $value){
        $education_id       = $value['id'];
        $campus_name     = $value['campus'];
    ?>
        <div class="modal fade" id="modal_delete_education<?php echo $education_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Delete Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/delete_education/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="form" value="profile/setting" />
                <div class="modal-body">
                    <p>Are you sure you want to delete <b><?php echo $campus_name;?></b></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="education_id" value="<?php echo $education_id;?>">
                    <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <div class="modal fade" id="modal_delete_education_about<?php echo $education_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Delete Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/delete_education/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="form" value="about" />
                <div class="modal-body">
                    <p>Are you sure you want to delete <b><?php echo $campus_name;?></b></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="education_id" value="<?php echo $education_id;?>">
                    <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </form>
            </div>
            </div>
        </div>
	<?php }} ?>

	<!-- License -->
    <div class="modal fade" id="modalLicense" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Add License</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/add_license/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="form" value="profile/setting" />
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">School</label><br>
                    <select name="school" class="form-select license">
                    <?php if(!empty($data_licenses)){
						foreach($data_licenses as $value){ ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->data_name ?></option>
                    <?php }} ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Study</label>
                    <input tyle="text" name="study" class="form-control" placeholder="Front End Developer" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Active Date</label>
                    <div class="hstack d-flex">
                        <input type="text" name="date_start" id="datepicker15" class="form-control datepicker" placeholder="DD/MM/YYYY">
                        <label class="mx-2">to</label>
                        <input type="text" name="date_end" id="datepicker16" class="form-control datepicker" placeholder="DD/MM/YYYY">
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Save">
            </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalLicenseabout" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Add License</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/add_license/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="form" value="about" />
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">School</label><br>
                    <select name="school" class="form-select license">
                    <?php if(!empty($data_licenses)){
						foreach($data_licenses as $value){ ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->data_name ?></option>
                    <?php }} ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Study</label>
                    <input tyle="text" name="study" class="form-control" placeholder="Front End Developer" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Active Date</label>
                    <div class="hstack d-flex">
                        <input type="text" name="date_start" id="datepicker23" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        <label class="mx-2">to</label>
                        <input type="text" name="date_end" id="datepicker24" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Save">
            </div>
            </form>
            </div>
        </div>
    </div>

    <?php
	if (!empty($licenses)) {
    foreach($licenses as $value){
        $license_id     = $value['id'];
        $study          = $value['study'];
        $date_start     = $value['date_start'];
        $date_end       = $value['date_end'];
    ?>
    <div class="modal fade" id="modal_edit_license<?php echo $license_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Edit License</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/edit_license/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="license_id" value="<?php echo $license_id?>" />
            <input type="hidden" name="form" value="profile/setting" />
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Study</label>
                    <input tyle="text" name="study" value="<?php echo $study ?>" class="form-control" placeholder="Front End Developer" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Active Date</label>
                    <div class="hstack d-flex">
                        <input type="text" name="date_start" value="<?php echo $date_start ?>" id="datepicker17" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        <label class="mx-2">to</label>
                        <input type="text" name="date_end" value="<?php echo $date_end ?>" id="datepicker18" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Update">
            </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit_license_about<?php echo $license_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Edit License</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/edit_license/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="license_id" value="<?php echo $license_id?>" />
            <input type="hidden" name="form" value="about" />
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Study</label>
                    <input tyle="text" name="study" value="<?php echo $study ?>" class="form-control" placeholder="Front End Developer" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Active Date</label>
                    <div class="hstack d-flex">
                        <input type="text" name="date_start" value="<?php echo $date_start ?>" id="datepicker25" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        <label class="mx-2">to</label>
                        <input type="text" name="date_end" value="<?php echo $date_end ?>" id="datepicker26" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Update">
            </div>
            </form>
            </div>
        </div>
    </div>
    <?php }} ?>

    <?php
	if(!empty($licenses)) {
    foreach($licenses as $value){
        $license_id       = $value['id'];
        $school_name     = $value['school'];
    ?>
        <div class="modal fade" id="modal_delete_license<?php echo $license_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Delete License</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/delete_license/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="form" value="profile/setting" />
                <div class="modal-body">
                    <p>Are you sure you want to delete <b><?php echo $school_name;?></b></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="license_id" value="<?php echo $license_id;?>">
                    <button class="btn btn-muted" data-bs-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <div class="modal fade" id="modal_delete_license_about<?php echo $license_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                <h3 class="modal-title" id="myModalLabel">Delete License</h3>
            </div>
            <form action="<?php echo base_url('user/profile/delete_license/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="form" value="about" />
                <div class="modal-body">
                    <p>Are you sure you want to delete <b><?php echo $school_name;?></b></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="license_id" value="<?php echo $license_id;?>">
                    <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </form>
            </div>
            </div>
        </div>
	<?php }} ?>

	<!-- Course -->
    <div class="modal fade" id="modalCourse" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="Lable">Add Private Course</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

					</button>
				</div>
				<form action="<?php echo base_url('user/profile/add_course/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="form" value="profile/setting" />
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">School</label><br>
						<select name="school" class="form-select course">
						<?php if(!empty($data_courses)){
							foreach($data_courses as $value){ ?>
						<option value="<?php echo $value->id ?>"><?php echo $value->data_name ?></option>
						<?php }} ?>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Study</label>
						<input tyle="text" name="study" class="form-control" placeholder="Front End Developer" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Enroll Date</label>
                        <div class="hstack d-flex">
                            <input type="text" name="date_start" id="datepicker19" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                            <label class="mx-2">to</label>
                            <input type="text" name="date_end" id="datepicker20" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        </div>
					</div>
				</div>
				<div class="modal-footer border-top">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
					<input type="submit" class="btn btn-danger" value="Save">
				</div>
				</form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCourseabout" role="dialog" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="Lable">Add Private Course</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

					</button>
				</div>
				<form action="<?php echo base_url('user/profile/add_course/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="form" value="about" />
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">School</label><br>
						<select name="school" class="form-select course">
						<?php if(!empty($data_courses)){
							foreach($data_courses as $value){ ?>
						<option value="<?php echo $value->id ?>"><?php echo $value->data_name ?></option>
						<?php }} ?>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Study</label>
						<input tyle="text" name="study" class="form-control" placeholder="Front End Developer" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Enroll Date</label>
                        <div class="hstack d-flex">
                            <input type="text" name="date_start" id="datepicker27" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                            <label class="mx-2">to</label>
                            <input type="text" name="date_end" id="datepicker28" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        </div>
					</div>
				</div>
				<div class="modal-footer border-top">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
					<input type="submit" class="btn btn-danger" value="Save">
				</div>
				</form>
            </div>
        </div>
    </div>

    <?php
	if (!empty($courses)) {
    foreach($courses as $value){
        $course_id      = $value['id'];
        $study          = $value['study'];
        $date_start     = $value['date_start'];
        $date_end       = $value['date_end'];
    ?>
    <div class="modal fade" id="modal_edit_course<?php echo $course_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Edit Private Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/edit_course/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="course_id" value="<?php echo $course_id?>" />
            <input type="hidden" name="form" value="profile/setting" />
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Study</label>
                    <input tyle="text" name="study" value="<?php echo $study ?>" class="form-control" placeholder="Front End Developer" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Enroll Date</label>
                    <div class="hstack d-flex">
                        <input type="text" name="date_start" value="<?php echo $date_start ?>" id="datepicker21" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        <label class="mx-2">to</label>
                        <input type="text" name="date_end" value="<?php echo $date_end ?>" id="datepicker22" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Update">
            </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_edit_course_about<?php echo $course_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Lable">Edit Private Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <form action="<?php echo base_url('user/profile/edit_course/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="course_id" value="<?php echo $course_id?>" />
            <input type="hidden" name="form" value="about" />
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Study</label>
                    <input tyle="text" name="study" value="<?php echo $study ?>" class="form-control" placeholder="Front End Developer" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Enroll Date</label>
                    <div class="hstack d-flex">
                        <input type="text" name="date_start" value="<?php echo $date_start ?>" id="datepicker29" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        <label class="mx-2">to</label>
                        <input type="text" name="date_end" value="<?php echo $date_end ?>" id="datepicker30" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Update">
            </div>
            </form>
            </div>
        </div>
    </div>
    <?php }} ?>

    <?php
	if (!empty($courses)) {
    foreach($courses as $value){
        $course_id       = $value['id'];
        $school_name     = $value['school'];
    ?>
        <div class="modal fade" id="modal_delete_course<?php echo $course_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="Lable">Delete Private Course</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

						</button>
					</div>
					<form action="<?php echo base_url('user/profile/delete_course/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
					<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
					<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
					<input type="hidden" name="id" value="<?php echo $users->id ?>" />
					<input type="hidden" name="form" value="profile/setting" />
						<div class="modal-body">
							<p>Are you sure you want to delete <b><?php echo $school_name;?></b></p>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="course_id" value="<?php echo $course_id;?>">
							<button class="btn btn-muted" data-bs-dismiss="modal" aria-hidden="true">Close</button>
							<button class="btn btn-danger">Delete</button>
						</div>
					</form>
				</div>
            </div>
        </div>
        <div class="modal fade" id="modal_delete_course_about<?php echo $course_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                <h3 class="modal-title" id="myModalLabel">Delete Course</h3>
            </div>
            <form action="<?php echo base_url('user/profile/delete_course/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce('user/setting')) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="form" value="about" />
                <div class="modal-body">
                    <p>Are you sure you want to delete <b><?php echo $school_name;?></b></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="course_id" value="<?php echo $course_id;?>">
                    <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </form>
            </div>
            </div>
        </div>
	<?php }} ?>

    <div class="modal fade" id="modalVolunterabout" role="dialog" aria-labelledby="Label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="Lable">Add Volunteer Experience</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

					</button>
				</div>
				<form action="<?php echo base_url('user/profile/add_volunteer/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/profile')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="form" value="about" />
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Volunteer Name</label>
						<input tyle="text" name="volunteer_name" class="form-control" placeholder="Health" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Join Date</label>
                        <div class="hstack d-flex">
                            <input type="text" name="date_start" id="datepicker" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                            <label class="mx-2">to</label>
                            <input type="text" name="date_end" id="datepicker2" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        </div>
					</div>
				</div>
				<div class="modal-footer border-top">
				<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
					<input type="submit" class="btn btn-danger" value="Save">
				</div>
				</form>
			</div>
		</div>
	</div>

<?php
	if (!empty($volunteers)) {
    foreach($volunteers as $value){
        $volunteer_id   = $value['id'];
        $volunteer      = $value['volunteer_name'];
        $date_start     = $value['date_start'];
        $date_end       = $value['date_end'];
    ?>
    <div class="modal fade" id="modal_edit_volunteer_about<?php echo $volunteer_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="Lable">Edit Volunteer Experience</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

					</button>
				</div>
				<form action="<?php echo base_url('user/profile/edit_volunteer/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/profile')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="volunteer_id" value="<?php echo $volunteer_id?>" />
				<input type="hidden" name="form" value="about" />
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Volunteer Name</label>
						<input tyle="text" name="volunteer_name" value="<?php echo $volunteer ?>" class="form-control" placeholder="Programmer" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Join Date</label>
                        <div class="hstack d-flex">
                            <input type="text" name="date_start" value="<?php echo $date_start ?>" id="datepicker3" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                            <label class="mx-2">to</label>
                            <input type="text" name="date_end" value="<?php echo $date_end ?>" id="datepicker4" class="form-control datepicker" placeholder="DD/MM/YYYY" required>
                        </div>
					</div>
				</div>
				<div class="modal-footer border-top">
					<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
					<input type="submit" class="btn btn-danger" value="Update">
				</div>
				</form>
            </div>
        </div>
    </div>
    <?php }} ?>

    <?php
	if (!empty($volunteers)) {
    foreach($volunteers as $value){
        $volunteer_id     = $value['id'];
        $volunteer_name   = $value['volunteer_name'];
    ?>
    <div class="modal fade" id="modal_delete_volunteer_about<?php echo $volunteer_id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
					<h3 class="modal-title" id="myModalLabel">Delete Volunteer Experience</h3>
				</div>
				<form action="<?php echo base_url('user/profile/delete_volunteer/'.$users->id) ?>" method="post" role="form" enctype="multipart/form-data">
				<?php echo form_hidden(generate_csrf_nonce('user/profile')) ?>
				<input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
				<input type="hidden" name="id" value="<?php echo $users->id ?>" />
				<input type="hidden" name="form" value="about" />
					<div class="modal-body">
						<p>Are you sure you want to delete <b><?php echo $volunteer_name;?></b></p>
					</div>
					<div class="modal-footer border-top">
						<input type="hidden" name="volunteer_id" value="<?php echo $volunteer_id;?>">
						<button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
						<button class="btn btn-danger">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php }} ?>
