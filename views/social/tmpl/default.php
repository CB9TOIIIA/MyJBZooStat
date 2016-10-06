<?php
/** @var $this MyjbzoostatViewAutors */
defined( '_JEXEC' ) or die; // No direct access

// ini_set( 'display_errors', 1 );
// error_reporting( E_ALL );

require_once JPATH_ADMINISTRATOR . '/components/com_myjbzoostat/elements/paramsetc.php';
require_once JPATH_ADMINISTRATOR . '/components/com_myjbzoostat/vendor/autoload.php'; // composer autoload.php

use JBZoo\HttpClient\HttpClient;
use JBZoo\HttpClient\Response;

$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/articles.css');
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/social.css');

 ?>


 <?php
 function rdate($param, $time=0) {
  if(intval($time)==0)$time=time();
  $MonthNames=array("январь", "февраль", "март", "апрель", "май", "июнь", "июль", "август", "сентябрь", "октябрь", "ноябрь", "декабрь");
  if(strpos($param,'M')===false) return date($param, $time);
    else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
 }



//https://apiok.ru/en/dev/methods/rest/group/group.getInfo

 // demo test
 // API WORK - but so difficult and token have time limit (1800)
 // $OK_application_id = '1123123123';
 // $OK_application_key = 'CBAAAAAAAAAAAAAAAAA';
 // $OK_application_secret_key = 'AFBBBBBBBBBBBBBBBBB';
 // $OK_ID_uids = '572111111111111';
 // $OK_sig = '451f981241241241242b30d26';
 // $OK_access_token = '6vnsga.19124214214214241124rv9';

 $httpClient = new HttpClient([
   'driver'  => 'auto',
   'timeout' => 10,        // Wait in seconds
   'allow_redirects' => true,
   'max_redirects'   => 10,
   'user_agent'  => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2',
   'accept-language' => 'ru-RU',
   'verify'  => false,     // Check cert for SSL
 ]);


 if (!empty($vksocialname)) {

   $response = $httpClient->request('https://api.vk.com/method/groups.getMembers?group_id='.$vksocialname.'');
   $code = $response->getcode();

   if ($code == 200) {
     $json = $response->getJSON();
     $valueVK = $json->find('response.count', 'default', 'trim');
     //dump($valueVK,0,'$valueVK');
   }

 }
 else {
   $valueVK = '-';
 }

 // $response = $httpClient->request("https://api.ok.ru/fb.do?application_key=".$OK_application_key."&fields=members_count&format=json&method=group.getInfo&uids=".$OK_ID_uids."&sig=".$OK_sig."&access_token=".$OK_access_token."");
 //
 // $code = $response->getcode();
 // if ($code == 200) {
 //   $json = $response->getJSON();
 //   $valueOK = $json->find('0.members_count', NULL, 'trim');
 //   if (NULL != $valueOK) {
 //     dump($valueOK,0,'$valueOK');
 //     // echo $valueOK;
 //   }
 // }
 // if (NULL == $valueOK) {


  if (!empty($vksocialname)) {
   $response = $httpClient->request("https://m.ok.ru/{$oksocialname}");
   $code = $response->getcode();
   if ($code == 200) {
     $body = $response->body;
     preg_match("/\<ul.class=\"list.toggle\"\>.+tgl-controls/", $body, $matchok);
     $matchok = strip_tags($matchok['0']);
     $matchok = str_replace('Темы','<div class="ok1"><span class="themes">Темы</span> <span class="themescount">',$matchok);
     $matchok = str_replace('Фото','</span></div> <div class="ok2"><span class="photo">Фото</span> <span class="photocount">',$matchok);
     $matchok = str_replace('Видео','</span></div> <div class="ok3"><span class="video">Видео &nbsp; &nbsp;</span> <span class="videocount">',$matchok);
     $matchok = str_replace('Участники','</span></div> <div class="ok4"><span class="users">Участники</span> <span class="userscount">',$matchok);
     $matchok = str_replace('Ссылки','</span></div> <div class="ok5"><span class="links">Ссылки &nbsp;&nbsp;&nbsp;</span> <span class="linkscount">',$matchok);
     $matchok .= '</span></div>';
     $matchok = str_replace('<span class="videocount"></span>','<span class="videocount">0</span>',$matchok);
     $matchok = str_replace('<span class="linkscount"></span>','<span class="linkscount">0</span>',$matchok);
     $matchok = str_replace('<span class="photocount"></span>','<span class="photocount">0</span>',$matchok);
    // dump($matchok,0,'$matchok');

   }
}
else {
  $matchok = '-';
}
 // }

 if (!empty($fbsocialname)) {

   $response = $httpClient->request('https://www.facebook.com/'.$fbsocialname.'');
   $code = $response->getcode();

   if ($code == 200) {
     $body = $response->body;
     if (preg_match('/MorePagerFetchOnScroll/', $body, $matchfb)) {
       preg_match('/\<span id\="PagesLikesCountDOMID"\>.+PageStructured/', $body, $matchfb);
       $matchfb = strip_tags($matchfb['0']);
       $matchfb = str_replace('Отметки «Нравится»:','<span class="fbcount">',$matchfb);
       $matchfb .= ' </span>';
     }
     else {
       $matchfb = '<span class="fbcount"> Нельзя </span>';
     }

     //dump($matchfb,0,'$matchfb');

   }
 }
 else {
   $matchfb = '-';
 }


 if (!empty($gplussocialname)) {
   $response = $httpClient->request('https://plus.google.com/'.$gplussocialname.'');
   $code = $response->getcode();

   if ($code == 200) {
     $body = $response->body;
    //  echo "<pre>";
    //  var_dump($body);
    //  echo "</pre>";
     if (preg_match('/подписчик/', $body, $matchgplustest) || preg_match('/послідовник/', $body, $matchgplustest) || preg_match('/користувач/', $body, $matchgplustest)) {
       preg_match_all('/\<span class\=\"BOfSxb\"\>.+\<span class\=\"DtDbDb\"\>/', $body, $matchgplus);
       foreach ($matchgplus as $matchgplusone) {
         $matchgplusone = strip_tags($matchgplusone['0']);
         $matchgplusone = preg_replace('/&.*/', '', $matchgplusone);
         $matchgplusone = str_replace(' подписчика','',$matchgplusone);
         $matchgplusone = str_replace(' подписчик','',$matchgplusone);
         $matchgplusone = str_replace(' послідовник','',$matchgplusone);
         $matchgplusone = str_replace(' послідовників','',$matchgplusone);
         $matchgplusone = str_replace(' користувач','',$matchgplusone);
         $matchgplusone = preg_replace('/і.*/', '', $matchgplusone);
         $matchgplusone = preg_replace('/в.*/', '', $matchgplusone);
         $matchgplusone = str_replace('і','',$matchgplusone);
         $matchgplusone = str_replace('в','',$matchgplusone);
        //  $matchgplusone = str_replace(' і підписалися','',$matchgplusone);
        //  $matchgplusone = str_replace(' підписалися','',$matchgplusone);
        //  $matchgplusone = str_replace('підписалися','',$matchgplusone);
        //  $matchgplusone = str_replace(' пдписалося','',$matchgplusone);
        //  $matchgplusone = str_replace('пдписалося','',$matchgplusone);
        //  $matchgplusone = str_replace('і','',$matchgplusone);
        //  $matchgplusone = str_replace('в','',$matchgplusone);
       }

       //dump($body,0,'$body');
       //dump($matchgplus,0,'$matchgplus');
     }
     else {
       $matchgplusone = '-';
     }

   }

 }
 else {
   $matchgplusone = '-';
 }


 if (!empty($gplussocialname)) {
   $response = $httpClient->request('https://plusone.google.com/u/0/_/+1/fastbutton?count=true&url=http://'.$_SERVER['SERVER_NAME'].'');
   $code = $response->getcode();

   if ($code == 200) {
     $body = $response->body;
     preg_match_all('/window\.\_\_SSR.+\.0/', $body, $matchgplusbtns);
     if (!empty($matchgplusbtns) || $matchgplusbtns != NULL) {
       foreach ($matchgplusbtns as $matchgplusbtn) {
         if ($matchgplusbtn != NULL && !empty($matchgplusbtn)) {
           $matchgplusbtn = $matchgplusbtn['0'];
           $matchgplusbtn = str_replace('window.__SSR = {','',$matchgplusbtn);
             $matchgplusbtn = str_replace('.0','',$matchgplusbtn);
             $matchgplusbtn = str_replace('c: ','',$matchgplusbtn);
           }
           else {
             $matchgplusbtn = 0;
           }
         }
         if(empty($matchgplusbtn)) {
           $matchgplusbtn = 0;
         }
       }
     }
   }
   else {
     $matchgplusbtn = '-';
   }


 if (!empty($twittersocialname)) {
  $response = $httpClient->request('https://twitter.com/'.$twittersocialname.'');
  $code = $response->getcode();

  if ($code == 200) {
    $body = $response->body;
    preg_match_all("/<span class=\"ProfileNav-value\" data-is-compact=\".+/", $body, $matchtwiterarr);
    foreach ($matchtwiterarr as $matchtwiter) {
      $matchtwit = strip_tags($matchtwiter['0']);
      $matchtwitreadusers = strip_tags($matchtwiter['1']);
      $matchtwitusers = strip_tags($matchtwiter['2']);
      $matchtwitlike = strip_tags($matchtwiter['3']);

      if (empty($matchtwitreadusers)) {
        $matchtwitreadusers = 0;
      }
      if (empty($matchtwitusers)) {
        $matchtwitusers = 0;
      }
      if (empty($matchtwitlike)) {
        $matchtwitlike = 0;
      }

    }

  }
}

if (!empty($twittersocialname)) {
  $response = $httpClient->request($youtubesocialname);
  $code = $response->getcode();

  if ($code == 200) {
    $body = $response->body;
    preg_match('/yt-uix-tooltip" title="(.*)" tabindex/', $body, $matchyt);
    $matchyt = strip_tags($matchyt['1']);
    //  dump($body,0,'$body');
    //dump($matchyt,0,'$matchyt');

  }
}


?>

<div class="socialblocks">

<?php  if (!empty($vksocialname)) : ?>

<div class="vkblock">
  <a target="_blank"  href="https://vk.com/<?php echo $vksocialname;?>"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDUwIDUwIiBpZD0iTGF5ZXJfMSIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgNTAgNTAiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxwYXRoIGQ9Ik00NSwxSDVDMi44LDEsMSwyLjgsMSw1djQwYzAsMi4yLDEuOCw0LDQsNGg0MGMyLjIsMCw0LTEuOCw0LTRWNUM0OSwyLjgsNDcuMiwxLDQ1LDF6IiBmaWxsPSIjNTQ3NjlCIi8+PHBhdGggZD0iTTI2LDM0YzEsMCwxLTEuNCwxLTJjMC0xLDEtMiwyLTJzMi43LDEuNyw0LDNjMSwxLDEsMSwyLDFzMywwLDMsMHMyLTAuMSwyLTJjMC0wLjYtMC43LTEuNy0zLTQgIGMtMi0yLTMtMSwwLTVjMS44LTIuNSwzLjItNC43LDMtNS4zYy0wLjItMC42LTUuMy0xLjYtNi0wLjdjLTIsMy0yLjQsMy43LTMsNWMtMSwyLTEuMSwzLTIsM2MtMC45LDAtMS0xLjktMS0zYzAtMy4zLDAuNS01LjYtMS02ICBjMCwwLTIsMC0zLDBjLTEuNiwwLTMsMS0zLDFzLTEuMiwxLTEsMWMwLjMsMCwyLTAuNCwyLDFjMCwxLDAsMiwwLDJzMCw0LTEsNGMtMSwwLTMtNC01LTdjLTAuOC0xLjItMS0xLTItMWMtMS4xLDAtMiwwLTMsMCAgYy0xLDAtMS4xLDAuNi0xLDFjMiw1LDMuNCw4LjEsNy4yLDEyLjFjMy41LDMuNiw1LjgsMy44LDcuOCwzLjlDMjUuNSwzNCwyNSwzNCwyNiwzNHoiIGZpbGw9IiNGRkZGRkYiIGlkPSJWS18xXyIvPjwvc3ZnPg=="></a>
  <div class="vkcount"><?php echo $valueVK;  ?></div>
  <div class="vkinfo">Кол-во подписчиков</div>
  <div class="helpbtn"><a target="_blank" href="https://vk.com/stats?gid=<?php echo $vk_ID_uids;?>" class="btn btn-small">Статистика</a>
  <a target="_blank" href="http://smm-helper.ru/tools/analytics/<?php echo $vksocialname;?>" class="btn btn-small">SMM-Helper</a>
</div>
</div>

<?php  endif; ?>

<?php  if (!empty($fbsocialname)) : ?>

<div class="fbblock">
  <a target="_blank"  href="https://facebook.com/<?php echo $fbsocialname;?>"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDUwIDUwIiBpZD0iTGF5ZXJfMSIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgNTAgNTAiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxwYXRoIGQ9Ik00NSwxSDVDMi44LDEsMSwyLjgsMSw1djQwYzAsMi4yLDEuOCw0LDQsNGg0MGMyLjIsMCw0LTEuOCw0LTRWNUM0OSwyLjgsNDcuMiwxLDQ1LDF6IiBmaWxsPSIjM0E1QkEwIi8+PHBhdGggZD0iTTMyLDI2bDEtNWwtNSwwdi00YzAtMS41LDAuOC0yLDMtMmgydi01YzAsMC0yLDAtNCwwYy00LjEsMC03LDIuNC03LDd2NGgtNXY1aDV2MTRoNlYyNkgzMnoiIGZpbGw9IiNGRkZGRkYiIGlkPSJmXzFfIi8+PC9zdmc+"></a>
  <div class="fbcount"><?php  echo $matchfb;  ?></div>
  <div class="fbinfo">&nbsp;&nbsp;&nbsp;Like Page/Group</div>
  <div class="helpbtn">
    <a target="_blank" href="https://www.facebook.com/<?php echo $fbsocialname;?>/insights/" class="btn btn-small">Статистика</a>
</div>

</div>

<?php  endif; ?>


<?php  if (!empty($oksocialname)) : ?>

<div class="okblock">
  <a target="_blank"  href="https://ok.ru/<?php echo $oksocialname;?>"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDUwIDUwIiBpZD0iTGF5ZXJfMSIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgNTAgNTAiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxwYXRoIGQ9Ik00NSwxSDVDMi44LDEsMSwyLjgsMSw1djQwYzAsMi4yLDEuOCw0LDQsNGg0MGMyLjIsMCw0LTEuOCw0LTRWNUM0OSwyLjgsNDcuMiwxLDQ1LDF6IiBmaWxsPSIjRjI3MjBDIi8+PGcgaWQ9Ik9LXzFfIj48cGF0aCBkPSJNMzIsMjVjLTEsMC0zLDItNywycy02LTItNy0yYy0xLjEsMC0yLDAuOS0yLDJjMCwxLDAuNiwxLjUsMSwxLjdjMS4yLDAuNyw1LDIuMyw1LDIuM2wtNC4zLDUuNCAgIGMwLDAtMC44LDAuOS0wLjgsMS42YzAsMS4xLDAuOSwyLDIsMmMxLDAsMS41LTAuNywxLjUtMC43UzI1LDM0LDI1LDM0YzAsMCw0LjUsNS4zLDQuNSw1LjNTMzAsNDAsMzEsNDBjMS4xLDAsMi0wLjksMi0yICAgYzAtMC42LTAuOC0xLjYtMC44LTEuNkwyOCwzMWMwLDAsMy44LTEuNiw1LTIuM2MwLjQtMC4zLDEtMC43LDEtMS43QzM0LDI1LjksMzMuMSwyNSwzMiwyNXoiIGZpbGw9IiNGRkZGRkYiIGlkPSJLXzFfIi8+PHBhdGggZD0iTTI1LDEwYy0zLjksMC03LDMuMS03LDdzMy4xLDcsNyw3YzMuOSwwLDctMy4xLDctN1MyOC45LDEwLDI1LDEweiBNMjUsMjAuNSAgIGMtMS45LDAtMy41LTEuNi0zLjUtMy41YzAtMS45LDEuNi0zLjUsMy41LTMuNWMxLjksMCwzLjUsMS42LDMuNSwzLjVDMjguNSwxOC45LDI2LjksMjAuNSwyNSwyMC41eiIgZmlsbD0iI0ZGRkZGRiIgaWQ9Ik9fMV8iLz48L2c+PC9zdmc+"></a>
  <div class="okcount"><?php  echo $matchok; ?></div>
   <div class="helpbtn">
      <a target="_blank" href="https://ok.ru/<?php echo $oksocialname;?>/stat/" class="btn btn-small">Статистика</a>
  </div>
</div>

<?php  endif; ?>

<?php  if (!empty($gplussocialname)) : ?>

<div class="gplusblock">
  <a target="_blank"  href="https://plus.google.com/<?php echo $gplussocialname;?>"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDUwIDUwIiBpZD0iTGF5ZXJfMSIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgNTAgNTAiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxwYXRoIGQ9Ik00NSwxSDVDMi44LDEsMSwyLjgsMSw1djQwYzAsMi4yLDEuOCw0LDQsNGg0MGMyLjIsMCw0LTEuOCw0LTRWNUM0OSwyLjgsNDcuMiwxLDQ1LDF6IiBmaWxsPSIjRTEzNzE5Ii8+PGcgaWQ9IkdfeDJCXyI+PHBvbHlnb24gZmlsbD0iI0ZGRkZGRiIgaWQ9Il94MkJfXzFfIiBwb2ludHM9IjQwLDIzIDM2LDIzIDM2LDE5IDM0LDE5IDM0LDIzIDMwLDIzIDMwLDI1IDM0LDI1IDM0LDI5IDM2LDI5IDM2LDI1IDQwLDI1ICAiLz48cGF0aCBkPSJNMjUsMjdjMCwwLTItMS4yLTItMmMwLDAtMC41LTEuOCwxLTNjMS41LTEuMiwzLTMsMy01YzAtMi4zLTEtNS0zLTZoM2wyLjQtMWMwLDAtNy4xLDAtOS40LDAgICBjLTQuMiwwLTgsMy4zLTgsN2MwLDMuNywyLjgsNi42LDcuMSw2LjZjMC4zLDAsMC42LDAsMC45LDBjLTAuMywwLjUtMC41LDEuMS0wLjUsMS43YzAsMSwwLjgsMiwxLjUsMi43Yy0wLjUsMC0xLjQsMC0yLDAgICBjLTUuMiwwLTksMi42LTksNmMwLDMuNCw0LjksNiwxMCw2YzUuOSwwLDEwLTMsMTAtN0MzMCwzMC4zLDI3LjUsMjguNywyNSwyN3ogTTIxLDIzYy0yLjQsMC01LjYtMi45LTYtNmMtMC40LTMuMSwxLjYtNi4xLDQtNiAgIHM0LjYsMi45LDUsNi4xQzI0LjQsMjAuMiwyMywyMywyMSwyM3ogTTIwLDM4Yy0zLjYsMC03LTEuMy03LTRjMC0yLjcsMy40LTUsNy01YzAuOCwwLDIsMCwyLDBjMSwwLDIuOSwwLjksNCwyYzEsMSwxLDIuNywxLDMgICBDMjcsMzcsMjUsMzgsMjAsMzh6IiBmaWxsPSIjRkZGRkZGIiBpZD0iZ18xXyIvPjwvZz48L3N2Zz4="></a>
  <div class="gpluscount"><?php   echo $matchgplusone;  ?> </div>
  <div class="gplusinfo">Кол-во подписчиков</div>
  <div class="gpluscountplus"><?php   echo $matchgplusbtn;  ?> </div>
  <div class="gplusinfoplus">Кол-во +1 share</div>

  <div class="helpbtn">
    <a target="_blank" href="https://business.google.com/u/4/b/<?php echo $gplussocialname;?>/insights/visibility/" class="btn btn-small">Статистика</a>
</div>
</div>


<?php  endif; ?>

<?php  if (!empty($youtubesocialname)) : ?>

<div class="ytblock">
  <a target="_blank"  href="<?php echo $youtubesocialname;?>"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDUwIDUwIiBpZD0iTGF5ZXJfMSIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgNTAgNTAiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxwYXRoIGQ9Ik00NSwxSDVDMi44LDEsMSwyLjgsMSw1djQwYzAsMi4yLDEuOCw0LDQsNGg0MGMyLjIsMCw0LTEuOCw0LTRWNUM0OSwyLjgsNDcuMiwxLDQ1LDF6IiBmaWxsPSIjQ0YzNDI3Ii8+PGcgaWQ9Il94NUJfX19feDNFX19feDVEX18xXyI+PGc+PHBhdGggZD0iTTM5LjcsMTljMCwwLTAuMy0yLjEtMS4yLTNjLTEuMS0xLjItMi40LTEuMi0zLTEuM0MzMS4zLDE0LjUsMjUsMTQuNSwyNSwxNC41cy02LjMsMC0xMC41LDAuMyAgICBjLTAuNiwwLjEtMS45LDAuMS0zLDEuM2MtMC45LDAuOS0xLjIsMy0xLjIsM3MtMC4zLDItMC4zLDQuNHYzYzAsMi40LDAuMyw0LjUsMC4zLDQuNXMwLjMsMi4xLDEuMiwzYzEuMSwxLjIsMi42LDEuMiwzLjMsMS4zICAgIGMyLjQsMC4yLDEwLjIsMC4yLDEwLjIsMC4yczYuMywwLjEsMTAuNS0wLjJjMC42LTAuMSwxLjktMC4xLDMtMS4zYzAuOS0wLjksMS4yLTMsMS4yLTNzMC4zLTIuMSwwLjMtNC41di0zICAgIEM0MCwyMS4xLDM5LjcsMTksMzkuNywxOXogTTIxLDI5di04bDgsNEwyMSwyOXoiIGZpbGw9IiNGRkZGRkYiLz48L2c+PC9nPjwvc3ZnPg=="></a>
  <div class="ytcount"><?php echo $matchyt;  ?> </div>
  <div class="ytinfo">Кол-во подписчиков</div>
  <div class="helpbtn">
    <a target="_blank" href="https://www.youtube.com/analytics?o=U" class="btn btn-small">Статистика</a>
</div>
</div>

<?php  endif; ?>

<?php  if (!empty($twittersocialname)) : ?>

<div class="twitterblock">
  <a target="_blank"  href="https://twitter.com/<?php echo $twittersocialname;?>"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDUwIDUwIiBpZD0iTGF5ZXJfMSIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgNTAgNTAiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxwYXRoIGQ9Ik00NSwxSDVDMi44LDEsMSwyLjgsMSw1djQwYzAsMi4yLDEuOCw0LDQsNGg0MGMyLjIsMCw0LTEuOCw0LTRWNUM0OSwyLjgsNDcuMiwxLDQ1LDF6IiBmaWxsPSIjMkNBN0UwIi8+PHBhdGggZD0iTTQwLDE2LjJjLTEuMSwwLjUtMi44LDEuMS00LDEuM2MxLjMtMC44LDIuNS0yLjYsMy00Yy0xLDAuNi0yLjEsMS40LTMuMiwxLjhMMzUsMTQuNSAgYy0xLjEtMS4yLTIuMi0yLTQtMmMtMy40LDAtNiwyLjYtNiw2YzAsMC40LDAsMC43LDAuMSwxbC0wLjEsMGMtNiwwLTEwLTEuMy0xMy01Yy0wLjUsMC45LTEsMS45LTEsM2MwLDIuMSwxLjMsMy45LDMsNSAgYy0xLDAtMi4yLTAuNS0zLTFjMCwzLDQuMiw2LjQsNyw3Yy0xLDEtNC42LDAuMS01LDBjMC44LDIuNCwzLjMsMy45LDYsNGMtMi4xLDEuNi00LjYsMi41LTcuNSwyLjVjLTAuNSwwLTEsMC0xLjUtMC4xICBjMi43LDEuNyw2LjUsMi42LDEwLDIuNmMxMS4zLDAsMTctOC45LDE3LTE3YzAtMC4zLDAtMC43LDAtMUMzOC4yLDE4LjYsMzkuMiwxNy40LDQwLDE2LjJ6IiBmaWxsPSIjRkZGRkZGIiBpZD0iQnJpZF8xXyIvPjwvc3ZnPg=="></a>
  <div class="twittercount"><?php echo "<div class='twitdiv'><div class='divtwitext'>Твиты</div> {$matchtwit}</div> <div class='twitdiv'><div class='divtwitext'>Читаемые</div> {$matchtwitreadusers}</div> <div class='twitdiv'><div class='divtwitext'>Читатели</div> {$matchtwitusers}</div> <div class='twitdiv'> <div class='divtwitext'>Нравится</div> {$matchtwitlike}</div>" ;  ?></div>
  <div class="helpbtn">
      <a target="_blank" href="https://analytics.twitter.com/user/<?php echo $twittersocialname;?>/home" class="btn btn-small">Статистика</a>
</div>
</div>

<?php  endif; ?>

<hr>

<div class="prcy">
<a target="_blank" href="https://a.pr-cy.ru/<?php echo $_SERVER['SERVER_NAME'] ?>"><img src="<?php echo JUri::root().'administrator/components/com_myjbzoostat/assets/img/'?>logo-prcy.svg"></a>
</div>

<div class="sbup">
  <a target="_blank" href="http://www.sbup.com/odd/<?php echo $_SERVER['SERVER_NAME'] ?>"><img src="<?php echo JUri::root().'administrator/components/com_myjbzoostat/assets/img/'?>sbup.png"></a>
</div>


<div class="seolink">
  <a target="_blank"  href="https://seolik.ru/a/<?php echo $_SERVER['SERVER_NAME'] ?>"><img src="<?php echo JUri::root().'administrator/components/com_myjbzoostat/assets/img/'?>seolik.png"> <span class="textseolik">SeoLik</span></a>
</div>


</div>
