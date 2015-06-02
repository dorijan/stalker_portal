(function(){
 
    // The first argument - caption under the icon in the main menu
     main_menu.add(get_word('Welcome screen'), [], 'mm_ico_welcome.png', function(){
 
        var params = '';
 
        if (stb.user['web_proxy_host']){
            params = '?proxy=http://'+stb.user['web_proxy_host']+':' +stb.user['web_proxy_port'];
        }
 
        stb.setFrontPanel('.');
 
        if (!params){
            params += '?';
        }else{
            params += '&';
        }
 
        params += 'referrer='+encodeURIComponent(window.location);
 
        //window.location = '/' + stb.portal_path + '/external/olltv/index.html'+params;
        window.location = '/' + stb.portal_path +'/external/welcome2/index.php'+params;
 
    }, {layer_name : "welcome"}); // For correct module work it is neccessary to point unique layer_name
 
    loader.next();
})();