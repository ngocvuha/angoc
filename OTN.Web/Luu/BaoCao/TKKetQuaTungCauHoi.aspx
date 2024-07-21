<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="TKKetQuaTungCauHoi, App_Web_zgkkpm8a" title="Untitled Page" enablesessionstate="True" trace="false" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2.Export, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView.Export" tagprefix="dxwgv" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">
        Thống kê kết quả từng câu hỏi</div>
    <div>
    <div>
            <table style="width: 1000px">
                <tr>
                    <td style="width: 83px">
                        Đề thi</td>
                    <td style="width: 520px">
        <dxe:ASPxComboBox ID="cboDeThi" runat="server" Width="448px" 
            onselectedindexchanged="cboDeThi_SelectedIndexChanged" 
            AutoPostBack="True">
        </dxe:ASPxComboBox>
        
                    </td>
                    <td>
                        &nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 83px">
                        Phòng thi</td>
                    <td style="width: 520px">
        <dxe:ASPxComboBox ID="cboPhongThi" runat="server" Width="448px">
        </dxe:ASPxComboBox>
        
                    </td>
                    <td>
                        &nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 83px">
                        Loại câu hỏi</td>
                    <td style="width: 520px">
        <dxe:ASPxComboBox ID="cboLoaiCauHoi" runat="server" Width="448px">
        </dxe:ASPxComboBox>
        
                    </td>
                    <td>
                        &nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 83px">
                        Thời gian</td>
                    <td style="width: 520px">
                <div style="float:left">
                <dxe:ASPxDateEdit ID="dtTuNgay" runat="server" 
                    DisplayFormatString="dd/MM/yyyy" EditFormatString="dd/MM/yyyy" 
                    Width="110px">
                </dxe:ASPxDateEdit>
                </div>
                <div style="float:left">
                    -&gt;
                </div>
                <dxe:ASPxDateEdit ID="dtDenNgay" runat="server" 
                    DisplayFormatString="dd/MM/yyyy" EditFormatString="dd/MM/yyyy" 
                    Width="110px">
                </dxe:ASPxDateEdit>
                    </td>
                    <td>
                        &nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 83px">
                        Điểm&nbsp;</td>
                    <td style="width: 520px">
                        <div style="float:left">
                        <dxe:ASPxTextBox ID="txtDiemTu" runat="server" Width="100px">
                        </dxe:ASPxTextBox>
                        </div>
                        <div style="float:left">
                            -&gt;
                        </div>
                        <dxe:ASPxTextBox ID="txtDiemDen" runat="server" Width="100px">
                        </dxe:ASPxTextBox>
                        
                    </td>
                    <td>
                        <div style="float:left; width:100px; height: 25px;">
            <dxe:ASPxButton ID="btnChon" CssClass="Button" runat="server" Text="Chọn" 
                                    onclick="btnChon_Click" Visible="True" Width="70px" 
                HorizontalAlign="Left" >
                <Image Url="~/images/search.png" />
            </dxe:ASPxButton>
        </div>
        <div style="float:left;">                 
    <div style="float:left; width:90px">
            <dxe:ASPxButton ID="btnExportToExcel" CssClass="Button" runat="server" 
                Text="Excel" onclick="btnExportToExcel_Click" HorizontalAlign="Left" 
                Width="25px">
                <Image Url="~/images/excel.png" />
            </dxe:ASPxButton>
    </div>
                                <dxe:ASPxButton ID="btnThoat" CssClass="Button" runat="server" Text="Thoát" 
                                    onclick="btnThoat_Click" Visible="False" />
        </div>
        </td>
                </tr>
            </table>
    </div>
        
 </div>
 
    <div>
    <dxwgv:ASPxGridView ID="gView" runat="server" 
        AutoGenerateColumns="False" KeyFieldName="IDDuThi" 
            oncustomcolumndisplaytext="gView_CustomColumnDisplayText">
        <SettingsPager PageSize="10000">
        </SettingsPager>
        <Columns>
            <dxwgv:GridViewDataTextColumn Caption="TT" Name="TT" VisibleIndex="0" 
                Width="30px">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <CellStyle HorizontalAlign="Right">
                </CellStyle>
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Loại câu hỏi" FieldName="TenLoaiCauHoi" Name="TenLoaiCauHoi" 
                VisibleIndex="1" Width="150px">
                <PropertiesTextEdit EncodeHtml="False">
                </PropertiesTextEdit>
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <CellStyle HorizontalAlign="Left">
                </CellStyle>
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Tên câu hỏi" FieldName="TenCauHoi" 
                Name="TenCauHoi" VisibleIndex="2" Width="150px">
                <PropertiesTextEdit EncodeHtml="False">
                </PropertiesTextEdit>
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
            </dxwgv:GridViewDataTextColumn>
<dxwgv:GridViewDataTextColumn FieldName="NoiDungCauHoi" Width="150px" 
                Caption="Nội dung câu hỏi" VisibleIndex="3">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <PropertiesTextEdit EncodeHtml="False">
                </PropertiesTextEdit>

</dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Nội dung trả lời" FieldName="NoiDungTraLoi" 
                Name="NoiDungTraLoi" VisibleIndex="4" Width="150px">
                <PropertiesTextEdit EncodeHtml="False">
                </PropertiesTextEdit>
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Số lựa chọn" FieldName="SoLuaChon" Name="SoLuaChon" 
                VisibleIndex="5" Width="70px">
                <CellStyle HorizontalAlign="Right">
                </CellStyle>
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Số hiển thị" Name="SoHienThi" VisibleIndex="6" 
                Width="70px" FieldName="SoHienThi">
                
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Là PA đúng" 
                Name="LaPADung" VisibleIndex="7" Width="60px" FieldName="Diem">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
            </dxwgv:GridViewDataTextColumn>
        </Columns>
    </dxwgv:ASPxGridView>
    </div>    
    
</asp:Content>

