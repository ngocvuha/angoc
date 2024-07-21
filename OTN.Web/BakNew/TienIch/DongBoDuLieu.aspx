<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="DongBoDuLieu, App_Web_45ii4lku" title="Untitled Page" enablesessionstate="True" trace="false" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2.Export, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView.Export" tagprefix="dxwgv" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">
        <div style="float:left"> Đồng bộ dữ liệu
        </div>
                                
    </div>
    <div>
    <div>
        <table style="width: 100%">
            <tr>
                <td style="width: 240px">
                    &nbsp;</td>
                <td colspan="2">
                    <b>THÔNG TIN CSDL CẦN ĐỒNG BỘ</b></td>
                <td>
                    &nbsp;</td>
            </tr>
            <tr>
                <td style="width: 240px">
                    &nbsp;</td>
                <td style="width: 172px">
                    Tên máy chủ SQLServer</td>
                <td>
            <dxe:ASPxTextBox ID="txtTenMayChu" runat="server" Width="270px" ForeColor="#6600FF" >
            </dxe:ASPxTextBox>
        
                </td>
                <td>
                    &nbsp;</td>
            </tr>
            <tr>
                <td style="width: 240px">
                    &nbsp;</td>
                <td style="width: 172px">
                    Tên CSDL</td>
                <td>
            <dxe:ASPxTextBox ID="txtTenCSDL" runat="server" Width="270px" ForeColor="#6600FF">
            </dxe:ASPxTextBox>
        
                </td>
                <td>
                    &nbsp;</td>
            </tr>
            <tr>
                <td style="width: 240px">
                    &nbsp;</td>
                <td style="width: 172px">
                    Tên đăng nhập</td>
                <td>
            <dxe:ASPxTextBox ID="txtTenDangNhap" runat="server" Width="270px" ForeColor="#6600FF">
            </dxe:ASPxTextBox>
        
                </td>
                <td>
                    &nbsp;</td>
            </tr>
            <tr>
                <td style="height: 19px; width: 240px">
                </td>
                <td style="width: 172px; height: 19px">
                    Mật khẩu</td>
                <td style="height: 19px">
            <dxe:ASPxTextBox ID="txtMatKhau" runat="server" Width="270px" ForeColor="#6600FF" 
                        Password="True">
            </dxe:ASPxTextBox>
        
                </td>
                <td style="height: 19px">
                </td>
            </tr>
            <tr>
                <td style="width: 240px">
                    &nbsp;</td>
                <td colspan="2">
        <div style="float:left; width:100px">
            <dxe:ASPxButton ID="btnChapNhan" CssClass="Button" runat="server" Text="Chấp nhận" 
                                    onclick="btnChapNhan_Click" Visible="True" Width="90px" 
                HorizontalAlign="Center" Height="15px" >
            </dxe:ASPxButton>
        </div>
                                <dxe:ASPxButton ID="btnThoat" CssClass="Button" runat="server" Text="Thoát" 
                                    onclick="btnThoat_Click" Visible="False" />
                </td>
                <td>
                    &nbsp;</td>
            </tr>
            <tr>
                <td style="width: 240px">
                    &nbsp;</td>
                <td colspan="2">
                    <dxe:ASPxLabel ID="lbThongBao" runat="server" ForeColor="Red">
                    </dxe:ASPxLabel>
                </td>
                <td>
                    &nbsp;</td>
            </tr>
        </table>
    </div>
        
 </div>
 
    </asp:Content>

