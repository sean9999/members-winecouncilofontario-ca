tinyMCE.init({
	mode : "textareas",
	editor_selector : "rtf",
	theme : "advanced",
	invalid_elements : "span",
	extended_valid_elements : "-p,li,ul[type]",
	plugins : "imagemanager",
	theme_advanced_disable : "strikethrough,justifyleft,justifycenter,justifyright,justifyfull,outdent,indent,cut,copy,paste,help,code,hr,removeformat,styleselect,sub,sup,forecolor,backcolor,forecolorpicker,backcolorpicker,charmap,visualaid,anchor,newdocument,blockquote,separator,cleanup",
	theme_advanced_buttons1_add_before : "insertimage,image,bullist,numlist,undo,redo,link,unlink",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_blockformats : "h1,h2,h3,h4,p,blockquote",
	convert_newlines_to_brs : false,
	document_base_url : "http://dev.solsmart.com/",
	relative_urls : false,
	remove_script_host : true,
	convert_urls : false,
	content_css : "/css/typo.css,/admin/chunks/editor.css"
});

function toggleEditor(fieldID) {
    var id1 = fieldID;
    //var id2 = 'Excerpt';
    if (!tinyMCE.getInstanceById(id1)) {
    	tinyMCE.execCommand('mceAddControl', false, id1);
    	//tinyMCE.execCommand('mceAddControl', false, id2);
    } else {
    	tinyMCE.execCommand('mceRemoveControl', false, id1);
    	//tinyMCE.execCommand('mceRemoveControl', false, id2);
    }
}