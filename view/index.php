<?=mi_header();?>
<?=mi_nav();?>
<?php
    if (isset($_GET['cat']) && !empty($_GET['cat'])){
        $get_fab_id = mi_db_read_by_id('fabrics', array('status'=>1, 'category'=>mi_secure_input($_GET['cat'])));
        if (count($get_fab_id)>0){
            $fabid = $get_fab_id[0];
        }else{
            $get_fab_id = mi_db_read_by_id('fabrics', array('is_default'=>1, 'status'=>1));
            $fabid = $get_fab_id[0];
        }
    }elseif (isset($_GET['search']) && !empty($_GET['search'])){
        $get_fab_id = mi_db_tbl_like('fabrics', 'ANY', 'title', mi_secure_input($_GET['search']));
        if (count($get_fab_id)>0){
            $fabid = $get_fab_id[0];
        }else{
            $get_fab_id = mi_db_read_by_id('fabrics', array('is_default'=>1, 'status'=>1));
            $fabid = $get_fab_id[0];
        }
    }else{
        $get_fab_id = mi_db_read_by_id('fabrics', array('is_default'=>1, 'status'=>1));
        $fabid = $get_fab_id[0];
    }
?>
<input type="hidden" id="default_fabric_id" value="<?=((isset($fabid['id']) && !empty($fabid['id']))?$fabid['id']:'');?>">
  <div class="container-fluid mi_shirt_configurator">
    <div class="row">
      <div id="loader"></div>

      <div class="card w-100" style="height: 100vh;overflow: hidden;">
        <div class="card-body p-0">

            <div class="row">
                <div class="mi_canvas_container col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <img src="" id="fabric_picture_large" class="w-100">
                        </div>
                        <div class="col-12 col-md-6">
                            <h3 class="fabric_title"></h3>
                            <p class="fabric_tagline"></p>
                            <div class="mi_fabric_details text-justify">

                            </div>
                        </div>

                        <div class="col-12 mi_designer_footer">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-6">
                                    <h5>Main Branch</h5>
                                    <p class="mb-0">
                                        <i class="fa fa-map-marker-alt"></i> &nbsp;
                                        26/6, Mirpur Road (Ground Floor), Opposite of Dhaka College Near Patrol Pump New Market, Dhaka-1205<br>
                                        <i class="fa fa-phone"></i> &nbsp; +8802 9669997 &nbsp; <i class="fa fa-mobile"></i> &nbsp; 01732562227
                                    </p>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <h5>Branch-1</h5>
                                    <p class="mb-0">
                                        <i class="fa fa-map-marker-alt"></i> &nbsp;
                                        159 Shanti Nagar (1st floor) <br>Opp. of Estern Plus Market Dhaka-1217.<br>
                                        <i class="fa fa-phone"></i> &nbsp; +8802 8331335 &nbsp; <i class="fa fa-mobile"></i> &nbsp; 01732699925
                                    </p>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <h5>Branch-1</h5>
                                    <p class="mb-0">
                                        <i class="fa fa-map-marker-alt"></i> &nbsp;
                                        8,Mirpur Road(1st Floor) Dhaka-1205 (Oppo.Dhaka College)<br>
                                        <i class="fa fa-phone"></i> &nbsp; +88029661771 &nbsp; <i class="fa fa-mobile"></i> &nbsp; 01744464698
                                    </p>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6 navbar">
                                    <ul class="navbar-nav ml-auto nav-flex-icons">
                                        <li class="nav-item mx-1">
                                            <img src="uploads/17years.png">
                                        </li>
                                        <li class="nav-item mx-1">
                                            <img src="uploads/quali-1.png">
                                        </li>
                                        <li class="nav-item mx-1">
                                            <img src="uploads/best-price.png">
                                        </li>
                                        <li class="nav-item mx-1">
                                            <img src="uploads/timely-delivery-1.png">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-4 col-sm-5 col-12 pr-0" id="fabricBaseContainer">
                    <div class="mi_fabric_container" style="overflow: auto!important;">
                        <div class="mi_filter_area">
                            <div class="filter_loader"></div>
                            <p class="mb-0 pb-0 border-bottom">
                                <button class="close">
                                    <i class="fa fa-times"></i>
                                </button>
                                Filter
                            </p>
                            <div class="md-form input-group mb-3">
                                <form action="<?=MI_BASE_URL;?>" method="get" class="d-flex w-100">
                                    <input type="text" class="form-control" placeholder="Search by fabric name" name="search">
                                    <div class="input-group-append">
                                        <button class="btn btn-md btn-dark m-0 px-3" type="submit" id="fabric_Search_button">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <ul class="list-group z-depth-0" id="mi_fabric_list_container" mi-val="<?=((isset($_GET['cat']) && !empty($_GET['cat']))?$_GET['cat']:((isset($_GET['search']) && !empty($_GET['search']))?$fabid['category']:''))?>">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- Card -->
    </div>
  </div>
  <!-- End your project here-->


<?=mi_footer();?>



