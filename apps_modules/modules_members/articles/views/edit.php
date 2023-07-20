<style>
    .note-editable {
        background-color: #fff;
    }
</style>

<?php $this->load->view($template['partials_sidebar_article']); ?>
<!-- Page Content  -->
<main>
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0 mt-4">
            <div class="bg-white p-2 me-auto col-6 col-md-5 mb-3">
                <select name="businessSelector" onchange="selectUser(this.value)"  class=" border-0 bg-white p-2 js-businessSelector">
                    <option value="1" data-image="<?php echo placeholder($users->file_path, $users->file_name_original) ?>"><?php echo $users->name_first ?> <?php echo $users->name_last ?></option>
                    <?php foreach($business_list as $value){ ?>
                    <option value="<?php echo $value->id ?>" data-id="<?php echo $value->id ?>" data-image="<?php echo placeholder($value->file_path, $value->file_name_original, 'business') ?>" class=""><?php echo $value->data_name ?></option>
                    <?php } ?>
                </select>
            </div>
            <span class="d-flex fw-bold mb-3">Edit Article</span>

            <div class="d-flex bg-white align-items-center mb-3 rounded-3 p-3">
                <form action="<?php echo base_url('articles/store') ?>" class="w-100" method="post" role="form" enctype="multipart/form-data">
                    <?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
                    <input type="hidden" id="id" name="id" value="<?php echo $CSRF['id']; ?>"/>
                    <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
                    <input type="hidden" name="article_id" value="<?php echo $article->id ?>">
                    <input type="hidden" id="select_user_id" name="select_user_id">
                    <input type="hidden" id="select_business_id" name="select_business_id">
                    <input type="hidden" name="form" value="profile">
                    <input type="hidden" name="action" value="edit">
                    <div class="mb-3">
                        <label class='form-label' for="article-title">Title</label>
                        <input type="text" class="form-control" id="article-title" name="title" value="<?php echo $article->data_name ?>" maxlength="200">
						<span class="text-danger">Maximum 200 characters</span>
					</div>
                    <div class="mb-3">
                        <label class='form-label' for="article-category">Category</label>
                        <select class="form-select article-category" name="category" id="article-category">
                            <option value="0" selected>Select Category</option>
                            <?php foreach($categories_article as $value){ ?>
                                <option value='<?php echo $value->id?>'
                                        <?php if($value->id == $article->data_categories) echo 'selected';?>>
                                    <?php echo $value->data_name ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class='form-label' for="editor">Contents</label>
                        <!-- Create toolbar container -->
                        <!-- <div id="editor" class="" style="height: 200px"><?php echo $article->data_description ?></div>
                        <textarea class="form-control" name="contents" id="contents" style="display:none"><?php echo $article->data_description ?></textarea> -->
                        <textarea id="summernote" name="contents" class="form-control"><?php echo htmlspecialchars_decode($article->data_description) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class='form-label' for="article-image">Featured Image</label>
                        <div>
                            <input type="file" name="__files[]" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="article-post">
                        <img data-src="<?php echo placeholder($article->file_path, $article->file_name_original, 'article', '4x3') ?>" class="article-list m-3 rounded-3 border placeholder" alt="<?php echo slug($value->data_name) ?>">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-danger px-3">Post</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</main>

<?php $this->load->view($template['partials_sidebar_ads']); ?>
<?php $this->load->view($template['action_ajax_profile']); ?>
