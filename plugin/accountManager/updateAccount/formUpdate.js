jQuery(document).ready(function(){
	
	$("#formUpdateAuth").validate({
		invalidHandler: function () {
			alert("Des champs sont invalide, merci de les remplir correctement.");
		},
		rules: {
			passwordBis: {
				equalTo: "[name='password']"
			}
		},
		messages: {
			passwordBis: {
				equalTo: "Ce mot de passe est different du précédent."
			}
		},
		showErrors: function () {
			this.defaultShowErrors();
			$("form label.error").hide();
			$("form input.error, form select.error").tooltip({ 
				extraClass: "ui-state-error ui-corner-all",
			    bodyHandler: function() {
			    	var content = "<span class='ui-icon ui-icon-alert'' style='float: left; margin-right: .3em;'></span>";
			    	content += $(this).parent("p").children("label.error").html();
			        return content; 
			    }
			});
		}
	});
	
	$("#formUpdatePerso").validate({
		invalidHandler: function () {
			alert("Des champs sont invalide, merci de les remplir correctement.");
		},
		rules:{
			codePostal: {
				minlength: 5
			}
		},
		showErrors: function () {
			this.defaultShowErrors();
			$("form label.error").hide();
			$("form input.error, form select.error").tooltip({ 
				extraClass: "ui-state-error ui-corner-all",
			    bodyHandler: function() {
			    	var content = "<span class='ui-icon ui-icon-alert'' style='float: left; margin-right: .3em;'></span>";
			    	content += $(this).parent("p").children("label.error").html();
			        return content; 
			    }
			});
		},
		unhighlight: function (element, errorClass, validClass) {
     		$(element).removeClass(errorClass).addClass(validClass);
     		$(element).tooltip();
		}
	});
		$("#birthDate").datepicker({
		dateFormat: "dd/mm/yy",
		changeYear: true,
		changeMonth: true,
		yearRange: "1900:2100"
	});
	$("#birthDate").datepicker($.datepicker.regional['fr']);
});
