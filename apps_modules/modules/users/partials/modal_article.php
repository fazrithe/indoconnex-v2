<?php
    foreach($post_articles as $value){
    $article_id            = $value->id;
?>
    <div class="modal fade" id="del_article<?php echo $article_id ?>" tabindex="-1" aria-labelledby="albumslabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Delete</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?php echo base_url('articles/delete/'.$article_id) ?>" method="post" role="form" enctype="multipart/form-data">
			<?php echo form_hidden(generate_csrf_nonce($template['partials_module_name'])) ?>
            <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
            <input type="hidden" name="user_id" value="<?php echo $users->id ?>" />
            <input type="hidden" name="form" value="profile" />
                <div class="modal-body">
                    <p>Are you sure you want to delete this Article?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="post_text_id" value="<?php echo $article_id;?>">
                    <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </form>
            </div>
        </div>
    </div>
<?php } ?>
