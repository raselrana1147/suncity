
<?php
    $role_session = mi_get_session('role');
    if ($role_session['user_management'] != 1){
        mi_redirect(MI_BASE_URL.'admin/index.php');
    }
?>

<?php
if (isset($_GET['e']) && !empty($_GET['e'])){
    $get_user = mi_db_read_by_id('mi_users', array('id'=>mi_secure_input($_GET['e'])))[0];
}
?>
<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>

<style>
    table.table tr th, table.table tr td{
        border: none;
    }
</style>

<!-- Main container -->
<main>

    <div class="main-content pt-5 mt-5">
        <div class="row justify-content-md-center">
            <div class="col-12 col-lg-7 col-md-7 ">
                <div class="card">
                    <h4 class="card-title"><strong><?=$get_user['user_name']?></strong>
                        <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#modalConfirmChange">
                            Change Password
                        </button>
                    </h4>
                    <div class="card-body">
                        <form action="actions.php" method="post" enctype="multipart/form-data">
                            <!--Body-->
                            <input type="hidden" name="edit_user_id" value="<?=$get_user['id']?>">
                            <!--                            ======================================-->
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group form-group-lg require">
                                            <h6 class="mb-1">Photo <i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="image" data-provide="dropify" 
                                            data-default-file="<?=(isset($get_user['user_photo']) && !empty($get_user['user_photo'])?$get_user['user_photo']:MI_BASE_URL.'uploads/avatar.png')?>" id="image">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="user_name" name="user_name" value="<?=$get_user['user_name']?>" required>
                                            <label for="user_name">Name</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" class="form-control" id="user_email" name="user_email" value="<?=$get_user['user_email']?>" required>
                                            <label for="user_email">Email</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?=$get_user['user_phone']?>" required>
                                            <label for="user_phone">Phone</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="user_address" name="user_address" value="<?=$get_user['user_address']?>" required>
                                            <label for="user_address">Address</label>
                                        </div>

                                        <div class="form-group">
                                            <select class="form-control" name="status">
                                                <option value="1" <?=(!empty($get_user['user_status']) && $get_user['user_status'] == 1)?'selected':'';?>>Pending</option>
                                                <option value="2"  <?=(!empty($get_user['user_status']) && $get_user['user_status'] == 2)?'selected':'';?>>Activated</option>
                                                <option value="3" <?=(!empty($get_user['user_status']) && $get_user['user_status'] == 3)?'selected':'';?>>Deactivated</option>
                                            </select>
                                            <label class="label-floated">Status</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--======================================-->
                            <div class="col-12 card-footer">
                                <button class="btn btn-primary float-right" type="submit" name="update_user">
                                    Update&nbsp;<i class="fa fa-refresh"></i>
                                </button>
                                <a href="users.php" class="btn btn-outline btn-danger float-right mr-1">Cancel</a>
                            </div>
                        </form>

                        <!-- Change password Modal Small -->
                        <div class="modal fade" id="modalConfirmChange" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <!--Content-->
                                <div class="modal-content form-elegant">
                                    <!--Header-->
                                    <div class="modal-header justify-content-center">
                                        <h4 class="heading">Change Password</h4>
                                    </div>

                                    <!--Body-->
                                    <div class="modal-body">

                                        <form action="actions.php" method="post" style="width: 100%;">
                                            <input type="hidden" name="change_pass_id" value="<?=$get_user['id']?>">
<!--                                            ==========================-->
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                    <div class="card-body form-type-material">
                                                        <div class="form-group">
                                                            <input type="password" class="form-control" id="password" name="password">
                                                            <label for="password">Password</label>
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="password" class="form-control" id="con_password" name="con_password">
                                                            <label for="con_password">Confirm Password</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
<!--                                            ==========================-->
                                            <!--Footer-->
                                            <div class="modal-footer flex-center">
                                                <a type="button" class="btn btn-outline btn-danger" data-dismiss="modal">Cancel</a>
                                                <button type="submit" class="btn btn-primary" name="change_user_pass">Change</button>
                                            </div>
                                        </form>

                                    </div>


                                </div>
                                <!--/.Content-->
                            </div>
                        </div>
                        <!-- Central Modal Small -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?=mi_include('footer_extra.php');?>
</main>
<!-- END Main container -->


<?=mi_footer();?>
