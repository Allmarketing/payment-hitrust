<?php
require_once "TP/class.TemplatePower.inc.php";
require_once "class/model/order/payment/hitrust.php"; 
require_once "conf/creditcard.php";
if($_POST){
    $card = new Model_Order_Payment_Hitrust($cms_cfg['creditcard']);
    $extra_info = array();
    if($_POST['use_ctravel']){
        $extra_info['e12']=$_POST['ctravel_startdate'];
        $extra_info['e13']=$_POST['ctravel_enddate'];
        $extra_info['e11']=$_POST['ctravel_zipcode'];
        $extra_info['e14']=$_POST['tw_id'];
    }
    $extra_info['orderdesc']=  mb_convert_encoding($_POST['orderdesc'], 'big5', 'utf-8');
    $card->checkout($_POST['orderid'], $_POST['price'],$extra_info);
}

