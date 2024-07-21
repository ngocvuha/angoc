<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="InKetQuaCaNhan, App_Web_5qgdzao-" title="Untitled Page" enablesessionstate="True" trace="false" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2.Export, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView.Export" tagprefix="dxwgv" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">
        <div style="float:left"> Đợt thi</div><div style="float:left">
        <dxe:ASPxComboBox ID="cboPhongThi" runat="server" Width="448px" 
            onselectedindexchanged="cboPhongThi_SelectedIndexChanged" 
            AutoPostBack="True">
        </dxe:ASPxComboBox>
        
        </div>
        <div style="float:left; width:84px">
            <dxe:ASPxCheckBox ID="chkDaThi" runat="server" Checked="True" Text="Đã thi" 
                Visible="False">
            </dxe:ASPxCheckBox>
         </div>
         <div style="float:left; width:102px">
            <dxe:ASPxCheckBox ID="chkChuaThi" runat="server" Checked="True" Text="Chưa thi" 
                 Visible="False">
            </dxe:ASPxCheckBox>
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
    <div style="float:left; width:700px; padding-top:5px">
        <dxe:ASPxLabel ID="lbTongSo" runat="server" Font-Bold="True" Font-Italic="True" 
            Text="  ">
        </dxe:ASPxLabel>
            
    </div>
    <div style="float:left; width:90px">
            <dxe:ASPxButton ID="btnExportToExcel" CssClass="Button" runat="server" 
                Text="Excel" onclick="btnExportToExcel_Click" HorizontalAlign="Left" 
                Width="25px">
                <Image Url="~/images/excel.png" />
            </dxe:ASPxButton>
    </div>
    <div style="float:left; width:90px">
            <dxe:ASPxButton ID="btnExportToWord" CssClass="Button" runat="server" 
                Text="Word" onclick="btnExportToWord_Click" 
                Width="70px" HorizontalAlign="Left">
                <Image Url="~/images/Word.png" />
            </dxe:ASPxButton>
    </div>
    <div>
            <dxe:ASPxButton ID="btnExportToPDF" CssClass="Button" runat="server" 
                Text="PDF" onclick="btnExportToPDF_Click" 
                Width="70px" HorizontalAlign="Left">
                <Image Url="~/images/pdf.png" />
            </dxe:ASPxButton>
    </div>
        
 </div>
 
    <div>
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
            <dxwgv:GridViewDataTextColumn Caption="CMT" FieldName="SBD" Name="SBD" 
                VisibleIndex="1" Width="120px">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <CellStyle HorizontalAlign="Center">
                </CellStyle>
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Họ và tên" FieldName="HoTen" 
                Name="HoTen" VisibleIndex="2" Width="200px">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataDateColumn Caption="Ngày sinh" FieldName="NgaySinh" 
                Name="NgaySinh" VisibleIndex="3" Width="70px">
                <PropertiesDateEdit DisplayFormatString="dd/MM/yyyy">
                </PropertiesDateEdit>
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <CellStyle HorizontalAlign="Center">
                </CellStyle>
            </dxwgv:GridViewDataDateColumn>
            <dxwgv:GridViewDataTextColumn Caption="Giới tính" FieldName="GioiTinh" 
                Name="GioiTinh" VisibleIndex="4" Width="40px">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <CellStyle HorizontalAlign="Center">
                </CellStyle>
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Tên lớp" FieldName="TenLop" 
                Name="TenLop" VisibleIndex="5" Width="250px">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Điểm thi" FieldName="Diem" Name="Diem" 
                VisibleIndex="6" Width="70px">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <CellStyle HorizontalAlign="Right">
                </CellStyle>
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="" Name="In" VisibleIndex="7" 
                Width="70px">
                
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <CellStyle HorizontalAlign="Center">
                </CellStyle>
                <DataItemTemplate>
                    <a id="clickElement" target="_blank" href="InKetQuaCaNhanCTiet.aspx?id=<%# Container.KeyValue%>">
                    <img alt="In" height="20" src="../images/print.png" />  
                    </a>
                </DataItemTemplate>
            </dxwgv:GridViewDataTextColumn>
        </Columns>
    </dxwgv:ASPxGridView>
    </div>    
    
</asp:Content>

