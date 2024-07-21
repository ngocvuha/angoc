<?php 
class TestCauHoi extends Module
{
	function TestCauHoi($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view(false,ANY_CATEGORY)){			
			if(Url::nget('cmd')=='update'){
				$this->update();
			}else{
				require_once 'forms/thi.php';
				$this->add_form(new ThiTestForm());
			}
		}else{
			Url::access_denied();
		}
	}
	function test(){
		$cautrucde = 36;
		$total = 0;
		if($cautrucde){
			$sql = "
				SELECT
					tblLoaiCauHoi_CauTrucDeThi.*,tblLoaiCauHoi.Ma,CAST(tblLoaiCauHoi.Ten as text) as LoaiCauHoi
				from
					tblLoaiCauHoi_CauTrucDeThi
					inner join tblLoaiCauHoi on tblLoaiCauHoi.ID = tblLoaiCauHoi_CauTrucDeThi.IDLoaiCauHoi
				where
					IDCauTrucDe = ".$cautrucde."
				ORDER BY STT	
			";
			$chi_tiet_cau_truc_de = DB::fetch_all($sql);
			if($chi_tiet_cau_truc_de){
				foreach($chi_tiet_cau_truc_de as $k=>$v){
					echo $v['LoaiCauHoi'].': ';
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
						$tt = 0;
						foreach($cauhoi as $_k=>$_v){							
							//$ids .= ','.$_v['id'];
							if($_v['IDCauHoiCha']==-1){
								$sql = "SELECT ID as id from tblCauHoi where IDCauHoiCha = ".$_k;
								$childs = DB::fetch_all($sql);
								if($childs){
									foreach($childs as $child){
										$total++;$tt++;
										//$ids .= ','.$child['id'];
									}
								}
							}else{
								$tt++;
								$total++;
							}
							if($tt==6 or $tt==4){
								System::debug($_v);
							}
						}
						echo $tt.'<br>';
					}
				}
			}
			echo '======================'.$total;
		}
	}
	function update(){
		$a2 = DB::fetch_all("select ID,CAST(Ten as text) as Ten from tblLoaiCauHoi where Ma like '014.006%'");
		foreach($a2 as $k=>$v){
			echo '<strong>'.$v['Ten'].'</strong><hr>';
			$q = DB::fetch_all('select ID,Ten,CAST(NoiDungCauHoi as text) as NoiDungCauHoi from tblCauHoi where IDCauHoiCha=-1 and IDLoaiCauHoi = '.$k);
			$i=1;
			foreach($q as $k1=>$v1){
				echo 'Q'.($i++).' : '.$v1['Ten'].'<br>'.$v1['NoiDungCauHoi'].'<hr>';
			}
		}
	}
}
?>
