<!DOCTYPE html>
<html>
<body>
<?php
function subFiles($fname,$url){
	$myFile = fopen($url.$fname , "w");
	copy($fname,$url.$fname);
	fclose($myFile);
}
try
{
	$code=hash('sha1',rand());
	if(!file_exists($code)) {
        mkdir($code, 0777, true);
    }
    $url="./".$code."/";
	subFiles("Game.php",$url);
	subFiles("SetColor.php",$url);
    header( "Location: ".$url."Game.php" );
}
catch(exception $e){
	echo $e;
}
?>
</body>
</html>