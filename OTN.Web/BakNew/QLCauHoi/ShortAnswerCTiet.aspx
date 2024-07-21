<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="ShortAnswerCTiet, App_Web_x6nppie8" title="Untitled Page" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">        
            Cập nhật trả lời ngắn
    </div><br />
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom:15px;"
        width="100%" align="center">
        <tr>
            <td with="100%" align="center">
                <table style="width: 100%">
                    <tr>
                        <td style="text-align: left; width: 106px">
                            Loại câu hỏi</td>
                        <td style="text-align: left; width: 657px">
                            <dxe:ASPxComboBox ID="cboLoaiCauHoi" runat="server" Width="700px">
                            </dxe:ASPxComboBox>
                        </td>
                        <td style="text-align: left">
                            &nbsp;</td>
                        <td style="text-align: left">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 106px">
                            Thuộc câu hỏi
                        </td>
                        <td style="text-align: left; width: 657px">
                            <dxe:ASPxComboBox ID="cboThuocCauHoi" runat="server" Width="700px" 
                                ValueType="System.String">
                            </dxe:ASPxComboBox>
                        </td>
                        <td style="text-align: left">
                            &nbsp;</td>
                        <td style="text-align: left">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 106px">
                            Tên</td>
                        <td style="text-align: left; width: 657px">
                            <dxe:ASPxTextBox ID="txtTen" runat="server" Width="700px" />
                        </td>
                        <td style="text-align: left">
                            &nbsp;</td>
                        <td style="text-align: left">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 106px">
                            Media</td>
                        <td style="text-align: left; width: 757px" colspan="2">
                            <div style="float:left">
                            <asp:FileUpload ID="UploadFile" runat="server" Height="22px" Width="550px" />
                            </div>
                            <div style="float:left">
                                <dxe:ASPxButton ID="btnInsertMedia" CssClass="Button" runat="server" 
                                    Text="Chèn Media" onclick="btnInsertMedia_Click" HorizontalAlign="Left" 
                                    Width="108px">
                                    <Image Url="~/images/media.jpg" />
                                </dxe:ASPxButton>
                            </div>
                        </td>
                        <td style="text-align: left">
                            &nbsp;</td>
                        <td style="text-align: left">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 106px">
                            Nội dung</td>
                        <td style="text-align: left; width: 657px">
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungCauHoi" runat="server" Height="200px"
                                Width="700px" ClientInstanceName="htmlNoiDung">
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                                <ClientSideEvents HtmlChanged="function(s, e) {
	                            getQuestionView()
	                            }" />
                            </dxhe:ASPxHtmlEditor>
                        </td>
                        <td style="text-align: left">
                            &nbsp;</td>
                        <td style="text-align: left">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 106px">
                            Điểm&nbsp;</td>
                        <td style="text-align: left; width: 657px">
                            <dxe:ASPxTextBox ID="txtDiem" runat="server" HorizontalAlign="Right" 
                                Width="42px" />
                        </td>
                        <td style="text-align: left">
                            &nbsp;</td>
                        <td style="text-align: left">
                            &nbsp;</td>
                    </tr>
                    
                    <tr>
                        <td style="text-align: left; width: 106px">
                            Ghi chú</td>
                        <td style="text-align: left; width: 657px">
                            <dxe:ASPxMemo ID="txtGhiChu" runat="server" Width="700px" Height="36px" />
                        </td>
                        <td style="text-align: left">
                            &nbsp;</td>
                        <td style="text-align: left">
                            &nbsp;</td>
                    </tr>
                    
                    <tr>
                        <td style="text-align: left; width: 106px">
                            Đáp án</td>
                        <td style="text-align: left; width: 657px">
                            <dxe:ASPxMemo ID="txtDapAn" runat="server" Width="700px" Height="36px" />
                        </td>
                        <td style="text-align: left">
                            &nbsp;</td>
                        <td style="text-align: left">
                            &nbsp;</td>
                    </tr>
                    
                    </table>
            </td>
        </tr>
        <tr>
            <td with="100%" align="center">
                
                
                
                <table style="width: 100%">
                    <tr>
                        <td style="width: 47px">
                            &nbsp;</td>
                        <td>
                            &nbsp;</td>
                        <td>
                            <b></b></td>
                        <td>
                            &nbsp;</td>
                        <td>
                            &nbsp;</td>
                    </tr>
                </table>
                
                
                
            </td>
        </tr>
        <tr>
            <td with="100%" align="center" style="text-align: left">
                <table style="width: 100%">
                    <tr>
                        <td>
                                
                            <asp:HiddenField ID="hdId" runat="server" />
                                
                            <asp:HiddenField ID="hdIdTraLoi" runat="server" />
                                
                            </td>
                        <td>
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
                        <td>
                            &nbsp;</td>
                        <td>
                            &nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        </table>

</asp:Content>

