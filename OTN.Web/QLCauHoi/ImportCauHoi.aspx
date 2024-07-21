<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="ImportCauHoi, App_Web_nvbb4npw" title="Untitled Page" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxTreeList.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxTreeList" tagprefix="dxwtl" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">

    <script type="text/javascript">
    function getValuesForHdId() {
        var items = win1.GetSelectedItems();
        var st = '0';
	    for(var i = 0;i<items.length; i++) {
		    st+=',' + items[i].value;
        }
	    var hd = document.getElementById('<%=hdIdCauHoi1.ClientID%>');
	    hd.value = st;
	    items = win2.GetSelectedItems();
	    st = '0';
	    for (var i = 0; i < items.length; i++) {
	        st += ',' + items[i].value;
	    }
	    var hd = document.getElementById('<%=hdIdCauHoi2.ClientID%>');
	    hd.value = st;
	}
	function XoaCauHoi() {
	    if (!confirm("Bạn có chắc chắn muốn xóa không?"))
	        return false;
	    else
	        getValuesForHdId();
	    return true;
	}
	function CheckAll(w, p) {
	    if (w == 1)//win1
	    {
	        if (p == 1)
	            win1.SelectAll();
	        else
	            win1.UnselectAll();
	    }
	    else {
	        if (p == 1)
	            win2.SelectAll();
	        else
	            win2.UnselectAll();
	    }
	}
</script>
    <div class="HeaderTitles">        
            Import câu hỏi từ Word<asp:HiddenField ID="hdIdCauHoi1" 
                runat="server" />
                                
                              
                            <asp:HiddenField ID="hdIdCauHoi2" runat="server" />
                                
                            </div><br />
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom:15px;"
        width="100%" align="center">
        <tr>
            <td with="100%" align="center">
                <table style="width: 100%">
                    <tr>
                        <td style="text-align: left; width: 106px" bgcolor="Gainsboro">
                            Chọn file</td>
                        <td style="text-align: left; width: 677px" bgcolor="Gainsboro">
                            <div style="float:left">
                            <asp:FileUpload ID="UploadFile" runat="server" Height="22px" Width="550px" />
                            </div>
                            <div style="float:right">
                                <dxe:ASPxButton ID="btnUploadFile" CssClass="Button" runat="server" 
                                    Text="Upload file" onclick="btnUploadFile_Click" HorizontalAlign="Left" 
                                    Width="108px">
                                </dxe:ASPxButton>
                            </div>
                        </td>
                        <td style="text-align: left; width: 90px;">
                            &nbsp;</td>
                        <td style="text-align: left">
                            <dxe:ASPxHyperLink ID="ASPxHyperLink1" runat="server" 
                                NavigateUrl="~/TienIch/OTN-TemplateImport.docx" Text="Download file mẫu" />
                        </td>
                    </tr>
                                        
                    </table>
            </td>
        </tr>
        <tr>
            <td with="100%">
                
                
                
                <table style="width: 100%">
                    <tr>
                        <td>
                            <table style="width: 100%">
                                <tr>
                                    <td colspan="3">
                                        <div style="float:left;width: 100px"> Loại </div><dxe:ASPxComboBox ID="cboLoaiCauHoi" runat="server" Width="550px" AutoPostBack="True" 
                                            onselectedindexchanged="cboLoaiCauHoi_SelectedIndexChanged">
                            </dxe:ASPxComboBox>
                                <dxe:ASPxButton ID="btnChon" CssClass="Button" runat="server" Text="Chọn" 
                                            HorizontalAlign="Left" onclick="btnChon_Click" Visible="False" >
                                </dxe:ASPxButton>
                                    </td>
                                    <td colspan="2">
                                        &nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 719px" colspan="3" valign="bottom">
                                        Danh sách câu hỏi chưa phân loại
                                        <dxe:ASPxLabel ID="lbSoCau1" runat="server">
                                        </dxe:ASPxLabel>
                                    </td>
                                    <td width="100px">
                                        <div style="float:left;width:40px">
                                        Điểm
                                        </div>
                                        <dxe:ASPxTextBox ID="txtDiem" runat="server" HorizontalAlign="Right" 
                                Width="42px" Text="10" />
                                    </td>
                                    <td>
                                <dxe:ASPxButton ID="btnCapNhat" CssClass="Button" runat="server" 
                                    Text="Cập nhật" onclick="btnCapNhat_Click" HorizontalAlign="Left" 
                                    Width="95px" >
                                    <Image Url="~/images/accept.png" />
                                </dxe:ASPxButton>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 719px" colspan="3" >
                <dxe:ASPxListBox ID="lstChuaPhanLoai" runat="server" Height="230px" Rows="20" 
                    SelectionMode="CheckColumn" ClientInstanceName="win1" Width="785px" >
                    <Columns>
                        <dxe:ListBoxColumn FieldName="TenCauHoi" Name="TenCauHoi" Width="300px" 
                            Caption="Tên câu hỏi" />
                        <dxe:ListBoxColumn Caption="Tên loại" FieldName="TenLoai" Name="TenLoai" 
                            Width="235px" />
                        <dxe:ListBoxColumn Caption="MultiAnswer" FieldName="MultiAnswer" Name="MultiAnswer" 
                            Width="55px" />
                    </Columns>
                </dxe:ASPxListBox>
                                    </td>
                                    <td colspan="2" rowspan="4"valign="top">
                                <dxwtl:ASPxTreeList ID="treeLoai" runat="server" AutoGenerateColumns="False" 
                                            Width="275px" DataCacheMode="Disabled">
                    <Columns>
                        <dxwtl:TreeListTextColumn Caption="Loại câu hỏi" FieldName="Ten" Name="Ten" 
                            VisibleIndex="0" Width="200px">
                        </dxwtl:TreeListTextColumn>
                    </Columns>
                </dxwtl:ASPxTreeList>
                
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                <div style="float:left">
                                <dxe:ASPxButton ID="btnCheckAll1" CssClass="Button" runat="server" Text="Check All" 
                                            HorizontalAlign="Center" onclick="btnXoa_Click" AutoPostBack="False" 
                                            ClientInstanceName="CheckAll1" >
                                    <ClientSideEvents Click="function(s, e) {
	e.processOnServer = CheckAll(1,1);
}" />
                                </dxe:ASPxButton>
                                </div>
                                <div style="float:left">
                                <dxe:ASPxButton ID="btnUnCheckAll1" CssClass="Button" runat="server" Text="Uncheck All" 
                                            HorizontalAlign="Center" onclick="btnXoa_Click" AutoPostBack="False" 
                                            ClientInstanceName="CheckAll1" >
                                    <ClientSideEvents Click="function(s, e) {
	e.processOnServer = CheckAll(1,2);
}" />
                                </dxe:ASPxButton>
                                </div>
                                <dxe:ASPxButton ID="btnXoa" CssClass="Button" runat="server" Text="Xóa câu hỏi" 
                                            HorizontalAlign="Left" onclick="btnXoa_Click" >
                                    <ClientSideEvents Click="function(s, e) {
	e.processOnServer = XoaCauHoi();
}" />
                                </dxe:ASPxButton>
                                    </td>
                                    <td>
                                    <div style="float: right">
                                <dxe:ASPxButton ID="btnAdd" CssClass="Button" runat="server" Text="Add" 
                                            HorizontalAlign="Left" onclick="btnAdd_Click" >
                                    <ClientSideEvents Click="function(s, e) {
	getValuesForHdId();
}" />
                                </dxe:ASPxButton>
                                </div>
                                
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 719px" colspan="3">
                                        Danh sách câu hỏi được chọn
                                        <dxe:ASPxLabel ID="lbSoCau2" runat="server">
                                        </dxe:ASPxLabel>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 719px" colspan="3"valign="top">
                <dxe:ASPxListBox ID="lstChon" runat="server" Height="230px" Rows="20" 
                    SelectionMode="CheckColumn" ClientInstanceName="win2" Width="785px" >
                    <Columns>
                        <dxe:ListBoxColumn FieldName="TenCauHoi" Name="TenCauHoi" Width="300px" 
                            Caption="Tên câu hỏi" />
                        <dxe:ListBoxColumn Caption="Tên loại" FieldName="TenLoai" Name="TenLoai" 
                            Width="235px" />
                        <dxe:ListBoxColumn Caption="MultiAnswer" FieldName="MultiAnswer" Name="MultiAnswer" 
                            Width="55px" />
                    </Columns>
                </dxe:ASPxListBox>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 639px">
                                <div style="float:left">
                                <dxe:ASPxButton ID="btnCheckAll2" CssClass="Button" runat="server" Text="Check All" 
                                            onclick="btnXoa_Click" AutoPostBack="False" 
                                            ClientInstanceName="btnCheckAll2" >
                                    <ClientSideEvents Click="function(s, e) {
	e.processOnServer = CheckAll(2,1);
}" />
                                </dxe:ASPxButton>
                                
                                </div>
                                <dxe:ASPxButton ID="btnUnCheckAll2" CssClass="Button" runat="server" Text="Uncheck All" 
                                            HorizontalAlign="Center" onclick="btnXoa_Click" AutoPostBack="False" 
                                            ClientInstanceName="CheckAll1" >
                                    <ClientSideEvents Click="function(s, e) {
	e.processOnServer = CheckAll(2,2);
}" />
                                </dxe:ASPxButton>
                                    </td>
                                    <td colspan="2">
                                    <div style="float: right">
                                <dxe:ASPxButton ID="btnRemove" CssClass="Button" runat="server" Text="Remove" 
                                            HorizontalAlign="Left" onclick="btnRemove_Click" >
                                    <ClientSideEvents Click="function(s, e) {
	getValuesForHdId();
}" />
                                </dxe:ASPxButton>
                                </div>
                                
                                        <asp:HiddenField ID="hdIdCauHoiDuocChon" 
                runat="server" />
                                
                                    </td>
                                    <td colspan="2">
                                        &nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                
                
                
            </td>
        </tr>
        <tr>
            <td with="100%" align="center" style="text-align: left">
                &nbsp;</td>
        </tr>
        </table>

</asp:Content>

