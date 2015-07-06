<?php

$host="localhost";
$user="root";
$pass="magic";
$db="stalker_db";

$pathdoslika="/stalker_portal/c/template/hortensia/i_720/";
$adresaportala="10.30.0.5/stalker_portal/c/";

function md5sobe($room,$sta,$koliko){
        $timee=floor(time()/100)*100;
        $controller="http://10.51.0.10:80/?Room=";
        $key="Test";
        $stringza=$key.$room.$key.$sta.$key.$koliko.$key.$timee;
        $md5iran=strtoupper(md5($stringza));
        $final="$controller$room&$sta=$koliko&Sign=$md5iran&IgnoreSign=2";
        //echo $final;
        $prog = strip_tags(file_get_contents($final));
        // explode($prog,"<br>")[0];
        return $prog;
}

function initLocale(){

//echo $_COOKIE['language'];
        if (!empty($_COOKIE['language'])){
                $locale = $_COOKIE['language'];
    } else {
                        $locale="en_GB.utf8";
        };
//      echo $locale;
setlocale(LC_MESSAGES, $locale);
setlocale(LC_TIME, $locale);
putenv('LC_MESSAGES='.$locale);
bindtextdomain('stb', '/var/www/html/stalker_portal/server/locale');
textdomain('stb');
bind_textdomain_codeset('stb', 'UTF-8');
}


?>
