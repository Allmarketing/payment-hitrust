<?php
require_once "returncode/hitrust.php";
class Model_Order_Payment_Hitrust {
    //put your code here
    protected $config;
    protected $code;
    protected $mode;
    protected $codedata = array();
    protected $url = array(
        'testing' => "https://testtrustlink.hitrust.com.tw/TrustLink/TrxReqForJava",
        'running' => "https://testtrustlink.hitrust.com.tw/TrustLink/TrxReqForJava",
    );
    protected $template = "templates/ws-cart-card-transmit-tpl.html";
    function __construct($config) {
        $this->config = $config;
        $this->mode = $config['exe_mode'];
        $this->codedata = array_merge($this->codedata,$this->config['params']);
    }
    //結帳
    function checkout($o_id,$total_price,$extra_info=array()){
        $this->codedata['ordernumber'] = strtoupper($o_id);
        $this->codedata['amount'] = $this->chgAmount($total_price);
        if(!empty($extra_info)){
            foreach($extra_info as $k => $v){
                $this->codedata[$k] = $v;
//                if(!isset($this->codedata[$k])){
//                    $this->codedata[$k] = $v;
//                }
            }
        }
        $tpl = new TemplatePower($this->template);
        $tpl->prepare();
        foreach($this->codedata as $k => $v){
            $tpl->newBlock("CARD_FIELD_LIST");
            $tpl->assign(array(
                "TAG_KEY"   => $k,
                "TAG_VALUE" => $v,
            ));
        }
//        $code = $this->make_code($this->codedata);
//        $tpl->assignGlobal("TAG_INPUT_STR",$code[0]);
//        $tpl->newBlock("CARD_FIELD_LIST");
//        $tpl->assign(array(
//            "TAG_KEY"   => 'checksum',
//            "TAG_VALUE" => $code[1]
//        ));
        $tpl->assignGlobal("AUTHORIZED_URL",$this->url[$this->mode]);
        $tpl->printToScreen();
        die();
    }

    //更新訂單
    function update_order(Dbtable_Abstract $dbtable,$result){
        $orderData = App::getHelper('dbtable')->order->getData($result['ordernumber'],'o_id,o_status')->getDataRow();
        $hitrustInfo = array_merge($result,array('o_id'=>$orderData['o_id']));
        if($result['retcode']=='00'){ //交易成功
            $orderData['o_status']='1';
            }else{
            //更新訂單狀態
            if($result['retcode']!='-308'){ //錯誤原因非訂單編號重複
                $orderData['o_status']='21';
            }
        }
        //這裡請使用dbtable寫
        //$dbtable->writeDataWithHitrust($orderData,$hitrustInfo);
    }
    
    //送出金額*100
    function chgAmount($amount){
        return $amount * 100;
    }
    
    //接收金額/100
    function rstAmount($amount){
        return $amount / 100;
    }
    
    
}
