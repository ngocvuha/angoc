<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="LoaiCauHoi, App_Web_x6nppie8" title="Untitled Page" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxTreeList.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxTreeList" tagprefix="dxwtl" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.Web.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHiddenField" tagprefix="dxhf" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">        
            Quản lý loại câu hỏi<asp:HiddenField ID="hdMaLoaiCauHoi" runat="server" />
            </div><br />
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom:15px;"
        width="100%" align="center">
        <tr>
            <td with="100%" style="width: 299px" rowspan="3" valign="top">
                
                <dxwtl:ASPxTreeList ID="treeLoai" runat="server" AutoGenerateColumns="False" 
                    onfocusednodechanged="treeLoai_FocusedNodeChanged" Width="277px">
                    <Columns>
                        <dxwtl:TreeListTextColumn Caption="Loại câu hỏi" FieldName="Ten" Name="Ten" 
                            VisibleIndex="0" Width="200px">
                        </dxwtl:TreeListTextColumn>
                    </Columns>
                </dxwtl:ASPxTreeList>
                
            </td>
            <td with="100%" align="center" valign=top style="text-align: left" 
                height="25px">
                            <div style="float:left; margin-right: 4px; width: 90px;">
                                <dxe:ASPxButton ID="btnRoot" CssClass="Button" runat="server" 
                                    Text="Đến gốc" onclick="btnRoot_Click" HorizontalAlign="Left" >
                                    <Image Url="~/images/top.png" />
                                </dxe:ASPxButton>
                            </div>
                            <div style="float:left; margin-right: 4px; width: 90px;">
                                <dxe:ASPxButton ID="btnChiTiet" CssClass="Button" runat="server" 
                                    Text="Chi tiết" onclick="btnChiTiet_Click" HorizontalAlign="Left"   >
                                    <Image Url="~/images/Detail.png" />
                                </dxe:ASPxButton>
                            </div>
                            <div style="float:left; margin-right: 4px; width: 90px;">
                                <dxe:ASPxButton ID="btnThem" CssClass="Button" runat="server" 
                                    Text="Thêm" onclick="btnThem_Click" HorizontalAlign="Left"  >
                                    <Image Url="~/images/Addnew.png" />
                                </dxe:ASPxButton>
                            </div>
                            
                                              
                            <div style="float:left; margin-right: 4px; width: 90px;">
                                <dxe:ASPxButton ID="btnSua" CssClass="Button" runat="server" 
                                    Text="Sửa" onclick="btnSua_Click" HorizontalAlign="Left"  >
                                    <Image Url="~/images/Edit.png" />
                                </dxe:ASPxButton>
                            </div>
                            <div style="float:left; margin-right: 4px; width: 90px;">
                                <dxe:ASPxButton ID="btnXoa" CssClass="Button" runat="server" 
                                    Text="Xóa" onclick="btnXoa_Click" HorizontalAlign="Left" 
                                    ImageSpacing="10px"  >
                                    <Image Url="~/images/delete.gif" />
                                    <ClientSideEvents Click="function(s, e) {e.processOnServer = confirm('Bạn có chắc chắn muốn xóa không!');}" />
                                </dxe:ASPxButton>
                            </div>
                            <div style="float:left; margin-right: 4px; width: 90px;">
                                <dxe:ASPxButton ID="btnThoat" CssClass="Button" runat="server" 
                                    Text="Thoát" onclick="btnThoat_Click" Visible="False" 
                                    HorizontalAlign="Left"  />
                            </div>
                
            </td>
        </tr>
        
        <tr>
            <td with="100%" align="center" 
                style="text-align: left; height: 16px;" 
                valign="bottom">
                
                <dxe:ASPxLabel ID="lbNhan" runat="server" 
                    Text="Danh sách câu hỏi thuộc loại: ">
                </dxe:ASPxLabel>
                
            </td>
        </tr>
        
        <tr>
            <td with="100%" valign="top">
                
                <dxwgv:ASPxGridView ID="gvListData" ClientInstanceName="gvListData" 
                    runat="server" AutoGenerateColumns="False" Width="650px" 
                    oncustomcolumndisplaytext="gvListData_CustomColumnDisplayText" >
                    <SettingsBehavior AllowFocusedRow="True" ColumnResizeMode="Control" />
                    <Styles> <Cell CssClass="gvCell"> </Cell>
                        <FocusedRow BackColor="#99CCFF">
                        </FocusedRow>
                    </Styles>
                    <SettingsPager PageSize="1000"></SettingsPager><Columns>
                        <dxwgv:GridViewDataTextColumn Caption="TT" VisibleIndex="0" Width="30px"  Name="colTT">
</dxwgv:GridViewDataTextColumn>

                        <dxwgv:GridViewCommandColumn VisibleIndex="0" ButtonType="Image" 
                            ShowSelectCheckbox="True" Width="30px" />
                        <dxwgv:GridViewDataTextColumn Caption="Id" FieldName="ID" Name="Id" 
                            Visible="False" VisibleIndex="1">
                        </dxwgv:GridViewDataTextColumn>
                        <dxwgv:GridViewDataTextColumn Caption="Tên" FieldName="Ten" 
                            Name="Ten" VisibleIndex="2" Width="460px">
                        </dxwgv:GridViewDataTextColumn>
                        <dxwgv:GridViewDataTextColumn Caption="Ghi chú" FieldName="GhiChu" 
                            Name="GhiChu" VisibleIndex="3" Width="120px">
                        </dxwgv:GridViewDataTextColumn>
                    </Columns>
                    <Settings ShowHorizontalScrollBar="True" 
                        ShowFilterRowMenu="True" />
                </dxwgv:ASPxGridView>
            </td>
        </tr>
        
        <tr>
            <td with="100%" align="center" style="text-align: left" colspan="2">
                &nbsp;</td>
        </tr>
        </table>

</asp:Content>

