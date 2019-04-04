<?php
defined( '_JEXEC' ) or die;

/* add  Class 'JFolder */
JLoader::register('JFile', JPATH_LIBRARIES . '/joomla/filesystem/file.php');
JLoader::register('JFolder', JPATH_LIBRARIES . '/joomla/filesystem/folder.php');

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


echo '
<script type="text/javascript">
jQuery(document).ready(function($) {
$("#myTable33").DataTable({language:{url:"/administrator/components/com_myjbzoostat/assets/js/Russian.json"}});
});
</script>';

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

$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/metrika.css');
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/datepick.css');
$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/metrika.js');
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/jquery.dataTables.min.css');
$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/jquery.dataTables.min.js');
$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/datepicker.min.js');
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/sort.css');
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/social.css');
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/uikit.min.css');
$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/chart.js');


echo "<script src='//yastatic.net/es5-shims/0.0.2/es5-shims.min.js'></script> <script type='text/javascript' src='//yastatic.net/share2/share.js'></script>";
if (!empty($disqusApiShort)) {
echo "<script id='dsq-count-scr' src='//{$disqusApiShort}.disqus.com/count.js' async></script>";
}

echo '
<script type="text/javascript">
jQuery(document).ready(function($) {
$("#myTable").DataTable({language:{url:"/administrator/components/com_myjbzoostat/assets/js/Russian.json"}});
});
</script>';

echo '
<script type="text/javascript">
jQuery(document).ready(function($) {
$("#myTable2").DataTable({language:{url:"/administrator/components/com_myjbzoostat/assets/js/Russian.json"}});
});
</script>';

echo '
<script type="text/javascript">
jQuery(document).ready(function($) {
$("#myTable344").DataTable({language:{url:"/administrator/components/com_myjbzoostat/assets/js/Russian.json"}});
});
</script>';

echo '
<script type="text/javascript">
jQuery(document).ready(function($) {
$("#myTable3454").DataTable({language:{url:"/administrator/components/com_myjbzoostat/assets/js/Russian.json"}});
});
</script>';

//JUST DO IT   $this->app   ----> $app

?>



<?php
if (empty($threshold)) {
  $threshold = '2';
}


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
    $myurltosite = $input->get('myurltosite', NULL, 'string');
    $myurltosite = strip_tags(trim($myurltosite));

    echo '<div style="margin-left: auto; width: 600px; margin-right: auto;" class="monthdate">';
    echo '<form action="/administrator/index.php?option=com_myjbzoostat&view=index" method="post" class="form-inline">';
    echo "<div style='position: relative;display: inline;margin: 0px; left: 0px;' class='calendfix'>";
    echo '<input id="mask-date-calendarstart" type="text" name="calendstart" placeholder="Дата начала">';
    echo '<input id="mask-date-calendarend" type="text" name="calendend" placeholder="Конечная дата">';
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
}




    $ApiYandexURLV2 = 'https://api-metrika.yandex.ru/stat/v1/data?id='.$counter_id;
    $ApiYandexURLV2 .= '&oauth_token='.$app_token;
    $ApiYandexURLV2 .= '&preset=traffic&dimensions=ym:s:datePeriod<group>&group=day&sort=ym:s:datePeriod<group>&metrics=ym:s:visits,ym:s:users,ym:s:pageviews';
    $ApiYandexURLV2 .= '&date1='.$date1;
    $ApiYandexURLV2 .= '&date2='.$date2;
    $ApiYandexURLV2 .= '&limit=10000';
    $ResponceApiYandexURLV2 = MetrikaHelper::open_http($ApiYandexURLV2, $method);
    $DataResponceApiYandexURLV2 = json_decode($ResponceApiYandexURLV2);

//сводка трафика
    $ApiYandexTrafficSource = 'https://api-metrika.yandex.ru/stat/v1/data?id='.$counter_id;
    $ApiYandexTrafficSource .= '&oauth_token='.$app_token;
    $ApiYandexTrafficSource .= '&preset=traffic&dimensions=ym:s:<attribution>TrafficSource&group=day&sort=ym:s:<attribution>TrafficSource&metrics=ym:s:visits,ym:s:users,ym:s:pageviews';
    $ApiYandexTrafficSource .= '&date1='.$date1;
    $ApiYandexTrafficSource .= '&date2='.$date2;
    $ApiYandexTrafficSource .= '&limit=10000';
    $ResponceApiYandexTrafficSource = MetrikaHelper::open_http($ApiYandexTrafficSource, $method);
    $DataResponceApiYandexTrafficSource = json_decode($ResponceApiYandexTrafficSource);
// dump($ResponceApiYandexTrafficSource,0,'ResponceApiYandexTrafficSource');
// dump($DataResponceApiYandexTrafficSource,0,'DataResponceApiYandexTrafficSource');

$CountTrafficSourceData = count($DataResponceApiYandexTrafficSource->data);

//результаты поиска

    $ApiYandexSearchEngine = 'https://api-metrika.yandex.ru/stat/v1/data?id='.$counter_id;
    $ApiYandexSearchEngine .= '&oauth_token='.$app_token;
    $ApiYandexSearchEngine .= '&preset=traffic&dimensions=ym:s:<attribution>SearchEngine&group=day&sort=ym:s:<attribution>SearchEngine&metrics=ym:s:visits,ym:s:users,ym:s:pageviews';
    $ApiYandexSearchEngine .= '&date1='.$date1;
    $ApiYandexSearchEngine .= '&date2='.$date2;
    $ApiYandexSearchEngine .= '&limit=10000';
    $ResponceApiYandexSearchEngine = MetrikaHelper::open_http($ApiYandexSearchEngine, $method);
    $DataResponceApiYandexSearchEngine = json_decode($ResponceApiYandexSearchEngine);
// dump($ResponceApiYandexSearchEngine,0,'ResponceApiYandexSearchEngine');
// dump($DataResponceApiYandexSearchEngine,0,'DataResponceApiYandexSearchEngine');

$CountSearchEngine = count($DataResponceApiYandexSearchEngine->data);

//с социальных сетей

    $ApiYandexSocialNetwork = 'https://api-metrika.yandex.ru/stat/v1/data?id='.$counter_id;
    $ApiYandexSocialNetwork .= '&oauth_token='.$app_token;
    $ApiYandexSocialNetwork .= '&preset=traffic&dimensions=ym:s:<attribution>SocialNetwork&group=day&sort=ym:s:<attribution>SocialNetwork&metrics=ym:s:visits,ym:s:users,ym:s:pageviews';
    $ApiYandexSocialNetwork .= '&date1='.$date1;
    $ApiYandexSocialNetwork .= '&date2='.$date2;
    $ApiYandexSocialNetwork .= '&limit=10000';
    $ResponceApiYandexSocialNetwork = MetrikaHelper::open_http($ApiYandexSocialNetwork, $method);
    $DataResponceApiYandexSocialNetwork = json_decode($ResponceApiYandexSocialNetwork);
// dump($ResponceApiYandexSocialNetwork,0,'ResponceApiYandexSocialNetwork');
// dump($DataResponceApiYandexSocialNetwork,0,'DataResponceApiYandexSocialNetwork');

$CountSocialNetwork = count($DataResponceApiYandexSocialNetwork->data);

//переходы с сайтов
    $ApiYandexexternalReferer = 'https://api-metrika.yandex.ru/stat/v1/data?id='.$counter_id;
    $ApiYandexexternalReferer .= '&oauth_token='.$app_token;
    $ApiYandexexternalReferer .= '&preset=traffic&dimensions=ym:s:externalReferer&group=day&sort=ym:s:externalReferer&metrics=ym:s:visits,ym:s:users,ym:s:pageviews';
    $ApiYandexexternalReferer .= '&date1='.$date1;
    $ApiYandexexternalReferer .= '&date2='.$date2;
    $ApiYandexexternalReferer .= '&limit=10000';
    $ResponceApiYandexexternalReferer = MetrikaHelper::open_http($ApiYandexexternalReferer, $method);
    $DataResponceApiYandexexternalReferer = json_decode($ResponceApiYandexexternalReferer);

    $CountYandexexternalReferer = count($DataResponceApiYandexexternalReferer->data);

// dump($ResponceApiYandexexternalReferer,0,'ResponceApiYandexexternalReferer');
// dump($DataResponceApiYandexexternalReferer,0,'DataResponceApiYandexexternalReferer');

//переходы с фразы
    $ApiYandexSearchPhrase = 'https://api-metrika.yandex.ru/stat/v1/data?id='.$counter_id;
    $ApiYandexSearchPhrase .= '&oauth_token='.$app_token;
    $ApiYandexSearchPhrase .= '&preset=traffic&dimensions=ym:s:<attribution>SearchPhrase&group=day&sort=ym:s:<attribution>SearchPhrase&metrics=ym:s:visits,ym:s:users,ym:s:pageviews';
    $ApiYandexSearchPhrase .= '&date1='.$date1;
    $ApiYandexSearchPhrase .= '&date2='.$date2;
    $ApiYandexSearchPhrase .= '&limit=10000';
    $ResponceApiYandexSearchPhrase = MetrikaHelper::open_http($ApiYandexSearchPhrase, $method);
    $DataResponceApiYandexSearchPhrase = json_decode($ResponceApiYandexSearchPhrase);

    $CountYandexSearchPhrase = count($DataResponceApiYandexSearchPhrase->data);

// dump($ResponceApiYandexSearchPhrase,0,'ResponceApiYandexSearchPhrase');
// dump($DataResponceApiYandexSearchPhrase,0,'DataResponceApiYandexSearchPhrase');


    $ApiYandexisRobot = 'https://api-metrika.yandex.ru/stat/v1/data?id='.$counter_id;
    $ApiYandexisRobot .= '&oauth_token='.$app_token;
    $ApiYandexisRobot .= '&preset=traffic&dimensions=ym:s:isRobot&group=day&sort=ym:s:isRobot&metrics=ym:s:visits,ym:s:users,ym:s:pageviews';
    $ApiYandexisRobot .= '&date1='.$date1;
    $ApiYandexisRobot .= '&date2='.$date2;
    $ApiYandexisRobot .= '&limit=10000';
    $ResponceApiYandexisRobot = MetrikaHelper::open_http($ApiYandexisRobot, $method);
    $DataResponceApiYandexisRobot = json_decode($ResponceApiYandexisRobot);

 $countDaysUrl = count($DataResponceApiYandexURLV2->data);

 $dimensionsarray = array();
 $metricsVisits = array();
 $metricsUsers = array();
 $metricsPageviews = array();
 $MyBigarrayData = array();
 for ($i=0; $i < $countDaysUrl ; $i++) {   
    $dimensionsarray[] .= '"'.date('d.m',strtotime($DataResponceApiYandexURLV2->data[$i]->dimensions['0']->id)).'"';
    $metricsVisits[] .= $DataResponceApiYandexURLV2->data[$i]->metrics['0'];
    $metricsUsers[] .= $DataResponceApiYandexURLV2->data[$i]->metrics['1'];
    $metricsPageviews[] .= $DataResponceApiYandexURLV2->data[$i]->metrics['2'];
 }
$MyBigarrayDataDates = array($dimensionsarray,$metricsVisits,$metricsUsers,$metricsPageviews);
$MyBigarrayData = array($metricsVisits,$metricsUsers,$metricsPageviews);


$PeopleMetrics = $DataResponceApiYandexisRobot->data['0']->metrics;
$RobotMetrics = $DataResponceApiYandexisRobot->data['1']->metrics;

function mrdate($param, $time=0) {
	if(intval($time)==0)$time=time();
	$MonthNames=array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
	if(strpos($param,'M')===false) return date($param, $time);
		else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
}

function nice_num($n) {

    $n = number_format( $n ,  0  , ',' , ' '  );

    return $n;
}

  $itemmonth1 = implode(', ',$dimensionsarray);
  $itemmonth2 = implode(', ',$metricsPageviews);
  $itemmonth4 = implode(', ',$metricsUsers);



 ?>



 <div class="item-page">


<div class="ct-chart"></div>

<?php
if(count($DataResponceApiYandexURLV2->data) > 1) {

  if (!empty($countDaysUrl)) {

    echo " <script type='text/javascript'>";
    echo " document.addEventListener('DOMContentLoaded',function(){";
      echo 'new Chartist.Line(".ct-chart", { ';
        echo "labels: [".$itemmonth1."],";
        echo "series: [   [".$itemmonth2."],[".$itemmonth4."]  ]";
        echo "     }, { ";
          echo "      low: 0, ";
          echo "       showArea: true, ";
          echo "  plugins: [
            Chartist.plugins.tooltip(),
            Chartist.plugins.ctThreshold({
              threshold: {$threshold}
            })
            ] ";
            echo "     }); ";
            echo "     }); ";
            echo "     </script> ";

          }
}
 ?>


<?php if($itemmonth2): ?>

<div class="uk-grid uk-container-center uk-text-center">
  <div class="uk-width-1-3">
  <div class="uk-panel uk-panel-box uk-panel-box-secondary">
  <h3 class="uk-panel-title uk-text-primary">Всего просмотров </h3>
  <div class="uk-text-large"><big><big><?php echo nice_num((int)$DataResponceApiYandexURLV2->totals['2']); ?></big></big></div>
  </div>
  </div>
  <div class="uk-width-1-3"><div class="uk-panel uk-panel-box uk-panel-box-secondary">
  <h3 class="uk-panel-title uk-text-success">Всего визитов </h3>
  <div class="uk-text-large"><big><big><?php echo nice_num((int)$DataResponceApiYandexURLV2->totals['0']); ?></big></big></div>
  </div></div>
  <div class="uk-width-1-3"><div class="uk-panel uk-panel-box uk-panel-box-secondary">
  <h3 class="uk-panel-title uk-text-muted">Всего посетителей </h3>
  <div class="uk-text-large"><big><big><?php echo nice_num((int)$DataResponceApiYandexURLV2->totals['1']); ?></big></big></div>
  </div></div>

</div>

<?php endif; ?>

<div class="uk-grid uk-container-center uk-text-center">

<?php 

 for ($i=0; $i < $CountTrafficSourceData ; $i++) {   

$TrafficSourceName = $DataResponceApiYandexTrafficSource->data[$i]->dimensions['0']->name;
$TrafficSourceMetrics = $DataResponceApiYandexTrafficSource->data[$i]->metrics;

echo ' <div class="uk-width-1-6"><div class="uk-panel uk-panel-box uk-panel-box-secondary">
  <h4 class="uk-panel-title uk-text-muted minismall uk-text-bold">'.$TrafficSourceName.'</h4>';

echo ' <div class="uk-text-center"><table class="uk-table"><tr><td>Визиты</td><td>Посетители</td><td>Просмотры</td></tr>
  <tr><td>'.$TrafficSourceMetrics['0'].'</td><td>'.$TrafficSourceMetrics['1'].'</td><td>'.$TrafficSourceMetrics['2'].'</td></tr></table></div>
  </div></div>';

 }

?>
</div>


<?php
if(count($DataResponceApiYandexURLV2->data) > 1) :
  echo "<table id='myTable33' class='zebratable'>";
  echo "<thead>";
  echo "<tr class='upper'>";
  echo "<td>Дата <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td><td>Визиты <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td><td>Посетители <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td><td>Просмотры <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td></tr>";   
  echo "</thead>";
  echo "<tbody>";
 for ($i=0; $i < $countDaysUrl ; $i++) {   
   echo "<tr>";
   echo "<td>" . $dimensionsarray = date('d.m.Y',strtotime($DataResponceApiYandexURLV2->data[$i]->dimensions['0']->id)) . "</td>";
   echo "<td>" . $metricsVisits = $DataResponceApiYandexURLV2->data[$i]->metrics['0']. "</td>";
   echo "<td>" . $metricsUsers = $DataResponceApiYandexURLV2->data[$i]->metrics['1']. "</td>";
   echo "<td>" . $metricsPageviews = $DataResponceApiYandexURLV2->data[$i]->metrics['2']. "</td>";
   echo "</tr>";
 }

 echo "</tbody>";
 echo "</table>";
endif;
?>
<br>
<br>
<div class="uk-grid uk-container-center uk-text-center">

<?php 

 for ($i=0; $i < $CountSearchEngine ; $i++) {   

$SearchEngineSourceName = $DataResponceApiYandexSearchEngine->data[$i]->dimensions['0']->name;
$SearchEngineSourceMetrics = $DataResponceApiYandexSearchEngine->data[$i]->metrics;

echo ' <div class="uk-width-1-6"><div class="uk-panel uk-panel-box uk-panel-box-secondary">
  <h4 class="uk-panel-title uk-text-muted minismall">'.$SearchEngineSourceName.'</h4>';

echo ' <div class="uk-text-center"><table class="uk-table"><tr><td>Визиты</td><td>Посетители</td><td>Просмотры</td></tr>
  <tr><td>'.$SearchEngineSourceMetrics['0'].'</td><td>'.$SearchEngineSourceMetrics['1'].'</td><td>'.$SearchEngineSourceMetrics['2'].'</td></tr></table></div>
  </div></div>';

 }

?>
</div>


<div class="uk-grid uk-container-center uk-text-center">

<?php 

 for ($i=0; $i < $CountSocialNetwork ; $i++) {   

$SocialNetworkName = $DataResponceApiYandexSocialNetwork->data[$i]->dimensions['0']->name;
$SocialNetworkMetrics = $DataResponceApiYandexSocialNetwork->data[$i]->metrics;

echo ' <div class="uk-width-1-6"><div class="uk-panel uk-panel-box uk-panel-box-secondary">
  <h4 class="uk-panel-title uk-text-muted minismall"><b>'.$SocialNetworkName.'</b></h4>';

echo ' <div class="uk-text-center"><table class="uk-table"><tr><td>Визиты</td><td>Посетители</td><td>Просмотры</td></tr>
  <tr><td>'.$SocialNetworkMetrics['0'].'</td><td>'.$SocialNetworkMetrics['1'].'</td><td>'.$SocialNetworkMetrics['2'].'</td></tr></table></div>
  </div></div>';

 }

?>
</div>


<?php

if(count($DataResponceApiYandexexternalReferer->data) > 1 && $fastboot != 'yes') :
  echo "<h2 class='uk-text-bold uk-text-center'>Переходы по ссылкам на сайтах</h2>";
  echo "<table id='myTable344' class='zebratable'>";
  echo "<thead>";
  echo "<tr class='upper'>";
  echo "<td>Дата <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td><td>Визиты <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td><td>Посетители <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td><td>Просмотры <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td></tr>";   
  echo "</thead>";
  echo "<tbody>";

 for ($i=0; $i < $CountYandexexternalReferer ; $i++) {   

$YandexexternalRefererNetworkName = $DataResponceApiYandexexternalReferer->data[$i]->dimensions['0']->name;
$YandexexternalRefererNetworkMetrics = $DataResponceApiYandexexternalReferer->data[$i]->metrics;

   echo "<tr>";
   echo "<td><a href='".$YandexexternalRefererNetworkName."' target='_blank'>" . iconv_substr($YandexexternalRefererNetworkName, 0 , 80 , "UTF-8" ) . "</a></td>";
   echo "<td>" . $YandexexternalRefererNetworkMetrics['0']. "</td>";
   echo "<td>" . $YandexexternalRefererNetworkMetrics['1']. "</td>";
   echo "<td>" . $YandexexternalRefererNetworkMetrics['2']. "</td>";
   echo "</tr>";
 }

 echo "</tbody>";
 echo "</table>";
endif;
?>

<br>
<br>

<?php
if(count($DataResponceApiYandexSearchPhrase->data) > 1 && $fastboot != 'yes') :
  echo "<h2 class='uk-text-bold uk-text-center'>Переходы по фразам</h2>";
  echo "<table id='myTable3454' class='zebratable'>";
  echo "<thead>";
  echo "<tr class='upper'>";
  echo "<td>Фраза <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td><td>Визиты <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td><td>Посетители <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td><td>Просмотры <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td></tr>";   
  echo "</thead>";
  echo "<tbody>";

 for ($i=0; $i < $CountYandexSearchPhrase ; $i++) {   

$YandexSearchPhraseName = $DataResponceApiYandexSearchPhrase->data[$i]->dimensions['0']->name;
$YandexSearchPhraseMetrics = $DataResponceApiYandexSearchPhrase->data[$i]->metrics;

   echo "<tr>";
   echo "<td>" .$YandexSearchPhraseName. "</td>";
   echo "<td>" . $YandexSearchPhraseMetrics['0']. "</td>";
   echo "<td>" . $YandexSearchPhraseMetrics['1']. "</td>";
   echo "<td>" . $YandexSearchPhraseMetrics['2']. "</td>";
   echo "</tr>";
 }

 echo "</tbody>";
 echo "</table>";
endif;
?>

<br>
<br>
<?php if($myurltosite): ?>
<div class="uk-grid uk-container-center uk-text-center">
  <div class="uk-width-1-5">
  <div class="uk-panel uk-panel-box uk-panel-box-secondary">
  <h3 class="uk-panel-title uk-text-primary">Общее количество строк в ответе выборки</h3>
  <div class="uk-text-large"><big><big><?php echo $DataResponceApiYandexURLV2->total_rows; ?> </big></big></div>
  </div>
  </div>
  <div class="uk-width-1-5"><div class="uk-panel uk-panel-box uk-panel-box-secondary">
  <h3 class="uk-panel-title uk-text-success">Количество строк в выборке данных </h3>
  <div class="uk-text-large"><big><big> <?php echo $DataResponceApiYandexURLV2->sample_size; ?></big></big></div>
  </div></div>
  <div class="uk-width-1-5"><div class="uk-panel uk-panel-box uk-panel-box-secondary">
  <h3 class="uk-panel-title uk-text-muted">Задержка в обновлении данных, в секундах </h3>
  <div class="uk-text-large"><big><big> <?php echo $DataResponceApiYandexURLV2->data_lag; ?></big></big></div>
  </div></div>
  <div class="uk-width-1-5"><div class="uk-panel uk-panel-box-secondary">
  <h3 class="uk-panel-title uk-text-muted">Кол-во заходов людей</h3>
  <div class="uk-text-center"><table class="uk-table "><tr><?php echo "<td>Визиты</td><td>Посетители</td><td>Просмотры</td>" ; ?></tr>
  <tr> <?php echo "<td>".$PeopleMetrics['0']."</td><td>".$PeopleMetrics['1']."</td><td>".$PeopleMetrics['2']."</td>"?></tr></table></div>
  </div></div>
  <?php if (!empty($RobotMetrics)): ?>
  <div class="uk-width-1-5"><div class="uk-panel uk-panel-box-secondary">
  <h3 class="uk-panel-title uk-text-muted">Кол-во заходов роботов</h3>
  <div class="uk-text-center"><table class="uk-table "><tr><?php echo "<td>Визиты</td><td>Посетители</td><td>Просмотры</td>" ; ?></tr>
  <tr> <?php echo "<td>".$RobotMetrics['0']."</td><td>".$RobotMetrics['1']."</td><td>".$RobotMetrics['2']."</td>"?></tr></table></div>
  </div></div>
  <?php endif; ?>
 </div></div>
</div>
<?php endif; ?>



</div>
