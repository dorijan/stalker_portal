			try {
				stb = gSTB;
				stb.RDir("setenv tvsystem 1080i-50");
				stb.RDir("setenv timezone_conf Europe/Vienna");
				stb.ExecAction('graphicres 1280');
				document.cookie="stb_lang="+stb.RDir('getenv language')+"; path=/";				
				gSTB.SetObjectCacheCapacities(1000000, 7000000, 10000000);
			} catch (e) {
			}
			try {
				modes.emulate = false;
				stb = gSTB;
			} catch (e) {
				modes.emulate = true;
				stb = egSTB;
//				document.cookie="stb_lang=hr; path=/";
			}
			var demovideo="http://10.30.0.4/demo1.mp4";
			var demosound="http://10.30.0.2/stalker_portal/external/welcome2/blop.mp3";
			function init(){ 
				stb.InitPlayer();
				stb.SetTopWin(1);
				stb.SetLoop(0);				
				stb.SetVolume(50);
				stb.Play(demosound);
				//stb.RDir('getenv language').clearnl()
				document.cookie="mac="+stb.GetDeviceMacAddress()+"; path=/";

//				alert(stb.RDir('getenv language'));
//				document.cookie="stb_lang=ru; path=/";				
//				$.cookie("mac", stb.GetDeviceMacAddress(), { path: '/' });
//				$.cookie("stb_lang", stb.RDir('getenv language'), { path: '/' });
		
				$('#soba').load('../welcome/vratipodatke.php?sta=brsobe');
//				$('#spol').load('vratipodatke.php?sta=spol);
				$('#name').load('../welcome/vratipodatke.php?sta=name');
				$('#login').load('../welcome/vratipodatke.php?sta=login');
				$('#password').load('../welcome/vratipodatke.php?sta=password');
//				$('#lang').html(stb.RDir('getenv language'));
//				$('#lang').html(stb.GetEnv('{"varList":["language"]}'));


				setTimeout(function(){vratiuportal();},300000);
//				setTimeout(function(){vratiuportal();},10000);		
				setInterval(function(){loadXMLDoccc();}, 60000);		
			} 
			
			function vratiuportal(){
				stb.Stop(); 
				window.location = "http://"+adresaportala;
			}
			
			function loadXMLDoccc()
			{
				var xmlhttp;
				xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
//						_debug("XMLresponse:"+xmlhttp.responseText);
						if (xmlhttp.responseText=="welcome"){
							stb.Stop();
							stb.StandBy(false);	
							stb.ExecAction('front_panel led-off');							
//							_debug("redirecting to home page");			
							window.location.href = "/stalker_portal/external/welcome2/index.php"
						
						};
						if (xmlhttp.responseText=="on"){
//							_debug("on");						
							stb.StandBy(false);
							stb.ExecAction('front_panel led-off');							
						
						};
						if (xmlhttp.responseText=="off"){
//							_debug("off");		
							stb.Stop();
							stb.StandBy(true);			
							stb.ExecAction('front_panel led-on');						
						};
						if (xmlhttp.responseText=="alarm"){
							stb.Stop();
							stb.StandBy(false);
							stb.ExecAction('front_panel led-off');				
							_debug("redirecting to home page");
							window.location.href = "/stalker_portal/external/alarm/index.php"
						
						};

						
					}
				}
				xmlhttp.open("GET","/stalker_portal/external/welcome/vratipodatke.php?sta=js",true);
				xmlhttp.send();	
			}			
			
			function getkeydown(e) { 
//				stb.Debug("!!!!key pressed!!!");
				var code = e.keyCode || e.which;
//				stb.Debug(code);								
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
					case 2117: //power
					{
						if (stb.GetStandByStatus()==true){
							//stb.Debug("Ugasen je palim ga...");						
							stb.StandBy(false);
							stb.ExecAction('front_panel led-off');							
						} else {
							//stb.Debug("Upaljen je, gasim ga...");
							stb.StandBy(true);
							stb.ExecAction('front_panel led-on');							
						}
						break;
					}				
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
					
					case 49:
					{
						document.cookie = "language=en_GB.utf8; expires=Tue, 1 Dec 2037 12:00:00 GMT; path=/";					
						//1
//						stb.RDir('getenv language')
						stb.Stop(); 
//						stb.SetEnv('{"language":"en"}');
						stb.RDir('setenv language en');
	
						document.cookie = "stb_lang=en; expires=Tue, 1 Dec 2037 12:00:00 GMT; path=/";						
						location.reload();
						break;
					}
					case 9950:
					{
						document.cookie = "language=ru_RU.utf8; expires=Tue, 1 Dec 2037 12:00:00 GMT; path=/";					
						//2
//						stb.RDir('getenv language')
						stb.Stop(); 
//						stb.SetEnv('{"language":"ru"}');
						stb.RDir('setenv language ru');

						document.cookie = "stb_lang=ru; expires=Tue, 1 Dec 2037 12:00:00 GMT; path=/";
						location.reload();
						break;
					}
					case 50:
					{
						document.cookie = "language=hr_HR.utf8; expires=Tue, 1 Dec 2037 12:00:00 GMT; path=/";					
						//3
//						stb.RDir('getenv language')
						stb.Stop(); 
//						stb.SetEnv('{"language":"hr"}');
						stb.RDir('setenv language hr');

						document.cookie = "stb_lang=hr; expires=Tue, 1 Dec 2037 12:00:00 GMT; path=/";						
						location.reload();						
						break;
					}										
					case 9952:
					{
						//4
//						stb.RDir('getenv language')
						stb.Stop(); 
//						stb.SetEnv('{"language":"pl"}');
						stb.RDir('setenv language pl');
						document.cookie = "language=pl_PL.utf8;  expires=Tue, 1 Dec 2037 12:00:00 GMT;path=/";
						document.cookie = "stb_lang=pl; expires=Tue, 1 Dec 2037 12:00:00 GMT; path=/";						
						location.reload();
						break;
					}

					
					
					case keys.EXIT:
					{
						stb.Stop(); 					
						window.location = "http://"+adresaportala;
						break; 						
					}
					case keys.MENU:
					{
						stb.Stop(); 					
						window.location = "http://"+adresaportala;
						break; 						
					}
					case 8: //back
					{
						stb.Stop(); 					
						window.location = "http://"+adresaportala;
						break; 						
					}					
					case keys.BLUE:
					{
						if (stb.GetPIG() == false){
							stb.Debug("GETPIG true, blue");
							stb.SetTopWin(1);
							stb.SetViewport(890,570, 188, 228);
							$('.container').show();
//							stb.SetPIG(0,64,300,300);						
							//stb.Play(demovideo);													
						} else {
							$('.container').hide();
							stb.Debug("GETPIG false, blue");
							stb.SetTopWin(1);							
							stb.SetPIG(1, -1, -1, -1);	
							stb.SetVolume(50);							
							stb.Play(demovideo);	
							$('.container').show();							
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
						stb.SetViewport(890,570, 188, 228);
						stb.SetVolume(50);				
						stb.Play(demovideo);
					  }
				  },
				  event : 0
			}	
			
