<?php
class ThiReadyForm extends Form
{
	function ThiReadyForm()
	{
		Form::Form('ThiReadyForm');
	}
	function on_submit(){
		$ThongTinThiSinh = Session::get('thi');
		if($ThongTinThiSinh['TrangThai']<=2){
			$ids = $this->generate_test();
			$row = array(
						'TrangThai'=>3,
						'T_BatDau'=>time(),
						'T_KetThuc'=>time()+$ThongTinThiSinh['ThoiGianLamBai']*60,
						'XauCauHoi'=>$ids,
						'XauTraLoi'=>'',
						'Diem'=>0,
						'TongDiem'=>0,
						'TongDiemTraLoi'=>0
					);
			ThiDB::update($row);
			Url::redirect_current();
		}else{
			echo '<script>alert("Vui lòng chờ xác nhận của giám thị!");</script>';
		}
	}
	function draw()
	{
		$this->map=Session::get('thi');
		$this->parse_layout('ready',$this->map);
	}
	function generate_test(){
		$ThongTinThiSinh = Session::get('thi');
		$sql = "select tblCauTrucDeThi.* from tblCauTrucDeThi where ID = '".$ThongTinThiSinh['IDCauTrucDeThi']."'";
		$cautrucde = DB::fetch($sql);
		$ids = '0';
		$total = 0;
		if($cautrucde){
			$sql = "
				SELECT
					tblLoaiCauHoi_CauTrucDeThi.*,tblLoaiCauHoi.Ma
				from
					tblLoaiCauHoi_CauTrucDeThi
					inner join tblLoaiCauHoi on tblLoaiCauHoi.ID = tblLoaiCauHoi_CauTrucDeThi.IDLoaiCauHoi
				where
					IDCauTrucDe = ".$ThongTinThiSinh['IDCauTrucDeThi']."
				ORDER BY STT	
			";
			$chi_tiet_cau_truc_de = DB::fetch_all($sql);
			if($chi_tiet_cau_truc_de){
				foreach($chi_tiet_cau_truc_de as $k=>$v){					
					$sql = "
						SELECT
							top ".$v['SoCauHoi']." tblCauHoi.ID as id,IDCauHoiCha
						FROM
							tblCauHoi
							inner join tblLoaiCauHoi on tblLoaiCauHoi.ID = tblCauHoi.IDLoaiCauHoi
						WHERE
							tblLoaiCauHoi.Ma like '".$v['Ma']."%' AND IDCauHoiCha<1 
						ORDER BY tblLoaiCauHoi.Ma,NEWID()";					
					$cauhoi = DB::fetch_all($sql);
					if($cauhoi){
						foreach($cauhoi as $_k=>$_v){
							$total++;
							$ids .= ','.$_v['id'];
							if($_v['IDCauHoiCha']==-1){
								$sql = "SELECT ID as id from tblCauHoi where IDCauHoiCha = ".$_k;
								$childs = DB::fetch_all($sql);
								if($childs){
									foreach($childs as $child){
										$total++;
										$ids .= ','.$child['id'];
									}
								}
							}
						}
					}
				}
			}
		}
		return $ids;
	}
}
?>