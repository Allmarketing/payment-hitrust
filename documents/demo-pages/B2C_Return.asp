<%
'Demo code for returnURL

 RetCode  = Request.QueryString( "retcode" )
 
if RetCode = "00" Then
   Response.write("������\�I" )
else
   Response.write("������ѡI" ) 
End if   
%>
       