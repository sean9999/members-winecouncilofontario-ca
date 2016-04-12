function deleteQuestion(qid) {
	if (confirm('Are you sure you want to delete this question?')) location.href = '?action=delete_question&QuestionID=' + qid;
	else 
		confirm('Test False');
}