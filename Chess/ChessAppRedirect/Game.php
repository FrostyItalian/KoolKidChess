<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' type='text/css' href='../ChessStyles.css'>
            
<?php
require_once('../Chess.php');

$myturn=true;
//if it is NOT your turn
{
	echo '<meta http-equiv=\'refresh\' content=\'30\'>';
}
echo '</head>';

if(!isset($_COOKIE['Color'])){
	echo '<body><p>Please select your colour</p>';
	echo '<FORM method=GET>';
		echo '<input class=\'button2\' type=\'submit\' value=White formaction=\'SetColor.php?Color=w\'>';//onclick=\'window.location=\''.getcwd().'setColor.php?Color=\'w\'
		echo '<input class=\'button1\' type=\'submit\' value=Black formaction=\'SetColor.php?Color=b\'>';//onclick=\'window.location=\''.getcwd().'setColor.php?Color=\'b\' 
	echo '</FORM>';
}else if(isset($_COOKIE['Color']))
{
	echo $_COOKIE['Color'];
}
echo '<br>';
$url = 'state.txt';
$exist = file_exists($url);
if ($exist){
	$myFile = fopen($url , "r") or die("FUCK!");
	$obj=fgets($myFile);
	$chess=new Chess($obj);
	fclose($myFile);
}else
{
	$chess = new Chess();
}
//if it is your turn generate all valid moves and do the other stuff....
//if($chess->turn()==$_COOKIE['white'])

$moves = $chess->moves();
echo '<form><label>Input Move Here </label><br><Select name=\'from\'>';
foreach($moves as $m)
{
	echo '<option value = \''.$m.'\'>'.$m.'</option>';
}
echo '</select>';
echo '<input class=\'button3\' type=\'submit\' method=POST value=\'Move\'></form>';
//search function to determine if a move exists in moves and obtain the index
$pMove=$_GET['from'];

$found = in_array($pMove,$moves);

if($found){
		$indx =array_search($pMove,$moves);
		$move = $moves[$indx];
		$chess->move($move);
	}
$myFile = fopen($url , "w");
$objtext = $chess->generateFen();
fwrite($myFile, $objtext);
fclose($myFile);

echo $chess->ascii().PHP_EOL;
?>
</body>
</html>
