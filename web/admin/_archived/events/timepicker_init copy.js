function timepicker_init() {

	// Use default settings
	$("#StartTime, #EndTime").timePicker({
		show24Hours: true,
		step: 30
	});
	    
	// Store time used by duration.
	var oldTime = $.timePicker("#StartTime").getTime();
	
	// Keep the duration between the two inputs.
	$("#StartTime").change(function() {
	  if ($("#EndTime").val()) { // Only update when second input has a value.
	    // Calculate duration.
	    var duration = ($.timePicker("#EndTime").getTime() - oldTime);
	    var time = $.timePicker("#StartTime").getTime();
	    // Calculate and update the time in the second input.
	    $.timePicker("#EndTime").setTime(new Date(new Date(time.getTime() + duration)));
	    oldTime = time;
	  }
	});
	
	// Validate.
	$("#EndTime").change(function() {
	  if($.timePicker("#StartTime").getTime() > $.timePicker(this).getTime()) {
	    $(this).addClass("timePickerError");
	  }
	  else {
	    $(this).removeClass("timePickerError");
	  }
	});

}