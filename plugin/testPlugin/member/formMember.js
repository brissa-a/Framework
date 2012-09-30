
jQuery(document).ready(function(){
	jQuery('#formMember').validate();
	jQuery('#formMember .date').datepicker({
		dateFormat: 'dd/mm/yy',
		changeYear: true,
		changeMonth: true,
		yearRange: '1900:2100'
	});
	jQuery('#formMember .date').datepicker($.datepicker.regional['fr']);
		
	jQuery('#formMember .datetime').datetimepicker({
		dateFormat: 'dd/mm/yy',
		timeFormat: 'hh:mm',
		changeYear: true,
		changeMonth: true,
		yearRange: '1900:2100',
		timeText: 'Heure',
		hourText: 'Heures',
		minuteText: 'Minutes',
		currentText: 'Maintenant',
		closeText: 'Valider'
	});
	
	jQuery('#formMember .time').timepicker({
		dateFormat: 'dd/mm/yy',
		timeFormat: 'hh:mm',
		changeYear: true,
		changeMonth: true,
		yearRange: '1900:2100',
		timeOnlyTitle: 'Choisissez une heure',
		timeText: 'Heure',
		hourText: 'Heures',
		minuteText: 'Minutes',
		currentText: 'Maintenant',
		closeText: 'Valider'
	});
});
