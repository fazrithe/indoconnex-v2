<style>
    .note-editable {
        background-color: #fff;
    }
</style>
<?php $this->load->view($template['partials_sidebar_article']); ?>
<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0 g-3">
            <div class="pt-4 mr-0 bg-indoconnex" >
                <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                    <select name="businessSelector" onchange="selectUser(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
                        <option value="1" data-image="<?php echo placeholder($users->file_path, $users->file_name_original) ?>"><?php echo $users->name_first ?> <?php echo $users->name_last ?></option>
                        <?php foreach($business_list as $value){ ?>
                        <option value="<?php echo $value->id ?>" data-id="<?php echo $value->id ?>" data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business')?>" class=""><?php echo $value->data_name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <span class="d-flex fw-bold mb-3">Create New Article</span>

                <form action="<?php echo base_url('articles/store') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
                    <?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
                    <input type="hidden" id="id" name="id" value="<?php echo $CSRF['id']; ?>"/>
                    <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <input type="hidden" id="select_user_id" name="select_user_id">
                    <input type="hidden" id="select_business_id" name="select_business_id">
                    <input type="hidden" name="form" value="profile">
                    <input type="hidden" name="action" value="create">

                    <div class="col-12 mb-3 ">
                        <div class="card border-0 mb-3 text-prussianblue" >
                            <div class="card-body fs-12 text-black">
                                <div class="mb-3">
                                    <label class='form-label' for="article-title">Title</label>
                                    <input type="text" class="form-control form-control-sm" id="article-title" name="title" maxlength="200" required>
									<span class="text-danger">Maximum 200 characters</span>
                                </div>
                                <div class="mb-3">
                                    <label class='form-label' for="article-category">Category</label>
                                    <select name="category" class="form-select form-select-sm article-category" onchange="data_cat()" required>
                                        <?php foreach($data_category as $value){ ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->data_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class='form-label' for="editor">Contents</label>
                                    <!-- Create toolbar container -->
                                    <!-- <div id="editor" class="" style="height: 300px"></div>
                                    <textarea class="form-control form-control-sm" name="contents" id="contents" style="display:none"></textarea> -->

                                    <textarea id="summernote" name="contents" class="form-control" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class='form-label' for="article-image">Featured Image</label>
                                    <div>
                                        <input type="file" name="__files[]" class="form-control form-control-sm" accept=".jpg, .jpeg, .png">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger px-3">Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
