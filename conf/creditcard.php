<?php
$cms_cfg['creditcard']['params']['storeid'] = "";   //商家代碼
$cms_cfg['creditcard']['params']['Type'] = "Auth";   //交易類別
$cms_cfg['creditcard']['params']['currency'] = "TWD";   //交易幣別: CNY(人民幣) TWD(台幣) HKD(港幣) USD(美金) AUD(澳幣)
$cms_cfg['creditcard']['params']['orderdesc'] = "";    //訂單說明，長度40字元
$cms_cfg['creditcard']['params']['depositflag'] = "1";    //請款 ‘1’: Sale 交易: 自動請款  ‘0’: 一般交易: 手動請款
$cms_cfg['creditcard']['params']['queryflag'] = "1";    //啟動查詢，設為1時，會將交易詳細資料以post方式傳給 merupdateURL，設為0只傳一般資料
$cms_cfg['creditcard']['params']['returnURL'] = "";     //指定接續網址，交易完成後，用以顯示交易結果之頁面，由商家提供
$cms_cfg['creditcard']['params']['merUpdateURL'] = "";      //交易結果網址，授權完成後，用以接收回傳結果之頁面，由商家提供
//$cms_cfg['creditcard']['params']['e03'] = "";  //分期期數
$cms_cfg['creditcard']['exe_mode'] = "testing";  //執行模式: testing or running
?>