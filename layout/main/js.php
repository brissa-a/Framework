<!-- Include external JS-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>

<!-- Static JS -->
<script type="text/javascript" src="/layout/main/include/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/layout/main/include/js/jquery.ui.datepicker-fr-CH.js"></script>

<!-- Autoload JS-->
<?php foreach (glob("layout/main/include/auto_js/*.js") as $filename) :?>
<script type="text/javascript" src="/<?php echo "$filename"?>"></script>
<?php endforeach; ?>

<script type="text/javascript" src="/layout/main/header/header.js"></script>
<script type="text/javascript" src="/layout/main/footer/footer.js"></script>
<script type="text/javascript" src="/layout/main/menu/menu.js"></script>

<!-- Page Specifique JS -->
<?php
$pathinfo = pathinfo($resultData['path'], PATHINFO_DIRNAME) . "/" . pathinfo($resultData['path'], PATHINFO_FILENAME);
$this->logger->debug("Include Page Specifique JS:" . $pathinfo . ".js");
if (file_exists($pathinfo . ".js")) :
?>
<script type="text/javascript" src="/<?php echo $pathinfo . ".js"?>"></script>
<?php endif;?>

<!-- Additional Page Specific Js defined in controller -->
<?php foreach ($resultData -> children() as $metaData) :?>
<?php if ($metaData->getName() == "js") :?>
<script type="text/javascript" src="<?php echo $metaData; ?>"></script>
<?php endif; ?>
<?php endforeach; ?>

<!-- compatibilite HTML5 IE -->
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->