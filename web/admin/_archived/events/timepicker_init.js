function timepicker_init() {

	$("#StartTime").timePicker({
		show24Hours: false,
		step: 30
	});
		
	$("#EndTime").timePicker({
		show24Hours: false,
		step: 30
	});
}