<?php
    $footer_title = mi_db_read_by_id('settings', array('meta_name' => 'footer_title'))[0];
    $footer_text = mi_db_read_by_id('settings', array('meta_name' => 'footer_text'))[0];
    $footer_copyright = mi_db_read_by_id('settings', array('meta_name' => 'footer_copyright'))[0];
    $copyright_link = mi_db_read_by_id('settings', array('meta_name' => 'copyright_link'))[0];
    $icons = mi_db_read_by_id('settings', array('type'=> 'social_icon'));

$pages = mi_db_read_by_id('pages', array('status'=>1));
?>

<div class="w-100 pt-5 pb-5"></div>

<div class="container-full">

    <!-- Section -->
    <section class="container-full"
             style="
             background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/Work/full%20page/img%20(2).jpg');
             background-repeat: no-repeat; background-size: cover;
             background-position: center center;"
    >

        <style>
            .input-grey .input-group-lg>.input-group-prepend>.input-group-text {
                border-radius: .125rem;
            }

            .input-grey .form-control {
                border-radius: .125rem;
            }

            .input-grey .form-control.form-control-lg {
                font-size: 1rem;
            }

            .form-control:focus {
                background-color: rgba(255,255,255,.3);
            }

            .input-grey input::placeholder {
                color: #fff;
            }

            .input-grey .input-group-lg>.form-control:not(textarea) {
                height: calc(1.5em + 1rem + 8px);
            }

            .social .fab {
                width: 30px;
                height: 30px;
            }
        </style>

        <div class="container-full mask rgba-black-strong py-5" style="background: rgb(46 46 46 / 80%);">

            <div class="container text-center my-5">

                <h3 class="font-weight-bold text-center white-text pb-2">News and Updates</h3>
                <p class="lead text-center white-text pt-2 mb-5">Subscribe to our newsletter and receive the latest news
                    from MDB.</p>

                <form class="input-grey mb-5" action="" method="post" target="_blank">
                    <div class="form-row">
                        <div class="col-md-4 ml-auto">
                            <div class="input-group input-group-lg z-depth-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rgba-white-light border-0"><i class="fa fa-envelope white-text"></i></span>
                                </div>
                                <input type="email" name="EMAIL" class="form-control form-control-lg rgba-white-light white-text border-0 z-depth-0" placeholder="Email Address">
                            </div>
                        </div>

                        <div class="col-md-2 mr-auto">
                            <button class="btn btn-block btn-primary">Subscribe</button>
                        </div>
                    </div>
                </form>

                <div class="social text-center">
                    <?php foreach ($icons as $icon){?>
                        <a class="mx-1" href="<?=$icon['meta_value']?>">
                            <i class="fab <?=$icon['meta_name']?>"></i>
                        </a>
                    <?php }?>

                </div>

            </div>

        </div>

    </section>
    <!-- Section -->

</div>



<!-- Footer -->
<footer class="page-footer font-small elegant-color pt-4">

    <!-- Footer Links -->
    <div class="container text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-6 mt-md-0 mt-3">

                <!-- Content -->
                <h5 class="text-uppercase"><?=$footer_title['meta_value']?></h5>
                <p><?=$footer_text['meta_value']?></p>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none pb-3">

            <!-- Grid column -->
            <div class="col-md-3 mb-md-0 mb-3">

                <!-- Links -->
                <h5 class="text-uppercase">Quick Links</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="shop.php">Shop</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact Us</a>
                    </li>
                </ul>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 mb-md-0 mb-3">

                <!-- Links -->
                <h5 class="text-uppercase">Others</h5>

                <ul class="list-unstyled">
                    <?php foreach ($pages as $page){?>

                        <li>
                            <a href="<?=MI_BASE_URL;?>page.php?page=<?=$page['id']?>"><?=$page['title']?></a>
                        </li>

                    <?php }?>
                </ul>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3 elegant-color-dark">© 2020 Copyright:
        <a href="<?=$copyright_link['meta_value']?>"><?=$footer_copyright['meta_value']?></a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->