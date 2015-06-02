<html>
<? include "../../dbinfo.php"; ?>
	<head>	
		<link type="text/css" rel="stylesheet" href="css/screen_1080.css">	
		<link type="text/css" rel="stylesheet" href="/stalker_portal/c/main_menu_720.css">
		<link type="text/css" rel="stylesheet" href="../../c/layer.list_720.css">
		<link type="text/css" rel="stylesheet" href="../../c/vclub_720.css">
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>		
		<script type="text/javascript" src="js/base-funcs.js"></script>
		<script language="JavaScript" src="js/variables.js"></script> 
		<script language="JavaScript" src="js/egSTB.js"></script> 		
		<script> 
			var pozicija=0;
			var maxmeni=3;
			try {
				stb = gSTB;
				stb.RDir("setenv tvsystem 1080i-50");
				stb.ExecAction('graphicres 1280');				
				gSTB.SetObjectCacheCapacities(1000000, 7000000, 10000000);
			} catch (e) {
			}
			try {
				modes.emulate = false;
				stb = gSTB;
			} catch (e) {
				modes.emulate = true;
				stb = egSTB;
			}		
			function init(){ 
				stb.InitPlayer();

//				document.cookie='mac='+stb.GetDeviceMacAddress();
//				document.cookie="stb_lang="+stb.RDir('getenv language');
//				$.cookie("mac", "00:1A:79:12:26:AC", { path: '/' });
//				$.cookie("mac", stb.GetDeviceMacAddress(), { path: '/' });
//				$.cookie("stb_lang", stb.RDir('getenv language'), { path: '/' });
//				document.cookie="mac="+stb.GetDeviceMacAddress()+"; path=/";
//				document.cookie="stb_lang="+stb.RDir('getenv language')+"; path=/";								
		
				$('#soba').load('../welcome/vratipodatke.php?sta=brsobe');
				osvjeziajax();				
				setInterval(function(){osvjeziajax()}, 5000);
				
				ofarbaj();

//				tempsobe
//				$('#spol').load('vratipodatke.php?sta=spol);
				
			} 
			

			function getkeydown(e) { 
//				console.log(("!!!!key pressed!!!");
//				var code=e.keyCode;
				var code = e.keyCode || e.which;
				console.log(code);								
				if (e.shiftKey) {
					code += 1000;
				}
				if (e.altKey) {
					code += 2000;
				}
//				stb.Debug(code);				
				switch (code) {
					case keys.EXIT:
					{
						stb.Stop(); 					
						window.location = "http://<? echo $adresaportala; ?>";
						break; 						
					}
					case keys.MENU:
					{
						stb.Stop(); 					
						window.location = "http://<? echo $adresaportala; ?>";
						break; 						
					}
					case keys.BLUE: //food order
					{
						$.get("../welcome/postavi.php?sta=Staff&koliko=2", function(respons2) {
							osvjeziajax();
						});						
						//window.location = "../welcome/postavi.php?sta=Staff&koliko=2";					
						break; 
					}
					case keys.GREEN: //otkljucaj vrata
					{

						//window.location = "../welcome/postavi.php?sta=Lock&koliko=1";					
						break; 
					}					
					case keys.RED:	//DND		
					{
						window.location = "../welcome/postavi.php?sta=DND&koliko=2";										
						break; 
					}			
					case keys.YELLOW: //room service
					{
						$.get("../welcome/postavi.php?sta=RoomSvc&koliko=2", function(respons2) {
							osvjeziajax();
						});
					
//						window.location = "../welcome/postavi.php?sta=Staff&koliko=2";					
						break; 
					}								
					case 43: //vol up
					{
						break; 					
					}
					case 45: //vol down
					{
						break; 					
					}
					case 38: //up
					{
					

						pozicija=pozicija-1;
						if (pozicija<0){
							pozicija=0;
						};
						
						console.log(pozicija);
						
						ofarbaj();
//						window.location = "../welcome/postavi.php?sta=SetPoint&koliko=1";
						break; 					
					}
					
					
					case 40: //down
					{
						//$.get("../welcome/postavi.php?sta=SetPoint&koliko=-1", function(respons2) {
						//	$('#a_sred').load('../welcome/vratipodatke.php?sta=Status&trebam=17');				
						//});

						pozicija=pozicija+1;
						if (pozicija>=maxmeni){
							pozicija=maxmeni-1;
						
						}

						console.log(pozicija);
						ofarbaj();
						
						
//						window.location = "../welcome/postavi.php?sta=SetPoint&koliko=-1";					
						break; 					
					}

					case 37: //left
					{
						if (pozicija==0){
							$.get("../welcome/postavi.php?sta=SetPointBath&koliko=-1", function(respons2) {
								osvjeziajax();
							});						
						
						}					
						if (pozicija==1){
							$.get("../welcome/postavi.php?sta=SetPoint&koliko=-1", function(respons2) {
								osvjeziajax();
							});						
						
						}
						if (pozicija==2){
							$.get("../welcome/postavi.php?sta=BlindsUp&koliko=1", function(respons2) {
								osvjeziajax();
							});						
						}					
					
						break;
					}
					
					case 39: //right
					{
						if (pozicija==0){
							$.get("../welcome/postavi.php?sta=SetPointBath&koliko=1", function(respons2) {
								osvjeziajax();
							});						
						
						}										
						if (pozicija==1){
							$.get("../welcome/postavi.php?sta=SetPoint&koliko=1", function(respons2) {
								osvjeziajax();
							});						
						
						}
						if (pozicija==2){
							$.get("../welcome/postavi.php?sta=BlindsUp&koliko=-1", function(respons2) {
								osvjeziajax();
							});						
						}						
					
						break;						
					}
				}

			}
			
			function ofarbaj(){

				for (var i = 0; i < maxmeni; i++) {
					var koja;
					koja="#me"+i;
					console.log(koja);
					$(koja).removeClass();						
					//$(".me"+i).removeClass("blue_row_bg");
					if (pozicija===i) {
						$(koja).addClass("active_row_bg");							
					} else {
						$(koja).addClass("blue_row_bg");
					}
				};
				if ((pozicija==1)||(pozicija==0)){
					$("#sastrane").html("<? echo _("Use LEFT and RIGHT buttons to set temperature.");?>");				
				};
				if ((pozicija==2)){
					$("#sastrane").html("<? echo _("Use LEFT and RIGHT buttons to lower or raise blinds.");?>");				
				};
				
			}
			
			
			function osvjeziajax(){
			
				$('#tempsobe').load('../welcome/vratipodatke.php?sta=Temperature');
				$('#tempbath').load('../welcome/vratipodatke.php?sta=Temperaturebath');				
				
				
				//da li su zakljucana vrata
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=11&dio=2", function(respons) {
					vrata1 = respons;
					$('#door2').css('background-image', 'url(' + vrata1 + ')');
				});
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=52", function(respons) {
					vrata1 = respons;
					$('#door').css('background-image', 'url(' + vrata1 + ')');
				});
				//kartica
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=13", function(respons) {
					vrata1 = respons;
					$('#card').css('background-image', 'url(' + vrata1 + ')');
				});
				//spremacica
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=10", function(respons) {
					vrata1 = respons;
					$('#maid').css('background-image', 'url(' + vrata1 + ')');
				});
				//staff
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=8", function(respons) {
					vrata1 = respons;
					$('#staff').css('background-image', 'url(' + vrata1 + ')');
				});

				//sos
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=9", function(respons) {
					vrata1 = respons;
					$('#sos').css('background-image', 'url(' + vrata1 + ')');
				});
				
				//DND
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=11", function(respons) {
					vrata1 = respons;
					$('#DND').css('background-image', 'url(' + vrata1 + ')');
				});				
				
				
				
				//temperatura postavljena
				$('#tempsobeset').load('../welcome/vratipodatke.php?sta=SetPoint');				
				
				//temperatura postavljena kupaone
				$('#tempbathset').load('../welcome/vratipodatke.php?sta=SetPointBath');				
				
			
			}
			
			document.onkeydown = getkeydown;

		</script> 
 <body onload="init()" onKeyPress="getkeydown(event)"> 

 <div id="vclub" style="display: block;">
		<div class="mb_header_info"></div>
		
		<!--
		<div class="door2" id="door2" onclick='top.location.href = "../welcome/postavi.php?sta=Lock&koliko=1"' ></div>
		
		
		<div class="roomstat" id="roomstat">
			<div id="tempsobe"></div>
		</div> 

		<div class="main_menu_date_bar"><span class="main_menu_date"><? echo date("F j, Y");?></span><span class="main_menu_time"><? echo date("G:i"); ?></span></div>

		<div class="sos" id="sos" onclick='top.location.href = "../welcome/postavi.php?sta=DND&koliko=2"' >DND</div>
		<div class="maid" id="maid" onclick='top.location.href = "../welcome/postavi.php?sta=Staff&koliko=2"' ></div>
		<div class="light" id="light" onclick='top.location.href = "../welcome/postavi.php?sta=Staff&koliko=2"' >Staff</div>
		<div class="light2" id="light2" ></div>
		<div class="door" id="door"></div>
		<div class="card" id="card" ></div>
		<div class="room" id="soba"></div>
		<div class="temperatura" id="temperatura"></div>
		<div class="tempicon" id="tempicon"></div>
		<div class="but1" id="but1" onclick='top.location.href = "../welcome/postavi.php?sta=DND&koliko=2"' ></div>
		<div class="but2" id="but2" onclick='top.location.href = "../welcome/postavi.php?sta=Lock&koliko=0"' ></div>
		<div class="but3" id="but3" onclick='top.location.href = "../welcome/postavi.php?sta=Staff&koliko=2"' ></div>
		<div class="but4" id="but4" onclick='top.location.href = "../welcome/postavi.php?sta=Staff&koliko=2"' ></div>
		<div class="but5" id="but5" onclick='top.location.href = "../welcome/postavi.php?sta=SetPoint&koliko=1"' ></div>
		<div class="but6" id="but6" onclick='top.location.href = "../welcome/postavi.php?sta=SetPoint&koliko=-1"' ></div>


		
		close
display: block; margin-right: 103px;
		
		-->
<div class="short_container">
	<? 
	
		$meni=array(
			array(
				_("Bathroom temperature"),1
			),
			array(
				_("Room temperature"),1
			),
			array(
				_("Blinds"),1
			)
		
		);
		
		$izabran=0;
		for ($row = 0; $row < 3; $row++) {
			
			$toppoz=130+$row*100;
			echo '<div id="me'.$row.'" class="blue_row_bg" style="top: '.$toppoz.'px;"><div class="name_block" style="">'.$meni[$row][0].'</div></div>';
		
		}
		
	
	
	?>
<!--	<div class="blue_row_bg" style="top: 82px;"><div class="name_block" style=""><?= _("Room temperature") ?></div></div>
	
	<div class="blue_row_bg" style="top: 120px;"><div class="name_block" style=""><?= _("Bathroom temperature") ?></div></div>

	<div class="blue_row_bg" style="top: 158px;"><div class="name_block" style=""><?= _("Blinds") ?></div></div>

	<div class="blue_row_bg" style="top: 196px;"><div class="name_block" style=";"><?= _("Door") ?></div></div>

	<div class="blue_row_bg" style="top: 234px;"><div class="name_block" style="display: none;"></div></div>

	<div class="blue_row_bg" style="top: 272px;"><div class="name_block" style="display: none;"></div></div>

	<div class="blue_row_bg" style="top: 310px;"><div class="name_block" style="display: none;"></div></div>

	<div class="blue_row_bg" style="top: 348px;"><div class="name_block" style="display: none;"></div></div>

	<div class="blue_row_bg" style="top: 386px;"><div class="name_block" style="display: none;"></div></div>

	<div class="blue_row_bg" style="top: 424px;"><div class="name_block" style="display: none;"></div></div>

	<div class="blue_row_bg" style="top: 462px;"><div class="name_block" style="display: none;"></div></div>

	<div class="blue_row_bg" style="top: 500px;"><div class="name_block" style="display: none;"></div></div>

	<div class="blue_row_bg" style="top: 538px;"><div class="name_block" style="display: none;"></div></div>
	
<!--
	<div class="blue_row_bg" style="top: 576px;"><div class="name_block" style="display: none;"></div></div>

	<div class="active_row_bg close" style="display: block; top: 67px;"><div class="active_name_block" style="margin-right: 130px;">Hotel demo</div></div>
-->	

	<div class="main_menu_date_bar">
		<span class="main_menu_time"><div id="soba"></div></span>	
	</div>
	<div id="bathstatus"></div>
	
	
	<div id="bathstatus2">
		<div id="tempbath"></div>
		<div id="tempbathset"></div>				
	</div>

	<div id="roomstatus"></div>
	
	<div id="roomstatus2">
		<div id="tempsobe"></div>
		<div id="tempsobeset"></div>
		<div class="card" id="card" ></div>					
	</div>	
	
	
	<div id="sastrane2"></div>
	<div id="sastrane"></div>		
	
	<div class="color_button_bar"><table><tr>
		<td><div class="btn_red"></div><span><? echo _("DND");?></span><div id="DND"></div></td>
		<td><div class="btn_green"></div><span><? echo _("DOOR LOCK");?></span><div id="door"></div></td>
		<td><div class="btn_yellow"></div><span><? echo _("MAID");?></span><div id="maid"></div></td>
		<td><div class="btn_blue"></div><span><? echo _("ROOM SERVICE");?></span><div id="staff"></div></td>
	</tr></table></div>
	
</div>
		
		
</div>


</body>
</html>