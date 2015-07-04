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
				setInterval(function(){osvjeziajax();}, 5000);
				ofarbaj();
				setTimeout(function(){vratiuportal();},600000);
				setInterval(function(){loadXMLDoccc();}, 60000);				
//				tempsobe
//				$('#spol').load('vratipodatke.php?sta=spol);
				
			} 

			function loadXMLDoccc()
			{
				var xmlhttp;
				xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
//						stb.Debug("XMLresponse:"+xmlhttp.responseText);
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
//				stb.Debug(("!!!!key pressed!!!");
//				var code=e.keyCode;
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
					case 2117: //power
					{
						if (stb.GetStandByStatus()==true){
							stb.Debug("Ugasen je palim ga...");						
							stb.StandBy(false);
							stb.ExecAction('front_panel led-off');							
						} else {

							stb.Debug("Upaljen je, gasim ga...");
							stb.StandBy(true);						
							stb.ExecAction('front_panel led-on');							
						}
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
						$.get("../welcome/postavi.php?sta=DND&koliko=2", function(respons2) {
							osvjeziajax();
						});
						break; 
					}			
					case keys.BLUE: //room service
					{
						$.get("../welcome/postavi.php?sta=RoomSvc&koliko=2", function(respons2) {
							osvjeziajax();
						});
					
//						window.location = "../welcome/postavi.php?sta=Staff&koliko=2";					
						break; 
					}								
					case keys.YELLOW: //food order
					{
						$.get("../welcome/postavi.php?sta=Staff&koliko=2", function(respons2) {
							osvjeziajax();
						});						
						//window.location = "../welcome/postavi.php?sta=Staff&koliko=2";					
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
						
						stb.Debug(pozicija);
						
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

						stb.Debug(pozicija);
						ofarbaj();
						
						
//						window.location = "../welcome/postavi.php?sta=SetPoint&koliko=-1";					
						break; 					
					}

					case 37: //left
					{
						if (pozicija==0){
							$.get("../welcome/postavi.php?sta=SetPoint&koliko=-1", function(respons2) {
								osvjeziajax();
							});						
						
						}					
						if (pozicija==1){
							$.get("../welcome/postavi.php?sta=SetPointBath&koliko=-1", function(respons2) {
								osvjeziajax();
							});						
						
						}					
						if (pozicija==2){
							$.get("../welcome/postavi.php?sta=BlindsDown&koliko=1", function(respons2) {
//								osvjeziajax();
							});						
						}					
					
						break;
					}
					
					case 39: //right
					{
						if (pozicija==0){
							$.get("../welcome/postavi.php?sta=SetPoint&koliko=1", function(respons2) {
								osvjeziajax();
							});						
						
						}					
						if (pozicija==1){
							$.get("../welcome/postavi.php?sta=SetPointBath&koliko=1", function(respons2) {
								osvjeziajax();
							});						
						
						}										

						if (pozicija==2){
							$.get("../welcome/postavi.php?sta=BlindsUp&koliko=1", function(respons2) {
//								osvjeziajax();
							});						
						}						
					
						break;						
					}
				}

			}
			
			function vratiuportal(){
				stb.Stop(); 
				window.location = "http://"+adresaportala;
			}
			
			function ofarbaj(){

				for (var i = 0; i < maxmeni; i++) {
					var koja;
					koja="#me"+i;
					koja2="#info"+i;					
//					stb.Debug(koja);
					$(koja).removeClass();
					$(koja2).css("display", "none");
					//$(".me"+i).removeClass("blue_row_bg");
					if (pozicija===i) {
						$(koja).addClass("mode-btn active");
						$(koja2).css("display", "block");						
					} else {
						$(koja).addClass("mode-btn");
					}
				};
				
//				if ((pozicija==1)||(pozicija==0)){
//					$("#sastrane").html("<? echo _("Use LEFT and RIGHT buttons to set temperature.");?>");				
//				};
//				if ((pozicija==2)){
//					$("#sastrane").html("<? echo _("Use LEFT and RIGHT buttons to lower or raise blinds.");?>");				
//				};
				
			}
			
			
			function osvjeziajax(){
			
				$('#tempsobe').load('../welcome/vratipodatke.php?sta=Temperature');
				$('#tempbath').load('../welcome/vratipodatke.php?sta=Temperaturebath');				
				//temperatura postavljena
				$('#tempsobeset').load('../welcome/vratipodatke.php?sta=SetPoint');				
				
				//temperatura postavljena kupaone
				$('#tempbathset').load('../welcome/vratipodatke.php?sta=SetPointBath');				
				
				//DND
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=11", function(respons) {
					$('#dndimg').attr("src",respons);
				});				

				//da li su zakljucana vrata
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=52", function(respons) {
					$('#doorlockimg').attr("src",respons);
				});

				//spremacica
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=8", function(respons) {
					$('#roomsrvimg').attr("src",respons);
				});				

				//staff - room service
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=10", function(respons) {
					$('#maidimg').attr("src",respons);
				});
				
				
//				$.get("../welcome/vratipodatke.php?sta=Status&trebam=52", function(respons) {
//					vrata1 = respons;
//					$('#door').css('background-image', 'url(' + vrata1 + ')');
//				});
				//kartica
//				$.get("../welcome/vratipodatke.php?sta=Status&trebam=13", function(respons) {
//					vrata1 = respons;
//					$('#card').css('background-image', 'url(' + vrata1 + ')');
//				});


				//sos
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=9&dio=1", function(respons) {
					$('#isos').removeClass().addClass(respons);
				});
				$('#isos').load("../welcome/vratipodatke.php?sta=Status&trebam=9&dio=2");
				//door open
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=61&dio=1", function(respons) {
					$('#idoor').removeClass().addClass(respons);
				});
				$('#idoor').load("../welcome/vratipodatke.php?sta=Status&trebam=61&dio=2");				
				
				//window open
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=62&dio=1", function(respons) {
					$('#iwindow').removeClass().addClass(respons);
				});
				$('#iwindow').load("../welcome/vratipodatke.php?sta=Status&trebam=62&dio=2");					
				
				//card
				$.get("../welcome/vratipodatke.php?sta=Status&trebam=1&dio=1", function(respons) {
					$('#icard').removeClass().addClass(respons);
				});
				$('#icard').load("../welcome/vratipodatke.php?sta=Status&trebam=1&dio=2");				

				//heating cooling
				$.get("../welcome/vratipodatke.php?sta=Stanjegrhl&dio=1", function(respons) {
					$('#iheatcool').removeClass().addClass(respons);
				});
				$('#iheatcool').load("../welcome/vratipodatke.php?sta=Stanjegrhl&dio=2");				
				$('#iheatcool1').load("../welcome/vratipodatke.php?sta=Stanjegrhl&dio=3");				
			
			}
			
		//	document.onkeydown = getkeydown;