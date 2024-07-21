<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="QLCauHoi, App_Web_x6nppie8" title="Untitled Page" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxTreeList.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxTreeList" tagprefix="dxwtl" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.Web.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHiddenField" tagprefix="dxhf" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">        
            Quản lý câu hỏi</div><br />
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom:15px;"
        width="100%" align="center">
        <tr>
            <td with="100%" style="width: 299px" rowspan="6" valign="top">
                
                <dxwtl:ASPxTreeList ID="treeLoai" runat="server" AutoGenerateColumns="False" 
                    onfocusednodechanged="treeLoai_FocusedNodeChanged" Width="275px">
                    <Columns>
                        <dxwtl:TreeListTextColumn Caption="Loại câu hỏi" FieldName="Ten" Name="Ten" 
                            VisibleIndex="0" Width="200px">
                        </dxwtl:TreeListTextColumn>
                    </Columns>
                </dxwtl:ASPxTreeList>
                
            </td>
            <td with="100%" align="center" style="text-align: left; height: 32px;">
                            
                            <div style="float:left; margin-right: 4px; width: 103px;">
                                <dxe:ASPxButton ID="btnAddMultiChoice" CssClass="Button" runat="server" 
                                    Text="Trắc nghiệm" onclick="btnAddMultiChoice_Click" Height="29px" 
                                    Width="100px"  />
                            </div>
                            <div style="float:left; margin-right: 4px; width: 103px;">
                                <dxe:ASPxButton ID="btnAddFill_In_Blank" CssClass="Button" runat="server" 
                                    Text="Điền khuyết" onclick="btnAddFill_In_Blank_Click" Height="29px" 
                                    Width="100px"  />
                            </div>
                            <div style="float:left; margin-right: 4px; width: 103px;">
                                <dxe:ASPxButton ID="btnAddMatching" CssClass="Button" runat="server" 
                                    Text="Ghép đôi" onclick="btnAddMatching_Click" Width="100px" 
                                    Height="29px"  />
                            </div>
                            <div style="float:left; margin-right: 4px; width: 103px;">
                                <dxe:ASPxButton ID="btnShortAnswer" CssClass="Button" runat="server" 
                                    Text="Short Answer" Width="100px" onclick="btnShortAnswer_Click" 
                                    Height="29px" />
                            </div>
                            <div style="float:left; margin-right: 4px; width: 103px;">
                                <dxe:ASPxButton ID="btnWritting" CssClass="Button" runat="server" 
                                    Text="Writting" Width="100px" onclick="btnWritting_Click" Height="29px"  />
                            </div>
                            <div style="float:left; margin-right: 4px; width: 103px;">
                                <dxe:ASPxButton ID="btnSorting" CssClass="Button" runat="server" 
                                    Text="Sorting" Width="100px" Height="29px" onclick="btnSorting_Click"  />
                            </div>
            </td>
        </tr>
        
        <tr>
            <td with="100%" align="center" style="text-align: left; height: 32px;">
                            <div style="float:left; margin-right: 4px; width: 103px;">
                                <dxe:ASPxButton ID="btnChiTiet" CssClass="Button" runat="server" 
                                    Text="Chi tiết" onclick="btnChiTiet_Click" Width="100px" 
                                    HorizontalAlign="Left" Height="25px"   >
                                    <Image Url="~/images/Detail.png" />
                                </dxe:ASPxButton>
                            </div>
                                              
                            <div style="float:left; margin-right: 4px; width: 103px;">
                                <dxe:ASPxButton ID="btnSua" CssClass="Button" runat="server" 
                                    Text="Sửa" onclick="btnSua_Click" Width="100px" HorizontalAlign="Left"  >
                                    <Image Url="~/images/Edit.png" />
                                </dxe:ASPxButton>
                            </div>
                            <div style="float:left; margin-right: 4px; width: 103px;">
                                <dxe:ASPxButton ID="btnXoa" CssClass="Button" runat="server" 
                                    Text="Xóa" onclick="btnXoa_Click" Width="100px" HorizontalAlign="Left" >
                                    <Image Url="~/images/delete.gif" />
                                   <ClientSideEvents Click="function(s, e) {e.processOnServer = confirm('Bạn có chắc chắn muốn xóa không!');}" />
                                    
                                </dxe:ASPxButton>
                            </div>
              </td>
        </tr>
        
        <tr>
            <td with="100%" align="center" 
                style="text-align: left; height: 18px;" 
                valign="bottom">
                
                <dxe:ASPxLabel ID="lbNhan" runat="server" 
                    Text="Danh sách câu hỏi thuộc loại: " Font-Bold="True">
                </dxe:ASPxLabel>
                
            </td>
        </tr>
        
        </tr>
        
        <tr>
            <td with="100%" align="center" 
                style="text-align: left; height: 19px;" 
                valign="bottom">
                <div style="float:left; width: 100px">
                <dxe:ASPxCheckBox ID="chkTracNghiem" runat="server" Text="Trắc nghiệm" AutoPostBack="True"
                        Checked="True" oncheckedchanged="btnLoc_Click">
                </dxe:ASPxCheckBox>
                </div>
                <div style="float:left; width: 105px">
                <dxe:ASPxCheckBox ID="chkDienKhuyet" runat="server" Text="Điền khuyết" 
                        Checked="True" AutoPostBack="True" oncheckedchanged="btnLoc_Click">
                </dxe:ASPxCheckBox>
                </div>
                <div style="float:left; width: 85px">
                <dxe:ASPxCheckBox ID="chkGhepDoi" runat="server" Text="Ghép đôi" Checked="True" 
                        oncheckedchanged="btnLoc_Click" AutoPostBack="True">
                </dxe:ASPxCheckBox>
                </div>
                <div style="float:left;width: 110px">
                <dxe:ASPxCheckBox ID="chkShortAnswer" runat="server" Text="Short Answer" 
                        Checked="True" AutoPostBack="True" oncheckedchanged="btnLoc_Click">
                </dxe:ASPxCheckBox>
                </div>
                <div style="float:left;width: 80px">
                <dxe:ASPxCheckBox ID="chkWritting" runat="server" Text="Writting" 
                        Checked="True" AutoPostBack="True" oncheckedchanged="btnLoc_Click">
                </dxe:ASPxCheckBox>
                </div>
                <div style="float:left;width: 100px">
                <dxe:ASPxCheckBox ID="chkSorting" runat="server" Text="Sorting" 
                        Checked="True" AutoPostBack="True" oncheckedchanged="btnLoc_Click">
                </dxe:ASPxCheckBox>
                </div>
            &nbsp;<div style="float:left; margin-right: 4px; width: 83px;">
                                <dxe:ASPxButton ID="btnLoc" CssClass="Button" runat="server" 
                                    Text="Tìm kiếm" onclick="btnLoc_Click" Width="92px" 
                                    HorizontalAlign="Left"   >
                                    <Image Url="~/images/search.png" />
                                </dxe:ASPxButton>
                            </div>
                                              
            </td>
        </tr>
        
        <tr>
            <td with="100%" align="center" 
                style="text-align: left; height: 19px;" 
                valign="bottom">
                            <dxe:ASPxTextBox ID="txtTen" runat="server" Width="670px">
                            </dxe:ASPxTextBox>
                                              
            </td>
        </tr>
        
        <tr>
            <td with="100%" valign="top">
                
                <dxwgv:ASPxGridView ID="gvListData" ClientInstanceName="gvListData" 
                    runat="server" AutoGenerateColumns="False" Width="673px" 
                    oncustomcolumndisplaytext="gvListData_CustomColumnDisplayText" >
                    <SettingsBehavior AllowFocusedRow="True" ColumnResizeMode="Control" />
                    <Styles> <Cell CssClass="gvCell"> </Cell>
                        <FocusedRow BackColor="#99CCFF">
                        </FocusedRow>
                    </Styles>
                    <SettingsPager PageSize="1000" Position="Top"></SettingsPager><Columns>
                        <dxwgv:GridViewDataTextColumn Caption="TT" VisibleIndex="0" Width="30px"  Name="colTT">
</dxwgv:GridViewDataTextColumn>

                        <dxwgv:GridViewCommandColumn VisibleIndex="0" ButtonType="Image" 
                            ShowSelectCheckbox="True" Width="30px" />
                        <dxwgv:GridViewDataTextColumn Caption="Id" FieldName="ID" Name="Id" 
                            Visible="False" VisibleIndex="1">
                        </dxwgv:GridViewDataTextColumn>
                        <dxwgv:GridViewDataTextColumn Caption="Tên" FieldName="Ten" 
                            Name="Ten" VisibleIndex="2" Width="480px">
                        </dxwgv:GridViewDataTextColumn>
                        <dxwgv:GridViewDataTextColumn Caption="Kiểu câu hỏi" FieldName="TenCachHoi" 
                            Name="TenCachHoi" VisibleIndex="3" Width="125px">
                        </dxwgv:GridViewDataTextColumn>
                    </Columns>
                    <Settings ShowHorizontalScrollBar="True" 
                        ShowFilterRowMenu="True" />
                </dxwgv:ASPxGridView>
            </td>
        </tr>
        
        <tr>
            <td with="100%" align="center" style="text-align: left" colspan="2">
                
                <asp:HiddenField ID="hdIdLoaiCauHoi" runat="server" />
            </td>
        </tr>
        </table>

</asp:Content>

