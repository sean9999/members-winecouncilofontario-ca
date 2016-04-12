tinyMCE.init({
	mode : "none",
	theme : "advanced",
	invalid_elements : "span",
	extended_valid_elements : "-p,li,ul[type]",
	relative_urls : false,
	plugins : "imagemanager",
	theme_advanced_disable : "strikethrough,justifyleft,justifycenter,justifyright,justifyfull,outdent,indent,cut,copy,paste,help,code,hr,removeformat,styleselect,sub,sup,forecolor,backcolor,forecolorpicker,backcolorpicker,charmap,visualaid,anchor,newdocument,blockquote,separator,cleanup",
	theme_advanced_buttons1_add_before : "insertimage,image,bullist,numlist,undo,redo,link,unlink",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_blockformats : "h1,h2,h3,h4,p,blockquote",
	convert_newlines_to_brs : false,
	document_base_url : "http://core.crazyhorsecoding.com/",
});

function toggleEditor() {
	var id1 = 'Description';
	//var id2 = 'InfoHours';
	//var id3 = 'InfoLocation';
	
	if (!tinyMCE.getInstanceById(id1)) {
		tinyMCE.execCommand('mceAddControl', false, id1);
		//tinyMCE.execCommand('mceAddControl', false, id2);
		//tinyMCE.execCommand('mceAddControl', false, id3);
	} else {
		tinyMCE.execCommand('mceRemoveControl', false, id1);
		//tinyMCE.execCommand('mceRemoveControl', false, id2);
		//tinyMCE.execCommand('mceRemoveControl', false, id3);
	}
}

toggleEditor();