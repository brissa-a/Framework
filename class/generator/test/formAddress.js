
		jQuery(document).ready(function(){
			jQuery('#formAddress').validate();
			jQuery('#formAddress .date').datepicker({
				dateFormat: 'dd/mm/yy',
				changeYear: true,
				changeMonth: true,
				yearRange: '1900:2100'
			});
			jQuery('#formAddress .date').datepicker($.datepicker.regional['fr']);
		});
		