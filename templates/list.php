<!DOCTYPE html>
<html>
 <head>
  <meta name="viewport" content="width=400, initial-scale=1.5">
  <style>p { margin: 0px; }</style>
  <title><?php p($_['title']); ?></title>
 </head>
 <body>
<?php
if ( ! $_['root'] ) {
?>
  <p><a href="../">Parent Directory</p>
<?php
}

foreach ( $_['files'] as $file ) {
	$name = $file->getName();
	if ($file->getType() === \OCP\Files\FileInfo::TYPE_FOLDER) {
		$name = "$name/";
	}
?>
  <p><a href="<?php p($name); ?>"><?php p($name); ?></a></p>
<?php
}
?>
 </body>
</html>
