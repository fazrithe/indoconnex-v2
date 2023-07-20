
<div class="container mb-4">
    <div class="row">

        <!-- SECTION -->
        <div class="col-auto col-md-9 bg-white mx-auto mb-3">
            <div class="p-4 d-flex">
                <div class="d-flex me-auto d-flex flex-column">
                    <abbr title="<?php echo carbon_long($article->published)?>" class="mb-2 text-decoration-none">
                        <span class="text-muted"><?php echo carbon_human($article->published);?></span>
                    </abbr>
                    <span class="text-black fw-bold fs-18"><?php echo $article->data_name;?></span>
                    <span class="text-muted mb-2"><?php echo trim($poster->name_first . ' ' . $poster->name_middle . ' ' . $poster->name_last) ?></span>
                    <span class="mb-2">
                        <span class="badge bg-light text-black rounded-pill"><?php if(!empty($category->data_name)){ echo $category->data_name; } ?></span>
                    </span>
					<div class="row">
						<div class="col-1" style="display: inline-block; padding:10px">
							<?=share_button('twitter',    array('url'=>site_url('public/articles/detail/'.$article->id), 'text'=>$article->data_name, 'via'=>'indoconnex'))?>
						</div>
						<div class="col" style=" display: inline-block; padding:5px; padding-left:40px;">
							<?=share_button('facebook',    array('url'=>site_url('public/articles/detail/'.$article->id), 'text'=>$article->data_name))?>
						</div>
					</div>
                </div>
            </div>
        </div>

        <div class="col-auto col-md-9 bg-white mx-auto mb-3">
            <div class="p-4 clearfix">
                <figure class="figure w-50 float-md-start me-3">
                    <img src="<?php echo placeholder($article->file_path, $article->file_name_original, 'article', '4x3')?>" class="figure-img img-fluid rounded" alt="<?php echo slug($article->data_name)?>">
                    <figcaption class="figure-caption">A caption for the above image.</figcaption>
                </figure>
                <!-- <div class="text-break text-pre-wrap ql-editor overflow-y-visible"><?php echo $article->data_description ?></div> -->
                <div class="text-break text-pre-wrap overflow-y-visible"><?php echo $article->data_description ?></div>
            </div>
        </div>
    </div>
</div>
