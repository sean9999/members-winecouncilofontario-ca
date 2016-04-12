function deleteUser(UID) {
	if (confirm('Are you sure you want to delete this user right here?')) location.href = '?action=delete_user&UserID=' + UID;
}