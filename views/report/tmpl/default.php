<?php
defined( '_JEXEC' ) or die;

if (JFolder::exists(JPATH_ROOT . '/components/com_zoo')) {
$checkJBZooSEF = JBModelConfig::model()->getGroup('config.sef');
$JBZooSEFenabled = $checkJBZooSEF->get('enabled');
$JBZooSEFfix_item = $checkJBZooSEF->get('fix_item');
$JBZooSEFitem_alias_id = $checkJBZooSEF->get('item_alias_id');
$JBZooSEFfix_category_id = $checkJBZooSEF->get('fix_category_id');
$JBZooSEFfix_category = $checkJBZooSEF->get('fix_category');
$JBZooSEFcategory_alias_id = $checkJBZooSEF->get('category_alias_id');
$JBZooSEFfix_feed = $checkJBZooSEF->get('fix_feed');
$JBZooSEFredirect = $checkJBZooSEF->get('redirect');
$JBZooSEFfix_canonical = $checkJBZooSEF->get('fix_canonical');
$JBZooSEFparse_priority = $checkJBZooSEF->get('parse_priority');
$JBZooSEFcanonical_redirect = $checkJBZooSEF->get('canonical_redirect');
$JBZooSEFzoo_route_caching = $checkJBZooSEF->get('zoo_route_caching');
}

JHtml::_('jquery.framework');


jimport('joomla.html.html.bootstrap');
require_once JPATH_ADMINISTRATOR . '/components/com_myjbzoostat/elements/paramsetc.php';

if ($csshack == 'yes') {
echo "<style>div#system-message-container {display:none;}</style>";
}
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
  jQuery('#mask-date-calendarstart').datepicker({
      language: 'ru',
      autoClose: true,
      keyboardNav: true
  });
  jQuery('#mask-date-calendarend').datepicker({
      language: 'ru',
      autoClose: true,
      keyboardNav: true
  });
});
</script>

<?php
// dump($_POST,0,'POST');

$url = 'https://api.github.com/repos/cb9toiiia/myjbzoostat/releases/latest';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2" );
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
$gitjversion = curl_exec($ch);
curl_close($ch);

 if (empty($gitjversion)) { $gitjversion = file_get_contents($url); }

 $content = json_decode($gitjversion, true);
 $latestjoomla = $content['tag_name'];
 $datejoomla = $content['published_at'];
 $daterelease = date('d.m.Y', strtotime($datejoomla));
 if (empty($latestjoomla)) {
   $latestjoomla = "Временно невозможно получить версию";
 }

echo "<div class='vergit'>Версия  - <a href='https://github.com/CB9TOIIIA/MyJBZooStat/releases' target='_blank'><b>{$latestjoomla}</b></a> ({$daterelease})</div>";


    if (!empty($counter_id)) :


$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/metrika.css');

$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/datepick.css');

$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/metrika.js');

$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/jquery.dataTables.min.css');

$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/jquery.dataTables.min.js');

$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/datepicker.min.js');

?>



<?php


if(!empty($counter_id) && !empty($app_token))

{



    $date = new JDate();

    $date2 = $date->format('Ymd');



    if($date_diapazon == 'week')

    {

        $date->modify('-7 day');

    }

    else

    {

        $date->modify('-'.$date_diapazon.' month');

    }

    $date1 = $date->format('Ymd');


    $yamonth = $input->get('yamonth', NULL, 'string');
    $yayear = $input->get('yayear', NULL, 'string');
    $NeedGeo = $input->get('NeedGeo', NULL, 'string');
    $NeedPop = $input->get('NeedPop', NULL, 'string');
    $NeedCountry = $input->get('NeedCountry', NULL, 'string');
    $nowYearglobal = date('Y');
    $nowMonthglobal = date('m');
    $minYearleft = $nowYearglobal - 2;
    $calendstart = $input->get('calendstart', NULL, 'string');
    $calendend = $input->get('calendend', NULL, 'string');
    $needcalend = $input->get('needcalend', NULL, 'string');

    echo '<div style="margin-left: auto; width: 600px; margin-right: auto;" class="monthdate">';
    echo '<form action="/administrator/index.php?option=com_myjbzoostat&view=report" method="post" class="form-inline">';
    echo "<div style='position: relative;display: inline;margin: 0px; left: 0px;' class='calendfix'>";
    echo '<input id="mask-date-calendarstart" type="text" name="calendstart" >';
    echo '<input id="mask-date-calendarend" type="text" name="calendend" >';
    echo '</div>';
    echo '<input type="submit"  class="btn" value="Поиск"></form>';
    echo '</div>';

  if (!empty($yayear) && !empty($yamonth) && empty($calendstart) && empty($calendend)) {

    $date1 = $yayear . $yamonth . '01';
    $nextmonth = $yamonth + 1;
    $dayendmonth =  date('d', mktime(0,0,0,$nextmonth,0,2016));
    $date2 = $yayear . $yamonth . $dayendmonth;
    $ModDate1 = $date1;
    $ModDate2 = $date2;

    // dump($yamonth,0,'$yamonth');

  }

  if (!empty($calendstart) && !empty($calendend)) {
    $date1 = date('Ymd',strtotime($calendstart));
    $date2 = date('Ymd',strtotime($calendend));
    $ModDate1 = $date1;
    $ModDate2 = $date2;
    // dump($yamonth,0,'$yamonth');

  }

    $datePeriodData = 'https://api-metrika.yandex.ru/stat/v1/data?id='.$counter_id;
    $datePeriodData .= '&oauth_token='.$app_token;
    $datePeriodData .= '&preset=traffic&dimensions=ym:s:datePeriod<group>&group=day&sort=ym:s:datePeriod<group>&metrics=ym:s:visits,ym:s:users,ym:s:pageviews';
    $datePeriodData .= '&date1='.$date1;
    $datePeriodData .= '&date2='.$date2;
    $SocialNetworkData .= '&group='.$date_group;
    $SocialNetworkData .= '&per_page=500';
    $ResponceurldatePeriodData = MetrikaHelper::open_http($datePeriodData, $method);

    $dataPeriod = json_decode($ResponceurldatePeriodData);
    $dataPeriodData = $dataPeriod->data;

    $SocialNetworkData = 'https://api-metrika.yandex.ru/stat/v1/data?id='.$counter_id;
    $SocialNetworkData .= '&oauth_token='.$app_token;
    $SocialNetworkData .= '&dimensions=ym:s:<attribution>SocialNetwork&metrics=ym:s:users,ym:s:pageviews&date1='.$date1;
    $SocialNetworkData .= '&date2='.$date2;
    $SocialNetworkData .= '&group='.$date_group;
    $SocialNetworkData .= '&per_page=500';
    $ResponceSocialNetworkData = MetrikaHelper::open_http($SocialNetworkData, $method);
    $DataResponceSocialNetworkData = json_decode($ResponceSocialNetworkData);

    $socnetworks = $DataResponceSocialNetworkData->data;

    $PopularData = 'https://api-metrika.yandex.ru/stat/v1/data?id='.$counter_id;
    $PopularData .= '&oauth_token='.$app_token;
    $PopularData .= '&dimensions=ym:pv:URL,ym:pv:title&metrics=ym:pv:pageviews&sort=-ym:pv:pageviews';
    $PopularData .= '&date1='.$date1;
    $PopularData .= '&date2='.$date2;
    $PopularData .= '&per_page=500';
    $ResponcePopularData = MetrikaHelper::open_http($PopularData, $method);
    $DataResponcePopularData = json_decode($ResponcePopularData);
    $PopularData = $DataResponcePopularData->data;



// HACK: fix minus 1 day

$ModDate1 = new DateTime($date1);
$ModDate1->modify('-1 day');
$ModDate1 = $ModDate1->format('Ymd');

$ModDate2 = new DateTime($date2);
$ModDate2->modify('-1 day');
$ModDate2 = $ModDate2->format('Ymd');

    if (!empty($yayear) && !empty($yamonth) && empty($calendstart) && empty($calendend)) {

      $date1 = $yayear . $yamonth . '01';
      $nextmonth = $yamonth + 1;
      $dayendmonth =  date('d', mktime(0,0,0,$nextmonth,0,2016));
      $date2 = $yayear . $yamonth . $dayendmonth;
      $ModDate1 = $date1;
      $ModDate2 = $date2;

    }

    if (!empty($calendstart) && !empty($calendend)) {
      $date1 = date('Ymd',strtotime($calendstart));
      $date2 = date('Ymd',strtotime($calendend));
      $ModDate1 = $date1;
      $ModDate2 = $date2;

    }



    $urlexfree = 'https://api-metrika.yandex.ru/stat/v1/data?id='.$counter_id;
    $urlexfree .= '&oauth_token='.$app_token;
    $urlexfree .= '&preset=traffic&dimensions=ym:s:<attribution>TrafficSource&group=day&sort=ym:s:<attribution>TrafficSource&metrics=ym:s:visits,ym:s:users,ym:s:pageviews';
    $urlexfree .= '&date1='.$date1;
    $urlexfree .= '&date2='.$date2;
    $urlexfree .= '&per_page=500';
    $Responceurlexfree = MetrikaHelper::open_http($urlexfree, $method);
    $DataResponceurlexfree = json_decode($Responceurlexfree);
    $dataurlfree = $DataResponceurlexfree->data;





if (NULL !== $data->errors) {
  $DataErrors = $data->errors;

  foreach ($DataErrors as $DataError) {
    $DataCode = $DataError->code;
    $DataText = $DataError->text;
  }

  if ($DataCode == 'ERR_NO_DATA' || $DataCode == 'ERR_TEMPORARY_UNAVAILABLE') {
    echo "<h2 align='center'>Нет данных за выбранный период</h2>";
    echo "<style>.row-fluid .span12 .item-page {display:none;}</style>";
  }
}


}

function mrdate($param, $time=0) {
	if(intval($time)==0)$time=time();
	$MonthNames=array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
	if(strpos($param,'M')===false) return date($param, $time);
		else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
}

 ?>



 <div class="item-page">

<?php


if ($data->errors->code == 'ERR_PARAM_REQUIRED') {
echo "<h1>Неверно указан диапазон</h1>";
}


if ($bd_nice == 'yes') {

  function bd_nice_number($n) {



      $n = (0+str_replace(",","",$n));



      if(!is_numeric($n)) return false;



      if($n>1000000) return round(($n/1000000),3).' тыс';

      else if($n>1000) return round(($n/1000),0).'+ тыc.';


      return number_format($n);

  }

}

else {

  function bd_nice_number($n) {

      $n = number_format( $n ,  0  , ',' , ' '  );

      return $n;

  }

}

function nice_num($n) {

    $n = number_format( $n ,  0  , ',' , ' '  );

    return $n;

}

if ($dataurlfree) {



  $datebegin = $DataResponceurlexfree->query->date1;

  $datebegin = date("d.m.Y", strtotime($datebegin));

  $datebeginMonth = mrdate("M", strtotime($datebegin));

  $datebeginMonthY = date("Y", strtotime($datebegin));

  $dateend = $DataResponceurlexfree->query->date2;

  $dateend = date("d.m.Y", strtotime($dateend));

  $dateendMonth = mrdate("M", strtotime($dateend));

  $dateendMonthY = date("Y", strtotime($dateend));

  //total

  $globalpageviews = $DataResponceurlexfree->totals[2];

  $globalvisits = $DataResponceurlexfree->totals[0];

  $globalvisitors = $DataResponceurlexfree->totals[1];

  $nowYearstat = date("Y");


}

?>

<table width='600px' style='border: 1px dashed #ccc; margin-left: auto; margin-right: auto;'>
  <tr>
    <td>

<?php


echo "<div class='shortheadinfo'><p align='right'><i>{$site_shortname}</i><p></div>";

if ($datebeginMonth == $dateendMonth && $datebeginMonthY == $dateendMonthY) {
  echo "<div class='shortheadinfo'><p align='right'><i>{$dateendMonth} {$dateendMonthY} г.</i><p></div>";
}
else {
 echo "<div class='shortheadinfo'><p align='right'><i>{$datebeginMonth} {$datebeginMonthY} &mdash; {$dateendMonth} {$dateendMonthY} гг.</i><p></div>";
}

echo "<br>";

echo "<p><b>1. Основные показатели за месяц (с {$datebegin} по {$dateend})</b></p>";


$daytosql = date('Ymd');


$globalgv = bd_nice_number($globalpageviews);

$globalvis = bd_nice_number($globalvisits);

$globalvisitor = bd_nice_number($globalvisitors);

if (preg_match('/тыс/',$globalgv,$matchs) || preg_match('/тыс/',$globalvis,$matchs) || preg_match('/тыс/',$globalvisitor,$matchs) ) {

  $globalgv = str_replace('.',' млн. ',$globalgv);

  $globalgv = $globalgv.'.';

  $globalvis = str_replace('.',' млн. ',$globalvis);

  $globalvis = $globalvis.'.';

  $globalvisitor = str_replace('.',' млн. ',$globalvisitor);

  $globalvisitor = $globalvisitor.'.';

  $globalvisitor = str_replace('тыc млн. .','тыc.', $globalvisitor);


}

    $site_domain = trim($site_domain);
    $site_domain = str_replace('https','',$site_domain);
    $site_domain = str_replace('http','',$site_domain);
    $site_domain = str_replace('//','',$site_domain);
    $site_domain = str_replace('/','',$site_domain);
    $site_domain = str_replace(':','',$site_domain);

//    $urlYanTic = 'http://bar-navig.yandex.ru/u?ver=2&url=http://';
    $urlYanTic = 'https://yandex.ru/yaca/yca/cy/'.$site_domain;

    $GetYandexTic = MetrikaHelper::open_http($urlYanTic, $method);

preg_match("/tic-rules.xml.+ресурса —(.+?)<\/div>/", $GetYandexTic, $DataYanTicMatch);

$DataYanTic = trim($DataYanTicMatch[1]);

echo "<ul style='list-style-type:none'>";
echo "<li>Посетители: <b>{$globalvisitor}</b></li>";
echo "<li>Просмотры: <b>{$globalgv}</b></li>";
echo "<li>Общее количество репостов в соцсетях: <b><a href='#getsocialshare'>неизвестно</a></b></li>";
echo "<li>(Фейсбук – XXXXXXX, ВКонтакте – XXXXXXX, Одноклассники XXXXXXX)</li>";
echo "<li>Рейтинг цитируемости (ТИЦ): <b>{$DataYanTic}</b></li>";
echo "</ul>";

echo "<p><b>2. Самые популярные материалы</b></p>";

echo "<p align='center'><b>ТОП – {$site_pagevievfilter} просмотры</b></p>";

?>


<div class='clrboth'></div>


<?php

echo "<a name='getsocialshare'></a>";
echo "<table style='width: 600px; border: 1px solid #000'>";

echo "<thead>";

echo "<tr style='border: 1px solid #000'>";

echo "<td style='border: 1px solid #000; width: 30px; text-align:center;'> </td>";

echo "<td style='border: 1px solid #000;text-align:center;'><b>Адрес страницы</b></td>";
echo "<td style='border: 1px solid #000;text-align:center; width: 100px;'><b>Просмотры</b></td>";
echo "</tr>";

echo "</thead>";

echo "<tbody>";

 $countadd = '0';

 if ($PopularData) {

   $datapop = $DataResponcePopularData->data;

   for ($i=0; $i < count($datapop); $i++) { 
     
     $poppage_views  = $PopularData[$i]->metrics[0];

     $popurl      = $PopularData[$i]->dimensions[0]->name;

     $ItemName  = $PopularData[$i]->dimensions[1]->name;


     if (preg_match($filterpopular, $popurl)) :

       $countadd++;

         echo "<tr style='border: 1px solid #000;text-align:center;'>";
         echo "<td style='border: 1px solid #000;text-align:center;'>{$countadd}</td>";
         echo "<td style='border: 1px solid #000;text-align:left; padding: 0px 5px;'><a target='_blank' href='{$popurl}'>{$ItemName}</a><br><small>$popurl</small></td>";
         echo "<td style='border: 1px solid #000;text-align:center;'>{$poppage_views}</td>";
         echo "</tr>";
  
     endif;
   }

 }

    echo "</tbody>";

    echo "</table>";

endif;

      if (empty($counter_id)) :
      echo "<h1 class='center'>Заполните API Яндекс.Метрика настройках компонента</h1>";
      endif;

echo "<br>";
echo "<p align='center'><b>ТОП – {$site_pagevievfilter} репосты</b></p>";

echo "<p>Используйте эти URL в скрипте: <a href='https://github.com/CB9TOIIIA/GetSocialShare' target='_blank'>GetSocialShare</a></p>";

$date1URLS = date('Y-m-d',strtotime($calendstart));
$date2URLS = date('Y-m-d',strtotime($calendend));

  $querysmonth = $db->getQuery(true);
  $querysmonth
  ->select($db->quoteName('id'))
  ->from($db->quoteName(ZOO_TABLE_ITEM))
  ->where($db->quoteName('publish_up') . ' BETWEEN "' .$date1URLS.' 00:00:00' . '" AND "' .$date2URLS.' 23:59:59"');

  $db->setQuery($querysmonth);
  $itemIdsResultsdatemonth = $db->loadObjectList();

foreach ($itemIdsResultsdatemonth as $itid) {
  $item = $app->table->item->get($itid->id);
  $itemUrl[] = "'".$app->jbrouter->externalItem($item)."'";
}

// echo implode('<br>',$itemUrl);
// echo "<hr>";
// echo "<br>";

echo "<textarea style='width: 600px; height: 50px;'>".implode(',',$itemUrl)."</textarea>";

echo "<br>";

echo "<p><b>3. Список журналистов и их материалы</b></p>";


    if (!empty($TypeAuthors)) {

      $querys = $db->getQuery(true);
      $querys
      ->select($db->quoteName('created_by'))
      ->from($db->quoteName(ZOO_TABLE_ITEM))
      ->where($db->quoteName('type') . ' = ' . $db->quote($TypeAuthors));
    }

    else {
      $querys = $db->getQuery(true);
      $querys
      ->select($db->quoteName('created_by'))
      ->from($db->quoteName(ZOO_TABLE_ITEM));
    }

    $db->setQuery($querys);


    $itemIdsResultsdate = array_unique($app->table->tag->database->queryResultArray($querys));
    $itemIds = array();
    foreach ($itemIdsResultsdate as $it) {
      $itemIds[] = $it;
    }



    echo "<table style='width: 600px; border: 1px solid #000'>";

    echo "<thead>";

    echo "<tr style='border: 1px solid #000'>";

    echo "<td style='border: 1px solid #000; width: 30px; text-align:center;'>№</td>";

    echo "<td style='border: 1px solid #000;text-align:center;'><b>Автор</b></td>";
    echo "<td style='border: 1px solid #000;text-align:center; width: 100px;'><b>Количество материалов</b></td>";
    echo "</tr>";

    echo "</thead>";

    echo "<tbody>";

    $in = 0;
    foreach ($itemIds as $key => $valueid) {


      $querysmonth = $db->getQuery(true);
      $querysmonth
      ->select('COUNT(id)')
      ->from($db->quoteName(ZOO_TABLE_ITEM))
      ->where($db->quoteName('created_by') . ' = "'.$valueid.'" AND publish_up BETWEEN "' .$date1URLS.' 00:00:00' . '" AND "' .$date2URLS.' 23:59:59"');

      $db->setQuery($querysmonth);
      $itemIdsResultsdatemonth = $db->loadObjectList();

      foreach ($itemIdsResultsdatemonth as $keynum) {

        foreach ($keynum as $keynumart) {

          $allarticles += $keynumart;
          $user = JFactory::getUser($valueid);
          $username = $user->name;

          if ($username) {
            if ($keynumart != '0') {
              $in++;
              echo "<tr style='border: 1px solid #000'>";
              echo "<td style='border: 1px solid #000; width: 30px; text-align:center;'>{$in}</td>";
              echo "<td style='border: 1px solid #000;text-align:left;padding: 0px 5px;'>{$username}</td>";
              echo "<td style='border: 1px solid #000;text-align:center; width: 100px;'>{$keynumart}</td>";
              echo "</tr>";

            }
          }
        }
      }

    }
    echo "</tbody>";
    echo "</table>";
echo "<br>";
$allarticles = bd_nice_number($allarticles);
echo "<p align='left'><b>Итого:</b> {$allarticles} публикаций.</p>";

echo "<br>";

echo "<p><b>4. Социальные сети</b></p>";

    echo "<table style='width: 600px; border: 1px solid #000'>";

    echo "<thead>";
    echo "<tr>";
    echo "<td style='border: 1px solid #000;text-align:center;'><b>Социальная сеть</b></td>";
    echo "<td style='border: 1px solid #000;text-align:center; width: 100px;'><b>Пользователи</b></td>";
    echo "<td style='border: 1px solid #000;text-align:center; width: 100px;'><b>Просмотры</b></td>";
    echo "</tr>";

    echo "</thead>";

    echo "<tbody>";

    foreach ($socnetworks as $socnet => $socialwww ) {

        $NameSocial = $socialwww->dimensions;

        foreach ($NameSocial as $NameSocialWork) {
          $NameSocialWork = $NameSocialWork->name;  //name id favicon
        }

        $UsersSocial = $socialwww->metrics;

        $UserS = $UsersSocial[0];
        $PageviewS = $UsersSocial[1];

        $AllUserSocial += $UserS;
        $AllPageviewSocial += $PageviewS;

    echo "<tr>";
    echo "<td style='border: 1px solid #000;text-align:left;padding: 0px 5px;'>{$NameSocialWork}</td>";
    echo "<td style='border: 1px solid #000;text-align:center; width: 100px;'>{$UserS}</td>";
    echo "<td style='border: 1px solid #000;text-align:center; width: 100px;'>{$PageviewS}</td>";
    echo "</tr>";

    }

    echo "</tbody>";
    echo "</table>";

    echo "<br>";

$AllUserSocial = bd_nice_number($AllUserSocial);
$AllPageviewSocial = bd_nice_number($AllPageviewSocial);

    echo "<p align='left'><b>Итого:</b> {$AllUserSocial} пользователей и {$AllPageviewSocial} просмотров.</p>";

    echo "<br>";

 ?>





   </td>
 </tr>

</table>
</div>
