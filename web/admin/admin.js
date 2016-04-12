function PopChunkView(chunkname) {
	popurl	= '/admin/chunks/pop_view.php?chunkname=' + chunkname;
	var	p	= window.open(popurl,'chunkview','width=350,height=350,resizable');
}

function deleteWinery(wid) {
	var go = confirm('Are you sure you want to delete this winery?');
	if (go) location.href='?action=delete_winery&winery_id='+wid;
}

//function deleteUser(uid) {
//	var go = confirm('Are you sure you want to delete this user?');
//	if (go) location.href='?action=delete_user&user_id='+uid;
//}

function deleteTag(tid) {
	if (confirm('Are you sure you want to delete this tag?')) location.href = '?action=delete_tag&tag_id=' + tid;
}

/*
function deleteWine(wid) {
	if (confirm('Are you sure you want to delete this wine?')) location.href = '?action=delete_wine&wine_id=' + wid;
}


function deleteWine(DownloadID) {
	if (confirm('Are you sure you want to delete this download?')) location.href = '?action=delete_download&DownloadID=' + DownloadID;
}
*/
function deleteAttraction(AttractionID) {
	if (confirm('Are you sure you want to delete this attraction?')) location.href = '?action=delete_attraction&AttractionID=' + AttractionID;
}

function deleteDownload(DownloadID) {
	if (confirm('Are you sure you want to prevent this download from appearing under the "Downloads" section of the site?')) location.href = '?action=delete_download&DownloadID=' + DownloadID;
}

function editEvent(eid) {
	location.href = '?view=event&event_id=' + eid;
}

function deleteEvent(eid) {
	if (confirm('are you sure you want to delete this event?')) {
		location.href = '?action=delete_event&event_id=' + eid;
	}
}

function weird() {
	alert('weridrd');
}