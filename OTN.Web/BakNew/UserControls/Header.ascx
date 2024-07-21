<%@ control language="C#" autoeventwireup="true" inherits="Header, App_Web_r6_jm9lo" %>
<%@ Register assembly="DevExpress.Web.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxMenu" tagprefix="dxm" %>
<%@ Register assembly="DevExpress.Web.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHeadline" tagprefix="dxhl" %>
<table border="0" cellpadding="0" cellspacing="0" width="100%" heigth="100%" 
    style="border-collapse:collapse; border-top: solid 1px #cacaca; border-bottom: solid 1px #cacaca;">
    <tr>
        <td valign="top" align="left">
            <dxm:ASPxMenu ID="mainMenu" runat="server">
                <Items>
                    <dxm:MenuItem Name="TrangChu" NavigateUrl="~/Default.aspx" Text="Trang chủ">
                    </dxm:MenuItem>
                    <dxm:MenuItem Text="Danh mục loại câu hỏi" BeginGroup="True" 
                        Name="DMLoaiCauHoi" NavigateUrl="~/QLCauHoi/LoaiCauHoi.aspx">
                    </dxm:MenuItem>
                    <dxm:MenuItem BeginGroup="True" Name="QLCauHoi" Text="Quản lý câu hỏi" 
                        NavigateUrl="~/QLCauHoi/QLCauHoi.aspx">
                    </dxm:MenuItem>
<dxm:MenuItem BeginGroup="True" Name="QLCauTrucDeThi" Text="Quản lý cấu trúc đề thi" 
                        NavigateUrl="~/QLCauHoi/QLCauTrucDeThi.aspx">
</dxm:MenuItem>
                    <dxm:MenuItem Text="Điều khiển cuộc thi" NavigateUrl="~/QLThi/DieuHanhThi.aspx">
                    </dxm:MenuItem>
                    <dxm:MenuItem BeginGroup="True" Text="Trợ giúp">
                    </dxm:MenuItem>
                </Items>
                <Border BorderWidth="0px" />
            </dxm:ASPxMenu>
        </td>
    </tr>
</table>
