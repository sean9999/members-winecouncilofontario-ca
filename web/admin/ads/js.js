function deleteThing(gid) {
	if (confirm('Are you sure you want to delete this ad?')) location.href = '?action=delete_thing&AdID=' + gid;
	else 
		confirm('Test False');
}