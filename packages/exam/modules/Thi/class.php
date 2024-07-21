<?php 
class Thi extends Module
{
	static $sv = array();
	function Thi($row)
	{
		Module::Module($row);
		require_once 'db.php';
		$cmd = Url::get('cmd');
		switch($cmd){
			case 'get_status': $this->get_status(); break;
			case 'keep_connect'; exit();
		}
		if($IDTSDuThi = Url::iget('IDThiSinh')){
			$ThongTinThiSinh = ThiDB::getThi($IDTSDuThi);
			$ThongTinThiSinh['IDTSDuThi'] = $ThongTinThiSinh['ID'];
			Session::set('thi',$ThongTinThiSinh);
		}		
		if($phongthi = Url::iget('phongthi') and $status = ThiDB::checkThi($phongthi)){
			//set lai trang thai
			$status['IDTSDuThi'] = $status['ID'];
			if($status['TrangThai']<3){
				Session::set('thi',$status);
				$check = true;
			}else{
				$check = false;
			}
		}elseif($status = Session::get('thi') and $status['TrangThai']>=1 and $status['P_BatDau']<time() and ($status['P_KetThuc']+$status['ThoiGianLamBai']*60)>time() ){
			$check = true;
		}else{
			$check = false;
		}		
		if($check){
			$TrangThai = ThiDB::get_status();
			if($TrangThai!=$status['TrangThai']){
				ThiDB::update(array('TrangThai'=>$TrangThai));
			}
			switch($TrangThai){
				case '0': ThiDB::update(array('TrangThai'=>1));
				case '1': $this->wait(); break;
				case '2': $this->ready(); break;
				case '3': $this->test(); break;
				case '4': $this->finish(); break;
			}
		}else{
			$this->error();
		}
	}
	function get_status(){
		$status = ThiDB::get_status();
		if($status==2){
			$ThongTinThiSinh = Session::get('thi');
			$ThongTinThiSinh['TrangThai'] = 2;
			Session::set('thi',$ThongTinThiSinh);
		}
		echo $status;
		exit();
	}
	function error(){
		require_once 'forms/error.php';
		$this->add_form(new ThiErrorForm());
	}
	function wait(){
		require_once 'forms/wait.php';
		$this->add_form(new ThiWaitForm());
	}
	function ready(){
		require_once 'forms/ready.php';
		$this->add_form(new ThiReadyForm());
	}
	function test(){
		require_once 'forms/thi.php';
		$this->add_form(new ThiTestForm());	
	}
	function finish(){
		require_once 'forms/finish.php';
		$this->add_form(new ThiFinishForm());
	}
}
?>