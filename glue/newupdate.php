<?
	die();
	include "../dbinfo.php";
	$db = new mysqli($host, $user, $pass, $db);

	if($db->connect_errno > 0){
		die('Unable to connect to database [' . $db->connect_error . ']');
	}	

	
	
	$sql = 'SELECT * FROM users WHERE DATE(last_active)=2014-07-10';		
	if(!$result = $db->query($sql)){
		die('There was an error running the query [' . $db->error . ']');
	}
//	$row = $result->fetch_assoc();	

	if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
//				echo $row['id']."<br>";	
				$sql2='INSERT INTO stalker_db.events SET event="update_image", uid="'.$row['id'].'",msg="", priority="1",events.addtime=NOW(), events.eventtime=(NOW() + INTERVAL 2 MINUTE);';
				$result2 = $db->query($sql2);
				echo $sql2."<br>";
			}
	}	
	
	
//	$sql2='INSERT INTO EVENTS SET event="update_image", uid="76", events.addtime=NOW(), events.eventtime=(NOW() + INTERVAL 2 MINUTE)';



?>