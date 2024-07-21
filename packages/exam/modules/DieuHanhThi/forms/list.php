<?php
class DieuHanhThiForm extends Form
{
	function DieuHanhThiForm()
	{
		Form::Form('DieuHanhThiForm');
	}
	function update($list,$status,$cond){
		$ids = '-1';
		foreach($list as $k=>$v){
			$ids .= ','.intval($k);
		}
		DB::update('tblDSDuThi',array('TrangThai'=>$status,),'ID in ('.$ids.') and TrangThai = '.$cond);
	}
	function on_submit(){
		$post = $_POST;
		if(isset($post['ChoThi'])){
			$this->update($post['ChoThi'],2,1);
		}
		if(isset($post['DuocThi'])){
			$this->update($post['DuocThi'],0,2);
		}
		if(isset($post['DangThi'])){
			$this->update($post['DangThi'],0,3);
		}
		Url::redirect_current(array('PhongThi'));
	}
	function draw()
	{
		$this->map['phongthi'] = DieuHanhThiDB::getPhongThi();
		$this->map['TenPhongThi'] = '';
		$this->map['ChuaThi_C'] = '';
		$this->map['ChoThi_C'] = '';
		$this->map['DuocThi_C'] = '';
		$this->map['DangThi_C'] = '';
		$this->map['DaThi_C'] = '';
		$debug = Url::iget('debug');
		if($id = Url::iget('PhongThi') and $phongthi = DieuHanhThiDB::PhongThi($id)){
			$this->map['TenPhongThi'] = $this->map['phongthi'][$id]['Ten'];
			$list = DieuHanhThiDB::getThiSinh($id);			
			if($list){
				$split = array();
				$count = array(0,0,0,0,0);
				foreach($list as $k=>$v){
					$split[$v['TrangThai']][$k] = $v;
					$count[$v['TrangThai']]++;
				}
				$this->map['ChuaThi_C'] = $count[0];
				$this->map['ChoThi_C'] = $count[1];
				$this->map['DuocThi_C'] = $count[2];
				$this->map['DangThi_C'] = $count[3];
				$this->map['DaThi_C'] = $count[4];
				if(isset($split[0])) $this->map['ChuaThi'] = $split[0];
				if(isset($split[1])) $this->map['ChoThi'] = $split[1];
				if(isset($split[2])) $this->map['DuocThi'] = $split[2];
				if(isset($split[3])) $this->map['DangThi'] = $split[3];
				if(isset($split[4])) $this->map['DaThi'] = $split[4];
				//System::debug($this->map['DaThi']);
			}
		}		
		$this->parse_layout('list',$this->map);
	}
}
?>