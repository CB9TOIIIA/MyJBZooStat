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

$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/chart.js');

$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/metrika.css');

$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/metrika.js');

$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/jquery.dataTables.min.css');

$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/jquery.dataTables.min.js');

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
  $("#myTable3").DataTable({language:{url:"/administrator/components/com_myjbzoostat/assets/js/Russian.json"}});
});
</script>';

echo '
<script type="text/javascript">
jQuery(document).ready(function($) {
  $("#myTable4").DataTable({language:{url:"/administrator/components/com_myjbzoostat/assets/js/Russian.json"}});
});
</script>';

?>



<div class="item-page">

  <?php

    $yearzoofromdb = $db->getQuery(true);
    $yearzoofromdb
    ->select($db->quoteName('created'))
    ->from($db->quoteName(ZOO_TABLE_MY_ORDERS))
    ->order($db->quoteName('created') . 'ASC LIMIT 1');

  $db->setQuery($yearzoofromdb);
  $ResYDBs = $db->loadObjectList();

  foreach ($ResYDBs as $ResYDB) {
    $MinYearJBZoo = date('Y', strtotime($ResYDB->created));
  }


    $yearzoofromdbmax = $db->getQuery(true);
    $yearzoofromdbmax
    ->select($db->quoteName('created'))
    ->from($db->quoteName(ZOO_TABLE_MY_ORDERS))
    ->order($db->quoteName('created') . 'DESC LIMIT 1');

  $db->setQuery($yearzoofromdbmax);
  $ResYDBmaxs = $db->loadObjectList();

  foreach ($ResYDBmaxs as $ResYDm) {
    $MaxYearJBZoo = date('Y', strtotime($ResYDm->created));
  }



  function rdate($param, $time=0) {
    if(intval($time)==0)$time=time();
    $MonthNames=array("январь", "февраль", "март", "апрель", "май", "июнь", "июль", "август", "сентябрь", "октябрь", "ноябрь", "декабрь");
    if(strpos($param,'M')===false) return date($param, $time);
    else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
  }

  $month = $input->get('month', date('m'), 'string');
  $year = $input->get('year', date('Y'), 'string');

  $Needzakazistat = $input->get('zakazistat', NULL, 'string');



  echo '<div class="monthdate">';
  echo '<form action="/administrator/index.php?option=com_myjbzoostat&view=orders" method="post" class="form-inline">';


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
      for($i = $MinYearJBZoo; $i <= $MaxYearJBZoo; $i++){
        $i_n = str_pad($i, 2, "0", STR_PAD_LEFT);
        if ($year == $i_n) {
          echo '<option selected value="'.$i_n.'">'.$i_n.'</option>';
        }
        else {
          echo '<option value="'.$i_n.'">'.$i_n.'</option>';
        }
      }
      echo '</select>';


          if (!empty($Needzakazistat) == 'yes') {
                echo '<label class="checkbox"><input type="checkbox" name="zakazistat" value="yes" checked> Подробная статистика </label>';
          }
          else {
                echo '<label class="checkbox"><input type="checkbox" name="zakazistat" value="yes"> Подробная статистика  </label>';
          }


  echo '<input type="submit" class="btn"  value="Поиск по месяцам"></form>';
  echo '</div>';
  echo '<hr>';
  $monthnew = rdate('M', mktime(0, 0, 0, intval($month), 10));


  $articlesmonth = "SELECT id"
  ." FROM " . ZOO_TABLE_MY_ORDERS
  ." WHERE created BETWEEN '".$year."-".$month."-01' AND '".$year."-".$month."-31'";


  $Arrayarticlesmonthcount  = count($app->table->tag->database->queryResultArray($articlesmonth));
  $countarticleinmonth = $Arrayarticlesmonthcount;

  //dump($countarticleinmonth,0,'Статей за месяц');

  $monthdatetwo = $year.'-'.$month;
  $querysmonth = $db->getQuery(true);
  $querysmonth
  ->select($db->quoteName('created'))
  ->from($db->quoteName(ZOO_TABLE_MY_ORDERS))
  ->where($db->quoteName('created') . ' BETWEEN "' .$monthdatetwo.'-01' . '" AND "' .$monthdatetwo.'-31"');


  $db->setQuery($querysmonth);
  $itemIdsResultsdatemonth = $db->loadObjectList();


  $itemIdsdatemonth = array();
  foreach ($itemIdsResultsdatemonth as $itdatemonth) {

    $itemIdsdatemonth[] = date("d.m.Y", strtotime("+0 seconds", strtotime($itdatemonth->created)));

  }

  $datearraydatemonth = array_count_values($itemIdsdatemonth);


  $itemmonth1  = array();
  $itemmonth2  = array();

  foreach ($datearraydatemonth as $datenum => $valuearticles) {

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
              threshold: {$Min_Zakazov}
            })
            ] ";
            echo "     }); ";
            echo "     }); ";
            echo "     </script> ";

          }


          echo '<h1>Статистика заказов за '.$monthnew.' '.$year.' ('.$countarticleinmonth.')</h1>';
          echo "<div class='ct-chart'></div>";


echo "</div>";



echo "<div class='clrboth'></div>";
echo "<h2>Детальная выручка: </h2>";


echo "<div class='clrboth'></div>";
echo "<table id='myTable4' class='zebratable'>";

echo "<thead>";
echo "<tr class='upper'>";
echo "<td>№ <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
echo "<td>День заказа<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
echo "<td>Заказов<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
echo "<td>Выручка<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
echo "</tr>";
echo "</thead>";

$Myplusa = '';

if (!empty($datearraydatemonth)) :

  foreach ($datearraydatemonth as $datenum => $valuearticles) {

    $datenumD = date('d',strtotime($datenum));
    $datenumDarr[] = date('d',strtotime($datenum));
    $datenumM = date('m',strtotime($datenum));
    $datenumY = date('Y',strtotime($datenum));
    $datenumfullrev = date('Y-m-d',strtotime($datenum));
    $datenumnorm = date('d.m.y',strtotime($datenum));
    $Myplusa++;

    $totalsuminMymonthsqlred = "SELECT total"
    ." FROM " . ZOO_TABLE_MY_ORDERS
    ." WHERE created BETWEEN '".$datenumfullrev." 00:00:00' AND '".$datenumfullrev." 23:59:59'";

    $totalsuminMymonthsDaya  = $app->table->tag->database->queryResultArray($totalsuminMymonthsqlred);

    $totalsuminMymonthzeroDay = 0;
    $totalsuminMymonthzeroDayarr = 0;
    foreach ($totalsuminMymonthsDaya as $totalsuminMymonthsDay) {
        $totalsuminMymonthzeroDay += $totalsuminMymonthsDay;
        $totalsuminMymonthzeroDayarr += $totalsuminMymonthsDay;
    }

    $totalsuminMymonthzeroDayard[] = $totalsuminMymonthzeroDayarr;

    echo "<tr>";
    echo "<td>{$Myplusa}</td>";
    echo "<td>{$datenum}</td>";
    echo "<td>{$valuearticles}</td>";
    echo "<td>{$totalsuminMymonthzeroDay}</td>";
    echo "</tr>";

  }



echo "</table>";


echo "<div class='clrboth'></div>";


 $itemmonth1datenumDarr = implode(', ',$datenumDarr);
 $itemmonth2totalsuminMymonthzeroDayarr = implode(', ',$totalsuminMymonthzeroDayard);

 if (!empty($valuearticles)) {

   echo " <script type='text/javascript'>";
   echo " document.addEventListener('DOMContentLoaded',function(){";
     echo 'new Chartist.Line(".ct-chart2", { ';
       echo "labels: [".$itemmonth1datenumDarr."],";
       echo "series: [   [".$itemmonth2totalsuminMymonthzeroDayarr."]  ]";
       echo "     }, { ";
         echo "      low: 0, ";
         echo "       showArea: true, ";
         echo "  plugins: [
           Chartist.plugins.tooltip(),
           Chartist.plugins.ctThreshold({
             threshold: {$Min_Money}
           })
           ] ";
           echo "     }); ";
           echo "     }); ";
           echo "     </script> ";

         }


         echo "<h1>График продаж за {$monthnew} {$year}</h1>";
         echo "<div class='ct-chart2'></div>";

           $totalsuminMymonthsql = "SELECT total"
           ." FROM " . ZOO_TABLE_MY_ORDERS
           ." WHERE created BETWEEN '".$year."-".$month."-01' AND '".$year."-".$month."-31'";


           $totalsuminMymonths  = $app->table->tag->database->queryResultArray($totalsuminMymonthsql);
           $totalsuminMymonthzero = 0;
           foreach ($totalsuminMymonths as $totalsuminMymonth) {
               $totalsuminMymonthzero += $totalsuminMymonth;
           }
           echo "<div class='clrboth'></div>";
           echo "<h3 align='right'>Итого: {$countarticleinmonth} шт. заказов на сумму {$totalsuminMymonthzero} руб. </h3>";
endif;

if ($Needzakazistat == 'yes') :

echo "<h2>Подробная статистика заказов: </h2>";

  $Myplus = '';
  $Arrayarticlesmonth  = $app->table->tag->database->queryResultArray($articlesmonth);
  // dump($Arrayarticlesmonth,0,'$Arrayarticlesmonth');
    echo "<div class='clrboth'></div>";
    echo "<table id='myTable' class='zebratable'>";

    echo "<thead>";
    echo "<tr class='upper'>";
    echo "<td>№ <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
    echo "<td>Дата заказа <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
    echo "<td>ID заказа<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
    echo "<td>Телефон клиента <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
    echo "<td>Имя клиента <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
    echo "<td>Кол-во товаров <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
    echo "<td>Сумма <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
    echo "</tr>";
    echo "</thead>";

if (!empty($Arrayarticlesmonth)) :



    $TopOrderClientName = array();
    $Telnumberarray = array();
    $nameitemorder = array();
    $OrderClientNamearray = array();
    $TelregBanoo = array();

    foreach ($Arrayarticlesmonth as $idOrderinMonth) {
      $Myplus++;

      $orderModel = JBModelOrder::model();
      $order = $orderModel->getById($idOrderinMonth);
      $myCreatedorder = $order->created;
      $myCreatedorder = date('d.m.y - H:i',strtotime($myCreatedorder));
      $MyOrderTotal = $order->getTotalSum()->val();
      $MyDataorder = $idOrderinMonth;


      $orderId = $MyDataorder;
      $orderModel = JBModelOrder::model();
      $orderItem = $orderModel->getById($orderId); // материал заказа
      $orderItemas = $orderItem->getItems(true); // материал заказа
      $OrderSku = $orderItem->getTotalCountSku(); // кол-во товаров
      $OrderURL = $orderItem->getUrl(); // url to order
      $OrderClientNamearray[] = $orderItem->getShippingFields()->get($ElementName)->value;
      $OrderClientName = $orderItem->getShippingFields()->get($ElementName)->value;
      $TopOrderClientName[] = $orderItem->getShippingFields()->get($ElementName)->value;
      if (!empty($TopTelVal)) {
            $TopTelVal[] = $orderItem->getShippingFields()->get($ElementTel)->value;
      }

      else {
        $TopTelVal[] = 'Номер не указан';
      }

      $TelregBadsg = preg_match('/^(\+7|8)(\(\d{3}\)|\d{3})\d{7}$/', $orderItem->getShippingFields()->get($ElementTel)->value, $matchtelbra);
      if (!empty($matchtelbra)) {
        $TelregBa[] = $matchtelbra[0];
        $TelregBanoo[] = $matchtelbra[0];
      }
      else {
        $TelregBa[] = 'Номер не указан';
      }

      $ordertelstatggg = $orderItem->getShippingFields();
      foreach ($ordertelstatggg as $key => $value) {
        if (!empty($value)) {
          $tel = $value->get('value');
          if (!empty($tel)) {
            $telreg = preg_match('/^(\+7|8)(\(\d{3}\)|\d{3})\d{7}$/', $tel, $matchtel);
            if (!empty($matchtel[0])) {
              $Telnumber = $matchtel[0];
              $Telnumberarray[] = $matchtel[0];
            }
          }
        }
      }

      if (!isset($OrderClientName)) {
          $OrderClientName = 'Имя не указано';
      }

      if (!isset($Telnumber) || empty($Telnumber)) {
        $Telnumber = 'Номер не указан';
        $Telnumberarray[] = 'Номер не указан';
      }

      foreach ($orderItemas as $orderITEM) {
        $nameitemorder[] = $orderITEM->get('item_name');
      }


// dump($TopTelnumberarray,0,'$TopTelnumberarray');
    echo "<tr>";
    echo "<td>{$Myplus}</td>";
    echo "<td>{$myCreatedorder}</td>";
    echo "<td><a target='_blank' href='{$OrderURL}'>{$MyDataorder}</a></td>";
    echo "<td>{$Telnumber}</td>";
    echo "<td>{$OrderClientName}</td>";
    echo "<td>{$OrderSku}</td>";
    echo "<td>{$MyOrderTotal}</td>";
    echo "</tr>";


  }


  echo "</table>";




$toptovarodMonth = array_count_values($nameitemorder);
$TopTelnumberarray = array_count_values($Telnumberarray);
// $TopOrderClientNamecount = array_count_values($TopOrderClientName);


echo "<h2>ТОП клиентов за месяц: </h2>";


echo "<div class='clrboth'></div>";
echo "<table id='myTable3' class='zebratable'>";

echo "<thead>";
echo "<tr class='upper'>";
echo "<td>№ <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
echo "<td>Номер клиента<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
echo "<td>Кол-во заказов<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
// echo "<td>Написать смс<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
echo "</tr>";
echo "</thead>";

$Myplusa = '';

$TelregBaasnooo = array_count_values($TelregBanoo);

$BigTestarray = array_unique(array_combine($TopOrderClientName, $TopTelVal));
//$BigTestarraygsd = array_combine($BigTestarray, $TopMobileC);

$Telclienglobal = array();
$KolvozakazovClienta = array();
$TopOrderClientNameasd = array();
$TopOrderClientNameasdffff = array();
$smsto = '';
foreach ($TelregBaasnooo as $keytel => $valuemonth) {
  $Myplusa++;
echo "<tr>";
echo "<td>{$Myplusa}</td>";
echo "<td>{$keytel}</td>";
echo "<td>{$valuemonth}</td>";
// echo "<td>Написать sms {$smsto}</td>";
echo "</tr>";
}


echo "</table>";

echo "<div class='clrboth'></div>";

echo "<h2>Популярные товары в этом месяце: </h2>";


echo "<div class='clrboth'></div>";
echo "<table id='myTable2' class='zebratable'>";

echo "<thead>";
echo "<tr class='upper'>";
echo "<td>№ <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
echo "<td>Название товара<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
echo "<td>Кол-во заказов<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
echo "</tr>";
echo "</thead>";

$Myplusa = '';

foreach ($toptovarodMonth as $keyitemname => $valuecount) {
    $Myplusa++;

    echo "<tr>";
    echo "<td>{$Myplusa}</td>";
    echo "<td>{$keyitemname}</td>";
    echo "<td>{$valuecount}</td>";
    echo "</tr>";

  }

echo "</table>";


echo "<div class='clrboth'></div>";

endif;

endif;
?>


</div>
