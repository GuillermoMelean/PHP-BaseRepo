<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 

$request = $_SERVER['REQUEST_URI'];
$arrayUrl = explode("/",trim($request));

if(count($arrayUrl)>2){
    $lang = strtoupper($arrayUrl[1]);
    if(strlen($lang)>3){
        $lang="pt";
    }
}else{
    $lang = "pt";
}

$page = (count($arrayUrl)>2) ? $arrayUrl[2] : $arrayUrl[1]; 

setcookie("lang", $lang, 0,'/');
$_COOKIE["lang"] = $lang;

switch (strtolower($page)) {

    case 'index' :
    case '' :
    case '/';
    case 'home';
        require './views/index.php';
        break;

    case 'contactos':
    case 'contacts':  
        require './views/contacts.php';
        break;

    default:
        require './views/404.php';
        break; 
}
