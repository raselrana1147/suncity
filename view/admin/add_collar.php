
<?php
    $role_session = mi_get_session('role');
    if ($role_session['design'] != 1){
        mi_redirect(MI_BASE_URL.'admin/index.php');
    }
?>

<?php
if (isset($_GET['e']) && !empty($_GET['e'])){
    $get_collar_style = mi_db_read_by_id('collars', array('id'=>mi_secure_input($_GET['e'])))[0];
}
?>
<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>


<main>
    <div class="main-content">
        <div class="row justify-content-md-center">
            
            <div class="col-12 col-lg-8 col-md-8">
                <div class="card pb-3">
                    <h4 class="card-title"><strong>Add Collar Style</strong></h4>
                    <div class="card-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="collar_style_id" value="<?=$get_collar_style['id']?>">
<!--                            ===============================================-->
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="title" name="title" value="<?=$get_collar_style['title']?>">
                                            <label for="title">Title</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="subtitle" name="subtitle" value="<?=$get_collar_style['subtitle']?>">
                                            <label for="subtitle">Subtitle</label>
                                        </div>

                                        <div class="form-group">
                                            <select class="form-control" name="status">
                                                <option value="1" <?=(!empty($get_collar_style['status']) && $get_collar_style['status'] == 1)?'selected':'';?>>Active</option>
                                                <option value="2" <?=(!empty($get_collar_style['status']) && $get_collar_style['status'] == 2)?'selected':'';?>>In active</option>
                                            </select>
                                            <label class="label-floated">Status</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="price" name="price"value="<?=$get_collar_style['price']?>">
                                            <label for="price">Price</label>
                                        </div>

                                        <div class="form-group">
                                            <h6 class="mb-1">Collar Style Thumbnail <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="collar_style_thumb" data-provide="dropify" data-default-file="<?=(!empty($get_collar_style['thumb']))?MI_BASE_URL.$get_collar_style['thumb']:'';?>" id="collar_style_thumb">
                                        </div>
                                    </div>
                                </div>
                            </div>
<!--                            ===============================================-->
                            <div class="col-12 card-footer">
                                <a href="collar_styles.php" class="btn btn-outline btn-danger">Cancel</a>
                                <button class="btn btn-dark float-right" type="submit" name="add_collar_style">
                                    Save &nbsp;<i class="fa fa-save"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?=mi_include('footer_extra.php');?>
</main>
<!-- END Main container -->


<?=mi_footer();?>
