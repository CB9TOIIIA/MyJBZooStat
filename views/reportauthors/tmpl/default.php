<?php
/** @var $this MyjbzoostatViewAutors */
defined( '_JEXEC' ) or die; // No direct access
?>
<?php

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


require_once JPATH_ADMINISTRATOR . '/components/com_myjbzoostat/elements/paramsetc.php';
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/articles.css');
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/jquery.dataTables.min.css');
$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/jquery.dataTables.min.js');
$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/chart.js');
//JUST DO IT   $this->app   ----> $app

  $yearzoofromdb = $db->getQuery(true);
  $yearzoofromdb
  ->select($db->quoteName('created'))
  ->from($db->quoteName(ZOO_TABLE_ITEM))
  ->order($db->quoteName('created') . 'ASC LIMIT 1');

$db->setQuery($yearzoofromdb);
$ResYDBs = $db->loadObjectList();

foreach ($ResYDBs as $ResYDB) {
  $MinYearJBZoo = date('Y', strtotime($ResYDB->created));

}


  $yearzoofromdbmax = $db->getQuery(true);
  $yearzoofromdbmax
  ->select($db->quoteName('created'))
  ->from($db->quoteName(ZOO_TABLE_ITEM))
  ->order($db->quoteName('created') . 'DESC LIMIT 1');

$db->setQuery($yearzoofromdbmax);
$ResYDBmaxs = $db->loadObjectList();

foreach ($ResYDBmaxs as $ResYDm) {
  $MaxYearJBZoo = date('Y', strtotime($ResYDm->created));
}


?>
<script type="text/javascript">
jQuery(document).ready(function($) {
$("#myTable").DataTable({language:{url:"/administrator/components/com_myjbzoostat/assets/js/Russian.json"}});
});
</script>

<div class="item-page">
  <div class="tagsstat">

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
    echo '<form action="/administrator/index.php?option=com_myjbzoostat&view=reportauthors" method="post" class="form-inline">';

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


    echo '<input type="submit"  class="btn" value="Поиск по месяцам"></form>';
    echo '</div>';
    echo '<hr>';
    $monthnew = rdate('M', mktime(0, 0, 0, intval($month), 10));


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
    // $itemIdsResultsdate = $db->loadObjectList();
    //
    //
    // $itemIds = array();
    //
    // foreach ($itemIdsResultsdate as $it) {
    //   $itemIds[] = $it->created_by;
    // }


    $itemIdsResultsdate = array_unique($app->table->tag->database->queryResultArray($querys));
    $itemIds = array();
    foreach ($itemIdsResultsdate as $it) {
      $itemIds[] = $it;
    }

    $idadd = '0';

    echo '<h1>Статистика за '.$monthnew.' '.$year.'</h1>';
    echo '<hr>';

    echo "<table id='myTable' class='zebratable'>";
    echo "<thead>";
    echo "<tr class='upper'>";
    echo "<td>№ <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='> </td>";
    // echo "<td>ID автора  <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='> </td>";
    echo "<td>Имя автора  <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='> </td>";
    echo "<td>Кол-во статей  <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='> </td>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($itemIds as $key => $valueid) {

      //dump($value,0,'Кол-во статей в месяц');

      $queryauthorss = "SELECT COUNT(id)"
      ." FROM " . ZOO_TABLE_ITEM
      ." WHERE created_by = '".$valueid."' AND publish_up BETWEEN '".$year."-".$month."-01 00:00:00' AND '".$year."-".$month."-31 23:59:59'";

      $idadd++;
      $Arrayauthorsscount = array($app->table->tag->database->queryResultArray($queryauthorss));


      foreach ($Arrayauthorsscount as $keynum) {

        foreach ($keynum as $keynumart) {

          $user = JFactory::getUser($valueid);
          $username = $user->name;

          if ($username) {
            if ($keynumart != '0') {


              echo "<tr>";
              echo "<td>".$idadd."</td>";
              // echo "<td>".$valueid."</td>";
              //  echo "<td>".$username."</td>";
              echo '<td><form style="display:none"  action="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" name="a'.$valueid.'" method="post" >';
              echo  $authcreatedx[] = '
              <input  type="hidden" name="authorids"  value="'.$valueid.'" />
              <input  type="hidden" name="monthdate"  value="'.$year.'-'.$month.'" />
              </form> <a class="test-submit" href="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" OnClick="a'.$valueid.'.submit();return false;">'.$username.'</a></td>';
              echo "<td>".$keynumart."</td>";
              echo "</tr>";

            }
          }
        }
      }

    }
    echo "</tbody>";
    echo "</table>";


    ?>

  </div>
</div>
