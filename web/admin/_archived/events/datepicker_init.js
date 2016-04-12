function add_event_datepicker_init() {
	$('#EventDate').datepicker({
		changeMonth:	true,
		changeYear:		true,
		dateFormat:		'yy-mm-dd'
	});
	$('#EventDateEnd').datepicker({
		changeMonth:	true,
		changeYear:		true,
		dateFormat:		'yy-mm-dd'
	});
}
