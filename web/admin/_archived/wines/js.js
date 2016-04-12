function deleteWine(wid) {
	if (confirm('Are you sure you want to delete this wine?')) location.href = '?action=delete_wine&WineID=' + wid;
	else 
		confirm('Test False');
}