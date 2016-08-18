<?php
/** @var $this MyjbzoostatViewAutors */
defined( '_JEXEC' ) or die; // No direct access
?>
<?php
$input = JFactory::getApplication()->input;
require_once JPATH_ADMINISTRATOR . '/components/com_zoo/config.php';
require_once JPATH_ROOT . '/media/zoo/applications/jbuniversal/framework/jbzoo.php';
require_once JPATH_ROOT . '/media/zoo/applications/jbuniversal/framework/classes/jbmodulehelper.php';
require_once JPATH_ROOT . '/media/zoo/applications/jbuniversal/framework/classes/jbtemplate.php';
$app = App::getInstance('zoo');


$mainframe = JFactory::getApplication();
$namecomponent = $mainframe->scope;

$document = JFactory::getDocument();
$document->addStyleSheet(JUri::root().'administrator/components/'.$namecomponent.'/assets/css/sort.css');
$document->addScript(JUri::root().'administrator/components/'.$namecomponent.'/assets/js/sort.js');
$document->addScript(JUri::root().'administrator/components/'.$namecomponent.'/assets/js/chart.js');
//JUST DO IT   $this->app   ----> $app
 ?>
 <script type="text/javascript">
 jQuery(document).ready(function($) {
   $("#myTable").tablesorter({});
 });
 </script>


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
 echo '<form action="/administrator/index.php?option=com_myjbzoostat&view=tags" method="post" class="form-inline">';

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


 $querymonthids = "SELECT id"
     ." FROM " . ZOO_TABLE_ITEM
     ." WHERE publish_up BETWEEN '".$year."-".$month."-01' AND '".$year."-".$month."-31'";

$alipublish_upformat = rdate("M", strtotime("+0 seconds", strtotime($month)));
$Arrayarticlesmonth = array($app->table->tag->database->queryResultArray($querymonthids));

// dump($Arrayarticlesmonth,0,'ID за месяц');
if (!empty($Arrayarticlesmonth[0])) {

foreach ($Arrayarticlesmonth as $idsmonth) {

  $querymonthtag = "SELECT name"
      ." FROM " . ZOO_TABLE_TAG
      ." WHERE item_id IN (" . implode(', ', $idsmonth) . ")";


  $tagsArraycounttagsmonthtag = array_count_values($app->table->tag->database->queryResultArray($querymonthtag));

 // dump($tagsArraycounttagsmonthtag,0,'Массив тегов за месяц');
      $tablecount = '0';
  $itemmonth1  = array();
  $itemmonth2  = array();
  $itemmonth3  = array();
  $itemmonth4  = array();

        foreach ($tagsArraycounttagsmonthtag as $tagname => $valuetag) {
            if ($valuetag > 0) {

                          $itemmonth3[] = '"'.$tagname.'"';
                          $itemmonth4[] = $valuetag;
            }

        }

$coutgra = count($tagsArraycounttagsmonthtag);
// dump($coutgra,0,'Массив $coutgra за месяц');
$itemmonth3s = implode(', ',$itemmonth3);
$itemmonth4s = implode(', ',$itemmonth4);
// dump($itemmonth3s,0,'Массив тегов за месяц');
// dump($itemmonth4s,0,'Массив тегов за месяц');


$itemmonth1 = implode(', ',$itemmonth1);
$itemmonth2 = implode(', ',$itemmonth2);

if ($coutgra != 0) {


       echo "<p><b><big>Статистика тегов  за  <u>{$alipublish_upformat}</u>: </big></b></p>";
      //
      //
  //     echo " <script type='text/javascript'>";
  //     echo " document.addEventListener('DOMContentLoaded',function(){";
  //     echo 'new Chartist.Line(".ct-chart", { ';
  //     echo "labels: [".$itemmonth3s."],";
  //     echo "series: [   [".$itemmonth4s."]  ]";
  //     echo "     }, { ";
  //     echo "      low: 0, ";
  //     echo "       showArea: true, lineSmooth: Chartist.Interpolation.simple({
  //   divisor: 2
  // }),
  // fullWidth: true,
  // chartPadding: {
  //   right: 20
  // },
  // low: 0,";
  //     echo "  plugins: [
  //         Chartist.plugins.tooltip(),
  //         Chartist.plugins.ctThreshold({
  //           threshold: 20
  //         })
  //       ] ";
  //     echo "     }); ";
  //     echo "     }); ";
  //     echo "     </script> ";

      echo " <script type='text/javascript'>";
      echo " document.addEventListener('DOMContentLoaded',function(){";
        echo "var chart = new Chartist.Bar('.ct-chart', {";
          echo "labels: [".$itemmonth3s."],";
          echo "series: [   [".$itemmonth4s."]  ]},  {
            seriesBarDistance: 100,
            reverseData: true,
            scaleMinSpace: 80,
            horizontalBars: true,
            axisY: {
              offset: 100
            },
            plugins: [
               Chartist.plugins.tooltip(),
              Chartist.plugins.ctPointLabels({
                textAnchor: 'middle'
              })
              ]});   }); ";
              echo "</script> ";

//
//       echo " <script type='text/javascript'>";
//       echo "document.addEventListener('DOMContentLoaded',function(){";
//         echo "var data = { ";
//           echo "labels: [".$itemmonth3s."],";
//           echo "series:   [".$itemmonth4s."] };
//           var options = {
//             labelInterpolationFnc: function(value) {
//               return value[0]
//             }
//           };
//
// var responsiveOptions = [
//   ['screen and (min-width: 1024px)', {
//     labelOffset: 180,
//     chartPadding: 100,
//     labelDirection: 'explode',
//     labelInterpolationFnc: function(value) {
//       return value;
//     }
//   }]
// ];
//             new Chartist.Pie('.ct-chart', data, options, responsiveOptions);
//         });
//
//        ";
//         echo "</script> ";

if ($coutgra < 5) {
  echo "<style>  .ct-chart {  height: 150px !important;  }</style>";
}

if ($coutgra >5 && $coutgra < 10) {
  echo "<style>  .ct-chart {  height: 300px !important;  }</style>";
}

if ($coutgra > 34) {
  echo "<style>  .ct-chart {  height: 1200px !important;  }</style>";
}

if ($coutgra > 0) {
      echo "<hr> ";
  echo "<style>  .ct-chart {  height: 700px;  }</style>";
  echo "<div class='ct-chart'></div>";
  echo "<hr> ";
  echo "<br> ";
}

       echo "<table id='myTable' class='zebratable'>";
       echo "<thead>";
       echo "<tr class='upper'>";
       echo "<td>№ <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
       echo "<td>Название тега <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
       echo "<td>Кол-во <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
       echo "</tr>";
       echo "</thead>";
       echo "<tbody>";

  foreach ($tagsArraycounttagsmonthtag as $tagname => $valuetag) {
    $tablecount++;

    echo "<tr>";
    echo "<td>".$tablecount."</td>";
    echo "<td>".$tagname."</td>";
    echo "<td>".$valuetag."</td>";
    echo "</tr>";

  }

     echo "</table>";
     echo "<br>";

  }
}
     echo "</hr>";

   }
  ?>

<div class="item-page">
<?php echo "<p><big><big>Глобальная статистика тегов: </big></big></p>"; ?>

<div class="tagsstat">
<ul class="zebra">
<?php

$db = JFactory::getDBO();
$appId  = 1;
$querycounttagalltags = $db->getQuery(true);

$querycounttagalltags = "SELECT name FROM " . ZOO_TABLE_TAG ." ORDER BY name";

$tagsArraytagalltags = array_unique($app->table->tag->database->queryResultArray($querycounttagalltags));

foreach ($tagsArraytagalltags as $tag) {

	$querycounttagalltagss = "SELECT COUNT(name) FROM " . ZOO_TABLE_TAG ." WHERE name = '$tag'";

	$tagsArraytagalltagss = array_unique($app->table->tag->database->queryResultArray($querycounttagalltagss));

  $tag = trim($tag);
	echo "<li><a target='_blank' href='/administrator/index.php?option=com_zoo&controller=item&filter_category_id=-1&filter_type=&filter_author_id=&search={$tag}'>{$tag}</a> ({$tagsArraytagalltagss[0]}) - <a target='_blank' href='/tag/{$tag}.html''><em class='icon-out-2'></em></a></li> ";


}
?>
</ul>
</div>
</div>
