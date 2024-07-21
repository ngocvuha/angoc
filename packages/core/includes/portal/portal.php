<?php
class Portal
{
	static $current = false;
	static $extra_header = '';
	static $css_header = '';
	static $js_header = '';
	static $extra_footer = '';
	static $page_start_time = 0;
	static $page = false;
	static $meta_keywords = '';
	static $meta_description = '';
	static $document_title = '';
	static $query = '';
	static $cache = '';
	static function run()
	{
		//System::banip();
		if(!Portal::get_setting('web_block') or User::is_admin() or (Url::get('page')=='admin'))
		{
			if(!Session::get('language_changed'))
			{
				Session::set('language_id',Portal::get_setting('default_language'));			
			}
			if(!(Portal::$query=$_SERVER['QUERY_STRING'])){
				Portal::$query='page=trang-chu';
			}
			$cachefile = ROOT_PATH.'cache/html/'.THEME.'/'.Portal::$query.'.html';			
			if(Portal::check_generate_html_cache() and file_exists($cachefile)){
				require $cachefile;
			}else{
				$page_name = Url::get('page');
				if($page_name){
					$sql = "select *, title_".Portal::language()." as title from page where name='".$page_name."' and hide='0'";
					if($page = DB::fetch($sql))
					{
						$_REQUEST['page_name'] = $page['title'];
						Portal::run_page($page,$page['name'],$page['params']);
					}
				}elseif($page = DB::fetch("select * from page where name='trang-chu'")){
					Portal::run_page($page,$page['name'],$page['params']);
				}
			}
			Session::end();
			DB::close();
		}else{
			exit(Portal::get_setting('notification_when_interrption'));
		}
	}
	function run_page($row, $page_name, $params=false)
	{
		if(Portal::check_generate_html_cache()){ob_start("Portal::html_cache");}
		$page_file = ROOT_PATH.'cache/pages/'.$page_name.'.cache.php';
		if(file_exists($page_file) and USE_CACHE)
		{
			require_once $page_file;
		}else{
			require_once 'packages/core/includes/portal/generate_page.php';
			$generate_page = new GeneratePage($row);
			$generate_page->generate();
			$page_name=$row['name'];
		}
		if(Portal::check_generate_html_cache()){ ob_end_flush(); require_once Portal::$cache;}
	}
	/* Tạo file cache html nội dung lấy từ buffer
	*/
	function html_cache($buffer){
		$dir = ROOT_PATH.'cache/html';
		if(!is_dir($dir))
		{
			@mkdir($dir,0755,true);
		}
		Portal::$cache = $dir.'/'.Portal::$query.'.html';
		$handler = fopen(Portal::$cache,'w+');
		fwrite($handler,$buffer);
		fclose($handler);
	}
	/* kiểm tra các điều kiện để tạo và chạy html_cache
	** Nếu có $_REQUEST khác ngoài $_REQUEST['page'] và $_REQUEST['page_name'] sẽ trả về false ==> ko chay html cache
	** Chỉ chạy html cache khi chưa đăng nhập
	*/
	static function check_generate_html_cache(){
		$check = false;
		$request = $_REQUEST;
		if(isset($request['page'])) unset($request['page']);
		if(isset($request['page_name'])) unset($request['page_name']);
		if(isset($request['debug'])) unset($request['debug']);
		if($request) return false;
		$page_cache = Portal::get_page_html_cache();
		$cachefile = ROOT_PATH.'cache/html/'.Portal::$query.'.html';
		if(isset($page_cache[str_replace('page=','',Portal::$query)]) and !User::is_login()){
			$check = true;
		}
		return $check;
	}
	/* Xóa html cache
	** Tham số $page có dạng tentrang1,tentrang2,tentrang3...
	** Nếu có tham số $page sẽ xóa các cache tương ứng nếu không sẽ xóa toàn bộ html cache
	*/
	function delete_html_cache($page=false){
		require_once 'packages/core/includes/utils/dir.php';
		if($page){
			$pages=explode(',',$page);
			foreach($pages as $page){
				if(file_exists('cache/html/page='.$page.'.html')){
					@unlink('cache/html/page='.$page.'.html');
				}
			}
		}else{
			empty_all_dir('cache/html');
		}
	}
	/* Lấy ra danh sách page sẽ tạo html cache
	** Nếu có cache thì lấy từ cache, nếu không lấy từ database rồi tạo cache
	*/
	static function get_page_html_cache(){
		$dir='cache/config/html_cache.php';
		if(file_exists($dir)){
			require_once $dir;
			if(isset($page) and is_array($page) and sizeof($page)>0) return $page;
		}
		if($page=DB::fetch_all('select name as id from page where cachable=1')){
			if(!is_dir('cache/config'))
			{
				@mkdir('cache/config',0755,true);
			}
			File::export_file($dir,'page',$page);
			return $page;
		}
		return array();
	}
	/* Trả về đường dẫn thư mục template giao diện
	*/
	function template()
	{
		return 'templates/'.THEME;;	
	}
	/* Trả về tên lệnh tương ứng với tham số cmd
	*/
	function get_action($cmd=''){
		$action = 'Danh sách';
		if(isset($cmd) and $cmd){
			switch ($cmd){
				case 'add':
					$action = 'Thêm'; break;
				case 'add_value':
					$action = 'Thêm giá trị'; break;
				case 'edit':
					$action = 'Sửa'; break;
				case 'delete':
					$action = 'Xóa'; break;
				case 'view':
					$action = 'Xem'; break;
				case 'duplicate':
					$action = 'Nhân bản'; break;
				case 'detail':
					$action = 'Chi tiết'; break;
				case 'generate':
					$action = 'Tạo ra'; break;
				case 'grant':
					$action = 'Gán quyền'; break;
				case 'import':
					$action = 'Import'; break;
			}
		}
		return $action;
	}
	/* Trả về mảng status
	*/
	function get_status(){
		$default=array('SHOW'=>'Hiển thị','HIDE'=>'Ẩn');
		$dir='cache/config/status.php';
		if(file_exists($dir)){
			require $dir;
			if(isset($status) and is_array($status) and sizeof($status)>0){
				return $status;
			}
		}
		return $default;
	}
	/* Trả về mảng currency
	*/
	function get_currency(){
		$dir='cache/tables/currency.cache.php';
		if(file_exists($dir)){
			require_once $dir;
			if(isset($currency) and is_array($currency) and sizeof($currency)>0){
				return $currency;
			}
		}
		return array();
	}
	/* Trả về mảng category có type="$type"
	*/
	function get_category($type){
		$dir='cache/db/'.$type.'_category.cache.php';
		if(file_exists($dir)){
			require_once $dir;
			if(isset($category) and is_array($category) and sizeof($category)>0){
				return $category;
			}
		}
		// lấy danh mục từ cơ sở dữ liệu và tạo cache
		$category = DB::fetch_all("
			SELECT
				category.*
				,category.name_".Portal::language()." as name
				,category.description_".Portal::language()." as description
			FROM
				category
			WHERE
				type='".strtoupper($type)."' and status<>'HIDE' and structure_id<>'".ID_ROOT."' and ".IDStructure::child_cond(ID_ROOT)."
			ORDER BY
				structure_id
		");
		if($category){
			foreach($category as $key=>$value){
				$indent='';
				for($i=1;$i<IDStructure::level($value['structure_id']);$i++){
					$indent.='-- ';
				}
				$category[$key]['indent'] = $indent;
				if(IDStructure::have_child('category',$value['structure_id'])){
					$category[$key]['have_child'] = 1;
				}else{
					$category[$key]['have_child'] = 0;
				}
				
			}
		}
		$file_name = 'category';
		File::export_file($dir,$file_name,$category);
		return $category;
	}
	/* Trả về customer_group_id (nhóm khách hàng)
	*/
	static function customer_group_id(){
		if(Session::get('customer_group_id')){
			return Session::get('customer_group_id');
		}else{
			// customer_group_id=1 là nhóm khách hàng chưa đăng nhập hoạch chưa được phân nhóm khách hàng
			return 1;
		}
	}
	static function get_customer_group($user_id=false){
		if(!$user_id) $user_id=User::id();
		$customer = DB::fetch("
			SELECT
				customer_group.*
			FROM
				customer_group
				INNER JOIN account ON customer_group.id=account.customer_group_id
			WHERE
				account.id='".$user_id."'
		");
		if(!$customer) $customer=DB::select('customer_group','id=1');
		return $customer;
	}
	static function template_css($portal='default')
	{
		return 'skins/'.$portal.'/';
	}
	static function template_js($package= 'core')
	{
		return 'packages/'.$package.'/includes/js/';
	}
	static function language($name=false)
	{
		if($name)
		{
			if(isset($GLOBALS['all_words']['[[.'.$name.'.]]']))
			{
				return $GLOBALS['all_words']['[[.'.$name.'.]]'];
			}
			else
			{
				$languages = System::get_language();
				$row = array();
				foreach($languages as $language)
				{
					$row['value_'.$language['id']] = ucfirst(str_replace('_',' ',$name));
				}
				DB::insert('word',$row + array(
					'id'=>$name,
					'package_id'=>Module::$current->data['module']['package_id']
				),1);
				Portal::make_word_cache();
				return $name;
			}
		}
		if(Session::is_set('language_id') and Session::get('language_id')!='')
		{
			return Session::get('language_id');
		}
		return 1;
	}
	static function get_setting($name, $default=false)
	{
		$dir = 'cache/config/config.php';
		if(file_exists($dir)){
			require $dir;
		}else{
			$config = DB::fetch_all('SELECT name as id,value,hide FROM setting');
		}
		if(isset($config[$name]) and $config[$name]['value']){
			return $config[$name]['value'];
		}
		return $default;
	}
	static function set_setting($name, $value='')
	{
		if(isset($name) and $name){
			if($setting = DB::select('setting',"name='".$name."'"))
			{
				DB::update('setting',array('value'=>$value),"name='".$name."'");
			}else{
				DB::insert('setting',array('name'=>$name,'value'=>$value));
			}
			$path = 'cache/config/config.php';
			$content = DB::fetch_all('SELECT name as id,value,hide FROM setting');
			File::export_file($path,'config',$content);
		}
	}
	function guide($id=false,$language=false){
		if($language){
			$language = $language;
		}else{
			$language = Portal::language();
		}
		if($id){
			$content = DB::fetch('select content_'.$language.' as content from guide where id = '.$id,'content');
			if(User::can_admin(MODULE_MANAGEGUIDE,ANY_CATEGORY)){
				$content .= '<span style="color:red; margin-left:10px;cursor:pointer" onclick="window.open(\''.Url::build('guide',array('id'=>$id,'cmd'=>'edit','opener'=>'1')).'\',\'EditGuide\',\'resizable=0\')">'.Portal::language('edit').'</span>';
			}
		}else{
			$content = '';
		}
		return $content;
	}
	static function make_word_cache()
	{
		$languages = System::get_language();
		foreach($languages as $language_id=>$row)
		{
			$all_words = DB::fetch_all('
					SELECT 
						id, value_'.$language_id.' as value 
					FROM
						word 
				');
			$language_convert = array();
			foreach($all_words as $language)
			{
				$language_convert = $language_convert + 
					array('[[.'.$language['id'].'.]]'=>$language['value']);
			}
			if($language_id==Portal::language())
			{
				$GLOBALS['all_words'] = $language_convert;
			}
			$st = '<?php
if(!isset($GLOBALS[\'all_words\']))
{
	$GLOBALS[\'all_words\'] = '.var_export($language_convert,1).';
}
?>';
			$f = fopen('cache/languages/language_'.$language_id.'.php','w+');
			fwrite($f,$st);
			fclose($f);
			$st = 'all_words = '.String::array2js($language_convert).';';
			$f = fopen('cache/languages/language_'.$language_id.'.js','w+');
			fwrite($f,$st);
			fclose($f);
		}
	}
}
Portal::$page_start_time = microtime(true);
require_once 'cache/languages/language_'.Portal::language().'.php';
Portal::$current = new Portal();
?>