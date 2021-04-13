
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
            <?php
                if (isset($_GET['e'])){
            ?>
<!-- -------------collar style edit-------------->
            <div class="col-12 col-lg-5 col-md-5">
                <div class="card pb-3">
                    <h4 class="card-title"><strong>Edit Collar Style</strong></h4>
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
                                <button class="btn btn-dark float-right" type="submit" name="edit_collar_style">
                                    Update&nbsp;<i class="fa fa-refresh"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!-- -------------/ collar style edit-------------->
            <?php }?>
<!-----------------show collar styles--------------->
            <div class="col-12 col-lg-<?=(isset($_GET['e'])?'7':'12')?> col-md-<?=(isset($_GET['e'])?'7':'12')?>">
                <div class="card">
                    <h4 class="card-title"><strong>Collar Styles</strong></h4>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Thumb</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $get_collar_styles = mi_db_read_all('collars', 'id', 'DESC');
                                    foreach ($get_collar_styles as $key => $style){
                                ?>
                                    <tr>
                                        <td><?=$key+1;?></td>
                                        <td><?=$style['title']?></td>
                                        <td><?=$style['subtitle']?></td>
                                        <td style="width: 100px">
                                            <img src="<?=MI_BASE_URL.$style['thumb'];?>" style="max-width: 90px;width: 100%;">
                                        </td>
                                        <td><?=$style['price']?></td>
                                        <td><?=($style['status']==1?'Active':'Deactive')?></td>
                                        <td>
                                            <a href="collar_styles.php?e=<?=$style['id']?>" class="btn btn-dark btn-sm" style="margin-bottom: 5px">Edit <i class="fa fa-edit"></i></a>
                                            <a val="<?=$style['id'] ?>" class="btn btn-danger text-white btn-sm deleteCollar">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?=mi_include('footer_extra.php');?>
</main>
<!-- END Main container -->


<?=mi_footer();?>
