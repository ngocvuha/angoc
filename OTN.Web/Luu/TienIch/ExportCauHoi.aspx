<%@ Page Language="C#" %>
<%  string sql;
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<script runat="server">
    System.Data.DataTable getDataTable(string sql)
    {
        string ConnStr = System.Configuration.ConfigurationSettings.AppSettings["ConnectionString"].ToString();
        System.Data.SqlClient.SqlConnection conn = new System.Data.SqlClient.SqlConnection();
        conn.ConnectionString = ConnStr;
        conn.Open();
        System.Data.SqlClient.SqlDataAdapter ad = new System.Data.SqlClient.SqlDataAdapter(sql, conn);
        System.Data.DataSet ds = new System.Data.DataSet();
        ad.Fill(ds);
        System.Data.DataTable tb = ds.Tables[0];
        return tb;  
    }
    string fView(string utf8String)
    {
        // Get UTF-8 bytes by reading each byte with ANSI encoding
        byte[] utf8Bytes = Encoding.Default.GetBytes(utf8String);

        // Convert UTF-8 bytes to UTF-16 bytes
        byte[] utf16Bytes = Encoding.Convert(Encoding.UTF8, Encoding.Unicode, utf8Bytes);

        // Return UTF-16 bytes as UTF-16 string
        return Encoding.Unicode.GetString(utf16Bytes);
    }
    void fView(System.Data.DataTable dt, params string[] FieldNames)
    {
        if (dt == null) return;
        //Convert dt to Utf16
        foreach (System.Data.DataRow dr in dt.Rows)
            for (int i = 0; i < FieldNames.Length; i++)
                dr[FieldNames[i]] = fView(dr[FieldNames[i]].ToString());

    }

    
    protected void btnOK_Click(object sender, EventArgs e)
    {
        Response.Write(lstCheckLoaiCauHoi.SelectedValue);
    }
</script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Untitled Page</title>
</head>
<body>
<%if (false && !Page.IsPostBack)
  { %>
    <form id="form1" runat="server">
    <div>
    <%
          string sql = @"SELECT ID,Ten FROM tblLoaiCauHoi WHERE Ma<'015.002' and LEN(Ma)=11 order by Ma";
          System.Data.DataTable dt = getDataTable(sql);
          fView(dt, "Ten");
          lstCheckLoaiCauHoi.DataSource = dt;
          lstCheckLoaiCauHoi.DataTextField = "Ten";
          lstCheckLoaiCauHoi.DataValueField = "ID";
          lstCheckLoaiCauHoi.DataBind();
    %>
    <asp:CheckBoxList ID="lstCheckLoaiCauHoi" runat="server" 
            RepeatDirection="Horizontal">
        </asp:CheckBoxList>
        
        <asp:Button ID="btnOK" runat="server" onclick="btnOK_Click" Text="OK" />
 
        <br />
    </div>
    </form>
  <% } %>
 <%   sql = @"SELECT tblCauHoi.IDLoaiCauHoi, tblLoaiCauHoi.Ma, tblLoaiCauHoi.Ten As TenLoaiCauHoi, tblTraLoi.IDCauHoi, tblCauHoi.NoiDungCauHoi, 
                      tblCauHoi.IDCachHoi, tblTraLoi.ID, tblTraLoi.NoiDungTraLoi, tblTraLoi.Diem
FROM         tblCauHoi INNER JOIN
                      tblLoaiCauHoi ON tblCauHoi.IDLoaiCauHoi = tblLoaiCauHoi.ID INNER JOIN
                      tblTraLoi ON tblCauHoi.ID = tblTraLoi.IDCauHoi INNER JOIN
                      tblCachHoi ON tblCauHoi.IDCachHoi = tblCachHoi.ID
WHERE     (tblCauHoi.IDCachHoi = 3) and Ma<'015.002'
ORDER BY tblLoaiCauHoi.Ma";
      System.Data.DataTable dt = getDataTable(sql);
      fView(dt, "TenLoaiCauHoi", "NoiDungCauHoi","NoiDungTraLoi");
 %>
    <table border="0">
        
<% string  IdCauHoi_Old = "0";
   string IdLoaiCauHoi_old = "0";
   string LoaiMuc1 = "";//11 ki tu
   string LoaiMuc2 = "";//15 ki tu
   string LoaiMuc3 = "";//19 ki tu
   int dem = 0;
    for (int i = 0; i < dt.Rows.Count; i++)
   {
       string Diem = (int.Parse(dt.Rows[i]["Diem"].ToString()) > 0 ? "x" : " ");
       if (dt.Rows[i]["IDLoaiCauHoi"].ToString() != IdLoaiCauHoi_old)
       {
           string MaLoaiCauHoi=dt.Rows[i]["Ma"].ToString();
           //In loai cau hoi muc 1
           if (MaLoaiCauHoi.Substring(0,11)!=LoaiMuc1)
           {
               LoaiMuc1=MaLoaiCauHoi.Substring(0,11);
               System.Data.DataTable dt1=getDataTable(string.Format("SELECT Ten FROM tblLoaiCauHoi Where Ma='{0}'",LoaiMuc1));
               fView(dt1, "Ten");
               %>
           <tr>
            <td>
                <%=" "%></td>
            <td colspan="2" style="font-weight:bold; color:Blue">
                <%=dt1.Rows[0]["Ten"].ToString() %></td>
           </tr>
           <%}
           //In loai cau hoi muc 2
           if (MaLoaiCauHoi.Substring(0,15)!=LoaiMuc2)
           {
               LoaiMuc2=MaLoaiCauHoi.Substring(0,15);
               System.Data.DataTable dt1=getDataTable(string.Format("SELECT Ten FROM tblLoaiCauHoi Where Ma='{0}'",LoaiMuc2));
               fView(dt1, "Ten");
               %>
           <tr>
            <td>
                <%=" "%></td>
            <td colspan="2" style="font-weight:bold;color:Red">
                <%=dt1.Rows[0]["Ten"].ToString() %></td>
           </tr>
           <%}
           //In loai cau hoi muc 3
           if (MaLoaiCauHoi.Substring(0,19)!=LoaiMuc3)
           {
               LoaiMuc3=MaLoaiCauHoi.Substring(0,19);
               System.Data.DataTable dt1=getDataTable(string.Format("SELECT Ten FROM tblLoaiCauHoi Where Ma='{0}'",LoaiMuc3));
               fView(dt1, "Ten");
               %>
           <tr>
            <td>
                <%=" "%></td>
            <td colspan="2" style="font-weight:bold;color:Purple">
                <%=dt1.Rows[0]["Ten"].ToString() %></td>
           </tr>
           <%}
  
           //In loai cau hoi 
           %>
        <tr>
            <td>
                <%=" "%></td>
            <td colspan="2" style="font-weight:bold;width:700px;">
                <%=dt.Rows[i]["TenLoaiCauHoi"].ToString() %></td>
        </tr>
       <%
           IdLoaiCauHoi_old = dt.Rows[i]["IDLoaiCauHoi"].ToString();
       }
        %>
       <% 
       if (dt.Rows[i]["IDCauHoi"].ToString() != IdCauHoi_Old)
       {
           //In Cau cau hoi
           dem++;
           %>
        <tr>
            <td style="width:70px">
                <%=dem%></td>
            <td style="width:660px">
                <%=dt.Rows[i]["NoiDungCauHoi"].ToString() %></td>
            <td style="width:70px">
                <%=" "%></td>
        </tr>
       <%
           IdCauHoi_Old = dt.Rows[i]["IDCauHoi"].ToString();
       } 
    %>             
        <tr>
            <td>
                <%="-"%></td>
            <td>
                <%=dt.Rows[i]["NoiDungTraLoi"].ToString() %></td>
            <td>
                <%=Diem %></td>
        </tr>
 <%} %>    
    </table>
</body>
</html>
