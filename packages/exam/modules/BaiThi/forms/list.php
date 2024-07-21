<?php
class BaiThiForm extends Form
{
	function BaiThiForm()
	{
		Form::Form('BaiThiForm');
	}
	function on_submit(){
	}
	function draw()
	{
		if($baithi_id = Url::iget('id')){
			$sql = "SELECT
						ID,Diem,NguoiDung,IDPhongThi,T_KetThuc
					FROM
						tblDSDuThi
					WHERE
						ID = ".$baithi_id."
			";
			$baithi = DB::fetch($sql);
			if($baithi){
				$baithi['HoTen'] = DB::fetch("select account.id,account.HoDem+' '+account.Ten as name from account where id='".$baithi['NguoiDung']."'",'name');
				$baithi['PhongThi'] = DB::fetch("select id,Ten from tblPhongThi where id=".$baithi['IDPhongThi'],'Ten');
				$baithi['NgayThi'] = date('d/m/Y',$baithi['T_KetThuc']);
				$this->parse_layout('list',$baithi);
			}
		}
	}
}
?>
