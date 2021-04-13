
<?php
$role_session = mi_get_session('role');
if ($role_session['settings'] != 1){
    mi_redirect(MI_BASE_URL.'admin/index.php');
}
?>

<?=mi_header();?>
<?=mi_sidebar();?>
<?=mi_nav();?>
<?php
    $sitetitle        = mi_db_read_by_id('settings', array('meta_name' => 'site_title_text', 'type' => 'home_page'))[0];
    $site_logo        = mi_db_read_by_id('settings', array('meta_name' => 'site_logo', 'type' => 'home_page'))[0];
    $footer_title     = mi_db_read_by_id('settings', array('meta_name' => 'footer_title', 'type' => 'footer'))[0];
    $footer_text      = mi_db_read_by_id('settings', array('meta_name' => 'footer_text', 'type' => 'footer'))[0];
    $copyright_link   = mi_db_read_by_id('settings', array('meta_name' => 'copyright_link', 'type' => 'footer'))[0];
    $footer_copyright = mi_db_read_by_id('settings', array('meta_name' => 'footer_copyright', 'type' => 'footer'))[0];
    
    $facebook         = mi_db_read_by_id('settings', array('meta_name' => 'fa-facebook', 'type' => 'social_icon'))[0];
    $twitter          = mi_db_read_by_id('settings', array('meta_name' => 'fa-twitter', 'type' => 'social_icon'))[0];
    $linkedin         = mi_db_read_by_id('settings', array('meta_name' => 'fa-linkedin', 'type' => 'social_icon'))[0];
    $instagram        = mi_db_read_by_id('settings', array('meta_name' => 'fa-instagram', 'type' => 'social_icon'))[0];

  $fabric_thumb            = mi_db_read_by_id('settings', array('meta_name' => 'fabric_thumb', 'type' => 'shirt_element'))[0];
  $button_thumb            = mi_db_read_by_id('settings', array('meta_name' => 'button_thumb', 'type' => 'shirt_element'))[0];
  $button_thread_thumb     = mi_db_read_by_id('settings', array('meta_name' => 'button_thread_thumb', 'type' => 'shirt_element'))[0];
  $contrast_thumb          = mi_db_read_by_id('settings', array('meta_name' => 'contrast_thumb', 'type' => 'shirt_element'))[0];
  $embroidery_thumb        = mi_db_read_by_id('settings', array('meta_name' => 'embroidery_thumb', 'type' => 'shirt_element'))[0];
  $button_hole_thread_thumb= mi_db_read_by_id('settings', array('meta_name' => 'button_hole_thread_thumb', 'type' => 'shirt_element'))[0];

   $paypal_client_id = mi_db_read_by_id('settings', array('meta_name' => 'paypal_client_id', 'type' => 'payment_getaway'))[0];
   $paypal_currency  = mi_db_read_by_id('settings', array('meta_name' => 'paypal_currency', 'type' => 'payment_getaway'))[0];

   $contact_info    = mi_db_read_by_id('settings', array('meta_name' => 'contact_info', 'type' => 'contact'))[0];



?>
<main>
    <div class="main-content">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4><strong>Home Page Settings</strong></h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="card-body form-type-material">
                                    <div class="form-group">
                                        <h5><strong style="font-weight: 500;">Home Page Info</strong></h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 code code-card code-fold">
                                                <h6 class="code-title">Home page Logo</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <img src="<?=MI_BASE_URL.$site_logo['meta_value'];?>" alt="">
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeHomePageLogo">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 code code-card code-fold">
                                                <h6 class="code-title">Site Title</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                           <p class="text-justify"><?=$sitetitle['meta_value']?></p>
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeSiteTitle">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                        </div>
                                             <h5><strong style="font-weight: 500;">Footer Section</strong></h5>
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3 code code-card code-fold">
                                                <h6 class="code-title">Footer Title</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <p><?=$footer_title['meta_value']?></p>
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeFooterTitle">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-lg-3 code code-card code-fold">
                                                <h6 class="code-title">Footer Text</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <p class="text-justify"><?=$footer_text['meta_value']?></p>
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeFooterText">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-lg-3 code code-card code-fold">
                                                <h6 class="code-title">Footer Copy right</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <p><?=$footer_copyright['meta_value']?></p>
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changefooterCopyrightText">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-lg-3 code code-card code-fold">
                                                <h6 class="code-title">Footer Copy right link</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <p><?=$copyright_link['meta_value']?></p>
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changefooterCopyrightLink">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>

                                        </div>

                                        <h5><strong style="font-weight: 500;">Social Icon Settings</strong></h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3 code code-card code-fold">
                                                <h6 class="code-title">Faebook</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <p class="text-justify"><?=$facebook['meta_value']?></p>
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeFacebook">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-lg-3 code code-card code-fold">
                                                <h6 class="code-title">Twitter</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <p><?=$twitter['meta_value']?></p>
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeTwitter">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-lg-3 code code-card code-fold">
                                                <h6 class="code-title">Linked In</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <p><?=$linkedin['meta_value']?></p>
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeLinkedIn">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-lg-3 code code-card code-fold">
                                                <h6 class="code-title">Instragram</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <p><?=$instagram['meta_value']?></p>
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeInstragram">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                        </div>

                                        <h5><strong style="font-weight: 500;">Shirt Element's Settings</strong></h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4 code code-card code-fold">
                                                <h6 class="code-title">Fabric Thumb</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                           
                                                            <img src="<?=MI_BASE_URL.$fabric_thumb['meta_value'];?>" alt="fabric">
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeFabricThumb">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 code code-card code-fold">
                                                <h6 class="code-title">Button Thumb</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                           
                                                            <img src="<?=MI_BASE_URL.$button_thumb['meta_value'];?>" alt="button">
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeButtonThumb">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 code code-card code-fold">
                                                <h6 class="code-title">Thread Thumb</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                           
                                                            <img src="<?=MI_BASE_URL.$button_thread_thumb['meta_value'];?>" alt="button">
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeButtonThreatThumb">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 code code-card code-fold">
                                                <h6 class="code-title">Constrast Thumb</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                           
                                                            <img src="<?=MI_BASE_URL.$contrast_thumb['meta_value'];?>" alt="button">
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeConstrastThumb">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                             <div class="col-md-4 col-lg-4 code code-card code-fold">
                                                <h6 class="code-title">Embroidery Thumb</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                           
                                                            <img src="<?=MI_BASE_URL.$embroidery_thumb['meta_value'];?>" alt="button">
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeEmbroideryThumb">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 code code-card code-fold">
                                                <h6 class="code-title">Button Hole Threat Thumb</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                           
                                                            <img src="<?=MI_BASE_URL.$button_hole_thread_thumb['meta_value'];?>" alt="button">
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeBHTThumb">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <h5><strong style="font-weight: 500;">Paypal Getaway Settings</strong></h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4 code code-card code-fold">
                                                <h6 class="code-title">paypal client Id </h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <p class="text-justify"><?=$paypal_client_id['meta_value']?></p>
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changePaypalCID">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 code code-card code-fold">
                                                <h6 class="code-title">Paypal Currency</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <p class="text-justify"><?=$paypal_currency['meta_value']?></p>
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changePaypalC">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-lg-4 code code-card code-fold">
                                                <h6 class="code-title">Contact Info</h6>

                                                <div class="code-preview">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <p class="text-justify"><?=$contact_info['meta_value']?></p>
                                                        </div>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#changeContact">
                                                            <span class="fa fa-pencil lead text-info"></span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="code-toggler">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--=========================================Modal Items=============================================-->
        <!------------------------modal banner background change------------------------->
        <!-- Modal -->

         <div class="modal modal-center fade" id="changeContact" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Contact</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$contact_info['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="contact_info" value="<?=$contact_info['meta_value']?>">
                                            <label for="footer_title">Contact</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_contact_info_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-center fade" id="changePaypalC" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change paypal Curreny</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$paypal_currency['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="paypal_currency" value="<?=$paypal_currency['meta_value']?>">
                                            <label for="footer_title">Paypal ID</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_paypaCurrency_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-center fade" id="changePaypalCID" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change paypal Client ID</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$paypal_client_id['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="paypal_client_id" value="<?=$paypal_client_id['meta_value']?>">
                                            <label for="footer_title">Paypal ID</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_paypalId_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-center fade" id="changeBHTThumb" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Hole Threat Thumb</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$button_hole_thread_thumb['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <h6 class="mb-1">Threat Hole Threat Thumb<i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="button_hole_thread_thumb" data-provide="dropify" data-default-file="<?=(!empty($button_hole_thread_thumb['meta_value']))?MI_BASE_URL.$button_hole_thread_thumb['meta_value']:'';?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_ht_thumb_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-center fade" id="changeEmbroideryThumb" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change  Embroidery Thumb</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$embroidery_thumb['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <h6 class="mb-1">Threat Embroidery Thumb<i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="embroidery_thumb" data-provide="dropify" data-default-file="<?=(!empty($embroidery_thumb['meta_value']))?MI_BASE_URL.$embroidery_thumb['meta_value']:'';?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_embroidery_thumb_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal modal-center fade" id="changeConstrastThumb" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change  Contrast Thumb</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$contrast_thumb['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <h6 class="mb-1">Threat Contrast Thumb<i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="contrast_thumb" data-provide="dropify" data-default-file="<?=(!empty($contrast_thumb['meta_value']))?MI_BASE_URL.$contrast_thumb['meta_value']:'';?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_contrast_thumb_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-center fade" id="changeButtonThreatThumb" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Button Threat Thumb</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$button_thread_thumb['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <h6 class="mb-1">Threat Thumb<i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="button_thread_thumb" data-provide="dropify" data-default-file="<?=(!empty($button_thread_thumb['meta_value']))?MI_BASE_URL.$button_thread_thumb['meta_value']:'';?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_threat_thumb_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-center fade" id="changeButtonThumb" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Button Thumb</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$button_thumb['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <h6 class="mb-1">Button Thumb<i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="button_thumb" data-provide="dropify" data-default-file="<?=(!empty($button_thumb['meta_value']))?MI_BASE_URL.$button_thumb['meta_value']:'';?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_button_thumb_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-center fade" id="changeFabricThumb" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Fabric Thumb</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$fabric_thumb['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <h6 class="mb-1">Fabric Thumb<i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="fabric_thumb" data-provide="dropify" data-default-file="<?=(!empty($fabric_thumb['meta_value']))?MI_BASE_URL.$fabric_thumb['meta_value']:'';?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_fabric_thumb_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-center fade" id="changeHomePageLogo" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Home Page Logo</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$site_logo['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <h6 class="mb-1">Site Logo<i class="fa fa-info-circle float-right" data-provide="tooltip" data-placement="bottom" title="Image size must be 300x300 pixel"></i></h6>
                                            <input type="file" name="site_logo" data-provide="dropify" data-default-file="<?=(!empty($site_logo['meta_value']))?MI_BASE_URL.$site_logo['meta_value']:'';?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_site_logo_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------ end modal banner background change------------------------->

        <!------------------------modal banner change------------------------->
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeSiteTitle" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change home page title</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$sitetitle['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="site_title" value="<?=$sitetitle['meta_value']?>">
                                            <label for="footer_title">Home Page Title</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_site_title_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------ end banner change------------------------->

        <!------------------------modal banner title change------------------------->
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeFooterTitle" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Footer Title</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$footer_title['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="footer_title" value="<?=$footer_title['meta_value']?>">
                                            <label for="footer_title">Footer Title</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_footer_title_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------ end banner title change------------------------->

        <!------------------------modal banner text change------------------------->
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeFooterText" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Footer Text</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$footer_text['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <label for="banner_text">Footer Text</label>
                                            <textarea class="form-control" name="footer_text" rows="3"><?=htmlspecialchars_decode(html_entity_decode($footer_text['meta_value']))?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_footer_text_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------ end banner text change------------------------->

        <!------------------------modal banner button text change------------------------->
        <!-- Modal -->
        <div class="modal modal-center fade" id="changefooterCopyrightText" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Footer Copy Right</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$footer_copyright['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="footer_copyright" value="<?=$footer_copyright['meta_value']?>">
                                            <label for="banner_button_text">Footer Copy Right</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_footer_copyright_text_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-center fade" id="changefooterCopyrightLink" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Footer Copy Right Link</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$copyright_link['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="copyright_link" value="<?=$copyright_link['meta_value']?>">
                                            <label for="banner_button_text">Footer Copy Right Link</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_footer_copyright_link_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------ end banner button text change------------------------->


        <!------------------------modal best seller text change------------------------->
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeBestSellerText" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Best Seller Heading Text</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="best_seller_text_id" value="<?=$best_seller_text['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <label for="heading_content_text">Best Seller heading text</label>
                                            <textarea class="form-control" id="best_seller_text" name="best_seller_text" rows="3"><?=$best_seller_text['meta_value']?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_best_seller_text_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------ end best seller text change------------------------->

        <!------------------------modal best seller quantity change------------------------->
        <!-- Modal -->
      
        <!------------------------ end best seller quantity change------------------------->

        <!------------------------modal feature text change------------------------->
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeFacebook" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Facebook</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$facebook['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <label for="feature_text">Facebook</label>
                                            <textarea class="form-control" name="facebook" rows="3"><?=$facebook['meta_value']?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_facebook_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
           <div class="modal modal-center fade" id="changeTwitter" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Twitter</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$twitter['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <label for="feature_text">Twitter</label>
                                            <textarea class="form-control" name="twitter" rows="3"><?=$twitter['meta_value']?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_twitter_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

          <div class="modal modal-center fade" id="changeLinkedIn" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Linked In</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$linkedin['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <label for="feature_text">Linked In</label>
                                            <textarea class="form-control" name="linkedin" rows="3"><?=$linkedin['meta_value']?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_linkedin_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

         <div class="modal modal-center fade" id="changeInstragram" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Instragram</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$instagram['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <label for="feature_text">Instragram</label>
                                            <textarea class="form-control" name="instagram" rows="3"><?=$instagram['meta_value']?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_instragram_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------ end feature text change------------------------->

        <!------------------------modal feature content change------------------------->
        <?php
        foreach ($feature_items as $item){
            $fContent = json_decode($item['meta_value'], true);
            ?>
            <!-- Modal -->
            <div class="modal modal-center fade" id="changeFeatureContent<?=$item['id']?>" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Change Feature Content</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                                <input type="hidden" name="feature_item_id" value="<?=$item['id']?>">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <div class="card-body form-type-material">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="feature_item_icon" name="feature_item_icon" value="<?=$fContent['icon']?>">
                                                <label for="feature_item_icon">Font Awesome Icon</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="feature_item_title" name="feature_item_title" value="<?=$fContent['title']?>">
                                                <label for="feature_item_title">Feature Item Title</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="feature_item_text">Feature Item Text</label>
                                                <textarea class="form-control" id="feature_item_text" name="feature_item_text" rows="3"><?=$fContent['text']?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="change_feature_item_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        <!------------------------ end feature content change------------------------->

        <!------------------------modal testimonial text change------------------------->
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeTestimonialText" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Testimonial Text</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="testimonial_text_id" value="<?=$testimonial_text['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <label for="testimonial_text">Testimonial text</label>
                                            <textarea class="form-control" id="testimonial_text" name="testimonial_text" rows="3"><?=$testimonial_text['meta_value']?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_testimonial_text_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------ end testimonial text change------------------------->

        <!------------------------modal faq text change------------------------->
        <!-- Modal -->
        <div class="modal modal-center fade" id="changeFAQText" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change FAQ Text</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="actions.php" method="post" style="width: 100%;" enctype="multipart/form-data">
                            <input type="hidden" name="faq_text_id" value="<?=$faq_text['id']?>">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="card-body form-type-material">
                                        <div class="form-group">
                                            <label for="faq_text">FAQ text</label>
                                            <textarea class="form-control" id="faq_text" name="faq_text" rows="3"><?=$faq_text['meta_value']?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="change_faq_text_submit" class="btn btn-bold btn-pure btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------ end faq text change------------------------->
        <!--==============================================End Modal Items========================================-->
    </div>
    <?=mi_include('footer_extra.php');?>
</main>
<!-- END Main container -->


<?=mi_footer();?>
