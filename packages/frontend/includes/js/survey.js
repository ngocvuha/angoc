function survey_list(item_name)
{
	var arr = document.getElementsByName(item_name);
	if (arr.length)
	{
		st='';
		for (i=0;i<arr.length;i++)
		{
			if(arr[i].checked)
			{
				if(st!='')
				{
					st+=',';
				}
				st+=arr[i].value;
			}
		}
		return st;
	}
	else
	{
		if(arr.checked)
		{
			return arr.value;
		}
	}
	return '';
}
