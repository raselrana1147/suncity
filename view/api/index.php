<?php
/**
 * Created by PhpStorm.
 * User: monir
 * Date: 4/6/2020
 * Time: 1:55 AM
 */

$msg;

if (isset($_GET['get_default_shirt_data']) && !empty($_GET['get_default_shirt_data']) && $_GET['get_default_shirt_data'] == 1){
    $id = mi_secure_input($_GET['id']);
    if (isset($id) && !empty($id)){
        $query = mi_db_read_by_id('fabrics', array('id'=>$id, 'status'=>1));
    }else{
        $query = mi_db_read_by_id('fabrics', array('is_default'=>1, 'status'=>1));
    }

    if (count($query)>0){
        $get_cat = mi_db_read_by_id('categories', array('id'=>$query[0]['category']));
        $msg = array('status'=>'success', 'msg'=>'Data retrieved', 'data'=>$query[0], 'category'=>$get_cat[0]);
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to retrieve data');
    }

    echo json_encode($msg);
}


if (isset($_POST['get_fabrics_data']) && !empty($_POST['get_fabrics_data']) && $_POST['get_fabrics_data'] == 1){
    $catid = mi_secure_input($_POST['category']);
    if (isset($catid) && !empty($catid)){
        $query = mi_db_read_by_id('fabrics', array('status'=>1, 'category'=>$catid));
    }else{
        $query = mi_db_read_by_id('fabrics', array('status'=>1));
    }

    if (count($query)>0){
        $htmls = '';
        foreach ($query as $d){
            $htmls .= '<li class="mi-shirt-choose-element" mi-id="'.$d['id'].'">';
            $htmls .= '<a class="element">';
            $htmls .= '<img src="'.MI_CDN_URL.$d['thumb'].'" class="img-fluid w-100 mr-2">';
            $htmls .= '<small>' . $d['title'] . '</small>';
            $htmls .= '</a>';
            $htmls .='</li>';
        }
        $msg = array('status'=>'success', 'msg'=>'Data retrieved', 'data'=>$htmls);
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to retrieve data');
    }

    echo json_encode($msg);
}




















