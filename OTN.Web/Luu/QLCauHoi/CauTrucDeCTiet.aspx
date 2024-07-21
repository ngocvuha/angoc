<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="CauTrucDeCTiet, App_Web_nvbb4npw" title="Untitled Page" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.Web.ASPxTreeList.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxTreeList" tagprefix="dxwtl" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">
         Chi tiết cấu trúc đề thi
    </div><dxe:ASPxLabel ID="lbThongBao" runat="server" Font-Bold="True" 
        Font-Italic="True" ForeColor="Red">
    </dxe:ASPxLabel><br />
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom:15px;"
        width="100%" align="center">
        <tr>
            <td with="100%" align="left">
                <table border="0" cellpadding="2" cellspacing="2" 
                    style="border-collapse: collapse; border: solid 1px #cacaca; width: 845px;">
                    <tr>
            <td with="100%" style="height: 27px;" valign="top" colspan="5">
                
                <table style="width: 100%">
                    <tr>
                        <td>
                
                Tên</td>
                        <td>
                
                            <dxe:ASPxTextBox ID="txtTen" runat="server" Width="370px">
                            </dxe:ASPxTextBox>
                        </td>
                        <td>
                
                Thời gian làm bài</td>
                        <td>
                
                            <dxe:ASPxTextBox ID="txtThoiGianLamBai" runat="server" Width="100px">
                            </dxe:ASPxTextBox>
                        </td>
                        <td>
                
                Môn thi</td>
                        <td>
                
                            <dxe:ASPxComboBox ID="cboMonThi" runat="server">
                            </dxe:ASPxComboBox>
                        </td>
                    </tr>
                    <tr>
                        <td>
                
                Ghi chú</td>
                        <td colspan="5">
                
                            <dxe:ASPxTextBox ID="txtGhiChu" runat="server" Width="370px">
                            </dxe:ASPxTextBox>
                        </td>
                    </tr>
                </table>
                        </td>
            <td with="100%" style="height: 27px;" valign="top">
                
                            &nbsp;</td>
                    </tr>
                    <tr>
            <td with="100%" style="width: 65px; height: 9px;" valign="top">
                
                        </td>
            <td with="100%" style="height: 9px;" valign="top">
                
                        </td>
            <td with="100%" style="width: 192px; height: 9px;" valign="top">
                
                        </td>
            <td with="100%" style="width: 369px; height: 9px;" valign="top">
                
                        </td>
            <td with="100%" style="width: 275px; height: 9px;" valign="top">
                
                        </td>
            <td with="100%" style="height: 9px;" valign="top">
                
                        </td>
                    </tr>
                    <tr>
            <td with="100%" style="height: 157px;" valign="top" colspan="3">
                
                <table style="width: 100%">
                    <tr>
                        <td style="width: 423px">
                
                <dxwtl:ASPxTreeList ID="treeLoai" runat="server" AutoGenerateColumns="False" 
                    onfocusednodechanged="treeLoai_FocusedNodeChanged" Height="174px" Width="332px">
                    <Columns>
                        <dxwtl:TreeListTextColumn Caption="Loại câu hỏi" FieldName="Ten" Name="Ten" 
                            VisibleIndex="0" Width="200px">
                        </dxwtl:TreeListTextColumn>
                    </Columns>
                </dxwtl:ASPxTreeList>
                
                        </td>
                        <td valign="top">
                            <i><b>Số câu:</b></i><br />
                            <div style="float:left;width: 32px;">
                              <dxe:ASPxTextBox ID="txtSoCauHoi" runat="server" Width="30px" 
                                    HorizontalAlign="Right">
                                <Paddings PaddingRight="5px" />
                            </dxe:ASPxTextBox>
                            </div>
                            <div style="float:left;width: 5px;padding-top:2px">/
                            </div>               
                            <div style="float:left; height: 26px;padding-top:2px"><dxe:ASPxLabel ID="lbTongSoCau" 
                                    runat="server" Text="100" 
                                    Font-Bold="True" ForeColor="Red">
                            </dxe:ASPxLabel>                
                            </div>
                                <br />
                            
                                <dxe:ASPxButton ID="btnAdd" CssClass="Button" runat="server" 
                                    Text="Add" onclick="btnAdd_Click" Width="90px" 
                                HorizontalAlign="Left"  >
                                    <Image Url="~/images/Addnew.png" />
                            </dxe:ASPxButton>
                            <br />
                                <dxe:ASPxButton ID="btnRemove" CssClass="Button" runat="server" 
                                    Text="Remove" onclick="btnRemove_Click" Width="90px" HorizontalAlign="Left" 
                                 >
                                    <Image Url="~/images/reject.png" />
                            </dxe:ASPxButton>
                            
                        </td>
                    </tr>
                </table>
                
            </td>
            <td with="100%" valign="top" style="height: 157px; margin-left: 40px" colspan="3">
                
                <table style="width: 100%">
                    <tr>
                        <td>
                
                <dxwgv:ASPxGridView ID="gvListData" ClientInstanceName="gvListData" 
                    runat="server" AutoGenerateColumns="False" Width="590px" 
                                ondatabound="gvListData_DataBound" onprerender="gvListData_PreRender" >
                    <SettingsBehavior AllowFocusedRow="True" ColumnResizeMode="Control" />
                    <Styles> <Cell CssClass="gvCell"> </Cell>
                        <FocusedRow BackColor="#99CCFF">
                        </FocusedRow>
                    </Styles>
                    <SettingsPager PageSize="100"></SettingsPager><Columns>
                        <dxwgv:GridViewDataTextColumn Caption="TT" VisibleIndex="0" Width="30px"  Name="colTT">
</dxwgv:GridViewDataTextColumn>
                        <dxwgv:GridViewCommandColumn VisibleIndex="0" ButtonType="Image" 
                            ShowSelectCheckbox="True" Width="30px" />
                        <dxwgv:GridViewDataTextColumn Caption="Id" FieldName="Id" Name="Id" 
                            Visible="False" VisibleIndex="1">
                        </dxwgv:GridViewDataTextColumn>
                        <dxwgv:GridViewDataTextColumn Caption="Tên loại câu hỏi" 
                            FieldName="TenLoaiCauHoi" Name="TenLoaiCauHoi" VisibleIndex="1" Width="400px">
                        </dxwgv:GridViewDataTextColumn>
                        <dxwgv:GridViewDataTextColumn Caption="Số câu" FieldName="SoCauHoi" 
                            Name="SoCau" VisibleIndex="2" Width="120px">
                        </dxwgv:GridViewDataTextColumn>
                    </Columns>
                    <Settings ShowHorizontalScrollBar="True" 
                        ShowFilterRowMenu="True" />
                </dxwgv:ASPxGridView>
                
                        </td>
                    </tr>
                    <tr>
                        <td>
                
                            <div style="float:left; margin-right: 10px; width: 103px;">
                                <dxe:ASPxButton ID="btnUp" runat="server" CssClass="Button" 
                                    onclick="btnUp_Click" Text="Lên trên"  Width="100px" 
                                    HorizontalAlign="Left" >
                                    <Image Url="~/images/up.jpg" />
                                </dxe:ASPxButton>
                            </div>
                            <div style="float:left; margin-right: 10px; width: 110px;">
                                <dxe:ASPxButton ID="btnDown" runat="server" CssClass="Button" 
                                    onclick="btnDown_Click" Text="Xuống dưới"  
                                    Width="110px" HorizontalAlign="Left" >
                                    <Image Url="~/images/Down.png" />
                                </dxe:ASPxButton>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            &nbsp;</td>
                        <td align="left" style="width: 566px" colspan="3">
                            &nbsp;</td>
                    </tr>                                                                                                                 
                    <tr>
                        <td colspan="3">
                            <asp:HiddenField ID="txtId" runat="server" />
                            <asp:HiddenField ID="hdIdLoaiCauHoi" runat="server" />
                        </td>
                        <td align="left" style="width: 566px" colspan="3">
                            <div style="float:left; margin-right: 10px; width: 104px;">
                                <dxe:ASPxButton ID="btnCapNhat" CssClass="Button" runat="server" 
                                    Text="Cập nhật" onclick="btnCapNhat_Click"  
                                    Width="100px" HorizontalAlign="Left" >
                                    <Image Height="18px" Url="~/images/accept.png" />
                                </dxe:ASPxButton>
                            </div>                   
                            <div style="float:left;">                 
                                <dxe:ASPxButton ID="btnThoat" CssClass="Button" runat="server" Text="Thoát" 
                                    onclick="btnThoat_Click" HorizontalAlign="Left"  >
                                    <Image Url="~/images/exit.png" />
                                </dxe:ASPxButton>
                            </div>                   
                        </td>
                    </tr>                                                                                                                 
                    <tr>
                        <td colspan="3">
                            &nbsp;</td>
                        <td align="left" style="width: 566px" colspan="3">
                            &nbsp;</td>
                    </tr>                                                                                                                 
                </table>
            </td>
        </tr>
    </table>
</asp:Content>

