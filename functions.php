<?php
/**
 * Author: Monirul Islam
 * Author Url: http://www.misujon.com/
 */

require_once dirname(__FILE__) . '/ins/env.php';
require_once dirname(__FILE__) . '/config/constants.php';
require_once dirname(__FILE__) . '/ins/credentials.php';
require_once dirname(__FILE__) . '/ins/mi_mailer.php';
require_once dirname(__FILE__) . '/ins/general.php';
require_once dirname(__FILE__) . '/ins/mi_session.php';
require_once dirname(__FILE__) . '/ins/template.php';
require_once dirname(__FILE__) . '/ins/db_crud.php';
require_once dirname(__FILE__) . '/ins/db_others.php';
require_once dirname(__FILE__) . '/ins/db_backup.php';
require_once dirname(__FILE__) . '/ins/http_req.php';
require_once dirname(__FILE__) . '/ins/mi_printer.php';
require_once dirname(__FILE__) . '/ins/mi_barcode.php';
require_once dirname(__FILE__) . '/ins/mi_image_merge.php';
require_once dirname(__FILE__) . '/ins/setup_action.php';

if (isset($_POST['delete_setup'])){
    mi_rmdir('setup');
    mi_permission_setup(dirname(__FILE__));
}