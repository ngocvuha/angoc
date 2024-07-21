<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="MultiChoiceCTiet, App_Web_nvbb4npw" title="Untitled Page" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
<script type="text/javascript">
    function checkMultiAnswer() {
        chk = chkMultiAnswer.GetChecked();
        optPA1.SetVisible(!chk);
        chkPA1.SetVisible(chk);
        optPA2.SetVisible(!chk);
        chkPA2.SetVisible(chk);
        optPA3.SetVisible(!chk);
        chkPA3.SetVisible(chk);
        optPA4.SetVisible(!chk);
        chkPA4.SetVisible(chk);
        optPA5.SetVisible(!chk);
        chkPA5.SetVisible(chk);
        optPA6.SetVisible(!chk);
        chkPA6.SetVisible(chk);
    }
</script>    
    <div class="HeaderTitles">
    Cập nhật câu hỏi trắc nghiệm
    </div><br />
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom:15px;"
        width="100%" align="center">
        <tr>
            <td with="100%" align="center">
                <table style="width: 100%">
                    <tr>
                        <td style="text-align: left; width: 106px">
                            Loại câu hỏi</td>
                        <td style="text-align: left; width: 657px" colspan="2">
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
                        <td style="text-align: left; width: 657px" colspan="2">
                            <dxe:ASPxComboBox ID="cboThuocCauHoi" runat="server" Width="700px">
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
                        <td style="text-align: left; width: 657px" colspan="2">
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
                        <td style="text-align: left; width: 657px" colspan="2">
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungCauHoi" runat="server" Height="200px" 
                                Width="700px">
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" AllowFormElements="True" 
                                    AllowScripts="True" UpdateDeprecatedElements="False" />
                            </dxhe:ASPxHtmlEditor>
                        </td>
                        <td style="text-align: left">
                            &nbsp;</td>
                        <td style="text-align: left">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 106px; ">
                            Điểm&nbsp;</td>
                        <td align="left" width="80px">
                            <dxe:ASPxTextBox ID="txtDiem" runat="server" HorizontalAlign="Right" 
                                Width="42px" ClientInstanceName="txtDiem" />
                        </td>
                        <td style="text-align: left; width: 657px; " valign="top">
                            <dxe:ASPxCheckBox ID="chkMultiAnswer" runat="server" 
                                ClientInstanceName="chkMultiAnswer" Text="Multi Answer">
                                <ClientSideEvents CheckedChanged="function(s, e) {
	checkMultiAnswer();	
}" />
                            </dxe:ASPxCheckBox>
                        </td>
                        <td style="text-align: left; ">
                            </td>
                        <td style="text-align: left; ">
                            </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 106px">
                            Ghi chú</td>
                        <td style="text-align: left; width: 657px" colspan="2">
                            <dxe:ASPxMemo ID="txtGhiChu" runat="server" Width="700px" Height="36px" />
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
                        <td style="text-align: left; " valign="Top" class="HeaderTitles" colspan="2">
                           <div style="float:left"> Các phương án trả lời&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;  </div>
                            <dxe:ASPxCheckBox ID="chkDaoPhuongAn" runat="server" 
                                Text="Cho phép đảo phương án" Checked="True">
                            </dxe:ASPxCheckBox>
                        </td>
                        <td style="text-align: left" valign="Top">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 79px" valign="Top">
                            a)<asp:HiddenField ID="hdId1" runat="server" />
                                
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                            <div style="float:left">
                            <dxe:ASPxRadioButton ID="optPA1" runat="server" Text=" " GroupName="optPA" ClientInstanceName ="optPA1">
                            </dxe:ASPxRadioButton>
                            <dxe:ASPxCheckBox ID="chkPA1" runat="server" Text=" " ClientInstanceName ="chkPA1">
                                </dxe:ASPxCheckBox>
                            </div>
                            <div style="float:left">
                                
                            <dxhe:ASPxHtmlEditor ID="htmlPhuongAn1" runat="server" Height="200px" 
                                Width="700px">
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                            </dxhe:ASPxHtmlEditor>
                            </div>
                        </td>
                        <td style="text-align: left" valign="Top">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 79px" valign="Top">
                            b)<asp:HiddenField ID="hdId2" runat="server" />
                                
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                        <div style="float:left">
                            <dxe:ASPxRadioButton ID="optPA2" runat="server" Text=" " GroupName="optPA" ClientInstanceName ="optPA2">
                            </dxe:ASPxRadioButton>
                            <dxe:ASPxCheckBox ID="chkPA2" runat="server" Text=" " ClientInstanceName ="chkPA2">
                                </dxe:ASPxCheckBox>
                            
                            </div>
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlPhuongAn2" runat="server" Height="200px" 
                                Width="700px">
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                            </dxhe:ASPxHtmlEditor>
                            </div>
                        </td>
                        <td style="text-align: left" valign="Top">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 79px" valign="Top">
                            c)<asp:HiddenField ID="hdId3" runat="server" />
                                
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                        <div style="float:left">
                            <dxe:ASPxRadioButton ID="optPA3" runat="server" Text=" " GroupName="optPA" ClientInstanceName ="optPA3">
                            </dxe:ASPxRadioButton>
                            <dxe:ASPxCheckBox ID="chkPA3" runat="server" Text=" " ClientInstanceName ="chkPA3">
                                </dxe:ASPxCheckBox>
                            
                            </div>
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlPhuongAn3" runat="server" Height="200px" 
                                Width="700px">
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                            </dxhe:ASPxHtmlEditor>
                            </div>
                        </td>
                        
                        <td style="text-align: left" valign="Top">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 79px" valign="Top">
                            d)<asp:HiddenField ID="hdId4" runat="server" />
                                
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                        <div style="float:left">
                            <dxe:ASPxRadioButton ID="optPA4" runat="server" Text=" " GroupName="optPA" ClientInstanceName ="optPA4">
                            </dxe:ASPxRadioButton>
                            <dxe:ASPxCheckBox ID="chkPA4" runat="server" Text=" " ClientInstanceName ="chkPA4">
                                </dxe:ASPxCheckBox>
                            </div>
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlPhuongAn4" runat="server" Height="200px" 
                                Width="700px">
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                            </dxhe:ASPxHtmlEditor>
                            </div>
                        </td>
                        <td style="text-align: left" valign="Top">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 79px" valign="Top">
                            e)<asp:HiddenField ID="hdId5" runat="server" />
                                
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                        <div style="float:left">
                            <dxe:ASPxRadioButton ID="optPA5" runat="server" Text=" " GroupName="optPA" ClientInstanceName ="optPA5">
                            </dxe:ASPxRadioButton>
                            <dxe:ASPxCheckBox ID="chkPA5" runat="server" Text=" " ClientInstanceName ="chkPA5">
                                </dxe:ASPxCheckBox>
                            </div>
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlPhuongAn5" runat="server" Height="200px" 
                                Width="700px">
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                            </dxhe:ASPxHtmlEditor>
                            </div>
                        </td>
                        <td style="text-align: left" valign="Top">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 79px" valign="Top">
                            f)<asp:HiddenField ID="hdId6" runat="server" />
                                
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                        <div style="float:left">
                            <dxe:ASPxRadioButton ID="optPA6" runat="server" Text=" " GroupName="optPA" ClientInstanceName ="optPA6">
                            </dxe:ASPxRadioButton>
                            <dxe:ASPxCheckBox ID="chkPA6" runat="server" Text=" " ClientInstanceName ="chkPA6">
                                </dxe:ASPxCheckBox>
                            </div>
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlPhuongAn6" runat="server" Height="200px" 
                                Width="700px">
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                            </dxhe:ASPxHtmlEditor>
                            </div>
                        </td>
                        <td style="text-align: left" valign="Top">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 79px">
                            <asp:HiddenField ID="hdSoPA" runat="server" />
                        </td>
                        <td style="text-align: left; width: 757px">
                                
                                <dxe:ASPxButton ID="btnThemPhuongAn" CssClass="buttons" runat="server" 
                                    Text="Thêm phương án" Width="139px" Visible="False"  />
                                
                            </td>
                        <td style="text-align: left">
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
        <script type="text/javascript">
            checkMultiAnswer();
        </script>
        
</asp:Content>

