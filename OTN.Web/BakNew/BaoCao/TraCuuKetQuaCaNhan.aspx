<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="TraCuuKetQuaCaNhan, App_Web_5qgdzao-" title="Untitled Page" enablesessionstate="True" trace="false" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2.Export, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView.Export" tagprefix="dxwgv" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">
        <div style="float:left"> Tra cứu kết quả cá nhân:
            <dxe:ASPxLabel ID="ASPxLabel1" runat="server" ForeColor="#6600FF" Text="Số CMT" 
                Width="50px">
            </dxe:ASPxLabel>
        </div>
        <div style="float:left;padding-right:10px">
            <dxe:ASPxTextBox ID="txtSoCMT" runat="server" Width="170px" ForeColor="#6600FF" 
                Height="25px">
            </dxe:ASPxTextBox>
        
        </div>
        <div style="float:left; width:100px">
            <dxe:ASPxButton ID="btnChon" CssClass="Button" runat="server" Text="Tra cứu" 
                                    onclick="btnChon_Click" Visible="True" Width="90px" 
                HorizontalAlign="Left" Height="15px" >
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
    <div>
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
            <dxwgv:GridViewDataTextColumn Caption="SBD" FieldName="SBD" Name="SBD" 
                VisibleIndex="1" Width="120px">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <CellStyle HorizontalAlign="Center">
                </CellStyle>
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Họ và tên" FieldName="HoTen" 
                Name="HoTen" VisibleIndex="2" Width="150px">
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
            <dxwgv:GridViewDataTextColumn Caption="CMT" FieldName="CMT" 
                Name="CMT" VisibleIndex="5" Width="110px">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Điểm thi" FieldName="Diem" Name="Diem" 
                VisibleIndex="6" Width="70px">
                <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                <CellStyle HorizontalAlign="Right">
                </CellStyle>
            </dxwgv:GridViewDataTextColumn>
            <dxwgv:GridViewDataTextColumn Caption="Đợt thi" Name="DotThi" VisibleIndex="7" 
                Width="300px" FieldName="DotThi">
             <HeaderStyle Font-Bold="True" HorizontalAlign="Center" />
                
            </dxwgv:GridViewDataTextColumn>
        </Columns>
    </dxwgv:ASPxGridView>
    </div>    
    
</asp:Content>

