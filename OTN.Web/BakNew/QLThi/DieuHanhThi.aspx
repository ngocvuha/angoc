<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="DieuHanhThi, App_Web_qiuxs1jm" title="Untitled Page" enablesessionstate="True" trace="false" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
<script type="text/javascript">
    function getValuesForHdId() {
        var items = win1.GetSelectedItems();
        var st = '0';
	    for(var i = 0;i<items.length; i++) {
		    st+=',' + items[i].value;
        }
	    var hd = document.getElementById('<%=hdIdChoPhepThi.ClientID%>');
	    hd.value = st;
	    items = win2.GetSelectedItems();
	    st = '0';
	    for (var i = 0; i < items.length; i++) {
	        st += ',' + items[i].value;
	    }
	    items = win3.GetSelectedItems();
	    for (var i = 0; i < items.length; i++) {
	        st += ',' + items[i].value;
	    }
	    var hd = document.getElementById('<%=hdIdHuyBoThi.ClientID%>');
	    hd.value = st;
    }
</script>
    <div class="HeaderTitles">
        <div style="float:left"> Điều hành thi &nbsp;</div><div style="float:left">
        <dxe:ASPxComboBox ID="cboPhongThi" runat="server" Width="448px" 
            onselectedindexchanged="cboPhongThi_SelectedIndexChanged" 
            AutoPostBack="True">
        </dxe:ASPxComboBox>
        &nbsp;</div>
        <div style="float:left; width:92px">
            <dxe:ASPxButton ID="btnChon" CssClass="Button" runat="server" Text="Chọn" 
                                    onclick="btnChon_Click" Visible="False" Width="70px" 
                HorizontalAlign="Left" >
                <Image Url="~/images/search.png" />
            </dxe:ASPxButton>
    </div>
    <div style="float:left; margin-right: 10px; width: 90px;">
                                <dxe:ASPxButton ID="btnCapNhat" CssClass="Button" runat="server" 
                                    Text="Cập nhật" onclick="btnCapNhat_Click" HorizontalAlign="Left" 
                                    Width="95px" >
                                    <Image Url="~/images/update.png" />
                                    <ClientSideEvents Click="function(s, e) {
	getValuesForHdId();
}" />
                                </dxe:ASPxButton>
                            </div>                   
                <div style="float:left;">                 
                                <dxe:ASPxButton ID="btnThoat" CssClass="Button" runat="server" Text="Thoát" 
                                    onclick="btnThoat_Click" Visible="False" />
                            </div>
                                
                            <asp:HiddenField ID="hdId" runat="server" />
                                
                            <asp:HiddenField ID="hdIdChoPhepThi" runat="server"  />
                                
                            <asp:HiddenField ID="hdIdHuyBoThi" runat="server" />
    </div>
    <table style="width: 1010px">
        <tr>
            <td>
              <div style="overflow-x: auto; width: 310px; border: 0px solid black;float:left">
              Danh sách chưa thi
                  <dxe:ASPxLabel ID="lbSL0" runat="server">
                  </dxe:ASPxLabel>
                  <br />
                <dxe:ASPxListBox ID="lstDuThi0" runat="server" Height="270px" Rows="2" >
                    <Columns>
                        <dxe:ListBoxColumn FieldName="SoBaoDanh" Name="SBD" Width="70px" 
                            Caption="SBD" />
                        <dxe:ListBoxColumn Caption="Họ và tên" FieldName="HoTen" Name="HoTen" 
                            Width="130px" />
                        <dxe:ListBoxColumn Caption="Ngày sinh" FieldName="NgaySinh" Name="NgaySinh" 
                            Width="50px" />
                    </Columns>
                </dxe:ASPxListBox>
              </div>
              <div style="overflow-x: auto; width: 345px; border: 0px solid black;float:left">
              Danh sách chờ thi (Tick để cho phép thi)
                  <dxe:ASPxLabel ID="lbSL1" runat="server">
                  </dxe:ASPxLabel>
                  <br />
                <dxe:ASPxListBox ID="lstDuThi1" runat="server" Height="270px" Rows="20" 
                    SelectionMode="CheckColumn" ClientInstanceName="win1" >
                    <Columns>
                        <dxe:ListBoxColumn FieldName="SoBaoDanh" Name="SBD" Width="70px" 
                            Caption="SBD" />
                        <dxe:ListBoxColumn Caption="Họ và tên" FieldName="HoTen" Name="HoTen" 
                            Width="130px" />
                        <dxe:ListBoxColumn Caption="Ngày sinh" FieldName="NgaySinh" Name="NgaySinh" 
                            Width="50px" />
                    </Columns>
                </dxe:ASPxListBox>
              </div>
              <div style="overflow-x: auto; width: 345px; border: 0px solid black">
              Danh sách được phép thi (Tick để hủy thi)
                  <dxe:ASPxLabel ID="lbSL2" runat="server">
                  </dxe:ASPxLabel>
                  <br />
                <dxe:ASPxListBox ID="lstDuThi2" runat="server" Height="270px" Rows="20" ClientInstanceName="win2" 
                    SelectionMode="CheckColumn">
                    <Columns>
                        <dxe:ListBoxColumn FieldName="SoBaoDanh" Name="SBD" Width="70px" 
                            Caption="SBD" />
                        <dxe:ListBoxColumn Caption="Họ và tên" FieldName="HoTen" Name="HoTen" 
                            Width="130px" />
                        <dxe:ListBoxColumn Caption="Ngày sinh" FieldName="NgaySinh" Name="NgaySinh" 
                            Width="50px" />
                    </Columns>
                </dxe:ASPxListBox>
              </div>
              <br />
              <div style="overflow-x: auto; width: 500px; border: 0px solid black;float:left">
              Danh sách đang thi (Tick để hủy thi)
                  <dxe:ASPxLabel ID="lbSL3" runat="server">
                  </dxe:ASPxLabel>
                  <br />
                <dxe:ASPxListBox ID="lstDuThi3" runat="server" Height="270px" Rows="20" ClientInstanceName="win3" 
                    SelectionMode="CheckColumn">
                    <Columns>
                        <dxe:ListBoxColumn FieldName="SoBaoDanh" Name="SBD" Width="70px" 
                            Caption="SBD" />
                        <dxe:ListBoxColumn Caption="Họ và tên" FieldName="HoTen" Name="HoTen" 
                            Width="130px" />
                        <dxe:ListBoxColumn Caption="Ngày sinh" FieldName="NgaySinh" Name="NgaySinh" 
                            Width="60px" />
                        <dxe:ListBoxColumn Caption="Bắt đầu" FieldName="T_BatDau" Name="T_BatDau" 
                            Width="55px" />
                        <dxe:ListBoxColumn Caption="Còn lại" FieldName="T_ConLai" Name="T_ConLai"
                            Width="55px" />
                    </Columns>
                </dxe:ASPxListBox>
              </div>
              <div style="overflow-x: auto; width: 500px; border: 0px solid black;float:left">
              Danh sách đã thi
                  <dxe:ASPxLabel ID="lbSL4" runat="server">
                  </dxe:ASPxLabel>
                  <br />
                <dxe:ASPxListBox ID="lstDuThi4" runat="server" Height="270px" Rows="20">
                    <Columns>
                        <dxe:ListBoxColumn FieldName="SoBaoDanh" Name="SBD" Width="70px" 
                            Caption="SBD" />
                        <dxe:ListBoxColumn Caption="Họ và tên" FieldName="HoTen" Name="HoTen" 
                            Width="130px" />
                        <dxe:ListBoxColumn Caption="Ngày sinh" FieldName="NgaySinh" Name="NgaySinh" 
                            Width="60px" />
                        <dxe:ListBoxColumn Caption="Điểm" FieldName="Diem" Name="Diem"
                            Width="50px" />
                        <dxe:ListBoxColumn Caption="Bắt đầu" FieldName="T_BatDau" Name="T_BatDau" 
                            Width="55px" />
                        <dxe:ListBoxColumn Caption="Kết thúc" FieldName="T_KetThuc" Name="T_KetThuc" 
                            Width="55px" />
                            
                    </Columns>
                </dxe:ASPxListBox>
              </div>
            </td>
            
        </tr>
    </table>
    
    
    </asp:Content>

