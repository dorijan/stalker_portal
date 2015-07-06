<!DOCTYPE html>
<html class="no-js">
<? include "../../dbinfo.php"; 


initLocale();


?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><? echo _("Welcome"); ?></title>

        <link rel="stylesheet" href="css/main.css">
		<style>
		.container {
			background: #583f32 url(<? echo $pathdoslika; ?>bg3.png) no-repeat top left;
		}
		</style>
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
		<script language="JavaScript" src="../welcome/js/base-funcs.js"></script>
		<script language="JavaScript" src="../welcome/js/variables.js"></script> 
		<script language="JavaScript" src="../welcome/js/egSTB.js"></script>
		<script> var adresaportala="<? echo $adresaportala; ?>";</script>		
        <script src="js/moje.js?ver=4"></script>
    </head>
    <body onload="init()" onKeyPress="getkeydown(event)">

        <div class="container">
            <div class="inner">
                <!-- header -->
                <div class="room-number"><h1><div id="soba"></div></h1></div>
                <!-- /header -->

                <!-- main -->
                <div class="main"><img src="img/tvback.png"></div>
                <!-- /main -->

                <!-- info -->
                <div class="info">
                    <div class="message">
                        <h2><? echo _("Welcome");?></h2>
                        <p><div id="name"></div></p>    
                    </div>

                    <div class="wireless">
                        <i class="icon"><img src="img/wireless.png"></i>
                        <div class="left">
                            <h2><? echo _("Wireless");?></h2>
                            <p>
                                <span><? echo _("username");?>:</span> <a id="login"></a><br>
                                <span><? echo _("password");?>:</span> <a id="password"></a>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /info -->

                <!-- menu -->
                <div class="menu">
                    <ul>
                        <li class="separator">&nbsp;</li>
                        <li><a ><? echo _("MENU");?></a></li>
                        <li class="separator">&nbsp;</li>
                        <li class="blue"><a ><? echo _("Full screen");?></a></li>
                        <li class="separator">&nbsp;</li>
                        <li><a >1 <img src="img/United-Kingdom-flat-icon.png"></a></li>
                        <li class="separator">&nbsp;</li>
                        <li><a >2 <img src="img/Croatia-flat-icon.png"></a></li>
                        <li class="separator">&nbsp;</li>						
                    </ul>
                </div>
                <!-- /menu -->
				<div id="lang"></div>
            </div>
        </div>

        <script src="js/vendor/jquery-1.11.0.min.js"></script>

        <!--remove in production 
        <script src="js/vendor/holder.js"></script>-->
        <!-- remove in production -->

    </body>
</html>
