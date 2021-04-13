<?php
    $role_session = mi_get_session('role');
    if ($role_session['tailoring'] != 1){
        mi_redirect(MI_BASE_URL.'admin/index.php');
    }
?>

<?php
    if (isset($_GET['e']) && !empty($_GET['e'])){
        $get = mi_db_read_by_id('categories', array('id'=>mi_secure_input($_GET['e'])))[0];
    }
?>
<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>

    <!-- Main container -->
    <main>

        <div class="main-content pt-5 mt-5">
            <div class="row">
                <div class="col-12 col-lg-5 col-md-5">
                    <div class="card pb-3">
                        <h4 class="card-title"><strong><?=isset($_GET['e'])  ? "Edit " : "Add " ?>category</strong></h4>
                        <form action="actions.php" method="post" style="width: 100%;">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <input type="hidden" name="cat_id" value="<?= (isset($_GET['e'])) ? $get['id'] : '' ?>">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name" 
                                            value="<?= (isset($_GET['e']) && !empty($_GET['e'])) ? $get['name'] : '';?>">
                                            <label for="name">Name</label>
                                        </div>

                                        <div class="form-group">
                                            <select class="form-control" name="parent_id">
                                                 <option value="0">Select Parent Category</option>
                                                <?php 
                                                    $parents=mi_db_read_by_id('categories',array('status'=>1));
                                                    foreach ($parents as $parent) {
                                                 ?>
                                                <option value="<?=$parent['id'] ?>" <?= isset($_GET['e']) ? ($parent['id']==$get['parent_id']) ? 'selected': '' : '' ?>><?=$parent['name'] ?></option>
                                            <?php } ?>
                                              
                                            </select>
                                            <label class="label-floated">Parent Category</label>
                                        </div>

                                        <div class="form-group">
                                            <select class="form-control" name="status">
                                                <option value="1" <?=(!empty($get['status']) && $get['status'] == 1)?'selected':'';?>>Active</option>
                                                <option value="2" <?=(!empty($get['status']) && $get['status'] == 2)?'selected':'';?>>In active</option>
                                            </select>
                                            <label class="label-floated">Status</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 card-footer">
                                <button class="btn btn-dark float-right" type="submit" name="category_<?=(isset($_GET['e']) ? 'update' : 'save' )?>">
                                    <?=(!empty($get['name']))?'Update':'Save';?> category &nbsp;&nbsp;<i class="fa fa-<?=(!empty($get['name']))?'refresh':'save';?>"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-lg-7 col-md-7">
                    <div class="card">
                        <h4 class="card-title"><strong>Categories</strong></h4>
                        <div class="card-body">
                            <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>P.Cat</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $get_cat = mi_db_read_all('categories', 'id', 'DESC');
                                        foreach ($get_cat as $key => $cat){
                                    ?>
                                            <tr>
                                                <td><?=$key+1?></td>
                                                <td><?=$cat['name']?></td>
                                                <td>
                                                  <?=mi_db_read_by_id('categories',array('id'=>$cat['parent_id']))[0]['name'];?>
                                                  
                                                </td>
                                                <td><?=(($cat['status'] == 1)?'Active':'Deactive')?></td>
                                                <td>
                                                    <a class="btn btn-dark btn-sm" href="categories.php?e=<?=$cat['id']?>" style="margin-bottom: 5px">Edit &nbsp;<i class="fa fa-edit"></i></a>
                                                    <a val="<?=$cat['id']?>" class="btn btn-danger btn-sm text-white deleteCategory">Delete &nbsp;<i class="fa fa-trash"></i></a>
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
