<?php
/**
 * Created by PhpStorm.
 * User: monir
 * Date: 6/3/2020
 * Time: 10:27 AM
 */
$message = [];

if (isset($_POST['save_fabrics'])){

    $name = mi_secure_input($_POST['fab_name']);
    $tagline = mi_secure_input($_POST['fab_tagline']);
    $price = mi_secure_input($_POST['fab_price']);
    $description = mi_secure_input($_POST['fab_description']);
    $category = mi_secure_input($_POST['fab_category']);
    $default = mi_secure_input($_POST['fab_default']);
    $status = mi_secure_input($_POST['fab_status']);
    $color = mi_secure_input($_POST['fab_color']);
    $type = mi_secure_input($_POST['fab_type']);
    $weight = mi_secure_input($_POST['fab_weight']);
    $pattern = mi_secure_input($_POST['fab_pattern']);
    $button = mi_secure_input($_POST['fab_button']);
    $thread = mi_secure_input($_POST['fab_button_thread']);
    $elements = array('weight'=>mi_secure_input($_POST['fab_weight_word']), 'yarn'=>mi_secure_input($_POST['fab_yarn']), 'weave'=>mi_secure_input($_POST['fab_weave']));

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Fabric name is required');
    }elseif (empty($price) && !is_numeric($price)){
        $msg = array('status'=>'error', 'msg'=>'Valid price is required');
    }else{
        $thumb = $_FILES['fab_thumb'];
        $shape = $_FILES['fab_shape'];
        $proimg = $_FILES['fab_proimg'];
        $gallary_img = $_FILES['fab_gallery_image'];

        $sbody = $_FILES['fab_shirt_body'];
        $sleeves = $_FILES['fab_sleeves'];
        $scollars = $_FILES['fab_collars'];
        $scuffs = $_FILES['fab_cuffs'];
        $splackets = $_FILES['fab_plackets'];
        $spocketplace = $_FILES['fab_pocket_placement'];
        $sbottom = $_FILES['fab_bottom'];
        $sbottomshort = $_FILES['fab_bottom_short'];
        $sback = $_FILES['fab_back'];
        $sbackyoke = $_FILES['fab_back_yoke'];

        if (!isset($thumb) || empty($thumb['name'])){
            $msg = array('status'=>'error', 'msg'=>'Fabric thumbnail is required');
        }elseif (!isset($shape) || empty($shape['name'])){
            $msg = array('status'=>'error', 'msg'=>'Shirt shape is required');
        }elseif (!isset($proimg) || empty($proimg['name'])){
            $msg = array('status'=>'error', 'msg'=>'Product image is required');
        }elseif (!isset($sbody) || empty($sbody['name'])){
            $msg = array('status'=>'error', 'msg'=>'Shirt body image is required');
        }elseif (count($sleeves)==0){
            $msg = array('status'=>'error', 'msg'=>'Collar images are required');
        }elseif (count($scollars)==0){
            $msg = array('status'=>'error', 'msg'=>'Collar images are required');
        }elseif (count($scuffs)==0){
            $msg = array('status'=>'error', 'msg'=>'Cuffs images are required');
        }elseif (count($splackets)==0){
            $msg = array('status'=>'error', 'msg'=>'Placket images are required');
        }elseif (count($spocketplace)==0){
            $msg = array('status'=>'error', 'msg'=>'Pocket places images are required');
        }elseif (count($sbottom)==0){
            $msg = array('status'=>'error', 'msg'=>'Shirt bottom long images are required');
        }elseif (count($sbottomshort)==0){
            $msg = array('status'=>'error', 'msg'=>'Shirt bottom short images are required');
        }elseif (count($sback)==0){
            $msg = array('status'=>'error', 'msg'=>'Shirt back details images are required');
        }elseif (count($sbackyoke)==0){
            $msg = array('status'=>'error', 'msg'=>'Shirt back yoke images are required');
        }else{

            $dir = mi_db_custom_query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_schema='".mi_env('DB_DATABASE')."' AND table_name='fabrics'");
            $folder_name = $dir[0]['AUTO_INCREMENT'];

            if (file_exists('../uploads/shirt/'.$folder_name)){
                $folder = $folder_name;
            }else{
                $folder = $folder_name;
                mkdir('../uploads/shirt/'.$folder_name);
            }

            $up_thumb = str_replace('../', '', mi_uploader($thumb['name'], $thumb['tmp_name'], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')));
            $up_shape = str_replace('../', '', mi_uploader($shape['name'], $shape['tmp_name'], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')));
            $up_proimg = str_replace('../', '', mi_uploader($proimg['name'], $proimg['tmp_name'], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')));
            $up_body = str_replace('../', '', mi_uploader($sbody['name'], $sbody['tmp_name'], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')));

            if (count($gallary_img)>0) {
                $galimg = [];
                if (is_array($gallary_img['name'])) {
                    foreach ($gallary_img['name'] as $key => $gimg) {
                        $galimg[] = str_replace('../', '', mi_uploader($gimg, $gallary_img['tmp_name'][$key], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')));
                    }
                }else{
                    $galimg[] = str_replace('../', '', mi_uploader($gallary_img['name'], $gallary_img['tmp_name'], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')));
                }
            }else{
                $galimg = '';
            }

            $up_sleeves = [];
            foreach ($sleeves['name'] as $key => $slvs){
                $up_sleeves[] = array(
                    'id' => $key,
                    'url'=> str_replace('../', '', mi_uploader($slvs[0], $sleeves['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                );
            }

            $up_collars = [];
            foreach ($scollars['name'] as $key => $cols){
                $up_collars[] = array(
                    'id' => $key,
                    'url'=> str_replace('../', '', mi_uploader($cols[0], $scollars['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                );
            }

            $up_cuffs = [];
            foreach ($scuffs['name'] as $key => $cufs){
                $up_cuffs[] = array(
                    'id' => $key,
                    'url'=> str_replace('../', '', mi_uploader($cufs[0], $scuffs['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                );
            }

            $up_placket = [];
            foreach ($splackets['name'] as $key => $plkt){
                $up_placket[] = array(
                    'id' => $key,
                    'url'=> str_replace('../', '', mi_uploader($plkt[0], $splackets['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                );
            }

            $up_pocket_place = [];
            foreach ($spocketplace['name'] as $key => $pokplc){
                if ($key > 1){
                    $up_pocket_place[] = array(
                        'id' => $key,
                        'url'=> str_replace('../', '', mi_uploader($pokplc[0], $spocketplace['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                    );
                }
            }

            $up_bottom_short = [];
            $up_bottom_long = [];
            foreach ($sbottomshort['name'] as $key => $sbtms){
                $up_bottom_short[] = array(
                    'id' => $key,
                    'url'=> str_replace('../', '', mi_uploader($sbtms[0], $sbottomshort['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                );
                $up_bottom_long[] = array(
                    'id' => $key,
                    'url'=> str_replace('../', '', mi_uploader($sbottom['name'][$key][0], $sbottom['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                );
            }
            $up_bottom = array('short'=>$up_bottom_short, 'long'=>$up_bottom_long);

            $up_back_details = [];
            foreach ($sback['name'] as $key => $sbk){
                $up_back_details[] = array(
                    'id' => $key,
                    'url'=> str_replace('../', '', mi_uploader($sbk[0], $sback['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                );
            }

            $up_back_yoke = [];
            foreach ($sbackyoke['name'] as $key => $sbky){
                $up_back_yoke[] = array(
                    'id' => $key,
                    'url'=> str_replace('../', '', mi_uploader($sbky[0], $sbackyoke['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                );
            }
            if ($default == 1){
                mi_db_update('fabrics', array('is_default'=> 2), array('is_default'=> 1));
            }

            $db_data = array(
                'title'             => $name,
                'tag_ling'          => $tagline,
                'price'             => $price,
                'description'       => $description,
                'type'              => $type,
                'weight'            => $weight,
                'pattern'           => $pattern,
                'color'             => $color,
                'thumb'             => $up_thumb,
                'shape'             => $up_shape,
                'pro_img'           => $up_proimg,
                'gallary_image'     => (($galimg != '')?json_encode($galimg):''),
                'elements'          => json_encode($elements),
                'main_body'         => $up_body,
                'collars'           => json_encode($up_collars),
                'cuffs'             => json_encode($up_cuffs),
                'sleeves'           => json_encode($up_sleeves),
                'plackets'          => json_encode($up_placket),
                'pockets'           => json_encode($up_pocket_place),
                'bottom_shapes'     => json_encode($up_bottom),
                'back_details'      => json_encode($up_back_details),
                'back_yokes'        => json_encode($up_back_yoke),
                'button'            => $button,
                'button_thread'     => $thread,
                'is_default'        => $default,
                'status'            => $status,
                'category'          => $category
            );

            $insert = mi_db_insert('fabrics', $db_data);
            if($insert == true){
                $msg = array('status'=>'success', 'msg'=>'Fabric Saved Successfully');
            }else{
                $msg = array('status'=>'error', 'msg'=>'Error to save fabric');
            }
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-fabric.php');
}

//===========================update fabrics==================================
if (isset($_POST['update_fabrics'])){
    $name = mi_secure_input($_POST['fab_name']);
    $tagline = mi_secure_input($_POST['fab_tagline']);
    $price = mi_secure_input($_POST['fab_price']);
    $description = mi_secure_input($_POST['fab_description']);
    $category = mi_secure_input($_POST['fab_category']);
    $default = mi_secure_input($_POST['fab_default']);
    $status = mi_secure_input($_POST['fab_status']);
    $color = mi_secure_input($_POST['fab_color']);
    $type = mi_secure_input($_POST['fab_type']);
    $weight = mi_secure_input($_POST['fab_weight']);
    $pattern = mi_secure_input($_POST['fab_pattern']);
    $button = mi_secure_input($_POST['fab_button']);
    $thread = mi_secure_input($_POST['fab_button_thread']);
    $elements = array('weight'=>mi_secure_input($_POST['fab_weight_word']), 'yarn'=>mi_secure_input($_POST['fab_yarn']), 'weave'=>mi_secure_input($_POST['fab_weave']));

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Fabric name is required');
    }elseif (empty($price) && !is_numeric($price)){
        $msg = array('status'=>'error', 'msg'=>'Valid price is required');
    }else{
        if ($default == 1){
            mi_db_update('fabrics', array('is_default'=> 2), array('is_default'=> 1));
        }
        $db_data = array(
            'title'             => $name,
            'tag_ling'          => $tagline,
            'price'             => $price,
            'description'       => $description,
            'type'              => $type,
            'weight'            => $weight,
            'pattern'           => $pattern,
            'color'             => $color,
            'elements'          => json_encode($elements),
            'button'            => $button,
            'button_thread'     => $thread,
            'is_default'        => $default,
            'status'            => $status,
            'category'          => $category
        );

        $insert = mi_db_update('fabrics', $db_data, array('id'=>mi_secure_input($_POST['update_fabrics'])));
        if($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Fabric Updated Successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update fabric');
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-fabric.php?f='.base64_encode($_POST['update_fabrics']));
}
//----------------------------edit fabric general image-----------------------
if (isset($_POST['change_general_img_submit']) && !empty($_POST['general_img_id'])){
    $fabId = mi_secure_input($_POST['general_img_id']);

    $thumb = $_FILES['e_fab_thumb'];
    $shape = $_FILES['e_fab_shape'];
    $proimg = $_FILES['e_fab_proimg'];
    $gallary_img = $_FILES['e_fab_gallery_image'];

    $folder = $fabId;
    $existing_fab = mi_db_read_by_id('fabrics', array('id'=> $fabId))[0];
    $e_galImgs = json_decode($existing_fab['gallary_image']);

    $e_thumb = '../'.$existing_fab['thumb'];
    $e_shape = '../'.$existing_fab['shape'];
    $e_proimg = '../'.$existing_fab['pro_img'];

    if (isset($thumb['name']) && !empty($thumb['name'])){
        $up_thumb = str_replace('../', '', mi_uploader($thumb['name'], $thumb['tmp_name'], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')));
        if ($up_thumb != false){
            unlink($e_thumb);
        }
        $th = array(
            'thumb' => $up_thumb
        );
        $update = mi_db_update('fabrics', $th, array('id'=> $fabId));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'General Image updated successfully');
        }else{
            $msg = array('status'=>'success', 'msg'=>'Error to update General Image');
        }
    }
    if (isset($shape) && !empty($shape['name'])){
        $up_shape = str_replace('../', '', mi_uploader($shape['name'], $shape['tmp_name'], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')));
        if ($up_shape != false){
            unlink($e_shape);
        }
        $sh = array(
            'shape' => $up_shape
        );
        $update = mi_db_update('fabrics', $sh, array('id'=> $fabId));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'General Image updated successfully');
        }else{
            $msg = array('status'=>'success', 'msg'=>'Error to update General Image');
        }
    }
    if (isset($proimg) && !empty($proimg['name'])){
        $up_proimg = str_replace('../', '', mi_uploader($proimg['name'], $proimg['tmp_name'], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')));
        if ($up_proimg != false){
            unlink($e_proimg);
        }
        $pi = array(
            'pro_img' => $up_proimg
        );
        $update = mi_db_update('fabrics', $pi, array('id'=> $fabId));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'General Image updated successfully');
        }else{
            $msg = array('status'=>'success', 'msg'=>'Error to update General Image');
        }
    }


    if (count(array_filter($gallary_img['name']))>0) {
        $galimg = [];
        if (is_array($gallary_img['name'])) {
            foreach ($gallary_img['name'] as $key => $gimg) {
                $galimg[] = str_replace('../', '', mi_uploader($gimg, $gallary_img['tmp_name'][$key], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')));
            }
        }
        if (count($galimg) > 0){
            foreach ($e_galImgs as $e_galImg){
                $unlink_img = '../'.$e_galImg;
                unlink($unlink_img);
            }
        }
        $gi = array(
            'gallary_image' => json_encode($galimg)
        );
        $update = mi_db_update('fabrics', $gi, array('id'=> $fabId));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'General Image updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update General Image');
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-fabric.php?f='.base64_encode($fabId));
}

//-----------------------edit fabric shirt body-----------------------
if (isset($_POST['change_fab_body_submit']) && !empty($_POST['fab_body_id'])){
    $fabId = mi_secure_input($_POST['fab_body_id']);
    $body = $_FILES['e_fab_shirt_body'];

    $folder = $fabId;
    if (isset($body['name']) && !empty($body['name'])){
        $existing_fab = mi_db_read_by_id('fabrics', array('id'=> $fabId))[0];
        $e_body = '../'.$existing_fab['main_body'];

        $up_body = mi_uploader($body['name'], $body['tmp_name'], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

        if ($up_body != false){
            unlink($e_body);
        }
        $body_data = array(
            'main_body' => str_replace('../', '', $up_body)
        );

        // print_r($up_body);return;

        $update = mi_db_update('fabrics', $body_data, array('id'=> $fabId));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Shirt body updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Shirt body');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-fabric.php?f='.base64_encode($fabId));
}
//-----------------------------edit fabric sleeves-----------------------------
if (isset($_POST['change_sleeve_submit']) && !empty($_POST['fab_sleeve_id'])){
    $fabId = mi_secure_input($_POST['fab_sleeve_id']);

    $input_sleeves = $_FILES['e_fab_sleeves'];
    $folder = $fabId;

    $fabric = mi_db_read_by_id('fabrics', array('id'=> $fabId))[0];
    $slvs = json_decode($fabric['sleeves'], true);

    foreach ($input_sleeves['name'] as $key => $i_slvs){
        if (count(array_filter($i_slvs)) > 0){
            $nm = array_search($key, array_column($slvs, 'id'));
            $upload_new = mi_uploader($i_slvs[0], $input_sleeves['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$slvs[$nm]['url']);

                $up_slv = str_replace('../', '', $upload_new);
                $slvs[$nm]['url'] = $up_slv;
            }
        }
    }
    $update = mi_db_update('fabrics', array('sleeves'=>json_encode($slvs)), array('id'=> $fabId));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Sleeves updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update sleeves');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-fabric.php?f='.base64_encode($fabId));

}

//-----------------------------edit fabric collars-------------------------
if (isset($_POST['change_collar_submit']) && !empty($_POST['fab_collar_id'])){
    $fabId = mi_secure_input($_POST['fab_collar_id']);

    $input_collars = $_FILES['e_fab_collars'];
    $folder = $fabId;

    $fabs = mi_db_read_by_id('fabrics', array('id'=> $fabId))[0];
    $cols = json_decode($fabs['collars'], true);
//    print_r($cols[0]);return;


    foreach ($input_collars['name'] as $key => $i_cols){
        if (count(array_filter($i_cols)) > 0){
            $nm = array_search($key, array_column($cols, 'id'));
            $upload_new = mi_uploader($i_cols[0], $input_collars['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$cols[$nm]['url']);

                $up_col = str_replace('../', '', $upload_new);
                $cols[$nm]['url'] = $up_col;
            }
        }
    }

    $update = mi_db_update('fabrics', array('collars'=>json_encode($cols)), array('id'=> $fabId));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Collars updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update collars');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-fabric.php?f='.base64_encode($fabId));
}

//-----------------------------edit fabric cuffs-------------------------
if (isset($_POST['change_cuff_submit']) && !empty($_POST['fab_cuff_id'])){
    $fabId = mi_secure_input($_POST['fab_cuff_id']);

    $input_cuffs = $_FILES['e_fab_cuffs'];
    $folder = $fabId;

    $fabs = mi_db_read_by_id('fabrics', array('id'=> $fabId))[0];
    $cuffs = json_decode($fabs['cuffs'], true);
//    print_r($cols[0]);return;


    foreach ($input_cuffs['name'] as $key => $i_cuffs){
        if (count(array_filter($i_cuffs)) > 0){
            $nm = array_search($key, array_column($cuffs, 'id'));
            $upload_new = mi_uploader($i_cuffs[0], $input_cuffs['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$cuffs[$nm]['url']);

                $up_cuff = str_replace('../', '', $upload_new);
                $cuffs[$nm]['url'] = $up_cuff;
            }
        }
    }

    $update = mi_db_update('fabrics', array('cuffs'=>json_encode($cuffs)), array('id'=> $fabId));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Cuffs updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update cuffs');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-fabric.php?f='.base64_encode($fabId));
}
//-----------------------------edit fabric plackets-------------------------
if (isset($_POST['change_placket_submit']) && !empty($_POST['fab_placket_id'])){
    $fabId = mi_secure_input($_POST['fab_placket_id']);

    $input_plackets = $_FILES['e_fab_plackets'];
    $folder = $fabId;

    $fabs = mi_db_read_by_id('fabrics', array('id'=> $fabId))[0];
    $plackets = json_decode($fabs['plackets'], true);
//    print_r($cols[0]);return;


    foreach ($input_plackets['name'] as $key => $i_plackets){
        if (count(array_filter($i_plackets)) > 0){
            $nm = array_search($key, array_column($plackets, 'id'));
//            print_r($plackets[$nm]['url']); return;
            $upload_new = mi_uploader($i_plackets[0], $input_plackets['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$plackets[$nm]['url']);

                $up_placket = str_replace('../', '', $upload_new);
                $plackets[$nm]['url'] = $up_placket;
            }
        }
    }

    $update = mi_db_update('fabrics', array('plackets'=>json_encode($plackets)), array('id'=> $fabId));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Plackets updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update plackets');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-fabric.php?f='.base64_encode($fabId));
}

//-----------------------------edit fabric pocket placement-------------------------
if (isset($_POST['change_pocket_placement_submit']) && !empty($_POST['fab_pocket_placement_id'])){
    $fabId = mi_secure_input($_POST['fab_pocket_placement_id']);

    $input_pocket_placements = $_FILES['e_fab_pocket_placement'];
    $folder = $fabId;

    $fabs = mi_db_read_by_id('fabrics', array('id'=> $fabId))[0];
    $pockets = json_decode($fabs['pockets'], true);
//    print_r($cols[0]);return;

//    ----------------------placement-------------------
    foreach ($input_pocket_placements['name'] as $key => $i_pocks){
        if (count(array_filter($i_pocks)) > 0){
            $nm = array_search($key, array_column($pockets, 'id'));
            $upload_new = mi_uploader($i_pocks[0], $input_pocket_placements['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$pockets[$nm]['url']);

                $up_pocket = str_replace('../', '', $upload_new);
                $pockets[$nm]['url'] = $up_pocket;
            }
        }
    }

    $update = mi_db_update('fabrics', array('pockets'=>json_encode($pockets)), array('id'=> $fabId));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Pocket placements updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update pocket placements');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-fabric.php?f='.base64_encode($fabId));
}
//-----------------------------edit fabric bottom shape-------------------------
if (isset($_POST['change_bottom_shape_submit']) && !empty($_POST['fab_bottom_shape_id'])){
    $fabId = mi_secure_input($_POST['fab_bottom_shape_id']);

    $input_bottom_shape_long = $_FILES['fab_bottom'];
    $input_bottom_shape_short = $_FILES['fab_bottom_short'];
    $folder = $fabId;

    $fabs = mi_db_read_by_id('fabrics', array('id'=> $fabId))[0];
    $shapes = json_decode($fabs['bottom_shapes'], true);

//    --------------long sleeve------------
    foreach ($input_bottom_shape_long['name'] as $key => $i_long_shp){
        if (count(array_filter($i_long_shp)) > 0){
            $nm = array_search($key, array_column($shapes['long'], 'id'));
            $upload_new = mi_uploader($i_long_shp[0], $input_bottom_shape_long['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$shapes['long'][$nm]['url']);

                $up_long_shape = str_replace('../', '', $upload_new);
                $shapes['long'][$nm]['url'] = $up_long_shape;
            }
        }
    }
//    ----------------short sleeve-----------
    foreach ($input_bottom_shape_short['name'] as $key => $i_short_shp){
        if (count(array_filter($i_short_shp)) > 0){
            $nm = array_search($key, array_column($shapes['short'], 'id'));
            $upload_new = mi_uploader($i_short_shp[0], $input_bottom_shape_short['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$shapes['short'][$nm]['url']);

                $up_short_shape = str_replace('../', '', $upload_new);
                $shapes['short'][$nm]['url'] = $up_short_shape;
            }
        }
    }

    $update = mi_db_update('fabrics', array('bottom_shapes'=>json_encode($shapes)), array('id'=> $fabId));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Bottom shapes updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update bottom shapes');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-fabric.php?f='.base64_encode($fabId));
}

//-----------------------------edit fabric back details-------------------------
if (isset($_POST['change_back_details_submit']) && !empty($_POST['fab_back_details_id'])){
    $fabId = mi_secure_input($_POST['fab_back_details_id']);

    $input_back_details = $_FILES['fab_back'];
    $folder = $fabId;

    $fabs = mi_db_read_by_id('fabrics', array('id'=> $fabId))[0];
    $backDetails = json_decode($fabs['back_details'], true);

    foreach ($input_back_details['name'] as $key => $i_details){
        if (count(array_filter($i_details)) > 0){
            $nm = array_search($key, array_column($backDetails, 'id'));
//            print_r($plackets[$nm]['url']); return;
            $upload_new = mi_uploader($i_details[0], $input_back_details['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$backDetails[$nm]['url']);

                $up_details = str_replace('../', '', $upload_new);
                $backDetails[$nm]['url'] = $up_details;
            }
        }
    }

    $update = mi_db_update('fabrics', array('back_details'=>json_encode($backDetails)), array('id'=> $fabId));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Back details updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update back details');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-fabric.php?f='.base64_encode($fabId));
}
//-----------------------------edit fabric back yoke-------------------------
if (isset($_POST['change_back_yoke_submit']) && !empty($_POST['fab_back_yoke_id'])){
    $fabId = mi_secure_input($_POST['fab_back_yoke_id']);

    $input_back_yokes = $_FILES['fab_back_yoke'];
    $folder = $fabId;

    $fabs = mi_db_read_by_id('fabrics', array('id'=> $fabId))[0];
    $backYokes = json_decode($fabs['back_yokes'], true);

    foreach ($input_back_yokes['name'] as $key => $i_yokes){
        if (count(array_filter($i_yokes)) > 0){
            $nm = array_search($key, array_column($backYokes, 'id'));
//            print_r($plackets[$nm]['url']); return;
            $upload_new = mi_uploader($i_yokes[0], $input_back_yokes['tmp_name'][$key][0], '../uploads/shirt/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$backYokes[$nm]['url']);

                $up_yokes = str_replace('../', '', $upload_new);
                $backYokes[$nm]['url'] = $up_yokes;
            }
        }
    }

    $update = mi_db_update('fabrics', array('back_yokes'=>json_encode($backYokes)), array('id'=> $fabId));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Back yokes updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update back yokes');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-fabric.php?f='.base64_encode($fabId));
}

//=====================================update button=================================
if (isset($_POST['update_button'])){
    $buttonId = mi_secure_input($_POST['update_button']);

    $name = mi_secure_input($_POST['button_name']);
    $color = mi_secure_input($_POST['button_color']);
    $price = mi_secure_input($_POST['button_price']);
    $status = mi_secure_input($_POST['button_status']);
    $type = mi_secure_input($_POST['button_type']);

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Button name is required');
    }elseif (empty($color)){
        $msg = array('status'=>'error', 'msg'=>'Button color is required');
    }elseif (empty($price) && !is_numeric($price)){
        $msg = array('status'=>'error', 'msg'=>'Valid price is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Button status is required');
    }elseif (empty($type)){
        $msg = array('status'=>'error', 'msg'=>'Button type is required');
    }else{
        $db_data = array(
            'title'             => $name,
            'color'             => $color,
            'price'             => $price,
            'type'              => $type,
            'status'            => $status
        );

        $update = mi_db_update('buttons', $db_data, array('id'=> $buttonId));
        if($update == true){
            $msg = array('status'=>'success', 'msg'=>'Button Updated Successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update button');
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-button.php?b='.base64_encode($buttonId));
}

//----------------------------edit button general image-----------------------
if (isset($_POST['change_btn_general_img_submit']) && !empty($_POST['general_img_id'])){
    $btnId = mi_secure_input($_POST['general_img_id']);

    $thumb = $_FILES['button_thumb'];
    $placket = $_FILES['button_placket'];

    $folder = $btnId;
    $existing_btn = mi_db_read_by_id('buttons', array('id'=> $btnId))[0];
    $e_thumb = '../'.$existing_btn['thumb'];
    $e_placket = '../'.$existing_btn['placket'];

    if (isset($thumb['name']) && !empty($thumb['name'])){
        $upload_new = mi_uploader($thumb['name'], $thumb['tmp_name'], '../uploads/buttons/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));
        if ($upload_new != false){
            unlink($e_thumb);
            $up_thumb = str_replace('../', '', $upload_new);

            $th = array(
                'thumb' => $up_thumb
            );
            $update = mi_db_update('buttons', $th, array('id'=> $btnId));
            if ($update == true){
                $msg = array('status'=>'success', 'msg'=>'General Image updated successfully');
            }else{
                $msg = array('status'=>'success', 'msg'=>'Error to update General Image');
            }
        }
    }

    if (isset($placket['name']) && !empty($placket['name'])){
        $upload_new = mi_uploader($placket['name'], $placket['tmp_name'], '../uploads/buttons/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));
        if ($upload_new != false){
            unlink($e_placket);
            $up_placket = str_replace('../', '', $upload_new);

            $plk = array(
                'placket' => $up_placket
            );
            $update = mi_db_update('buttons', $plk, array('id'=> $btnId));
            if ($update == true){
                $msg = array('status'=>'success', 'msg'=>'General Image updated successfully');
            }else{
                $msg = array('status'=>'success', 'msg'=>'Error to update General Image');
            }
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-button.php?b='.base64_encode($btnId));
}
//-----------------------------edit button collars-------------------------
if (isset($_POST['change_btn_collar_img_submit']) && !empty($_POST['btn_collar_img_id'])){
    $btnId = mi_secure_input($_POST['btn_collar_img_id']);

    $input_collars = $_FILES['button_collars'];
    $folder = $btnId;

    $buttons = mi_db_read_by_id('buttons', array('id'=> $btnId))[0];
    $cols = json_decode($buttons['collar'], true);
//    print_r($cols[0]);return;


    foreach ($input_collars['name'] as $key => $i_cols){
        if (count(array_filter($i_cols)) > 0){
            $nm = array_search($key, array_column($cols, 'id'));
            $upload_new = mi_uploader($i_cols[0], $input_collars['tmp_name'][$key][0], '../uploads/buttons/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$cols[$nm]['url']);

                $up_col = str_replace('../', '', $upload_new);
                $cols[$nm]['url'] = $up_col;
            }
        }
    }

    $update = mi_db_update('buttons', array('collar'=>json_encode($cols)), array('id'=> $btnId));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Collar buttons updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update collar buttons');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-button.php?b='.base64_encode($btnId));
}
//-----------------------------edit pocket button-------------------------
if (isset($_POST['change_pocket_button_submit']) && !empty($_POST['btn_pocket_id'])){
    $btnId = mi_secure_input($_POST['btn_pocket_id']);

    $input_pocket_btns = $_FILES['pocket_button'];
    $folder = $btnId;

    $btns = mi_db_read_by_id('buttons', array('id'=> $btnId))[0];
    $pockets = json_decode($btns['pocket'], true);
//    print_r($pockets);return;

    foreach ($input_pocket_btns['name'] as $key => $i_btns){
        if (count(array_filter($i_btns)) > 0){
            $nm = array_search($key, array_column($pockets, 'id'));
            $upload_new = mi_uploader($i_btns[0], $input_pocket_btns['tmp_name'][$key][0], '../uploads/buttons/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$pockets[$nm]['url']);

                $up_pocket = str_replace('../', '', $upload_new);
                $pockets[$nm]['url'] = $up_pocket;
            }
        }
    }

    $update = mi_db_update('buttons', array('pocket'=>json_encode($pockets)), array('id'=> $btnId));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Pocket buttons updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update pocket buttons');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-button.php?b='.base64_encode($btnId));
}

//===============================update button thread===============================
if (isset($_POST['update_thread'])){
    $threadId = mi_secure_input($_POST['update_thread']);

    $name = mi_secure_input($_POST['thread_name']);
    $color = mi_secure_input($_POST['thread_color']);
    $status = mi_secure_input($_POST['thread_status']);

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Thread name is required');
    }elseif (empty($color)){
        $msg = array('status'=>'error', 'msg'=>'Thread color is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Thread status is required');
    }else{
        $db_data = array(
            'title'             => $name,
            'color_code'        => $color,
            'status'            => $status
        );

        $update = mi_db_update('button_threads', $db_data, array('id'=> $threadId));
        if($update == true){
            $msg = array('status'=>'success', 'msg'=>'Button Thread Updated Successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update button thread');
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-thread.php?t='.base64_encode($threadId));
}
//-------------------------edit button thread thumbnail------------------------
if (isset($_POST['change_thread_thumb_submit']) && !empty($_POST['thread_thumb_id'])){
    $threadId = mi_secure_input($_POST['thread_thumb_id']);

    $thumb = $_FILES['thread_thumb'];

    $folder = $threadId;
    $existing_thrd = mi_db_read_by_id('button_threads', array('id'=> $threadId))[0];
    $e_thumb = '../'.$existing_thrd['thumb'];

    if (isset($thumb['name']) && !empty($thumb['name'])){
        $upload_new = mi_uploader($thumb['name'], $thumb['tmp_name'], '../uploads/threads/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));
        if ($upload_new != false){
            unlink($e_thumb);
            $up_thumb = str_replace('../', '', $upload_new);

            $th = array(
                'thumb' => $up_thumb
            );
            $update = mi_db_update('button_threads', $th, array('id'=> $threadId));
            if ($update == true){
                $msg = array('status'=>'success', 'msg'=>'Thread thumb updated successfully');
            }else{
                $msg = array('status'=>'success', 'msg'=>'Error to update thread thumb');
            }
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-thread.php?t='.base64_encode($threadId));

}
//-----------------------------edit collars thread-------------------------
if (isset($_POST['change_collar_thread_submit']) && !empty($_POST['collar_thread_id'])){
    $threadId = mi_secure_input($_POST['collar_thread_id']);

    $input_collar_thread = $_FILES['thread_collars'];
    $folder = $threadId;

    $threads = mi_db_read_by_id('button_threads', array('id'=> $threadId))[0];
    $cols = json_decode($threads['button_thread'], true);
//    $col_threads = $cols[0];
//    print_r($col_threads);return;


    foreach ($input_collar_thread['name'] as $key => $i_col_thrd){
        if (count(array_filter($i_col_thrd)) > 0){
            $nm = array_search($key, array_column($cols[0]['collar'], 'id'));
            $upload_new = mi_uploader($i_col_thrd[0], $input_collar_thread['tmp_name'][$key][0], '../uploads/threads/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$cols[0]['collar'][$nm]['url']);

                $up_collar_thrd = str_replace('../', '', $upload_new);
                $cols[0]['collar'][$nm]['url'] = $up_collar_thrd;
            }
        }
    }

    $update = mi_db_update('button_threads', array('button_thread'=>json_encode($cols)), array('id'=> $threadId));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Collar threads updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update collar threads');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-thread.php?t='.base64_encode($threadId));
}

//-----------------------------edit placket thread-------------------------
if (isset($_POST['change_placket_thread_submit']) && !empty($_POST['placket_thread_id'])){
    $threadId = mi_secure_input($_POST['placket_thread_id']);

    $input_placket_thread = $_FILES['thread_plackets'];
    $folder = $threadId;

    $threads = mi_db_read_by_id('button_threads', array('id'=> $threadId))[0];
    $plks = json_decode($threads['button_thread'], true);
//    $col_threads = $cols[0];
//    print_r($col_threads);return;


    foreach ($input_placket_thread['name'] as $key => $i_plk_thrd){
        if (count(array_filter($i_plk_thrd)) > 0){
            $nm = array_search($key, array_column($plks[0]['placket'], 'id'));
            $upload_new = mi_uploader($i_plk_thrd[0], $input_placket_thread['tmp_name'][$key][0], '../uploads/threads/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));

            if ($upload_new != false){
                unlink('../'.$plks[0]['placket'][$nm]['url']);

                $up_placket_thrd = str_replace('../', '', $upload_new);
                $plks[0]['placket'][$nm]['url'] = $up_placket_thrd;
            }
        }
    }

    $update = mi_db_update('button_threads', array('button_thread'=>json_encode($plks)), array('id'=> $threadId));
    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Placket threads updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update placket threads');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-thread.php?t='.base64_encode($threadId));
}

if (isset($_POST['admin_login'])){
    $uphn = mi_secure_input($_POST['username']);
    $upass = mi_secure_input($_POST['password']);

    if (empty($uphn) || empty($upass)){
        $msg = array('status'=>'error', 'msg'=>'All the fields are required');
    }elseif (!filter_var($uphn, FILTER_VALIDATE_EMAIL)){
        $msg = array('status'=>'error', 'msg'=>'Invalid email address');
    }else{

        $getdata = mi_db_read_by_id('mi_admin', array('user_email'=>$uphn));

        if (count($getdata) > 0){

            if ($getdata[0]['user_status'] == 2){

                $attempt_time = strtotime(date('Y-m-d H:i:s'));
                $remove_time = strtotime($getdata[0]['user_authen_time']);
                if ($getdata[0]['user_attepts'] >= 5 && $attempt_time < $remove_time){
                    $minutes = round(abs(strtotime($getdata[0]['user_authen_time']) - time()) / 60);
                    $msg = array('status'=>'error', 'msg'=>'Sorry you have failed to login 5 times. Please try again after '.$minutes.' minute!');
                }else{
                    if ($getdata[0]['user_password'] != md5($upass)){
                        $attept_data = array(
                            'user_attepts' => $getdata[0]['user_attepts'] + 1,
                            'user_authen_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'))+strtotime("+10 minutes", strtotime('Y-m-d H:i:s')))
                        );
                        $attept_update = mi_db_update('mi_admin', $attept_data, array('id'=>$getdata[0]['id']));
                        $msg = array('status'=>'error', 'msg'=>'Password not matching.');
                    }else{
                        $logger = array(
                            'user_attepts' => '',
                            'user_authen_time' => '',
                            'user_last_login' => date('Y-m-d H:i:s')
                        );
                        mi_db_update('mi_admin', $logger, array('id'=>$getdata[0]['id']));
                        mi_set_session('admin', base64_encode($getdata[0]['id']));
                        $role = mi_db_read_by_id('user_roles', array('id'=> $getdata[0]['role_id'], 'status' == 1))[0];
                        mi_set_session('role', $role);
                        $msg = array('status'=>'success', 'msg'=>'Login Successfully');
                    }
                }
            }else{
                $msg = array('status'=>'error', 'msg'=>'Sorry, Your account account is not activated');
            }

        }else{
            $msg = array('status'=>'error', 'msg'=>'User not exists.');
        }

    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/login.php');
}


if (isset($_POST['update_profile']) && !empty($_POST['update_profile'])){
    $user    = mi_secure_input($_POST['user_id']);
    $name    = mi_secure_input($_POST['user_name']);
    $phone   = mi_secure_input($_POST['user_phone']);
    $address = mi_secure_input($_POST['user_address']);

    $image = $_FILES['image'];

    if (empty($name) || empty($phone) || empty($address)){
        $msg = array('status'=>'error', 'msg'=>'All fields are required');
    }else{
        $cut = mi_db_read_by_id('mi_admin', array('id' => $user))[0];
        $cut_img = $cut['user_photo'];
//        ----------------------
        if (!empty($image['name'])){
            $up_img = mi_uploader(
                $image['name'],
                $image['tmp_name'],
                'staff-uploads/staff-profile/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            );
            if ($up_img != false){
                unlink($cut_img);
            }

            $data = array(
                'user_name' => $name,
                'user_phone' => $phone,
                'user_address' => $address,
                'user_photo' => $up_img,
            );
        }else{
            $data = array(
                'user_name' => $name,
                'user_phone' => $phone,
                'user_address' => $address
            );
        }
//        ----------------------
        $update = mi_db_update('mi_admin', $data, array('id'=>$user));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Profile updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update profile.');
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/profile.php');
}


if (isset($_POST['update_password']) && !empty($_POST['update_password'])){
    $user = mi_secure_input($_POST['update_password']);
    $current = mi_secure_input($_POST['current']);
    $new = mi_secure_input($_POST['new']);
    $confirm = mi_secure_input($_POST['confirm']);

    if (empty($current) || empty($new) || empty($confirm)){
        $msg = array('status'=>'error', 'msg'=>'All fields are required');
    }elseif ($new != $confirm){
        $msg = array('status'=>'error', 'msg'=>'New passwords are not matching');
    }else{
        $check = mi_db_read_by_id('mi_admin', array('id'=>$user));
        if (count($check)>0){
            if ($check[0]['user_password'] == md5($current)){
                $data = array(
                    'user_password' => md5($confirm),
                    'user_salt' => $new
                );
                $update = mi_db_update('mi_admin', $data, array('id'=>$user));
                if ($update == true){
                    $msg = array('status'=>'success', 'msg'=>'Password updated successfully');
                }else{
                    $msg = array('status'=>'error', 'msg'=>'Error to update password.');
                }
            }else{
                $msg = array('status'=>'error', 'msg'=>'Current password not matching');
            }

        }else{
            $msg = array('status'=>'error', 'msg'=>'Undefined user');
        }

    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/profile.php');
}


if (isset($_POST['category_save'])){

    $name      = mi_secure_input($_POST['name']);
    $parent_id = mi_secure_input($_POST['parent_id']);
    $status    = mi_secure_input($_POST['status']);
    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Category name is required');
    }else{
        $check = mi_db_read_by_id('categories', array('name'=>$name));
        if (count($check) > 0){
            $msg = array('status'=>'error', 'msg'=>'Category exists');
        }else{
            $data = array(
                'name'     => $name,
                'parent_id'=> $parent_id,
                'status'   => $status
            );
            $insert = mi_db_insert('categories', $data);
            if ($insert){
                $msg = array('status'=>'success', 'msg'=>'Category Saved Successfully!');
            }else{
                $msg = array('status'=>'error', 'msg'=>'Error to save category');
            }
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/categories.php');
}


if (isset($_POST['category_update'])){
    $id = mi_secure_input($_POST['cat_id']);
    $name = mi_secure_input($_POST['name']);
    $parent_id = mi_secure_input($_POST['parent_id']);
    $status = mi_secure_input($_POST['status']);
    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Category name is required');
    }else{
        $check = mi_db_read_by_id('categories', array('name'=>$name),true);
        if (count($check) > 0){
            $data = array(
                'name' => $name,
                'parent_id' =>$parent_id,
                'status' => $status
            );
            $insert = mi_db_update('categories', $data, array('id'=>$id));
            if ($insert){
                $msg = array('status'=>'success', 'msg'=>'Category Updated Successfully!');
            }else{
                $msg = array('status'=>'error', 'msg'=>'Error to update category');
            }
        }else{
            $msg = array('status'=>'error', 'msg'=>'Category not exists');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/categories.php');
}

//----------------------delete category-----------------------
if (isset($_POST['category_delete_request']) && !empty($_POST['category_delete_request']) && $_POST['category_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $delete = mi_db_delete('categories', 'id', array($id));

    if ($delete == true){
        $message['status'] = 'success';
        $message['msg'] = 'Category deleted successfully';
    }else{
        $message['status'] = 'error';
        $message['msg'] = 'Error to delete Category';
    }
    echo json_encode($message);
}


//----------------------delete collars-----------------------
if (isset($_POST['collar_delete_request']) && !empty($_POST['collar_delete_request']) && $_POST['collar_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $collar=mi_db_read_by_id('collars',array('id'=>$id))[0];
    $exit_thumb=$collar['thumb'];

    if ($exit_thumb !=false) {
        unlink('../'.$exit_thumb);
    }

    $delete = mi_db_delete('collars', 'id', array($id));

    if ($delete == true){
        $message['status'] = 'success';
        $message['msg'] = 'Collar deleted successfully';
    }else{
        $message['status'] = 'error';
        $message['msg'] = 'Error to delete Collar';
    }
    echo json_encode($message);
}



function delete_dir($src) {
    $dir = opendir($src);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                delete_dir($src . '/' . $file);
            }
            else {
                unlink($src . '/' . $file);
            }
        }
    }
    closedir($dir);
    rmdir($src);

}
if (isset($_GET['dbtn']) && !empty($_GET['dbtn'])){
    $id = base64_decode(mi_secure_input($_GET['dbtn']));

    if (file_exists('../uploads/buttons/'.$id) && is_dir('../uploads/buttons/'.$id)){
        $delete = mi_db_delete('buttons', 'id', array($id));
        if ($delete){
            delete_dir('../uploads/buttons/'.$id);
            $msg = array('status'=>'success', 'msg'=>'Button deleted successfully!');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Button not deleted');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Directory does not exists');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/buttons.php');
}

if (isset($_GET['dthrd']) && !empty($_GET['dthrd'])){
    $id = base64_decode(mi_secure_input($_GET['dthrd']));

    if (file_exists('../uploads/threads/'.$id) && is_dir('../uploads/threads/'.$id)){
        $delete = mi_db_delete('button_threads', 'id', array($id));
        if ($delete){
            delete_dir('../uploads/threads/'.$id);
            $msg = array('status'=>'success', 'msg'=>'Thread deleted successfully!');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Thread not deleted');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Directory does not exists');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/threads.php');
}

if (isset($_GET['dbtnfab']) && !empty($_GET['dbtnfab'])){
    $id = base64_decode(mi_secure_input($_GET['dbtnfab']));

    if (file_exists('../uploads/shirt/'.$id) && is_dir('../uploads/shirt/'.$id)){
        $delete = mi_db_delete('fabrics', 'id', array($id));
        if ($delete){
            delete_dir('../uploads/shirt/'.$id);
            $msg = array('status'=>'success', 'msg'=>'Fabric deleted successfully!');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Fabric not deleted');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Directory does not exists');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/fabrics.php');
}


if(isset($_POST['save_button'])){
    $name = mi_secure_input($_POST['button_name']);
    $color = mi_secure_input($_POST['button_color']);
    $price = mi_secure_input($_POST['button_price']);
    $status = mi_secure_input($_POST['button_status']);
    $type = mi_secure_input($_POST['button_type']);

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Name is required');
    }elseif (empty($color)){
        $msg = array('status'=>'error', 'msg'=>'Color is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }elseif (empty($type)){
        $msg = array('status'=>'error', 'msg'=>'Type is required');
    }else{

        $thumb = $_FILES['button_thumb'];
        $plack = $_FILES['button_placket'];
        $collars = $_FILES['button_collars'];
        $pocketbuttons = $_FILES['button_pocket'];

        if (empty($thumb['name'])){
            $msg = array('status'=>'error', 'msg'=>'Button thumbnail is required');
        }elseif (empty($plack['name'])){
            $msg = array('status'=>'error', 'msg'=>'Placket button is required');
        }elseif (count($collars)==0){
            $msg = array('status'=>'error', 'msg'=>'Collar buttons are required');
        }elseif (count($pocketbuttons)==0){
            $msg = array('status'=>'error', 'msg'=>'Pocket buttons are required');
        }else{

            $dir = mi_db_custom_query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_schema='custom_shirt_Design' AND table_name='buttons'");
            $folder_name = $dir[0]['AUTO_INCREMENT'];
            if (file_exists('../uploads/buttons/'.$folder_name)){
                $folder = $folder_name;
            }else{
                $folder = $folder_name;
                mkdir('../uploads/buttons/'.$folder_name);
            }
            $up_thumb = str_replace('../', '', mi_uploader($thumb['name'], $thumb['tmp_name'], '../uploads/buttons/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')));
            $up_plack = str_replace('../', '', mi_uploader($plack['name'], $plack['tmp_name'], '../uploads/buttons/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')));

            $up_collars = [];
            foreach ($collars['name'] as $key => $cols){
                $up_collars[] = array(
                    'id' => $key,
                    'url'=> str_replace('../', '', mi_uploader($cols[0], $collars['tmp_name'][$key][0], '../uploads/buttons/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                );
            }

            $up_pocks = [];
            foreach ($pocketbuttons['name'] as $key => $poks){
                $up_pocks[] = array(
                    'id' => $key,
                    'url'=> str_replace('../', '', mi_uploader($poks[0], $pocketbuttons['tmp_name'][$key][0], '../uploads/buttons/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'))),
                );
            }


            $db_data = array(
                'title'   => $name,
                'thumb'   => $up_thumb,
                'color'   => $color,
                'placket' => $up_plack,
                'pocket'  => json_encode($up_pocks),
                'collar'  => json_encode($up_collars),
                'type'    => $type,
                'price'   => $price,
                'status'  => $status,
            );

            $insert = mi_db_insert('buttons', $db_data);
            if($insert == true){
                $msg = array('status'=>'success', 'msg'=>'Button Saved Successfully');
            }else{
                $msg = array('status'=>'error', 'msg'=>'Error to save button');
            }

        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/buttons.php');
}



if(isset($_POST['save_thread'])){
    $name = mi_secure_input($_POST['thread_name']);
    $color = mi_secure_input($_POST['thread_color']);
    $status = mi_secure_input($_POST['thread_status']);

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Name is required');
    }elseif (empty($color)){
        $msg = array('status'=>'error', 'msg'=>'Color is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{

        $thumb = $_FILES['thread_thumb'];
        $plack = $_FILES['thread_plackets'];
        $collars = $_FILES['thread_collars'];


        if (empty($thumb['name'])){
            $msg = array('status'=>'error', 'msg'=>'Thread thumbnail is required');
        }elseif (count($plack) == 0){
            $msg = array('status'=>'error', 'msg'=>'Thread plackets are required');
        }elseif (count($collars)==0){
            $msg = array('status'=>'error', 'msg'=>'Collar threads are required');
        }else{

            $dir = mi_db_custom_query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_schema='custom_shirt_Design' AND table_name='button_threads'");
            $folder_name = $dir[0]['AUTO_INCREMENT'];
            if (file_exists('../uploads/threads/'.$folder_name)){
                $folder = $folder_name;
            }else{
                $folder = $folder_name;
                mkdir('../uploads/threads/'.$folder_name);
            }
            $up_thumb = str_replace(
                '../',
                '',
                mi_uploader(
                    $thumb['name'],
                    $thumb['tmp_name'],
                    '../uploads/threads/'.$folder.'/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                )
            );

            $up_collars = [];
            foreach ($collars['name'] as $key => $cols){
                $up_collars[] = array(
                    'id' => $key,
                    'url'=> str_replace('../', '', mi_uploader($cols[0], $collars['tmp_name'][$key][0], '../uploads/threads/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                );
            }


            $up_pocks = [];
            foreach ($plack['name'] as $key => $poks){
                $up_pocks[] = array(
                    'id' => $key,
                    'url'=> str_replace('../', '', mi_uploader($poks[0], $plack['tmp_name'][$key][0], '../uploads/threads/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'))),
                );
            }

            $button_threads = array(
                'id' => $folder,
                'collar' => $up_collars,
                'placket' => $up_pocks
            );


            $db_data = array(
                'title'   => $name,
                'thumb'   => $up_thumb,
                'color_code'=> $color,
                'status'  => $status,
                'button_thread' => json_encode(array($button_threads))
            );

            $insert = mi_db_insert('button_threads', $db_data);

            if($insert == true){
                $msg = array('status'=>'success', 'msg'=>'Thread Saved Successfully');
            }else{
                $msg = array('status'=>'error', 'msg'=>'Error to save thread');
            }

        }
    }

//    print_r($db_data);
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/threads.php');
}



if (isset($_POST['mi_update_status_request']) && !empty($_POST['mi_update_status_request']) && $_POST['mi_update_status_request'] == 1){

    $type = mi_secure_input($_POST['type']);
    $id = mi_secure_input($_POST['id']);
    $status = mi_secure_input($_POST['status']);

    if (empty($type)){
        echo 'Type is required';
    }elseif (empty($id) || !is_numeric($id)){
        echo 'Invalid id';
    }elseif (empty($status) || !is_numeric($status)){
        echo 'Invalid status';
    }else{
        $db = '';
        if ($type == 'fabric'){
            $db = 'fabrics';
        }elseif ($type == 'button'){
            $db = 'buttons';
        }elseif ($type == 'thread'){
            $db = 'button_threads';
        }elseif ($type == 'fabric-contrast'){
            $db = 'contrast_data';
        }
        $update = mi_db_update($db, array('status'=>$status), array('id'=>$id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Status changed successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to change status');
        }
    }
    echo json_encode($msg);
}


//---------------------------collar style add------------------------
if (isset($_POST['add_collar_style'])){


    $title    = mi_secure_input($_POST['title']);
    $subtitle = mi_secure_input($_POST['subtitle']);
    $status   = mi_secure_input($_POST['status']);
    $price    = mi_secure_input($_POST['price']);

    $thumb = $_FILES['collar_style_thumb'];

        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/collar/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

      
        $data = array(
            'title'    => $title,
            'subtitle' => $subtitle,
            'thumb'    => $up_thumb,
            'status'   => $status,
            'price'    => $price
        );
    

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($subtitle)) {
        $msg = array('status'=>'error', 'msg'=>'Subtitle is required');
    }elseif (empty($thumb)) {
       $msg = array('status'=>'error', 'msg'=>'Image is required');
    }elseif (empty($price)) {
       $msg = array('status'=>'error', 'msg'=>'Price is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $insert = mi_db_insert('collars', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Collar style added');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to added');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/collar_styles.php');

}
//---------------------------collar style edit------------------------
if (isset($_POST['edit_collar_style'])){

    $id       = mi_secure_input($_POST['collar_style_id']);
    $title    = mi_secure_input($_POST['title']);
    $subtitle = mi_secure_input($_POST['subtitle']);
    $status   = mi_secure_input($_POST['status']);
    $price    = mi_secure_input($_POST['price']);

    $thumb = $_FILES['collar_style_thumb'];

    $collars = mi_db_read_by_id('collars', array('id' => $id))[0];
    $u_thumb = '../'.$collars['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/collar/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'subtitle' => $subtitle,
            'thumb' => $up_thumb,
            'status' => $status,
            'price' => $price
        );
    }else{
        $dta = array(
            'title' => $title,
            'subtitle' => $subtitle,
            'status' => $status,
            'price' => $price
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('collars', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('status'=>'success', 'msg'=>'Collar style updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/collar_styles.php');

}
//------------------------collar stays edit-------------------------
if (isset($_POST['edit_collar_stay'])){
    $id = mi_secure_input($_POST['collar_stay_id']);
    $title = mi_secure_input($_POST['title']);
    $subtitle = mi_secure_input(((isset($_POST['subtitle']) && !empty($_POST['subtitle']))?$_POST['subtitle']:''));
    $status = mi_secure_input($_POST['status']);
    $price = mi_secure_input(((isset($_POST['price']) && !empty($_POST['price']))?$_POST['price']:''));

    $thumb = $_FILES['collar_stay_thumb'];

    $collar_stay = mi_db_read_by_id('collar_stays', array('id' => $id))[0];
    $u_thumb = '../'.$collar_stay['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/collar-stays/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'subtitle' => $subtitle,
            'thumb' => $up_thumb,
            'status' => $status,
            'price' => $price
        );
    }else{
        $dta = array(
            'title' => $title,
            'subtitle' => $subtitle,
            'status' => $status,
            'price' => $price
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('collar_stays', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('status'=>'success', 'msg'=>'Collar Stays updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/collar_stays.php');
}
//------------------------collar stiffness edit-----------------------------
if (isset($_POST['edit_collar_stiffness'])){
    $id = mi_secure_input($_POST['collar_stiffness_id']);
    $title = mi_secure_input($_POST['title']);
    $status = mi_secure_input($_POST['status']);

    $thumb = $_FILES['collar_stiffness_thumb'];

    $collar_stiffness = mi_db_read_by_id('collar_stiffness', array('id' => $id))[0];
    $u_thumb = '../'.$collar_stiffness['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/collar-stiffness/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'thumb' => $up_thumb,
            'status' => $status,
        );
    }else{
        $dta = array(
            'title' => $title,
            'status' => $status,
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('collar_stiffness', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('success'=>'error', 'msg'=>'Collar stiffness updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/collar_stiffness.php');
}

//-----------------------------edit sleeves------------------------
if (isset($_POST['edit_sleeves'])){
    $id = mi_secure_input($_POST['sleeves_id']);
    $title = mi_secure_input($_POST['title']);
    $status = mi_secure_input($_POST['status']);

    $thumb = $_FILES['sleeves_thumb'];

    $sleeves = mi_db_read_by_id('sleeves', array('id' => $id))[0];
    $u_thumb = '../'.$sleeves['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/sleeve/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'thumb' => $up_thumb,
            'status' => $status,
        );
    }else{
        $dta = array(
            'title' => $title,
            'status' => $status,
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('sleeves', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('status'=>'success', 'msg'=>'Sleeves updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/sleeves.php');
}

//-----------------------------edit cuffs------------------------
if (isset($_POST['edit_cuffs'])){
    $id = mi_secure_input($_POST['cuffs_id']);
    $title = mi_secure_input($_POST['title']);
    $subtitle = mi_secure_input($_POST['subtitle']);
    $status = mi_secure_input($_POST['status']);

    $thumb = $_FILES['cuffs_thumb'];

    $cuffs = mi_db_read_by_id('cuffs', array('id' => $id))[0];
    $u_thumb = '../'.$cuffs['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/cuffs/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'subtitle' => $subtitle,
            'thumb' => $up_thumb,
            'status' => $status,
        );
    }else{
        $dta = array(
            'title' => $title,
            'subtitle' => $subtitle,
            'status' => $status,
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('cuffs', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('status'=>'success', 'msg'=>'Cuff updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/cuffs.php');
}


//-----------------------------edit fittings------------------------
if (isset($_POST['edit_fittings'])){
    $id = mi_secure_input($_POST['fittings_id']);
    $title = mi_secure_input($_POST['title']);
    $status = mi_secure_input($_POST['status']);

    $thumb = $_FILES['fitting_thumb'];

    $sleeves = mi_db_read_by_id('fittings', array('id' => $id))[0];
    $u_thumb = '../'.$sleeves['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/fit/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'thumb' => $up_thumb,
            'status' => $status,
        );
    }else{
        $dta = array(
            'title' => $title,
            'status' => $status,
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('fittings', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('success'=>'error', 'msg'=>'Fitting updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/fittings.php');
}
//---------------------edit placket----------------------
if (isset($_POST['edit_placket'])){
    $id = mi_secure_input($_POST['placket_id']);
    $title = mi_secure_input($_POST['title']);
    $subtitle = mi_secure_input(((isset($_POST['subtitle']) && !empty($_POST['subtitle']))?$_POST['subtitle']:''));
    $status = mi_secure_input($_POST['status']);
    $buttons = mi_secure_input($_POST['buttons']);
    $price = mi_secure_input(((isset($_POST['price']) && !empty($_POST['price']))?$_POST['price']:''));

    $thumb = $_FILES['placket_thumb'];

    $placket = mi_db_read_by_id('placket', array('id' => $id))[0];
    $u_thumb = '../'.$placket['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/placket/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'subtitle' => $subtitle,
            'thumb' => $up_thumb,
            'status' => $status,
            'have_buttons' => $buttons,
            'price' => $price
        );
    }else{
        $dta = array(
            'title' => $title,
            'subtitle' => $subtitle,
            'status' => $status,
            'have_buttons' => $buttons,
            'price' => $price
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('placket', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('status'=>'success', 'msg'=>'Placket updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/placket.php');
}

//----------------------------edit pocket placement---------------------
if (isset($_POST['edit_pocket_placement'])){
    $id = mi_secure_input($_POST['pocket_placement_id']);
    $title = mi_secure_input($_POST['title']);
    $status = mi_secure_input($_POST['status']);

    $thumb = $_FILES['placement_thumb'];

    $placement = mi_db_read_by_id('pocket_placement', array('id' => $id))[0];
    $u_thumb = '../'.$placement['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/pocket/placement/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'thumb' => $up_thumb,
            'status' => $status,
        );
    }else{
        $dta = array(
            'title' => $title,
            'status' => $status,
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('pocket_placement', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('status'=>'success', 'msg'=>'Pocket Placement updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/pocket_placement.php');
}
//----------------------------edit pocket style---------------------
if (isset($_POST['edit_pocket_style'])){
    $id = mi_secure_input($_POST['pocket_style_id']);
    $title = mi_secure_input($_POST['title']);
    $status = mi_secure_input($_POST['status']);

    $thumb = $_FILES['style_thumb'];

    $style = mi_db_read_by_id('pocket_style', array('id' => $id))[0];
    $u_thumb = '../'.$style['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/pocket/style/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'thumb' => $up_thumb,
            'status' => $status,
        );
    }else{
        $dta = array(
            'title' => $title,
            'status' => $status,
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('pocket_style', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('status'=>'success', 'msg'=>'Pocket Style updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/pocket_style.php');
}

//----------------------------edit pocket flap---------------------
if (isset($_POST['edit_pocket_flap'])){
    $id = mi_secure_input($_POST['pocket_flap_id']);
    $title = mi_secure_input($_POST['title']);
    $price = mi_secure_input($_POST['price']);
    $status = mi_secure_input($_POST['status']);

    $thumb = $_FILES['flap_thumb'];

    $flap = mi_db_read_by_id('pocket_flap', array('id' => $id))[0];
    $u_thumb = '../'.$flap['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/pocket/flap/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'price' => $price,
            'thumb' => $up_thumb,
            'status' => $status,
        );
    }else{
        $dta = array(
            'title' => $title,
            'price' => $price,
            'status' => $status,
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('pocket_flap', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('status'=>'success', 'msg'=>'Pocket Flap updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/pocket_flap.php');
}
//----------------------------edit back details---------------------
if (isset($_POST['edit_back_details'])){
    $id = mi_secure_input($_POST['back_details_id']);
    $title = mi_secure_input($_POST['title']);
    $status = mi_secure_input($_POST['status']);

    $thumb = $_FILES['back_details_thumb'];

    $details = mi_db_read_by_id('back_details', array('id' => $id))[0];
    $u_thumb = '../'.$details['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/back-details/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'thumb' => $up_thumb,
            'status' => $status,
        );
    }else{
        $dta = array(
            'title' => $title,
            'status' => $status,
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('back_details', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('status'=>'success', 'msg'=>'Back Details updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/back_details.php');
}
//----------------------------edit back yoke---------------------
if (isset($_POST['edit_back_yoke'])){
    $id = mi_secure_input($_POST['back_yoke_id']);
    $title = mi_secure_input($_POST['title']);
    $status = mi_secure_input($_POST['status']);

    $thumb = $_FILES['back_yoke_thumb'];

    $yoke = mi_db_read_by_id('back_yoke', array('id' => $id))[0];
    $u_thumb = '../'.$yoke['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/back-yoke/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'thumb' => $up_thumb,
            'status' => $status,
        );
    }else{
        $dta = array(
            'title' => $title,
            'status' => $status,
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('back_yoke', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('status'=>'success', 'msg'=>'Back Yoke updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/back_yoke.php');
}
//----------------------------edit bottom cut---------------------
if (isset($_POST['edit_bottom_cut'])){
    $id = mi_secure_input($_POST['bottom_cut_id']);
    $title = mi_secure_input($_POST['title']);
    $subtitle = mi_secure_input($_POST['subtitle']);
    $status = mi_secure_input($_POST['status']);

    $thumb = $_FILES['bottom_cut_thumb'];

    $cut = mi_db_read_by_id('bottom_cut', array('id' => $id))[0];
    $u_thumb = '../'.$cut['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/bottom-cut/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'subtitle' => $subtitle,
            'thumb' => $up_thumb,
            'status' => $status,
        );
    }else{
        $dta = array(
            'title' => $title,
            'subtitle' => $subtitle,
            'status' => $status,
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('bottom_cut', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('status'=>'success', 'msg'=>'Bottom Cut updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/bottom_cut.php');
}

//-----------------------------edit contrasts------------------------
if (isset($_POST['edit_contrast'])){
    $id = mi_secure_input($_POST['contrast_id']);
    $title = mi_secure_input($_POST['title']);
    $status = mi_secure_input($_POST['status']);

    $thumb = $_FILES['contrast_thumb'];

    $contrasts = mi_db_read_by_id('contrasts', array('id' => $id))[0];
    $u_thumb = '../'.$contrasts['thumb'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/contrast/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'title' => $title,
            'thumb' => $up_thumb,
            'status' => $status,
        );
    }else{
        $dta = array(
            'title' => $title,
            'status' => $status,
        );
    }

    if (empty($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $updates = mi_db_update('contrasts', $dta, array('id'=>$id));
        if ($updates == true){
            $msg = array('success'=>'error', 'msg'=>'Contrasts updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/contrast.php');
}

//-----------------------------edit others------------------------
if (isset($_POST['edit_element'])){
    $id = mi_secure_input($_POST['element_id']);

    $thumb = $_FILES['element_thumb'];

    $elements = mi_db_read_by_id('settings', array('id' => $id))[0];
    $u_thumb = '../'.$elements['meta_value'];

    if (!empty($thumb['name'])){
        $up_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $thumb['name'],
                $thumb['tmp_name'],
                '../uploads/custom/shirt-element/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );

        if ($up_thumb != false){
            unlink($u_thumb);
        }

        $dta = array(
            'meta_value' => $up_thumb,
        );
    }

    $updates = mi_db_update('settings', $dta, array('id'=>$id));
    if ($updates == true){
        $msg = array('success'=>'error', 'msg'=>'Element updated');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to update');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/others.php');
}

//--------------------------edit user--------------------
if (isset($_POST['update_user'])){
    $user_id = mi_secure_input($_POST['edit_user_id']);
    $name = mi_secure_input($_POST['user_name']);
    $email = mi_secure_input($_POST['user_email']);
    $phone = mi_secure_input($_POST['user_phone']);
    $address = mi_secure_input($_POST['user_address']);
    $status = mi_secure_input($_POST['status']);
    $image=$_FILES['image'];

    if (empty($name) || empty($email) || empty($phone) || empty($address)){
        $msg = array('status'=>'error', 'msg'=>'All fields are required');
        mi_set_session('alert', $msg);
        mi_redirect(MI_BASE_URL.'admin/user_edit.php?e='.$user_id);
    }else{

                $cut = mi_db_read_by_id('mi_users', array('id' => $user_id))[0];
                $cut_img = $cut['user_photo'];
        //        ----------------------
                if (!empty($image['name'])){
                    $up_img = mi_uploader(
                        $image['name'],
                        $image['tmp_name'],
                        'staff-uploads/staff-profile/',
                        array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
                    );
                    if ($up_img != false){
                        unlink($cut_img);
                    }

                    $data = array(
                        'user_name'    => $name,
                        'user_email'   => $email,
                        'user_phone'   => $phone,
                        'user_address' => $address,
                        'user_photo'   => $up_img,
                        'user_status'  => $status,
                    );
                   
                }else{
                    $data = array(
                        'user_name'    => $name,
                        'user_email'   => $email,
                        'user_phone'   => $phone,
                        'user_address' => $address,
                        'user_status'  => $status,
                    );
                    
                }
        
        $update = mi_db_update('mi_users', $data, array('id'=>$user_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'User updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update user.');
        }
        mi_set_session('alert', $msg);
        mi_redirect(MI_BASE_URL.'admin/users.php');
    }

}
//-----------------------change user password----------------------
if (isset($_POST['change_user_pass'])){
    $change_id = mi_secure_input($_POST['change_pass_id']);
    $password = mi_secure_input($_POST['password']);
    $confirm_password = mi_secure_input($_POST['con_password']);

    if (empty($password) || empty($confirm_password)){
        $msg = array('status'=>'error', 'msg'=>'All fields are required');
    }elseif ($password != $confirm_password){
        $msg = array('status'=>'error', 'msg'=>'Passwords are not matching');
    }else{
        $data = array(
            'user_password' => md5($password),
            'user_salt' => $password
        );
        $update = mi_db_update('mi_users', $data, array('id' => $change_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'User Password updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Password');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/user_edit.php?e='.$change_id);
}

//--------------------------add user----------------------
if (isset($_POST['add_user'])){
    $name = mi_secure_input($_POST['name']);
    $email = mi_secure_input($_POST['email']);
    $phone = mi_secure_input($_POST['phone']);
    $address = mi_secure_input($_POST['address']);
    $password = mi_secure_input($_POST['password']);
    $con_pass = mi_secure_input($_POST['con_pass']);
    $status = mi_secure_input($_POST['status']);

    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($password) || empty($con_pass) || empty($status)){
        $msg = array('status'=>'error', 'msg'=>'All fields are required');
    }elseif ($password != $con_pass){
        $msg = array('status'=>'error', 'msg'=>'Passwords are not matching');
    }else{
        $data = array(
            'user_name' => $name,
            'user_email' => $email,
            'user_phone' => $phone,
            'user_address' => $address,
            'user_password' => md5($password),
            'user_salt' => $password,
            'user_status' => $status
        );
        $insert = mi_db_insert('mi_users', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'User added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add user');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/users.php');
}

//-------------------add roles--------------------
if (isset($_POST['role_add'])){
    $role_name = mi_secure_input($_POST['role_name']);
    $design = mi_secure_input(((isset($_POST['design']) && !empty($_POST['design']))?$_POST['design']:''));
    $tailoring = mi_secure_input(((isset($_POST['tailoring']) && !empty($_POST['tailoring']))?$_POST['tailoring']:''));
    $order = mi_secure_input(((isset($_POST['order']) && !empty($_POST['order']))?$_POST['order']:''));
    $settings = mi_secure_input(((isset($_POST['settings']) && !empty($_POST['settings']))?$_POST['settings']:''));
    $u_manage = mi_secure_input(((isset($_POST['u_manage']) && !empty($_POST['u_manage']))?$_POST['u_manage']:''));
    $status = mi_secure_input($_POST['status']);

    if (!empty($role_name) && isset($role_name)){
        $data = array(
            'role_name' => $role_name,
            'design' => $design,
            'tailoring' => $tailoring,
            'orders' => $order,
            'user_management' => $u_manage,
            'settings' => $settings,
            'status' => $status
        );
        $insert = mi_db_insert('user_roles', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Role added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add role');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Role name is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/staff_roles.php');
}

//-------------------edit roles--------------------
if (isset($_POST['role_edit'])){
    $role_id = mi_secure_input($_POST['role_edit_id']);
    $role_name = mi_secure_input($_POST['role_name']);
    $design = mi_secure_input(((isset($_POST['design']) && !empty($_POST['design']))?$_POST['design']:''));
    $tailoring = mi_secure_input(((isset($_POST['tailoring']) && !empty($_POST['tailoring']))?$_POST['tailoring']:''));
    $order = mi_secure_input(((isset($_POST['order']) && !empty($_POST['order']))?$_POST['order']:''));
    $settings = mi_secure_input(((isset($_POST['settings']) && !empty($_POST['settings']))?$_POST['settings']:''));
    $u_manage = mi_secure_input(((isset($_POST['u_manage']) && !empty($_POST['u_manage']))?$_POST['u_manage']:''));
    $status = mi_secure_input($_POST['status']);

    if (!empty($role_name) && isset($role_name)){
        $data = array(
            'role_name' => $role_name,
            'design' => $design,
            'tailoring' => $tailoring,
            'orders' => $order,
            'user_management' => $u_manage,
            'settings' => $settings,
            'status' => $status
        );
        $update = mi_db_update('user_roles', $data, array('id' => $role_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Role updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update role');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'Role name is required');
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/staff_roles.php');
}

//--------------------------delete roles--------------------------
//if (isset($_GET['d']) && !empty($_GET['d'])){
//    $d_id = mi_secure_input($_GET['d']);
//    $delete = mi_db_delete('user_roles', array('id' => $d_id));
//    if ($delete){
//        $msg = array('status'=>'success', 'msg'=>'Role deleted');
//    }else{
//        $msg = array('status'=>'error', 'msg'=>'Role not deleted');
//    }
//    mi_set_session('alert', $msg);
//    mi_redirect(MI_BASE_URL.'admin/staff_roles.php');
//}

//-------------------------add staff---------------------------
if (isset($_POST['add_staff'])){
    $name = mi_secure_input($_POST['name']);
    $email = mi_secure_input($_POST['email']);
    $phone = mi_secure_input($_POST['phone']);
    $address = mi_secure_input($_POST['address']);
    $password = mi_secure_input($_POST['password']);
    $con_pass = mi_secure_input($_POST['con_pass']);
    $status = mi_secure_input($_POST['status']);
    $role = mi_secure_input($_POST['role']);

    $image = $_FILES['image'];

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Staff name is required');
    }elseif(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $msg = array('status'=>'error', 'msg'=>'Valid staff email is required');
    }elseif(empty($phone) || strlen($phone) != 10){
        $msg = array('status'=>'error', 'msg'=>'Valid 10 digit Phone Number is required!');
    }elseif(empty($address)){
        $msg = array('status'=>'error', 'msg'=>'Staff address is required!');
    }elseif(empty($password)){
        $msg = array('status'=>'error', 'msg'=>'Password is required!');
    }elseif(empty($con_pass) || $password!= $con_pass){
        $msg = array('status'=>'error', 'msg'=>'Password not matching!');
    }elseif(empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }elseif(empty($role)){
        $msg = array('status'=>'error', 'msg'=>'Staff role is required');
    }else{
        if (!empty($image['name'])){
            $up_img = mi_uploader(
                $image['name'],
                $image['tmp_name'],
                'staff-uploads/staff-profile/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            );
            $data = array(
                'user_name' => $name,
                'user_email' => $email,
                'user_phone' => $phone,
                'user_address' => $address,
                'user_password' => md5($password),
                'user_salt' => $password,
                'user_status' => $status,
                'role_id' => $role,
                'user_photo' => $up_img,
            );
        }else{
            $data = array(
                'user_name' => $name,
                'user_email' => $email,
                'user_phone' => $phone,
                'user_address' => $address,
                'user_password' => md5($password),
                'user_salt' => $password,
                'user_status' => $status,
                'role_id' => $role,
            );
        }

        $insert = mi_db_insert('mi_admin', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Staff added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add staff');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/staffs.php');
}

//-------------------------edit staff---------------------------
if (isset($_POST['edit_staff'])){
    $edit_id = mi_secure_input($_POST['edit_staff_id']);
    $name = mi_secure_input($_POST['name']);
    $email = mi_secure_input($_POST['email']);
    $phone = mi_secure_input($_POST['phone']);
    $address = mi_secure_input($_POST['address']);
    $status = mi_secure_input($_POST['status']);
    $role = mi_secure_input($_POST['role']);

    $image = $_FILES['image'];

    if (empty($name)){
        $msg = array('status'=>'error', 'msg'=>'Staff name is required');
    }elseif(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $msg = array('status'=>'error', 'msg'=>'Valid staff email is required');
    }elseif(empty($phone) || strlen($phone) != 10){
        $msg = array('status'=>'error', 'msg'=>'Valid 10 digit Phone Number is required!');
    }elseif(empty($address)){
        $msg = array('status'=>'error', 'msg'=>'Staff address is required!');
    }elseif(empty($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }elseif(empty($role)){
        $msg = array('status'=>'error', 'msg'=>'Staff role is required');
    }else{
        $cut = mi_db_read_by_id('mi_admin', array('id' => $edit_id))[0];
        $cut_img = $cut['user_photo'];

        if (!empty($image['name'])){
            $up_img = mi_uploader(
                $image['name'],
                $image['tmp_name'],
                'staff-uploads/staff-profile/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            );
            if ($up_img != false){
                unlink($cut_img);
            }

            $data = array(
                'user_name' => $name,
                'user_email' => $email,
                'user_phone' => $phone,
                'user_address' => $address,
                'user_status' => $status,
                'role_id' => $role,
                'user_photo' => $up_img,
            );
        }else{
            $data = array(
                'user_name' => $name,
                'user_email' => $email,
                'user_phone' => $phone,
                'user_address' => $address,
                'user_status' => $status,
                'role_id' => $role,
            );
        }

        $update = mi_db_update('mi_admin', $data, array('id' => $edit_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Staff updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update staff');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/staffs.php');
}
//-----------------------change staff password----------------------
if (isset($_POST['change_staff_pass'])){
    $change_id = mi_secure_input($_POST['change_pass_id']);
    $password = mi_secure_input($_POST['password']);
    $confirm_password = mi_secure_input($_POST['con_password']);

    if (empty($password) || empty($confirm_password)){
        $msg = array('status'=>'error', 'msg'=>'All fields are required');
    }elseif ($password != $confirm_password){
        $msg = array('status'=>'error', 'msg'=>'Passwords are not matching');
    }else{
        $data = array(
            'user_password' => md5($password),
            'user_salt' => $password
        );
        $update = mi_db_update('mi_admin', $data, array('id' => $change_id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Staff Password updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Password');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/staff_edit.php?e='.$change_id);
}

//===============================Settings===============================
//----------------------change site title--------------------
if (isset($_POST['change_site_title_submit'])){
    $id = mi_secure_input($_POST['site_title_id']);
    $title = mi_secure_input($_POST['site_title']);

    if(empty($title) || !isset($title)){
        $msg = array('status'=>'error', 'msg'=>'Site Title is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $title), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Site Title updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Site Title');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/settings.php');
}

//===========change hole threat Thumb=============================
if (isset($_POST['change_ht_thumb_submit'])){
    $id = mi_secure_input($_POST['id']);

    $image = $_FILES['button_hole_thread_thumb'];

    if (empty($image['name'])){
        $msg = array('status'=>'error', 'msg'=>'Image is required');
    }else{
        $cut = mi_db_read_by_id('settings', array('id' => $id))[0];
        $cut_image = $cut['meta_value'];

        $up_image = str_replace(
            '../',
            '',
            mi_uploader(
                $image['name'],
                $image['tmp_name'],
                '../uploads/custom/shirt-element/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_image != false){
            unlink('../'.$cut_image);
        }
        $update = mi_db_update('settings', array('meta_value' => $up_image), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Thumb updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Thumb');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');

}
 
//===========change Embroidery Thumb=============================
if (isset($_POST['change_embroidery_thumb_submit'])){
    $id = mi_secure_input($_POST['id']);

    $image = $_FILES['embroidery_thumb'];

    if (empty($image['name'])){
        $msg = array('status'=>'error', 'msg'=>'Image is required');
    }else{
        $cut = mi_db_read_by_id('settings', array('id' => $id))[0];
        $cut_image = $cut['meta_value'];

        $up_image = str_replace(
            '../',
            '',
            mi_uploader(
                $image['name'],
                $image['tmp_name'],
                '../uploads/custom/shirt-element/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_image != false){
            unlink('../'.$cut_image);
        }
        $update = mi_db_update('settings', array('meta_value' => $up_image), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Thumb updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Thumb');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');

}
 
//===========change contrast Thumb=============================
if (isset($_POST['change_contrast_thumb_submit'])){
    $id = mi_secure_input($_POST['id']);

    $image = $_FILES['contrast_thumb'];

    if (empty($image['name'])){
        $msg = array('status'=>'error', 'msg'=>'Image is required');
    }else{
        $cut = mi_db_read_by_id('settings', array('id' => $id))[0];
        $cut_image = $cut['meta_value'];

        $up_image = str_replace(
            '../',
            '',
            mi_uploader(
                $image['name'],
                $image['tmp_name'],
                '../uploads/custom/shirt-element/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_image != false){
            unlink('../'.$cut_image);
        }
        $update = mi_db_update('settings', array('meta_value' => $up_image), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Thumb updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Thumb');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');

}


//===========change button Threat Thumb=============================
if (isset($_POST['change_threat_thumb_submit'])){
    $id = mi_secure_input($_POST['id']);

    $image = $_FILES['button_thread_thumb'];

    if (empty($image['name'])){
        $msg = array('status'=>'error', 'msg'=>'Image is required');
    }else{
        $cut = mi_db_read_by_id('settings', array('id' => $id))[0];
        $cut_image = $cut['meta_value'];

        $up_image = str_replace(
            '../',
            '',
            mi_uploader(
                $image['name'],
                $image['tmp_name'],
                '../uploads/custom/shirt-element/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_image != false){
            unlink('../'.$cut_image);
        }
        $update = mi_db_update('settings', array('meta_value' => $up_image), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Thumb updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Thumb');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');

}

//===========change button Thumb=============================
if (isset($_POST['change_button_thumb_submit'])){
    $id = mi_secure_input($_POST['id']);

    $image = $_FILES['button_thumb'];

    if (empty($image['name'])){
        $msg = array('status'=>'error', 'msg'=>'Image is required');
    }else{
        $cut = mi_db_read_by_id('settings', array('id' => $id))[0];
        $cut_image = $cut['meta_value'];

        $up_image = str_replace(
            '../',
            '',
            mi_uploader(
                $image['name'],
                $image['tmp_name'],
                '../uploads/custom/shirt-element/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_image != false){
            unlink('../'.$cut_image);
        }
        $update = mi_db_update('settings', array('meta_value' => $up_image), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Thumb updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Thumb');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');

}
//===========change fabric Thumb=============================
if (isset($_POST['change_fabric_thumb_submit'])){
    $id = mi_secure_input($_POST['id']);

    $image = $_FILES['fabric_thumb'];

    if (empty($image['name'])){
        $msg = array('status'=>'error', 'msg'=>'Image is required');
    }else{
        $cut = mi_db_read_by_id('settings', array('id' => $id))[0];
        $cut_image = $cut['meta_value'];

        $up_image = str_replace(
            '../',
            '',
            mi_uploader(
                $image['name'],
                $image['tmp_name'],
                '../uploads/custom/shirt-element/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_image != false){
            unlink('../'.$cut_image);
        }
        $update = mi_db_update('settings', array('meta_value' => $up_image), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Thumb updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Thumb');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');

}

//----------------------change site logo--------------------
if (isset($_POST['change_site_logo_submit'])){
    $id = mi_secure_input($_POST['id']);

    $logo = $_FILES['site_logo'];

    if (empty($logo['name'])){
        $msg = array('status'=>'error', 'msg'=>'Logo is required');
    }else{
        $cut = mi_db_read_by_id('settings', array('id' => $id))[0];
        $cut_logo = $cut['meta_value'];

        $up_logo = str_replace(
            '../',
            '',
            mi_uploader(
                $logo['name'],
                $logo['tmp_name'],
                '../uploads/site-logo/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_logo != false){
            unlink('../'.$cut_logo);
        }
        $update = mi_db_update('settings', array('meta_value' => $up_logo), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Site Logo updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Logo');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');

}


//----------------------change Contact--------------------
if (isset($_POST['change_contact_info_submit'])){
    $id = mi_secure_input($_POST['id']);
    $contact_info = mi_secure_input($_POST['contact_info']);

    if(empty($contact_info) || !isset($contact_info)){
        $msg = array('status'=>'error', 'msg'=>'Contact is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $contact_info), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Contact updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Content');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change paypal client Id--------------------
if (isset($_POST['change_paypalId_submit'])){
    $id = mi_secure_input($_POST['id']);
    $paypal_client_id = mi_secure_input($_POST['paypal_client_id']);

    if(empty($paypal_client_id) || !isset($paypal_client_id)){
        $msg = array('status'=>'error', 'msg'=>'Paypal Client ID is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $paypal_client_id), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Paypal Id  updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Paypal Id');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change paypal currency--------------------
if (isset($_POST['change_paypaCurrency_submit'])){
    $id = mi_secure_input($_POST['id']);
    $paypal_currency = mi_secure_input($_POST['paypal_currency']);

    if(empty($paypal_currency) || !isset($paypal_currency)){
        $msg = array('status'=>'error', 'msg'=>'Paypal currency required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $paypal_currency), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Paypal Currency  updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Paypal currency');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change footer title--------------------
if (isset($_POST['change_footer_text_submit'])){
    $id = mi_secure_input($_POST['id']);
    $footer_text = mi_secure_input($_POST['footer_text']);

    if(empty($footer_text) || !isset($footer_text)){
        $msg = array('status'=>'error', 'msg'=>'Footer text is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $footer_text), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Footer text updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Footer text');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change footer text--------------------
if (isset($_POST['change_footer_title_submit'])){
    $id = mi_secure_input($_POST['id']);
    $footer_title = mi_secure_input($_POST['footer_title']);

    if(empty($footer_title) || !isset($footer_title)){
        $msg = array('status'=>'error', 'msg'=>'Footer Title is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $footer_title), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Footer title updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Footer title');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}
//----------------------change footer copyright--------------------
if (isset($_POST['change_footer_copyright_submit'])){
    $id = mi_secure_input($_POST['footer_copyright_id']);
    $footer_copyright = mi_secure_input($_POST['footer_copyright']);

    if(empty($footer_copyright) || !isset($footer_copyright)){
        $msg = array('status'=>'error', 'msg'=>'Footer Copyright is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $footer_copyright), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Footer Copyright updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Footer Copyright');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/settings.php');
}

//----------------------change copyright link--------------------
if (isset($_POST['change_copyright_link_submit'])){
    $id = mi_secure_input($_POST['copyright_link_id']);
    $copyright_link = mi_secure_input($_POST['copyright_link']);

    if(empty($copyright_link) || !isset($copyright_link)){
        $msg = array('status'=>'error', 'msg'=>'Copyright Link is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $copyright_link), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Copyright Link updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Copyright Link');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/settings.php');
}
//----------------------------change social icon-------------------------
if (isset($_POST['change_social_icon_submit'])){
    $data = $_POST['social_data'];

    foreach ($data['id'] as $k => $id){
        mi_db_update(
            'settings',
            array(
                'meta_name' => (isset($data['icon'][$k]) && !empty($data['icon'][$k])? mi_secure_input($data['icon'][$k]):''),
                'meta_value' => (isset($data['link'][$k]) && !empty($data['link'][$k])? mi_secure_input($data['link'][$k]):'')
            ),
            array('id' =>$id)
        );
    }
    mi_redirect(MI_BASE_URL.'admin/settings.php');
}
//----------------------change Banner --------------------
if (isset($_POST['change_banner_submit'])){
    $id = mi_secure_input($_POST['banner_id']);

    $image = $_FILES['banner'];

    if (empty($image['name'])){
        $msg = array('status'=>'error', 'msg'=>'Banner is required');
    }else{
        $cut = mi_db_read_by_id('home_page_settings', array('id' => $id))[0];
        $cut_image = $cut['meta_value'];

       
        if ($up_image != false){
            unlink('../'.$cut_image);
        }
        $update = mi_db_update('home_page_settings', array('meta_value' => $up_image), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Banner updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Banner');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');

}

//----------------------change Site title--------------------
if (isset($_POST['change_site_title_submit'])){
    $id = mi_secure_input($_POST['id']);
    $title = mi_secure_input($_POST['site_title']);

    if(empty($title) || !isset($title)){
        $msg = array('status'=>'error', 'msg'=>'Site Title is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $title), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Site Title updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Site Title');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change banner text--------------------
if (isset($_POST['change_banner_text_submit'])){
    $id = mi_secure_input($_POST['banner_text_id']);
    $text = mi_secure_input($_POST['banner_text']);

    if(empty($text) || !isset($text)){
        $msg = array('status'=>'error', 'msg'=>'Banner Text is required!');
    }else{
        $update = mi_db_update('home_page_settings', array('meta_value' => $text), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Banner Text updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Banner Text');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change footer copy right text--------------------
if (isset($_POST['change_footer_copyright_text_submit'])){
    $id = mi_secure_input($_POST['id']);
    $text = mi_secure_input($_POST['footer_copyright']);

    if(empty($text) || !isset($text)){
        $msg = array('status'=>'error', 'msg'=>'Copy Right Text is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $text), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Copy right Text updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update copyright Text');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change footer copy right link--------------------
if (isset($_POST['change_footer_copyright_link_submit'])){
    $id = mi_secure_input($_POST['id']);
    $link = mi_secure_input($_POST['copyright_link']);

    if(empty($link) || !isset($link)){
        $msg = array('status'=>'error', 'msg'=>'Copy Right Text is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $link), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Copy right link updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update copyright link');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}


//----------------------change facebook link--------------------
if (isset($_POST['change_facebook_submit'])){
    $id = mi_secure_input($_POST['id']);
    $facebook = mi_secure_input($_POST['facebook']);

    if(empty($facebook) || !isset($facebook)){
        $msg = array('status'=>'error', 'msg'=>'Facebook link is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $facebook), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Facebook link updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to facebook link');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change twitter link--------------------
if (isset($_POST['change_twitter_submit'])){
    $id = mi_secure_input($_POST['id']);
    $twitter = mi_secure_input($_POST['twitter']);

    if(empty($twitter) || !isset($twitter)){
        $msg = array('status'=>'error', 'msg'=>'Twitter link is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $twitter), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Twitter link updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to twitter link');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change linkedIn link--------------------
if (isset($_POST['change_linkedin_submit'])){
    $id = mi_secure_input($_POST['id']);
    $linkedin = mi_secure_input($_POST['linkedin']);

    if(empty($linkedin) || !isset($linkedin)){
        $msg = array('status'=>'error', 'msg'=>'Linkedin link is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $linkedin), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Linkedin link updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to linkedin link');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}


//----------------------change Instragram link--------------------
if (isset($_POST['change_instragram_submit'])){
    $id = mi_secure_input($_POST['id']);
    $instagram = mi_secure_input($_POST['instagram']);

    if(empty($instagram) || !isset($instagram)){
        $msg = array('status'=>'error', 'msg'=>'Instagram link is required!');
    }else{
        $update = mi_db_update('settings', array('meta_value' => $instagram), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Instagram link updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to instagram link');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}


//----------------------change content heading title--------------------
if (isset($_POST['change_content_heading_title_submit'])){
    $id = mi_secure_input($_POST['heading_title_id']);
    $title = mi_secure_input($_POST['content_heading_title']);

    if(empty($title) || !isset($title)){
        $msg = array('status'=>'error', 'msg'=>'Content Heading Title is required!');
    }else{
        $update = mi_db_update('home_page_settings', array('meta_value' => $title), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Content Heading Title updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Content Heading Title');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change content heading text--------------------
if (isset($_POST['change_content_heading_text_submit'])){
    $id = mi_secure_input($_POST['heading_text_id']);
    $text = mi_secure_input($_POST['heading_content_text']);

    if(empty($text) || !isset($text)){
        $msg = array('status'=>'error', 'msg'=>'Content Heading Text is required!');
    }else{
        $update = mi_db_update('home_page_settings', array('meta_value' => $text), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Content Heading Text updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Content Heading Text');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change content image --------------------
if (isset($_POST['change_content_image_submit'])){
    $id = mi_secure_input($_POST['content_image_id']);

    $image = $_FILES['content_image'];

    if (empty($image['name'])){
        $msg = array('status'=>'error', 'msg'=>'Content Image is required');
    }else{
        $cut = mi_db_read_by_id('home_page_settings', array('id' => $id))[0];
        $cut_image = $cut['meta_value'];

        $up_image = str_replace(
            '../',
            '',
            mi_uploader(
                $image['name'],
                $image['tmp_name'],
                '../uploads/home-page/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'GIF', 'JPEG', 'svg', 'SVG')
            )
        );
        if ($up_image != false){
            unlink('../'.$cut_image);
        }
        $update = mi_db_update('home_page_settings', array('meta_value' => $up_image), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Content Image updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Content Image');
        }

    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');

}


//-----------------------------change contents-------------------------
if (isset($_POST['change_content_submit'])){
    $id = mi_secure_input($_POST['item_id']);
    $icon = mi_secure_input($_POST['subcontent_icon']);
    $title = mi_secure_input($_POST['subcontent_title']);
    $text = mi_secure_input($_POST['subcontent_text']);

    $data = array(
        'icon' => $icon,
        'title' => $title,
        'text' => $text
    );
//    print_r(json_encode($data));
    if (empty($icon) || !isset($icon) || empty($title) || !isset($title) || empty($text) || !isset($text)){
        $msg = array('status'=>'error', 'msg'=>'All fields are required');
    }else{
        $update = mi_db_update('home_page_settings', array('meta_value'=> json_encode($data)), array('id'=> $id));

        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Content updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Content');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change best seller text--------------------
if (isset($_POST['change_best_seller_text_submit'])){
    $id = mi_secure_input($_POST['best_seller_text_id']);
    $text = mi_secure_input($_POST['best_seller_text']);

    if(empty($text) || !isset($text)){
        $msg = array('status'=>'error', 'msg'=>'Best Seller Heading Text is required!');
    }else{
        $update = mi_db_update('home_page_settings', array('meta_value' => $text), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Best Seller Heading Text updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Best Seller Heading Text');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change best seller quantity--------------------
if (isset($_POST['change_best_seller_quantity_submit'])){
    $id = mi_secure_input($_POST['best_seller_quantity_id']);
    $quantity = mi_secure_input($_POST['best_seller_quantity']);

    if(empty($quantity) || !isset($quantity)){
        $msg = array('status'=>'error', 'msg'=>'Best Seller Heading quantity is required!');
    }else{
        $update = mi_db_update('home_page_settings', array('meta_value' => $quantity), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Best Seller quantity updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Best Seller quantity');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change feature text--------------------
if (isset($_POST['change_feature_text_submit'])){
    $id = mi_secure_input($_POST['feature_text_id']);
    $feature_text = mi_secure_input($_POST['feature_text']);

    if(empty($feature_text) || !isset($feature_text)){
        $msg = array('status'=>'error', 'msg'=>'Feature text is required!');
    }else{
        $update = mi_db_update('home_page_settings', array('meta_value' => $feature_text), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Feature text updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Feature text');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//-----------------------------change feature item-------------------------
if (isset($_POST['change_feature_item_submit'])){
    $id = mi_secure_input($_POST['feature_item_id']);
    $icon = mi_secure_input($_POST['feature_item_icon']);
    $title = mi_secure_input($_POST['feature_item_title']);
    $text = mi_secure_input($_POST['feature_item_text']);

    $data = array(
        'icon' => $icon,
        'title' => $title,
        'text' => $text
    );
//    print_r(json_encode($data));
    if (empty($icon) || !isset($icon) || empty($title) || !isset($title) || empty($text) || !isset($text)){
        $msg = array('status'=>'error', 'msg'=>'All fields are required');
    }else{
        $update = mi_db_update('home_page_settings', array('meta_value'=> json_encode($data)), array('id'=> $id));

        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Feature item updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Feature item');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change testimonial text--------------------
if (isset($_POST['change_testimonial_text_submit'])){
    $id = mi_secure_input($_POST['testimonial_text_id']);
    $testimonial_text = mi_secure_input($_POST['testimonial_text']);

    if(empty($testimonial_text) || !isset($testimonial_text)){
        $msg = array('status'=>'error', 'msg'=>'Testimonial text is required!');
    }else{
        $update = mi_db_update('home_page_settings', array('meta_value' => $testimonial_text), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Testimonial text updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Testimonial text');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//----------------------change faq text--------------------
if (isset($_POST['change_faq_text_submit'])){
    $id = mi_secure_input($_POST['faq_text_id']);
    $faq_text = mi_secure_input($_POST['faq_text']);

    if(empty($faq_text) || !isset($faq_text)){
        $msg = array('status'=>'error', 'msg'=>'FAQ text is required!');
    }else{
        $update = mi_db_update('home_page_settings', array('meta_value' => $faq_text), array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'FAQ text updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update FAQ text');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/home_page_settings.php');
}

//-------------------------add testimonial-------------------------
if (isset($_POST['add_testimonial'])){
    $name = mi_secure_input($_POST['name']);
    $designation = mi_secure_input($_POST['designation']);
    $quote = mi_secure_input($_POST['quote']);
    $rating = mi_secure_input($_POST['rating']);

    $photo = $_FILES['photo'];

    if (empty($name) || !isset($name)){
        $msg = array('status'=>'error', 'msg'=>'Client name is required');
    }elseif (empty($designation) || !isset($designation)){
        $msg = array('status'=>'error', 'msg'=>'Client designation is required');
    }elseif (empty($quote) || !isset($quote)){
        $msg = array('status'=>'error', 'msg'=>'Quote is required');
    }elseif (empty($rating) || !isset($rating)){
        $msg = array('status'=>'error', 'msg'=>'Rating is required');
    }else{
        if (!empty($photo['name'])){
            $up_img = str_replace(
                '../',
                '',
                mi_uploader(
                    $photo['name'],
                    $photo['tmp_name'],
                    '../uploads/testimonial/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                )
            );
            $data = array(
                'name' => $name,
                'designation' => $designation,
                'quote' => $quote,
                'rating' => $rating,
                'photo' => $up_img,
            );
        }else{
            $data = array(
                'name' => $name,
                'designation' => $designation,
                'quote' => $quote,
                'rating' => $rating
            );
        }
        $insert = mi_db_insert('testimonials', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Testimonial added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add testimonial');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/testimonials.php');
}

//-------------------------edit testimonial-------------------------
if (isset($_POST['edit_testimonial'])){
    $id = mi_secure_input($_POST['testimonial_id']);
    $name = mi_secure_input($_POST['name']);
    $designation = mi_secure_input($_POST['designation']);
    $quote = mi_secure_input($_POST['quote']);
    $rating = mi_secure_input($_POST['rating']);

    $photo = $_FILES['photo'];

    if (empty($name) || !isset($name)){
        $msg = array('status'=>'error', 'msg'=>'Client name is required');
    }elseif (empty($designation) || !isset($designation)){
        $msg = array('status'=>'error', 'msg'=>'Client designation is required');
    }elseif (empty($quote) || !isset($quote)){
        $msg = array('status'=>'error', 'msg'=>'Quote is required');
    }elseif (empty($rating) || !isset($rating)){
        $msg = array('status'=>'error', 'msg'=>'Rating is required');
    }else{
        if (!empty($photo['name'])){
            $cut = mi_db_read_by_id('testimonials', array('id' => $id))[0];
            $cut_image = $cut['photo'];

            $up_img = str_replace(
                '../',
                '',
                mi_uploader(
                    $photo['name'],
                    $photo['tmp_name'],
                    '../uploads/testimonial/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                )
            );
            $data = array(
                'name' => $name,
                'designation' => $designation,
                'quote' => $quote,
                'rating' => $rating,
                'photo' => $up_img,
            );
        }else{
            $data = array(
                'name' => $name,
                'designation' => $designation,
                'quote' => $quote,
                'rating' => $rating
            );
        }
        if ($up_img != false){
            unlink('../'.$cut_image);
        }
        $update = mi_db_update('testimonials', $data, array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Testimonial updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update testimonial');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/testimonials.php');
}

//---------------------------add faq---------------------------
if (isset($_POST['add_faqs'])){
    $question = mi_secure_input($_POST['question']);
    $answer = mi_secure_input($_POST['answer']);

    if (empty($question) || !isset($question)){
        $msg = array('status'=>'error', 'msg'=>'Question is required');
    }elseif (empty($answer) || !isset($answer)){
        $msg = array('status'=>'error', 'msg'=>'Answer is required');
    }else{
        $insert = mi_db_insert('faqs', array('question'=> $question, 'answer'=> $answer));
        if ($insert == true){
            $msg = array('status'=>'error', 'msg'=>'FAQ added');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add FAQ');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/faqs.php');

}

//---------------------------edit faq---------------------------
if (isset($_POST['edit_faq'])){
    $id = mi_secure_input($_POST['faq_id']);
    $question = mi_secure_input($_POST['question']);
    $answer = mi_secure_input($_POST['answer']);

    if (empty($question) || !isset($question)){
        $msg = array('status'=>'error', 'msg'=>'Question is required');
    }elseif (empty($answer) || !isset($answer)){
        $msg = array('status'=>'error', 'msg'=>'Answer is required');
    }else{
        $update = mi_db_update('faqs', array('question'=> $question, 'answer'=> $answer), array('id'=>$id));
        if ($update == true){
            $msg = array('status'=>'error', 'msg'=>'FAQ updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update FAQ');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/faqs.php');

}

//-----------------------------add page-----------------------------
if (isset($_POST['add_page'])){
    $title = mi_secure_input($_POST['title']);
    $status = mi_secure_input($_POST['status']);
    $content = mi_secure_input($_POST['content']);

    $image = $_FILES['image'];

    if (empty($title) || !isset($title)){
        $msg = array('status'=>'error', 'msg'=>'Page Title is required');
    }elseif (empty($status) || !isset($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }elseif (empty($image['name']) || !isset($image['name'])){
        $msg = array('status'=>'error', 'msg'=>'Page Background Image is required');
    }else{
        if (!empty($image['name'])){

            $up_img = str_replace(
                '../',
                '',
                mi_uploader(
                    $image['name'],
                    $image['tmp_name'],
                    '../uploads/page/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                )
            );
            $data = array(
                'title' => $title,
                'status' => $status,
                'content' => $content,
                'background_image' => $up_img,
            );
        }
        $insert = mi_db_insert('pages', $data);
        if ($insert == true){
            $msg = array('status'=>'success', 'msg'=>'Page Added successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to add Page');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/pages.php');
}

//-----------------------------edit page-----------------------------
if (isset($_POST['edit_page'])){
    $id = mi_secure_input($_POST['page_id']);
    $title = mi_secure_input($_POST['title']);
    $status = mi_secure_input($_POST['status']);
    $content = mi_secure_input($_POST['content']);

    $image = $_FILES['image'];

    if (empty($title) || !isset($title)){
        $msg = array('status'=>'error', 'msg'=>'Page Title is required');
    }elseif (empty($status) || !isset($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }else{
        $cut = mi_db_read_by_id('pages', array('id' => $id))[0];
        $cut_image = $cut['background_image'];

        if (!empty($image['name'])){

            $up_img = str_replace(
                '../',
                '',
                mi_uploader(
                    $image['name'],
                    $image['tmp_name'],
                    '../uploads/page/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                )
            );
            if ($up_img != false){
                unlink('../'.$cut_image);
            }

            $data = array(
                'title' => $title,
                'status' => $status,
                'content' => $content,
                'background_image' => $up_img
            );
        }else{
            $data = array(
                'title' => $title,
                'status' => $status,
                'content' => $content
            );
        }

        $update = mi_db_update('pages', $data, array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Page Updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to Update Page');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/pages.php');
}

//-----------------------------edit measurement settings-----------------------------
if (isset($_POST['edit_mes_settings'])){
    $id = mi_secure_input($_POST['mes_setting_id']);
    $title = mi_secure_input($_POST['title']);
    $description = mi_secure_input($_POST['description']);
    $status = mi_secure_input($_POST['status']);
    $type = mi_secure_input($_POST['type']);

    $background_image = $_FILES['background_image'];
    $icon = $_FILES['icon'];

    if (empty($title) || !isset($title)){
        $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($description) || !isset($description)){
        $msg = array('status'=>'error', 'msg'=>'Description is required');
    }elseif (empty($status) || !isset($status)){
        $msg = array('status'=>'error', 'msg'=>'Status is required');
    }elseif (empty($type) || !isset($type)){
        $msg = array('status'=>'error', 'msg'=>'Type is required');
    }else{
        $cut = mi_db_read_by_id('measurement_meta', array('id' => $id))[0];
        $cut_background = $cut['background_image'];
        $cut_icon = $cut['icon'];

        if (!empty($background_image['name'])){

            $up_background_img = str_replace(
                '../',
                '',
                mi_uploader(
                    $background_image['name'],
                    $background_image['tmp_name'],
                    '../img/measurement/mes-all/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                )
            );
            if ($up_background_img != false){
                unlink('../'.$cut_background);
            }

            $data = array(
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'type' => $type,
                'background_image' => $up_background_img,
            );
        }elseif (!empty($icon['name'])){
            $up_icon = str_replace(
                '../',
                '',
                mi_uploader(
                    $icon['name'],
                    $icon['tmp_name'],
                    '../img/measurement/button-all/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                )
            );
            if ($up_icon != false){
                unlink('../'.$cut_icon);
            }

            $data = array(
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'type' => $type,
                'icon' => $up_icon,
            );
        }else{
            $data = array(
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'type' => $type
            );
        }

        $update = mi_db_update('measurement_meta', $data, array('id' => $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Measurement settings Updated successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to Update Measurement settings');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/measurement_settings.php');
}

//----------------------delete page-----------------------
if (isset($_POST['page_delete_request']) && !empty($_POST['page_delete_request']) && $_POST['page_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $delete = mi_db_delete('pages', 'id', array($id));

    if ($delete == true){
        $message['status'] = 'success';
        $message['msg'] = 'Page deleted successfully';
    }else{
        $message['status'] = 'error';
        $message['msg'] = 'Error to delete Page';
    }
    echo json_encode($message);
}

//----------------------delete faq-----------------------
if (isset($_POST['faq_delete_request']) && !empty($_POST['faq_delete_request']) && $_POST['faq_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $delete = mi_db_delete('faqs', 'id', array($id));

    if ($delete == true){
        $message['status'] = 'success';
        $message['msg'] = 'FAQ deleted successfully';
    }else{
        $message['status'] = 'error';
        $message['msg'] = 'Error to delete FAQ';
    }
    echo json_encode($message);
}

//----------------------delete testimonial-----------------------
if (isset($_POST['testimonial_delete_request']) && !empty($_POST['testimonial_delete_request']) && $_POST['testimonial_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $delete = mi_db_delete('testimonials', 'id', array($id));

    if ($delete == true){
        $message['status'] = 'success';
        $message['msg'] = 'Testimonial deleted successfully';
    }else{
        $message['status'] = 'error';
        $message['msg'] = 'Error to delete Testimonial';
    }
    echo json_encode($message);
}



//===============================End Settings===========================

//----------------------delete role-----------------------
if (isset($_POST['role_delete_request']) && !empty($_POST['role_delete_request']) && $_POST['role_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $delete = mi_db_delete('user_roles', 'id', array($id));

    if ($delete == true){
        $message['status'] = 'success';
        $message['msg'] = 'Role deleted successfully';
    }else{
        $message['status'] = 'error';
        $message['msg'] = 'Error to delete Role';
    }
    echo json_encode($message);
}

//----------------------delete thread-----------------------
if (isset($_POST['thread_delete_request']) && !empty($_POST['thread_delete_request']) && $_POST['thread_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $delete = mi_db_delete('button_threads', 'id', array($id));

    if ($delete == true){
        $message['status'] = 'success';
        $message['msg'] = 'Thread deleted successfully';
    }else{
        $message['status'] = 'error';
        $message['msg'] = 'Error to delete Thread';
    }
    echo json_encode($message);
}

//----------------------delete button-----------------------
if (isset($_POST['button_delete_request']) && !empty($_POST['button_delete_request']) && $_POST['button_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $delete = mi_db_delete('buttons', 'id', array($id));

    if ($delete == true){
        $message['status'] = 'success';
        $message['msg'] = 'Button deleted successfully';
    }else{
        $message['status'] = 'error';
        $message['msg'] = 'Error to delete Button';
    }
    echo json_encode($message);
}



//----------------------delete fabric contrast-----------------------
if (isset($_POST['fabric_contrast_delete_request']) && !empty($_POST['fabric_contrast_delete_request']) && $_POST['fabric_contrast_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $delete = mi_db_delete('contrast_data', 'id', array($id));

    if ($delete == true){
        $message['status'] = 'success';
        $message['msg'] = 'Contrast deleted successfully';
    }else{
        $message['status'] = 'error';
        $message['msg'] = 'Error to delete Contrast';
    }
    echo json_encode($message);
}

//----------------------delete order-----------------------
if (isset($_POST['order_delete_request']) && !empty($_POST['order_delete_request']) && $_POST['order_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $delete = mi_db_delete('mi_orders', 'id', array($id));

    if ($delete == true){
        $message['status'] = 'success';
        $message['msg'] = 'Order deleted successfully';
    }else{
        $message['status'] = 'error';
        $message['msg'] = 'Error to delete Order';
    }
    echo json_encode($message);
}

//----------------------delete contact-----------------------
if (isset($_POST['contact_delete_request']) && !empty($_POST['contact_delete_request']) && $_POST['contact_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $delete = mi_db_delete('contact', 'id', array($id));

    if ($delete == true){
        $message['status'] = 'success';
        $message['msg'] = 'Contact deleted successfully';
    }else{
        $message['status'] = 'error';
        $message['msg'] = 'Error to delete Contact';
    }
    echo json_encode($message);
}






if (isset($_POST['backup_export']) && !empty($_POST['backup_export']) && $_POST['backup_export'] == 1){
    $name = 'MI_BACKUP';
    $extension = 'mi';
    $path = dirname(__FILE__).DIRECTORY_SEPARATOR.'backup/';

    $flag = false;
    if (is_dir($path)){
        $data = [];
        foreach (scandir($path) as $files){
            if (strlen($files) > 10){
                $data[] = $files;
            }
        }
        if (count($data)<5){
            $flag = true;
        }
    }

    if ($flag == true){
        $exported = mi_db_export($name, $extension, $path);
        if ($exported !== false){
            $msg = array('status'=>'success', 'msg'=>'Backup Created Successfully', 'file'=>$exported);
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to create backup');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>"Error to create more then 5 backups.");
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/backup.php');
}


if (isset($_POST['backup_delete_request']) && !empty($_POST['backup_delete_request']) && $_POST['backup_delete_request'] == 1){
    $path = dirname(__FILE__).DIRECTORY_SEPARATOR.'backup'.DIRECTORY_SEPARATOR.mi_secure_input($_POST['file']);
    if (file_exists($path)){

        if (unlink($path)){
            $msg = array('status'=>'success', 'msg'=>'Backup deleted successfully');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to delete backup');
        }

    }else{
        $msg = array('status'=>'error', 'msg'=>'File not exists');
    }

    echo json_encode($msg);
}


if (isset($_POST['backup_restore']) && !empty($_POST['backup_restore']) && $_POST['backup_restore'] == 1){
    $file = $_FILES['backup_file'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    if ($ext == 'mi'){
        $import = mi_db_import($file);
        if (in_array(0, $import)){
            $msg = array('status'=>'error', 'msg'=>'Error to import total data');
        }else{
            $msg = array('status'=>'success', 'msg'=>'Data imported successfully');
        }
    }else{
        $msg = array('status'=>'error', 'msg'=>'File not exists');
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/backup.php');
}


if (isset($_POST['change_paypal_info_submit']) && !empty($_POST['change_paypal_info_submit']) && $_POST['change_paypal_info_submit']){
    $cid = mi_secure_input($_POST['paypal_client_id']);
    $crnid = mi_secure_input($_POST['paypal_currency_id']);
    $client = mi_secure_input($_POST['paypal_client']);
    $currency = mi_secure_input($_POST['paypal_currency']);

    if(!isset($cid) || empty($cid) || !isset($client) || empty($client)){
        $msg = array('status'=>'error', 'msg'=>'Paypal client is required');
    }elseif(!isset($crnid) || empty($crnid) || !isset($currency) || empty($currency)){
        $msg = array('status'=>'error', 'msg'=>'Paypal currency is required');
    }else{
        $update1 = mi_db_update('settings', array('meta_value' => $client), array('id' => $cid));
        $update2 = mi_db_update('settings', array('meta_value' => $currency), array('id' => $crnid));
        if ($update1 == true && $update2 == true){
            $msg = array('status'=>'success', 'msg'=>'Paypal Info Updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update Paypal Info');
        }
    }
    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/settings.php');
}

//------------------------change order status-------------------------
if (isset($_POST['change_status_request']) && !empty($_POST['change_status_request']) && $_POST['change_status_request'] == 1){
    $id = mi_secure_input($_POST['id']);
    $status = mi_secure_input($_POST['status']);

    if($status == 5){
        $update = mi_db_update('mi_orders', array('order_status'=> $status, 'cancellation_reason'=> 'Cancelled by admin'), array('id'=> $id));
        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Order status updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update order status');
        }
    }else{
        $update = mi_db_update('mi_orders', array('order_status'=> $status, 'cancellation_reason'=> ''), array('id'=> $id));

        if ($update == true){
            $msg = array('status'=>'success', 'msg'=>'Order status updated');
        }else{
            $msg = array('status'=>'error', 'msg'=>'Error to update order status');
        }
    }


    echo json_encode($msg);
}

//------------------------Cancellation accept-------------------------
if (isset($_POST['cancellation_accept_request']) && !empty($_POST['cancellation_accept_request']) && $_POST['cancellation_accept_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $update = mi_db_update('mi_orders', array('order_status'=> 5), array('id'=> $id));

    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Cancellation request accepted');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to accept cancellation request');
    }

    echo json_encode($msg);
}

//------------------------Cancellation cancel-------------------------
if (isset($_POST['cancellation_cancel_request']) && !empty($_POST['cancellation_cancel_request']) && $_POST['cancellation_cancel_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    $update = mi_db_update('mi_orders', array('order_status'=> 1, 'cancellation_reason'=> ''), array('id'=> $id));

    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Cancellation request cancelled');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to cancel cancellation request');
    }

    echo json_encode($msg);
}

//------------------------change fabric type-------------------------
if (isset($_POST['change_fab_type_request']) && !empty($_POST['change_fab_type_request']) && $_POST['change_fab_type_request'] == 1){
    $id = mi_secure_input($_POST['id']);
    $type = mi_secure_input($_POST['type']);

    $update = mi_db_update('fabrics', array('type'=> $type), array('id'=> $id));

    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Fabric type changed');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to change fabric type');
    }


    echo json_encode($msg);
}

//------------------------change fabric weight-------------------------
if (isset($_POST['change_fab_weight_request']) && !empty($_POST['change_fab_weight_request']) && $_POST['change_fab_weight_request'] == 1){
    $id = mi_secure_input($_POST['id']);
    $weight = mi_secure_input($_POST['weight']);

    $update = mi_db_update('fabrics', array('weight'=> $weight), array('id'=> $id));

    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Fabric weight changed');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to change fabric weight');
    }


    echo json_encode($msg);
}

//------------------------change fabric pattern-------------------------
if (isset($_POST['change_fab_pattern_request']) && !empty($_POST['change_fab_pattern_request']) && $_POST['change_fab_pattern_request'] == 1){
    $id = mi_secure_input($_POST['id']);
    $pattern = mi_secure_input($_POST['pattern']);

    $update = mi_db_update('fabrics', array('pattern'=> $pattern), array('id'=> $id));

    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Fabric pattern changed');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to change fabric pattern');
    }


    echo json_encode($msg);
}

//------------------------change button type-------------------------
if (isset($_POST['change_button_type_request']) && !empty($_POST['change_button_type_request']) && $_POST['change_button_type_request'] == 1){
    $id = mi_secure_input($_POST['id']);
    $type = mi_secure_input($_POST['type']);

    $update = mi_db_update('buttons', array('type'=> $type), array('id'=> $id));

    if ($update == true){
        $msg = array('status'=>'success', 'msg'=>'Button type changed');
    }else{
        $msg = array('status'=>'error', 'msg'=>'Error to change button type');
    }


    echo json_encode($msg);
}



if (isset($_POST['save_fabrics_contrast'])){

    $contrast_fabric = mi_secure_input($_POST['contrast_fabric']);
    $contrast_status = mi_secure_input($_POST['fab_status']);
    $contrast_collar_out = $_FILES['con_colout'];
    $contrast_collar_in = $_FILES['con_colin'];
    $contrast_cuff_out = $_FILES['cuffs_out'];
    $contrast_cuff_in = $_FILES['cuffs_in'];
    $contrast_fastenin = $_FILES['fastening_inside'];

    if (empty($contrast_fabric)){
        $msg = array('status'=>'error', 'msg'=>'Please select a fabric');
    }elseif (count($contrast_collar_out['name']) < 1){
        $msg = array('status'=>'error', 'msg'=>'Coller out shapes are required');
    }elseif (count($contrast_collar_in['name']) < 1){
        $msg = array('status'=>'error', 'msg'=>'Coller in shapes are required');
    }elseif (count($contrast_cuff_out['name']) < 1){
        $msg = array('status'=>'error', 'msg'=>'Cuff out shapes are required');
    }elseif (count($contrast_cuff_in['name']) < 1){
        $msg = array('status'=>'error', 'msg'=>'Cuff in shapes are required');
    }elseif (empty($contrast_fastenin['name'])){
        $msg = array('status'=>'error', 'msg'=>'Fastening in is required');
    }else{
        $get_fabric = mi_db_read_by_id('fabrics', array('id'=>$contrast_fabric));
        if(count($get_fabric)>0){
            $check_fabric = mi_db_read_by_id('contrast_data', array('fab_id' => $contrast_fabric));
            if (count($check_fabric)>0){
                $msg = array('status'=>'error', 'msg'=>'Fabric already used in another contrast');
            }else{
                $folder_name = $contrast_fabric;
                if (file_exists('../uploads/contrast/'.$folder_name)){
                    $folder = $folder_name;
                }else{
                    $folder = $folder_name;
                    mkdir('../uploads/contrast/'.$folder_name);
                }

                $up_con_colout = [];
                foreach ($contrast_collar_out['name'] as $key => $colout){
                    $up_con_colout[] = array(
                        'id' => $key,
                        'url'=> str_replace('../', '', mi_uploader($colout[0], $contrast_collar_out['tmp_name'][$key][0], '../uploads/contrast/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                    );
                }

                $up_con_colin = [];
                foreach ($contrast_collar_in['name'] as $key => $colin){
                    $up_con_colin[] = array(
                        'id' => $key,
                        'url'=> str_replace('../', '', mi_uploader($colin[0], $contrast_collar_in['tmp_name'][$key][0], '../uploads/contrast/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                    );
                }

                $up_con_cufout = [];
                foreach ($contrast_cuff_out['name'] as $key => $cofout){
                    $up_con_cufout[] = array(
                        'id' => $key,
                        'url'=> str_replace('../', '', mi_uploader($cofout[0], $contrast_cuff_out['tmp_name'][$key][0], '../uploads/contrast/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                    );
                }

                $up_con_cufin = [];
                foreach ($contrast_cuff_in['name'] as $key => $cofin){
                    $up_con_cufin[] = array(
                        'id' => $key,
                        'url'=> str_replace('../', '', mi_uploader($cofin[0], $contrast_cuff_in['tmp_name'][$key][0], '../uploads/contrast/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')))
                    );
                }

                $data = array(
                    'fab_id' => $contrast_fabric,
                    'collar_out' => json_encode($up_con_colout),
                    'collar_in' => json_encode($up_con_colin),
                    'cuff_out' => json_encode($up_con_cufout),
                    'cuff_in' => json_encode($up_con_cufin),
                    'fastening_in' => str_replace('../', '', mi_uploader($contrast_fastenin['name'], $contrast_fastenin['tmp_name'], '../uploads/contrast/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'))),
                    'status' => ((isset($contrast_status) && !empty($contrast_status))?$contrast_status:1)
                );

                $update = mi_db_insert('contrast_data', $data);
                if ($update != true){
                    $msg = array('status'=>'error', 'msg'=>'Error to add fabric');
                }else{
                    $msg = array('status'=>'success', 'msg'=>'Successfully Added Contrast');
                }

            }
        }else{
            $msg = array('status'=>'error', 'msg'=>'Invalid fabric');
        }
    }

    mi_set_session('alert', $msg);
    mi_redirect(MI_BASE_URL.'admin/single-contrast.php');
}




function mi_update_single_image_db($existing, $new, $folder){
    foreach ($new['name'] as $key => $clout){
        if (!empty($clout[0])){
            $extkey = array_search($key, array_column($existing, 'id'));
            $upload = mi_uploader($clout[0], $new['tmp_name'][$key][0], '../uploads/contrast/'.$folder.'/', array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG'));
            if ($upload != false){
                unlink('../'.$existing[$extkey]['url']);
                $existing[$extkey]['url'] = str_replace('../', '', $upload);
            }
        }
    }
    return ((count($existing)>0)?$existing:false);
}


// add fabric 

if (isset($_POST['save_fabrics'])){
    $fab_id          = mi_secure_input($_POST['fab_id']);
    $fab_name        = mi_secure_input($_POST['fab_name']);
    $fab_tagline     = mi_secure_input($_POST['fab_tagline']);
    $fab_price       = mi_secure_input($_POST['fab_price']);
    $fab_description = mi_secure_input($_POST['fab_description']);
    $fab_category    = mi_secure_input($_POST['fab_category']);
    $fab_default     = mi_secure_input($_POST['fab_default']);
    $fab_status      = mi_secure_input($_POST['fab_status']);

  
    $fab_thumb       =$_FILES['fab_thumb'];
    $product_image   =$_FILES['product_image'];

    if (empty($fab_name)) {
         $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($fab_tagline)) {
       $msg = array('status'=>'error', 'msg'=>'Tagline is required');
    }elseif (empty($fab_price)) {
       $msg = array('status'=>'error', 'msg'=>'Price is required');
    }elseif (empty($fab_description)) {
        $msg = array('status'=>'error', 'msg'=>'Description is required');
    }elseif (empty($fab_thumb['name'])) {
        $msg = array('status'=>'error', 'msg'=>'Thumb is required');
    }elseif (empty($product_image['name'])) {
        $msg = array('status'=>'error', 'msg'=>'Product Image is required');
    }else{
       
        $up_fab_thumb = str_replace(
            '../',
            '',
            mi_uploader(
                $fab_thumb['name'],
                $fab_thumb['tmp_name'],
                '../uploads/fabrics/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
            )
        );

        $up_product_image = str_replace(
            '../',
            '',
            mi_uploader(
                $product_image['name'],
                $product_image['tmp_name'],
                '../uploads/fabrics/',
                array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
            )
        );

        $data = array(
            'title'       => $fab_name,
            'tag_ling'    => $fab_tagline,
            'price'       => $fab_price,
            'description' => $fab_description,
            'thumb'       => $up_fab_thumb,
            'pro_img'     => $up_product_image,
            'status'      => $status,
            'is_default'  => $fab_default,
            'category'    => $fab_category,
           
        );

        $insert = mi_db_insert('fabrics', $data);
        if ($insert != true){
            $msg = array('status'=>'error', 'msg'=>'Error to add fabric');
        }else{
            $msg = array('status'=>'success', 'msg'=>'Successfully Added Fabric');
        }

   }

       mi_set_session('alert', $msg);
       mi_redirect(MI_BASE_URL.'admin/add-fabric.php');
}

// end fabrics


if (isset($_POST['update_fabrics'])){
    $fab_id          = mi_secure_input($_POST['fab_id']);
    $fab_name        = mi_secure_input($_POST['fab_name']);
    $fab_tagline     = mi_secure_input($_POST['fab_tagline']);
    $fab_price       = mi_secure_input($_POST['fab_price']);
    $fab_description = mi_secure_input($_POST['fab_description']);
    $fab_category    = mi_secure_input($_POST['fab_category']);
    $fab_default     = mi_secure_input($_POST['fab_default']);
    $fab_status      = mi_secure_input($_POST['fab_status']);

  
    $fab_thumb       =$_FILES['fab_thumb'];
    $product_image   =$_FILES['product_image'];

    if (empty($fab_name)) {
         $msg = array('status'=>'error', 'msg'=>'Title is required');
    }elseif (empty($fab_tagline)) {
       $msg = array('status'=>'error', 'msg'=>'Tagline is required');
    }elseif (empty($fab_price)) {
       $msg = array('status'=>'error', 'msg'=>'Price is required');
    }elseif (empty($fab_description)) {
        $msg = array('status'=>'error', 'msg'=>'Description is required');
    }else{
        $cut = mi_db_read_by_id('fabrics', array('id' => $fab_id))[0];
        $cut_fab_thumb = '../'.$cut['thumb'];
        $cut_pro_img   = '../'.$cut['pro_img'];



        if (!empty($fab_thumb['name'])){

            $up_fab_thumb = str_replace(
                '../',
                '',
                mi_uploader(
                    $fab_thumb['name'],
                    $fab_thumb['tmp_name'],
                    '../uploads/fabrics/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                )
            );
           

            $data = array(
                'title'       => $fab_name,
                'tag_ling'    => $fab_tagline,
                'price'       => $fab_price,
                'description' => $fab_description,
                'thumb'       => $up_fab_thumb,
                'status'      => $status,
                'is_default'  => $fab_default,
                'category'    => $fab_category,
               
            );

             if ($up_fab_thumb != false){
                unlink($cut_fab_thumb);
            }
        }elseif (!empty($product_image['name'])){
            $up_product_image = str_replace(
                '../',
                '',
                mi_uploader(
                    $product_image['name'],
                    $product_image['tmp_name'],
                    '../uploads/fabrics/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                )
            );
            

            $data = array(
                'title'       => $fab_name,
                'tag_ling'    => $fab_tagline,
                'price'       => $fab_price,
                'description' => $fab_description,
                'pro_img'     => $up_product_image,
                'status'      => $status,
                'is_default'  => $fab_default,
                'category'    => $fab_category,
               
            );
            if ($up_product_image != false){
                unlink($cut_pro_img);
            }
        }elseif (!empty($fab_thumb['name']) && !empty($product_image['name'])) {
            $up_fab_thumb = str_replace(
                '../',
                '',
                mi_uploader(
                    $fab_thumb['name'],
                    $fab_thumb['tmp_name'],
                    '../uploads/fabrics/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                )
            );

            $up_product_image = str_replace(
                '../',
                '',
                mi_uploader(
                    $product_image['name'],
                    $product_image['tmp_name'],
                    '../uploads/fabrics/',
                    array('png', 'PNG', 'jpg', 'jpeg', 'JPG', 'gif', 'JPEG')
                )
            );

           


            $data = array(
                'title'       => $fab_name,
                'tag_ling'    => $fab_tagline,
                'price'       => $fab_price,
                'description' => $fab_description,
                'thumb'       => $up_fab_thumb,
                'pro_img'     => $up_product_image,
                'status'      => $status,
                'is_default'  => $fab_default,
                'category'    => $fab_category,
               
            );

             if ($up_fab_thumb != false){
                unlink($cut_fab_thumb);
            }

             if ($up_product_image != false){
                unlink($cut_pro_img);
            }
            
        }else{
            
            $data = array(
                'title'       => $fab_name,
                'tag_ling'    => $fab_tagline,
                'price'       => $fab_price,
                'description' => $fab_description,
                'status'      => $status,
                'is_default'  => $fab_default,
                'category'    => $fab_category,
               
            );

          
       }

       $update = mi_db_update('fabrics', $data, array('id'=>$fab_id));
       if($update == true){
           $msg = array('status'=>'success', 'msg'=>'Fabric Updated Successfully');
       }else{
           $msg = array('status'=>'error', 'msg'=>'Error to update fabric');
       }
   }

       mi_set_session('alert', $msg);
       mi_redirect(MI_BASE_URL.'admin/single-fabric.php?f='.base64_encode($_POST['fab_id']));
}


//----------------------delete fabric-----------------------
if (isset($_POST['fabric_delete_request']) && !empty($_POST['fabric_delete_request']) && $_POST['fabric_delete_request'] == 1){
    $id = mi_secure_input($_POST['id']);

    

    $fabric=mi_db_read_by_id('fabrics',array('id'=>$id))[0];
    $exit_thumb='../'.$fabric['thumb'];
    $exit_pro_img='../'.$fabric['pro_img'];

   

    if ($exit_thumb != false) {
        unlink($exit_thumb);
    }

    if ($exit_pro_img != false) {
        unlink($exit_pro_img);
    }

    $delete = mi_db_delete('fabrics', 'id', array($id));


    if ($delete == true){
        $message['status'] = 'success';
        $message['msg'] = 'Fabric deleted successfully';
    }else{
        $message['status'] = 'error';
        $message['msg'] = 'Error to delete Fabric';
    }
    echo json_encode($message);
}

















