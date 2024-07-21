<%@ control language="C#" autoeventwireup="true" inherits="Header, App_Web_tsa8q4dg" %>

<table border="0" cellpadding="5" cellspacing="2" height="25px" runat="server" id="tblLogin">
    <tr>
        <td width="200px" align="right" style="padding-right: 5px">
            <asp:Label ID="lblUserName" runat="server" CssClass="UserName" />
        </td>
        <td align="left" style="border-left: solid 1px #cccccc; padding-left: 5px">
            <asp:LinkButton ID="lnkChangPass" runat="server" CssClass="SignOut" OnClick="lnkChangPass_Click"
                CausesValidation="False">Đổi mật khẩu</asp:LinkButton>
        </td>        
        <td align="left" style="border-left: solid 1px #cccccc; padding-left: 5px">
            <asp:LinkButton ID="lnkSignOut" runat="server" CssClass="SignOut" OnClick="lnkSignOut_Click"
                CausesValidation="False">Thoát</asp:LinkButton>
        </td>
    </tr>
</table>

