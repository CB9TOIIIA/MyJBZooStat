<?php
defined( '_JEXEC' ) or die;
	
	/* add  Class 'JFolder */
	JLoader::register('JFile', JPATH_LIBRARIES . '/joomla/filesystem/file.php');
	JLoader::register('JFolder', JPATH_LIBRARIES . '/joomla/filesystem/folder.php');
	
	
	ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

jimport('joomla.html.html.bootstrap');
require_once JPATH_ADMINISTRATOR . '/components/com_myjbzoostat/elements/paramsetc.php';

if ($csshack == 'yes') {
  echo "<style>div#system-message-container {display:none;}</style>";
}

JHtml::_('jquery.framework');

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


$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/metrika.css');

$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/datepick.css');

$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/metrika.js');

$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/jquery.dataTables.min.css');

$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/jquery.dataTables.min.js');

$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/datepicker.min.js');

?>



<?php



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

$month = $input->get('month', date('m'), 'string');
$year = $input->get('year', date('Y'), 'string');
echo '<div style="margin-left: auto; width: 600px; margin-right: auto;" class="monthdate">';
echo '<form action="/administrator/index.php?option=com_myjbzoostat&view=nodubles" method="post" class="form-inline">';
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

$articlesmonthtag = "SELECT id"
." FROM " . ZOO_TABLE_ITEM
." WHERE type = '".$TypeArticleorProduct."' AND state = '1' AND access = '1' AND publish_up BETWEEN '".$year."-".$month."-01 00:00:00' AND '".$year."-".$month."-31 23:59:59'";

$Arrayarticlesmonthtag  = array($app->table->tag->database->queryResultArray($articlesmonthtag));
echo "<h1>Детектор дублей</h1>";
echo "<ul class='listdubl'>";
$itemid = NULL;
$val = NULL;
if (!empty($Arrayarticlesmonthtag[0])) {
  foreach ($Arrayarticlesmonthtag as $keyidarticles  => $valueddid) {

    foreach ($valueddid as $valueddidz) {
      $item = $app->table->item->get($valueddidz);
      $itemid = $item->id;
      $itemstate = $item->state;

      if ($itemstate == 1) {
        $element = $item->getElement('1331309a-133d-4208-9250-4330706af965'); // element id получаем так
        $data = (array)$element->data(); // получаем данные
        $tels[] = $data[0]['value']; // смотрим что там хранится
        $dubles   =    array_unique(array_count_values($tels),SORT_REGULAR);
        foreach ($dubles as $key => $value) {
          if ($value == 2) {
            $val[] .= $key;
          }
          
        }
      }


    }

  }
}
@$dublesd   =    array_unique(($val),SORT_REGULAR);
if (!empty($dublesd)) {
foreach ($dublesd as $keyg) {
  $urll = urlencode($keyg);
  echo '<li><a target="_blank" href="http://dom813.ru/?e%5B1331309a-133d-4208-9250-4330706af965%5D='.$urll.'&limit=20&order%5Bfield%5D=_none&order%5Bmode%5D=s&order%5Border%5D=asc&logic=and&send-form=%D0%98%D1%81%D0%BA%D0%B0%D1%82%D1%8C&exact=1&controller=search&option=com_zoo&task=filter&type=realty&app_id=1&Itemid=105">'.$keyg.'</a></li>';
}
}


echo "</ul>";
?>
<div class="item-page">


</div>
