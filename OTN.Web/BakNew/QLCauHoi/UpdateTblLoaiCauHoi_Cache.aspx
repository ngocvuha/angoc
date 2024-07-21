<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="QLCauHoi_UpdateTblLoaiCauHoi_Cache, App_Web_x6nppie8" title="Untitled Page" %>

<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <table width="100%">
        <tr>
            <td align="center" style="height: 199px">
                <br />
                <dxe:ASPxLabel ID="lblThongBao" runat="server" Font-Bold="True" 
                    ForeColor="#3333FF">
                </dxe:ASPxLabel>
                <br />
                <br />
                <dxe:ASPxButton ID="btnUpdate" runat="server" onclick="btnUpdate_Click" 
                Text="Update tblLoaiCauHoi_Cache" Height="48px" HorizontalAlign="Center" 
                Width="292px">
                </dxe:ASPxButton>
            </td>
        </tr>
    </table>
    

</asp:Content>

