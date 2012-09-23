jQuery(document).ready(function () {
	$("#formLogin").validate({
		submitHandler: function(form) {
			var response = jQuery.ajax({
									url:		"ajax.php?a=checkLogin",
									type:		"POST",
									async:		false,
									data:		{ 	
													user: 		$("[name='login']").val(),
													password:	$("[name='password']").val()
												},
									success: function(msg){}
							}).responseText;
			if (response == "1") {
				form.submit();
			} else {
				$("#wrongPassword").show();
				//$("#dialog").dialog({height: 250});
		 		return false;
			}
		}
	});
});