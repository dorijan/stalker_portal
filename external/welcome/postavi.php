<?
include "../../dbinfo.php";
$db = new mysqli($host, $user, $pass, $db);
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
$sql = 'SELECT * FROM users WHERE mac ="'.$_COOKIE["mac"].'"  ';
if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
$row = $result->fetch_assoc();
$room=$row['ls'];

$sta=$_GET["sta"];
$koliko=$_GET["koliko"];
$podatak=md5sobe($room,$sta,$koliko);

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>