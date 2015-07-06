<?
	require('routeros_api.class.php');
	include "../dbinfo.php";
	$API = new routeros_api();
	//$API->debug = true;
	$db = new mysqli($host, $user, $pass, $db);

	if($db->connect_errno > 0){
		die('Unable to connect to database [' . $db->connect_error . ']');
	}		
	
	switch($_GET["what"]){
		
		case "rentshow":
			$sql = 'SELECT * FROM users WHERE ls ="'.$_GET["room"].'" ';		
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
			$row = $result->fetch_assoc();
//			echo $row["id"];
			$sql2 = 'SELECT * FROM `video_rent_history`, `video` WHERE video_rent_history.`video_id`=video.`id` AND uid ="'.$row["id"].'" ';
//			echo $sql2;
			if(!$result2 = $db->query($sql2)){
				die('There was an error running the query [' . $db->error . ']');
			}

			if ($result2->num_rows > 0) {
				// output data of each row
				while($row2 = $result2->fetch_assoc()) { 
					echo "Price: 75 kn / name: " . $row2["name"]. " - " . $row2["rent_date"]. "<br>";
				}
			} else {
				echo "0 results<br>";
			}
			echo "Total: ".(75*$result2->num_rows)." kn<br>";
			echo "<a href='iptv.php?what=removerent&room=".$_GET["room"]."'>Clear</a><br>";
			echo '<a href="rent.php">Back</a>';
			die();
			break;
			
			
		case "removerent":
			$sql = 'SELECT * FROM users WHERE ls ="'.$_GET["room"].'" ';		
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
			$row = $result->fetch_assoc();
			
//			echo $row["uid"];
			$sqldelete='DELETE FROM video_rent_history WHERE uid="'.$row["id"].'"';
			if(!$resultdelete = $db->query($sqldelete)){
				die('There was an error running the query [' . $db->error . ']');
			}
			$sqldelete='DELETE FROM video_rent WHERE uid="'.$row["id"].'"';
			if(!$resultdelete = $db->query($sqldelete)){
				die('There was an error running the query [' . $db->error . ']');
			}			
			header("Location: rent.php");
			die();
			
			break;
				
		case "card":
			$sql = 'SELECT * FROM users WHERE ls ="'.$_GET["room"].'" ';		
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
			$row = $result->fetch_assoc();
			
			
			$sqldelete='DELETE FROM events_tvset WHERE ls="'.$_GET["room"].'"';
			if(!$resultdelete = $db->query($sqldelete)){
				die('There was an error running the query [' . $db->error . ']');
			}
			
			if ($_GET["CardIn"]=="1") {
				//ako prvi put ulazi upali welcome
				if ($row["firstentry"]==1) {
					$sql2='INSERT INTO events_tvset SET ls="'.$_GET["room"].'", sended="0", what="welcome"';
					if(!$result2 = $db->query($sql2)){
						die('There was an error running the query [' . $db->error . ']');
					}
					$sqlupd = 'UPDATE users SET firstentry="0" WHERE ls ="'.$_GET["room"].'"';				
					if(!$resultupd = $db->query($sqlupd)){
						die('There was an error running the query [' . $db->error . ']');
					}					
					
				}
				
	
				//inace nista
			} else {
					$sql2='INSERT INTO events_tvset SET ls="'.$_GET["room"].'", sended="0", what="off"';
					if(!$result2 = $db->query($sql2)){
						die('There was an error running the query [' . $db->error . ']');
					}								
			
			}
		
			break;		
		case "add":


			$sifra=generatePassword();
			echo $sifra;
			if (isset($_GET["mac"])) {
				echo "<br>ima mac<br>";
				$macadresa=$_GET["mac"];
				$macadresa=$macadresa[0].$macadresa[1].":".$macadresa[2].$macadresa[3].":".$macadresa[4].$macadresa[5].":".$macadresa[6].$macadresa[7].":".$macadresa[8].$macadresa[9].":".$macadresa[10].$macadresa[11];
				
				$sql = 'SELECT * FROM users WHERE mac ="'.$macadresa.'"  ';

				if(!$result = $db->query($sql)){
					die('There was an error running the query [' . $db->error . ']');
				}
				$row = $result->fetch_assoc();
				if ($row){ 
					echo "Postoji user<br>";

					$sql2 = 'UPDATE users SET hotspotpassword="'.$sifra.'", firstentry=1, fname="'.utf8_encode($_GET['fname']).'", login="'.$_GET['room'].'",ls="'.$_GET['room'].'", gender="'.$_GET['gender'].'" WHERE mac ="'.$macadresa.'"';
					
				} else {					
					echo "Ne postoji user<br>";
				
					$sql2 = 'INSERT into users SET hotspotpassword="'.$sifra.'", firstentry=1, fname="'.utf8_encode($_GET['fname']).'", login="'.$_GET['room'].'",mac="'.$macadresa.'", gender="'.$_GET['gender'].'", ls ="'.$_GET["room"].'"';
				}
				if(!$result = $db->query($sql2)){
					die('There was an error running the query [' . $db->error . ']');
				};
/*				$sql3 = 'INSERT into events SET uid="'.mysql_insert_id().'",event="update_image", addtime=NOW()';
				if(!$result = $db->query($sql3)){
					die('There was an error running the query [' . $db->error . ']');
				};*/				
				$hotpassreset=1;
				
			
			} else {
				echo "<br>nema mac<br>";			
				$sql = 'SELECT * FROM users WHERE ls ="'.$_GET["room"].'"  ';

				if(!$result = $db->query($sql)){
					die('There was an error running the query [' . $db->error . ']');
				}
				$row = $result->fetch_assoc();
				echo "U bazi:".$row["fname"]."<br>";
				if (utf8_encode($_GET['fname'])!=$row["fname"]){
					echo "novo ime<br>";
					$sql2 = 'UPDATE users SET hotspotpassword="'.$sifra.'", firstentry=1, fname="'.utf8_encode($_GET['fname']).'", login="'.$_GET['room'].'" WHERE ls ="'.$_GET["room"].'"';
					$hotpassreset=1;
					if(!$result = $db->query($sql2)){
						die('There was an error running the query [' . $db->error . ']');
					}
				} else {
					echo "staro ime<br>";
					$hotpassreset=0;				
				}
			};

			
			
			//add new mikrotik hotspot user
/*			if ($hotpassreset==1){
				if ($API->connect('10.30.0.1', 'hotspot', 'hhoottcreate1.')) {
					//remove first
					$API->write('/ip/hotspot/user/print', false);
					$API->write('?name='.$_GET["room"], false);
					$API->write('=.proplist=.id');
					$ARRAYS = $API->read();


					$API->write('/ip/hotspot/user/remove', false);
					$API->write('=.id=' . $ARRAYS[0]['.id']);
					$READ = $API->read();
					//print_r($READ);
					
					$bla=$API->comm("/ip/hotspot/user/add", array(
							  "name"     => $_GET["room"],
							  "password" => $sifra,
							  "profile" => "default"
					));
					//print_r($bla);
				   $API->disconnect();
				}
			}			*/
			

			break;
		case "remove":
		
			if ($API->connect('10.30.0.1', 'hotspot', 'hhoottcreate1.')) {
				//remove first
				$API->write('/ip/hotspot/user/print', false);
				$API->write('?name='.$_GET["room"], false);
				$API->write('=.proplist=.id');
				$ARRAYS = $API->read();


				$API->write('/ip/hotspot/user/remove', false);
				$API->write('=.id=' . $ARRAYS[0]['.id']);
				$READ = $API->read();
				//print_r($READ);
			}
		
		
			break;
	
	}
			
	$db->close();

	function generatePassword($length = 6) {
//		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$count = mb_strlen($chars);

		for ($i = 0, $result = ''; $i < $length; $i++) {
			$index = rand(0, $count - 1);
			$result .= mb_substr($chars, $index, 1);
		}

		return $result;
	}
	
?>

<a href="form.php">Back</a>