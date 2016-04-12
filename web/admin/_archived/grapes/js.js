function deleteGrape(gid) {
	if (confirm('Are you sure you want to delete this grape?')) location.href = '?action=delete_grape&GrapeID=' + gid;
	else 
		confirm('Test False');
}