<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>

    <!-- Main container -->
    <main>
        <?php
            $role_session = mi_get_session('role');
        ?>
        <div class="main-content">
            <div class="row">

                <div class="col-6 col-lg-3">
                    <div class="card card-body bg-info">
                        <h6 class="text-uppercase text-white">Completed Orders</h6>
                        <div class="flexbox mt-2">
                            <i class="pe-7s-shopbag text-white fs-30"></i>
                            <span class="fs-30"><?=count(mi_db_read_by_id('mi_orders', array('order_status'=>4)));?></span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card card-body bg-primary">
                        <h6 class="text-uppercase text-white">Pending Orders</h6>
                        <div class="flexbox mt-2">
                            <i class="pe-7s-refresh-2 text-white fs-30"></i>
                            <span class="fs-30"><?=count(mi_db_read_by_id('mi_orders', array('order_status'=>1)))+count(mi_db_read_by_id('mi_orders', array('order_status'=>2)));?></span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card card-body bg-danger">
                        <h6 class="text-uppercase text-white">Cancelled Orders</h6>
                        <div class="flexbox mt-2">
                            <i class="pe-7s-close-circle text-white fs-30"></i>
                            <span class="fs-30"><?=count(mi_db_read_by_id('mi_orders', array('order_status'=>5)))?></span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card card-body bg-cyan">
                        <h6 class="text-uppercase text-white">Total Users</h6>
                        <div class="flexbox mt-2">
                            <i class="pe-7s-users text-white fs-30"></i>
                            <span class="fs-30"><?=count(mi_db_read_all('mi_users'))?></span>
                        </div>
                    </div>
                </div>
                <?php if ($role_session['orders'] == 1){?>
                 <div class="col-12 col-lg-12">
                    <div class="card">
                        <h4 class="card-title"><strong>Recent</strong> Orders</h4>

                        <div class="card-body">
                            <table class="table table-striped table-bordered" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Id</th>
                                    <th>User Info</th>
                                    <th>Payment Info</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th style="width: 100px;">Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Order Id</th>
                                    <th>User Info</th>
                                    <th>Payment Info</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th style="width: 100px;">Actions</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                $get_my_ord = mi_db_read_all('mi_orders', 'id', 'DESC', 5);
                                if (count($get_my_ord)>0){
                                    foreach ($get_my_ord as $key => $ord){
                                        $totals = [];
                                        $items = 0;
                                        $qty = [];
                                        foreach (json_decode($ord['shirt_details'], true) as $ttl){
                                            $totals[] = ($ttl['total_amount']*$ttl['qty']);
                                            $items+=1;
                                            $qty[] = $ttl['qty'];
                                        }
                                        $user = json_decode($ord['shipping_details'], true);
                                        $delv = json_decode($ord['delivery_method'], true);
                                        ?>
                                        <tr>
                                            <td><?=$key+1;?></td>
                                            <td>
                                                <h5><?=$ord['order_id'];?></h5>
                                                <small><?=date('M d, Y - H:i a', strtotime($ord['created_at']));?></small>
                                            </td>
                                            <td>
                                                Name: <?=$user['name'];?><br>
                                                Email: <?=$user['email'];?><br>
                                                Phone: <?=$user['phone'];?><br>
                                                Address: <?=$user['address'];?>
                                            </td>
                                            <td>
                                                <h5>Method: <?=($ord['payment_method'] == 1)?'Paypal':'Card';?></h5>
                                                Status: <?=($ord['payment_status'] == 1)?'Unpaid':'Paid';?><br>
                                                <?php if ($ord['payment_status'] == 2){?>
                                                    Trx id: <?=$ord['payment_id'];?>
                                                <?php }?>
                                            </td>
                                            <td><h5>$<?=array_sum($totals);?></h5></td>
                                            <td>
                                                <h6><?=($ord['order_status'] == 1?'Pending':($ord['order_status'] == 2?'Processing':($ord['order_status'] == 3?'Shipping':($ord['order_status'] == 4?'Delivered':($ord['order_status'] == 5?'Cancelled':'Cancellation requested')))))?></h6>

                                            </td>
                                            <td style="width: 100px;">
                                                <a class="btn btn-dark btn-sm mb-2" href="single-order.php?o=<?=base64_encode($ord['id']);?>">View <i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php }}else{?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Orders Found!</td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php }?>

            </div>
        </div>

      <?=mi_include('footer_extra.php');?>
    </main>
    <!-- END Main container -->


<?=mi_footer();?>
