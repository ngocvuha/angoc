<?php 
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY VUONGIGALONG
******************************/
class PageAdmin extends Module
{
	function PageAdmin($row)
	{
		Module::Module($row);
		require_once 'db.php';
		if(User::can_view())
		{
			/* Xóa trang */
			if(Url::get('cmd')=='delete' and is_array(Url::get('selected_ids')) and sizeof(Url::get('selected_ids'))>0 and User::can_delete())
			{
				if(Url::get('selected_ids')){
					foreach(Url::get('selected_ids') as $id)
					{
						$this->delete_page($id);
					}
					Url::redirect_current(array('page_no','name','title_1','package_id'));
				}
			/* Cập nhật trạng thái Ẩn, Hiện của trang */
			}elseif(Url::get('cmd')=='update_hide' and $id=Url::iget('id') and User::can_edit()){
				if(Url::get('hide')=='true') $hide=1;
				else $hide=0;
				DB::update_id('page',array('hide'=>$hide),$id);
				exit();
			/* Cập nhật trạng thái Cache của trang
			** Nếu không dùng cache sẽ xóa file cache của trang tương ứng tại cache/html/page=tên trang.html
			*/
			}elseif(Url::get('cmd')=='update_cache' and $id=Url::iget('id') and $page=DB::exists_id('page',$id) and User::can_edit()){
				if(Url::get('cache')=='true') $cache=1;
				else{
					$cache=0;
					if(file_exists('cache/html/page='.$page['name'].'.html')){
						@unlink('cache/html/page='.$page['name'].'.html');
					}
				}
				DB::update_id('page',array('cachable'=>$cache),$id);
				exit();
			}else{
				switch(URL::get('cmd'))
				{
					/* Thêm, Sửa trang */
					case 'edit':
					case 'add':
						require_once 'forms/edit.php';
						$this->add_form(new EditPageAdminForm());break;
					/* Nhân bản trang */
					case 'duplicate':
						require_once 'forms/duplicate.php';
						$this->add_form(new DuplicatePageForm());break;
					/* Danh sách trang */
					default: 
						require_once 'forms/list.php';
						$this->add_form(new ListPageAdminForm());
						break;
				}
			}
		}
		else
		{
			URL::access_denied();
		}
	}
	function get_cond(){
		$cond = '1=1';
		if(Url::get('package_id')){
			$cond.=' and '.IDStructure::child_cond(DB::structure_id('package',Url::get('package_id')));
		}
		if(Url::get('search_name')){
			$cond.=" and page.name LIKE '%".Url::get('search_name')."%'";
		}
		if(Url::get('search_title_1')){
			$cond.=" and page.title_1 LIKE '%".Url::get('search_title_1')."%'";
		}
		return $cond;
	}
	/* Xóa trang có id là $id */
	function delete_page($id){
		if($row=DB::select('page',$id)){
			$blocks = DB::select_all('block','page_id='.$id);
			foreach ($blocks as $key=>$value){
				DB::delete('block_setting', 'block_id='.$value['id']); 
			}
			DB::delete('block', 'page_id='.$id); 
			DB::delete_id('page', $id);
		}
	}
}
?>