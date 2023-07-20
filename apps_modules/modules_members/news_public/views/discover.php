<!-- Sidebar  -->
<?php $this->load->view($template['partials_sidebar_news_public']); ?>
<input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>

<!-- Page Content  -->
<div class="container-fluid">
    <div class="row">
        <div class="col-11 col-md-7 mx-auto px-0">
            <div class="pt-4 mr-0 bg-indoconnex" >

                <span class="d-flex fw-bold mb-3">Discover News & Events</span>
                <div class="d-flex bg-white mb-3">
                    <form action="<?php echo base_url('public/discover/news') ?>" class="row p-2 w-100" method="get" role="form">
                        <div class="d-flex justify-content-evenly">
                            <div class="input-group input-group-sm border-0 d-flex align-items-center py-1 mx-auto">
                                <span class="input-group-text bg-white border-0" id="basic-addon1">
                                    <span class="material-icons text-danger">search</span>
                                </span>
                                <input type="text" class="form-control border-end-2 border-start-0 border-top-0 border-bottom-0 border border-2 rounded-0" placeholder="Search" aria-label="" aria-describedby="basic-addon1" name="news-name">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <span class="d-none d-md-block text-white px-3">Search</span>
                                    <span class="material-icons text-white d-block d-md-none">search</span>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex">

                            <div class="dropdown dropdown-monik">
                                <select name="news-category" id="news-category" class="form-select border-0 fw-semi fs-12">
                                <option value="">Category</option>
                                    <?php foreach ($categories_news as $value) {
                                        echo "<option value='".$value->id."'>".$value->data_name."</option>";
                                    } ?>
                            </select>

                            </div>
                        </div>
                    </form>
                </div>

                <div class="bg-white container d-flex">
                    <div class="col-12">
                        <div class="justify-content-evenly m-3 d-flex align-text-center">
                            <span class="me-auto text-prussianblue fw-bold">Search Result</span>
                            <span class="ms-auto text-muted">Found <?php echo $total_rows ?> matches</span>
                        </div>

                        <div id="" class="row row-cols-3 mb-3">
                            <?php foreach($news as $value){ ?>
                                <div class="col-12 col-xs-6 col-md-4">
                                <div class="card h-100">
                                    <div class="placeholder-glow business-card position-relative">
                                        <img src="<?php echo placeholder($value->file_path, $value->file_name_original, 'news', '16x9') ?>" alt="<?php echo slug(words($value->data_name, 5)) ?>" class="card-img-top fit-cover">
                                    </div>
                                    <div class="card-body flex-column d-flex placeholder-glow px-3">
                                        <span class="d-flex align-items-center fs-16 fw-bold" id="prod-rand1-name">
                                            <a class="text-black fw-semi fs-16 text-break" href="<?php echo site_url('news/'.$value->data_slug)?>"><?php echo str_limit($value->data_name, 90) ?></a>
                                        </span>
                                    </div>
                                    <div class="card-footer bg-transparent align-items-end d-flex border-0">
                                        <abbr title="<?php echo carbon_long($value->published)?>" class="text-decoration-none ms-auto fs-14"><span class="text-muted"><?php echo carbon_human($value->published);?></span></abbr>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php echo $pagination; ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    $(function() {
        $("#news-category").select2({
            placeholder: "Category",
            allowClear: true
        });
    });
</script>

<?php $this->load->view($template['partials_sidebar_ads']); ?>