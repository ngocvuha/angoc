<div class="middle">
	<div class="content-header clrfix">
    	<div class="fl title">{{Url::get('page_name').' <span>[ '.Portal::get_action(Url::get('cmd')).' ]</span>'}}</div>
        <div class="fr">
        <!--IF:can(User::can_add())--><button id="save" class="red-button">Import</button><!--/IF:can-->
        </div>
    </div>
	<div class="form-content">
		<form name="import" id="import" method="post" enctype="multipart/form-data">
			<table width="100%" cellpadding="2" border="1" style="border-collapse:collapse">
				<tr>
					<th width="30%">Tên Nhóm (Nếu có)<br />
						<i style="font-weight:normal">Trong trường hợp danh sách này gồm sinh viên ở nhiều lớp khác nhau, Tạo nhóm sẽ giúp tổng hợp danh sách sinh viên dễ hơn</i>
					</th>
					<td><input type="text" name="Nhom" id="Nhom" style="width:100%"></td>
				</tr>
				<tr>
					<th>Input Xls File: </th>
					<td><input type="file" name="xls" id="xls"></td>
				</tr>
			</table>
		</form>
	</div>
</div>