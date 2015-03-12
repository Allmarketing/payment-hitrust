<%

 OrderNum = Request( "ordernumber" )
 RetCode  = Request( "retcode" )
 
'Please do'nt remove under code or your returnURL will hend up. 
Response.write("ordernumber=" + OrderNum + "&retcode=" + retcode )
    
%>
       