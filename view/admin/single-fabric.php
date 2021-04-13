<?php
    $role_session = mi_get_session('role');
    if ($role_session['tailoring'] != 1){
        mi_redirect(MI_BASE_URL.'admin/index.php');
    }
?>

<?php
    if (isset($_GET['f']) && !empty($_GET['f'])){
        $sfab = mi_db_read_by_id('fabrics', array('id'=>base64_decode(mi_secure_input($_GET['f']))));
        if (count($sfab)>0){
            $fabric = $sfab[0];
        }
    }
?>

<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>


    <!-- Main container -->
    <main>

        <div class="main-content">
            <form action="actions.php" method="post" class="w-100 form-type-combine" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12 col-lg-9 col-md-9 col-sm-8">
                        <input type="hidden" name="fab_id" value="<?=$fabric['id'] ?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group form-group-lg require">
                                    <label for="fab-name">Fabric Name</label>
                                    <input type="text" name="fab_name" class="form-control form-control-lg" value="<?=(isset($fabric) && !empty($fabric['title']))?$fabric['title']:'';?>" placeholder="Enter fabric name..." id="fab-name">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-sm-6">
                                <div class="form-group require">
                                    <label for="fab-tagline">Fabric Tagline</label>
                                    <input type="text" name="fab_tagline" class="form-control" value="<?=(isset($fabric) && !empty($fabric['tag_ling']))?$fabric['tag_ling']:'';?>" placeholder="Enter fabric tagline..." id="fab-tagline">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-sm-6">
                                <div class="form-group require">
                                    <label for="fab-price">Fabric Price</label>
                                    <input type="number" name="fab_price" class="form-control" value="<?=(isset($fabric) && !empty($fabric['price']))?$fabric['price']:'';?>" placeholder="Enter fabric price..." id="fab-price">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fab-description">Description</label>
                                    <textarea class="form-control" name="fab_description" id="fab-description" rows="6" placeholder="Write description about the fabric..."><?=(isset($fabric) && !empty($fabric['description']))?$fabric['description']:'';?></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="divider mb-0" style="font-size: 15px;">Images Images</div>
                            </div>
                            
                            <div class="col-6 col-lg-3 col-md-3 col-sm-4">
                                <div class="form-group required">
                                    <label class="w-100" for="fab-thumb">
                                        Fabrics Thumbnail &nbsp;
                                        <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i>
                                    </label>
                                    <input type="file" name="fab_thumb" data-provide="dropify" data-default-file="<?=(isset($fabric) && !empty($fabric['thumb']))?MI_BASE_URL.$fabric['thumb']:'';?>" id="fab-thumb">
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-3 col-sm-4">
                                <div class="form-group required">
                                    <label class="w-100" for="fab-shape">
                                        Product Image &nbsp;
                                        <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i>
                                    </label>
                                    <input type="file" name="product_image" data-provide="dropify" data-default-file="<?=(isset($fabric) && !empty($fabric['pro_img']))?MI_BASE_URL.$fabric['pro_img']:'';?>" id="pro_img">
                                </div>
                            </div>
                           
                           
                        </div>
                    </div>

                    <div class="col-12 col-lg-3 col-md-3 col-sm-4">
                        
                            <button type="submit" name="update_fabrics" class="btn btn-bold btn-info btn-lg w-100" value="<?=base64_decode($_GET['f']);?>">
                                Update Fabric &nbsp;&nbsp;<i class="fa fa-refresh"></i>
                            </button>

                        <div class="divider mt-3 mb-3"></div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group require">
                                    <label for="fab-category">Category</label>
                                    <select class="form-control" name="fab_category" data-provide="selectpicker" data-live-search="true" id="fab-category">
                                        <?php
                                        $get_cats = mi_db_read_by_id('categories', array('status'=>1));
                                        foreach ($get_cats as $cate){
                                            echo '<option value="'.$cate['id'].'" '.((isset($fabric) && !empty($fabric['category']) && $fabric['category'] == $cate['id'])?'selected':'').'>'.$cate['name'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group require">
                                    <label for="fab-default">Default Fabric</label>
                                    <select class="form-control" name="fab_default" id="fab-default">
                                        <option value="2" <?=(isset($fabric) && !empty($fabric['is_default']) && $fabric['is_default'] == 2)?'selected':''?>>No</option>
                                        <option value="1" <?=(isset($fabric) && !empty($fabric['is_default']) && $fabric['is_default'] == 1)?'selected':''?>>Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group require">
                                    <label for="fab-active">Status</label>
                                    <select class="form-control" name="fab_status" id="fab-active">
                                        <option value="1" <?=(isset($fabric) && !empty($fabric['status']) && $fabric['status'] == 1)?'selected':''?>>Active</option>
                                        <option value="2" <?=(isset($fabric) && !empty($fabric['status']) && $fabric['status'] == 2)?'selected':''?>>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="divider"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

           
            <!------------------------ end modal back yoke image change------------------------->
        </div>

      <?=mi_include('footer_extra.php');?>
    </main>
    <!-- END Main container -->


<?=mi_footer();?>
