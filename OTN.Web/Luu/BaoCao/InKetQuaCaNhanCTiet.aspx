<%@ page language="C#" masterpagefile="~/OTN.master" autoeventwireup="true" inherits="InKetQuaCaNhanCTiet, App_Web_zgkkpm8a" title="Untitled Page" enablesessionstate="True" trace="false" %>
<%@ Register assembly="DevExpress.Web.ASPxEditors.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxEditors" tagprefix="dxe" %>

<%@ Register assembly="DevExpress.Web.ASPxHtmlEditor.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxHtmlEditor" tagprefix="dxhe" %>
<%@ Register assembly="DevExpress.Web.ASPxSpellChecker.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxSpellChecker" tagprefix="dxwsc" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView" tagprefix="dxwgv" %>

<%@ Register assembly="DevExpress.Web.ASPxGridView.v9.2.Export, Version=9.2.4.0, Culture=neutral, PublicKeyToken=b88d1754d700e49a" namespace="DevExpress.Web.ASPxGridView.Export" tagprefix="dxwgv" %>

<asp:Content ID="Content1" ContentPlaceHolderID="cphContent" Runat="Server">
  <div align="center">
        <table  style="width: 800px; text-align: right; height: 411px; font-family: 'Times New Roman';font-size:14pt;">
            <tr>
                <td style="text-align: center; height: 11px; width: 52px;" valign="top">
                    <dxe:ASPxImage ID="ASPxImage1" runat="server" Height="43px" 
                        ImageUrl="~/images/logoHNMU.png" Width="46px">
                    </dxe:ASPxImage>
                </td>
                <td style="text-align: center; height: 11px; width: 281px;" valign="top">
                    UBND THÀNH PHỐ HÀ NỘI<br />
                    <b>TRƯỜNG ĐH CÔNG ĐOÀN</b></td>
                <td style="text-align: center; height: 11px;">
                    <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br />
                    Độc lập - Tự do - Hạnh phúc</b></td>
            </tr>
            <tr>
                <td colspan="3" 
                    style="height: 62px; font-size: 20px; text-align: center; font-family: 'Times New Roman', Times, serif;">
                    <b>
                    <br />
                    PHIẾU XÁC NHẬN KẾT QUẢ THI<br />
                    CHỨNG CHỈ ỨNG DỤNG CÔNG NGHỆ THÔNG TIN (CƠ BẢN)<br />
                    </b><i><span style="font-size: 14pt">Phần thi Trắc nghiệm trên máy</span></i><b><br />
                    </b><span style="font-size: 14pt">Đợt thi: ngày&nbsp;<%=DateTime.Today.Day%> tháng&nbsp;<%=DateTime.Today.Month%> năm</span> <%=DateTime.Today.Year%><br />
&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: right; height: 26px; font-size: small;" 
                    align="right" colspan="3">
                    <table style="width: 100%;font-family: 'Times New Roman'; font-size:14pt">
                        <tr>
                            <td style="text-align: left; width: 143px">
                                Họ và tên:</td>
                            <td style="text-align: left; width: 298px">
                
                <dxe:ASPxLabel ID="lbHoTen" runat="server" Font-Bold="True" Font-Size="14pt" 
                                    Font-Names="Times New Roman">
                </dxe:ASPxLabel>
                
                            </td>
                            <td style="text-align: left; width: 104px">
                                Ngày sinh:</td>
                            <td style="text-align: left">
                
                <dxe:ASPxLabel ID="lbNgaySinh" runat="server" Font-Bold="True" Font-Size="14pt" 
                                    Font-Names="Times New Roman">
                </dxe:ASPxLabel>
                
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; width: 143px; height: 23px;">
                                Số CMND/CCCD:</td>
                            <td style="text-align: left; width: 298px; height: 23px;">
                
                <dxe:ASPxLabel ID="lbCMT" runat="server" Font-Names="Times New Roman" Font-Bold="True" 
                                    Font-Size="14pt">
                </dxe:ASPxLabel>
                
                            </td>
                            <td style="text-align: left; width: 104px; height: 23px;">
                                Nơi sinh:</td>
                            <td style="text-align: left; height: 23px;">
                
                <dxe:ASPxLabel ID="lbNoiSinh" runat="server" Font-Bold="True" Font-Size="14pt" 
                                    Font-Names="Times New Roman">
                </dxe:ASPxLabel>
                
                                </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="text-align: left; height: 26px;" 
                    align="left" colspan="3">
                    Đạt kết quả bài thi trắc nghiệm trên máy tính với số điểm:</td>
            </tr>
            <tr>
                <td style="text-align: center; height: 90px; font-size: 14pt;" 
                    align="right" colspan="3">
                
                <dxe:ASPxLabel ID="lbDiem" runat="server" Font-Bold="True" Font-Size="24pt" 
                        ForeColor="Black">
                </dxe:ASPxLabel>
                
                    điểm<br />
                </td>
            </tr>
            <tr>
                <td style="text-align: center; height: 26px; font-size: small;" 
                    align="right" colspan="3">
                
                    <table cellspacing="0" style="width: 100%; height: 232px; font-family:'Times New Roman'; font-size:14pt;">
                        <tr>
                            <td style="border: 1px solid #000000; height: 124px; margin:0px; width: 390px;" 
                                valign="top">
                                <b>Đại diện cán bộ coi thi<br />
                                (Ký, ghi rõ họ tên)</b></td>
                            <td style="border: 1px solid #000000; height: 124px" valign="top">
                                <b>Xác nhận của thí sinh<br />
                                (Ký, ghi rõ họ tên)</b></td>
                        </tr>
                        </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="height:50px">&nbsp;</td>
            </tr>
            <tr align="left">
                <td colspan="3" style="height:50px; font-size: small;">------------------------------------------------------------------</td>
            </tr>
            <tr align="left">
                <td colspan="3" style="height:50px; font-size: small;">&nbsp;</td>
            </tr>
            </table>
    
        <table  style="width: 800px; text-align: right; height: 411px; font-family: 'Times New Roman';font-size:14pt;">
            <tr>
                <td style="text-align: center; height: 11px; width: 52px;" valign="top">
                    <dxe:ASPxImage ID="ASPxImage2" runat="server" Height="43px" 
                        ImageUrl="~/images/logoHNMU.png" Width="46px">
                    </dxe:ASPxImage>
                </td>
                <td style="text-align: center; height: 11px; width: 281px;" valign="top">
                    UBND THÀNH PHỐ HÀ NỘI<br />
                    <b>TRƯỜNG ĐH THỦ ĐÔ HÀ NỘI</b></td>
                <td style="text-align: center; height: 11px;">
                    <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br />
                    Độc lập - Tự do - Hạnh phúc</b></td>
            </tr>
            <tr>
                <td colspan="3" 
                    style="height: 62px; font-size: 20px; text-align: center; font-family: 'Times New Roman', Times, serif;">
                    <b>
                    <br />
                    PHIẾU XÁC NHẬN KẾT QUẢ THI<br />
                    CHỨNG CHỈ ỨNG DỤNG CÔNG NGHỆ THÔNG TIN (CƠ BẢN)<br />
                    </b><i><span style="font-size: 14pt">Phần thi Trắc nghiệm trên máy</span></i><b><br />
                    </b><span style="font-size: 14pt">Đợt thi: ngày&nbsp;<%=DateTime.Today.Day%> tháng&nbsp;<%=DateTime.Today.Month%> năm</span> <%=DateTime.Today.Year%><br />
&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: right; height: 26px; font-size: small;" 
                    align="right" colspan="3">
                    <table style="width: 100%;font-family: 'Times New Roman'; font-size:14pt">
                        <tr>
                            <td style="text-align: left; width: 143px">
                                Họ và tên:</td>
                            <td style="text-align: left; width: 298px">
                
                <dxe:ASPxLabel ID="lbHoTen1" runat="server" Font-Bold="True" Font-Size="14pt" 
                                    Font-Names="Times New Roman">
                </dxe:ASPxLabel>
                
                            </td>
                            <td style="text-align: left; width: 104px">
                                Ngày sinh:</td>
                            <td style="text-align: left">
                
                <dxe:ASPxLabel ID="lbNgaySinh1" runat="server" Font-Bold="True" Font-Size="14pt" 
                                    Font-Names="Times New Roman">
                </dxe:ASPxLabel>
                
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; width: 143px; height: 23px;">
                                Số CMND/CCCD:</td>
                            <td style="text-align: left; width: 298px; height: 23px;">
                
                <dxe:ASPxLabel ID="lbCMT1" runat="server" Font-Names="Times New Roman" Font-Bold="True" 
                                    Font-Size="14pt">
                </dxe:ASPxLabel>
                
                            </td>
                            <td style="text-align: left; width: 104px; height: 23px;">
                                Nơi sinh:</td>
                            <td style="text-align: left; height: 23px;">
                
                <dxe:ASPxLabel ID="lbNoiSinh1" runat="server" Font-Bold="True" Font-Size="14pt" 
                                    Font-Names="Times New Roman">
                </dxe:ASPxLabel>
                
                                </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="text-align: left; height: 26px;" 
                    align="left" colspan="3">
                    Đạt kết quả bài thi trắc nghiệm trên máy tính với số điểm:</td>
            </tr>
            <tr>
                <td style="text-align: center; height: 90px; font-size: 14pt;" 
                    align="right" colspan="3">
                
                <dxe:ASPxLabel ID="lbDiem1" runat="server" Font-Bold="True" Font-Size="24pt" 
                        ForeColor="Black">
                </dxe:ASPxLabel>
                
                    điểm</td>
            </tr>
            <tr>
                <td style="text-align: center; height: 26px; font-size: small;" 
                    align="right" colspan="3">
                
                    <table cellspacing="0" style="width: 100%; height: 232px; font-family:'Times New Roman'; font-size:14pt;">
                        <tr>
                            <td style="border: 1px solid #000000; height: 124px; margin:0px; width: 390px;" 
                                valign="top">
                                <b>Đại diện cán bộ coi thi<br />
                                (Ký, ghi rõ họ tên)</b></td>
                            <td style="border: 1px solid #000000; height: 124px" valign="top">
                                <b>Xác nhận của thí sinh<br />
                                (Ký, ghi rõ họ tên)</b></td>
                        </tr>
                        </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="height:50px">&nbsp;</td>
            </tr>
            </table>
 </div>  
    
</asp:Content>

