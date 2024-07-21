tinyMCEPopup.requireLangPack();
function get_content(id){
	var src=document.getElementById('src').value;
	if(src==''){
		alert('Hãy nhập File/URL');
		document.getElementById('src').focus();
		return false;
	}
	if(document.getElementById('thumbnail').value!='')
		var thumbnail=document.getElementById('thumbnail').value;
	else
		var thumbnail='';
	if(document.getElementById('width').value!='')
		var width=document.getElementById('width').value;
	else
		var width=350;
	if(document.getElementById('height').value!='')
		var height=document.getElementById('height').value;
	else
		var height=250;
	var content='<img class="icon-video" src="/lib/js/tinymce/jscripts/tiny_mce/themes/advanced/img/video.png" width="'+width+'" height="'+height+'" alt="'+src+'" title="'+src+'" name="'+thumbnail+'" /><script type="text/javascript">jwplayer("'+id+'").setup({width: '+width+',height: '+height+',skin: "/lib/js/jwplayer/skins/six/six.xml",file: "'+src+'",image: "'+thumbnail+'"});</script>';
	return content;
}
var VideoDialog = {
	init : function() {
		var f = document.forms[0]; ed = tinyMCEPopup.editor;
		// Get the selected contents as text and place it in the input
		//f.src.value = tinyMCEPopup.editor.selection.getContent({format : 'text'});
		e = ed.selection.getNode();
		if (e.nodeName == 'IMG' && ed.dom.getAttrib(e,'class')== 'icon-video') {
			f.width.value = ed.dom.getAttrib(e, 'width');
			f.height.value = ed.dom.getAttrib(e, 'height');
			f.thumbnail.value = ed.dom.getAttrib(e, 'name');
			f.src.value = ed.dom.getAttrib(e, 'title');
			f.insert.value = ed.getLang('update');
		}
		// Setup browse button
		document.getElementById('filebrowsercontainer').innerHTML = getBrowserHTML('filebrowser','src','video','video');
		document.getElementById('filebrowserthumbnail').innerHTML = getBrowserHTML('filebrowser','thumbnail','image','image');
	},

	insert : function() {
		if(document.getElementById('insert').value=='Update'){
			var f = document.forms[0]; ed = tinyMCEPopup.editor; dom = ed.dom;
			e = ed.selection.getNode();
			parent=dom.getParent(e, 'span');
			edit_id=ed.dom.getAttrib(parent, 'id');
			ed.dom.remove(parent);
			var content='<p><span id="'+edit_id+'">'+get_content(edit_id)+'</span></p>';
			tinyMCEPopup.editor.execCommand('mceInsertContent', false, content);
			//alert(parent);
		}else{
			var d = new Date();
			var n = d.getTime(); 
			var id='video'+n;
			var content='<p><span id="'+id+'">'+get_content(id)+'</span></p>';
			tinyMCEPopup.editor.execCommand('mceInsertContent', false, content);
		}
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(VideoDialog.init, VideoDialog);
