<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="Login, App_Web_v5qieqy-" title="Đăng nhập hệ thống" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="1000px">
        <tr>
            <td height="5">
            </td>
        </tr>
        <tr>
            <td height="5" style="height: 200px" align="center">
                <table border="0" cellpadding="2" cellspacing="2" style="width: 420px; border: solid 1px #cccccc; background-color:#efefef">
                    <tr>
                        <td style="height: 40px;" colspan="3" align="center"><b>Đăng nhập hệ thống</b></td>
                    </tr>
                    <tr>
                        <td align="left" style="width: 100px">&nbsp;Tên truy cập</td>
                        <td style="width: 100px">
                            <asp:TextBox ID="txtUserName" runat="server" CssClass="TextBox" Width="250px"></asp:TextBox>
                        </td>
                        <td align="left">
<%--                            <asp:RequiredFieldValidator ID="RequiredFieldValidator1" runat="server" ControlToValidate="txtUserName"
                                CssClass="ErrorText" ErrorMessage="RequiredFieldValidator">*</asp:RequiredFieldValidator>
--%>                        </td>
                    </tr>
                    <tr>
                        <td align="left">&nbsp;Mật khẩu</td>
                        <td>
                            <asp:TextBox ID="txtPassword" runat="server" CssClass="TextBox" Width="250px" TextMode="Password"></asp:TextBox>
                        </td>
                        <td align="left" style="font: bold">
<%--                            <asp:RequiredFieldValidator ID="RequiredFieldValidator2" runat="server" ControlToValidate="txtPassword"
                                CssClass="ErrorText" ErrorMessage="RequiredFieldValidator">*</asp:RequiredFieldValidator>
--%>                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="left">
                            <asp:Button ID="btnLogIn" runat="server" CssClass="Button" Text="Đăng nhập" OnClick="btnLogIn_Click" />
                            <asp:Button ID="btnReset" runat="server" CssClass="Button" Text="Nhập lại" OnClick="btnReset_Click" />
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="height: 2px;" colspan="3" align="left">
                        </td>
                    </tr>                    
                </table>
            </td>
        </tr>
        <tr>
            <td height="5" align="center">
                <asp:Label ID="lblMessage" runat="server" CssClass="ErrorText"></asp:Label>
            </td>
        </tr>
    </table>
</asp:Content>

