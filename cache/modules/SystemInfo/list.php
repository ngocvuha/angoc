<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title"><?php echo Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>';?></div>
    </div>
	<div class="form-content">
        <div id="SystemInfo" class="cms-tabs" align="center">
            <ul>
                <li><a href="#system_info"><span><?php echo Portal::language('system_info');?></span></a></li>
                <li><a href="#PHP_configs"><span><?php echo Portal::language('PHP_configs');?></span></a></li>
                <li><a href="#apache2handler"><span><?php echo Portal::language('apache2handler');?></span></a></li>
                <li><a href="#Apache_environment"><span><?php echo Portal::language('Apache_environment');?></span></a></li>
                <li><a href="#gd"><span><?php echo Portal::language('Graph_driver');?></span></a></li>
                <li><a href="#mysql"><span><?php echo Portal::language('mysql');?></span></a></li>
                <li><a href="#session"><span><?php echo Portal::language('session');?></span></a></li>
            </ul>
            <div id="system_info">
                <table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
                  <tr style="background-color:#F0F0F0">
                        <th colspan="2" align="left"><a><?php echo Portal::language('System_info');?></a></th>
                  </tr>
                  <tr >
                    <td width="27%" align="left">PHP Version</td>
                    <td width="73%" align="left"><?php echo phpversion();?></td>
                  </tr>
                  <tr>
                    <td align="left">Zend Version</td>
                    <td align="left"><?php echo zend_version();?></td>
                  </tr>
                  <tr >
                    <td align="left">Client Browser</td>
                    <td align="left"><?php echo $_SERVER['HTTP_USER_AGENT'];?></td>
                  </tr>
                  <tr >
                    <td align="left">Server Name</td>
                    <td align="left"><?php echo $_SERVER['SERVER_NAME'];?></td>
                  </tr>
                  <tr >
                    <td align="left">Mysql Server Info</td>
                    <td align="left"><?php echo mysql_get_server_info();?></td>
                  </tr>
                  <tr >
                    <td align="left">GD2 Library</td>
                    <td align="left"><?php $gd2 = gd_info();echo $gd2['GD Version'];?></td>
                  </tr>
                  <tr >
                    <td align="left">Server IP</td>
                    <td align="left"><?php echo gethostbyname($_SERVER['HTTP_HOST']);?></td>
                  </tr>
                  <tr >
                    <td align="left">Client IP</td>
                    <td align="left"><?php echo gethostbyname($_SERVER['REMOTE_ADDR']);?></td>
                </tr>
            </table>
            </div>
            <div id="PHP_configs">
                <table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
                  <tr style="background-color:#F0F0F0">
                        <th colspan="2" align="left"><a><?php echo Portal::language('PHP_configs');?></a></th>
                  </tr>
                  <?php foreach($this->map['system_info']['PHP Configuration'] as $key=>$value){?>
                  <tr >
                    <td width="27%" align="left"><?php echo $key;?></td>
                    <td width="73%" align="left"><?php echo $value;?></td>
                  </tr>		 
                  <?php }?>
            </table>
            </div>
            <div id="apache2handler">
                <table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
                  <tr style="background-color:#F0F0F0">
                        <th colspan="2" align="left"><a><?php echo Portal::language('apache2handler');?></a></th>
                  </tr>
                  <?php foreach($this->map['system_info']['apache2handler'] as $key=>$value){?>
                  <tr >
                    <td width="27%" align="left"><?php echo $key;?></td>
                    <td width="73%" align="left"><?php echo $value;?></td>
                  </tr>		 
                  <?php }?>
            </table>
            </div>
            <div id="Apache_environment">
                <table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
                  <tr style="background-color:#F0F0F0">
                        <th colspan="2" align="left"><a><?php echo Portal::language('Apache_environment');?></a></th>
                  </tr>
                  <?php foreach($this->map['system_info']['Apache Environment'] as $key=>$value){?>
                  <tr >
                    <td width="27%" align="left"><?php echo $key;?></td>
                    <td width="73%" align="left"><?php echo $value;?></td>
                  </tr>		 
                  <?php }?>
            </table>
            </div>
            <div id="gd">
                <table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
                  <tr style="background-color:#F0F0F0">
                        <th colspan="2" align="left"><a><?php echo Portal::language('Graph_driver');?></a></th>
                  </tr>
                  <?php foreach($this->map['system_info']['gd'] as $key=>$value){?>
                  <tr >
                    <td width="27%" align="left"><?php echo $key;?></td>
                    <td width="73%" align="left"><?php echo $value;?></td>
                  </tr>		 
                  <?php }?>
            </table>
            </div>
            <div id="mysql">
                <table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
                  <tr style="background-color:#F0F0F0">
                        <th colspan="2" align="left"><a><?php echo Portal::language('mysql');?></a></th>
                  </tr>
                  <?php foreach($this->map['system_info']['mysql'] as $key=>$value){?>
                  <tr >
                    <td width="27%" align="left"><?php echo $key;?></td>
                    <td width="73%" align="left"><?php echo $value;?></td>
                  </tr>		 
                  <?php }?>
            </table>
            </div>
            <div id="session">
                <table  cellpadding="6" cellspacing="0" width="100%" style="#width:99%;margin-top:4px;" border="1" bordercolor="#E7E7E7" align="center">
                  <tr style="background-color:#F0F0F0">
                        <th colspan="2" align="left"><a><?php echo Portal::language('session');?></a></th>
                  </tr>
                  <?php foreach($this->map['system_info']['session'] as $key=>$value){?>
                  <tr >
                    <td width="27%" align="left"><?php echo $key;?></td>
                    <td width="73%" align="left"><?php echo $value;?></td>
                  </tr>		 
                  <?php }?>
            </table>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
jQuery(function() {
	jQuery('#SystemInfo').tabs();
});
</script>
