<%@ page contentType="text/html;charset=BIG5"%>
<%String message=request.getParameter("retcode");
  String str="";
  if(message.equals("00"))
    str="������\";
  else
    str="�������";    
%>
<html>
<head>
<title> DEMO RETURN PAGE</title>
</head>
<body>
  <%=str%>
</body>
</html>