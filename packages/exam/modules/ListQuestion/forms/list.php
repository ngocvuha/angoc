<?php
class ListQuestionForm extends Form
{
	function ListQuestionForm()
	{
		Form::Form('ListQuestionForm');
	}
	function draw()
	{
		$ThongTinThiSinh = Session::get('thi');
		//System::debug($ThongTinThiSinh);
		if($ThongTinThiSinh && ($ThongTinThiSinh['TrangThai']>2)){
			$this->map = $ThongTinThiSinh;
			$this->map['items'] = $this->get_cau_hoi($ThongTinThiSinh['XauCauHoi']);
			$this->parse_layout('list',$this->map);
		}
	}
	function get_cau_hoi($ids){
		$sql = "SELECT
					tblCauHoi.ID,tblCauHoi.IDCauHoiCha
				FROM
					tblCauHoi
				WHERE
					tblCauHoi.id in (".$ids.")
				ORDER BY CHARINDEX(','+CONVERT(varchar,tblCauHoi.id)+',', ',".$ids.",')";
		return DB::fetch_all($sql);
	}
}
?>