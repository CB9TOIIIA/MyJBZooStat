<?php
/** @var $this MyjbzoostatViewAutors */
defined( '_JEXEC' ) or die; // No direct access
?>
<?php
require_once JPATH_ADMINISTRATOR . '/components/com_myjbzoostat/elements/paramsetc.php';
if (empty($threshold)) {
  $threshold = '2';
}


$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/sort.css');
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/articles.css');
$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/sort.js');
$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/chart.js');

//JUST DO IT 😹 $this->app   ----> $app
 ?>

 <script type="text/javascript">
 jQuery(document).ready(function($) {
$("#myTable").tablesorter({});
});
 </script>


<div class="item-page">

<?php


function rdate($param, $time=0) {
 if(intval($time)==0)$time=time();
 $MonthNames=array("январь", "февраль", "март", "апрель", "май", "июнь", "июль", "август", "сентябрь", "октябрь", "ноябрь", "декабрь");
 if(strpos($param,'M')===false) return date($param, $time);
   else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
}

$month = $input->get('month', date('m'), 'string');
$year = $input->get('year', date('Y'), 'string');

echo '<div class="monthdate">';
echo '<form action="/administrator/index.php?option=com_myjbzoostat&view=articles" method="post" class="form-inline">';


echo '<select class="month" name="month">';
for($i = 1; $i < 13; $i++){
  $i_n = str_pad($i, 2, "0", STR_PAD_LEFT);
  if ($month == $i_n) {
    echo '<option selected value="'.$i_n.'">'.$i_n.'</option>';
  }
  else {
    echo '<option value="'.$i_n.'">'.$i_n.'</option>';
  }
}
echo '</select>';


echo '<select class="year" name="year">';
for($i = 2014; $i < 2017; $i++){
  $i_n = str_pad($i, 2, "0", STR_PAD_LEFT);
  if ($year == $i_n) {
    echo '<option selected value="'.$i_n.'">'.$i_n.'</option>';
  }
  else {
    echo '<option value="'.$i_n.'">'.$i_n.'</option>';
  }
}
echo '</select>';



echo '<input type="submit" value="Поиск по месяцам"></form>';
echo '</div>';
echo '<hr>';
$monthnew = rdate('M', mktime(0, 0, 0, intval($month), 10));


$articlesmonth = "SELECT COUNT(id)"
    ." FROM " . ZOO_TABLE_ITEM
    ." WHERE publish_up BETWEEN '".$year."-".$month."-01' AND '".$year."-".$month."-31'";


    $Arrayarticlesmonth  = $app->table->tag->database->queryResultArray($articlesmonth);
    $countarticleinmonth = $Arrayarticlesmonth[0];

  //dump($countarticleinmonth,0,'Статей за месяц');

$monthdatetwo = $year.'-'.$month;
  $querysmonth = $db->getQuery(true);
$querysmonth
      ->select($db->quoteName('publish_up'))
      ->from($db->quoteName(ZOO_TABLE_ITEM))
      ->where($db->quoteName('publish_up') . ' BETWEEN "' .$monthdatetwo.'-01' . '" AND "' .$monthdatetwo.'-31"');


  $db->setQuery($querysmonth);
  $itemIdsResultsdatemonth = $db->loadObjectList();


  $itemIdsdatemonth = array();
  foreach ($itemIdsResultsdatemonth as $itdatemonth) {

      $itemIdsdatemonth[] = date("d.m.Y", strtotime("+0 seconds", strtotime($itdatemonth->publish_up)));

  }

  $datearraydatemonth = array_count_values($itemIdsdatemonth);


//  dump($datearraydatemonth,0,'Статей за месяц1');
//  dump($itemIdsdatemonth,0,'Статей за месяц2');

//$imdatenum = implode(', ',$datearraydatemonth);

$itemmonth1  = array();
$itemmonth2  = array();

foreach ($datearraydatemonth as $datenum => $valuearticles) {

  // $itemmonth1[] = implode(', ',$datenum);
  // $itemmonth2[] = implode(', ',$valuearticles);
  $datenum = date("d", strtotime($datenum));
  $itemmonth1[] = '"'.$datenum.'"';
  $itemmonth2[] = $valuearticles;


}
$itemmonth1 = implode(', ',$itemmonth1);
$itemmonth2 = implode(', ',$itemmonth2);


if (!empty($valuearticles)) {

echo " <script type='text/javascript'>";
echo " document.addEventListener('DOMContentLoaded',function(){";
echo 'new Chartist.Line(".ct-chart", { ';
echo "labels: [".$itemmonth1."],";
echo "series: [   [".$itemmonth2."]  ]";
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


echo '<h1>Статистика статей за '.$monthnew.' '.$year.' ('.$countarticleinmonth.')</h1>';
echo "<div class='ct-chart'></div>";

$articlesmonthtag = "SELECT id"
    ." FROM " . ZOO_TABLE_ITEM
    ." WHERE type = 'news' AND publish_up BETWEEN '".$year."-".$month."-01' AND '".$year."-".$month."-31'";
//HACK to type

    $Arrayarticlesmonthtag  = array($app->table->tag->database->queryResultArray($articlesmonthtag));
//
// dump($Arrayarticlesmonthtag,0,'$countarticleinmonthtag');


if (!empty($Arrayarticlesmonthtag[0])) {
foreach ($Arrayarticlesmonthtag as $keyidarticles  => $valueddid) {


// dump($valueddid,0,'$valueddid');
  // $itkeyidarti = implode(', ',$valueddid);
// dump($itkeyidarti,0,'$itkeyidarti');

$articlesmonthtagtagtag = "SELECT item_id"
    ." FROM " . ZOO_TABLE_TAG
    ." WHERE item_id IN (" . implode(', ', $valueddid) . ")";

    $Arrayarticlesmonthtagas  = array_unique($app->table->tag->database->queryResultArray($articlesmonthtagtagtag));

//dump($Arrayarticlesmonthtagas,0,'$Arrayarticlesmonthtagas');

$comparear = array_diff($valueddid,$Arrayarticlesmonthtagas);

//dump($comparear,0,'$Arrayarticlesmonthtagas');

$idadd = '0';
if ($comparear) {
  echo "<h2>Статьи без тегов: </h2>";
  echo "<table id='myTable' class='zebratable'>";
  echo "<thead>";
  echo "<tr class='upper'>";
  echo "<td>№ <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
  echo "<td>Дата <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
  echo "<td>Название статьи <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
  echo "<td>Имя автора <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
}

foreach ($comparear as $idnothavatags) {
  $itemnothavatags = $app->table->item->get($idnothavatags);

  $namenottag = $itemnothavatags->name;
  $aliasnottag = $itemnothavatags->alias;
  $publishupnottag = $itemnothavatags->publish_up;
  $creatnottag = $itemnothavatags->created_by;
  $idnottag = $itemnothavatags->id;
  $typenottag = $itemnothavatags->type;
  //dump($itemnothavatags,0,'$itemnothavatags');
 $genurl = JRoute::_($app->jbrouter->externalItem($itemnothavatags, false), false, 2);
 $user = JFactory::getUser($creatnottag);
 $valueid = $creatnottag;
 $bignamau = $user->name;
 $mydatefor = date("d.m",strtotime($publishupnottag));
 $leftcarret = urlencode('[');
 $rightcarret = urlencode(']');
$genadminurleditor = "/administrator/index.php?option=com_zoo&controller=item&changeapp=1&task=edit&cid".$leftcarret.$rightcarret."=".$idnottag;
$idadd++;

  if ($typenottag == 'news') {
    # code...

        echo "<tr>";
        echo "<td>".$idadd."</td>";
        echo "<td>".$mydatefor."</td>";
        // echo "<td>".$valueid."</td>";
      //  echo "<td>".$username."</td>";
        echo "<td><a target='_blank' href='".$genadminurleditor."'>".$namenottag."</a> &nbsp; <a target='_blank' href='".$genurl."'><em class='icon-out-2'></em></a></td>";
        echo '<td><form style="display:none"  action="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" name="a'.$valueid.'" method="post" >
        <input  type="hidden" name="authorids"  value="'.$valueid.'" />
         <input  type="hidden" name="monthdate"  value="'.$year.'-'.$month.'" />
         </form> <a class="test-submit" href="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" OnClick="a'.$valueid.'.submit();return false;">'.$bignamau.'</a></td>';
        echo "</tr>";
  }


//dump($Arrayauthorsscount,0,'Кол-во статей в месяц');

}


}
}

      echo "</tbody>";
      echo "</table>";



?>

<!-- <script type="text/javascript">
document.addEventListener('DOMContentLoaded',function(){
new Chartist.Line('.ct-chartad', {
  labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
  series: [
    [12, 9, 7, 8, 5],
    [2, 1, 3.5, 7, 3],
    [1, 3, 4, 5, 6]
  ]
}, {
  fullWidth: true,
  chartPadding: {
    right: 40
  }
});
});
</script> -->




<?php

		//	$author = $this->_item->created_by_alias;
		//	$user   = $app->user->get($this->item->created_by);
	//		$authorid = $user->id;
	//		$authorname = $user->name;


	$querys = $db->getQuery(true);
	$querys
	    ->select($db->quoteName('publish_up'))
	    ->from($db->quoteName(ZOO_TABLE_ITEM))
      ->order('publish_up DESC');

	$db->setQuery($querys);
	$itemIdsResultsdate = $db->loadObjectList();


	$itemIdsdate = array();
	foreach ($itemIdsResultsdate as $itdate) {

	    $itemIdsdate[] = date("m.Y", strtotime("+0 seconds", strtotime($itdate->publish_up)));

	}

//    dump($itemIdsdate,0,'Массив статей');
$datearraydate = array_count_values($itemIdsdate);
//ksort($datearraydate);


echo "<hr>";
echo "<div class='allinfoabout'>";
echo "<p><big><big>Глобальная статистика публикаций: </big></big></p>";
echo "<div class='tagsstat mounth'><ul class='zebra'>";
foreach ($datearraydate as $valtagdate => $valuecount )  {

echo  $datearraydate[] = '<li>'.$valtagdate. ' ('. $valuecount.')</li>';

}
echo "</ul></div>";

 ?>










</div>
