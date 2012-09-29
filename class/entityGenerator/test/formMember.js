
		jQuery(document).ready(function(){
			jQuery('#formMember').validate();
			jQuery('#formMember .date').datepicker({
				dateFormat: 'dd/mm/yy',
				changeYear: true,
				changeMonth: true,
				yearRange: '1900:2100'
			});
			jQuery('#formMember .date').datepicker($.datepicker.regional['fr']);
		});
		