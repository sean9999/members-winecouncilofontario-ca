function autosave(thing,UserID) {
	//	just answers
	$.getJSON("/lib/autosave/autosave-survey.php", { QuestionID: thing.name, Answer: thing.value, UserID: UserID }, function(json){
    	//console.log(json);
    });
}

function autosavecomment(comments,QuestionID,UserID) {
	//	just comments
	if (comments.length > 0) {
		$.getJSON("/lib/autosave/autosave-survey-comment.php", { QuestionID: QuestionID, Comments: comments, UserID: UserID }, function(json){
    		//console.log(json);
    	});	
	}
}