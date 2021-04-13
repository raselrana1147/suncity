
<?php
$role_session = mi_get_session('role');
if ($role_session['design'] != 1){
    mi_redirect(MI_BASE_URL.'admin/index.php');
}
?>

<?php
if (isset($_GET['e']) && !empty($_GET['e'])){
    $get_element = mi_db_read_by_id('settings', array('id'=>mi_secure_input($_GET['e'])))[0];
}
?>
<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>

<main>
    <div class="main-content">
        <div class="row">
            <?php
            if (isset($_GET['e'])){
                ?>
                <!-- -------------collar stiffness edit-------------->
                <div class="col-12 col-lg-5 col-md-5">
                    <div class="card pb-3">
                        <h4 class="card-title"><strong>Edit <?=$get_element['meta_name']?></strong></h4>
                        <div class="card-body">
                            <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                                <input type="hidden" name="element_id" value="<?=$get_element['id']?>">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <div class="card-body form-type-material">
                                            <div class="form-group">
                                                <h6 class="mb-1">Thumbnail <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                                <input type="file" name="element_thumb" data-provide="dropify" data-default-file="<?=(!empty($get_element['meta_value']))?MI_BASE_URL.$get_element['meta_value']:'';?>" id="element_thumb">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 card-footer">
                                    <a href="others.php" class="btn btn-outline btn-danger">Cancel</a>
                                    <button class="btn btn-dark float-right" type="submit" name="edit_element">
                                        Update&nbsp;<i class="fa fa-refresh"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- -------------/ collar stiffness edit-------------->
            <?php }?>
            <!---------------------show sleeves------------------->
            <div class="col-12 col-lg-<?=(isset($_GET['e'])?'7':'12')?> col-md-<?=(isset($_GET['e'])?'7':'12')?>">
                <div class="card">
                    <h4 class="card-title"><strong>Elements</strong></h4>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Thumb</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $get_results = mi_db_read_by_id('settings', array('type'=> 'shirt_element'), '', 'id', 'DESC');

                            foreach ($get_results as $key => $result){
                                ?>
                                <tr>
                                    <td><?=$key+1;?></td>
                                    <td><?=$result['meta_name']?></td>
                                    <td style="width: 100px">
                                        <img src="<?=MI_BASE_URL.$result['meta_value'];?>" class="other-elem">
                                    </td>
                                    <td>
                                        <a href="others.php?e=<?=$result['id']?>" class="btn btn-dark btn-sm">Edit <i class="fa fa-edit"></i></a>
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
