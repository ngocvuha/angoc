<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="QLCauTrucDeThi, App_Web_x6nppie8" title="Untitled Page" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxTreeList.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxTreeList" tagprefix="dxwtl" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.Web.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHiddenField" tagprefix="dxhf" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">        
            Quản lý cấu trúc đề thi</div><br />
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom:15px;"
        width="100%" align="center">
        <tr>
            <td with="100%" style="width: 299px" class="HeaderTitles">
                
                Danh sách cấu trúc đề</td>
            <td with="100%" align="center" style="text-align: left" class="HeaderTitles">
                
                &nbsp;</td>
        </tr>
        
        </tr>
        <tr>
            <td with="100%" style="width: 299px; height: 157px;" valign="top">
                
                <dxe:ASPxListBox ID="lstCauTrucDe" runat="server" Width="395px" Height="390px" 
                    onselectedindexchanged="lstCauTrucDe_SelectedIndexChanged" 
                    AutoPostBack="True">
                </dxe:ASPxListBox>
                <div style="float:left; margin-right: 4px; width: 87px;">
                                <dxe:ASPxButton ID="btnChiTiet" CssClass="Button" runat="server" 
                                    Text="Chi tiết" onclick="btnChiTiet_Click" Width="85px" 
                                    HorizontalAlign="Left"   >
                                    <Image Url="~/images/Detail.png" />
                                </dxe:ASPxButton>
                            </div>
                            <div style="float:left; margin-right: 2px; width: 84px;">
                                <dxe:ASPxButton ID="btnThem" CssClass="Button" runat="server" 
                                    Text="Thêm" onclick="btnThem_Click" Width="80px" HorizontalAlign="Left"  >
                                    <Image Url="~/images/Addnew.png" />
                                </dxe:ASPxButton>
                            </div>
                            
                                              
                            <div style="float:left; margin-right: 4px; width: 84px;">
                                <dxe:ASPxButton ID="btnSua" CssClass="Button" runat="server" 
                                    Text="Sửa" onclick="btnSua_Click" Width="85px" HorizontalAlign="Left"  >
                                    <Image Url="~/images/Edit.png" />
                                </dxe:ASPxButton>
                            </div>
                            <div style="float:left; margin-right: 4px; width: 76px;">
                                <dxe:ASPxButton ID="btnXoa" CssClass="Button" runat="server" 
                                    Text="Xóa" onclick="btnXoa_Click" Width="85px" HorizontalAlign="Left"  >
                                    <Image Url="~/images/delete.gif" />
                                    <ClientSideEvents Click="function(s, e) {e.processOnServer = confirm('Bạn có chắc chắn muốn xóa không!');}" />
                                </dxe:ASPxButton>
                            </div>
                            <div style="float:left; margin-right: 4px; width: 82px;">
                                <dxe:ASPxButton ID="btnThoat" CssClass="Button" runat="server" 
                                    Text="Thoát" onclick="btnThoat_Click" Width="75px" Visible="False"  />
                            </div>
            </td>
            <td with="100%" valign="top" style="height: 157px; margin-left: 40px">
                
                <table style="width: 100%">
                    <tr>
                        <td style="width: 218px">
                            Thời gian làm bài:
                        </td>
                        <td style="width: 101px">
                            <dxe:ASPxTextBox ID="txtThoiGianLamBai" runat="server" Width="100px">
                            </dxe:ASPxTextBox>
                        </td>
                        <td style="width: 136px">
                            Môn thi</td>
                        <td>
                            <dxe:ASPxComboBox ID="cboMonThi" runat="server">
                            </dxe:ASPxComboBox>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 218px">
                            Ghi chú</td>
                        <td colspan="3">
                            <dxe:ASPxTextBox ID="txtGhiChu" runat="server" Width="470px">
                            </dxe:ASPxTextBox>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                
                <dxe:ASPxLabel ID="lbNhan" runat="server" 
                    Text="Danh sách loại câu hỏi thuộc cấu trúc đề:">
                </dxe:ASPxLabel>
                
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                
                <dxwgv:ASPxGridView ID="gvListData" ClientInstanceName="gvListData" 
                    runat="server" AutoGenerateColumns="False" Width="590px" 
                                oncustomcolumndisplaytext="gvListData_CustomColumnDisplayText" >
                    <SettingsBehavior AllowFocusedRow="True" ColumnResizeMode="Control" />
                    <Styles> <Cell CssClass="gvCell"> </Cell>
                        <FocusedRow BackColor="#99CCFF">
                        </FocusedRow>
                    </Styles>
                    <SettingsPager PageSize="1000"></SettingsPager><Columns>
                        <dxwgv:GridViewDataTextColumn Caption="TT" VisibleIndex="0" Width="30px"  Name="colTT">
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
                </table>
            </td>
        </tr>
        
        <tr>
            <td with="100%" valign="top" colspan="2">
                
                            
                
            </td>
        </tr>
        
        <tr>
            <td with="100%" align="center" style="text-align: left" colspan="2">
                
                &nbsp;</td>
        </tr>
        </table>

</asp:Content>

