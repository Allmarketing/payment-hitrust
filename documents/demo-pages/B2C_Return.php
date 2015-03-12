<?
	if ($retcode !="00"){
	  echo "交易失敗!!";
	  echo "<br>";
	  echo "訂單編號 : [".$ordernumber. "]";
	  echo "<br>";
	  echo "回傳代碼 : [" . $retcode . "]";
	}else{
	  
	  echo "交易成功!!";
	}

?>
