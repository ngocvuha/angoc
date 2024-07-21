input_count = 100;
all_forms = {};
function mi_add_new_row(name,setfocus)
{
	input_count++;
	if(typeof(all_forms[name])=='undefined')
	{
		all_forms[name]=[];
	}
	all_forms[name].push(input_count);
	var tr = jQuery('#'+name+'_sample tbody').html();
	tr=tr.replace(/#xxxx#/g,input_count);
	jQuery('#'+name+'_button').before(tr);
	
	if($('structure_id_'+input_count) && !$('structure_id_'+input_count).value)
	{
		var i=input_count-1;
		while(i>0)
		{
			if($('structure_id_'+i))
			{
				$('structure_id_'+input_count).value = (parseInt($('structure_id_'+i).value)-1+2);
				break;
			}
			i--;
		}
		if(i<=0)
		{
			$('structure_id_'+input_count).value = 1;
		}
	}
	if((typeof(event)!='undefined' && event)||typeof(setfocus)!='undefined')
	{
		var inputs=document.getElementsByTagName('input');
		for(var i=0;i<inputs.length;i++)
		{
			if(typeof(inputs[i].name)!='undefined' && inputs[i].id.indexOf('_'+input_count)!=-1 && inputs[i].type!="hidden" && inputs[i].style.display=='' && !inputs[i].disabled)
			{
				window.setTimeout('$(\''+inputs[i].id+'\').focus();',100);
				break;
			}
		}
		mi_update_onkeydown();
	}
}
function mi_update_onkeydown()
{
	var inputs=document.getElementsByTagName('input');
	for(var i=0;i<inputs.length;i++)
	{
		if(typeof(inputs[i].name)!='undefined' && inputs[i].id.search(/_[0-9]+$/)!=-1 && inputs[i].type!="hidden" && inputs[i].style.display=='' && !inputs[i].disabled)
		{
			var index = inputs[i].id.substr(inputs[i].id.search(/_[0-9]+$/)+1);
			if(parseInt(index))
			{
				//eval('addEvent(inputs[i],"keydown",function (){uKD();mi_onkeydown("'+inputs[i].id.substr(0,inputs[i].id.search(/_[0-9]+$/))+'", '+index+');});');
			}
		}
	}
}

function mi_change_position(i,j)
{
	if($('input_group_'+i) && $('input_group_'+j))
	{
		var content_i = $('input_group_'+i).innerHTML;
		var content_j = $('input_group_'+j).innerHTML;
		$('input_group_'+i).innerHTML = content_j;
		$('input_group_'+j).innerHTML = content_i;
	}else
	{
		alert(2);	
	}
}
function mi_move_up(index)
{
	var inputs=document.getElementsByTagName('input');
	var last_input = false;
	for(var i=0;i<inputs.length;i++)
	{
		if(inputs[i].id=='id_'+index)
		{
			if(last_input)
			{
				mi_change_position(index,last_input.id.substr(last_input.id.search(/_[0-9]+$/)+1));
			}
			break;
		}
		if(typeof(inputs[i].name)!='undefined' && inputs[i].id.search(/id_[0-9]+$/)!=-1 && inputs[i].type!="hidden" && inputs[i].style.display=='' && !inputs[i].disabled)
		{
			last_input = inputs[i];
		}
	}
}
function mi_move_down(index)
{
	var inputs=document.getElementsByTagName('input');
	var last_input = false;
	for(var i=inputs.length-1;i>=0;i--)
	{
		if(inputs[i].id=='id_'+index)
		{
			if(last_input)
			{
				mi_change_position(last_input.id.substr(last_input.id.search(/_[0-9]+$/)+1),index);
			}
			break;
		}
		if(inputs[i].id.search(/^id_[0-9]+$/)!=-1 && inputs[i].type!="hidden" && inputs[i].style.display=='' && !inputs[i].disabled)
		{
			last_input = inputs[i];
		}
	}
}
function mi_onkeydown(name,index)
{
	var key = event.keyCode;
	if(key==40 || key==38)
	{
		if(document.all)event.returnValue=false; 
		var i=parseInt(index);
		do
		{
			if(key==40)
			{
				i++;
				if(i>input_count)
				{
					break;
				}
			}
			else
			{
				i--;
				if(i<=0)
				{
					break;
				}
			}
			if($(name+'_'+i))
			{
				$(name+'_'+i).focus();
				break;
			}
		}
		while(1);
		
	}
	else
	if(key==37 || key==39)
	{
		var pos, len;
		if($(name+'_'+index).type=='text' ||$(name+'_'+index).type=='textarea')
		{
			
			if(event.ctrlKey || $(name+'_'+index).value.length==0)
			{
				pos = 0;
				len = 0;
			}
			else
			{
				pos = -1;
				len = $(name+'_'+index).value.length;
			}
		}
		else
		{
			pos = 0;
			len = 0;
		}
		if(key==37 && pos==0)
		{
			if(document.all)event.returnValue=false;
			var inputs=document.getElementsByTagName('input');
			var last_input = false;
			for(var i=0;i<inputs.length;i++)
			{
				if(inputs[i].id==name+'_'+index)
				{
					if(last_input)
					{
						last_input.focus();
					}
					break;
				}
				if(typeof(inputs[i].name)!='undefined' && inputs[i].id.indexOf('_'+index)!=-1 && inputs[i].type!="hidden" && inputs[i].style.display=='' && !inputs[i].disabled)
				{
					last_input = inputs[i];
				}
			}
		}
		else
		if(key==39 && pos==len)
		{
			if(document.all)event.returnValue=false; else return false;
			var inputs=document.getElementsByTagName('input');
			var found = false;
			for(var i=0;i<inputs.length;i++)
			{
				if(inputs[i].id==name+'_'+index)
				{
					found=true;
				}
				else
				if(found && typeof(inputs[i].name)!='undefined' && inputs[i].id.indexOf('_'+index)!=-1 && inputs[i].type!="hidden" && inputs[i].style.display=='' && !inputs[i].disabled)
				{
					inputs[i].focus();
					break;
				}
			}
		}
	}
	return true;
}
function mi_delete_row(obj)
{
	jQuery(obj).parent().parent().remove();
	/*if(typeof(prefix)=='undefined')
	{
		prefix = '';
	}
	if(typeof(all_forms[name])!='undefined')
	{
		for(var i=0;i<all_forms[name].length;i++)
		{
			if(all_forms[name][i]==index)
			{
				all_forms[name].splice(i,1);
				break;
			}
		}
	}
	if($(prefix+'deleted_ids') && $('id_'+index).value && $('id_'+index).value!='(auto)')
	{
		$(prefix+'deleted_ids').value+=($(prefix+'deleted_ids').value?',':'')+$('id_'+index).value;
	}
	obj.parentNode.removeChild(obj);*/
}
function mi_delete_selected_row(name)
{
	if(typeof(all_forms[name])!='undefined')
	{
		for(var i=0;i<all_forms[name].length;i++)
		{
			if($('_checked_'+all_forms[name][i]).checked)
			{
				mi_delete_row($('input_group_'+all_forms[name][i]),name,all_forms[name][i]);
				i--;
			}
		}
	}
}
function mi_select_all_row(name,value)
{
	if(typeof(all_forms[name])!='undefined')
	{
		for(var i=0;i<all_forms[name].length;i++)
		{
			$('_checked_'+all_forms[name][i]).checked=value;
		}
	}
}
function mi_init_rows(name,values)
{
	var count = 0;
	for(var i in values)
	{
		count++;
		mi_init_row(name,values[i]);
	}
	if(count==0)
	{	
		//mi_add_new_row(name,true);
	}
	else
	{
		
		mi_update_onkeydown();
	}
}
function mi_init_row(name,value)
{
	mi_add_new_row(name);
	for(var i in value)
	{
		if($(i+'_'+input_count))
		{
			if($(i+'_'+input_count).type=='checkbox')
			{
				if(value[i]>0)
				{
					$(i+'_'+input_count).checked = true;
				}
			}else
			if($(i+'_'+input_count).tagName == 'SPAN' || $(i+'_'+input_count).tagName == 'DIV')
			{
				$(i+'_'+input_count).innerText = value[i];
			}else
			{
				$(i+'_'+input_count).value = value[i];
			}
			if($('img_'+i+'_'+input_count) && typeof($('img_'+i+'_'+input_count).src) != 'undefined')
			{
				if(value[i])
				{
					$('img_'+i+'_'+input_count).src = value[i];
				}
			}
		}
	}
}