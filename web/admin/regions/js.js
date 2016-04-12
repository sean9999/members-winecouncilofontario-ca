function deleteRegion(rid) {
	if (confirm('Are you sure you want to delete this region?')) location.href = '?action=delete_region&RegionID=' + rid;
}