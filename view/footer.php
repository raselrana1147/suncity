<?php
$payment= mi_db_read_by_id('settings', array('type' => 'payment_getaway'));
$pma = [];
foreach ($payment as $pm){
    $pma[$pm['meta_name']] = $pm['meta_value'];
}
?>

<!-- jQuery -->
<script type="text/javascript" src="<?=MI_BASE_URL;?>js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?=MI_BASE_URL;?>js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?=MI_BASE_URL;?>js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?=MI_BASE_URL;?>js/mdb.min.js"></script>
<script type="text/javascript" src="<?=MI_BASE_URL;?>plugins/toast/jquery.toast.min.js"></script>
<script src="<?=MI_BASE_URL;?>js/jquery-ui.js"></script>


<script src="<?=MI_BASE_URL;?>plugins/paginator/js/jplist.core.min.js"></script>
<script src="<?=MI_BASE_URL;?>plugins/paginator/js/jplist.history-bundle.min.js"></script>
<script src="<?=MI_BASE_URL;?>plugins/paginator/js/jplist.sort-bundle.min.js"></script>
<script src="<?=MI_BASE_URL;?>plugins/paginator/js/jplist.pagination-bundle.min.js"></script>
<script src="<?=MI_BASE_URL;?>plugins/paginator/js/jplist.textbox-filter.min.js"></script>
<script src="<?=MI_BASE_URL;?>plugins/paginator/js/jplist.filter-dropdown-bundle.min.js"></script>
<script src="<?=MI_BASE_URL;?>plugins/paginator/js/jplist.filter-toggle-bundle.min.js"></script>

<script type="text/javascript" src="<?=MI_BASE_URL;?>js/mi.js"></script>
</body>
</html>