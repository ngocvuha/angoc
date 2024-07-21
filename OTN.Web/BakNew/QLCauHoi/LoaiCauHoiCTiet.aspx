<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="LoaiCauHoiCTiet, App_Web_x6nppie8" title="Untitled Page" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">
         Chi tiết loại câu hỏi
    </div><br />
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom:15px;"
        width="100%" align="center">
        <tr>
            <td with="100%" align="center">
                <table border="0" cellpadding="2" cellspacing="2" 
                    style="border-collapse: collapse; border: solid 1px #cacaca; width: 845px;">
                    <tr>
                        <td align="right" style="height: 37px; width: 201px;">Loại câu hỏi cha</td>
                        <td align="left" style="width: 566px; height: 37px">
                            <dxe:ASPxComboBox ID="cboLoaiCauHoiCha" runat="server" Width="700px">
                            </dxe:ASPxComboBox>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" style="width: 201px">Tên</td>
                        <td align="left" style="width: 566px">
                            <dxe:ASPxTextBox ID="txtTen" runat="server" Width="700px" />
                        </td>
                    </tr>                  
                    <tr>
                        <td align="right" style="width: 201px">Nội dung</td>
                        <td align="left" style="width: 566px">
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungCauHoi" runat="server" Height="200px" 
                                Width="700px" Html="">
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                            </dxhe:ASPxHtmlEditor>
                        </td>
                    </tr>  
                    <tr>
                        <td align="right" style="width: 201px">Ghi chú</td>
                        <td align="left" style="width: 566px">
                            <dxe:ASPxMemo ID="txtGhiChu" runat="server" Width="700px" Height="50px" />
                        </td>
                    </tr>  
                    <tr>
                        <td align="right" style="width: 201px">&nbsp;</td>
                        <td align="left" style="width: 566px">
                            &nbsp;</td>
                    </tr>                      
                    <tr>
                        <td style="width: 201px">
                            <asp:HiddenField ID="txtId" runat="server" />
                        </td>
                        <td align="left" style="width: 566px">
                            <div style="float:left; margin-right: 10px; width: 90px;">
                                <dxe:ASPxButton ID="btnCapNhat" CssClass="Button" runat="server" 
                                    Text="Cập nhật" onclick="btnCapNhat_Click" HorizontalAlign="Left" 
                                    Width="95px" >
                                    <Image Url="~/images/accept.png" />
                                </dxe:ASPxButton>
                            </div>                   
                            <div style="float:left;">                 
                                <dxe:ASPxButton ID="btnThoat" CssClass="Button" runat="server" Text="Thoát" 
                                    onclick="btnThoat_Click" HorizontalAlign="Left" >
                                    <Image Url="~/images/exit.png" />
                                </dxe:ASPxButton>
                            </div>                   
                        </td>
                    </tr>                                                                                                                 
                    <tr>
                        <td style="width: 201px">
                            &nbsp;</td>
                        <td align="left" style="width: 566px">
                            <asp:HiddenField ID="txtIdLoaiCha" runat="server" />
                        </td>
                    </tr>                                                                                                                 
                </table>
            </td>
        </tr>
    </table>
</asp:Content>

