<?php
/**
 * Created by PhpStorm.
 * User: Sujon
 * Date: 8/20/2019
 * Time: 5:33 PM
 */


function mi_order_complete_invoice_template($data){

    $shipping = json_decode($data['shipping_details'], true);
    $products = json_decode($data['products_details'], true);

    $template = '<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">	
</head>

<body class="clean-body" style="margin: 0 auto;padding: 25px;background-color: #ffffff;max-width: 1000px;border: 1px solid #e3e3e3;">
	<div class="ie-browser">
	    <div class="container">   
            <div class="row">
                <div class="mi_thank_you_invoice">
                    <div class="col-12 text-center mt-2" style="text-align: center;">
                        <img src="https://i.ibb.co/wRrvV66/ezgif-com-resize.gif" alt="Prothom Proneta" style="max-width: 300px;" class="m-auto">
                    </div>
                    <div class="col-12 text-center mt-4 mb-5" style="text-align: center;">
                        <img src="https://i.ibb.co/0yF9PYR/thank-you.png" alt="Prothom Proneta" style="max-width: 80%;" class="m-auto">
                        <p style="max-width: 80%;margin: 0 auto;font-size: 20px;">
                            Your Order was completed successfully.
                            An email receipt including the order details has been sent to your email address provided.
                            On the other way another SMS has been sent including the order ID to your phone number provided.
                            Please keep it for your record.
                        </p>
                    </div>
                    <hr>
                    <div class="col-12 mt-3 mb-3 pl-0">
                        <h3 style="font-size: 25px;border-bottom: 2px solid #e6ba30;padding-bottom: 6px;float: left;" class="float-left">Here is your Order Details</h3>
                    </div>
                    <div class="clearfix" style="clear: both;"></div>
                    <div class="row" style="width: 100%;">
                        <div class="col-sm-6 col-12 mb-5" style="width: 50%; text-align: left;float: left;">
                            <h4><strong>Order ID: </strong> '.$data['trx_id'].'</h4>
                            <p class="m-0"><strong>Order Date: </strong> '.date('M d, Y').'</p>
                            <p class="m-0"><strong>Order Time: </strong> '.date('H:i A').'</p>
                            <h4 class="m-0"><strong>Delivery Date: '.date('M d, Y', strtotime("+ 3 day")).'</strong></h4>
                        </div>

                        <div class="col-sm-6 col-12 mb-5 text-right" style="text-align: right;width: 50%;float: right">
                            <h4>Shipping Details</h4>
                            <p class="m-0">'.$shipping['uname'].' | '.$shipping['uphone'].'</p>
                            <p class="m-0">'.$shipping['uemail'].'</p>
                            <p class="m-0">'.$shipping['uaddress'].', '.$shipping['ucity'].', '.$shipping['udivision'].'</p>
                        </div>
                    </div>
                    <div class="clearfix" style="clear: both;"></div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-bordered" style="width: 100%;text-align: center;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #E3E3E3;padding: 10px 10px;">Product</th>
                                        <th style="border: 1px solid #E3E3E3;padding: 10px 10px;">Quantity</th>
                                        <th style="border: 1px solid #E3E3E3;padding: 10px 10px;">Sub total</th>
                                        <th style="border: 1px solid #E3E3E3;padding: 10px 10px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>';

                $get_total = [];
                foreach ($products as $pro){
                    $template .= '<tr>
                                        <td style="border: 1px solid #E3E3E3;padding: 10px 10px; text-align: left;">
                                            <a href="#" style="vertical-align: middle;"><img src="https://i.ibb.co/whn7XCp/Product.jpg" width="60px" height="60px;"></a>
                                            <a href="#" style="vertical-align: middle;">'.mi_db_read_by_id('mi_products', array('pro_id'=>$pro['pro_id']))[0]['pro_name'].'</a>
                                        </td>
                                        <td style="border: 1px solid #E3E3E3;padding: 10px 10px; text-align: center;">
                                            '.$pro['pro_qty'].'
                                        </td>
                                        <td style="border: 1px solid #E3E3E3;padding: 10px 10px; text-align: center;">
                                            <p class="m-0"><strong>Price: </strong>'.$pro['pro_price'].' Tk</p>';

                    if (!empty($pro['pro_color']) && !empty($pro['pro_size'])){
                        $color_price = mi_db_read_by_id('mi_product_variables', array('id'=>$pro['pro_color']))[0];
                        $size_price = mi_db_read_by_id('mi_product_variables', array('id'=>$pro['pro_size']))[0];

                        $template .= '<p class="m-0"><strong>Color: </strong> '.$color_price['vname'].' <small>(+'.$color_price['vprice'].' Tk)</small></p>
                                      <p class="m-0"><strong>Size: </strong> '.$size_price['vname'].' <small>(+'.$size_price['vprice'].' Tk)</small></p>';

                        $get_total[] = ($pro['pro_price']+$color_price['vprice']+$size_price['vprice'])*$pro['pro_qty'];
                        $single_total = $pro['pro_price']+$color_price['vprice']+$size_price['vprice'];
                    }elseif (!empty($pro['pro_color'])){
                        $color_price = mi_db_read_by_id('mi_product_variables', array('id'=>$pro['pro_color']))[0];

                        $template .= '<p class="m-0"><strong>Color: </strong> '.$color_price['vname'].' <small>(+'.$color_price['vprice'].' Tk)</small></p>';
                        $get_total[] = ($pro['pro_price']+$color_price['vprice'])*$pro['pro_qty'];
                        $single_total = $pro['pro_price']+$pro_col['price'];

                    }elseif (!empty($pro['pro_size'])){
                        $size_price = mi_db_read_by_id('mi_product_variables', array('id'=>$pro['pro_size']))[0];
                        $template .= '<p class="m-0"><strong>Size: </strong> '.$size_price['vname'].' <small>(+'.$size_price['vprice'].' Tk)</small></p>';
                        $get_total[] = ($pro['pro_price']+$size_price['vprice'])*$pro['pro_qty'];
                        $single_total = $pro['pro_price']+$size_price['vprice'];

                    }else{
                        $get_total[] = $pro['pro_price'];
                        $single_total = $pro['pro_price'];
                    }

                    $template .= '     </td>
                                        <td style="border: 1px solid #E3E3E3;padding: 10px 10px; text-align: center;">
                                            <strong>
                                                '.($single_total*$pro['pro_qty']).' Tk
                                            </strong>
                                        </td>
                                    </tr>';
                }

        $get_shipping_charge = mi_db_read_by_id('mi_user_city', array('id'=>$data['shipping_charge']))[0];
        $get_discount_coupon = mi_db_read_by_id('mi_coupon', array('id'=>$data['discount_coupon_id']));

        $template .=        '</tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="border: 1px solid #E3E3E3;padding: 10px 10px;text-align: right">Sub Total</th>
                                        <th style="border: 1px solid #E3E3E3;padding: 10px 10px; text-align: center;">'.array_sum($get_total).' Tk</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-right" style="border: 1px solid #E3E3E3;padding: 10px 10px;text-align: right">Shipping Charge</th>
                                        <th style="border: 1px solid #E3E3E3;padding: 10px 10px; text-align: center;">'.$get_shipping_charge['shipping_charge'].' Tk</th>
                                    </tr>';

        if (count($get_discount_coupon) > 0){
            $template .=            '<tr>
                                        <th colspan="3" class="text-right" style="border: 1px solid #E3E3E3;padding: 10px 10px;text-align: right">Coupon <small>('.$get_discount_coupon[0]['coupon_title'].' - '.$get_discount_coupon[0]['coupon_code'].')</small></th>
                                        <th style="border: 1px solid #E3E3E3;padding: 10px 10px; text-align: center;"> -'.(($get_discount_coupon[0]['coupon_type'] == 1)?$get_discount_coupon[0]['coupon_discount']." Tk":$get_discount_coupon[0]['coupon_discount']."%").'</th>
                                    </tr>';
        }


        $template .=                '<tr>
                                        <th colspan="3" style="text-align: right;border: 1px solid #E3E3E3;padding: 10px 10px;">
                                            <h3>Grand Total</h3>
                                        </th>
                                        <th style="border: 1px solid #E3E3E3;padding: 10px 10px;text-align: center;">
                                            <h3>'.$data['order_total_amount'].' Tk</h3>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <small>
                                <strong>Prothom Proneta Limited</strong> - Shah Ali Plaza, Level-7,
                                Suit-801,802,804,805,806,811,818, Mirpur-10, Dhaka-1216
                                <br><strong>support@prothomproneta.com | 09639-444-777</strong>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</body>
</html>';
    return $template;
}
