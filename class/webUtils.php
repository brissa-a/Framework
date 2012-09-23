<?php
function includeJS($jsPath) {
	echo '<script type="text/javascript">';
	include $jsPath;
	echo '</script>';
}

function includeCSS($cssPath) {
	echo '<style type="text/css">';
	include $cssPath;
	echo '</style>';
}

function dateFrToDateTime($str) {
	list($day, $month, $year) = explode('/', $str);
	$dateTime = new DateTime();
	$dateTime -> setDate($year, $month, $day);
	return $dateTime;
}

function generatePassword($nb_caract = 8) {
	$chaine = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@-_";
	$pass = "";
	for ($u = 1; $u <= $nb_caract; $u++) {
		$nb = strlen($chaine);
		$nb = mt_rand(0, ($nb - 1));
		$pass .= $chaine[$nb];
	}
	return $pass;
}

function downloadFile($fullPath) {

	// Must be fresh start
	if (headers_sent())
		die('Headers Sent');

	// Required for some browsers
	if (ini_get('zlib.output_compression'))
		ini_set('zlib.output_compression', 'Off');

	// File Exists?
	if (file_exists($fullPath)) {

		// Parse Info / Get Extension
		$fsize = filesize($fullPath);
		$path_parts = pathinfo($fullPath);
		$ext = strtolower($path_parts["extension"]);

		// Determine Content Type
		switch ($ext) {
			case "pdf" :
				$ctype = "application/pdf";
				break;
			case "exe" :
				$ctype = "application/octet-stream";
				break;
			case "zip" :
				$ctype = "application/zip";
				break;
			case "doc" :
				$ctype = "application/msword";
				break;
			case "xls" :
				$ctype = "application/vnd.ms-excel";
				break;
			case "ppt" :
				$ctype = "application/vnd.ms-powerpoint";
				break;
			case "gif" :
				$ctype = "image/gif";
				break;
			case "png" :
				$ctype = "image/png";
				break;
			case "jpeg" :
			case "jpg" :
				$ctype = "image/jpg";
				break;
			default :
				$ctype = "application/force-download";
		}

		header("Pragma: public");
		// required
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private", false);
		// required for certain browsers
		header("Content-Type: $ctype");
		header("Content-Disposition: attachment; filename=\"" . basename($fullPath) . "\";");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . $fsize);
		ob_clean();
		flush();
		readfile($fullPath);

	} else
		die('File Not Found');

}

//pathinfo working with utf8 
function mb_pathinfo($filepath) {
    preg_match('%^(.*?)[\\\\/]*(([^/\\\\]*?)(\.([^\.\\\\/]+?)|))[\\\\/\.]*$%im',$filepath,$m);
    if($m[1]) $ret['dirname']=$m[1];
    if($m[2]) $ret['basename']=$m[2];
    if($m[5]) $ret['extension']=$m[5];
    if($m[3]) $ret['filename']=$m[3];
    return $ret;
}
?>