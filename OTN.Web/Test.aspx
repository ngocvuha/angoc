<%@ page language="C#" autoeventwireup="true" inherits="Test, App_Web_dqshko-8" %>

<%@ Register assembly="DevExpress.Web.ASPxTreeList.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxTreeList" tagprefix="dxwtl" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>
<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
    <div>
    
        <dxe:ASPxButton ID="ASPxButton1" runat="server" onclick="ASPxButton1_Click" 
            Text="ASPxButton">
        </dxe:ASPxButton>
        <dxe:ASPxTextBox ID="txt2" runat="server" Width="170px">
        </dxe:ASPxTextBox>
    
        <br />
    
        <dxe:ASPxButton ID="ASPxButton2" runat="server" onclick="ASPxButton2_Click" 
            Text="Xoay Loai Cau Hoi" Width="137px">
        </dxe:ASPxButton>
    
        <br />
    
        <dxe:ASPxButton ID="btnConvert" runat="server" onclick="btnConvert_Click" 
            Text="Convert Font" Width="137px">
        </dxe:ASPxButton>
    
    </div>
    </form>
</body>
</html>
