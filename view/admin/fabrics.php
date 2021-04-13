<?php
$role_session = mi_get_session('role');
if ($role_session['tailoring'] != 1){
    mi_redirect(MI_BASE_URL.'admin/index.php');
}
?>

<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>


    <!-- Main container -->
    <main>

        <div class="main-content">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <h4 class="card-title"><strong>Fabrics</strong></h4>

                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="fabric-datatable" data-provide="datatables">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Thumb</th>
                                    <th>Info</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th style="width: 100px;">Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Thumb</th>
                                    <th>Info</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th style="width: 100px;">Actions</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                $get_fabrics = mi_db_read_all('fabrics', 'id', 'DESC');
                                if (count($get_fabrics)>0){
                                    foreach ($get_fabrics as $key => $fab){
                                        $category = ((!empty($fab['category']))?mi_db_read_by_id('categories', array('id'=>$fab['category']))[0]['name']:'Uncategorized');
                                        ?>
                                        <tr>
                                            <td><?=$key+1;?></td>
                                            <td width="125px">
                                                <img src="<?=MI_BASE_URL.$fab['thumb'];?>" style="max-width: 115px;width: 100%;">
                                            </td>
                                            <td>
                                                <h4><?=$fab['title'];?></h4>
                                                <p><?=$fab['tag_ling'];?></p>
                                                <h5 class="font-weight-bold mb-0 pb-0">$<?=$fab['price'];?></h5>
                                            </td>

                                            <td>
                                               <?=mi_db_read_by_id('categories',array('id'=>$fab['category']))[0]['name'] ?>
                                            </td>
                                            
                                            <td>
                                                <div class="form-group form-type-material" style="max-width: 180px;">
                                                    <select class="form-control mi-status-update" mid="<?=$fab['id'];?>" mitype="fabric">
                                                        <option value="1" <?=($fab['status'] == 1)?'selected':'';?>>Active</option>
                                                        <option value="2" <?=($fab['status'] == 2)?'selected':'';?>>In active</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="width: 100px;">
                                                <a class="btn btn-dark btn-sm mb-2" href="single-fabric.php?f=<?=base64_encode($fab['id']);?>">View <i class="fa fa-eye"></i></a>
                                                <a val="<?=$fab['id']?>" class="btn btn-danger btn-sm text-white deleteFabric">Delete <i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    <?php }}else{?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Fabric Found!</td>
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
