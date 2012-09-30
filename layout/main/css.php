<!-- Global Autoload CSS-->
<?php foreach (glob("layout/main/include/auto_css/*.css") as $filename) : ?>
<link rel="stylesheet" media="screen" type="text/css" href="/<?php echo "$filename"?>" />
<?php endforeach; ?>

<!-- Page Specific CSS -->
<?php
$pathinfo = pathinfo($resultData['path'], PATHINFO_DIRNAME) + pathinfo($resultData['path'], PATHINFO_FILENAME);
if (file_exists($pathinfo . ".css")) : ?>
<link rel="stylesheet" media="screen" type="text/css" href="/<?php $pathinfo . ".css" ?>"/>
<?php endif; ?>

<link rel="stylesheet" media="screen" type="text/css" href="/layout/main/header/header.css"/>
<link rel="stylesheet" media="screen" type="text/css" href="/layout/main/menu/menu.css"/>
<link rel="stylesheet" media="screen" type="text/css" href="/layout/main/footer/footer.css"/>

<!-- Additional Page Specific Css defined in controller -->
<?php foreach ($resultData -> children() as $metaData) :?>
<?php if ($metaData->getName() == "css") :?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo $metaData?>" />
<?php endif; ?>
<?php endforeach; ?>