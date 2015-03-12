<%
'Demo code for returnURL

 RetCode  = Request.QueryString( "retcode" )
 
if RetCode = "00" Then
   Response.write("交易成功！" )
else
   Response.write("交易失敗！" ) 
End if   
%>
       