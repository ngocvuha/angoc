<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="TKKetQuaTheoDeThi, App_Web_5qgdzao-" title="Untitled Page" enablesessionstate="True" trace="false" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2.Export, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView.Export" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.XtraCharts.v9.2.Web, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.XtraCharts.Web" tagprefix="dxchartsui" %>
<%@ Register assembly="DevExpress.XtraCharts.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.XtraCharts" tagprefix="cc1" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">
        <div style="float:left; padding-right: 10px;"> Đề thi</div><div style="float:left">
        <dxe:ASPxComboBox ID="cboDeThi" runat="server" Width="448px" 
            onselectedindexchanged="cboPhongThi_SelectedIndexChanged" 
            AutoPostBack="True">
        </dxe:ASPxComboBox>
        
        </div>
         <div style="float:left; width:102px">
         </div>
        <div style="float:left; width:100px">
            <dxe:ASPxButton ID="btnChon" CssClass="Button" runat="server" Text="Chọn" 
                                    onclick="btnChon_Click" Visible="True" Width="70px" 
                HorizontalAlign="Left" >
                <Image Url="~/images/search.png" />
            </dxe:ASPxButton>
        </div>
        <div style="float:left;">                 
                                <dxe:ASPxButton ID="btnThoat" CssClass="Button" runat="server" Text="Thoát" 
                                    onclick="btnThoat_Click" Visible="False" />
        </div>
                                
    </div>
    <div>
    <div>
    </div>
        
 </div>
 <div style="clear:left"></div>
 <div>
     <dxe:ASPxLabel ID="lbNhan" runat="server" Text="" Font-Bold="True" 
         Font-Size="Large" Height="30px">
     </dxe:ASPxLabel>
  </div>
<div style="float:left;padding-right:50px">
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
     <dxchartsui:WebChartControl ID="ChartKQ" runat="server" Height="300px" 
         Width="450px">
     </dxchartsui:WebChartControl>
    </div>        
    
</asp:Content>

