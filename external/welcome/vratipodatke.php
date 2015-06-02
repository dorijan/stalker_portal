<?
header("Content-Type: text/plain");
include "../../dbinfo.php";
initLocale();
$db = new mysqli($host, $user, $pass, $db);
//print_r($_COOKIE["mac"]);
//	echo "blaa";		
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql = 'UPDATE users SET last_watchdog=NOW() WHERE mac="'.$_COOKIE["mac"].'"  ';
if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}


$sql = 'SELECT * FROM users WHERE mac ="'.$_COOKIE["mac"].'"  ';
if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
$row = $result->fetch_assoc();
$room=$row['ls'];



	switch ($_GET["sta"]) {
		case "js":
		
			//UPDATE users SET last_watchdog=NOW() WHERE mac="00:1A:79:12:26:AB"
		
			$sql2 = 'SELECT * FROM events_tvset WHERE ls="'.$room.'" AND sended=0 AND eventtime>DATE_SUB(NOW(),INTERVAL 1 HOUR) AND eventtime<=NOW()';
//			echo $sql2;
			if(!$result2 = $db->query($sql2)){
				die('There was an error running the query [' . $db->error . ']');
			}
			$row2 = $result2->fetch_assoc();
			
			if ($result2->num_rows>0){
				echo $row2['what'];

				$sql3='UPDATE events_tvset SET sended="1" WHERE id='.$row2["id"];
//				echo $sql3;								
				if(!$result3 = $db->query($sql3)){
					die('There was an error running the query [' . $db->error . ']');
				};
			} else {
				echo " ";			
			}
			
//			echo "welcome";
			//echo "off";
//			echo "on";

			break;
		case "brsobe":
			echo _("Room number: ").$room;
			break;
		case "brsobe2":
			echo $room;
			break;			
		case "spol":
			if ($row['gender']==1){
				echo _("mr.");
			} else {
				echo _("mrs.");
			}
			break;
		case "name":
			echo $row['fname'];
			break;
		case "login":
			echo $row['login'];
			break;			
		case "password":
			echo $row['hotspotpassword'];
			break;			
		case "demovideo":
			echo "http://10.30.1.248/hotel.mp4";
			break;
		case "demosound":
			echo "http://10.30.0.2/stalker_portal/external/welcome/dynasty.mp3";
			break;
		case "Temperature":
			$sta="Temperature";
			$koliko=4;
			echo md5sobe($room,$sta,$koliko);
			break;
		case "SetPoint":
			$sta="SetPoint";
			$koliko='0';
			$podatak=md5sobe($room,$sta,$koliko);
			if ($podatak>128){
				$podatak=$podatak-128;
			}
			echo $podatak;
			break;
		case "SetPointBath":
			$sta="SetPointBath";
			$koliko='0';
			$podatak=md5sobe($room,$sta,$koliko);
			if ($podatak>128){
				$podatak=$podatak-128;
			}			
			echo $podatak;
			break;			
		case "Temperaturebath":
			$sta="Temperature";
			$koliko=1;
			echo md5sobe($room,$sta,$koliko);
			break;
		case "Stanjegrhl":
			$podatak=md5sobe($room,"HVAC_Mode","");		
//			$podatak=md5sobe($room,"Status","13");
			//$podatak;
			//echo $podatak;
			if ($podatak==2) {
				//mod grijanja
				$podatak2=md5sobe($room,"Status","13");
				if ($_GET["dio"]==3){ 
					echo _("Heating"); 
				};
				if ($podatak2==1){
					//ukljuceno grijanje
					if ($_GET["dio"]==1){ 
						echo "state ok"; 
					} elseif ($_GET["dio"]==2) { 
						echo _("on");
					};
				} else {
					if ($_GET["dio"]==1){ 
						echo "state warn"; 
					} elseif ($_GET["dio"]==2) { 
						echo _("off");
					};					
				}				
				
			} else {
				//mod hladenja
				$podatak2=md5sobe($room,"Status","14");
				if ($_GET["dio"]==3){ 
					echo _("Cooling"); 
				};
				if ($podatak2==1){
					//ukljuceno grijanje
					if ($_GET["dio"]==1){ 
						echo "state ok"; 
					} elseif ($_GET["dio"]==2) { 
						echo _("on");
					};
				} else {
					if ($_GET["dio"]==1){ 
						echo "state warn"; 
					} elseif ($_GET["dio"]==2) { 
						echo _("off");
					};					
				}				
				
				
			};
			break;
		case "Status":
			$sta="Status";
//			$koliko=80;
			$koliko=$_GET['trebam'];
			$podatak=md5sobe($room,$sta,$koliko);
			//$ispravan=str_pad(bstr2bin(hex2bin( $podatak[2].$podatak[3].$podatak[0].$podatak[1])), 16, "0", STR_PAD_LEFT);
			$ispravan=$podatak;
			$j=$_GET['trebam'];
			switch ($j){
				case 0:
					if ($ispravan==1){
		//				echo "Otvoren prozor prilikom alarma<br>";				
					}
					break;				
				case 1:
					//echo "card";	
					if ($ispravan==1){
						if ($_GET["dio"]==1){ 
							echo "state ok"; 
						} else { 
							echo _("in slot");
						};
					} else {
						if ($_GET["dio"]==1){ 
							echo "state warn"; 
						} else { 
							echo _("out");
						};					

					}
					break;
				case 2:
					if ($ispravan==1){
		//				echo "izgubilo se primarno napajanje<br>";				
					}
					break;								
				case 3:
					if ($ispravan==1){
		//				echo "soba otvorena karticom<br>";				
					}
					break;								
				case 4:
					if ($ispravan==1){
						//echo "produzeno svijetlo nakon ulaska u sobu<br>";				
					}
					break;								
				case 5:
					if ($ispravan==1){
						//echo "odlagac ceka umetanje ispravne karticu<br>";				
					}
					break;								
				case 6:

					break;								
				case 7:

					break;								
				case 8:
					if ($ispravan==1){
						//echo "Staff";				
						echo '../welcome2/img/service-on.png';														
					} else {
					
						echo '../welcome2/img/service-off.png';																		
					}				
					break;								
				case 9:
					//echo "SOS poziv<br>";								
					if ($ispravan==1){
						if ($_GET["dio"]==1){ 
							echo "state warn"; 
						} else { 
							echo _("on");
						};
					} else {
						if ($_GET["dio"]==1){ 
							echo "state ok"; 
						} else { 
							echo _("off");
						};					

					}
					break;								
				case 10:
//					echo $ispravan;
					if ($ispravan==1){
						//echo "room service";
						echo '../welcome2/img/maid-on.png';														
					} else {
					
						echo '../welcome2/img/maid-off.png';													
					}
					break;								
				case 11:
//					echo $podatak;
					if ($ispravan==1){
						//echo "DND";
						echo '../welcome2/img/dnd-on.png';														
					} else {
						echo '../welcome2/img/dnd-off.png';													
					}
					break;
				case 12:
					if ($ispravan==1){
						//echo "Procitana kartica na citacu<br>";				
					}
					break;								
				case 13:
					if ($ispravan==1){
						//echo "ispravna kartica je u odlagacu<br>";				
						echo 'imgroom2/Ok.png';								
					}else {
					
						echo 'imgroom2/bad.png';
					}
					break;								
				case 14:
					if ($ispravan==1){
						//echo "kartica je umetnuta u odlagac <br>";				
					}
					break;								
				case 15:
					if ($ispravan==1){
				//		echo "soba je prazna i bilo koja promijena prozora ili vrata aktivira alarm<br>";				
					}
					break;
				case 17:
					break;
				case 61:
					//echo "vrata otvorena";								
					if ($ispravan==1){
						if ($_GET["dio"]==1){ 
							echo "state warn"; 
						} else { 
							echo _("open");
						};
					} else {
						if ($_GET["dio"]==1){ 
							echo "state ok"; 
						} else { 
							echo _("closed");
						};					
					}
					break;
				case 62:
					//echo "prozor otvorena";								
					if ($ispravan==1){
						if ($_GET["dio"]==1){ 
							echo "state warn"; 
						} else { 
							echo _("open");
						};
					} else {
						if ($_GET["dio"]==1){ 
							echo "state ok"; 
						} else { 
							echo _("closed");
						};					
					}
					break;
					
				case 52:
					if ($ispravan==1){
						//echo "eRoomLockOut";
						echo '../welcome2/img/lock-on.png';														
					} else {
						echo '../welcome2/img/lock-off.png';													
					}
					break;					
			}			
			break;
			
	}

	
function bstr2bin($input)
// Binary representation of a binary-string
{
  if (!is_string($input)) return null; // Sanity check

  // Unpack as a hexadecimal string
  $value = unpack('H*', $input);
  
  // Output binary representation
  return base_convert($value[1], 16, 2);
}
/*
function hex2bin($hex_string) {
    $pos = 0;
	$result = '';
	while ($pos < strlen($hex_string)) {
	  if (strpos(HEX2BIN_WS, $hex_string{$pos}) !== FALSE) {
	    $pos++;
	  } else {
	    $code = hexdec(substr($hex_string, $pos, 2));
		$pos = $pos + 2;
	    $result .= chr($code); 
	  }
	}
	return $result;
}	
*/	
?>