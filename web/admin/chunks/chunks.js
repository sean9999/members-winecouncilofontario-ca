function deleteChunk(cid) {
	if (confirm('Are you sure you want to delete this chunk?')) location.href = '?action=delete_chunk&ChunkID=' + cid;
}

function toggleKids(PID) {
	
	var options = {};
	class_string = '.childof_' + PID;
	id_string = 'toggler_' + PID;
	id_string_jquery = '#' + id_string;
	$(class_string).toggle('highlight',options,500);
	current_src = $(id_string_jquery).attr('src');
	
	if (current_src == '/admin/assets/arrow_down.png') {
		$(id_string_jquery).attr('src','/admin/assets/arrow_right.png');
	} else {
		$(id_string_jquery).attr('src','/admin/assets/arrow_down.png');
	}

}