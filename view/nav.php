<?php

    $brand_logo = mi_db_read_by_id('settings', array('meta_name' => 'site_logo'))[0];

    $pages = mi_db_read_by_id('pages', array('status'=>1));

?>


<!--Navbar -->

<nav class="navbar navbar-expand-lg fixed-top bg-white" style="padding-top: 0px;padding-bottom: 0px;z-index: 999999999;">

    <div class="container-fluid">

        <a class="navbar-brand2" href="<?=MI_BASE_URL;?>">

            <img src="<?=MI_CDN_URL.$brand_logo['meta_value'];?>" style="width: 250px;">

        </a>

        <button class="navbar-toggler nav_icon" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"

                aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon">
                <i class="fa fa-bars"></i>
            </span>

        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">

            <a class="navbar-brand" href="<?=MI_BASE_URL;?>">

                <img src="<?=MI_CDN_URL.$brand_logo['meta_value'];?>" style="width: 340px;">

            </a>

            <ul class="navbar-nav mr-auto ml-lg-3">
                <?php
                    $get_cats = mi_db_read_by_id('categories', array('parent_id'=>0, 'status'=>1));
                    if (count($get_cats)>0){
                        foreach ($get_cats as $cat){
                            $get_sub = mi_db_read_by_id('categories', array('parent_id'=>$cat['id']));
                ?>
                    <li class="nav-item <?=((count($get_sub)>0)?'dropdown':'');?>">
                        <a class="nav-link <?=((count($get_sub)>0)?'dropdown-toggle':'');?>" href="<?=MI_BASE_URL.'index.php?cat='.$cat['id'];?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?=$cat['name'];?>
                        </a>
                        <?php
                            if (count($get_sub)>0){?>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php foreach ($get_sub as $sub){?>
                                    <a class="dropdown-item" href="<?=MI_BASE_URL.'index.php?cat='.$sub['id'];?>"><?=$sub['name'];?></a>
                                    <?php }?>
                                </div>
                        <?php }?>
                    </li>
                <?php }}?>
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">

                <li class="nav-item mx-2" style="line-height: 10px;">

                    <i class="fa fa-phone"></i> &nbsp; <label class="font-weight-bold">+88029669997, 01732562227</label>
                    <small class="d-block ml-4 pl-1">Email: suncitytailors@gmail.com</small>

                </li>
                <li class="nav-item mx-2">
                    <img src="uploads/getaway.png">
                </li>
            </ul>

        </div>

    </div>

</nav>

<!--/.Navbar -->