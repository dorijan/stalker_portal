<!DOCTYPE html>
<html class="no-js">
<? include "../../dbinfo.php"; 
initLocale();

$db = new mysqli($host, $user, $pass, $db);
//print_r($_COOKIE["mac"]);
//	echo "blaa";		
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql = 'SELECT * FROM users WHERE mac ="'.$_COOKIE["mac"].'"  ';
if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
$row = $result->fetch_assoc();
$room=$row['ls'];

if ( isset( $_GET['obrisi'] ) && !empty( $_GET['obrisi'] ) ){
	if ($_GET['obrisi']=="1") {
		$sql2 = 'delete from events_tvset where ls="'.$room.'" AND what="alarm"';		
		if(!$result2 = $db->query($sql2)){
			die('There was an error running the query [' . $db->error . ']');
		}		
	}
}

if ( isset( $_GET['dan'] ) && !empty( $_GET['dan'] ) ){

	if ($_GET['dan']=="1") {
		$datuum = new DateTime('tomorrow');
	} else {
		$datuum = new DateTime('today');			
	};

	$sql2 = 'select * from events_tvset where ls="'.$room.'" AND sended=0 AND eventtime="'.$datuum->format('Y-m-d '.$_GET['kada'].':00').'" AND what="alarm"';

	if(!$result2 = $db->query($sql2)){
		die('There was an error running the query [' . $db->error . ']');
	}
	
	
	if ($result2->num_rows==0){
	
		$sql2 = 'select * from events_tvset where ls="'.$room.'" AND sended=0 AND events_tvset.eventtime>NOW() AND what="alarm"';

		if(!$result2 = $db->query($sql2)){
			die('There was an error running the query [' . $db->error . ']');
		}
		if ($result2->num_rows<6){	
		
			$sql2 = 'insert into events_tvset set ls="'.$room.'", sended=0, eventtime="'.$datuum->format('Y-m-d '.$_GET['kada'].':00').'", what="alarm"';
		//	error_log($sql2,0);
			if(!$result2 = $db->query($sql2)){
				die('There was an error running the query [' . $db->error . ']');
			}
		}
	}
}

?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><? echo _("Alarm"); ?></title>

        <link rel="stylesheet" href="css/main.css">
        <script src="../welcome2/js/vendor/modernizr-2.6.2.min.js"></script>
		<script type="text/javascript" src="../welcome/js/base-funcs.js"></script>
		<script language="JavaScript" src="../welcome/js/variables.js"></script> 
		<script language="JavaScript" src="../welcome/js/egSTB.js"></script> 
		<script> var adresaportala="<? echo $adresaportala; ?>";</script>
        <script src="js/moje.js?nekaj=18"></script>		
    </head>
    <body onload="init()" onKeyPress="getkeydown(event)">

        <div class="container">
            <div class="inner">
                <!-- header -->
                <div class="room-number"><h1><div id="soba"></div><!-- <? echo substr($_COOKIE["mac"],-5); ?> --></h1></div>
                <!-- /header -->
				<form id="posalji" action="index.php" method="get">
                <!-- main -->
                <div class="main">
                    <div class="mode">
                        <h1><? echo _("MODE"); ?></h1>
                        <a id="me0" href="#" class="mode-btn active"><?= _("Day") ?></a>
                        <a id="me1" href="#" class="mode-btn"><?= _("Time") ?></a>
<!--                        <a id="me2" href="#" class="mode-btn" onclick="document.getElementById('posalji').submit(); return false;" ><?= _("Save") ?></a>-->						
                    </div>
                    <div class="statuses">
                        <h1><? echo _("SET"); ?></h1>					
                        <div class="stat">
                            <div id="danprikaz" class="name"><?= _("Tomorrow") ?></div>
							<input type="hidden" name="dan" value="1" id="dan">
                        </div>

                        <div class="stat">
                            <div id="vrijemeprikaz" class="name"><?= _("07:00") ?></div>
							<input type="hidden" name="kada" value="07:00" id="kada">							
                        </div>
						
                    </div>
					<? //print_r($_GET); ?>
                </div>					
				</form>				
                <div class="info">
                    <div class="settings">
					
					<?
					echo "<h1>"._("Current alarms(5 max.):")."</h1>";
					echo "<br>";
					$sql3 = 'SELECT * FROM events_tvset WHERE ls ="'.$room.'" and sended="0" and what="alarm" and events_tvset.eventtime>NOW() order by eventtime';
					if(!$result3 = $db->query($sql3)){
						die('There was an error running the query [' . $db->error . ']');
					}
					

					while ($row3 = $result3->fetch_assoc()) {
						echo $row3["eventtime"]."<br>";					
					}
					
					?>

                    </div>
                </div>					
					


                <!-- /main -->



                <!-- menu -->
                <div class="menu">
                    <ul>
                        <li class="separator">&nbsp;</li>
                        <li><a ><? echo _("MENU");?></a></li>
                        <li class="separator">&nbsp;</li>
                        <li class="red"><a href="#"><? echo _("Save alarm"); ?></a></li>						
                        <li class="separator">&nbsp;</li>
                        <li class="blue"><a href="#"><? echo _("Clear all alarms"); ?></a></li>
                        <li class="separator">&nbsp;</li>
					</ul>
                </div>
                <!-- /menu -->
            </div>
        </div>

        <script src="../welcome2/js/vendor/jquery-1.11.0.min.js"></script>

        <!--remove in production 
        <script src="js/vendor/holder.js"></script>-->
        <!-- remove in production -->

    </body>
</html>
