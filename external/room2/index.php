<!DOCTYPE html>
<html class="no-js">
<? include "../../dbinfo.php"; 
initLocale();
?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><? echo _("Room"); ?></title>

        <link rel="stylesheet" href="../welcome2/css/main.css">

        <script src="../welcome2/js/vendor/modernizr-2.6.2.min.js"></script>
		<script type="text/javascript" src="../welcome/js/base-funcs.js"></script>
		<script language="JavaScript" src="../welcome/js/variables.js"></script> 
		<script language="JavaScript" src="../welcome/js/egSTB.js"></script> 
		<script> var adresaportala="<? echo $adresaportala; ?>";</script>
        <script src="js/moje.js?nekaj=7"></script>		
    </head>
    <body onload="init()" onKeyPress="getkeydown(event)">

        <div class="container">
            <div class="inner">
                <!-- header -->
                <div class="room-number"><h1><div id="soba"></div><!-- <? echo substr($_COOKIE["mac"],-5); ?> --></h1></div>
                <!-- /header -->

                <!-- main -->
                <div class="main">
                    <div class="mode">
                        <h1><? echo _("MODE"); ?></h1>
                        <a id="me0" href="#" class="mode-btn active"><?= _("Room temperature") ?></a>
                        <a id="me1" href="#" class="mode-btn"><?= _("Bathroom temperature") ?></a>
                        <a id="me2" href="#" class="mode-btn"><?= _("Blinds") ?></a>
                    </div>

                    <div class="statuses">
                        <h1><? echo _("STATUS"); ?></h1>
                        <div class="stat">
                            <div class="name"><? echo _("Door"); ?></div>
                            <div class="state warn" id="idoor" ><?= _("Open") ?></div>
                        </div>

                        <div class="stat">
                            <div class="name"><? echo _("Window"); ?></div>
                            <div class="state ok" id="iwindow" ><?= _("Closed") ?></div>
                        </div>

                        <div class="stat">
                            <div class="name"><? echo _("Card"); ?></div>
                            <div class="state ok" id="icard"><?= _("In slot") ?></div>
                        </div>

                        <div class="stat">
                            <div class="name" id="iheatcool1"><? echo _("Cooling"); ?></div>
                            <div class="state warn" id="iheatcool"><?= _("On") ?></div>
                        </div>

                        <div class="stat">
                            <div class="name"><? echo _("SOS"); ?></div>
                            <div class="state ok" id="isos" ><?= _("Off") ?></div>
                        </div>
                    </div>
                </div>
                <!-- /main -->

                <!-- info -->
                <div class="info" id="info0">
                    <div class="settings">
                        <div class="set-temp">
                            <span><div id="tempsobeset"></div>&deg;C</span>
                            <? echo _("set temperature"); ?>
                        </div>
                        <div class="current-temp">
                            <span><div id="tempsobe"></div>&deg;C</span>
                            <? echo _("current temperature"); ?>
                        </div>
                    </div>
                </div>

                <div class="info" id="info1" style="display:none">
                    <div class="settings">
                        <div class="set-temp">
                            <span><div id="tempbathset"></div>&deg;C</span>
                            <? echo _("set temperature"); ?>
                        </div>
                        <div class="current-temp">
                            <span><div id="tempbath"></div>&deg;C</span>
                            <? echo _("current temperature"); ?>
                        </div>
                    </div>
                </div>				

                <div class="info" id="info2" style="display:none">
                    <div class="settings">
                        <div class="blinds">
                            <? echo _("Use left and right buttons to lower or raise the blinds."); ?>
                        </div>
                    </div>
                </div>				
                <!-- /info -->

                <!-- menu -->
                <div class="menu">
                    <ul>
                        <li class="separator">&nbsp;</li>
                        <li class="red"><a href="#"><? echo _("DND"); ?> <img id="dndimg" src="../welcome2/img/dnd-on.png"></a></li>
                        <li class="separator">&nbsp;</li>
                        <li class="green"><a href="#"><? echo _("Door lock"); ?> <img id="doorlockimg" src="../welcome2/img/lock-on.png"></a></li>
                        <li class="separator">&nbsp;</li>
                        <li class="yellow"><a href="#"><? echo _("Maid"); ?><img id="roomsrvimg" src="../welcome2/img/service-off.png"> </a></li>
                        <li class="separator">&nbsp;</li>
                        <li class="blue"><a href="#"><? echo _("Room service"); ?> <img id="maidimg" src="../welcome2/img/maid-off.png"></a></li>
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
