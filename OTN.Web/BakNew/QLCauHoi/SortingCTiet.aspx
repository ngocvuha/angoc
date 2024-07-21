<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="SortingCTiet, App_Web_x6nppie8" title="Untitled Page" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">        
            Cập nhật câu hỏi sắp xếp
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
                        <td style="text-align: left; width: 757px">
                            <div style="float:left">
                            <asp:FileUpload ID="UploadFile" runat="server" Height="22px" Width="550px" />
                            </div>
                            <div style="float:left">
                                <dxe:ASPxButton ID="btnInsertMedia" CssClass="Button" runat="server" 
                                    Text="Chèn Media" onclick="btnInsertMedia_Click" Width="108px" 
                                    HorizontalAlign="Left">
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
                        <td style="text-align: left; " colspan="4" class="HeaderTitles">Nhập các phương án 
                            theo thứ tự đúng </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td with="100%" align="center">
                
                
                
                <table style="width: 100%">
                    <tr>
                        <td>
                            <b>1.</b></td>
                        <td>
                            <dxhe:ASPxHtmlEditor ID="htmlSorting1" runat="server" Height="170px"
                                Width="800px">
                                <StylesSpellChecker EnableDefaultAppearance="False">
                                </StylesSpellChecker>
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                                <Settings AllowPreview="False" />
                                <Toolbars>
                                    <dxhe:StandardToolbar1>
                                        <Items>
                                            <dxhe:ToolbarCopyButton>
                                            </dxhe:ToolbarCopyButton>
                                            <dxhe:ToolbarCutButton>
                                            </dxhe:ToolbarCutButton>
                                            <dxhe:ToolbarPasteButton>
                                            </dxhe:ToolbarPasteButton>
                                            <dxhe:ToolbarUndoButton BeginGroup="True">
                                            </dxhe:ToolbarUndoButton>
                                            <dxhe:ToolbarRedoButton>
                                            </dxhe:ToolbarRedoButton>
                                            <dxhe:ToolbarRemoveFormatButton BeginGroup="True">
                                            </dxhe:ToolbarRemoveFormatButton>
                                            <dxhe:ToolbarInsertLinkDialogButton BeginGroup="True">
                                            </dxhe:ToolbarInsertLinkDialogButton>
                                            <dxhe:ToolbarInsertImageDialogButton>
                                            </dxhe:ToolbarInsertImageDialogButton>
                                            <dxhe:ToolbarTableOperationsDropDownButton BeginGroup="True">
                                                <Items>
                                                    <dxhe:ToolbarInsertTableDialogButton BeginGroup="True" ViewStyle="ImageAndText">
                                                    </dxhe:ToolbarInsertTableDialogButton>
                                                    <dxhe:ToolbarTablePropertiesDialogButton BeginGroup="True">
                                                    </dxhe:ToolbarTablePropertiesDialogButton>
                                                    <dxhe:ToolbarTableRowPropertiesDialogButton>
                                                    </dxhe:ToolbarTableRowPropertiesDialogButton>
                                                    <dxhe:ToolbarTableColumnPropertiesDialogButton>
                                                    </dxhe:ToolbarTableColumnPropertiesDialogButton>
                                                    <dxhe:ToolbarTableCellPropertiesDialogButton>
                                                    </dxhe:ToolbarTableCellPropertiesDialogButton>
                                                    <dxhe:ToolbarInsertTableRowAboveButton BeginGroup="True">
                                                    </dxhe:ToolbarInsertTableRowAboveButton>
                                                    <dxhe:ToolbarInsertTableRowBelowButton>
                                                    </dxhe:ToolbarInsertTableRowBelowButton>
                                                    <dxhe:ToolbarInsertTableColumnToLeftButton>
                                                    </dxhe:ToolbarInsertTableColumnToLeftButton>
                                                    <dxhe:ToolbarInsertTableColumnToRightButton>
                                                    </dxhe:ToolbarInsertTableColumnToRightButton>
                                                    <dxhe:ToolbarSplitTableCellHorizontallyButton BeginGroup="True">
                                                    </dxhe:ToolbarSplitTableCellHorizontallyButton>
                                                    <dxhe:ToolbarSplitTableCellVerticallyButton>
                                                    </dxhe:ToolbarSplitTableCellVerticallyButton>
                                                    <dxhe:ToolbarMergeTableCellRightButton>
                                                    </dxhe:ToolbarMergeTableCellRightButton>
                                                    <dxhe:ToolbarMergeTableCellDownButton>
                                                    </dxhe:ToolbarMergeTableCellDownButton>
                                                    <dxhe:ToolbarDeleteTableButton BeginGroup="True">
                                                    </dxhe:ToolbarDeleteTableButton>
                                                    <dxhe:ToolbarDeleteTableRowButton>
                                                    </dxhe:ToolbarDeleteTableRowButton>
                                                    <dxhe:ToolbarDeleteTableColumnButton>
                                                    </dxhe:ToolbarDeleteTableColumnButton>
                                                </Items>
                                            </dxhe:ToolbarTableOperationsDropDownButton>
                                        </Items>
                                    </dxhe:StandardToolbar1>
                                    <dxhe:StandardToolbar2>
                                        <Items>
                                            <dxhe:ToolbarFontNameEdit>
                                                <Items>
                                                    <dxhe:ToolbarListEditItem Text="Times New Roman" Value="Times New Roman" />
                                                    <dxhe:ToolbarListEditItem Text="Tahoma" Value="Tahoma" />
                                                    <dxhe:ToolbarListEditItem Text="Verdana" Value="Verdana" />
                                                    <dxhe:ToolbarListEditItem Text="Arial" Value="Arial" />
                                                    <dxhe:ToolbarListEditItem Text="MS Sans Serif" Value="MS Sans Serif" />
                                                    <dxhe:ToolbarListEditItem Text="Courier" Value="Courier" />
                                                </Items>
                                            </dxhe:ToolbarFontNameEdit>
                                            <dxhe:ToolbarFontSizeEdit>
                                                <Items>
                                                    <dxhe:ToolbarListEditItem Text="1 (8pt)" Value="1" />
                                                    <dxhe:ToolbarListEditItem Text="2 (10pt)" Value="2" />
                                                    <dxhe:ToolbarListEditItem Text="3 (12pt)" Value="3" />
                                                    <dxhe:ToolbarListEditItem Text="4 (14pt)" Value="4" />
                                                    <dxhe:ToolbarListEditItem Text="5 (18pt)" Value="5" />
                                                    <dxhe:ToolbarListEditItem Text="6 (24pt)" Value="6" />
                                                    <dxhe:ToolbarListEditItem Text="7 (36pt)" Value="7" />
                                                </Items>
                                            </dxhe:ToolbarFontSizeEdit>
                                            <dxhe:ToolbarBoldButton BeginGroup="True">
                                            </dxhe:ToolbarBoldButton>
                                            <dxhe:ToolbarItalicButton>
                                            </dxhe:ToolbarItalicButton>
                                            <dxhe:ToolbarUnderlineButton>
                                            </dxhe:ToolbarUnderlineButton>
                                            <dxhe:ToolbarFontColorButton>
                                            </dxhe:ToolbarFontColorButton>
                                        </Items>
                                    </dxhe:StandardToolbar2>
                                </Toolbars>
                                
                            </dxhe:ASPxHtmlEditor>
                        </td>
                        <td>
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <b>2.</b></td>
                        <td>
                            <dxhe:ASPxHtmlEditor ID="htmlSorting2" runat="server" Height="170px"
                                Width="800px">
                                <StylesSpellChecker EnableDefaultAppearance="False">
                                </StylesSpellChecker>
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                                <Settings AllowPreview="False" />
                                <Toolbars>
                                    <dxhe:StandardToolbar1>
                                        <Items>
                                            <dxhe:ToolbarCopyButton>
                                            </dxhe:ToolbarCopyButton>
                                            <dxhe:ToolbarCutButton>
                                            </dxhe:ToolbarCutButton>
                                            <dxhe:ToolbarPasteButton>
                                            </dxhe:ToolbarPasteButton>
                                            <dxhe:ToolbarUndoButton BeginGroup="True">
                                            </dxhe:ToolbarUndoButton>
                                            <dxhe:ToolbarRedoButton>
                                            </dxhe:ToolbarRedoButton>
                                            <dxhe:ToolbarRemoveFormatButton BeginGroup="True">
                                            </dxhe:ToolbarRemoveFormatButton>
                                            <dxhe:ToolbarInsertLinkDialogButton BeginGroup="True">
                                            </dxhe:ToolbarInsertLinkDialogButton>
                                            <dxhe:ToolbarInsertImageDialogButton>
                                            </dxhe:ToolbarInsertImageDialogButton>
                                            <dxhe:ToolbarTableOperationsDropDownButton BeginGroup="True">
                                                <Items>
                                                    <dxhe:ToolbarInsertTableDialogButton BeginGroup="True" ViewStyle="ImageAndText">
                                                    </dxhe:ToolbarInsertTableDialogButton>
                                                    <dxhe:ToolbarTablePropertiesDialogButton BeginGroup="True">
                                                    </dxhe:ToolbarTablePropertiesDialogButton>
                                                    <dxhe:ToolbarTableRowPropertiesDialogButton>
                                                    </dxhe:ToolbarTableRowPropertiesDialogButton>
                                                    <dxhe:ToolbarTableColumnPropertiesDialogButton>
                                                    </dxhe:ToolbarTableColumnPropertiesDialogButton>
                                                    <dxhe:ToolbarTableCellPropertiesDialogButton>
                                                    </dxhe:ToolbarTableCellPropertiesDialogButton>
                                                    <dxhe:ToolbarInsertTableRowAboveButton BeginGroup="True">
                                                    </dxhe:ToolbarInsertTableRowAboveButton>
                                                    <dxhe:ToolbarInsertTableRowBelowButton>
                                                    </dxhe:ToolbarInsertTableRowBelowButton>
                                                    <dxhe:ToolbarInsertTableColumnToLeftButton>
                                                    </dxhe:ToolbarInsertTableColumnToLeftButton>
                                                    <dxhe:ToolbarInsertTableColumnToRightButton>
                                                    </dxhe:ToolbarInsertTableColumnToRightButton>
                                                    <dxhe:ToolbarSplitTableCellHorizontallyButton BeginGroup="True">
                                                    </dxhe:ToolbarSplitTableCellHorizontallyButton>
                                                    <dxhe:ToolbarSplitTableCellVerticallyButton>
                                                    </dxhe:ToolbarSplitTableCellVerticallyButton>
                                                    <dxhe:ToolbarMergeTableCellRightButton>
                                                    </dxhe:ToolbarMergeTableCellRightButton>
                                                    <dxhe:ToolbarMergeTableCellDownButton>
                                                    </dxhe:ToolbarMergeTableCellDownButton>
                                                    <dxhe:ToolbarDeleteTableButton BeginGroup="True">
                                                    </dxhe:ToolbarDeleteTableButton>
                                                    <dxhe:ToolbarDeleteTableRowButton>
                                                    </dxhe:ToolbarDeleteTableRowButton>
                                                    <dxhe:ToolbarDeleteTableColumnButton>
                                                    </dxhe:ToolbarDeleteTableColumnButton>
                                                </Items>
                                            </dxhe:ToolbarTableOperationsDropDownButton>
                                        </Items>
                                    </dxhe:StandardToolbar1>
                                    <dxhe:StandardToolbar2>
                                        <Items>
                                            <dxhe:ToolbarFontNameEdit>
                                                <Items>
                                                    <dxhe:ToolbarListEditItem Text="Times New Roman" Value="Times New Roman" />
                                                    <dxhe:ToolbarListEditItem Text="Tahoma" Value="Tahoma" />
                                                    <dxhe:ToolbarListEditItem Text="Verdana" Value="Verdana" />
                                                    <dxhe:ToolbarListEditItem Text="Arial" Value="Arial" />
                                                    <dxhe:ToolbarListEditItem Text="MS Sans Serif" Value="MS Sans Serif" />
                                                    <dxhe:ToolbarListEditItem Text="Courier" Value="Courier" />
                                                </Items>
                                            </dxhe:ToolbarFontNameEdit>
                                            <dxhe:ToolbarFontSizeEdit>
                                                <Items>
                                                    <dxhe:ToolbarListEditItem Text="1 (8pt)" Value="1" />
                                                    <dxhe:ToolbarListEditItem Text="2 (10pt)" Value="2" />
                                                    <dxhe:ToolbarListEditItem Text="3 (12pt)" Value="3" />
                                                    <dxhe:ToolbarListEditItem Text="4 (14pt)" Value="4" />
                                                    <dxhe:ToolbarListEditItem Text="5 (18pt)" Value="5" />
                                                    <dxhe:ToolbarListEditItem Text="6 (24pt)" Value="6" />
                                                    <dxhe:ToolbarListEditItem Text="7 (36pt)" Value="7" />
                                                </Items>
                                            </dxhe:ToolbarFontSizeEdit>
                                            <dxhe:ToolbarBoldButton BeginGroup="True">
                                            </dxhe:ToolbarBoldButton>
                                            <dxhe:ToolbarItalicButton>
                                            </dxhe:ToolbarItalicButton>
                                            <dxhe:ToolbarUnderlineButton>
                                            </dxhe:ToolbarUnderlineButton>
                                            <dxhe:ToolbarFontColorButton>
                                            </dxhe:ToolbarFontColorButton>
                                        </Items>
                                    </dxhe:StandardToolbar2>
                                </Toolbars>
                                
                            </dxhe:ASPxHtmlEditor>
                        </td>
                        <td>
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <b>3.</b></td>
                        <td>
                            <dxhe:ASPxHtmlEditor ID="htmlSorting3" runat="server" Height="170px"
                                Width="800px">
                                <StylesSpellChecker EnableDefaultAppearance="False">
                                </StylesSpellChecker>
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                                <Settings AllowPreview="False" />
                                <Toolbars>
                                    <dxhe:StandardToolbar1>
                                        <Items>
                                            <dxhe:ToolbarCopyButton>
                                            </dxhe:ToolbarCopyButton>
                                            <dxhe:ToolbarCutButton>
                                            </dxhe:ToolbarCutButton>
                                            <dxhe:ToolbarPasteButton>
                                            </dxhe:ToolbarPasteButton>
                                            <dxhe:ToolbarUndoButton BeginGroup="True">
                                            </dxhe:ToolbarUndoButton>
                                            <dxhe:ToolbarRedoButton>
                                            </dxhe:ToolbarRedoButton>
                                            <dxhe:ToolbarRemoveFormatButton BeginGroup="True">
                                            </dxhe:ToolbarRemoveFormatButton>
                                            <dxhe:ToolbarInsertLinkDialogButton BeginGroup="True">
                                            </dxhe:ToolbarInsertLinkDialogButton>
                                            <dxhe:ToolbarInsertImageDialogButton>
                                            </dxhe:ToolbarInsertImageDialogButton>
                                            <dxhe:ToolbarTableOperationsDropDownButton BeginGroup="True">
                                                <Items>
                                                    <dxhe:ToolbarInsertTableDialogButton BeginGroup="True" ViewStyle="ImageAndText">
                                                    </dxhe:ToolbarInsertTableDialogButton>
                                                    <dxhe:ToolbarTablePropertiesDialogButton BeginGroup="True">
                                                    </dxhe:ToolbarTablePropertiesDialogButton>
                                                    <dxhe:ToolbarTableRowPropertiesDialogButton>
                                                    </dxhe:ToolbarTableRowPropertiesDialogButton>
                                                    <dxhe:ToolbarTableColumnPropertiesDialogButton>
                                                    </dxhe:ToolbarTableColumnPropertiesDialogButton>
                                                    <dxhe:ToolbarTableCellPropertiesDialogButton>
                                                    </dxhe:ToolbarTableCellPropertiesDialogButton>
                                                    <dxhe:ToolbarInsertTableRowAboveButton BeginGroup="True">
                                                    </dxhe:ToolbarInsertTableRowAboveButton>
                                                    <dxhe:ToolbarInsertTableRowBelowButton>
                                                    </dxhe:ToolbarInsertTableRowBelowButton>
                                                    <dxhe:ToolbarInsertTableColumnToLeftButton>
                                                    </dxhe:ToolbarInsertTableColumnToLeftButton>
                                                    <dxhe:ToolbarInsertTableColumnToRightButton>
                                                    </dxhe:ToolbarInsertTableColumnToRightButton>
                                                    <dxhe:ToolbarSplitTableCellHorizontallyButton BeginGroup="True">
                                                    </dxhe:ToolbarSplitTableCellHorizontallyButton>
                                                    <dxhe:ToolbarSplitTableCellVerticallyButton>
                                                    </dxhe:ToolbarSplitTableCellVerticallyButton>
                                                    <dxhe:ToolbarMergeTableCellRightButton>
                                                    </dxhe:ToolbarMergeTableCellRightButton>
                                                    <dxhe:ToolbarMergeTableCellDownButton>
                                                    </dxhe:ToolbarMergeTableCellDownButton>
                                                    <dxhe:ToolbarDeleteTableButton BeginGroup="True">
                                                    </dxhe:ToolbarDeleteTableButton>
                                                    <dxhe:ToolbarDeleteTableRowButton>
                                                    </dxhe:ToolbarDeleteTableRowButton>
                                                    <dxhe:ToolbarDeleteTableColumnButton>
                                                    </dxhe:ToolbarDeleteTableColumnButton>
                                                </Items>
                                            </dxhe:ToolbarTableOperationsDropDownButton>
                                        </Items>
                                    </dxhe:StandardToolbar1>
                                    <dxhe:StandardToolbar2>
                                        <Items>
                                            <dxhe:ToolbarFontNameEdit>
                                                <Items>
                                                    <dxhe:ToolbarListEditItem Text="Times New Roman" Value="Times New Roman" />
                                                    <dxhe:ToolbarListEditItem Text="Tahoma" Value="Tahoma" />
                                                    <dxhe:ToolbarListEditItem Text="Verdana" Value="Verdana" />
                                                    <dxhe:ToolbarListEditItem Text="Arial" Value="Arial" />
                                                    <dxhe:ToolbarListEditItem Text="MS Sans Serif" Value="MS Sans Serif" />
                                                    <dxhe:ToolbarListEditItem Text="Courier" Value="Courier" />
                                                </Items>
                                            </dxhe:ToolbarFontNameEdit>
                                            <dxhe:ToolbarFontSizeEdit>
                                                <Items>
                                                    <dxhe:ToolbarListEditItem Text="1 (8pt)" Value="1" />
                                                    <dxhe:ToolbarListEditItem Text="2 (10pt)" Value="2" />
                                                    <dxhe:ToolbarListEditItem Text="3 (12pt)" Value="3" />
                                                    <dxhe:ToolbarListEditItem Text="4 (14pt)" Value="4" />
                                                    <dxhe:ToolbarListEditItem Text="5 (18pt)" Value="5" />
                                                    <dxhe:ToolbarListEditItem Text="6 (24pt)" Value="6" />
                                                    <dxhe:ToolbarListEditItem Text="7 (36pt)" Value="7" />
                                                </Items>
                                            </dxhe:ToolbarFontSizeEdit>
                                            <dxhe:ToolbarBoldButton BeginGroup="True">
                                            </dxhe:ToolbarBoldButton>
                                            <dxhe:ToolbarItalicButton>
                                            </dxhe:ToolbarItalicButton>
                                            <dxhe:ToolbarUnderlineButton>
                                            </dxhe:ToolbarUnderlineButton>
                                            <dxhe:ToolbarFontColorButton>
                                            </dxhe:ToolbarFontColorButton>
                                        </Items>
                                    </dxhe:StandardToolbar2>
                                </Toolbars>
                                
                            </dxhe:ASPxHtmlEditor>
                        </td>
                        <td>
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <b>4.</b></td>
                        <td>
                            <dxhe:ASPxHtmlEditor ID="htmlSorting4" runat="server" Height="170px"
                                Width="800px">
                                <StylesSpellChecker EnableDefaultAppearance="False">
                                </StylesSpellChecker>
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                                <Settings AllowPreview="False" />
                                <Toolbars>
                                    <dxhe:StandardToolbar1>
                                        <Items>
                                            <dxhe:ToolbarCopyButton>
                                            </dxhe:ToolbarCopyButton>
                                            <dxhe:ToolbarCutButton>
                                            </dxhe:ToolbarCutButton>
                                            <dxhe:ToolbarPasteButton>
                                            </dxhe:ToolbarPasteButton>
                                            <dxhe:ToolbarUndoButton BeginGroup="True">
                                            </dxhe:ToolbarUndoButton>
                                            <dxhe:ToolbarRedoButton>
                                            </dxhe:ToolbarRedoButton>
                                            <dxhe:ToolbarRemoveFormatButton BeginGroup="True">
                                            </dxhe:ToolbarRemoveFormatButton>
                                            <dxhe:ToolbarInsertLinkDialogButton BeginGroup="True">
                                            </dxhe:ToolbarInsertLinkDialogButton>
                                            <dxhe:ToolbarInsertImageDialogButton>
                                            </dxhe:ToolbarInsertImageDialogButton>
                                            <dxhe:ToolbarTableOperationsDropDownButton BeginGroup="True">
                                                <Items>
                                                    <dxhe:ToolbarInsertTableDialogButton BeginGroup="True" ViewStyle="ImageAndText">
                                                    </dxhe:ToolbarInsertTableDialogButton>
                                                    <dxhe:ToolbarTablePropertiesDialogButton BeginGroup="True">
                                                    </dxhe:ToolbarTablePropertiesDialogButton>
                                                    <dxhe:ToolbarTableRowPropertiesDialogButton>
                                                    </dxhe:ToolbarTableRowPropertiesDialogButton>
                                                    <dxhe:ToolbarTableColumnPropertiesDialogButton>
                                                    </dxhe:ToolbarTableColumnPropertiesDialogButton>
                                                    <dxhe:ToolbarTableCellPropertiesDialogButton>
                                                    </dxhe:ToolbarTableCellPropertiesDialogButton>
                                                    <dxhe:ToolbarInsertTableRowAboveButton BeginGroup="True">
                                                    </dxhe:ToolbarInsertTableRowAboveButton>
                                                    <dxhe:ToolbarInsertTableRowBelowButton>
                                                    </dxhe:ToolbarInsertTableRowBelowButton>
                                                    <dxhe:ToolbarInsertTableColumnToLeftButton>
                                                    </dxhe:ToolbarInsertTableColumnToLeftButton>
                                                    <dxhe:ToolbarInsertTableColumnToRightButton>
                                                    </dxhe:ToolbarInsertTableColumnToRightButton>
                                                    <dxhe:ToolbarSplitTableCellHorizontallyButton BeginGroup="True">
                                                    </dxhe:ToolbarSplitTableCellHorizontallyButton>
                                                    <dxhe:ToolbarSplitTableCellVerticallyButton>
                                                    </dxhe:ToolbarSplitTableCellVerticallyButton>
                                                    <dxhe:ToolbarMergeTableCellRightButton>
                                                    </dxhe:ToolbarMergeTableCellRightButton>
                                                    <dxhe:ToolbarMergeTableCellDownButton>
                                                    </dxhe:ToolbarMergeTableCellDownButton>
                                                    <dxhe:ToolbarDeleteTableButton BeginGroup="True">
                                                    </dxhe:ToolbarDeleteTableButton>
                                                    <dxhe:ToolbarDeleteTableRowButton>
                                                    </dxhe:ToolbarDeleteTableRowButton>
                                                    <dxhe:ToolbarDeleteTableColumnButton>
                                                    </dxhe:ToolbarDeleteTableColumnButton>
                                                </Items>
                                            </dxhe:ToolbarTableOperationsDropDownButton>
                                        </Items>
                                    </dxhe:StandardToolbar1>
                                    <dxhe:StandardToolbar2>
                                        <Items>
                                            <dxhe:ToolbarFontNameEdit>
                                                <Items>
                                                    <dxhe:ToolbarListEditItem Text="Times New Roman" Value="Times New Roman" />
                                                    <dxhe:ToolbarListEditItem Text="Tahoma" Value="Tahoma" />
                                                    <dxhe:ToolbarListEditItem Text="Verdana" Value="Verdana" />
                                                    <dxhe:ToolbarListEditItem Text="Arial" Value="Arial" />
                                                    <dxhe:ToolbarListEditItem Text="MS Sans Serif" Value="MS Sans Serif" />
                                                    <dxhe:ToolbarListEditItem Text="Courier" Value="Courier" />
                                                </Items>
                                            </dxhe:ToolbarFontNameEdit>
                                            <dxhe:ToolbarFontSizeEdit>
                                                <Items>
                                                    <dxhe:ToolbarListEditItem Text="1 (8pt)" Value="1" />
                                                    <dxhe:ToolbarListEditItem Text="2 (10pt)" Value="2" />
                                                    <dxhe:ToolbarListEditItem Text="3 (12pt)" Value="3" />
                                                    <dxhe:ToolbarListEditItem Text="4 (14pt)" Value="4" />
                                                    <dxhe:ToolbarListEditItem Text="5 (18pt)" Value="5" />
                                                    <dxhe:ToolbarListEditItem Text="6 (24pt)" Value="6" />
                                                    <dxhe:ToolbarListEditItem Text="7 (36pt)" Value="7" />
                                                </Items>
                                            </dxhe:ToolbarFontSizeEdit>
                                            <dxhe:ToolbarBoldButton BeginGroup="True">
                                            </dxhe:ToolbarBoldButton>
                                            <dxhe:ToolbarItalicButton>
                                            </dxhe:ToolbarItalicButton>
                                            <dxhe:ToolbarUnderlineButton>
                                            </dxhe:ToolbarUnderlineButton>
                                            <dxhe:ToolbarFontColorButton>
                                            </dxhe:ToolbarFontColorButton>
                                        </Items>
                                    </dxhe:StandardToolbar2>
                                </Toolbars>
                                
                            </dxhe:ASPxHtmlEditor>
                        </td>
                        <td>
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <b>5.</b></td>
                        <td>
                            <dxhe:ASPxHtmlEditor ID="htmlSorting5" runat="server" Height="170px"
                                Width="800px" AccessibilityCompliant="True">
                                <StylesSpellChecker EnableDefaultAppearance="False">
                                </StylesSpellChecker>
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                                <Settings AllowPreview="False" />
                                <Toolbars>
                                    <dxhe:StandardToolbar1>
                                        <Items>
                                            <dxhe:ToolbarCopyButton>
                                            </dxhe:ToolbarCopyButton>
                                            <dxhe:ToolbarCutButton>
                                            </dxhe:ToolbarCutButton>
                                            <dxhe:ToolbarPasteButton>
                                            </dxhe:ToolbarPasteButton>
                                            <dxhe:ToolbarUndoButton BeginGroup="True">
                                            </dxhe:ToolbarUndoButton>
                                            <dxhe:ToolbarRedoButton>
                                            </dxhe:ToolbarRedoButton>
                                            <dxhe:ToolbarRemoveFormatButton BeginGroup="True">
                                            </dxhe:ToolbarRemoveFormatButton>
                                            <dxhe:ToolbarInsertLinkDialogButton BeginGroup="True">
                                            </dxhe:ToolbarInsertLinkDialogButton>
                                            <dxhe:ToolbarInsertImageDialogButton>
                                            </dxhe:ToolbarInsertImageDialogButton>
                                            <dxhe:ToolbarTableOperationsDropDownButton BeginGroup="True">
                                                <Items>
                                                    <dxhe:ToolbarInsertTableDialogButton BeginGroup="True" ViewStyle="ImageAndText">
                                                    </dxhe:ToolbarInsertTableDialogButton>
                                                    <dxhe:ToolbarTablePropertiesDialogButton BeginGroup="True">
                                                    </dxhe:ToolbarTablePropertiesDialogButton>
                                                    <dxhe:ToolbarTableRowPropertiesDialogButton>
                                                    </dxhe:ToolbarTableRowPropertiesDialogButton>
                                                    <dxhe:ToolbarTableColumnPropertiesDialogButton>
                                                    </dxhe:ToolbarTableColumnPropertiesDialogButton>
                                                    <dxhe:ToolbarTableCellPropertiesDialogButton>
                                                    </dxhe:ToolbarTableCellPropertiesDialogButton>
                                                    <dxhe:ToolbarInsertTableRowAboveButton BeginGroup="True">
                                                    </dxhe:ToolbarInsertTableRowAboveButton>
                                                    <dxhe:ToolbarInsertTableRowBelowButton>
                                                    </dxhe:ToolbarInsertTableRowBelowButton>
                                                    <dxhe:ToolbarInsertTableColumnToLeftButton>
                                                    </dxhe:ToolbarInsertTableColumnToLeftButton>
                                                    <dxhe:ToolbarInsertTableColumnToRightButton>
                                                    </dxhe:ToolbarInsertTableColumnToRightButton>
                                                    <dxhe:ToolbarSplitTableCellHorizontallyButton BeginGroup="True">
                                                    </dxhe:ToolbarSplitTableCellHorizontallyButton>
                                                    <dxhe:ToolbarSplitTableCellVerticallyButton>
                                                    </dxhe:ToolbarSplitTableCellVerticallyButton>
                                                    <dxhe:ToolbarMergeTableCellRightButton>
                                                    </dxhe:ToolbarMergeTableCellRightButton>
                                                    <dxhe:ToolbarMergeTableCellDownButton>
                                                    </dxhe:ToolbarMergeTableCellDownButton>
                                                    <dxhe:ToolbarDeleteTableButton BeginGroup="True">
                                                    </dxhe:ToolbarDeleteTableButton>
                                                    <dxhe:ToolbarDeleteTableRowButton>
                                                    </dxhe:ToolbarDeleteTableRowButton>
                                                    <dxhe:ToolbarDeleteTableColumnButton>
                                                    </dxhe:ToolbarDeleteTableColumnButton>
                                                </Items>
                                            </dxhe:ToolbarTableOperationsDropDownButton>
                                        </Items>
                                    </dxhe:StandardToolbar1>
                                    <dxhe:StandardToolbar2>
                                        <Items>
                                            <dxhe:ToolbarFontNameEdit>
                                                <Items>
                                                    <dxhe:ToolbarListEditItem Text="Times New Roman" Value="Times New Roman" />
                                                    <dxhe:ToolbarListEditItem Text="Tahoma" Value="Tahoma" />
                                                    <dxhe:ToolbarListEditItem Text="Verdana" Value="Verdana" />
                                                    <dxhe:ToolbarListEditItem Text="Arial" Value="Arial" />
                                                    <dxhe:ToolbarListEditItem Text="MS Sans Serif" Value="MS Sans Serif" />
                                                    <dxhe:ToolbarListEditItem Text="Courier" Value="Courier" />
                                                </Items>
                                            </dxhe:ToolbarFontNameEdit>
                                            <dxhe:ToolbarFontSizeEdit>
                                                <Items>
                                                    <dxhe:ToolbarListEditItem Text="1 (8pt)" Value="1" />
                                                    <dxhe:ToolbarListEditItem Text="2 (10pt)" Value="2" />
                                                    <dxhe:ToolbarListEditItem Text="3 (12pt)" Value="3" />
                                                    <dxhe:ToolbarListEditItem Text="4 (14pt)" Value="4" />
                                                    <dxhe:ToolbarListEditItem Text="5 (18pt)" Value="5" />
                                                    <dxhe:ToolbarListEditItem Text="6 (24pt)" Value="6" />
                                                    <dxhe:ToolbarListEditItem Text="7 (36pt)" Value="7" />
                                                </Items>
                                            </dxhe:ToolbarFontSizeEdit>
                                            <dxhe:ToolbarBoldButton BeginGroup="True">
                                            </dxhe:ToolbarBoldButton>
                                            <dxhe:ToolbarItalicButton>
                                            </dxhe:ToolbarItalicButton>
                                            <dxhe:ToolbarUnderlineButton>
                                            </dxhe:ToolbarUnderlineButton>
                                            <dxhe:ToolbarFontColorButton>
                                            </dxhe:ToolbarFontColorButton>
                                        </Items>
                                    </dxhe:StandardToolbar2>
                                </Toolbars>
                                
                            </dxhe:ASPxHtmlEditor>
                        </td>
                        <td>
                            &nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <b>6.</b></td>
                        <td>
                            <dxhe:ASPxHtmlEditor ID="htmlSorting6" runat="server" Height="170px"
                                Width="800px">
                                <StylesSpellChecker EnableDefaultAppearance="False">
                                </StylesSpellChecker>
                                <settingsimageupload>
                                    <validationsettings allowedcontenttypes="image/jpeg,image/pjpeg,image/gif,image/png,image/x-png">
                                    </validationsettings>
                                </settingsimageupload>
                                <SettingsHtmlEditing AllowIFrames="True" />
                                <Settings AllowPreview="False" />
                                <Toolbars>
                                    <dxhe:StandardToolbar1>
                                        <Items>
                                            <dxhe:ToolbarCopyButton>
                                            </dxhe:ToolbarCopyButton>
                                            <dxhe:ToolbarCutButton>
                                            </dxhe:ToolbarCutButton>
                                            <dxhe:ToolbarPasteButton>
                                            </dxhe:ToolbarPasteButton>
                                            <dxhe:ToolbarUndoButton BeginGroup="True">
                                            </dxhe:ToolbarUndoButton>
                                            <dxhe:ToolbarRedoButton>
                                            </dxhe:ToolbarRedoButton>
                                            <dxhe:ToolbarRemoveFormatButton BeginGroup="True">
                                            </dxhe:ToolbarRemoveFormatButton>
                                            <dxhe:ToolbarInsertLinkDialogButton BeginGroup="True">
                                            </dxhe:ToolbarInsertLinkDialogButton>
                                            <dxhe:ToolbarInsertImageDialogButton>
                                            </dxhe:ToolbarInsertImageDialogButton>
                                            <dxhe:ToolbarTableOperationsDropDownButton BeginGroup="True">
                                                <Items>
                                                    <dxhe:ToolbarInsertTableDialogButton BeginGroup="True" ViewStyle="ImageAndText">
                                                    </dxhe:ToolbarInsertTableDialogButton>
                                                    <dxhe:ToolbarTablePropertiesDialogButton BeginGroup="True">
                                                    </dxhe:ToolbarTablePropertiesDialogButton>
                                                    <dxhe:ToolbarTableRowPropertiesDialogButton>
                                                    </dxhe:ToolbarTableRowPropertiesDialogButton>
                                                    <dxhe:ToolbarTableColumnPropertiesDialogButton>
                                                    </dxhe:ToolbarTableColumnPropertiesDialogButton>
                                                    <dxhe:ToolbarTableCellPropertiesDialogButton>
                                                    </dxhe:ToolbarTableCellPropertiesDialogButton>
                                                    <dxhe:ToolbarInsertTableRowAboveButton BeginGroup="True">
                                                    </dxhe:ToolbarInsertTableRowAboveButton>
                                                    <dxhe:ToolbarInsertTableRowBelowButton>
                                                    </dxhe:ToolbarInsertTableRowBelowButton>
                                                    <dxhe:ToolbarInsertTableColumnToLeftButton>
                                                    </dxhe:ToolbarInsertTableColumnToLeftButton>
                                                    <dxhe:ToolbarInsertTableColumnToRightButton>
                                                    </dxhe:ToolbarInsertTableColumnToRightButton>
                                                    <dxhe:ToolbarSplitTableCellHorizontallyButton BeginGroup="True">
                                                    </dxhe:ToolbarSplitTableCellHorizontallyButton>
                                                    <dxhe:ToolbarSplitTableCellVerticallyButton>
                                                    </dxhe:ToolbarSplitTableCellVerticallyButton>
                                                    <dxhe:ToolbarMergeTableCellRightButton>
                                                    </dxhe:ToolbarMergeTableCellRightButton>
                                                    <dxhe:ToolbarMergeTableCellDownButton>
                                                    </dxhe:ToolbarMergeTableCellDownButton>
                                                    <dxhe:ToolbarDeleteTableButton BeginGroup="True">
                                                    </dxhe:ToolbarDeleteTableButton>
                                                    <dxhe:ToolbarDeleteTableRowButton>
                                                    </dxhe:ToolbarDeleteTableRowButton>
                                                    <dxhe:ToolbarDeleteTableColumnButton>
                                                    </dxhe:ToolbarDeleteTableColumnButton>
                                                </Items>
                                            </dxhe:ToolbarTableOperationsDropDownButton>
                                        </Items>
                                    </dxhe:StandardToolbar1>
                                    <dxhe:StandardToolbar2>
                                        <Items>
                                            <dxhe:ToolbarFontNameEdit>
                                                <Items>
                                                    <dxhe:ToolbarListEditItem Text="Times New Roman" Value="Times New Roman" />
                                                    <dxhe:ToolbarListEditItem Text="Tahoma" Value="Tahoma" />
                                                    <dxhe:ToolbarListEditItem Text="Verdana" Value="Verdana" />
                                                    <dxhe:ToolbarListEditItem Text="Arial" Value="Arial" />
                                                    <dxhe:ToolbarListEditItem Text="MS Sans Serif" Value="MS Sans Serif" />
                                                    <dxhe:ToolbarListEditItem Text="Courier" Value="Courier" />
                                                </Items>
                                            </dxhe:ToolbarFontNameEdit>
                                            <dxhe:ToolbarFontSizeEdit>
                                                <Items>
                                                    <dxhe:ToolbarListEditItem Text="1 (8pt)" Value="1" />
                                                    <dxhe:ToolbarListEditItem Text="2 (10pt)" Value="2" />
                                                    <dxhe:ToolbarListEditItem Text="3 (12pt)" Value="3" />
                                                    <dxhe:ToolbarListEditItem Text="4 (14pt)" Value="4" />
                                                    <dxhe:ToolbarListEditItem Text="5 (18pt)" Value="5" />
                                                    <dxhe:ToolbarListEditItem Text="6 (24pt)" Value="6" />
                                                    <dxhe:ToolbarListEditItem Text="7 (36pt)" Value="7" />
                                                </Items>
                                            </dxhe:ToolbarFontSizeEdit>
                                            <dxhe:ToolbarBoldButton BeginGroup="True">
                                            </dxhe:ToolbarBoldButton>
                                            <dxhe:ToolbarItalicButton>
                                            </dxhe:ToolbarItalicButton>
                                            <dxhe:ToolbarUnderlineButton>
                                            </dxhe:ToolbarUnderlineButton>
                                            <dxhe:ToolbarFontColorButton>
                                            </dxhe:ToolbarFontColorButton>
                                        </Items>
                                    </dxhe:StandardToolbar2>
                                </Toolbars>
                                
                            </dxhe:ASPxHtmlEditor>
                        </td>
                        <td>
                            &nbsp;</td>
                    </tr>
                    <tr>
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

