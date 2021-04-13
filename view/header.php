<?php 
if (file_exists('setup')){
    mi_redirect('setup');
}
$title = mi_db_read_by_id('settings', array('meta_name' => 'site_title_text'))[0];?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?=$title['meta_value']?></title>

    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Romanesco&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

    <!-- MDB icon -->
    <link rel="icon" href="<?=MI_BASE_URL;?>img/mdb-favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?=MI_BASE_URL;?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=MI_BASE_URL;?>plugins/toast/jquery.toast.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="<?=MI_BASE_URL;?>css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="<?=MI_BASE_URL;?>css/jquery-ui.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=MI_BASE_URL;?>css/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link rel="stylesheet" href="<?=MI_BASE_URL;?>plugins/paginator/css/jplist.core.min.css" type="text/css">
    <link rel="stylesheet" href="<?=MI_BASE_URL;?>plugins/paginator/css/jplist.history-bundle.min.css" type="text/css">
    <link rel="stylesheet" href="<?=MI_BASE_URL;?>plugins/paginator/css/jplist.pagination-bundle.min.css" type="text/css">
    <link rel="stylesheet" href="<?=MI_BASE_URL;?>plugins/paginator/css/jplist.textbox-filter.min.css" type="text/css">
    <link rel="stylesheet" href="<?=MI_BASE_URL;?>plugins/paginator/css/jplist.filter-toggle-bundle.min.css" type="text/css">

    <link rel="stylesheet" href="<?=MI_BASE_URL;?>css/style.css">
</head>
<body>
<input type="hidden" id="base_url" value="<?=MI_BASE_URL;?>">
<input type="hidden" id="cdn_url" value="<?=MI_CDN_URL;?>">