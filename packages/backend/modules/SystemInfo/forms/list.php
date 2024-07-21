<?php
class SystemInfoForm extends Form
{
	function SystemInfoForm()
	{
		Form::Form('SystemInfoForm');
	}	
	function phpinfo_array($return=false)
	{
		ob_start();
		phpinfo(-1);		
		$pi = preg_replace(
		array('#^.*<body>(.*)</body>.*$#ms', '#<h2>PHP License</h2>.*$#ms',
		'#<h1>Configuration</h1>#',  "#\r?\n#", "#</(h1|h2|h3|tr)>#", '# +<#',
		"#[ \t]+#", '#&nbsp;#', '#  +#', '# class=".*?"#', '%&#039;%',
		'#<tr>(?:.*?)" src="(?:.*?)=(.*?)" alt="PHP Logo" /></a>'
		.'<h1>PHP Version (.*?)</h1>(?:\n+?)</td></tr>#',
		'#<h1><a href="(?:.*?)\?=(.*?)">PHP Credits</a></h1>#',
		'#<tr>(?:.*?)" src="(?:.*?)=(.*?)"(?:.*?)Zend Engine (.*?),(?:.*?)</tr>#',
		"# +#", '#<tr>#', '#</tr>#'),
		array('$1', '', '', '', '</$1>' . "\n", '<', ' ', ' ', ' ', '', ' ',
		'<h2>PHP Configuration</h2>'."\n".'<tr><td>PHP Version</td><td>$2</td></tr>'.
		"\n".'<tr><td>PHP Egg</td><td>$1</td></tr>',
		'<tr><td>PHP Credits Egg</td><td>$1</td></tr>',
		'<tr><td>Zend Engine</td><td>$2</td></tr>' . "\n" .
		'<tr><td>Zend Egg</td><td>$1</td></tr>', ' ', '%S%', '%E%'),
		ob_get_clean());		
		$sections = explode('<h2>', strip_tags($pi, '<h2><th><td>'));
		unset($sections[0]);		
		$pi = array();
		//System::debug($sections);
		foreach($sections as $section)
		{
			$n = substr($section, 0, strpos($section, '</h2>'));
			preg_match_all('#%S%(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?%E%#',$section, $askapache, PREG_SET_ORDER);
			//System::debug($askapache); exit();
			foreach($askapache as $m){
				//System::debug($m);
				//echo $m[2]?$m[2]:' Error ------------------------==========+++++++++++++++ '.'<br>';
				if(!isset($m[3]) or $m[2]==$m[3]){
					if(isset($m[2])){
						$pi[$n][$m[1]]=$m[2];
					}else{
						$pi[$n][$m[1]]=array_slice($m,2);
					}
				}else{
					$pi[$n][$m[1]]=array_slice($m,2);
				}
				//$pi[$n][$m[1]]=(!isset($m[3]) or $m[2]==$m[3])?$m[2]:array_slice($m,2);
			}
			//exit();
		}
		//System::debug($pi);
		return ($return === false) ? print_r($pi) : $pi;
	}
	function draw()
	{			
		$system_info = $this->phpinfo_array(true);
		//System::debug($system_info);
		$this->parse_layout('list',array(
			'system_info'=>$system_info
		));
	}
}
?>