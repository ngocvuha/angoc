<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="BangDiemTongHop, App_Web_5qgdzao-" title="Untitled Page" enablesessionstate="True" trace="false" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2.Export, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView.Export" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.XtraReports.v9.2.Web, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.XtraReports.Web" tagprefix="dxxr" %>
<%@ Register assembly="Microsoft.ReportViewer.WebForms, Version=9.0.0.0, Culture=neutral, PublicKeyToken=b03f5f7f11d50a3a" namespace="Microsoft.Reporting.WebForms" tagprefix="rsweb" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
    <div class="HeaderTitles">
        <div style="float:left"> Bảng điểm</div><div style="float:left">
        <dxe:ASPxComboBox ID="cboPhongThi" runat="server" Width="448px" 
            onselectedindexchanged="cboPhongThi_SelectedIndexChanged" 
            AutoPostBack="True">
        </dxe:ASPxComboBox>
        
        </div>
        <div style="float:left; width:84px">
            <dxe:ASPxCheckBox ID="chkDaThi" runat="server" Checked="True" Text="Đã thi">
            </dxe:ASPxCheckBox>
         </div>
         <div style="float:left; width:102px">
            <dxe:ASPxCheckBox ID="chkChuaThi" runat="server" Checked="True" Text="Chưa thi">
            </dxe:ASPxCheckBox>
         </div>
        <div style="float:left; width:100px">
            <dxe:ASPxButton ID="btnChon" CssClass="Button" runat="server" Text="Chọn" 
                                    onclick="btnChon_Click" Visible="True" />
        </div>
        <div style="float:left;">                 
                                <dxe:ASPxButton ID="btnThoat" CssClass="Button" runat="server" Text="Thoát" 
                                    onclick="btnThoat_Click" />
        </div>
                                
    </div>
    <div>
        
        <dxxr:ReportToolbar ID="ReportToolbar1" runat="server" 
            ReportViewer="<%# RpView %>" ShowDefaultButtons="False">
            <Items>
                <dxxr:ReportToolbarButton ItemKind="Search" />
                <dxxr:ReportToolbarSeparator />
                <dxxr:ReportToolbarButton ItemKind="PrintReport" />
                <dxxr:ReportToolbarButton ItemKind="PrintPage" />
                <dxxr:ReportToolbarSeparator />
                <dxxr:ReportToolbarButton Enabled="False" ItemKind="FirstPage" />
                <dxxr:ReportToolbarButton Enabled="False" ItemKind="PreviousPage" />
                <dxxr:ReportToolbarLabel ItemKind="PageLabel" />
                <dxxr:ReportToolbarComboBox ItemKind="PageNumber" Width="65px">
                </dxxr:ReportToolbarComboBox>
                <dxxr:ReportToolbarLabel ItemKind="OfLabel" />
                <dxxr:ReportToolbarTextBox IsReadOnly="True" ItemKind="PageCount" />
                <dxxr:ReportToolbarButton ItemKind="NextPage" />
                <dxxr:ReportToolbarButton ItemKind="LastPage" />
                <dxxr:ReportToolbarSeparator />
                <dxxr:ReportToolbarButton ItemKind="SaveToDisk" />
                <dxxr:ReportToolbarButton ItemKind="SaveToWindow" />
                <dxxr:ReportToolbarComboBox ItemKind="SaveFormat" Width="70px">
                    <Elements>
                        <dxxr:ListElement Value="pdf" />
                        <dxxr:ListElement Value="xls" />
                        <dxxr:ListElement Value="xlsx" />
                        <dxxr:ListElement Value="rtf" />
                        <dxxr:ListElement Value="mht" />
                        <dxxr:ListElement Value="txt" />
                        <dxxr:ListElement Value="csv" />
                        <dxxr:ListElement Value="png" />
                    </Elements>
                </dxxr:ReportToolbarComboBox>
            </Items>
            <Styles>
                <LabelStyle>
                <Margins MarginLeft="3px" MarginRight="3px" />
                </LabelStyle>
            </Styles>
        </dxxr:ReportToolbar>
        
 </div>
 
    <div>
        <dxxr:ReportViewer ID="RpView" runat="server" 
            Report="<%# new RpBangDiemTongHop() %>" ReportName="RpBangDiemTongHop">
        </dxxr:ReportViewer>
    </div>    
    
</asp:Content>

