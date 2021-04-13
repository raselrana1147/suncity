<?=mi_header();?>
<?=mi_nav();?>

    <!-- Jumbotron -->
    <div class="card card-image pt-5" style="background-image: url(<?=MI_CDN_URL?>'img/shutterstock_628722836.jpg');background-size: cover; background-repeat: no-repeat;">
        <div class="text-white text-center rgba-stylish-strong">
            <div class="py-5">
                <h2 class="card-title h2 my-4 py-2">All our fabric</h2>
            </div>
        </div>
    </div>

    <section class="blog-grid pt-3">
        <div class="container" id="mi_product_controller">
            <div class="row">
                <div class="col-12 card-header" style="border: 1px solid #e3e3e3;padding-top: 0px;">
                    <div class="jplist-panel box panel-top">

                        <!-- reset button -->
                        <button
                                type="button"
                                class="jplist-reset-btn"
                                data-control-type="reset"
                                data-control-name="reset"
                                data-control-action="reset">
                            Reset &nbsp;<i class="fas fa-sync-alt"></i>
                        </button>

                        <!-- items per page dropdown -->
                        <div
                                class="jplist-drop-down"
                                data-control-type="items-per-page-drop-down"
                                data-control-name="paging"
                                data-control-action="paging">

                            <ul>
                                <li><span data-number="12" data-default="true"> 12 per page </span></li>
                                <li><span data-number="18"> 18 per page </span></li>
                                <li><span data-number="24"> 24 per page </span></li>
                                <li><span data-number="all"> view all </span></li>
                            </ul>
                        </div>

                        <!-- sort dropdown -->
                        <div
                                class="jplist-drop-down"
                                data-control-type="sort-drop-down"
                                data-control-name="sort"
                                data-control-action="sort"
                                data-datetime-format="{month}/{day}/{year}"> <!-- {year}, {month}, {day}, {hour}, {min}, {sec} -->

                            <ul>
                                <li><span data-path="default">Sort by</span></li>
                                <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                                <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
                            </ul>
                        </div>

                        <!-- sort dropdown -->
                        <div
                                class="jplist-drop-down"
                                data-control-type="filter-drop-down"
                                data-control-name="category-filter"
                                data-control-action="filter"> <!-- {year}, {month}, {day}, {hour}, {min}, {sec} -->

                            <ul>
                                <li><span data-path="default">Sort by Category</span></li>
                                <?php
                                $catslad = mi_db_read_all('categories');
                                foreach ($catslad as $catl){
                                    ?>
                                    <li>
                                        <span data-path=".<?=$catl['slug']?>" data-order="asc" data-type="text">
                                            <?=$catl['name'];?>
                                        </span>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>

                        <!-- sort dropdown -->
                        <div
                                class="jplist-drop-down"
                                data-control-type="filter-drop-down"
                                data-control-name="type-filter"
                                data-control-action="filter">
                            <ul>
                                <li><span data-path="default">Sort by Type</span></li>
                                <li><span data-path=".regular">Regular</span></li>
                                <li><span data-path=".featured">Featured</span></li>
                                <li><span data-path=".premium">Premium</span></li>
                                <li><span data-path=".luxury">Luxury</span></li>
                                <li><span data-path=".non-iron">Non-iron</span></li>
                            </ul>
                        </div>

                        <!-- sort dropdown -->
                        <div
                                class="jplist-drop-down"
                                data-control-type="filter-drop-down"
                                data-control-name="weight-filter"
                                data-control-action="filter">

                            <ul>
                                <li><span data-path="default">Sort by Weight</span></li>
                                <li><span data-path=".regular">Regular</span></li>
                                <li><span data-path=".very-light">Very Light</span></li>
                                <li><span data-path=".medium">Medium</span></li>
                                <li><span data-path=".heavy">Heavy</span></li>
                                <li><span data-path=".veryheavy">Very Heavy</span></li>
                            </ul>
                        </div>


                        <!-- filter by title -->
                        <div class="text-filter-box">

                            <i class="fa fa-search jplist-icon"></i>

                            <!--[if lt IE 10]>
                            <div class="jplist-label">Filter by Title:</div>
                            <![endif]-->

                            <div class="md-form float-left m-0">
                                <input
                                        data-path=".title"
                                        type="text"
                                        value=""
                                        placeholder="Filter by Title"
                                        data-control-type="textbox"
                                        data-control-name="title-filter"
                                        data-control-action="filter"
                                        class="form-control"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row list">
                        <?php
                            $get_fabs = mi_db_read_by_id('fabrics', array('status'=>1), false, 'id', 'DESC');

                            if (count($get_fabs) > 0){
                                foreach ($get_fabs as $feb){
                                    if ($feb['type'] == 1){
                                        $type = 'Regular';
                                    }elseif($feb['type'] == 2){
                                        $type = 'Featured';
                                    }elseif($feb['type'] == 3){
                                        $type = 'Premium';
                                    }elseif($feb['type'] == 4){
                                        $type = 'Luxury';
                                    }elseif($feb['type'] == 5){
                                        $type = 'Non-iron';
                                    }else{
                                        $type = 'All';
                                    }

                                    if ($feb['weight'] == 1){
                                        $weight = 'Regular';
                                    }elseif($feb['weight'] == 2){
                                        $weight = 'Very Light';
                                    }elseif($feb['weight'] == 3){
                                        $weight = 'Light';
                                    }elseif($feb['weight'] == 4){
                                        $weight = 'Medium';
                                    }elseif($feb['weight'] == 5){
                                        $weight = 'Heavy';
                                    }elseif($feb['weight'] == 6){
                                        $weight = 'Very Heavy';
                                    }else{
                                        $weight = 'N/A';
                                    }

                                    $category = mi_db_read_by_id('categories', array('id'=>$feb['category']))[0];
                        ?>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6 list-item mb-3">

                            <!--Card-->
                            <div class="card card-cascade card-ecommerce shadow-none border">

                                <!--Card image-->
                                <div class="view view-cascade overlay img-box">
                                    <div class="card-img-top" alt="" style="  max-height: 250px;
                                            height: 250px;
                                            background: url('<?=MI_CDN_URL.$feb['shape']?>');
                                            background-repeat: no-repeat;
                                            background-size: contain;
                                            background-position: center;
                                            text-indent: -9999px;">
                                        <a href="<?=MI_BASE_URL.'single.php?fab='.$feb['id'];?>"
                                           data-lcl-txt="<?=$feb['title'];?>"
                                           data-lcl-author="<?=$feb['title'];?>"
                                           data-lcl-thumb="<?=MI_CDN_URL.$feb['shape'];?>">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                </div>
                                <!--/.Card image-->

                                <!--Card content-->
                                <div class="card-body card-body-cascade text-center">
                                    <!--Category & Title-->
                                    <h6 class="<?=$category['slug'];?>">
                                        <a href="<?=MI_BASE_URL.'single.php?fab='.$feb['id'];?>">
                                            <?=$category['name'];?>
                                        </a>
                                    </h6>
                                    <h5 class="card-title">
                                        <strong>
                                            <a href="<?=MI_BASE_URL.'single.php?fab='.$feb['id'];?>" class="title text-dark">
                                                <?=substr($feb['title'], 0, 18).'..';?>
                                            </a>
                                        </strong>
                                    </h5>

                                    <!--Description-->
<!--                                    <p class="card-text">Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe-->
<!--                                        eveniet ut et voluptates.-->
<!--                                    </p>-->
                                    <p class="card-text text-left">
                                        <small>
                                            <i class="fa fa-star"></i>&nbsp;Type:
                                            <span class="<?=strtolower($type);?>"><?=$type;?></span>
                                        </small>
                                        &nbsp;&nbsp;|&nbsp;&nbsp;
                                        <small>
                                            <i class="fa fa-weight"></i>&nbsp;Weight:
                                            <span class="<?=str_replace(' ', '', strtolower($weight));?>"><?=$weight;?></span>
                                        </small>
                                        <br>
                                        <small>
                                            <i class="fa fa-paint-brush"></i>&nbsp;Color:
                                            <?=$feb['color'];?>
                                        </small>
                                    </p>

                                    <!--Card footer-->
                                    <div class="card-footer" style="padding: 0;padding-top: 5px;background: no-repeat;">
                                        <span class="float-left">$<?=$feb['price'];?></span>
                                        <span class="float-right">
                                            <a class="btn btn-dark btn-sm m-0" href="<?=MI_BASE_URL.'design.php?fab='.$feb['id'];?>">
                                                Customize <i class="fas fa-cut"></i>
                                            </a>
                                        </span>
                                    </div>

                                </div>
                                <!--/.Card content-->

                            </div>
                            <!--/.Card-->

                        </div>
                        <?php }}else{?>
                        <div class="col-12">
                            <h3 class="text-center">No Items Found!</h3>
                        </div>
                        <?php }?>

                    </div>
                    <div class="post-pagination">
                        <div class="jplist-panel box panel-top">
                            <!-- pagination results -->
                            <div
                                    class="jplist-label"
                                    data-type="Page {current} of {pages}"
                                    data-control-type="pagination-info"
                                    data-control-name="paging"
                                    data-control-action="paging">
                            </div>

                            <!-- pagination control -->
                            <div
                                    class="jplist-pagination"
                                    data-control-type="pagination"
                                    data-control-name="paging"
                                    data-control-action="paging">
                            </div>

                        </div>
                    </div><!-- /.post-pagination -->
                </div>
            </div>
        </div><!-- /.container -->
    </section>


<?=mi_include('foot.php');?>
<?=mi_footer();?>