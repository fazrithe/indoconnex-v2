<?php
$title = 'Profile Dashboard | INDOCONNEX';
?>
<!-- navbar -->
<?php $this->load->view($template['partials_navbar_user']); ?>

<?php if(empty($users_profile->status_privacy) || !empty($checkusers_profile)) { ?>
<div class="row">
    <div class="col-sm">
        <h4 class="text-prussianblue">Create New Article</h4>
        <form action="" method="post" class="">
            <div class="mb-3">
                <label class='form-label' for="article-title">Title</label>
                <input type="text" class="form-control" id="article-title" name="article-title">
            </div>
            <div class="mb-3">
                <label class='form-label' for="article-category">Category</label>
                <select class="custom-select" name="article-category" id="article-category">
                    <option value="0" selected>Select Category</option>
                </select>
            </div>
            <div class="mb-3">
                <label class='form-label' for="article-editor">Contents</label>
                <!-- Create toolbar container -->
                <div id="toolbar"></div>
                <div class="ql-editor" name="article-editor" id="article-editor" style="height: 250px;"></div>
            </div>

            <div class="mb-3">
                <label class='form-label' for="article-image">Featured Image</label>
                <div>
                    <img src="http://placehold.it/883x378" alt="Upload Featured Image" srcset="">
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-danger px-3">Post</button>
            </div>
        </form>
    </div>

    <div class="col-2 align-self-right">
        <div class="position-fixed" style="overflow: auto">
            <div class="card-mjk">
                <p>Promotions</p>
                <div class="card-mjk-img">
                    <a href="index.php?pages=news-detail" title="">
                        <figure class="rounded" data-aspect-ratio="16:9">
                            <img src="./themes/images/ads/1.png" alt="">
                        </figure>
                    </a>
                </div>
                <div class="card-mjk-desc">
                    <div class="card-mjk-desc-item">

                        <h3><a href="index.php?pages=news-detail" title="">Daily Harvest Brackfast Bowls Now 50%</a></h3>
                        <p><a href="#">www.hearvestbreakfest.com</a></p>

                    </div>
                </div>
                <div class="card-mjk-img">
                    <a href="index.php?pages=news-detail" title="">
                        <figure class="rounded" data-aspect-ratio="16:9">
                            <img src="./themes/images/dummy/img-1.jpg" alt="">
                        </figure>
                    </a>
                </div>
                <div class="card-mjk-desc">
                    <div class="card-mjk-desc-item">

                        <h3><a href="index.php?pages=news-detail" title="">Daily Harvest Brackfast Bowls Now 50%</a></h3>
                        <p><a href="#">www.hearvestbreakfest.com</a></p>

                    </div>
                </div>
                <div class="card-mjk-img">
                    <a href="index.php?pages=news-detail" title="">
                        <figure class="rounded" data-aspect-ratio="16:9">
                            <img src="./themes/images/dummy/img-1.jpg" alt="">
                        </figure>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } else { ?>
    <div class="container mb-4">
        <div class="row">
            <div class="col mx-auto">
                <div class="mb-4 rounded-3 msn-widget">
                    <div class="text-center p-md-4 p-2">
                        This account is Private
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
