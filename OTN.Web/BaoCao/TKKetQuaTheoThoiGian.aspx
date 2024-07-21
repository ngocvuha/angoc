<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="TKKetQuaTheoThoiGian, App_Web_zgkkpm8a" title="Untitled Page" enablesessionstate="True" trace="false" %>

<%@ Register Assembly="DevExpress.XtraCharts.v9.2.Web, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a"
    Namespace="DevExpress.XtraCharts.Web" TagPrefix="dxchartsui" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2.Export, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView.Export" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.XtraCharts.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.XtraCharts" tagprefix="cc1" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">
        <div style="float:left"> Thống kê dữ liệu theo thời gian</div>
                                
    </div>
    <table style="width: 700px">
        <tr>
            <td style="width: 39px">
                <dxe:ASPxRadioButton ID="opt1" runat="server" Checked="True" GroupName="chon">
                </dxe:ASPxRadioButton>
            </td>
            <td style="width: 94px">
                Ngày</td>
            <td>
                <dxe:ASPxDateEdit ID="dtNgay" runat="server" 
                    DisplayFormatString="dd/MM/yyyy" EditFormatString="dd/MM/yyyy" 
                    Width="110px">
                </dxe:ASPxDateEdit>
            </td>
        </tr>
        <tr>
            <td style="width: 39px">
                <dxe:ASPxRadioButton ID="opt2" runat="server" GroupName="chon">
                </dxe:ASPxRadioButton>
            </td>
            <td style="width: 94px">
                Tháng</td>
            <td>
                <div style="float:left;margin-right:10px">
                <dxe:ASPxComboBox ID="cboThang" runat="server" SelectedIndex="0" 
                    ValueType="System.String" Width="50px">
                    <Items>
                        <dxe:ListEditItem Selected="True" Text="[All]" Value="0" />
                        <dxe:ListEditItem Text="1" Value="1" />
                        <dxe:ListEditItem Text="2" Value="2" />
                        <dxe:ListEditItem Text="3" Value="3" />
                        <dxe:ListEditItem Text="4" Value="4" />
                        <dxe:ListEditItem Text="5" Value="5" />
                        <dxe:ListEditItem Text="6" Value="6" />
                        <dxe:ListEditItem Text="7" Value="7" />
                        <dxe:ListEditItem Text="8" Value="8" />
                        <dxe:ListEditItem Text="9" Value="9" />
                        <dxe:ListEditItem Text="10" Value="10" />
                        <dxe:ListEditItem Text="11" Value="11" />
                        <dxe:ListEditItem Text="12" Value="12" />
                    </Items>
                </dxe:ASPxComboBox>
                </div>
                <dxe:ASPxSpinEdit ID="spinNam" runat="server" Height="21px" Number="0" 
                    Width="70px" />
            </td>
        </tr>
        <tr>
            <td style="width: 39px">
                <dxe:ASPxRadioButton ID="opt3" runat="server" GroupName="chon">
                </dxe:ASPxRadioButton>
            </td>
            <td style="width: 94px">
                Tùy chọn</td>
            <td>
            <div style="float:left">
                <dxe:ASPxDateEdit ID="dtTuNgay" runat="server" 
                    DisplayFormatString="dd/MM/yyyy" EditFormatString="dd/MM/yyyy" 
                    Width="110px">
                </dxe:ASPxDateEdit>
            </div>
            <div style="float:left;padding:0 5px 0 5px;">
                ->
            </div>
            <div style="float:left">
                <dxe:ASPxDateEdit ID="dtDenNgay" runat="server" 
                    DisplayFormatString="dd/MM/yyyy" EditFormatString="dd/MM/yyyy" 
                    Width="110px">
                </dxe:ASPxDateEdit>
            </div>
            </td>
        </tr>
        <tr>
            <td style="width: 39px">
                &nbsp;</td>
            <td style="width: 94px">
            <dxe:ASPxButton ID="btnChon" CssClass="Button" runat="server" Text="Thống kê" 
                                    onclick="btnChon_Click" Visible="True" Width="100px" 
                HorizontalAlign="Left" >
                <Image Url="~/images/search.png" />
            </dxe:ASPxButton>
            </td>
            <td>
                &nbsp;</td>
        </tr>
    </table>
&nbsp;<div style="clear:left"></div>
    <div>
        <dxe:ASPxLabel ID="lbTongSo" runat="server" Font-Bold="True" Font-Italic="True" 
            Text="  ">
        </dxe:ASPxLabel>
            
    </div>
    <div style="float:left;padding-right:100px">
    <dxwgv:ASPxGridView ID="gView" runat="server" 
        AutoGenerateColumns="False" KeyFieldName="IDDuThi" 
            oncustomcolumndisplaytext="gView_CustomColumnDisplayText">
        <SettingsPager PageSize="1000">
        </SettingsPager>
        <Columns>
            <dxwgv:GridViewDataTextColumn Caption="TT" Name="TT" VisibleIndex="0" 
                Width="30px">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <CellStyle HorizontalAlign="Right">
                </CellStyle>
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Xếp loại" FieldName="XepLoai" Name="XepLoai" 
                VisibleIndex="1" Width="100px">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <CellStyle HorizontalAlign="Center">
                </CellStyle>
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Số lượng" FieldName="SL" 
                Name="SL" VisibleIndex="2" Width="90px">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataDateColumn Caption="Tỉ lệ" FieldName="TiLe" 
                Name="TiLe" VisibleIndex="3" Width="70px">
                <PropertiesDateEdit DisplayFormatString="dd/MM/yyyy">
                </PropertiesDateEdit>
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <CellStyle HorizontalAlign="Right">
                </CellStyle>
            </dxwgv:GridViewDataDateColumn>
        </Columns>
    </dxwgv:ASPxGridView>
    </div>    
    <div>
     <dxchartsui:webchartcontrol ID="ChartKQ" runat="server" Height="300px" 
         Width="450px">
     </dxchartsui:webchartcontrol>
    </div>    
</asp:Content>


