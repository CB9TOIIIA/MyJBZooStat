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
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/autors.css');

$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/jquery.dataTables.min.css');

$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/jquery.dataTables.min.js');
//JUST DO IT   $this->app   ----> $app

echo '
<script type="text/javascript">
jQuery(document).ready(function($) {
$("#myTable").DataTable({language:{url:"/administrator/components/com_myjbzoostat/assets/js/Russian.json"}});
});
</script>';

?>


<div class="item-page">

  <?php
  if (empty($TypeAuthors)):

    if ($csshack == 'yes') {
    echo "<style>div#system-message-container {display:none;}</style>";
    }

    $queryauthors = "SELECT created_by"
    ." FROM " . ZOO_TABLE_ITEM;

      $AuthorsNoType = count(array_unique($app->table->tag->database->queryResultArray($queryauthors)));
      $Arrayauthors = array_unique($app->table->tag->database->queryResultArray($queryauthors));
      ksort($Arrayauthors);

      echo '<big><big>Всего авторов: <b>'.$AuthorsNoType.'</b></big></big>';

        echo "<br>";

        $querynameauth = $db->getQuery(true);


          $querynameauth = "SELECT created_by"
          ." FROM " . ZOO_TABLE_ITEM;

        $db->setQuery($querynameauth);
        //dump($itemIdsResultnameauth,1,'tagsArrayauthors');
        $itemIdsResultnameauth = array_unique($app->table->tag->database->queryResultArray($querynameauth));

        echo "<div class='tagsstat'>";
        echo "<ul class='zebra'>";
        foreach ($itemIdsResultnameauth as $created_byas  ) {
          // dump($created_byas,1,'tagsArrayauthors');

          $created_bycreated = $created_byas;

          $user = JFactory::getUser($created_bycreated);
          $valueid = $created_bycreated;

          if ($user->name !== NULL) {

            $bignamau = $user->name;

          }

          $monthdate = date("Y-m");
          echo '<li><form style="display:none"  action="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" name="a'.$created_bycreated.'" method="post" >';
          echo  $authcreatedx[] = '
          <input  type="hidden" name="authorids"  value="'.$created_bycreated.'" />
          <input  type="hidden" name="monthdate"  value="'.$monthdate.'" />

          </form> <a class="test-submit" href="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" OnClick="a'.$created_bycreated.'.submit();return false;">'.$bignamau.'</a> </li>';
          //   echo  $itemIdsResultnameauth[] = '<option value="'.$created_by.'">'.$name.'</option>';

        }
        echo "</ul>";
        echo "</div>";


endif;

  if (!empty($TypeAuthors)):


    $queryauthors = "SELECT created_by"
    ." FROM " . ZOO_TABLE_ITEM
    ." WHERE type = '".$TypeAuthors."'";

  $Arrayauthorscount = count($app->table->tag->database->queryResultArray($queryauthors));
  $Arrayauthors = array_unique($app->table->tag->database->queryResultArray($queryauthors));
  ksort($Arrayauthors);

  echo '<big><big>Всего авторов: <b>'.$Arrayauthorscount.'</b></big></big>';
  echo "<br>";

  echo "<br>";


  $querynameauth = $db->getQuery(true);


    $querynameauth = "SELECT  created_by, name"
    ." FROM " . ZOO_TABLE_ITEM
    ." WHERE type = '".$TypeAuthors."'";



  $db->setQuery($querynameauth);
  $itemIdsResultnameauth = $db->loadObjectList();

  //dump($itemIdsResultnameauth,1,'tagsArrayauthors');

  echo "<table id='myTable' class='zebratable'>";
  echo "<thead>";
  echo "<tr class='upper'>";
  echo "<td>ID <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
  echo "<td>Имя автора <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABmUlEQVQ4T6WTPUgcURDHZ2bX7w+0VLCwFPQu4e27AxvPpLIQrQWtBFNoZ2NiJxj7NFGsBC2vsNFC9JLO213Wvc7OQrRUBA3q2xlZYWEjZj3M697Mm9/M/OcNwn8eTMeXSiX76ub2lxCu17zqVto3WCzmLJHFsFqdSdv/AiilGgzSgyB8rbnu9+ShUqrnUeAUiToIaS1wj5cS35uAONggHYJwPyA1AYAIwrckQSbgOVjoiIF7iHAHAL8A8zYQTQnIcs3zVjMBecfZY5Zhy6IxBhhBgdXb66vm9q6uDQGcJoTRTMCg1n3E3Fvz/eOc1ksxwBZu9H0/yms9Gbpu+U0NErFeAB7rFrEuwAfHmTjxvF2llJ0eY95xChRF50EQXPyzgpzWn1HgAAA2zJ+7Bbul9T7+BxZixZhonyz6HbrueGYLea1XQGBZIthEC2YB5CezTBHQJYn5lFlB0mMCie8ifI9CZ0lwbKtLxI+Fwg9mmWfhG5t5IM5cl4jp5RhSqkzGrIRhGKTtOacwgyxz3Z1tI5VKxbw6xvds9hPRaxT6nhWaoAAAAABJRU5ErkJggg=='></td>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  $myautp = 0;
  foreach ($itemIdsResultnameauth as $created_byas  ) {
    // dump($created_byas,1,'tagsArrayauthors');
    $created_bycreated = $created_byas->created_by;
    $created_byname = $created_byas->name;
    $myautp++;
    $monthdate = date("Y-m");
    echo '<tr><td>'.$myautp.'</td><td>
    <form style="display:none"  action="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" name="a'.$created_bycreated.'" method="post" >';
    echo  $authcreatedx[] = '
    <input  type="hidden" name="authorids"  value="'.$created_bycreated.'" />
    <input  type="hidden" name="monthdate"  value="'.$monthdate.'" />


    </form><a class="test-submit" href="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" OnClick="a'.$created_bycreated.'.submit();return false;">'.$created_byname.'</a></td></tr>';
    //   echo  $itemIdsResultnameauth[] = '<option value="'.$created_by.'">'.$name.'</option>';

  }
  echo "</tbody>";
echo "</table>";

endif;

  ?>


</div>
