<?php
/* echo "alxa " . $_SERVER["SCRIPT_NAME"];
echo "<br> xpto " .strrpos($_SERVER["SCRIPT_NAME"],"/");
echo "<br> xpto2 " .$_SERVER['REQUEST_URI'];
die(); */
 
if(isset($_COOKIE['lang'])){
  $_COOKIE['lang'] = strtolower($_COOKIE['lang']);
}else{
  $lang = explode(";",getcookie('lang'))[0];
}

function curPageName() {
  $url = $_SERVER['REQUEST_URI'];
  $urlOb = explode("/",$url);
  
  if(count($urlOb)>2){
    $url = $urlOb[2]; 
    if(count($urlOb)>3){
      $url .= '/'.$urlOb[3];
    }
  }
  else{
    $url = "";
  }

  return $url;
}

function funGetLinkToShare(){
  return $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function funGetHost(){
  return $_SERVER['HTTP_HOST'];
}

function getcookie($name) {
  $cookies = [];
  $headers = headers_list();
  // see http://tools.ietf.org/html/rfc6265#section-4.1.1
  foreach($headers as $header) {
      if (strpos($header, 'Set-Cookie: ') === 0) {
          $value = str_replace('&', urlencode('&'), substr($header, 12));
          parse_str(current(explode(';', $value, 1)), $pair);
          $cookies = array_merge_recursive($cookies, $pair);
      }
  }
  if(!isset($cookies[$name])){
    return "";
  }else{
    return strtolower($cookies[$name]);
  }
}

function funSetCookie($vfNameCookie,$vfCookieValue){
  if(!isset($_COOKIE[$vfNameCookie])) {
    setcookie($vfNameCookie, $vfCookieValue, 0,'/');
    $_COOKIE[$vfNameCookie] = $vfCookieValue;
  }
}

include_once("includes/globalVars.php");
include_once(PATH_DATABASE_BASE);

$db = Database::getInstance();
$connection = $db->getConnection();

$blacklist = array(
  '127.0.0.1',
  'localhost',
  '::1'
); 

$listLangHide = "";
$listSocialMedia = ""; 
$sql = "SELECT
          tb_language.langMin,
          tb_language.lang,
          tb_language.defaultLang
          FROM tb_language
          WHERE statusLang = 1";

if ($result = $connection->query($sql)) {
   
  while($row = mysqli_fetch_assoc($result)){

    if(!isset($_COOKIE['lang']) || $row['langMin'] == $_COOKIE['lang']){
      $first = "first-lang";
    } else {
      $first = "";
    }
    
    $arrayCF = array();
    if(isset($_COOKIE['lang'])){
      $arrayCF = explode('_',$_COOKIE['lang']);
    }

    $lang = $row['langMin'];
    $fulllang = $row['lang'];  

    if(($row['defaultLang'] == 1 && !isset($_COOKIE['lang'])) || $row['langMin'] == $_COOKIE['lang'] || (count($arrayCF)==2 )){
      if(!isset($_COOKIE['lang']) || (count($arrayCF)==2 ))
      {
        $_COOKIE['lang']=strtolower($lang);
      }
      $listLangVisi = '<a href="/'.$lang."/".curPageName().'"><img src="/images/flags/'.$lang.'.png" alt="'.$lang.'">'.$fulllang.'</a>';
    }else{
      $COUNTER ="entrou no false";
      $listLangHide .= '<li class="top-links-item"><a href="/'.$lang."/".curPageName().'"><img src="/images/flags/'.$lang.'.png" alt="Lang">'.$fulllang.'</a></li>';
    } 
  }
}

if(isset($_COOKIE['lang'])){
  $lang = $_COOKIE['lang'];
}else{
  $lang = explode(";",getcookie('lang'))[0];
}

$sqlCmdTranslations = "SELECT
                        tb_translations_codes.code,
                        tb_translations.value
                      FROM
                        tb_translations
                      JOIN tb_translations_codes
                      ON tb_translations.idTbCodeTranslations = tb_translations_codes.id
                      JOIN tb_language
                      ON tb_translations.idTbLanguage = tb_language.id
                      WHERE
                        tb_translations_codes.deleted = 0
                      AND 
                        tb_language.deleted = 0
                      AND
                        tb_language.langMin ='".$lang."'";

if ($resultTrans = $connection->query($sqlCmdTranslations)) {
  while ($rowTrans = mysqli_fetch_assoc($resultTrans)) {
    define($rowTrans['code'],$rowTrans['value']);
  }
}

$sqlCmdSettings = "SELECT * FROM tb_setting";

if ($resultTrans = $connection->query($sqlCmdSettings)) {
  while ($rowTrans = mysqli_fetch_assoc($resultTrans)) {
    define('SETTING_'.$rowTrans['description'],$rowTrans['value']);
  }
}