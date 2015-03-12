<?php
require_once "TP/class.TemplatePower.inc.php";
require_once "class/model/order/payment/hitrust.php"; 
require_once "conf/config.inc.php";
require_once "conf/creditcard.php";
require_once "conf/database.php";
include_once("libs/libs-mysql.php");
$db = new DB($cms_cfg['db_host'],$cms_cfg['db_user'],$cms_cfg['db_password'],$cms_cfg['db_name'],$cms_cfg['tb_prefix']);
$tpl = new TemplatePower("test3.html");
$tpl->prepare();
$card = new Model_Order_Payment_Hitrust($cms_cfg['creditcard']);
//$sql = $card->update_order($db,$_POST);
$tpl->gotoBlock("_ROOT");
//$tpl->assign("UPDATE_ORDER_SQL",$sql);
foreach($_GET as $k=>$v){
    $tpl->assign("MSG_".$k,$v);
    if($k=="retcode"){
        $tpl->assign("MSG_".$k."_STR",  Model_Order_Payment_Returncode_Hitrust::$retcode[$v]);
    }
}
ob_start();
print_r($_GET);
file_put_contents("tmp/returnData0.txt", ob_get_clean());
$tpl->printToScreen();


