function loadInLightbox() {
	
	jQuery("#dialog").load("lightbox.php"+jQuery(this).attr("href"), function() {
		var lightboxParam = jQuery("#lightboxParam").metadata({type:'attr',name:'data'});
		jQuery("#dialog").dialog("close");
		jQuery("#dialog").dialog("option",lightboxParam);
		jQuery("#dialog").dialog("open");
		jQuery("a.openLightbox").click(loadInLightbox);
	});
	return false;
}

jQuery(document).ready(function() {
	$.metadata.defaults.cached = false;
	jQuery("#dialog").dialog({autoOpen:false});
	jQuery("a.openLightbox").click(loadInLightbox);
});