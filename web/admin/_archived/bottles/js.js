function deleteBottle(bid) {
	if (confirm('Are you sure you want to delete this bottle?')) location.href = '?action=delete_bottle&BottleID=' + bid;
	else 
		confirm('Test False');
}