function deleteWine(wid) {
	if (confirm('Are you sure you want to delete this wine?')) location.href = 'wines.php?action=delete_wine&WineID=' + wid;
	else 
		confirm('Test False');
}