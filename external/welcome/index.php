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
//			var demovideo="http://10.168.192.2:8080/Content/Images/big.avi";		
			var demovideo="http://10.30.1.248/hotel.mp4";
			var demosound="http://10.30.0.2/stalker_portal/external/welcome/dynasty.mp3";
			function init(){ 
				stb.InitPlayer();
				stb.SetTopWin(1);
				stb.SetLoop(0);				
				stb.SetVolume(50);
				stb.Play(demosound);
				document.cookie="mac="+stb.GetDeviceMacAddress()+"; path=/";
				document.cookie="stb_lang="+stb.RDir('getenv language')+"; path=/";				
//				$.cookie("mac", stb.GetDeviceMacAddress(), { path: '/' });
//				$.cookie("stb_lang", stb.RDir('getenv language'), { path: '/' });
		
				$('#soba').load('vratipodatke.php?sta=brsobe');
//				$('#spol').load('vratipodatke.php?sta=spol);
				$('#name').load('vratipodatke.php?sta=name');
				$('#login').load('vratipodatke.php?sta=login');
				$('#password').load('vratipodatke.php?sta=password');
				
			} 
			function getkeydown(e) { 
				stb.Debug("!!!!key pressed!!!");
				var code = e.keyCode || e.which;
				stb.Debug(code);								
//				if (stb && stb.key_lock === true && code != key.FRAME) {
//					return;
//				}
				if (e.shiftKey) {
					code += 1000;
				}
				if (e.altKey) {
					code += 2000;
				}
//				if (VKBlock == true && code != keys.OK && code != keys.EXIT) {
//					return;
//				}
				stb.Debug(code);				
				switch (code) {
					case 2114: // Play 
					{ 
						stb.Debug("play");																
						stb.Play(demovideo) ;
						break; 
					} 
					case 2115: // Stop 
					{ 
						stb.Debug("stop");																
						stb.Stop(); 
						break; 
					}
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
					case keys.BLUE:
					{
						if (stb.GetPIG() == false){
							stb.Debug("GETPIG true, blue");
							stb.SetTopWin(1);
							stb.SetViewport(589,340, 350, 130);
//							stb.SetPIG(0,64,300,300);						
							//stb.Play(demovideo);													
						} else {
							stb.Debug("GETPIG false, blue");
							stb.SetTopWin(1);							
							stb.SetPIG(1, -1, -1, -1);	
							stb.SetVolume(50);							
							stb.Play(demovideo);							
							//stb.SetPIG(1,256,0,0);
							//stb.Play(demovideo);						
							
						}
						break; 
					}
					case 43: //vol up
					{
						stb.Debug("volup"+stb.GetVolume());											
						stb.SetVolume(stb.GetVolume()+10);
						break; 					
					}
					case 45: //vol down
					{
						stb.Debug("voldown"+stb.GetVolume());
						if (stb.GetVolume()>0){
							stb.SetVolume(stb.GetVolume()-10);
						}
						break; 					
					}
				}

			}
			var stbEvent = {
				  onEvent : function (event) {
					  stb.Debug(event);
					  if (event == 1) {
						stb.SetViewport(589,340, 350, 130);
						stb.SetVolume(0);				
						stb.Play(demovideo);
					  }
				  },
				  event : 0
			}			
						

		</script> 
 <body onload="init()" onKeyPress="getkeydown(event)"> 
 <div class="main_menu" >

		<div class="main_menu_date_bar">
			<span class="main_menu_date"><? echo date();?></span><span class="main_menu_time"><? echo _("ROOM");?> <div id="soba"></div></span>
		</div> 
		<div id="goredesno">
			<b><? echo _("Wireless");?>:</b><br>
			<? echo _("Username");?>: "<div id="login"></div>"<br>
			<? echo _("Password");?>: "<div id="password"></div>"
		</div>
		<div class="tv_prev_window"></div>
		<div id="unutra" >
			<? echo _("Welcome");?> <div id="spol"></div> <div id="name"></div><br>
			
			
			
		</div>
		<div class="color_button_bar">
			<table><tr>
			<td><div class="btn_menu"></div><span><? echo _("MENU");?></span></td>
<!--			<td><div class="separator"></div><div class="btn_green"></div><span>SORT</span></td>
			<td><div class="separator"></div><div class="btn_yellow"></div><span>FAVORITE</span></td>-->
			<td><div class="separator"></div><div class="btn_blue"></div><span><? echo _("Full screen");?></span></td>
			</tr></table>
		</div>		
<!--		<div id="gumbplavi">
			<div style="display: table-row">
				<div id="but4"></div><div id="but4text">FULL SCREEN</div>
			</div>
		</div>
		
		<div id="gumbmenu">
			<div style="display: table-row">
				<div id="butmenu">MENU</div><div id="butmenutext">BACK TO MAIN MENU</div>
			</div>
		</div>		
-->		
	</div>

	</body>
</html>