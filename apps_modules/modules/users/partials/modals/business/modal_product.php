<!-- Modal Add Product/Service -->
<div class="modal fade" id="productserviceModal" tabindex="-1" aria-labelledby="productserviceModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Add Product/Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="" method="post">
            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label" for="product-type">Type</label>
                    <input type="hidden" name="user_id" value=" <?php echo $users->id ?>">
                    <select name="product-type" id="product-type" class="form-select">
                        <option value="1">Product</option>
                        <option value="2">Service</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" name="product-category" for="product-category">Category</label>
                    <select class="w-100 form-select" name="product-category">
                    <?php foreach($categories as $value){
                            echo "<option value='$value->id'>$value->data_name</option>";
                        }
                    ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" name="product-name" for="product-name">Product Name</label>
                    <input type="text" name="product-name" id="product-name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label d-flex align-items-center" for="product-type-price">Price Type <a href="#" target="_blank" class="btn p-1" data-bs-toggle="tooltip" data-bs-placement="right" title="click to learn more"><span class="text-muted material-icons-outlined fs-12">info</span></a></label>
                    <select class="form-select" name="product-type-price" id="price-select">
                        <option value="0">Please Select</option>
                        <option value="1">Free / Giveaway</option>
                        <option value="2">Fixed Price</option>
                        <option value="3">Starting at</option>
                        <option value="4">Ask for Price</option>
                        <option value="5">Variable Price</option>
                    </select>
                </div>
                <div class="mb-3 d-none" id="pricing">
                    <label class="form-label" for="">Price</label>
                    <div class="hstack gap-2 d-none" id="price-num">
                        <select class="form-select" name="product-currency">
                            <option value="USD">USD</option>
                            <option value="IDR">IDR</option>
                            <option value="AUD">AUD</option>
                        </select>
                        <input type="text" name="price" id="" class="form-control">
                    </div>
                    <div class="vstack gap-2 d-none" id="price-table">
                        <div class="hstack gap-2">
                            <input class="form-control" type="text" name="product-count-variant[]" id="" placeholder="1 - 50">
                            <input class="form-control" type="text" name="product-price-variant[]" id="" placeholder="1000">
                        </div>
                        <div class="hstack gap-2">
                            <input class="form-control" type="text" name="product-count-variant[]" id="" placeholder="51 - 200">
                            <input class="form-control" type="text" name="product-price-variant[]" id="" placeholder="950">
                        </div>
                        <div class="hstack gap-2">
                            <input class="form-control" type="text" name="product-count-variant[]" id="" placeholder="200 +">
                            <input class="form-control" type="text" name="product-price-variant[]" id="" placeholder="925">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" name="" for="">Label</label>
                    <select class="w-100 form-select js-labels" name="product-label">
                    <?php foreach($labeles as $value){
                            echo "<option value='$value->id'>$value->data_name</option>";
                        }
                    ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Description</label>
                    <textarea name="product-description" id="" cols="10" rows="5" maxlength="350" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Main Photo</label>
                    <input type="file" class="form-control" name="__logo_files[]" accept="image/*" >
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">SKU (Optional)</label>
                    <input type="text" name="sku" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="publish" id="publish" >
                        <label class="form-check-label" for="publish">
                            Publish in Buy & Sell
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Product/Service -->
<?php foreach($items_list_product as $value){ ?>
    <form action="<?php echo base_url('market/update') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
    <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
<div class="modal fade" id="modal_edit_product<?php echo $value->id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Edit Product/Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Product/Service
                            Name</label>
                        <input type="text" name="product-name" class="form-control form-control-sm" id="formGroupExampleInput"
                            placeholder="Input product/service name" value="<?php echo $value->data_name ?>">
                        <input type="hidden" name="product-id" value="<?php echo $value->id ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputState" class="form-label">Price Type</label>
                        <select id="inputState" name="product-type-price" class="form-select form-select-sm">
                            <?php foreach($price_type as $key => $val){
                                if($value->price_type == $key){
                                    echo '<option value="'.$key.'" selected>'.$val.'</option>';
                                }else{
                                    echo '<option value="'.$key.'">'.$val.'</option>';
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="mb-3 <?php if(in_array($value->price_type, [0,1,4])) echo 'd-none' ?>" id="pricing">
                        <label class="form-label" for="">Price</label>
                        <div class="hstack gap-2 <?php if(in_array($value->price_type, [0,1,4,5])) echo 'd-none' ?>" id="price-num">
                            <select class="form-select" name="product-currency" onchange="init_mask_money(this.value)">
                                <option value="USD" <?php if($value->price_currency == 'USD') echo 'selected'; ?>>USD</option>
                                <option value="IDR" <?php if($value->price_currency == 'IDR') echo 'selected'; ?>>IDR</option>
                                <option value="AUD" <?php if($value->price_currency == 'AUD') echo 'selected'; ?>>AUD</option>
                            </select>
                            <input type="text" name="price_copy" onkeyup="inputprice()"  id="price-num-price" class="form-control" value="<?php if(in_array($value->price_type, [2,3])) echo $value->price_low ?>">
                            <input type="text" name="price" id="price-num-price_copy" class="form-control" value="<?php if(in_array($value->price_type, [2,3])) echo $value->price_low ?>">
                        </div>
                        <div class="vstack gap-2 <?php if(in_array($value->price_type, [0,1,2,3,4])) echo 'd-none' ?>" id="price-table">
                            <?php
                                if($value->price_type == 5):
                                $qty = json_decode($value->price_variant);
                                foreach ($qty as $key => $val) :
                            ?>
                            <div class="hstack gap-2">
                                <input class="form-control" type="text" name="product-count-variant[]" id="" placeholder="1 - 50" value="<?php echo $val->qty ?>">
                                <input class="form-control" type="text" name="product-price-variant[]" id="" placeholder="1000" value="<?php echo $val->price ?>">
                            </div>
                            <?php
                                endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea name="product-description" class="form-control form-control-sm" id="exampleFormControlTextarea1"
                            placeholder="Input description" rows="3"><?php echo $value->data_description ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Category</label>
                        <select class="w-100 form-select" name="product-category[]">
                                <?php foreach($categories as $value){
                                        echo "<option value='$value->id'>$value->data_name</option>";
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Image</label>
                        <input name="__logo_files[]" class="form-control form-control-sm" id="formFileMultiple" type="file"
                            placeholder="Input product image" multiple>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Submit">
            </div>
        </div>
    </div>
</div>
</form>
<?php } ?>

<!-- Modal Edit Product/Service -->
<?php
if(!empty($items_list_service)){
foreach($items_list_service as $value){ ?>
    <form action="<?php echo base_url('market/update') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
    <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
<div class="modal fade" id="modal_edit_jasa<?php echo $value->id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Edit Product/Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Product/Service
                            Name</label>
                        <input type="text" name="product-name" class="form-control form-control-sm" id="formGroupExampleInput"
                            placeholder="Input product/service name" value="<?php echo $value->data_name ?>">
                        <input type="hidden" name="product-id" value="<?php echo $value->id ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputState" class="form-label">Price Type</label>
                        <select id="inputState" name="product-type-price" class="form-select form-select-sm">
                            <?php foreach($price_type as $key => $val){
                                if($value->price_type == $key){
                                    echo '<option value="'.$key.'" selected>'.$val.'</option>';
                                }else{
                                    echo '<option value="'.$key.'">'.$val.'</option>';
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="mb-3 <?php if(in_array($value->price_type, [0,1,4])) echo 'd-none' ?>" id="pricing">
                        <label class="form-label" for="">Price</label>
                        <div class="hstack gap-2 <?php if(in_array($value->price_type, [0,1,4,5])) echo 'd-none' ?>" id="price-num">
                            <select class="form-select" name="product-currency" onchange="init_mask_money(this.value)">
                                <option value="USD" <?php if($value->price_currency == 'USD') echo 'selected'; ?>>USD</option>
                                <option value="IDR" <?php if($value->price_currency == 'IDR') echo 'selected'; ?>>IDR</option>
                                <option value="AUD" <?php if($value->price_currency == 'AUD') echo 'selected'; ?>>AUD</option>
                            </select>
                            <input type="text" name="price_copy" onkeyup="inputprice()"  id="price-num-price" class="form-control" value="<?php if(in_array($value->price_type, [2,3])) echo $value->price_low ?>">
                            <input type="text" name="price" id="price-num-price_copy" class="form-control" value="<?php if(in_array($value->price_type, [2,3])) echo $value->price_low ?>">
                        </div>
                        <div class="vstack gap-2 <?php if(in_array($value->price_type, [0,1,2,3,4])) echo 'd-none' ?>" id="price-table">
                            <?php
                                if($value->price_type == 5):
                                $qty = json_decode($value->price_variant);
                                foreach ($qty as $key => $val) :
                            ?>
                            <div class="hstack gap-2">
                                <input class="form-control" type="text" name="product-count-variant[]" id="" placeholder="1 - 50" value="<?php echo $val->qty ?>">
                                <input class="form-control" type="text" name="product-price-variant[]" id="" placeholder="1000" value="<?php echo $val->price ?>">
                            </div>
                            <?php
                                endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea name="product-description" class="form-control form-control-sm" id="exampleFormControlTextarea1"
                            placeholder="Input description" rows="3"><?php echo $value->data_description ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Category</label>
                        <select class="w-100 form-select" name="product-category[]">
                                <?php foreach($categories as $value){
                                        echo "<option value='$value->id'>$value->data_name</option>";
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Image</label>
                        <input name="__logo_files[]" class="form-control form-control-sm" id="formFileMultiple" type="file"
                            placeholder="Input product image" multiple>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Submit">
            </div>
        </div>
    </div>
</div>
</form>
<?php }} ?>

<!-- Modal Delete Product/Service -->
<?php foreach($items_list_product as $value){ ?>
    <form action="<?php echo base_url('market/delete') ?>" method="post" role="form" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
        <div class="modal fade" id="deleteproductserviceModal" tabindex="-1" aria-labelledby=""
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Are you sure to delete this product/service?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <input type="hidden" name="items-id" value="" id="items-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-danger" value="Yes">
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>

<!-- Modal Delete Product/Service -->
<?php foreach($items_list_product as $value){ ?>
    <form action="<?php echo base_url('buysells/delete') ?>" method="post" role="form" enctype="multipart/form-data">
    <input type="hidden" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
        <div class="modal fade" id="deleteproductbuyModal" tabindex="-1" aria-labelledby=""
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Are you sure to delete this product?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <input type="hidden" name="items-id" value="" id="items-buy-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-danger" value="Yes">
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>

<!-- Modal Edit Product/Service -->
<?php foreach($items_list_product as $value){ ?>
    <form action="<?php echo base_url('buysells/update') ?>" class="row mx-0 px-0" method="post" role="form" enctype="multipart/form-data">
    <input type="hidden" class="txt_csrfname" name="<?php echo $CSRF['name']; ?>" value="<?php echo $CSRF['hash']; ?>"/>
<div class="modal fade" id="modal_edit_product_buy<?php echo $value->id;?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-l modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Edit Buy & Sells</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Product
                            Name</label>
                        <input type="text" name="product-name" class="form-control form-control-sm" id="formGroupExampleInput"
                            placeholder="Input product/service name" value="<?php echo $value->data_name ?>">
                        <input type="hidden" name="product-id" value="<?php echo $value->id ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputState" class="form-label">Price Type</label>
                        <select id="inputState" name="product-type-price" class="form-select form-select-sm">
                            <?php foreach($price_type as $key => $val){
                                if($value->price_type == $key){
                                    echo '<option value="'.$key.'" selected>'.$val.'</option>';
                                }else{
                                    echo '<option value="'.$key.'">'.$val.'</option>';
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="mb-3 <?php if(in_array($value->price_type, [0,1,4])) echo 'd-none' ?>" id="pricing">
                        <label class="form-label" for="">Price</label>
                        <div class="hstack gap-2 <?php if(in_array($value->price_type, [0,1,4,5])) echo 'd-none' ?>" id="price-num">
                            <select class="form-select" name="product-currency" onchange="init_mask_money(this.value)">
                                <option value="USD" <?php if($value->price_currency == 'USD') echo 'selected'; ?>>USD</option>
                                <option value="IDR" <?php if($value->price_currency == 'IDR') echo 'selected'; ?>>IDR</option>
                                <option value="AUD" <?php if($value->price_currency == 'AUD') echo 'selected'; ?>>AUD</option>
                            </select>
                            <input type="text" name="price_copy" onkeyup="inputprice()"  id="price-num-price" class="form-control" value="<?php if(in_array($value->price_type, [2,3])) echo $value->price_low ?>">
                            <input type="text" name="price" id="price-num-price_copy" class="form-control" value="<?php if(in_array($value->price_type, [2,3])) echo $value->price_low ?>">
                        </div>
                        <div class="vstack gap-2 <?php if(in_array($value->price_type, [0,1,2,3,4])) echo 'd-none' ?>" id="price-table">
                            <?php
                                if($value->price_type == 5):
                                $qty = json_decode($value->price_variant);
                                foreach ($qty as $key => $val) :
                            ?>
                            <div class="hstack gap-2">
                                <input class="form-control" type="text" name="product-count-variant[]" id="" placeholder="1 - 50" value="<?php echo $val->qty ?>">
                                <input class="form-control" type="text" name="product-price-variant[]" id="" placeholder="1000" value="<?php echo $val->price ?>">
                            </div>
                            <?php
                                endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea name="product-description" class="form-control form-control-sm" id="exampleFormControlTextarea1"
                            placeholder="Input description" rows="3"><?php echo $value->data_description ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Category</label>
                        <select class="w-100 form-select" name="product-category[]">
                                <?php foreach($categories as $value){
                                        echo "<option value='$value->id'>$value->data_name</option>";
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Image</label>
                        <input name="__logo_files[]" class="form-control form-control-sm" id="formFileMultiple" type="file"
                            placeholder="Input product image" multiple>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Submit">
            </div>
        </div>
    </div>
</div>
</form>
<?php } ?>
<script>
    $('.productItemEdit').click(function (card) {

    });
</script>
