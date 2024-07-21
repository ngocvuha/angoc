<?php
class ChamThi extends Module
{
	static $id = '';
	function ChamThi($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(Session::get('ChamThi'))
		{
			ChamThi::$id = Session::get('ChamThi');
			switch(Url::get('cmd'))
			{
				case 'cham':
					$this->cham();
					break;
				case 'thoat':
					$this->thoat();
					break;	
				default:
					$this->list_cmd();
					break;
			}
		}else{
			Url::access_denied();
		}
	}
	function thoat(){
		Session::delete('ChamThi');
		Url::redirect('dang-nhap');
	}
	function list_cmd()
	{
		require_once 'forms/list.php';
		$this->add_form(new ListChamThiForm());
	}
	function cham(){
		$diem = Url::iget('Diem');
		$writing = Url::iget('IDWriting');
		$sql = "
			SELECT
				tblWriting_ChamThi.id
			FROM
				tblWriting_ChamThi
			WHERE
				tblWriting_ChamThi.id = '".$writing."'
				and tblWriting_ChamThi.UserID = '".ChamThi::$id['id']."'
		";
		if(DB::fetch($sql)){
			if(DB::update_id('tblWriting_ChamThi',array('Diem'=>$diem,'T_Cham'=>time()),$writing)){
				echo 1; exit();
			}
		}
		echo 0; exit();
	}
}
?>
