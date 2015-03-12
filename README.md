payment-hitrust
============

網際威信信用卡串接


前置設定
---------------
1.設定conf/creditcard.php裡的 $cms_cfg['creditcard']['params']['storeid'] (特店編號)。<br/>
2.設定conf/creditcard.php第8行的$cms_cfg['creditcard']['params']['returnURL']、$cms_cfg['creditcard']['params']['merUpdateURL']，改為測試環境接收授權結果的url<br/>
3.設定conf/creditcard.php第11行的$cms_cfg['exe_mode']，設為testing(測試)或running(正式)，主要影響到會使用哪一個串接網址。<br/>
4.依實際環境修改documents/fields_for_order.sql，為訂單資料表加上授權寫入的相關欄位<br/>


測試流程
---------------
1.執行card-test1.php，輸入訂單號碼及訂單價格、國旅卡選項及訂單說明.<br/>
2.前述訂單號碼及訂單價格由card-test2.php接收後，依documents/信用卡WI使用手冊(v2.0.1).pdf第9頁的「授權」主題的參數說明，以post方式傳給網際威信伺服器.<br/>
3.之後會進入線上刷頁頁面，測試卡號應為另外提供<br/>
4.授權成功後，金流端會先將頁面導至$cms_cfg['creditcard']['params']['returnURL'] (使用GET)，這是提供給消費者瀏覽訂單結果的頁面。
> 金流端另外會傳送授權結果到$cms_cfg['creditcard']['params']['merUpdateURL'] (使用POST)，若$cms_cfg['creditcard']['params']['queryflag']設為1，則傳的訊息會比較詳細。
5.$cms_cfg['creditcard']['params']['merUpdateURL']最後需回應 R01=00 ，以利金流端確認接收正常。


api說明
---------------

### Model_Order_Payment_Hitrust::__construct($config)

    1.$config: 即conf/credictcard.php裡的$cms_cfg['creditcard'].


### Model_Order_Payment_Hitrust::checkout($o_id,$total_price,$extra_info=array())

    1.$o_id:訂單號碼.
    2.$total_price:訂單價格，傳給網際威信的金額需以原金額再乘以100，因為會留兩位小數，所以回傳的價格也需除以100，已有內建兩個方法處理。
    3.$extra_info:額外的欄位，預設是空陣列，也就是不加新欄位，如果要加新欄位，請以關聯式陣列輸入，例如: array('email'=>'xxxx@some.domain','tel'=>'88881888').


### Model_Order_Payment_Hitrust::update_order($db,$result)

    1.$db: 即libs/libs-mysql.php類別的實體物件。請使用本專案的libs/libs-mysql.php，因為有使用到新增的prefix().
    2.$result: 即網際威信伺服器回傳的結果，即$_POST.
> 說明:測試流程是以此方法傳回更新訂單的sql。實際上因為已傳入$db，所以可以直接在方法裡面直接執行查詢.<br/>
> 　　 除了訂單編號重複的錯誤之外(retcode=-308)，無論授權成功或失敗都留有更新訂單的敘述.<br/>
>     增加更新訂單後傳回該筆訂單記錄的敘述。正式套用時可解除註解。

### Model_Order_Payment_Hitrust::chgAmount($amount)
    1.$amount: 原始價格，乘以100後傳回


### Model_Order_Payment_Hitrust::rstAmount($amount)
    1.$amount: 金流端傳回價格，除以100後傳回