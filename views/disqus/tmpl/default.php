<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);
/** @var $this MyjbzoostatViewAutors */
defined( '_JEXEC' ) or die; // No direct access
require_once JPATH_ADMINISTRATOR . '/components/com_myjbzoostat/elements/paramsetc.php';
require_once JPATH_ADMINISTRATOR . '/components/com_myjbzoostat/vendor/autoload.php'; // composer autoload.php
// require_once '/../../../vendor/autoload.php'; // composer autoload.php

use JBZoo\HttpClient\HttpClient;
use JBZoo\HttpClient\Response;


$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/sort.css');
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/disqus.css');
$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/disqus.js');


echo "<script src='//yastatic.net/es5-shims/0.0.2/es5-shims.min.js'></script> <script type='text/javascript' src='//yastatic.net/share2/share.js'></script>";
echo "<script id='dsq-count-scr' src='//{$disqusApiShort}.disqus.com/count.js' async></script>";

    $httpClient = new HttpClient([
        'driver'  => 'auto',
        'timeout' => 10,        // Wait in seconds
        'verify'  => false,     // Check cert for SSL
    ]);

function disqusRequest($url, $params = [], $ttl = DISQUS_TTL, $debugurl = 0)
{
    if ($url == URL_LIST_USAGE) {
      $params['application'] = DISQUS_API_APP;
      $params['api_key'] = DISQUS_API_KEY;
      $params['access_token'] = DISQUS_ACCESS_TOKEN;
    }

    if ($url == URL_FORUMS_LISTTHREADS || $url == URL_POSTS_LIST) {
      $params['forum'] = DISQUS_API_SHORT_NAME;
      $params['api_key'] = DISQUS_API_KEY;
    }

    if ($url == URL_USERS_LISTPOSTS) {
      $params['api_key'] = DISQUS_API_KEY;
    }

    // Уникальный ключ внутри кеша
    $cacheKey = md5(serialize($params) . '||' . $url);

    // Готовим кешы
    $cache = JFactory::getCache('disqus_api', 'output');
    $cache->setCaching(true);
    $cache->setLifeTime($ttl); // convert to seconds

    $httpClient = new HttpClient([
        'driver'  => 'auto',
        'timeout' => 10,        // Wait in seconds
        'verify'  => false,     // Check cert for SSL
    ]);

    if ($debugurl === 1) {

      if (!empty($params)) {
        $url = $url .'?'.http_build_query($params);
      }
      // dump($url,0,'$url');
      $response = $httpClient->request($url);
    }
    else {
          $response = $cache->get($cacheKey);
    }
    if (!$response)
         $response = $httpClient->request($url, $params, 'get');

      if ($response->code === 200) {
        $cache->store($response, $cacheKey);
      }

    return $response->getJSON();
}


?>
<div class="item-page">


<?php

$responseApiCountDisqus = disqusRequest(URL_LIST_USAGE, [
    'days' => '0'
], 3, 0);

$resusageapp = $responseApiCountDisqus['response'][0];
$dateusageapp = date('d.m.Y',strtotime($resusageapp[0]));
$valuusageapp = $resusageapp[1];


echo "<div class='righappuse'><a style='color:#000' href='https://disqus.com/api/applications/{$disqusApplication}/usage/' target='_blank'>API: {$valuusageapp}</a></div>";



echo "<h3>Получить информацию о комментариях в Disqus: </h3>";
echo '<div class="monthdate">';
echo '<form action="/administrator/index.php?option='.$namecomponent.'&view=disqus" method="post" class="form-inline">';

$urllistPosts = $input->get('urllistPosts', null, 'string');
$userdisqusform = $input->get('userdisqusform', null, 'string');
$idcheckbl = $input->get('idcheckbl', null, 'string');

echo '<input type="hidden"  name="urllistPosts" placeholder="Введите url" value="">';
echo '<input type="text" name="userdisqusform" placeholder="Введите url / username / id" value="">';

echo '<input type="submit" value="Отправить"></form>';
echo '</div>';

if (preg_match('/http:/', $userdisqusform)) {
  $urllistPosts = $userdisqusform;
  $userdisqusform = '';
}

?>


<?php

if (!empty($urllistPosts)) {
// $datalistThreads = [
//   'forum' => $disqusApiShort,
//   'thread' => 'link:'.$urllistPosts,
//   'api_key' => $disqusApiPublic
//  ];
// $url = 'https://disqus.com/api/3.0/forums/listThreads.json?'. http_build_query($datalistThreads,null,'&');
//
//   $responce = MyjbzoostatHelper::open_http($url, $method);
//   $listThreads = json_decode($responce, true);

  $listThreads = disqusRequest(URL_FORUMS_LISTTHREADS, [
      'thread' => 'link:'.$urllistPosts,
  ], 3, 0);


  if ($listThreads['code'] == 13) {
    echo "<p class='bg-danger' align='center'><small>Превышен лимит Disqus, необходимо немного подождать.</small></p>";
  }
  else {
$listThreadsres = $listThreads['response'][0];
$disqusfeed = $listThreadsres['feed'];
$disqusidthread = $listThreadsres['id'];
$disquscreated = $listThreadsres['createdAt'];
$disquslinkd = $listThreadsres['link'];
$disqusslug = $listThreadsres['slug'];
$disquscleantitle = $listThreadsres['clean_title'];
$disqusposts = $listThreadsres['posts'];
$disqusApiShort = $listThreadsres['forum'];
$disqushighlightedPost  = $listThreadsres['highlightedPost'];
$linktodisqussitethread = 'https://'.$disqusApiShort.'.disqus.com/admin/moderate/#/all/search/thread:'.$disqusidthread.'';
$linktodisqussiteslug = 'https://disqus.com/home/discussion/'.$disqusApiShort.'/'.$disqusslug.'/';
//    dump($listThreadsres,0,'$listThreadsres');
$disquscreated = date('d.m.Y H:i:s', strtotime("+3 hours", strtotime($disquscreated)));
$disqushighlightedPost = (!empty($disqushighlightedPost)) ? 'Да' : 'Нет' ;

echo '<h2>Информация статьи в Disqus: </h2>';
echo "<div id='infoarticle' class='scrollbar-inner-left'>";
echo "<blockquote class='threadclass'>";
     echo "<ul>";
     echo "<li><b>Title:</b> <a href='{$disquslinkd}'  target='_blank'>{$disquscleantitle}</a></li>";
     echo "<li><b>Число комментариев:</b> <span class='chislocom'>{$disqusposts}</span></li>";
     echo "<li><b>Дата создания:</b> {$disquscreated}</li>";
     echo "<li><b>ID темы:</b> {$disqusidthread}</li>";
    //  echo "<li><b>URL статьи:</b> <a href='{$disquslinkd}' class='btn btn-small' target='_blank'>Перейти в статью</a></li>";
    //  echo "<li><b>Алиас темы Disqus:</b> {$disqusslug}</li>";
     echo "<li><b>Выделенный комментарий:</b> {$disqushighlightedPost}</li>";
     echo "<li><b>Комментарии: </b>  <a href='{$disqusfeed}' class='btn btn-small threepx' target='_blank'>RSS</a> <a href='{$linktodisqussiteslug}' class='btn btn-small threepx' target='_blank'>на сайте Disqus</a> <a href='{$linktodisqussitethread}' class='btn btn-small threepx' target='_blank'>в админке Disqus</a></li>";
     if ($disqusposts > '100') {
             echo "<br>";
            echo "<li><span style='color:red;text-align:center;font-weight:bold;'>Превышен лимит по API. Максимум 100 сообщений.</span></li>";
     }
echo "</ul>";
echo "</blockquote>";
echo "</div>";

$disqusapproved = 'include[]=approved';
$disqusunapproved = 'include[]=unapproved';
$disqusspam = 'include[]=spam';
$disqusdeleted = 'include[]=deleted';
$disqusflagged = 'include[]=flagged';
$disqushighlighted = 'include[]=highlighted';


$mylistdisalldata = $disqusapproved.'&'.$disqusunapproved.'&'.$disqusspam.'&'.$disqusdeleted.'&'.$disqusflagged.'&'.$disqushighlighted;

$datalistPosts = [
  'forum' => $disqusApiShort,
  'thread' => 'link:'.$urllistPosts,
  'api_key' => $disqusApiPublic,
  // 'order'   => 'asc',
  'order'   => 'desc',
  'limit'   => '100',
 ];

// $url = 'https://disqus.com/api/3.0/threads/listPosts.json?'. http_build_query($datalistPosts,null,'&').'&'.$mylistdisalldata;
$url = 'https://disqus.com/api/3.0/posts/list.json?'. http_build_query($datalistPosts,null,'&').'&'.$mylistdisalldata;

  echo "<div class='scrollbar-inner'>";

if (!empty($urllistPosts)) {
  $httpClientj = JHttpFactory::getHttp();
  $responce = $httpClientj->get($url, null , null);
  $responce = $responce->body;
  $listPosts = json_decode($responce, true);

  if ($listPosts['code'] == 13) {
    echo "<p class='bg-danger' align='center'><small>Превышен лимит Disqus, необходимо немного подождать.</small></p>";
  }
  else {
    $listPostsres = $listPosts['response'];
    // asort($listPostsres);
    // dump($listPostsres,0,'$listPostsres');
   $numlistPostsrespost = '0';
    foreach ($listPostsres as $listPostsrespost) {
//dump($listPostsrespost,0,'$listPostsrespost');

$lpdisqusthumbimg = $listPostsrespost['media'];

if (!empty($lpdisqusthumbimg)) {
  foreach ($lpdisqusthumbimg as $lpdisqusthumbimgs) {
    // dump($lpdisqusthumbimgs,0,'$lpdisqusthumbimgs');
    $lpdisqusthumbnailURLimg = $lpdisqusthumbimgs['thumbnailURL'];
    $lpdisqusthumbnailURLimgUrl = $lpdisqusthumbimgs['url'];
  }
}

$lpdisqusraw_message = $listPostsrespost['raw_message'];
$lpdisqusidcomment = $listPostsrespost['id'];
$lpdisquscreated = $listPostsrespost['createdAt'];
$lpdisqusthread = $listPostsrespost['thread'];
$lpdisqusforum = $listPostsrespost['forum'];
$lpdisqusparent  = $listPostsrespost['parent'];
$lpdisqusisApproved   = $listPostsrespost['isApproved'];
$lpdisqusisDeleted  = $listPostsrespost['isDeleted'];
$lpdisqusisHighlighted  = $listPostsrespost['isHighlighted'];
$lpdisqusispoints  = $listPostsrespost['points'];
$lpdisqusnumReports   = $listPostsrespost['numReports'];
$lpdisqusdislikes    = $listPostsrespost['dislikes'];
$lpdisquslikes     = $listPostsrespost['likes'];
$lpdisqusname = $listPostsrespost['author']['name'];
$lpdisqusisAnonymous = $listPostsrespost['author']['isAnonymous'];
// dump($listPostsrespost['author'],0,listPostsrespost);
if ($lpdisqusisAnonymous === FALSE) {
  $lpdisqususername = $listPostsrespost['author']['username'];
  $lpdisqususernameava = $listPostsrespost['author']['avatar']['permalink'];
  $lpdisqusabout = $listPostsrespost['author']['about'];
  $lpdisqusrep = $listPostsrespost['author']['rep'];
  $lpdisqusrep = round($lpdisqusrep,2);
  $lpdisqusisPrivate = $listPostsrespost['author']['isPrivate'];
  $lpdisqusjoinedAt = $listPostsrespost['author']['joinedAt'];
  $lpdisqusid = $listPostsrespost['author']['id'];
  $lpdisqusisAnonymous = 'Нет';
}
else {
  $lpdisqusisAnonymous = '/ <b><u>АНОНИМ</u></b>';
  $lpdisqususernameava = '//a.disquscdn.com/1470166271/images/noavatar92.png';
  $lpdisqusisPrivate = '';
}
$lpdisqusprofileUrl = $listPostsrespost['author']['profileUrl'];
$lpdisqusurl = $listPostsrespost['author']['url'];
$lpdisqussignedUrl = $listPostsrespost['author']['signedUrl'];
$lpdisqusavatar = $listPostsrespost['author']['avatar']['permalink'];
// $lplinktodisqussitethread = 'https://'.$disqusApiShort.'.disqus.com/admin/moderate/#/all/search/thread:'.$lpdisqusthread.'';
$lplinktodisqussiteidcomment = 'https://'.$disqusApiShort.'.disqus.com/admin/moderate/#/all/search/id:'.$lpdisqusidcomment.'';

$approveAr = [
   'post ' => $lpdisqusidcomment,
   'access' => $disqusApiSecret
  ];

$approve = 'https://disqus.com/api/3.0/posts/approve.json?'. http_build_query($approveAr,null,'&');

$spamAr = [
   'post ' => $lpdisqusidcomment,
   'access' => $disqusApiSecret
  ];

$spam = 'https://disqus.com/api/3.0/posts/spam.json?'. http_build_query($spamAr,null,'&');

$removeAr = [
   'post ' => $lpdisqusidcomment,
   'access' => $disqusApiSecret
  ];

$remove = 'https://disqus.com/api/3.0/posts/remove.json?'. http_build_query($removeAr,null,'&');
// $remove = str_replace('+','',$remove);

$reportAr = [
   'post ' => $lpdisqusidcomment,
   'access' => $disqusApiSecret
  ];

$report = 'https://disqus.com/api/3.0/posts/report.json?'. http_build_query($reportAr,null,'&');


$lpdisquscreated = date('d.m.Y H:i:s', strtotime("+3 hours", strtotime($lpdisquscreated)));
$numlistPostsrespost++;


if (!empty($lpdisqusraw_message)) {

  if ($lpdisqusisDeleted === true) {    $lpdisqusisDeleted = 'deletemessage';  }
  if ($lpdisqusisApproved === false) {    $lpdisqusisApproved = 'spammessage';  }

  echo "<blockquote class='postaclass'>";
  echo "<div class='avamesinfo'><a title='Перейти в профиль Disqus' href='{$lpdisqusprofileUrl}' target='_blank'><img src='{$lpdisqususernameava}'></a></div>";
  echo "<ul>";
  echo "<li class='numbercoma'>#{$numlistPostsrespost}</li>";
  echo "<li><b>Дата:</b> {$lpdisquscreated}</li>";
  if ($lpdisqusprofileUrl && $lpdisqususername && $lpdisqusisAnonymous == 'Нет') {
    echo "<li><b>Имя/Псевдоним:</b>    <form  class='flform' action='/administrator/index.php?option={$namecomponent}&view=disqus' name='form{$lpdisqusid}' method='post' >
      <input  style='display:none'   type='hidden' name='userdisqusform'  value='{$lpdisqusid}' />
      <input class='btn btn-small' type='submit' value='{$lpdisqusname} /  {$lpdisqususername}' > </form> <a title='Перейти в профиль Disqus' href='{$lpdisqusprofileUrl}' target='_blank'><em class='icon-out-2'></em> </a> ";     if ($lpdisqusabout) {   echo "<span class='osebe'><b>О себе:</b> {$lpdisqusabout}</span></li>";   }
  }
  else {
    echo "<li><b>Имя/Псевдоним:</b> {$lpdisqusname} ";  if ($lpdisqusisAnonymous != 'Нет') {  echo "{$lpdisqusisAnonymous}"; }
  }
  echo "<li class='messageauthor {$lpdisqusisDeleted} {$lpdisqusisApproved}'><b>Сообщение:</b> <a class='nameames' href='{$lplinktodisqussiteidcomment}' target='_blank'>{$lpdisqusraw_message}</a>";
if (!empty($lpdisqusthumbimg && $lpdisqusthumbnailURLimgUrl) ) {
  echo "<br><br><a href='{$lpdisqusthumbnailURLimgUrl}' target='_blank'><img style='height:150px !important;' src='{$lpdisqusthumbnailURLimg}'></a>  <a href='{$disquslinkd}#comment-{$lpdisqusidcomment}' target='_blank'><em class='icon-out-2'></em></a></li>";
  }
  else {echo " <a href='{$disquslinkd}#comment-{$lpdisqusidcomment}' target='_blank'><em class='icon-out-2'></em></a> </li>";}
  if ($lpdisqusprofileUrl) {
    if ($lpdisqusrep > '0') {      echo "<li class='inforepsmile'> <img title='Репутация' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAe1JREFUOI2VU79rFFEQ/mb2CEljQAk27s6+3Zc0ksJCK+0shCuMYiAcKUQQEvwjBMFWBa0E0UpS2J2pgn+BNjaCZuPLRZugKdKYnHc7YyFvuZyFyXTz/XjzzcAjjJVzbg6qbQKVpJgCAGMcsPKmGa1vfd+qRvU02vjMLRvpnNbcTSaT7aqqfgCA936mPqxzYrtuZJ9Cr/d6fDDcOXevkOLmP8RY+czdKlJZGQeXj2Nu9M4tOpFOs3Mp8uC45lhFlj/0aVoyVNtaczcSs1lWlJLvOZE7EXMiq07yn0VRZBFjsq5S0mYClclksh0JZZ4HcJqNrjRipcsMnLHhcD5iNXMgspJJMRWvDQC/+v0Ngz2rGU+avKSPFPZUid5FKISwC7NplGn+4qT7xyqz7BUb48B7P3NSs3PuLIj2mZU368M6j0SR5fe9yIVxg/f+VCFyI/Yts5yNqpYZrRPrbQDvAYAnWo+1P1zN03wWCT4PBoO9yWTimg4Glwh4GR9QxUICfU4A4EQ6ifHvaie8aSJm7iqTXoQCCv4QvoWNJqXIEgB87fXWmohFKiveucX/7V6ILJVZdjf2Rz6TE+mQ0Xkm69bMIYSwGw/WMstVsWBkH0cnH3kAAHyalkpJm8hKmE3/VdE+G1UEfftlZyeM6v8AePS5OjufevcAAAAASUVORK5CYII='> {$lpdisqusrep}";   }
    else {
      echo "<li> <img title='Репутация' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAiRJREFUOI2dk99LU3EYxj/Hc5Znm8fh8rSc5jZrXmhza04ziUZnKXZj0E0RlGClN1142z/QPyCs4YViYGQEXhRkhVOkiJR+WRJJjjky1KT8kVPXyi5qsoRi7IEHvrzf53le3pfvV2AHXIZC72XV0e7Pt2ilOqMNIJaIR0dW5sLdi1Oh1/HlV+l6Ie1suF5xuLOluKx1Z2g6uj9+6LrybrwDWE8PMAxpgQf16p6j/zOn8PjzwmhDeKgJWBcBQv6aUHN5ySlBhkxoMxttFr1ceD/26Z7gLTJ5n55vep5J552o7Rk8JLXWHmjHlI0dLh7Z3yYFXBZNULayCtBcFk0qtettggizK0mK86WMjCmtXTY4JPIAEUhu0ftmCZc1F1WR2K2IGHQ5AMQTP1n89oPF1SQTs5s0VBghD/gOUmx1LeosVpwlRonTZoXGazOccOVhVyUuHS8A4Nb4MpH5BOHJNR5etaHoc4AtorG1iFjpzK/0HTT7BB3IBgGzItFcp6B5jAg6EHTgdco4S3bh2KvDUy5v12+PxvoFt9PkedHX+DKbJbrPPHKL818254osuVZfVUG1IEGKnQNfGXu/vs26Kpn0++Cd6WDv3WhP6inrh2/4B/016rFMOg+PLYwEWkZPAhvin1qyd2Cm32rNVX1uc7Ugwr8YvDkdPNvx7AKwAX//xt9zVZg8befK2gL1qmbfZ3QARGbikfCT+aFQX7Tr7dTSRLr+F13cpAatFiB7AAAAAElFTkSuQmCC'> <b>{$lpdisqusrep}</b>";
    }


  }

  if ($lpdisqusispoints != '0') {         echo " <img title='Баллов' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAPRJREFUOI3F0D0vRGEQxfGfl4hCISFia4XQK3QotHoRspoN4iWipdlEJD6ARHwJ8WEIeoVkGyR2i13FnU2ux712o3GSp7j/mTN35vDfGkq+x7CMebziM/gEVjGDF7SKhq2hgU68N6xjEx853ojeb5pDE9eYwiTO409NnGI8ajex2Wx+wCXuMZAM3sF2wgbxhAsYDlgJ2EmarwpObeMR03lYw3sKS1SRZVLNw1E8487PM1Ld4gEjaWFRFlr9F/OZLMCFsoaqLIf9gtqu7P6NHhs6icbDHNsLdtTL3NVxGOrx2jjo19zVliyTlj7WLtMKlv5q7ktfG+g0Z4EGC00AAAAASUVORK5CYII='> {$lpdisqusispoints}"; }
  if ($lpdisqusnumReports != '0') {      echo " <img title='Жалоб' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAplJREFUOI2FU0lPU1EYPd/to2WwtMVahhgBYyJRuzCNMQImRKM7h2CMsiESCRpjMFGGxhCabmQyEuNOXchGCf/AaMSFJiyICagMisogfW3fawsiCLTvfi5MG4YIZ3Vzz/nOPd+93yVsgK7r2avMVQSchKSiaE3dQdisMaUg722Gw9W8p+XO7Fo9JRfMTCEtepXZ6IIQdkgMAhiPNjeVIhpzGZMzWZyVyZaysmf7s8y15PdLrC1Ww3qXqumsalpfMBjcuzHZj67uipHqmplht4dHr98cYObU4QiGI7WqpnMgrLesIzaAmWn8VsPrYbeHvzbefQoApOt6dtyQUxD0Ks/pvERE/D8DAGCfT4xMTE8nvn8rsJ+/uFusMldJwEaG4d2uGADI75eWQweqaXGJliOBdlI1rQ+SivNznUcAYNDjsZlXcHnVgl7zCl0wTPE3SkIcTSjy5eGhobmk0eczlYtks0cUSCoCMJ4kzCvcCJDDskw6IHNIKq1S8IoilUIAnakodkcYc7FdAmueEgCYSDBBlTCOSSITgRngF8ycPuT2VCV1JgYYDAWCJwEqSRFG2n3DtHrWnFh6GE/LPEfS9HzBqugZf+LLxCLVQiKq5ZqcOzUENK1O1XQOhUL7trvAJL60t58adnt4tNHbI8xEvZAyJok6tpqBVIs+nzCGxnpgtXKGzeUVTqfzF0g0gESlqkVatxwkn0+MReb7458+5qcfL39c1HJb/UcwUyCsd6iazhOdDz5MtHWd2BT7Xufp0aorgWG3h8du1L9P7q/7TD/fDdRHm73dtPCbTEWFS7A7wgDAES1XzsxmsHUHW8pLn5R0tl3bZJDEVMejguVIoN0IhCp4PpYDAMJhj5hc+f1pLru3uKkpuFb/F+0OPtEyTX4+AAAAAElFTkSuQmCC'> {$lpdisqusnumReports}"; }
  if ($lpdisquslikes != '0') {  echo " <img title='Лайков' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAcJJREFUOI2VkT2LE1EUht9zJkMczPrViRaCX1sl3DkhxCDEUmxsjGhjI4uW29oFxE5Wf4AWVqIotopaLEJwo3cCKYJarIuNpUQJZGZy77FJKhNJ3vKe+z48nENYEBFZ996/YWZV1WtJknyc948XAVT1KjM/897fJqIX5XJ5/0oAACcBfO31eq8B9MIwvLQ0oNForBHRRQBvpzbfABxfClCv16M0TZ+o6itr7Y/p80FVHc0DkDHmPoBNZg5U9TsRsapuj8fjjcFgkAGAMeYLgFMAMgA5gBGAXSK6Q8aYSRRFhzudzp84jrcAPF+0cQDUbDaDPM+jLMvOO+ceQ0R0NhWR9oLiP6lWq2dF5Fdh2cIscRwfJaJbzrlzRPT+f2ecmyRJflpr2wAeENGhlQ1E5DqAdQBXVPXhygbW2qelUumu935fEASdlQEAMBwOzzDzkTRN93iqdVNEXgJAq9UKFhUrlcoxEWkT0TtVvdfv90dkjJkUi0WT57kBYFT1MhFtE9EH59znMAz3ut3u7xmkVqsdmEwmnwDcSJJkp8DMW2maJsxc8N7vAtggotPe+wsANvM8PyEiazOAcy4lokfW2h0A+AsWq7wO7k2tEQAAAABJRU5ErkJggg==' />  {$lpdisquslikes}";   }
  if ($lpdisqusdislikes != '0') {      echo " <img title='Дизлайков' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACQUlEQVR42pWSzUtUYRSHn3eu44zXydLRiURmoIUYiAtpE2VNk24iF0YtolUQWBEGEdQ/EBXlNqFdm4ggFBNqkbQIRYjJxGo0F46OSmnOTDrfH/ftvTOpjRXkgcvlnHvOc8753SOkVuUnn2sFCRZtQBixLumovYPbc4u91Sqs4hsmRPFdpkFwETHzUQjp65B0d0HeAP809D58zY2edk40QzZX4GLW5fOQUI/FdBTgwWOYCOhCeo9Les4UE0Y/w+Ao3L8EqfRWd7MmoWB9z6HcWoRkDDLvJ28L2eaVXD0NOQUYm4IXIwrQrQrSpaObY+s2VWwpAk1m5zVE7ohXalc61QSq21gAXvnh3kU1QXYLYHb8ECI58IbsXJDfTaSO+aTtstIgOAMrBgu9j2i4cBjCkc1OBdPtUFcHu51Fv9ZFun8csVrvljWHXEqwDMnAKpHQOvWnGpVvlK6wHCO+GCW8mNgMWx2Ol+JbjVO6vO6C2smpMNH5NfZ1eCCdLwXs0f+YIHS9DzEtKoNSSs+G2KbunhYX9npHUZeND5oST/u100qc+NcY38OZki03bRz7XGNTrVt3VRSI6XCS2UCUtLElrEC80xCDfwWY5scuW1vUyLqVZbVWaCm2/yCp2e15/wSMYGuptlknDjTVEVmJ8Wnpx5M2Muf/G2DaMBZ5tMFFmV7O8JeFeDuGY0eAIcRdn9N5s6LSztD8wro6t6odAfph8uSu6ub1bJ63qbWn6tzO7QjwDHzqPwxnwFBn5TirTmV7zk9shddKmKNbNAAAAABJRU5ErkJggg=='> {$lpdisqusdislikes}";   }
  echo "</li>";
  //      echo "<li><b>Перейти в Disqus:</b> <a href='{$lplinktodisqussiteidcomment}' class='btn btn-small threepx' target='_blank'>Комментарий</a> ";
  // if ($lpdisqusprofileUrl) {   echo "<a href='{$lpdisqusprofileUrl}' class='btn btn-small threepx' target='_blank'>Профиль</a></li>"; }
  if ($lpdisqusisPrivate === true) {
    echo "<li class='hideinfouser'><u>Пользователь скрыл личную информацию</u></li>";
  }
  if ($lpdisqusisDeleted !== false) {
    echo "<li class='hideinfouser'><u>Это сообщение удалено!</u></li>";
  }
  if ($lpdisqusisApproved !== true) {
    echo "<li class='hideinfouser'><u>Это сообщение попало в СПАМ!</u></li>";
  }
  echo "</ul>";
  echo "<script>";
  echo "jQuery(document).ready(function($) {";
  echo "$('#report-{$lpdisqusidcomment}').click(function(){
    $.ajax({
        type: 'POST',
        url: '{$report}'
     });
   });
  });";
  echo "</script>";
  // echo "<p class='mlplus'><a id='delete-$lpdisqusidcomment' href='#'>[Удалить]</a> <a id='spam-$lpdisqusidcomment' target='_blank' href='{$spam}'>[Спам]</a> <a id='report-$lpdisqusidcomment' href='#'>[Предупреждение]</a> <a id='approve-$lpdisqusidcomment' target='_blank' href='{$approve}'>[Опубликовать]</a> </p>";
  echo "</blockquote>";
//need share2
}
// dump($listPostsrespost,0,'$listPostsrespost');
    }

 // dump($listPosts,0,'$listPosts');


  }
}
if ($numlistPostsrespost == '100') {
  echo "<h2 style='color:red;text-align:center;font-weight:bold;'>Лимит по API 100 сообщений</h2>";
}
  echo "</div>";
  }
}
// else {
//     echo "<p class='bg-danger' align='center'><small>Введите ссылку сайта, чтобы узнать детальную информацию Disqus.</small></p>";
// }


//Returns details of a user.
if (!empty($userdisqusform)) {
  if(!preg_match("|^[\d]+$|", $userdisqusform) === TRUE) {

  $datausers = [
    //'user' => 'username:disqus_Gnis53AxKh',
    'user' => 'username:'.$userdisqusform.'',
    'api_key' => $disqusApiPublic
   ];
}
   else {
    $datausers = [
       //'user' => 'username:disqus_Gnis53AxKh',
       'user' => $userdisqusform,
       'api_key' => $disqusApiPublic
      ];
   }

  $url = 'https://disqus.com/api/3.0/users/details.json?'. http_build_query($datausers,null,'&');
}



if (!empty($userdisqusform)) {

  $users = disqusRequest($url, [ ], 1, 0);
// dump($users,0,'$users');

  if ($users['code'] == 13) {
    echo "<p class='bg-danger' align='center'><small>Превышен лимит Disqus, необходимо немного подождать.</small></p>";
  }
  else {
    $usersres = $users['response'];

    $userdisqusnumFollowers = $usersres['numFollowers'];
    $userdisqusidthread = $usersres['id'];
    $userdisqusrep = round($usersres['rep'],2);
    $userdisqusnumPosts = $usersres['numPosts'];
    $userdisqusjoinedAt = $usersres['joinedAt'];
    $userdisqusisPrivate = $usersres['isPrivate'];
// dump($userdisqusisPrivate,0,'$userdisqusisPrivate');
    $userdisqusjoinedAttine = date('d.m.Y H:i:s',strtotime($userdisqusjoinedAt));
    $userdisqususername = $usersres['username'];
    $userdisqusnumLikesReceived = $usersres['numLikesReceived'];
    $userdisqusabout = $usersres['about'];
    $userdisqusname = $usersres['name'];
    $userdisqusurl = $usersres['url'];
    $userdisqusid= $usersres['id'];
    $userdisqusnumForumsFollowing = $usersres['numForumsFollowing'];
    $userdisqusprofileUrl = $usersres['profileUrl'];
    $userdisqusisAnonymous = $usersres['isAnonymous'];
    $userdisqusavatar  = $usersres['avatar']['permalink'];
    $userlinktodisqussitethread = 'https://'.$disqusApiShort.'.disqus.com/admin/moderate/#/all/search/user:'.$userdisqususername.'';
echo "<div id='infoarticle' class='scrollbar-inner-left'>";
    echo "<blockquote class='postaclass'>";
         echo "<ul>";
         echo "<div class='circleimg'><img src='{$userdisqusavatar}'></div>";
         echo "<li><b>Никнейм:</b> {$userdisqususername}</li>";
         echo "<li><b>Имя:</b> {$userdisqusname}</li>";
         echo "<li><b>ID:</b> {$userdisqusid}</li>";
         echo "<li><b>Дата:</b> {$userdisqusjoinedAttine}</li>";
         echo "<li><b>Кол-во комментариев:</b> {$userdisqusnumPosts}</li>";
         echo "<li><b>Репутация:</b> {$userdisqusrep}</li>";
         echo "<li><b>Лайков:</b> {$userdisqusnumLikesReceived}</li>";
         echo "<li><b>Все сообщения:</b> <a class='btn btn-small' target='_blank' href='{$userlinktodisqussitethread}'>Перейти на Disqus</a></li>";
         if ($userdisqusisPrivate === true) {
               echo "<li class='hideinfouser'><u>Пользователь скрыл личную информацию</u></li>";
         }

         echo "</ul>";
    echo "</blockquote>";

    if (!empty($userdisqusform)) {
      $databl = [
        'query' => $userdisqusform,
        'forum' => $disqusApiShort,
        'api_key' => $disqusApiPublic,
        'access_token' => $disqusApiToken
       ];
      $url = 'https://disqus.com/api/3.0/blacklists/list.json?type=user&type=email&type=ip&type=domain&'. http_build_query($databl,null,'&');

      $httpClientj = JHttpFactory::getHttp();
      // dump($httpClientj,0,'$httpClientj');
      $responce = $httpClientj->get($url, null , null);
      $responce = $responce->body;
      $blacklist = json_decode($responce, true);

      if ($blacklist['code'] == 13) {
        echo "<p class='bg-danger' align='center'><small>Превышен лимит Disqus, необходимо немного подождать.</small></p>";
      }
      else {
        $checkbl = $blacklist['response'];
        // if (empty($checkbl)) {
        //     echo "<p class='bg-success' align='center'><small>Пользователь не  забанен.</small></p>";
        // }
        if (!empty($checkbl)) {
            $checkbluser = $blacklist['response'][0]['id'];
            $checkblusernotes = $blacklist['response'][0]['notes'];
            echo "<p class='bg-danger'><b>Внимание: <a href='https://{$disqusApiShort}.disqus.com/admin/moderate/#/all/search/user:{$userdisqusform}' target='_blank'> Пользователь  забанен</a>  ";
            if (!empty($checkblusernotes)) {
              echo "/ Причина: {$checkblusernotes}</b></p>";
            }
            else {
              echo "</b></p>";
            }
        }

    //    dump($blacklist,0,'$blacklist');
      }

    }

echo "</div>";


  }
}

if (empty($urllistPosts) && !empty($userdisqusid)) {
  $userdisqusform = $userdisqusid;

  $datauserslistPosts = [
    //'user' => 'username:disqus_Gnis53AxKh',
    'user' => $userdisqusform,
    'limit' => '100',
    'api_key' => $disqusApiPublic
  ];
// dump($datauserslistPosts,0,'$datauserslistPosts');
  $urluserslistPosts = 'https://disqus.com/api/3.0/users/listPosts.json?'. http_build_query($datauserslistPosts,null,'&');
echo "<div class='scrollbar-inner'>";


//   $responcelistuserposts = MyjbzoostatHelper::open_http($urluserslistPosts, $method);
//   $responcelistuserpostsresult = json_decode($responcelistuserposts, true);
// // dump($responcelistuserpostsresult,0,'$responcelistuserpostsresult');

$httpClientj = JHttpFactory::getHttp();
// dump($httpClientj,0,'$httpClientj');
$responce = $httpClientj->get($urluserslistPosts, null , null);
$responce = $responce->body;
$responcelistuserpostsresult = json_decode($responce, true);


if ($responcelistuserpostsresult['code'] != 12) {


  $responcelistuserpostsresult = $responcelistuserpostsresult['response'];
  foreach ($responcelistuserpostsresult as $responcelistuserpostsresultone ) {


    $responcedispostforum = $responcelistuserpostsresultone['forum'];
    $responcedispostsusername = $responcelistuserpostsresultone['author']['username'];
    $responcedispostsuserrep = round($responcelistuserpostsresultone['author']['rep'],2);
    $responcedispostsuseridauthor = $responcelistuserpostsresultone['author']['id'];
    $responcedispostsuseravatar = $responcelistuserpostsresultone['author']['avatar']['permalink'];
    $responcedispostscreatedAt = $responcelistuserpostsresultone['createdAt'];
    $responcedispoststtine = date('d.m.Y H:i:s',strtotime($responcedispostscreatedAt));
    $responcedispostsidcomment = $responcelistuserpostsresultone['id'];
    $responcedispoststhread = $responcelistuserpostsresultone['thread'];
    $responcedispostsraw_message = $responcelistuserpostsresultone['raw_message'];
    $responcedispostsnumReports = $responcelistuserpostsresultone['numReports'];
    $responcedispostspoints = $responcelistuserpostsresultone['points'];
    $responcedispostslikes = $responcelistuserpostsresultone['likes'];
    $responcedispostsdislikes = $responcelistuserpostsresultone['dislikes'];
    $responcedispostsisFlagged = $responcelistuserpostsresultone['isFlagged'];
    $responcedispostsisSpam = $responcelistuserpostsresultone['isSpam'];
    $responcedispostsisDeleted = $responcelistuserpostsresultone['isDeleted'];
    $responcedispostsisDeletedByAuthor = $responcelistuserpostsresultone['isDeletedByAuthor'];
    $responcedispostsisApproved = $responcelistuserpostsresultone['isApproved'];

    $mysearchtext = mb_substr($responcedispostsraw_message,0,50);

    // $resultsjbzoo = $httpClientjbzoo->request('https://disqus.com/api/3.0/threads/details.json?',[
    //         'forum' => $disqusApiShort,
    //         'thread' => $responcedispoststhread,
    //         'api_key' => $disqusApiPublic
    //     ], 'get'  );

  // dump($resultsjbzoo->body,0,'$resultsjbzoo');

  // $threadtitle = [
  //   'forum' => $disqusApiShort,
  //   'thread' => $responcedispoststhread,
  //   'api_key' => $disqusApiPublic
  //  ];
  //
  // $urlthreadtitle = 'https://disqus.com/api/3.0/threads/details.json?'. http_build_query($threadtitle,null,'&');
  //
  // if (!empty($responcedispoststhread)) {
  //   $responcethreadtitle = MyjbzoostatHelper::open_http($urlthreadtitle, $method);
  //   $listPoststhreadtitle = json_decode($responcethreadtitle, true);
  //   if ($listPoststhreadtitle['code'] == 13) {
  //     echo "<p class='bg-danger' align='center'><small>Превышен лимит Disqus, необходимо немного подождать.</small></p>";
  //   }
  //   else {
  //     $listPoststhreadtitleamytitle = $listPoststhreadtitle['response']['clean_title'];
  //     $listPoststhreadtitleamycomments = $listPoststhreadtitle['response']['posts'];
  //     $listPoststhreadtitleamylink = $listPoststhreadtitle['response']['link'];
  //   }
  // }
    echo "<blockquote class='postaclass'>";
    echo "<ul>";
    // echo "<li><b>Никнейм:</b> {$responcedispostsusername}</li>";
    // echo "<li><b>ID:</b> {$responcedispostsidcomment}</li>";
    echo "<li><b>Дата:</b> {$responcedispoststtine}</li>";
    if ($responcedispostforum != $disqusApiShort) {
        echo "<li class='clrred'><b>На сайте:</b> {$responcedispostforum}</li>";
    }
    // echo "<li><b>ID автора:</b> {$responcedispostsuseridauthor}</li>";
    // echo "<li><b>Репутация:</b> {$responcedispostsuserrep}</li>";
    // echo "<li><b>Аватар:</b> {$responcedispostsuseravatar}</li>";
    // echo "<li><b>Тема:</b> {$listPoststhreadtitleamytitle}</li>";
    // echo "<li><b>Комментариев:</b> {$listPoststhreadtitleamycomments}</li>";
    // echo "<li><b>Ссылка:</b> {$listPoststhreadtitleamylink}</li>";
    echo "<li class='messageauthorafds'><b>Сообщение:</b> {$responcedispostsraw_message} <a href='https://{$disqusApiShort}.disqus.com/admin/moderate/#/all/search/{$mysearchtext}' target='_blank'><em class='icon-out-2'></em></a></li>";
    echo "<li>";
if ($responcedispostsnumReports > 0) {
    echo " <img title='Жалоб' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAplJREFUOI2FU0lPU1EYPd/to2WwtMVahhgBYyJRuzCNMQImRKM7h2CMsiESCRpjMFGGxhCabmQyEuNOXchGCf/AaMSFJiyICagMisogfW3fawsiCLTvfi5MG4YIZ3Vzz/nOPd+93yVsgK7r2avMVQSchKSiaE3dQdisMaUg722Gw9W8p+XO7Fo9JRfMTCEtepXZ6IIQdkgMAhiPNjeVIhpzGZMzWZyVyZaysmf7s8y15PdLrC1Ww3qXqumsalpfMBjcuzHZj67uipHqmplht4dHr98cYObU4QiGI7WqpnMgrLesIzaAmWn8VsPrYbeHvzbefQoApOt6dtyQUxD0Ks/pvERE/D8DAGCfT4xMTE8nvn8rsJ+/uFusMldJwEaG4d2uGADI75eWQweqaXGJliOBdlI1rQ+SivNznUcAYNDjsZlXcHnVgl7zCl0wTPE3SkIcTSjy5eGhobmk0eczlYtks0cUSCoCMJ4kzCvcCJDDskw6IHNIKq1S8IoilUIAnakodkcYc7FdAmueEgCYSDBBlTCOSSITgRngF8ycPuT2VCV1JgYYDAWCJwEqSRFG2n3DtHrWnFh6GE/LPEfS9HzBqugZf+LLxCLVQiKq5ZqcOzUENK1O1XQOhUL7trvAJL60t58adnt4tNHbI8xEvZAyJok6tpqBVIs+nzCGxnpgtXKGzeUVTqfzF0g0gESlqkVatxwkn0+MReb7458+5qcfL39c1HJb/UcwUyCsd6iazhOdDz5MtHWd2BT7Xufp0aorgWG3h8du1L9P7q/7TD/fDdRHm73dtPCbTEWFS7A7wgDAES1XzsxmsHUHW8pLn5R0tl3bZJDEVMejguVIoN0IhCp4PpYDAMJhj5hc+f1pLru3uKkpuFb/F+0OPtEyTX4+AAAAAElFTkSuQmCC'> {$responcedispostsnumReports} ";
}
if ($responcedispostspoints > 0) {
    echo "<img title='Баллов' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAPRJREFUOI3F0D0vRGEQxfGfl4hCISFia4XQK3QotHoRspoN4iWipdlEJD6ARHwJ8WEIeoVkGyR2i13FnU2ux712o3GSp7j/mTN35vDfGkq+x7CMebziM/gEVjGDF7SKhq2hgU68N6xjEx853ojeb5pDE9eYwiTO409NnGI8ajex2Wx+wCXuMZAM3sF2wgbxhAsYDlgJ2EmarwpObeMR03lYw3sKS1SRZVLNw1E8487PM1Ld4gEjaWFRFlr9F/OZLMCFsoaqLIf9gtqu7P6NHhs6icbDHNsLdtTL3NVxGOrx2jjo19zVliyTlj7WLtMKlv5q7ktfG+g0Z4EGC00AAAAASUVORK5CYII='> {$responcedispostspoints} ";
}
if ($responcedispostslikes > 0) {
    echo " <img title='Лайков' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAcJJREFUOI2VkT2LE1EUht9zJkMczPrViRaCX1sl3DkhxCDEUmxsjGhjI4uW29oFxE5Wf4AWVqIotopaLEJwo3cCKYJarIuNpUQJZGZy77FJKhNJ3vKe+z48nENYEBFZ996/YWZV1WtJknyc948XAVT1KjM/897fJqIX5XJ5/0oAACcBfO31eq8B9MIwvLQ0oNForBHRRQBvpzbfABxfClCv16M0TZ+o6itr7Y/p80FVHc0DkDHmPoBNZg5U9TsRsapuj8fjjcFgkAGAMeYLgFMAMgA5gBGAXSK6Q8aYSRRFhzudzp84jrcAPF+0cQDUbDaDPM+jLMvOO+ceQ0R0NhWR9oLiP6lWq2dF5Fdh2cIscRwfJaJbzrlzRPT+f2ecmyRJflpr2wAeENGhlQ1E5DqAdQBXVPXhygbW2qelUumu935fEASdlQEAMBwOzzDzkTRN93iqdVNEXgJAq9UKFhUrlcoxEWkT0TtVvdfv90dkjJkUi0WT57kBYFT1MhFtE9EH59znMAz3ut3u7xmkVqsdmEwmnwDcSJJkp8DMW2maJsxc8N7vAtggotPe+wsANvM8PyEiazOAcy4lokfW2h0A+AsWq7wO7k2tEQAAAABJRU5ErkJggg==' /> {$responcedispostslikes} ";
}
if ($responcedispostsdislikes > 0) {

      echo " <img title='Дизлайков' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACQUlEQVR42pWSzUtUYRSHn3eu44zXydLRiURmoIUYiAtpE2VNk24iF0YtolUQWBEGEdQ/EBXlNqFdm4ggFBNqkbQIRYjJxGo0F46OSmnOTDrfH/ftvTOpjRXkgcvlnHvOc8753SOkVuUnn2sFCRZtQBixLumovYPbc4u91Sqs4hsmRPFdpkFwETHzUQjp65B0d0HeAP809D58zY2edk40QzZX4GLW5fOQUI/FdBTgwWOYCOhCeo9Les4UE0Y/w+Ao3L8EqfRWd7MmoWB9z6HcWoRkDDLvJ28L2eaVXD0NOQUYm4IXIwrQrQrSpaObY+s2VWwpAk1m5zVE7ohXalc61QSq21gAXvnh3kU1QXYLYHb8ECI58IbsXJDfTaSO+aTtstIgOAMrBgu9j2i4cBjCkc1OBdPtUFcHu51Fv9ZFun8csVrvljWHXEqwDMnAKpHQOvWnGpVvlK6wHCO+GCW8mNgMWx2Ol+JbjVO6vO6C2smpMNH5NfZ1eCCdLwXs0f+YIHS9DzEtKoNSSs+G2KbunhYX9npHUZeND5oST/u100qc+NcY38OZki03bRz7XGNTrVt3VRSI6XCS2UCUtLElrEC80xCDfwWY5scuW1vUyLqVZbVWaCm2/yCp2e15/wSMYGuptlknDjTVEVmJ8Wnpx5M2Muf/G2DaMBZ5tMFFmV7O8JeFeDuGY0eAIcRdn9N5s6LSztD8wro6t6odAfph8uSu6ub1bJ63qbWn6tzO7QjwDHzqPwxnwFBn5TirTmV7zk9shddKmKNbNAAAAABJRU5ErkJggg=='>  {$responcedispostsdislikes} ";
}
if ($responcedispostsisFlagged > 0) {

      echo " <img title='Штрафы (flag)' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACKElEQVR42mNkAILZS1d9Evj541xoUpzD//WTvH5+/GTH8PKVJcPHz0z/P3znYvzKfJFj4dKkrxOqFZhlpfgZ//5lZw/LOwXSywgizt579FztxWMJxsml79iUZIT+ff3K8P/ufYZ/Lz8xMLz7BlTBz/BNSfESK+8vPVZ5EQbm/0wMHP3rGOEGHLp197HV0cMyf+sTGf4FezMw8gsx/L9zG2wA08dfDH+efWd48/EDA688DwOnkQoDy38GBvbFRxAG7L1y47HluRMyDI0ZDEzBHkADBBn+Xb/J8O/FBwamT0ADXv1keP35KwOPFCcDt7kmAwsLMwP7jJ0IA3adv/rYAmgAa3sWA2Mg0AUC/Az/rgENeEmkARuPn3lsd+6UDGd/IQNDsC/QBUADrl4DGvARYsDz7wyvvwENkOZh4DZWYWAC6uKcdwBhwLI9Bx+7XDonwzejhuG/vysDIyfnk/93H5wAGrCO6f2Pn3+/s1W9evnKmEeWh4FLSwYYBv8YOJafQBgwf/ve5wEnDksILGxd8S3QbTJ3/9ZjDEjghamD0O8n13o5JLm2cqpLPmFh+M8HNGAX3IBpqzb8N/7x5bh5XIwVA4kAbMCkiVP/C6pqnon1cjIly4CWtq7/QkKCZ7IyUskzoK6h5T8vL++Z0uJ88gwoq6z9z83Jeaa+roo8AwoLS/8zs7Gd6elsJc+A9Mzc/4yMjGdmTJtEngGp6dlfQQbMmjHFnlQDANbE6xGJCe7DAAAAAElFTkSuQmCC'> {$responcedispostsisFlagged} ";
}
if ($responcedispostsisSpam > 0) {
    echo "<img title='Спам' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAldJREFUOI19k81LlFEUxn/nzIwzaoVG2X2dVbjIPsivMGknBq4iiiD7IoL+AZFoY1AiLQoqol0YJhFJO2tRi2onkmZqkUZpu5l51WqRZI7z3ttC32E06ezuOed5zr3Pea6wQaTT6QoRaQF2AjjnZoDXnufNru+VwoPv+8Zae8M5d1pVI4U1a22gqo+Ay8YY/x8C3/drnXMvgYqNblVAlFHVVmPMRJ7A933jnBvPg39+h4F+3PjIypSaA3C0Dcq2hiRpVa0zxviy+uY+ETkH4CY/IFfb0Vxu7eRYDK7dgV17w1SvMeaCpNPpCudcSlUjLC3B+SNoEBBtOEhueBCAaOMhciNDBNEo8vAZFMWx1uaAShWRllCwYOAJupzF1dRRfruHomMniZ04Q/mtHthXQySbxT5/CoCqRkWkORquCiB4P0QMYHSYdPclvM6bAKS6OoiNj4IIuZFBio6fDSFVulZhtyKaCMWlW/L50pLNICsLs84WQlzUOTcjq0VX0wBfptCGRsrar5Dq6kBU8TpvMv/tK278HdQ3FRJMrxHR/Vlkse0wxRphuXoPialJHLBUvZvY50/8DgJK+l8h8QTW2pxzzlPP82ZXHYYkiol232Uhu0h8ahJEEBHiU5P8yi4Su34PiSdCEfuSyeS8AGQymR3W2jFVNQDBjzkWHt/Hjr1daa5vYtOpi0TKt4VGSgG1lZWVc3krZzKZ/dbaF6rq8Z+w1qZEpNXzvI8A+S0YYyZUtQ7oXTXJemAOeADUhmBY9xvDSKVS20WkGagCHDBtrX2TTCbn1/f+Be3U9vkIGr2IAAAAAElFTkSuQmCC'> {$responcedispostsisSpam} ";
}

    if ($responcedispostsisDeleted === TRUE) { echo "Комментарий удален"; }
    if ($responcedispostsisDeletedByAuthor === TRUE) { echo "Автор комментария удален"; }
    if ($responcedispostsisApproved === FALSE) { echo "Комментарий не опубликован"; }
echo "</li>";
    //      if ($userdisqusprofileUrl) {
    // if ($lpdisqususername) {      echo "<li><b>Никнейм:</b> {$lpdisqususername}</li>";   }
    // if ($lpdisqusabout) {      echo "<li><b>Инфо:</b> {$lpdisqusabout}</li>";   }
    // if ($lpdisqusrep) {      echo "<li><b>Репутация:</b> {$lpdisqusrep}</li>";   }
    // if ($lpdisqusisPrivate) {      echo "<li><b>Приватность:</b> {$lpdisqusisPrivate}</li>";   }
    // if ($lpdisqusid) {      echo "<li><b>ID пользователя:</b> {$lpdisqusid}</li>";   }
    //    }
    echo "</ul>";
    echo "</blockquote>";

    // dump($responcelistuserpostsresult,0,'$responcelistuserpostsresult');
  }
  }
  echo "</div>";
}

 ?>

<?php
if (empty($urllistPosts) && empty($userdisqusform)) {

  echo "<table id='myTable' class='zebratable' role='grid'>";
  $today = date('Y-m-d');
  $db = JFactory::getDBO();
  $querys = $db->getQuery(true);
  $querys
  ->select($db->quoteName('id'))
  ->from($db->quoteName(ZOO_TABLE_ITEM))
  ->where($db->quoteName('publish_up') . ' BETWEEN "' .$today.' 00:00:01' . '" AND "' .$today.' 23:59:59"');
  // ->where($db->quoteName('publish_up') . ' = ' . $db->quote($today));
  $db->setQuery($querys);
  $itemIdsResultsdate = $db->loadObjectList();
  $Disid = array();
  $myhtml = array();
  if (!empty($itemIdsResultsdate)) {

    echo "<tr>";
    echo "<td><b>Дата</b></td>";
    echo "<td><b>Статья</b></td>";
    echo "<td><b>Автор</b></td>";
    echo "<td><b>Disqus</b></td>";
    echo "<td><b>Share</b></td>";
    echo "</tr>";
    foreach ($itemIdsResultsdate as $idarts) {
      foreach ($idarts as $idart) {
        $Disitem = $app->table->item->get($idart);
        $Dispublish_up = $Disitem->publish_up;
        $Dispublish_up1 = date('d.m.Y',strtotime($Dispublish_up));
        $Dispublish_up = date('d.m.Y H:i:s',strtotime($Dispublish_up));
        $Dispublish_up3 = date('H:i:s',strtotime($Dispublish_up));
        $Disid[] = $Disitem->id;
        $Disname = $Disitem->name;
        $Distype = $Disitem->type;
        $Discreated_by = $Disitem->created_by;
        $userauthor = JFactory::getUser($Discreated_by);
        $userauthor = $userauthor->name;
        $myurltosite = JRoute::_($app->jbrouter->externalItem($Disitem, false), false, 2);

        echo "</tr>";

        $myhtml[] = "<tr><td>{$Dispublish_up3}</td><td><form  class='flform' action='/administrator/index.php?option={$namecomponent}&view=disqus' name='form{$idart}' method='post' >
        <input type='hidden' name='userdisqusform' value='{$myurltosite}' />
        <input class='btn btn-small' type='submit' value='{$Disname}' > </form></td>
        <td>  <form action='/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile' name='a{$idart}' method='post' >
        <input  type='hidden' name='authorids'  value='{$Discreated_by}' />
        <input class='btn btn-small' type='submit' value='{$userauthor}' > </form></td>

        <td><span class='disqus-comment-count' data-disqus-url='{$myurltosite}'></span></td>

        <td><div class='ya-share2' data-services='vkontakte,facebook,odnoklassniki,moimir,gplus' data-url='{$myurltosite}'  data-size='m' data-counter=''></div></td></tr>";

      }
    } $datearraydatemonth = count($Disid);
    if (!empty($datearraydatemonth)) {
      echo "<h3>Статьи за сегодня: {$datearraydatemonth} шт.</h3>";
      foreach ($myhtml as $myhtmla) {
        echo $myhtmla;
      }
    }


  }

}
echo "</table>";




 ?>

</div>
