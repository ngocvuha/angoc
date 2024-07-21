<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="WrittingCTiet, App_Web_x6nppie8" title="Untitled Page" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">        
                        Cập nhật câu hỏi
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
                        <td style="text-align: left; width: 106px; height: 26px;">
                            File</td>
                        <td style="text-align: left; width: 757px; height: 26px;" colspan="2">
                            <div style="float:left">
                            <asp:FileUpload ID="UploadFile" runat="server" Height="22px" Width="550px" />
                            </div>
                            <div style="float:left">
                                <dxe:ASPxButton ID="btnInsertMedia" CssClass="Button" runat="server" 
                                    Text="Chèn file" onclick="btnInsertMedia_Click" HorizontalAlign="Left" 
                                    Width="108px">
                                    <Image Url="~/images/attach.png" />
                                </dxe:ASPxButton>
                            </div>
                        </td>
                        <td style="text-align: left; height: 26px;">
                            </td>
                        <td style="text-align: left; height: 26px;">
                            </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 106px">
                            Nội dung</td>
                        <td style="text-align: left; width: 657px">
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungCauHoi" runat="server" Height="200px"
                                Width="850px" ClientInstanceName="htmlNoiDung">
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                                
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
                                Width="42px"/>
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
                            <dxe:ASPxMemo ID="txtGhiChu" runat="server" Width="850px" Height="200px" />
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
        <tr>
            <td with="100%" align="center">
               <table style="width: 100%">
                    <tr>
                        <td with="100%" align="center">
                <table style="width: 100%">
                    <tr>
                        <td style="text-align: left; " valign="Top" class="HeaderTitles" colspan="2">
                           <div style="float:left"> Chi tiết thang điểm&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;  </div>
                        </td>
                        <td style="text-align: left" valign="Top">
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 100px" valign="Top">
                            1)<asp:HiddenField ID="hdId1" runat="server" />
                            <br />
                            <div>    
                             Điểm 
                             </div>
                            <div>
                            <dxe:ASPxTextBox ID="txtDiemCon1" runat="server" HorizontalAlign="Right" 
                                Width="42px"/>
                             </div>
                            <div>
                            Mức lẻ
                            </div>
                            <div>
                            <dxe:ASPxComboBox ID="cboMuc1" runat="server" DropDownStyle="DropDown" 
                                SelectedIndex="0" ValueType="System.String" Width="50px">
                                <Items>
                                    <dxe:ListEditItem Selected="True" Text="0.25" Value="0.25" />
                                    <dxe:ListEditItem Text="0.5" Value="0.5" />
                                    <dxe:ListEditItem Text="1" Value="1" />
                                </Items>
                            </dxe:ASPxComboBox>
                            </div>    
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                            <div>
                                
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungY1" runat="server" Height="200px" 
                                Width="850px">
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
                        <td style="text-align: left; width: 100px" valign="Top">
                            2)<asp:HiddenField ID="hdId2" runat="server" /><br />
                            <div>    
                             Điểm 
                             </div>
                            <div>
                            <dxe:ASPxTextBox ID="txtDiemCon2" runat="server" HorizontalAlign="Right" 
                                Width="42px"/>
                             </div>
                            <div>
                            Mức lẻ
                            </div>
                            <div>
                            <dxe:ASPxComboBox ID="cboMuc2" runat="server" DropDownStyle="DropDown" 
                                SelectedIndex="0" ValueType="System.String" Width="50px">
                                <Items>
                                    <dxe:ListEditItem Selected="True" Text="0.25" Value="0.25" />
                                    <dxe:ListEditItem Text="0.5" Value="0.5" />
                                    <dxe:ListEditItem Text="1" Value="1" />
                                </Items>
                            </dxe:ASPxComboBox>
                            </div>     
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungY2" runat="server" Height="200px" 
                                Width="850px">
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
                        <td style="text-align: left; width: 100px" valign="Top">
                            3)<asp:HiddenField ID="hdId3" runat="server" /><br />
                            <div>    
                             Điểm 
                             </div>
                            <div>
                            <dxe:ASPxTextBox ID="txtDiemCon3" runat="server" HorizontalAlign="Right" 
                                Width="42px"/>
                             </div>
                            <div>
                            Mức lẻ
                            </div>
                            <div>
                            <dxe:ASPxComboBox ID="cboMuc3" runat="server" DropDownStyle="DropDown" 
                                SelectedIndex="0" ValueType="System.String" Width="50px">
                                <Items>
                                    <dxe:ListEditItem Selected="True" Text="0.25" Value="0.25" />
                                    <dxe:ListEditItem Text="0.5" Value="0.5" />
                                    <dxe:ListEditItem Text="1" Value="1" />
                                </Items>
                            </dxe:ASPxComboBox>
                            </div>     
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungY3" runat="server" Height="200px" 
                                Width="850px">
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
                        <td style="text-align: left; width: 100px" valign="Top">
                            4)<asp:HiddenField ID="hdId4" runat="server" /><br />
                            <div>    
                             Điểm 
                             </div>
                            <div>
                            <dxe:ASPxTextBox ID="txtDiemCon4" runat="server" HorizontalAlign="Right" 
                                Width="42px"/>
                             </div>
                            <div>
                            Mức lẻ
                            </div>
                            <div>
                            <dxe:ASPxComboBox ID="cboMuc4" runat="server" DropDownStyle="DropDown" 
                                SelectedIndex="0" ValueType="System.String" Width="50px">
                                <Items>
                                    <dxe:ListEditItem Selected="True" Text="0.25" Value="0.25" />
                                    <dxe:ListEditItem Text="0.5" Value="0.5" />
                                    <dxe:ListEditItem Text="1" Value="1" />
                                </Items>
                            </dxe:ASPxComboBox>
                            </div>     
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungY4" runat="server" Height="200px" 
                                Width="850px">
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
                        <td style="text-align: left; width: 100px" valign="Top">
                            5)<asp:HiddenField ID="hdId5" runat="server" /><br />
                            <div>    
                             Điểm 
                             </div>
                            <div>
                            <dxe:ASPxTextBox ID="txtDiemCon5" runat="server" HorizontalAlign="Right" 
                                Width="42px"/>
                             </div>
                            <div>
                            Mức lẻ
                            </div>
                            <div>
                            <dxe:ASPxComboBox ID="cboMuc5" runat="server" DropDownStyle="DropDown" 
                                SelectedIndex="0" ValueType="System.String" Width="50px">
                                <Items>
                                    <dxe:ListEditItem Selected="True" Text="0.25" Value="0.25" />
                                    <dxe:ListEditItem Text="0.5" Value="0.5" />
                                    <dxe:ListEditItem Text="1" Value="1" />
                                </Items>
                            </dxe:ASPxComboBox>
                            </div>     
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungY5" runat="server" Height="200px" 
                                Width="850px">
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
                        <td style="text-align: left; width: 100px" valign="Top">
                            6)<asp:HiddenField ID="hdId6" runat="server" /><br />
                            <div>    
                             Điểm 
                             </div>
                            <div>
                            <dxe:ASPxTextBox ID="txtDiemCon6" runat="server" HorizontalAlign="Right" 
                                Width="42px"/>
                             </div>
                            <div>
                            Mức lẻ
                            </div>
                            <div>
                            <dxe:ASPxComboBox ID="cboMuc6" runat="server" DropDownStyle="DropDown" 
                                SelectedIndex="0" ValueType="System.String" Width="50px">
                                <Items>
                                    <dxe:ListEditItem Selected="True" Text="0.25" Value="0.25" />
                                    <dxe:ListEditItem Text="0.5" Value="0.5" />
                                    <dxe:ListEditItem Text="1" Value="1" />
                                </Items>
                            </dxe:ASPxComboBox>
                            </div>     
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungY6" runat="server" Height="200px" 
                                Width="850px">
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
                        <td style="text-align: left; width: 100px" valign="Top">
                            7)<asp:HiddenField ID="hdId7" runat="server" /><br />
                            <div>    
                             Điểm 
                             </div>
                            <div>
                            <dxe:ASPxTextBox ID="txtDiemCon7" runat="server" HorizontalAlign="Right" 
                                Width="42px"/>
                             </div>
                            <div>
                            Mức lẻ
                            </div>
                            <div>
                            <dxe:ASPxComboBox ID="cboMuc7" runat="server" DropDownStyle="DropDown" 
                                SelectedIndex="0" ValueType="System.String" Width="50px">
                                <Items>
                                    <dxe:ListEditItem Selected="True" Text="0.25" Value="0.25" />
                                    <dxe:ListEditItem Text="0.5" Value="0.5" />
                                    <dxe:ListEditItem Text="1" Value="1" />
                                </Items>
                            </dxe:ASPxComboBox>
                            </div>     
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungY7" runat="server" Height="200px" 
                                Width="850px">
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
                        <td style="text-align: left; width: 100px" valign="Top">
                            8)<asp:HiddenField ID="hdId8" runat="server" /><br />
                            <div>    
                             Điểm 
                             </div>
                            <div>
                            <dxe:ASPxTextBox ID="txtDiemCon8" runat="server" HorizontalAlign="Right" 
                                Width="42px"/>
                             </div>
                            <div>
                            Mức lẻ
                            </div>
                            <div>
                            <dxe:ASPxComboBox ID="cboMuc8" runat="server" DropDownStyle="DropDown" 
                                SelectedIndex="0" ValueType="System.String" Width="50px">
                                <Items>
                                    <dxe:ListEditItem Selected="True" Text="0.25" Value="0.25" />
                                    <dxe:ListEditItem Text="0.5" Value="0.5" />
                                    <dxe:ListEditItem Text="1" Value="1" />
                                </Items>
                            </dxe:ASPxComboBox>
                            </div>     
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungY8" runat="server" Height="200px" 
                                Width="850px">
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
                        <td style="text-align: left; width: 100px" valign="Top">
                            9)<asp:HiddenField ID="hdId9" runat="server" /><br />
                            <div>    
                             Điểm 
                             </div>
                            <div>
                            <dxe:ASPxTextBox ID="txtDiemCon9" runat="server" HorizontalAlign="Right" 
                                Width="42px"/>
                             </div>
                            <div>
                            Mức lẻ
                            </div>
                            <div>
                            <dxe:ASPxComboBox ID="cboMuc9" runat="server" DropDownStyle="DropDown" 
                                SelectedIndex="0" ValueType="System.String" Width="50px">
                                <Items>
                                    <dxe:ListEditItem Selected="True" Text="0.25" Value="0.25" />
                                    <dxe:ListEditItem Text="0.5" Value="0.5" />
                                    <dxe:ListEditItem Text="1" Value="1" />
                                </Items>
                            </dxe:ASPxComboBox>
                            </div>     
                            </td>
                        <td style="text-align: left; width: 757px" valign="Top">
                            <div style="float:left">
                            <dxhe:ASPxHtmlEditor ID="htmlNoiDungY9" runat="server" Height="200px" 
                                Width="850px">
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
                        <td style="text-align: left; width: 100px">
                            <asp:HiddenField ID="hdSoPA" runat="server" />
                        </td>
                        <td style="text-align: left; width: 757px">
                                
                            </td>
                        <td style="text-align: left">
                            &nbsp;</td>
                    </tr>
                </table>
                        </td>
                    </tr>
                </table>
                
          </td>
        </tr>
     </table>

</asp:Content>

