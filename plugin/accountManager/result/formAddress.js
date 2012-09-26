jQuery(document).ready(function(){
	jQuery("#formAddress").validate();
	$(".date").datepicker({
		dateFormat: "dd/mm/yy",
		changeYear: true,
		changeMonth: true,
		yearRange: "1900:2100"
	});
	$(".date").datepicker($.datepicker.regional['fr']);
});
