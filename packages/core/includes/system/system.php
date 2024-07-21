<?php
/******************************
COPY RIGHT BY NYN PORTAL - TCV
WRITTEN BY vuonggialong
******************************/

//Lop he thong
//Cac ham dung chung thong dung cho vao day
class Timer
{
	var $starttime = 0;
    function start_timer()
    {
        $mtime = microtime(true);
		$this->starttime = $mtime;
    }
}

class System
{
	static $false = false;
	function send_mail($from,$to,$subject,$content,$from_name='',$reply_to="",$email_content_text="")
	{
		require 'lib/php/phpmailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = Portal::get_setting('system_email_smtp');  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = Portal::get_setting('system_email');                 // SMTP username
		$mail->Password = Portal::get_setting('system_email_password');                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = Portal::get_setting('system_email_port');                                    // TCP port to connect to
		
		$mail->From = $from;
		$mail->FromName = $from_name?$from_name:$from;
		//$mail->addAddress($email, $name);     // Add a recipient
		$mail->addAddress($to);               // Name is optional
		if($reply_to) $mail->addReplyTo($reply_to, 'Đăng ký học tại website tingiaoduc.vn');
		//$mail->addCC('ncquan@example.com');
		//$mail->addBCC('bcc@example.com');
		
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = $subject;
		$mail->Body    = $content;
		$mail->AltBody = strip_tags($email_content_text);
		
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
	function halt()
	{
		Session::end();
		DB::close();
		exit();
	}
	function log($type, $title='', $description = '', $parameter = '', $note = '', $user_id = false)
	{
		DB::insert('log', array(
			'type'=>$type, 
			'module_id'=>is_object(Module::$current)?Module::block_id():0,
			'title'=>$title, 
			'description'=>$description, 
			'parameter'=>$parameter, 
			'note'=>$note, 
			'time'=>time(),
			'user_id'=>$user_id?$user_id:is_object(User::$current)?User::id():0)
		);
	}
	function set_page_title($title)
	{
		echo '<script type="text/javascript">document.title=\''.str_replace('\'','&quot;',$title).'\';</script>';
	}
	function set_page_description($description)
	{
		echo '<script type="text/javascript">document.description=\''.str_replace('\'','&quot;',$description).'\';</script>';
	}
	function add_meta_tag($tags)
	{
		global $meta_tags;
		if(isset($meta_tags))
		{
	 		$meta_tags.=$tags;
		}
		else
		{
			$meta_tags=$tags;
		}
	}
	function display_number($num)
	{
		if($num==round($num))
		{
			return number_format($num,0,'','.');
		}
		else
		{
			return number_format($num,2,'.',',');
		}
	}
	function display_price($num,$dec=0)
	{
		if(Portal::get_setting('default_currency')=='VNĐ' or Portal::get_setting('default_currency')=='VND' or Portal::get_setting('default_currency')=='đ'){
			return number_format($num,$dec,',','.');
		}else{
			return number_format($num,2,'.',',');
		}
	}
	function format_price($num)
	{
		if(Portal::get_setting('default_currency')=='VNĐ' or Portal::get_setting('default_currency')=='đ'){
			return str_replace('.','',$num);
		}else{
			return str_replace(',','',$num);
		}
	}
	function display_number_report($num)
	{
		return number_format($num,2,'.',',');
	}
	function debug($array)
	{
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
	// Lấy mảng ngôn ngữ
	function get_language(){
		if(file_exists('cache/tables/language.cache.php')){
			require_once 'cache/tables/language.cache.php';
			if(isset($cache_language) and $cache_language){
				$languages = $cache_language;
			}else{
				$languages = DB::fetch_all('select * from language where status order by id');
			}
		}else{
			$languages = DB::fetch_all('select * from language where status order by id');
		}
		foreach($languages as $key=>$value){
			$languages[$key]['url'] = Url::build('change_language',array('language_id'=>$key,'href'=>substr($_SERVER['REQUEST_URI'],1)));
		}
		return $languages;
	}
	function css_compress($buffer,$temp){
			// remove comments
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		 // remove tabs, spaces, new lines, etc. 
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
		// remove unnecessary spaces
		$buffer = str_replace('{ ', '{', $buffer);
		$buffer = str_replace(' }', '}', $buffer);
		$buffer = str_replace('; ', ';', $buffer);
		//$buffer = str_replace(', ', ',', $buffer);
		$buffer = str_replace(' {', '{', $buffer);
		$buffer = str_replace('} ', '}', $buffer);
		//$buffer = str_replace(': ', ':', $buffer);
		$buffer = str_replace(' ,', ',', $buffer);
		$buffer = str_replace(' ;', ';', $buffer);
		if(isset($temp) and $temp)
			return preg_replace('@(\.\.\/)+@','/'.$temp.'/',$buffer);
		else
			return $buffer;
	}
	function banip(){
		$c_ip=$_SERVER['REMOTE_ADDR'];
		$banip_file='cache/tables/banip.cache.php';
		if(file_exists($banip_file)){
			require_once $banip_file;
			if(isset($banip[$c_ip])){
				die('<div align="center"><h1>Địa chỉ IP này <strong style="color:red;">'.$c_ip.'</strong> đã bị khóa vì lý do an ninh.</h1></div>');
			}
		}else
		if(DB::exists('select * from lockip where ip="'.$c_ip.'"')){
			die('<div align="center"><h1>Địa chỉ IP này <strong style="color:red;">'.$c_ip.'</strong> đã bị khóa vì lý do an ninh.</h1></div>');
		}
	}
	function execInBackground() {
		//echo $_SERVER['DOCUMENT_ROOT']; exit();
		$m=shell_exec("D:\wamp\bin\php\php5.3.5\php.exe -f '".str_replace('/','\\',$_SERVER['DOCUMENT_ROOT'])."\test.php' &");
		echo $m;
		/*if (file_exists($path . $exe)) {
			chdir($path);
			if (substr(php_uname(), 0, 7) == "Windows"){
				pclose(popen("start \"bla\" \"" . $exe . "\" " . escapeshellarg($args), "r"));    
			} else {
				exec("./" . $exe . " " . escapeshellarg($args) . " > /dev/null &");
			}
		}*/
	}

	function run_cronjob($id=false){
		//System::execInBackground();
		set_time_limit(0);
		if($id and $item=DB::exists_id('cronjob',$id)){
			System::run_cronjob_one($item);
		}else{
			$sql="SELECT * FROM cronjob WHERE `act`=1 AND `start_time` <= '".CURRENTTIME."' ORDER BY `id`";
			if($cronjobs=DB::fetch_all($sql)){
				foreach($cronjobs as $key=>$value){
					System::run_cronjob_one($value);
					sleep(10);
				}
			}
		}
	}
	function run_cronjob_one($item){
		$cron_allowed=false;
		if(empty($item['interval'])){
			$cron_allowed=true;
		}else{
			$interval=$item['interval']*60;
			if($item['start_time'] > CURRENTTIME){
				$last_time=$item['start_time'];
			}else{
				if($item['last_time'] >= $item['start_time']){
					$last_time=$item['last_time']+$interval;
				}else{
					$last_time=$item['start_time'];
				}
			}
			if($last_time<CURRENTTIME){
				$cron_allowed=true;
			}
		}
		if($cron_allowed){
			if(!empty($item['run_file']) and preg_match("/^([a-zA-Z0-9\-\_\.]+)\.php$/",$item['run_file']) and file_exists(ROOT_PATH.'/lib/php/cronjobs/'.$item['run_file'])){
				require_once(ROOT_PATH.'/lib/php/cronjobs/'.$item['run_file']);
			}
			if(!function_exists($item['run_func'])){
				DB::update_id('cronjob',array('act'=>0,'last_time'=>CURRENTTIME,'last_result'=>0),$item['id']);
			}else{
				$params=(!empty($item['params']))?array_map("trim",explode(",",$item['params'])):array();
				$result2=call_user_func_array($item['run_func'],$params);
				if(!$result2){
					DB::update_id('cronjob',array('act'=>0,'last_time'=>CURRENTTIME,'last_result'=>0),$item['id']);
				}else{
					if($item['del']){
						DB::delete_id('cronjob',$item['id']);
					}elseif(empty($item['interval'])){
						DB::update_id('cronjob',array('act'=>0,'last_time'=>CURRENTTIME,'last_result'=>1),$item['id']);
					}else{
						DB::update_id('cronjob',array('last_time'=>CURRENTTIME,'last_result'=>1),$item['id']);
					}
				}
			}
		}
	}
	// Trả lại đường dẫn file cache db
	function file_cache_db($type='news'){
		return 'cache/db/'.$type.'/'.Module::$current->data['module']['name'].'/db_'.Portal::language().'.php';
	}
	function file_check($file,$timeout=600){
		return file_exists($file)&&(time()-filemtime($file)<$timeout);
	}
	function delete_cache_db($type=false,$module=false){
		require_once 'packages/core/includes/utils/dir.php';
		if($type){
			if($module){
				$folder='cache/db/'.$type.'/'.$module.'/';
			}else{
				$folder='cache/db/'.$type.'/';
			}
		}else{
			$folder='cache/db/';
		}
		empty_all_dir($folder);
	}
}
class String
{
	function array2suggest($array)
	{
		$st = '[';
		$i = 0;
		$size_of_array = sizeof($array);
		foreach($array as $key=>$value)
		{
			$st.='{';
			if(isset($value['name']))
			{
				$st.='name:"'.String::string2js($value['name']).'",to:"'.$key.'", id:"'.$key.'"';
			}
			else
			{
				$st.='name:"'.$key.'",to:"'.$key.'", id:"'.$key.'"';
			}
			$i++;
			if($i==$size_of_array)
			{
				$st.='}';
			}
			else
			{
				$st.='},
';
			}
		}
		$st.= ']';
		return $st;
	}
	function str_multi_language($vn,$en=false)
	{
		if(Portal::language()==1)
		{
			return $vn;
		}
		else
		if(Portal::language()==2)
		{
			return ($en!=false)?$en:$vn;
		}
		else
		if(Portal::language()==3)
		{
			return ($en!=false)?$en:$vn;
		}
		else
		if(Portal::language()==4)
		{
			return ($en!=false)?$en:$vn;
		}
		else
		{
			return ($en!=false)?$en:$vn;
		}
	}
	function language_field_list($name)
	{
		$languages = DB::select_all('language');
		$st = '';
		foreach($languages as $language)
		{
			if($st)
			{
				$st .= ',';
			}
			$st .= $name.'_'.$language['id'];
		}
		return $st;
	}
	function display_sort_title($str,$word_number,$char=false)
	{
		$str = strip_tags($str);
		if($char)
		{
			$length = strlen($str);
			if($word_number<$length)
			{
				return substr($str,0,$word_number-$length).'...';
			}else{
				return $str;
			}
		}else{
			$str = preg_replace('/(^[Ã]\s)\s+/','$1', trim($str));
			$arr = explode(' ',$str);
			$c = sizeof($arr);
			$new_str='';
			if($word_number < $c)
			{
				$i=0;
				while($i<$word_number)
				{
					$new_str.=$arr[$i].' ';
					$i++;
				}
				return $new_str.'...';
			}
			else
			{
				return $str;
			}
		}
	}
	function word_count($str){
		$str = preg_replace('/(^[Ã]\s)\s+/','$1', trim(strip_tags($str)));
		$arr = explode(' ',$str);
		return sizeof($arr);
	}
	function html_normalize($st)
	{
		return str_replace(array('"','<'),array('&quot;','&lt;'),$st);
	}
	function string2js($st)
	{
		return strtr($st, array('\''=>'\\\'','\\'=>'\\\\','\n'=>'',chr(10)=>'\\
',chr(13)=>''));
	}
	function array2js($array)
	{
		$st = '{';
		foreach($array as $key=>$value)
		{
			if($st!='{')
			{
				$st.='
,';
			}
			$st.='\''.String::string2js($key).'\':';
			if(is_array($value))
			{
				$st .= String::array2js($value);
			}
			else
			{
				$st .= '\''.String::string2js($value).'\'';
			}
		}
		return $st.'
}';
	}
	function array2tree(&$items,$items_name)
	{
		//$structure_ids = array(ID_ROOT=>1);
		$show_items = array();
		$min = -1;
		foreach($items as $item)
		{
			if($min==-1)
			{
				$min = IDStructure::level($item['structure_id']);
			}
			$structure_ids[number_format($item['structure_id'],0,'','')] = $item['id'];
			//echo number_format($item['structure_id'],0,'','').'<br>';
			if(IDStructure::level($item['structure_id'])<=$min)
			{
				$show_items[$item['id']] = $item+(isset($item['childs'])?array():array($items_name=>array()));
			}
			else
			{
				$st = '';
				$parent = $item['structure_id'];
				
				while(($level=IDStructure::level($parent = IDStructure::parent($parent)))>=$min and $parent and isset($structure_ids[number_format($parent,0,'','')]))
				{
					
					$st = '['.$structure_ids[number_format($parent,0,'','')].'][\''.$items_name.'\']'.$st;
					
				}
				//echo number_format($parent,0,'','').' '.$st.'<br>';
				if($level<$min or $level==0)
				{
					//echo '$show_items'.$st.'['.$item['id'].']<br>';
					eval('$show_items'.$st.'['.$item['id'].'] = $item+array($items_name=>array());');
				}
			}
		}
		return $show_items;
	}
//convert to vnnumeric
	function convert_to_vnnumeric($st)
	{
		//$temp = str_replace('.','',$st);
		return str_replace(',','',$st);
	}
//convert string to number	
	function to_number($st,$count=0)
	{
		$temp = substr($st,$count);
		$n = 0;
		for($i=0;$i<strlen($temp);$i++)
		{
			$n = $n*10 + $temp[$i]; 
		}
		return $n;
	}
	function get_list($items, $field_name=false,$indent=false)
	{
		//System::debug($items);
		$item_list = array();
		foreach($items as $item)
		{
			if(!$field_name)
			{
				$field_name=isset($item['name'])?'name':(isset($item['title'])?'title':(isset($item['name_'.Portal::language()])?'name_'.Portal::language():(isset($item['title_'.Portal::language()])?'title_'.Portal::language():'id')));
			}
			if(isset($item['structure_id']))
			{
				$level = IDStructure::level($item['structure_id']);
				for($i=0;$i<$level;$i++)
				{
					$item[$field_name] = ($indent?$indent:' --- ').$item[$field_name];
				}
			}
			$item_list[$item['id']]=isset($item[$field_name])?$item[$field_name]:'';
		}
		return $item_list;
	}
	function get_select_list($items=array(),$name='category_id',$non_parent=false,$id=false,$field=false,$indent=false){
		$result='';
		if($items){System::debug($items);
			if(!$id) $id='id';
			foreach($items as $item){
				$result.='<option value="'.$item[$id].'"';
				if(!$field)
				{
					$field=isset($item['name'])?'name':(isset($item['title'])?'title':(isset($item['name_'.Portal::language()])?'name_'.Portal::language():(isset($item['title_'.Portal::language()])?'title_'.Portal::language():'id')));
				}
				if(Url::get($name)==$item[$id]){
					$result.=' selected="selected"';
				}
				if($non_parent and isset($item['have_child']) and $item['have_child']){
					// disable những bản ghi có con
					$result.=' disabled="disabled"';
				}
				$result.='>';
				if(isset($item['structure_id']) and $item['structure_id']){
					$level = IDStructure::level($item['structure_id']);
					for($i=0;$i<$level;$i++)
					{
						$result.=($indent?$indent:' --- ');
					}
				}
				$result.=$item[$field];
				$result.='</option>';
			}
		}
		return $result;
	}
	function make_tree($items,$category,$field_name='name',$indent=false)
	{
		foreach($items as $key=>$item)
		{	
			if(!$field_name)
			{
				$field_name=isset($item['name'])?'name':(isset($item['title'])?'title':(isset($item['name_'.Portal::language()])?'name_'.Portal::language():(isset($item['title_'.Portal::language()])?'title_'.Portal::language():'id')));
			}
			if(isset($item['structure_id']))
			{
				$level = IDStructure::level($item['structure_id']);
				for($i=0;$i<$level;$i++)
				{
					$item[$field_name] = ($indent?$indent:' --- ').$item[$field_name];
				}
			}
			$items[$key]['name']=isset($item[$field_name])?$item[$field_name]:'';
		}
		return $items;
	}
	function array2menu($array,$m='m'){
		$str = 'var '.$m.'=[];';
		foreach($array as $key=>$value){
			$i=0;
			$str .= $m.'['.$key.']=[];';
			if($value['childs']){
				foreach($value['childs'] as $k=>$v){
					$v['child_number']=10;
					$str .= $m.'['.$key.']['.$i.']=';
					$str .= '{r:"'.$v['name_id'].'|'.String::tojs($v['name']).'|'.$v['child_number'].'"';
					if($v['childs']){
						$str .= ',s:[';
						$check = 1;
						foreach($v['childs'] as $s=>$sv){
							if($check > 1){
								$str .= ',"'.$s.'|'.String::tojs($sv['name']).'"';
							}else{
								$str .= '"'.$s.'|'.String::tojs($sv['name']).'"';
							}
							$check++;
						}
						$str .= ']';
					}
					$str .= '};';
					$i++;
				}
			}
		}
		return $str;
	}
	function myUrlEncode($string) {
		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		return str_replace($entities, $replacements, str_replace('+','%20',urlencode($string)));
		exit();
	}
	function tojs($st){
		return strtr($st,array('"'=>'\"','\\'=>'\\\\','\n'=>'',chr(10)=>'\\',chr(13)=>''));
	}
	function simpleRandString($length=16, $list="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"){
		$newstring="";
		if($length>0){
			$lenght_list=strlen($list);
			while(strlen($newstring)<$length){
				$newstring.=$list[mt_rand(0, $lenght_list-1)];
			}
		}
		return $newstring;
	}
	function format_text($str,$type='TEXT'){
		if($type=='NUMBER'){
			$str = str_replace(array('\\',' ','"','\''),'',trim(str_replace('  ',' ',strip_tags($str))));
			if(is_numeric($str)) $str = $str;
			else $str = '';
		}else{
			$str = str_replace(array('\\','"','\''),array('','&quot;','&rsquo;'),trim(str_replace('  ',' ',$str)));
		}
		return $str;
	}
	/* strip javascript, styles, html tags, normalize entities and spaces
	** based on http://www.php.net/manual/en/function.strip-tags.php#68757
	*/
	function html2text($html=''){
		$text = $html;
		static $search = array(
			'@<script.+?</script>@usi', // Strip out javascript content
			'@<style.+?</style>@usi', // Strip style content
			'@<!--.+?-->@us', // Strip multi-line comments including CDATA
			'@</?[a-z].*?\>@usi', // Strip out HTML tags
		);
		$text = preg_replace($search, ' ', $text);
		// normalize common entities
		$text = String::normalizeEntities($text);
		// decode other entities
		$text = html_entity_decode($text, ENT_QUOTES, 'utf-8');
		// normalize possibly repeated newlines, tabs, spaces to spaces
		$text = preg_replace('/\s+/u', ' ', $text);
		$text = trim($text);
		/* we must still run htmlentities on anything that comes out!
		// for instance:
		// <<a>script>alert('XSS')//<<a>/script>
		// will become
		// <script>alert('XSS')//</script>
		*/
		return $text;
	}
	/* replace encoded and double encoded entities to equivalent unicode character
	** also see /app/bookmarkletPopup.js
	*/
	function normalizeEntities($text) {
		static $find = array();
		static $repl = array();
		if (!count($find)) {
			// build $find and $replace from map one time
			$map = array(
				array('\'', 'apos', 39, 'x27'), // Apostrophe
				array('\'', '`', 'lsquo', 8216, 'x2018'), // Open single quote
				array('\'', '`', 'rsquo', 8217, 'x2019'), // Close single quote
				array('"', '"', 'ldquo', 8220, 'x201C'), // Open double quotes
				array('"', '"', 'rdquo', 8221, 'x201D'), // Close double quotes
				array('\'', '‚', 'sbquo', 8218, 'x201A'), // Single low-9 quote
				array('"', '"', 'bdquo', 8222, 'x201E'), // Double low-9 quote
				array('\'', '′', 'prime', 8242, 'x2032'), // Prime/minutes/feet
				array('"', '″', 'Prime', 8243, 'x2033'), // Double prime/seconds/inches
				array(' ', 'nbsp', 160, 'xA0'), // Non-breaking space
				array('-', '‐', 8208, 'x2010'), // Hyphen
				array('-', '–', 'ndash', 8211, 150, 'x2013'), // En dash
				array('--', '—', 'mdash', 8212, 151, 'x2014'), // Em dash
				array(' ', ' ', 'ensp', 8194, 'x2002'), // En space
				array(' ', ' ', 'emsp', 8195, 'x2003'), // Em space
				array(' ', ' ', 'thinsp', 8201, 'x2009'), // Thin space
				array('*', '•', 'bull', 8226, 'x2022'), // Bullet
				array('*', '‣', 8227, 'x2023'), // Triangular bullet
				array('...', '…', 'hellip', 8230, 'x2026'), // Horizontal ellipsis
				array('°', 'deg', 176, 'xB0'), // Degree
				array('€', 'euro', 8364, 'x20AC'), // Euro
				array('¥', 'yen', 165, 'xA5'), // Yen
				array('£', 'pound', 163, 'xA3'), // British Pound
				array('©', 'copy', 169, 'xA9'), // Copyright Sign
				array('®', 'reg', 174, 'xAE'), // Registered Sign
				array('™', 'trade', 8482, 'x2122') // TM Sign
			);
			foreach ($map as $e) {
				for ($i = 1; $i < count($e); ++$i) {
					$code = $e[$i];
					if (is_int($code)) {
						// numeric entity
						$regex = "/&(amp;)?#0*$code;/";
					}
					elseif (preg_match('/^.$/u', $code)/* one unicode char*/) {
						// single character
						$regex = "/$code/u";
					}
					elseif (preg_match('/^x([0-9A-F]{2}){1,2}$/i', $code)) {
						// hex entity
						$regex = "/&(amp;)?#x0*" . substr($code, 1) . ";/i";
					}
					else {
						// named entity
						$regex = "/&(amp;)?$code;/";
					}
					$find[] = $regex;
					$repl[] = $e[0];
				}
			}
		} // end first time build
		return preg_replace($find, $repl, $text);
	}
	/* Trả về url sắp xếp theo $name.
	** $name có dạng ten_module.ten_truong
	** $params là các tham số truyền theo nếu có
	*/
	function order_by($name,$params=array()){
		$url='';
		$symbol='|';
		if($order_by=Url::get('order_by') and strpos($order_by,$symbol)!==false){
			$order_by=explode($symbol,$order_by);
			$order_dir=$symbol.($order_by[1]=='desc'?'asc':'desc');
			if($order_by[0]==$name){
				$url=Url::build_current($params+array('order_by'=>$name.$order_dir));
			}else{
				$url=Url::build_current($params+array('order_by'=>$name.$symbol.'asc'));
			}
		}else{
			$url=Url::build_current($params+array('order_by'=>$name.$symbol.'asc'));
		}
		return $url;
	}
	/* Trả về class của link order.
	** $name có dạng ten_module.ten_truong
	*/
	function order_by_active($name){
		if($order_by=Url::get('order_by')){
			if(strpos($order_by,$name.'|asc')!==false){
				return ' orderby-active orderby-asc';
			}elseif(strpos($order_by,$name.'|desc')!==false){
				return ' orderby-active orderby-desc';
			}
		}
		return '';
	}
	/* Trả về phần ORDER BY trong câu sql khi sắp xếp.
	** $field là mảng các trường được sắp xếp. Các phần tử trong mảng $field có dạng ten_module.ten_truong
	** $default là phần mặc định khi không có order hoặc url phần order bị sai
	*/
	function order_by_sql($field,$default=''){
		$order_by='';
		$field=array_flip($field);
		$order=array_flip(array('asc','desc'));
		if($str=Url::get('order_by')){
			$order_by = 'ORDER BY ';
			if(strpos($str,'|')!==false){
				$str=explode('|',$str);
				if(!isset($field[$str[0]]) or !isset($order[$str[1]])){
					$order_by.=$default;
				}else{
					$order_by.=$str[0].' '.$str[1];
				}
			}else{
				$order_by.=$default;
			}
		}elseif($default){
			$order_by.='ORDER BY '.$default;
		}
		return $order_by;
	}
	function show_content_limit_time($content,$from='',$to='',$default=''){
		$result='';
		if($from and $to){
			if($from<=time() and $to>=time()){
				$result=$content;
			}
		}elseif($from and !$to){
			if($from<=time()){
				$result=$content;
			}
		}elseif(!$from and $to){
			if($to>=time()){
				$result=$content;
			}
		}
		if($result) return $result;
		elseif($default) return $default;
		else return false;
	}
	/* Thêm tiếp đầu ngữ vào tên file trong đường dẫn của file đó
	*/
	function add_prefix($file,$prefix){
		$arr=explode('/',$file);
		$total=sizeof($arr)-1;
		$arr[$total]=$prefix.$arr[$total];
		return implode('/',$arr);
	}
	function stripwhitespace( $bff )
	{
		$pzcr = 0;
		$pzed = strlen( $bff ) - 1;
		$rst = "";
		while( $pzcr < $pzed )
		{
			$t_poz_start = stripos( $bff, "<textarea", $pzcr );
			if( $t_poz_start === false )
			{
				$bffstp = substr( $bff, $pzcr );
				$temp = String::stripBuffer( $bffstp );
				$rst .= $temp;
				$pzcr = $pzed;
			}
			else
			{
				$bffstp = substr( $bff, $pzcr, $t_poz_start - $pzcr );
				$temp = String::stripBuffer( $bffstp );
				$rst .= $temp;
				$t_poz_end = stripos( $bff, "</textarea>", $t_poz_start );
				$temp = substr( $bff, $t_poz_start, $t_poz_end - $t_poz_start );
				$rst .= $temp;
				$pzcr = $t_poz_end;
			}
		}
		return String::html_compress( $rst );
	}
	
	function stripBuffer( $bff )
	{
		/* carriage returns, new lines */
		$bff = str_replace( array(
			"\r\r\r",
			"\r\r",
			"\r\n",
			"\n\r",
			"\n\n\n",
			"\n\n" ), "\n", $bff );
		/* tabs */
		$bff = str_replace( array(
			"\t\t\t",
			"\t\t",
			"\t\n",
			"\n\t" ), "\t", $bff );
		/* opening HTML tags */
		$bff = str_replace( array(
			">\r<a",
			">\r <a",
			">\r\r <a",
			"> \r<a",
			">\n<a",
			"> \n<a",
			"> \n<a",
			">\n\n <a" ), "><a", $bff );
		$bff = str_replace( array( ">\r<b", ">\n<b" ), "><b", $bff );
		$bff = str_replace( array(
			">\r<d",
			">\n<d",
			"> \n<d",
			">\n <d",
			">\r <d",
			">\n\n<d" ), "><d", $bff );
		$bff = str_replace( array(
			">\r<f",
			">\n<f",
			">\n <f" ), "><f", $bff );
		$bff = str_replace( array(
			">\r<h",
			">\n<h",
			">\t<h",
			"> \n\n<h" ), "><h", $bff );
		$bff = str_replace( array(
			">\r<i",
			">\n<i",
			">\n <i" ), "><i", $bff );
		$bff = str_replace( array( ">\r<i", ">\n<i" ), "><i", $bff );
		$bff = str_replace( array(
			">\r<l",
			"> \r<l",
			">\n<l",
			"> \n<l",
			">  \n<l",
			"/>\n<l",
			"/>\r<l" ), "><l", $bff );
		$bff = str_replace( array( ">\t<l", ">\t\t<l" ), "><l", $bff );
		$bff = str_replace( array( ">\r<m", ">\n<m" ), "><m", $bff );
		$bff = str_replace( array( ">\r<n", ">\n<n" ), "><n", $bff );
		$bff = str_replace( array(
			">\r<p",
			">\n<p",
			">\n\n<p",
			"> \n<p",
			"> \n <p" ), "><p", $bff );
		$bff = str_replace( array( ">\r<s", ">\n<s" ), "><s", $bff );
		$bff = str_replace( array( ">\r<t", ">\n<t" ), "><t", $bff );
		/* closing HTML tags */
		$bff = str_replace( array( ">\r</a", ">\n</a" ), "></a", $bff );
		$bff = str_replace( array( ">\r</b", ">\n</b" ), "></b", $bff );
		$bff = str_replace( array( ">\r</u", ">\n</u" ), "></u", $bff );
		$bff = str_replace( array(
			">\r</d",
			">\n</d",
			">\n </d" ), "></d", $bff );
		$bff = str_replace( array( ">\r</f", ">\n</f" ), "></f", $bff );
		$bff = str_replace( array( ">\r</l", ">\n</l" ), "></l", $bff );
		$bff = str_replace( array( ">\r</n", ">\n</n" ), "></n", $bff );
		$bff = str_replace( array( ">\r</p", ">\n</p" ), "></p", $bff );
		$bff = str_replace( array( ">\r</s", ">\n</s" ), "></s", $bff );
		/* other */
		$bff = str_replace( array( ">\r<!", ">\n<!" ), "><!", $bff );
		$bff = str_replace( array( "\n<div" ), " <div", $bff );
		$bff = str_replace( array( ">\r\r \r<" ), "><", $bff );
		$bff = str_replace( array( "> \n \n <" ), "><", $bff );
		$bff = str_replace( array( ">\r</h", ">\n</h" ), "></h", $bff );
		$bff = str_replace( array( "\r<u", "\n<u" ), "<u", $bff );
		$bff = str_replace( array(
			"/>\r",
			"/>\n",
			"/>\t" ), "/>", $bff );
		//$bff=ereg_replace(" {2,}",' ',$bff);
		//$bff=ereg_replace("  {3,}",'  ',$bff);
		$bff = str_replace( "> <", "><", $bff );
		$bff = str_replace( "  <", "<", $bff );
		/* non-breaking spaces */
		$bff = str_replace( " &nbsp;", "&nbsp;", $bff );
		$bff = str_replace( "&nbsp; ", "&nbsp;", $bff );
		/* Example of EXCEPTIONS where I want the space to remain
		between two form buttons at */
		/* <!-- http://websitetips.com/articles/copy/loremgenerator/ --> */
		/* name="select" /> <input */
		$bff = str_replace( array( "name=\"select\" /><input" ), "name=\"select\" /> <input", $bff );
	
		return $bff;
	}

	function html_compress( $html )
	{
		preg_match_all( '!(<(?:code|pre).*>[^<]+</(?:code|pre)>)!', $html, $pre );
		$html = preg_replace( '!<(?:code|pre).*>[^<]+</(?:code|pre)>!', '#pre#', $html );
		$html = preg_replace( '#<!–[^\[].+–>#', "", $html );
		$html = preg_replace( '/[\r\n\t]+/', ' ', $html );
		$html = preg_replace( '/>[\s]+</', '><', $html );
		// remote empty tag
		//$html = preg_replace('/<[^\/>]*>([\s]?)*<\/[^>]*>/', ' ', $html);
		//$html = preg_replace('/<[^\/>]*>([\s&nbsp;]?)*<\/[^>]*>/', ' ', $html);
		$html = preg_replace( '/<!--(.*)-->/Uis', '', $html );
		if( ! empty( $pre[0] ) )
			foreach( $pre[0] as $tag ) $html = preg_replace( '!#pre#!', $tag, $html, 1 );
		return trim( $html );
	}
	function nv_convert( $string )
	{
		$strings = str_replace( array(
			'&#192;',
			'&#193;',
			'&#194;',
			'&#200;',
			'&#201;',
			'&#202;',
			'&#204;',
			'&#205;',
			'&#208;',
			'&#210;',
			'&#211;',
			'&#212;',
			'&#213;',
			'&#217;',
			'&#218;',
			'&#221;',
			'&#224;',
			'&#225;',
			'&#226;',
			'&#227;',
			'&#232;',
			'&#233;',
			'&#234;',
			'&#236;',
			'&#237;',
			'&#242;',
			'&#243;',
			'&#244;',
			'&#249;',
			'&#250;',
			'&#253;',
			'&Agrave;',
			'&Aacute;',
			'&Acirc;',
			'&Egrave;',
			'&Eacute;',
			'&Ecirc;',
			'&Igrave;',
			'&Iacute;',
			'&ETH;',
			'&Ograve;',
			'&Oacute;',
			'&Ocirc;',
			'&Otilde;',
			'&Ugrave;',
			'&Uacute;',
			'&Yacute;',
			'&agrave;',
			'&aacute;',
			'&acirc;',
			'&#7927;',
			'&eacute;',
			'&ecirc;',
			'&igrave;',
			'&iacute;',
			'&ograve;',
			'&oacute;',
			'&ocirc;',
			'&ugrave;',
			'&uacute;',
			'&yacute;',
			'&#195;',
			'\'',
			'&amp;',
			'&#160;',
			'&#7893;',
			'&#7875;',
			'&#7901;',
			'&#7897;',
			'&#7843;',
			'&#160;',
			'&quot;',
			'&#7871;',
			'&#7879;',
			'&#7915;',
			'&#7911;',
			'&#7921;',
			'&#7845;',
			'&#273;',
			'&#7841;',
			'&#259;',
			'&#7849;',
			'&#7899;',
			'&rdquo;',
			'&ldquo;',
			'&#7853;',
			'&#7877;',
			'&#7847;',
			'&#7861;',
			'&#7907;',
			'&#7919;',
			'&#7909;',
			'&#7889;',
			'&#7873;',
			'&#7857;',
			'&#417;',
			'&#7859;',
			'&#7863;',
			'&#7865;',
			'&#7881;',
			'&#7895;',
			'&#7917;',
			'&#272;',
			'&#7913;',
			'&#7903;',
			'&#7867;',
			'&#7883;',
			'&#7885;',
			'&#7855;',
			'&#7869;',
			'&#432;',
			'&#7891;',
			'&#361;',
			'&#7887;',
			'&#7929;',
			'&#297;',
			'&#431;',
			'&gt;',
			'&lt;',
			'&amp;',
			'&mdash;',
			'&hellip;',
			'&egrave;',
			'&#7842;',
			'&#7851;',
			'&#7905;',
			'&#7844;',
			'&nbsp;',
			'&#7923;',
			'&#7870;',
			'&#7840;',
			'&atilde;',
			'&Atilde;',
			'&Aring;',
			'&copy;',
			'&#169;',
			'&reg;',
			'&#174;',
			'&#40;',
			'&#41;',
			'&#42;',
			'&#43;',
			'&#44;',
			'&#45;',
			'&#46;',
			'&#47;',
			'&#32;',
			'&#33;',
			'&#34;',
			'&#35;',
			'&#36;',
			'&#37;',
			'&#38;',
			'&#39;',
			'&#171',
			'&laquo;',
			'&#187;',
			'&raquo;',
			'&#8220;',
			'&#8221;',
			'&#8230;',
			'&#124;',
			'&#131;',
			'&#136;',
			'&#139;',
			'&#8216;',
			'&#8217;',
			'&ndash;',
			'&prime;' ), array(
			'À',
			'Á',
			'Â',
			'È',
			'É',
			'Ê',
			'Ì',
			'Í',
			'Ð',
			'Ò',
			'Ó',
			'Ô',
			'Õ',
			'Ù',
			'Ú',
			'Ý',
			'à',
			'á',
			'â',
			'ã',
			'è',
			'é',
			'ê',
			'ì',
			'í',
			'ò',
			'ó',
			'ô',
			'ù',
			'ú',
			'ý',
			'À',
			'Á',
			'Â',
			'È',
			'É',
			'Ê',
			'Ì',
			'Í',
			'Ð',
			'Ò',
			'Ó',
			'Ô',
			'Õ',
			'Ù',
			'Ú',
			'Ý',
			'à',
			'á',
			'â',
			'ỷ',
			'é',
			'ê',
			'ì',
			'í',
			'ò',
			'ó',
			'ô',
			'ù',
			'ú',
			'ý',
			'Ã',
			'\'',
			' ',
			' ',
			'ổ',
			'ể',
			'ờ',
			'ộ',
			'ả',
			'ể',
			'"',
			'ế',
			'ệ',
			'ừ',
			'ủ',
			'ự',
			'ấ',
			'đ',
			'ạ',
			'ă',
			'ẩ',
			'ớ',
			'"',
			'"',
			'ậ',
			'ễ',
			'ầ',
			'ẵ',
			'ợ',
			'ữ',
			'ụ',
			'ố',
			'ề',
			'ắ',
			'ơ',
			'ẳ',
			'ặ',
			'ẹ',
			'ỉ',
			'ỗ',
			'ử',
			'Đ',
			'ứ',
			'ở',
			'ẻ',
			'ị',
			'ọ',
			'ắ',
			'ẽ',
			'ư',
			'ồ',
			'ũ',
			'ỏ',
			'ỹ',
			'ĩ',
			'Ư',
			'>',
			'<',
			'&',
			'—',
			'…',
			'è',
			'Ả',
			'ẫ',
			'ỡ',
			'Ấ',
			' ',
			'ỳ',
			'Ế',
			'Ạ',
			'ã',
			'Ã',
			'Â',
			'©',
			'©',
			'®',
			'®',
			'(',
			')',
			'*',
			'+',
			',',
			'-',
			'.',
			'/',
			' ',
			'!',
			'"',
			'#',
			'$',
			'%',
			'&',
			'\'',
			'«',
			'«',
			'»',
			'»',
			'"',
			'"',
			'…',
			'|',
			'ƒ',
			'ˆ',
			'‹',
			'"',
			'"',
			'-',
			'\'' ), $string );
		return $strings;
	}
	function thumbUrl($params){
		$result='';
		if(isset($params['url']) and file_exists($params['url'])){
			$result.='timthumb/timthumb.php?src='.$params['url'];
			if(isset($params['w'])){
				$result.='&w='.$params['w'];
			}
			if(isset($params['h'])){
				$result.='&h='.$params['h'];
			}
			if(!isset($params['zc'])){
				$params['zc']=1;
			}
			$result.='&zc='.$params['zc'];
			if(!isset($params['q'])){
				$params['q']=100;
			}
			$result.='&q='.$params['q'];
		}
		return $result;
	}
	function mssql_real_escape_string($s) {
		if(get_magic_quotes_gpc()) {
			$s = stripslashes($s);
		}
		$s = str_replace("'","''",$s);
		return $s;
	}
}
class Date_Time
{
	function to_sql_date($date)
	{
		$a = explode('/',$date);
		if(sizeof($a)==3 and is_numeric($a[1]) and is_numeric($a[2]) and is_numeric($a[0]) and checkdate($a[1],$a[0],$a[2]))
		{
			return ($a[2].'-'.$a[1].'-'.$a[0]);
		}
		else
		{
			return false;
		}
	}
	function to_common_date($date)
	{
		$a = explode('-',$date);
		
		if(sizeof($a)==3 and $a[0]!='0000')
		{
			return ($a[2].'/'.$a[1].'/'.$a[0]);
		}
		else
		{
			return false;
		}	
	}
	// format d/m/Y
	function to_time($date)
	{
		if(preg_match('/(\d+)\/(\d+)\/(\d+)\s*(\d+)\:(\d+)/',$date,$patterns))
		{
			return strtotime($patterns[2].'/'.$patterns[1].'/'.$patterns[3])+$patterns[4]*3600+$patterns[5]*60;
		}
		else
		{
			$a = explode('/',$date);
			if(sizeof($a)==3 and is_numeric($a[1]) and is_numeric($a[2]) and is_numeric($a[0]) and checkdate($a[1],$a[0],$a[2]))
			{
				return strtotime($a[1].'/'.$a[0].'/'.$a[2]);
			}
			else
			{
				return false;
			}		
		}
	}
	//Tra ve ngay lon nhat trong thang (29, 30 hay 31)
	function display_date($time)
	{
		$time=date('d/m/Y',$time);
		return $time;
	}
	function daily($time)
	{
		$daily=(getdate($time));
		return $daily['weekday'];
	}
	function remain($second){
		if($second<0) return '<span style="color:red">Hết giờ</span>';
		$hours = floor($second/3600);
		$minutes = floor(($second - $hours*3600)/60);
		$second = $second-$hours*3600-$minutes*60;
		return $hours.':'.$minutes.':'.$second;
	}
}
?>