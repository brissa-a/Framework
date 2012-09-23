<!DOCTYPE html>
<html>
	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Template test</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
		<?php include "css.php"?>
	</head>
	
	<body>
		<?php include ("header/header.php"); ?>
		<?php include ("menu/menu.php"); ?>
		<section id="corps">
				<?php include $resultData['path'];?>
		</section>	
		<?php include ("footer/footer.php");?>
		<div id="dialog" style="display: none;"></div>
	</body>
		
	<?php include "js.php" ?>

</html>
