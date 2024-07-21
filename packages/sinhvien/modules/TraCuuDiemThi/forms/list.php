<?php
class ListTraCuuDiemThiForm extends Form
{
	function ListTraCuuDiemThiForm()
	{
		Form::Form('ListTraCuuDiemThiForm');
	}
	function draw()
	{
		$sql = "
			select
				tblDSDuThi.id,tblDSDuThi.T_KetThuc,tblPhongThi.Ten,tblDSDuThi.Diem,TongDiemTraLoi,TongDiem
			from
				tblDSDuThi
				inner join tblPhongThi on tblDSDuThi.IDPhongThi = tblPhongThi.ID
			where
				tblDSDuThi.NguoiDung = '".User::id()."'
			ORDER BY 
				tblDSDuThi.id desc
		";
		$items=DB::fetch_all($sql);
		$this->parse_layout('list',array('items'=>$items));
	}	
}
?>