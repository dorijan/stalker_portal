<html>
<? include "../../dbinfo.php"; ?>
	<head>	
		<link type="text/css" rel="stylesheet" href="/stalker_portal/c/main_menu_720.css">			
		<link type="text/css" rel="stylesheet" href="css/screen_1080.css">	
		<link type="text/css" rel="stylesheet" href="../../c/layer.list_720.css">			
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>		
		<script type="text/javascript" src="js/base-funcs.js"></script>
		<script language="JavaScript" src="js/variables.js"></script> 
		<script language="JavaScript" src="js/egSTB.js"></script> 		
		<script> 

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
				document.cookie="mac="+stb.GetDeviceMacAddress()+"; path=/";
				document.cookie="stb_lang="+stb.RDir('getenv language')+"; path=/";								
		
				$('#soba').load('../welcome/vratipodatke.php?sta=brsobe');
				osvjeziajax();				
				setInterval(function(){osvjeziajax()}, 5000);

//				tempsobe
//				$('#spol').load('vratipodatke.php?sta=spol);
				
			} 
			function getkeydown(e) { 
				stb.Debug("!!!!key pressed!!!");
				var code = e.keyCode || e.which;
//				stb.Debug(code);								
				if (e.shiftKey) {
					code += 1000;
				}
				if (e.altKey) {
					code += 2000;
				}
				stb.Debug(code);				
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
					case keys.BLUE: //poziv osoblju
					{
						$.get("../welcome/postavi.php?sta=Staff&koliko=2", function(respons2) {
							osvjeziajax();
						});						
						//window.location = "../welcome/postavi.php?sta=Staff&koliko=2";					
						break; 
					}
					case keys.GREEN: //otkljucaj vrata
					{
						$.get("../welcome/postavi.php?sta=Lock&koliko=1", function(respons2) {
							osvjeziajax();
						});
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
						$.get("../welcome/postavi.php?sta=Staff&koliko=2", function(respons2) {
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
						$.get("../welcome/postavi.php?sta=SetPoint&koliko=1", function(respons2) {
							$('#a_sred').load('../welcome/vratipodatke.php?sta=Status&trebam=17');																
						});
//						window.location = "../welcome/postavi.php?sta=SetPoint&koliko=1";
						break; 					
					}
					case 40: //down
					{
						$.get("../welcome/postavi.php?sta=SetPoint&koliko=-1", function(respons2) {
							$('#a_sred').load('../welcome/vratipodatke.php?sta=Status&trebam=17');				
						});
					
//						window.location = "../welcome/postavi.php?sta=SetPoint&koliko=-1";					
						break; 					
					}					
				}

			}
			
			function osvjeziajax(){
			
				$('#tempsobe').load('../welcome/vratipodatke.php?sta=Temperature');
				//da li su zakljucana vrata
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=11&dio=2", function(respons) {
					vrata1 = respons;
					$('#door2').css('background-image', 'url(' + vrata1 + ')');
				});
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=11&dio=1", function(respons) {
					vrata1 = respons;
					$('#door').css('background-image', 'url(' + vrata1 + ')');
				});
				//kartica
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=13", function(respons) {
					vrata1 = respons;
					$('#card').css('background-image', 'url(' + vrata1 + ')');
				});
				//spremacica
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=7", function(respons) {
					vrata1 = respons;
					$('#maid').css('background-image', 'url(' + vrata1 + ')');
				});

				
				
				//temperatura postavljena
				$('#a_sred').load('../welcome/vratipodatke.php?sta=Status&trebam=17');				
				
			
			
			}
						

		</script> 
 <body onload="init()" onKeyPress="getkeydown(event)"> 
	<div class="content"> 

<!--		<div id="blanket" style="display:none;"></div>
		<div id="popUpRed" style="display:none;">
		Press RED button again to toggle SOS!<br>
		Press Back to go back.
		</div>

		<div id="popUpGreen" style="display:none;">
		Press Green button again to toggle door!<br>
		Press Back to go back.
		</div>

		<div id="popUpYellow" style="display:none;">
		Press Yellow button again to toggle maid call!<br>
		Press Back to go back.
		</div>

		<div id="popUpBlue" style="display:none;">
		Press Blue button again to toggle lights!<br>
		Press Back to go back.
		</div>
-->
		<div class="hotel"></div> 
		<div class="door2" id="door2" onclick='top.location.href = "../welcome/postavi.php?sta=Lock&koliko=1"' ></div>
		
		
		<div class="roomstat" id="roomstat">
			<div id="tempsobe"></div>
		</div> 

		<div class="main_menu_date_bar"><span class="main_menu_date"><? echo date("F j, Y");?></span><span class="main_menu_time"><? echo date("G:i"); ?></span></div>

		</div>

		<div class="sos" id="sos" onclick='top.location.href = "../welcome/postavi.php?sta=DND&koliko=2"' >DND</div>
		<div class="maid" id="maid" onclick='top.location.href = "../welcome/postavi.php?sta=Staff&koliko=2"' ></div>
		<div class="light" id="light" onclick='top.location.href = "../welcome/postavi.php?sta=Staff&koliko=2"' >Staff</div>
		<div class="light2" id="light2" ></div>
		<div class="door" id="door"></div>
		<div class="card" id="card" ></div>
		<div class="room" id="soba"></div>
		<div class="weather"></div>
		<div class="weather_ico"></div>
		<div class="temperatura" id="temperatura"></div>
		<div class="sobasl" id="sobasl"></div>
		<div class="tempicon" id="tempicon"></div>
		<div class="but1" id="but1" onclick='top.location.href = "../welcome/postavi.php?sta=DND&koliko=2"' ></div>
		<div class="but2" id="but2" onclick='top.location.href = "../welcome/postavi.php?sta=Lock&koliko=0"' ></div>
		<div class="but3" id="but3" onclick='top.location.href = "../welcome/postavi.php?sta=Staff&koliko=2"' ></div>
		<div class="but4" id="but4" onclick='top.location.href = "../welcome/postavi.php?sta=Staff&koliko=2"' ></div>
		<div class="but5" id="but5" onclick='top.location.href = "../welcome/postavi.php?sta=SetPoint&koliko=1"' ></div>
		<div class="but6" id="but6" onclick='top.location.href = "../welcome/postavi.php?sta=SetPoint&koliko=-1"' ></div>

		<div class="a_sred" id="a_sred">
		</div>
	</div>



</body>
</html>