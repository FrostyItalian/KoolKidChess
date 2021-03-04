<?php 
	setcookie('Color',hash('sha1',getcwd().$_GET['Color']),time() + (30*60),"/");
	echo '<!DOCTYPE html><html><head>';
	echo '<meta http-equiv=\'refresh\' content=\'0;url='.getcwd().'Game.php\'>';
	echo'</head>';
?>
