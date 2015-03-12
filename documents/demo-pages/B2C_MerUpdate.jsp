<%@ page contentType="text/html;charset=BIG5"%>
<%String retcode=request.getParameter("retcode");
  String OrderNum=request.getParameter("ordernumber");
  String str="";
  
  str="ordernumber=" + OrderNum + "&retcode=" + retcode;
   
%>

<html>
<head>
<title> DEMO MERUPDATE PAGE</title>
</head>
<body>
  <%=str%>
</body>
</html>