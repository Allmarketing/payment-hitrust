<?php
require_once "TP/class.TemplatePower.inc.php";
require_once "class/model/order/payment/hitrust.php"; 
require_once "conf/config.inc.php";
require_once "conf/creditcard.php";
require_once "conf/database.php";
include_once("libs/libs-mysql.php");
$db = new DB($cms_cfg['db_host'],$cms_cfg['db_user'],$cms_cfg['db_password'],$cms_cfg['db_name'],$cms_cfg['tb_prefix']);
$card = new Model_Order_Payment_Hitrust($cms_cfg['creditcard']);
//$sql = $card->update_order($db,$_POST);
ob_start();
//echo "sql:===============\n";
//echo $sql."\n";
echo "\$_GET:===============\n";
print_r($_GET);
echo "\n";
echo "\$_POST:===============\n";
print_r($_POST);
$ob_content = ob_get_clean();
file_put_contents("tmp/returnData.txt", $ob_content);
echo "R01=00";
