window.onload = init;
window.onkeydown = key.press;
function init() {
    try {
        stb = gSTB;
        stb.ExecAction("graphicres " + graphicres_mode);
        stb.EnableServiceButton(true);
    } catch (e) {
    }
    try {
        modes.emulate = false;
        stb = gSTB;
    } catch (e) {
        modes.emulate = true;
        stb = egSTB;
    }
    VKBlock = true;
    win = {"width":screen.width, "height":screen.height};
//    gs.layers.game = document.getElementById('game').getContext('2d');
//    if (!gs.layers.game || !gs.layers.game.drawImage) {
//        return;
//    }
    var loc = new String(window.location);
    if (loc.indexOf('?') >= 0) {
        var parts = loc.substr(loc.indexOf('?') + 1).split('&'), _GET = new Object();
        for (var key = 0; key < parts.length; key++) {
            var part = parts[key];
            _GET[part.substr(0, part.indexOf('='))] = part.substr(part.indexOf('=') + 1);
        }
        pages.referrer = decodeURIComponent(_GET['referrer']);
    } else {
        pages.referrer = document.referrer;
    }
    switch (win.height) {
        case 480:

            graphicres_mode = "720";
            break;
        case 576:

            graphicres_mode = "720";
            break;
        case 720:

            graphicres_mode = "1280";
            break;
        case 1080:

            graphicres_mode = "1920";
            break;
    }
    window.resizeTo(win.width, win.height);
    window.moveTo(0, 0);
    var fileref = document.createElement("link");
    fileref.setAttribute("rel", "stylesheet");
    fileref.setAttribute("type", "text/css");
    fileref.setAttribute("href", 'css/screen_' + win.height + '.css');
    document.getElementsByTagName("head")[0].appendChild(fileref);
	var ipaddress;
	stb.RDir("IPAddress",ipaddress)
	document.getElementById('unutra').innerHTML += ipaddress;

	
}
