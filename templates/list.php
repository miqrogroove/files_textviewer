<!DOCTYPE html>
<html>
 <head>
  <meta name="viewport" content="initial-scale=1.5">
  <style>td { padding: 0px; }</style>
  <title><?php p($_['title']); ?></title>
 </head>
 <body>
  <table>
   <tr><th>Name</th><th>Size</th><th>DL</th></tr>
<?php
if ( ! $_['root'] ) {
?>
   <tr><td><a href="../">Parent Directory</a></td><td>-</td><td></td></tr>
<?php
}

foreach ( $_['files'] as $file ) {
	$name = $file->getName();
	if ($file->getType() === \OCP\Files\FileInfo::TYPE_FOLDER) {
?>
   <tr><td><a href="<?php p(rawurlencode($name)); ?>/"><?php p($name); ?>/</a></td><td>-</td><td></td></tr>
<?php
	} else {
		$download = "{$_['webdav']}/webdav{$_['path']}{$name}";
		$download = implode("/", array_map("rawurlencode", explode("/", $download)));
		$size = $file->getSize();
		if ( $size <= 1048576 ) {
?>
   <tr><td><a href="<?php p(rawurlencode($name)); ?>"><?php p($name); ?></a></td><td><?php p($size); ?></td><td><a href="<?php p($download); ?>">DL</a></td></tr>
<?php
		} else {
?>
   <tr><td><?php p($name); ?></td><td><?php p($size); ?></td><td><a href="<?php p($download); ?>">DL</a></td></tr>
<?php
		}
	}
}
?>
  </table>
 </body>
</html>
