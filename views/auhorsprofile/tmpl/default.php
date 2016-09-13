<?php
/** @var $this MyjbzoostatViewAutors */
defined( '_JEXEC' ) or die; // No direct access
?>
<?php
require_once JPATH_ADMINISTRATOR . '/components/com_myjbzoostat/elements/paramsetc.php';

$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/auhorsprofile.css');
$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/sort.js');
$document->addScript(JUri::root().'administrator/components/com_myjbzoostat/assets/js/chart.js');
//JUST DO IT   $this->app   ----> $app
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
  $("#myTable").tablesorter({});
});
</script>

<script type="text/javascript">
jQuery(document).ready(function($) {
  $("#myTable2").tablesorter({});
});
</script>


<div class="item-page">

  <?php

  if ($csshack == 'yes') {
  echo "<style>div#system-message-container {display:none;}</style>";
  }


  echo "<script src='//yastatic.net/es5-shims/0.0.2/es5-shims.min.js'></script> <script type='text/javascript' src='//yastatic.net/share2/share.js'></script>";
  if (!empty($disqusApiShort)) :   echo "<script id='dsq-count-scr' src='//{$disqusApiShort}.disqus.com/count.js' async></script>"; endif;

  ?>


  <?php


  function rdate($param, $time=0) {
    if(intval($time)==0)$time=time();
    $MonthNames=array("январь", "февраль", "март", "апрель", "май", "июнь", "июль", "август", "сентябрь", "октябрь", "ноябрь", "декабрь");
    if(strpos($param,'M')===false) return date($param, $time);
    else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
  }


    if ((empty($TypeAuthors))) :

            $queryauthors = "SELECT created_by"
            ." FROM " . ZOO_TABLE_ITEM;

              $AuthorsNoType = count(array_unique($app->table->tag->database->queryResultArray($queryauthors)));
              $Arrayauthors = array_unique($app->table->tag->database->queryResultArray($queryauthors));
              ksort($Arrayauthors);

              echo '<big class="mono">Всего авторов: <b>'.$AuthorsNoType.'</b></big>';

                echo "<br>";

                $querynameauth = $db->getQuery(true);


      $querynameauth = "SELECT created_by"
      ." FROM " . ZOO_TABLE_ITEM;

    $db->setQuery($querynameauth);
    //dump($itemIdsResultnameauth,1,'tagsArrayauthors');
    $itemIdsResultnameauth = array_unique($app->table->tag->database->queryResultArray($querynameauth));

        echo "<div class='formnameatu'>";
      echo '<form action="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" method="post" class="form-inline">';

      echo "<input type='hidden' name='monthdate' value='".$monthdate."'>";
      echo '<select class="" name="authorids">';


      foreach ($itemIdsResultnameauth as $created_byas  ) {

        $created_bycreated = $created_byas;

        $user = JFactory::getUser($created_bycreated);
        $valueid = $created_bycreated;
        if ($user->name !== NULL) {
          $bignameIn = $user->name;
        }

        if ($created_bycreated == $authorid) {
          if ($user->name !== NULL) {
                    $bigname = $user->name;
                  }
          echo  $authcreatedx[] = '<option selected value="'.$created_bycreated.'">'.$bignameIn.'</option>';
        }
        else {
          echo  $authcreatedx[] = '<option value="'.$created_bycreated.'">'.$bignameIn.'</option>';
        }

        //   echo  $itemIdsResultnameauth[] = '<option value="'.$created_by.'">'.$name.'</option>';
      }

      echo '</select> <input type="submit"  class="btn" value="Поиск"></form>';
      echo '</div>';

endif;


  if (!empty($TypeAuthors)) :


    $queryauthors = "SELECT created_by"
    ." FROM " . ZOO_TABLE_ITEM
    ." WHERE type = '".$TypeAuthors."'";


  $Arrayauthorscount = count($app->table->tag->database->queryResultArray($queryauthors));
  $Arrayauthors = array_unique($app->table->tag->database->queryResultArray($queryauthors));
  ksort($Arrayauthors);



  $querynameauth = $db->getQuery(true);



    $querynameauth = "SELECT created_by, name"
    ." FROM " . ZOO_TABLE_ITEM
    ." WHERE type = '".$TypeAuthors."'";


  $db->setQuery($querynameauth);
  $itemIdsResultnameauth = $db->loadObjectList();

  //jbdump($itemIdsResultnameauth,1,'tagsArrayauthors');
  echo "<div class='formnameatu'>";
  echo '<form action="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" method="post" class="form-inline">';

  echo "<input type='hidden' name='monthdate' value='".$monthdate."'>";
  echo '<select class="" name="authorids">';


  foreach ($itemIdsResultnameauth as $created_byas  ) {
    // jbdump($created_byas,1,'tagsArrayauthors');
    $created_bycreated = $created_byas->created_by;
    $created_byname = $created_byas->name;
    if ($created_bycreated == $authorid) {
      echo  $authcreatedx[] = '<option selected value="'.$created_bycreated.'">'.$created_byname.'</option>';
    }
    else {
      echo  $authcreatedx[] = '<option value="'.$created_bycreated.'">'.$created_byname.'</option>';
    }

    //   echo  $itemIdsResultnameauth[] = '<option value="'.$created_by.'">'.$name.'</option>';
  }
  echo '</select> <input type="submit"  class="btn" value="Поиск"></form>';
  echo '</div>';
  echo '</div>';


  $user = JFactory::getUser($authorid);
  $bigname = $user->name;

  echo "<div class='tagsstat'>";
  echo "</div>";


endif;

  //jbdump($itemIdsResult,0,'Массив');

// if (empty($authorid)) {
//   $user = JFactory::getUser();
//   $authorid = $user->id;
// }

  $querys = $db->getQuery(true);
  $querys
  ->select($db->quoteName('publish_up'))
  ->from($db->quoteName(ZOO_TABLE_ITEM))
  ->where($db->quoteName('created_by') . ' = ' . $db->quote($authorid))
  ->order('publish_up DESC');


  $db->setQuery($querys);
  $itemIdsResultsdate = $db->loadObjectList();


  $itemIdsdate = array();
  foreach ($itemIdsResultsdate as $itdate) {

    $itemIdsdate[] = date("m.Y", strtotime("+0 seconds", strtotime($itdate->publish_up)));

  }

  $datearraydate = array_count_values($itemIdsdate);

  $countarticlesauthor = count($itemIdsResultsdate);
  //fix count (1 articles = author)
  $countarticlesauthor = $countarticlesauthor - 1;


  $querystat = $db->getQuery(true);
  $querystat
  ->select($db->quoteName('id'))
  ->from($db->quoteName(ZOO_TABLE_ITEM))
  ->where($db->quoteName('created_by') . ' = ' . $db->quote($authorid));


  $db->setQuery($querystat);
  $itemIdsResult = $db->loadObjectList();



  $itemIds = array();
  foreach ($itemIdsResult as $it) {

    $itemIds[] = $it->id;
  }



  // $querystatmonth = "SELECT id,name,publish_up"
  //          ." FROM " . ZOO_TABLE_ITEM
  //          ." WHERE publish_up BETWEEN '".$monthdate."-01' AND  '".$monthdate."-31' AND created_by = '".$authorid."' ";
  //
  // $Arrayquerymonth = array($app->table->tag->database->queryResultArray($querystatmonth));
  //



  $querystatmonth = $db->getQuery(true);
  $querystatmonth
  ->select($db->quoteName('id'))
  ->from($db->quoteName(ZOO_TABLE_ITEM))
  ->where($db->quoteName('publish_up') . ' BETWEEN "' .$monthdate.'-01 00:00:00' . '" AND "' .$monthdate.'-31 23:59:59"')
  ->where($db->quoteName('created_by') . ' = ' . $db->quote($authorid));

  $db->setQuery($querystatmonth);

  $Arrayquerymonth = $db->loadObjectList();

  $itemIdsmonth = array();
  foreach ($Arrayquerymonth as $itmonth) {

    $itemIdsmonth[] = $itmonth->id;
  }

  // jbdump($itemIdsmonth,0,'Массив статей');

  //  $querymonth = "SELECT id"
  //      ." FROM " . ZOO_TABLE_ITEM
  //      ." WHERE publish_up BETWEEN '".$monthdate."-01' AND  '".$monthdate."-31'
  //      AND created_by = '".$authorid."'";
  //
  //  $querymonthcount = "SELECT COUNT(id)"
  //      ." FROM " . ZOO_TABLE_ITEM
  //      ." WHERE publish_up BETWEEN '".$monthdate."-01' AND  '".$monthdate."-31'
  //      AND created_by = '".$authorid."'";



  $query = "SELECT name"
  ." FROM " . ZOO_TABLE_TAG
  ." WHERE item_id IN (" . implode(', ', $itemIds) . ")";


  $tagsArraycounttags = array_count_values($app->table->tag->database->queryResultArray($query));
  $tagsArrayztags = array_unique($app->table->tag->database->queryResultArray($query));
  ksort($tagsArraycounttags);
  asort($tagsArrayztags);

  $currentTags = array();
  $valtags = array();

  if ($itemIdsmonth) {



    $querymonthtag = "SELECT name"
    ." FROM " . ZOO_TABLE_TAG
    ." WHERE item_id IN (" . implode(', ', $itemIdsmonth) . ")";


    $tagsArraycounttagsmonthtag = array_count_values($app->table->tag->database->queryResultArray($querymonthtag));
    $tagsArrayztagsquerymonthtag = array_unique($app->table->tag->database->queryResultArray($querymonthtag));
    ksort($tagsArraycounttagsmonthtag);
    asort($tagsArrayztagsquerymonthtag);


  }


  // $querysautiidtop10 = "SELECT id,name"
  // ." FROM " . ZOO_TABLE_ITEM
  // ." WHERE (created_by = ".$authorid.")"
  // ." ORDER BY id DESC LIMIT 5";
  //
  // $Arrayutiidtop10 = array($app->table->tag->database->queryResultArray($querysautiidtop10));



  if ($countarticlesauthor != '0') :


    foreach ($datearraydate as $keynumdate => $valuedaten) {
      //jbdump($keynumdate,0,'Месяцы');

    }


    foreach ($itemIdsResultsdate as $itdate) {

      $itemIdsdatemonth[] = date("Y-m", strtotime("+0 seconds", strtotime($itdate->publish_up)));

    }

    foreach ($itemIdsResultsdate as $itdate) {

      $itemIdsdatemonthrdate[] = rdate("m-Y", strtotime("+0 seconds", strtotime($itdate->publish_up)));

    }


    $querymonth = $db->getQuery(true);
    //  $querymonth = "SELECT id"
    //      ." FROM " . ZOO_TABLE_ITEM
    //      ." WHERE publish_up > LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) + INTERVAL 1 DAY AND `publish_up` < DATE_ADD(LAST_DAY(CURDATE() - INTERVAL 0 MONTH), INTERVAL 1 DAY)
    //      AND created_by = ".$authorid."";


    //  jbdump($datearraydatemonthdate,0,'$itemIdsdatemonthrdate');
    //  jbdump($datearraydatemonthdate,0,'$itemIdsdatemonthrdate');


    $datearraydatemonth = array_count_values($itemIdsdatemonth);
    $datearraydatemonthas = array_count_values($itemIdsdatemonthrdate);

    //jbdump($datearraydatemonthas,0,'$itemIdsdatemonthrdate');
    //jbdump($datearraydatemonthas,0,'$datearraydatemonthas');


    echo '<div class="monthdate">';
    echo '<form action="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" method="post" class="form-inline">';

    echo "<input type='hidden' name='authorids' value='".$authorid."'>";

    echo '<select class="month" name="monthdate">';



    foreach ($datearraydatemonth as $keytosqlmonth => $valmonthno) {

      $keytosqlmonthas =  date("m.Y", strtotime("+0 seconds", strtotime($keytosqlmonth)));

      if ($keytosqlmonth == $monthdate) {
        echo  $keytosqlmonthsd[] = '<option selected value="'.$keytosqlmonth.'">'.$keytosqlmonthas.'</option>';
      }
      else {
        echo  $keytosqlmonthsd[] = '<option value="'.$keytosqlmonth.'">'.$keytosqlmonthas.'</option>';
      }

    }

    echo '</select> <input type="submit"  class="btn" value="Поиск по месяцам"></form>';
    echo '</div>';


    echo "<hr>";
    echo '<h1>'.$bigname.'</h1>';

    echo "<p class='countarticlesauthor'><big><big>Всего ".$StatOrProduct." автора: <b>".$countarticlesauthor."</big></big></b></p>";
//fix last day month
    $querymonth = "SELECT id"
    ." FROM " . ZOO_TABLE_ITEM
    ." WHERE type = '".$TypeArticleorProduct."'  AND  publish_up BETWEEN '".$monthdate."-01 00:00:00' AND  '".$monthdate."-31 23:59:59'
    AND created_by = '".$authorid."'";

    $querymonthcount = "SELECT COUNT(id)"
    ." FROM " . ZOO_TABLE_ITEM
    ." WHERE publish_up BETWEEN '".$monthdate."-01 00:00:00' AND  '".$monthdate."-31 23:59:59'
    AND created_by = '".$authorid."'";

    $Arrayquerymonth = array($app->table->tag->database->queryResultArray($querymonth));
    $Arrayquerymonthcccooount = array_count_values($app->table->tag->database->queryResultArray($querymonthcount));
    $Arrayquerymonthcountv = array_count_values($app->table->tag->database->queryResultArray($querymonth));

    foreach ($Arrayquerymonthcccooount as $keymonthcountv => $novamcount) {
      //   jbdump($keymonthcountv,0,'Месяцы');
    }

    foreach ($Arrayquerymonth as $keymoth => $valuenoth) {

      foreach ($valuenoth as $monthiteid  ) {
        $monthitem = $app->table->item->get($monthiteid);
        $alipublish_up   = $monthitem->publish_up;
        $alipublish_upformat = rdate("M", strtotime("+0 seconds", strtotime($alipublish_up)));
      }
    }

    if (!empty($valuenoth)) :
      echo "<hr>";
      echo "<p><b><big>".$StatOrProduct." за <u>{$alipublish_upformat}</u> ({$keymonthcountv}): </big></b></p>";
      echo "<table id='myTable' class='zebratable'>";
      echo "<thead>";
      echo "<tr class='upper'>";
      echo "<td>№ </td>";
      echo "<td>ID</td>";
      echo "<td>Дата</td>";
      echo "<td>Название</td>";
      echo "<td>Популярность</td>";
if (!empty($disqusApiShort)) :       echo "<td>Комментариев</td>"; endif;
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";

      $tablecount = '0';
      foreach ($Arrayquerymonth as $monthitemarray  ) {
        foreach ($monthitemarray as $monthiteid  ) {

          $monthitem = $app->table->item->get($monthiteid);
          //  jbdump($monthitem,0,'Месяцы');
          $myurltosite = JRoute::_($app->jbrouter->externalItem($monthitem, false), false, 2);
          // dump($myurltosite,0,'$myurltosite');
          $aliasart  = $monthitem->alias;
          $aliasartitem  = 'item/'.$aliasart;
          $alipublish_up   = $monthitem->publish_up;
          $alipublish_upformat = date("d.m.Y", strtotime("+0 seconds", strtotime($alipublish_up)));
          $aliname  = $monthitem->name;
          $aliid   = $monthitem->id;
          $tablecount++;

          // jbdump($monthitem,0,'$itemautinfo статей');
          // jbdump($aliasart,0,'$itemUrl');
          echo "<tr>";
          echo "<td>".$tablecount."</td>";
          echo "<td>".$aliid."</td>";
          echo "<td>".$alipublish_upformat."</td>";
          echo "<td><a target='_blank' href='{$myurltosite}'>".$aliname."</a></td>";

          if ($keymonthcountv > '100') {
            echo "<td>Счетчики отключены (>100)</td>";
          }
          else {
            echo "<td><div class='ya-share2' data-services='vkontakte,facebook,odnoklassniki,moimir,gplus' data-url='{$myurltosite}'  data-size='m' data-counter=''></div></td>";

          }

  if (!empty($disqusApiShort)) :  echo "<td><span class='disqus-comment-count' data-disqus-url='{$myurltosite}'></span></td>"; endif;
          echo "</tr>";

        }
      }


      echo "</tbody>";
      echo "</table>";


    endif;
    if (empty($valuenoth)) :
      $monthdate = rdate("M", strtotime("+0 seconds", strtotime($monthdate)));
      echo "<p>Пожалуйста выберите период для отображения ".$StatOrProduct.", т.к. за <u>{$monthdate}</u> ".$StatOrProduct." нет. </p>";
    endif;

    // echo "<hr>";
    // echo "<p><b><big>Последние 5 статей автора: </big></b></p>";
    // echo "<table class='zebratable'>";
    // echo "<tr class='upper'>";
    // echo "<td>ID</td>";
    // echo "<td>Дата</td>";
    // echo "<td>Название</td>";
    // echo "<td>Популярность статьи</td>";
    // echo "<td>Комментариев</td>";
    // echo "</tr>";
    // foreach ($Arrayutiidtop10 as $utiidtop10  ) {
    //   foreach ($utiidtop10 as $utiidtop10arti) {
    //     $newItem = $app->table->item->get($utiidtop10arti);
    //     $myurltositesfd = JRoute::_($app->jbrouter->externalItem($newItem, false), false, 2);
    // //  dump($myurltosite,0,'$myurltosite');
    //     $aliasart  = $newItem->alias;
    //     $aliasartitem  = '/item/'.$aliasart;
    //     $alipublish_up   = $newItem->publish_up;
    //     $alipublish_upformat = date("d.m.Y", strtotime("+0 seconds", strtotime($alipublish_up)));
    //     $aliname  = $newItem->name;
    //     $aliid   = $newItem->id;
    //     // jbdump($newItem,0,'$itemautinfo статей');
    //     // jbdump($aliasart,0,'$itemUrl');
    //     echo "<tr>";
    //     echo "<td>".$aliid."</td>";
    //     echo "<td>".$alipublish_upformat."</td>";
    //     echo "<td><a target='_blank' href='{$myurltositesfd}'>".$aliname."</a></td>";
    //     echo "<td><div class='ya-share2' data-services='vkontakte,facebook,odnoklassniki,moimir,gplus' data-url='{$myurltositesfd}'  data-size='m' data-counter=''></div></td>";
    //     echo "<td><span class='disqus-comment-count' data-disqus-url='{$myurltositesfd}'></span></td>";
    //     echo "</tr>";
    //
    //   }
    // }
    //
    // echo "</table>";

    echo "<hr>";


    if (!empty($tagsArrayztagsquerymonthtag )) {

      echo "<h3>Теги за месяц: </h3>";


      echo "<table id='myTable2' class='zebratable'>";
      echo "<thead>";
      echo "<tr class='upper'>";
      echo "<td>№</td>";
      echo "<td>Название тега</td>";
      echo "<td>Кол-во</td>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";

      $mynumadd = 0;
      foreach ($tagsArraycounttagsmonthtag as $valtag => $value )  {

        //$valtags[] = '<a href="' . JRoute::_($app->route->tag($appId, $valtag)) . '">' . $valtag . '</a> - '. $value.', ';

        //echo  $valtags[] = '<li>'.$valtag. ' - '. $value.'</li>';
        $mynumadd++;

        $urlParams = [
          'e'          => [
            '_itemtag'    => $valtag,
            '_itemauthor' => $authorid,
          ],
          'order'      => [
            'field'   => 'corepublish_up',
            'reverse' => '1',
            'mode'    => 's'
          ],
          'logic'      => 'and',
          'exact'      => '1',
          'controller' => 'searchjbuniversal',
          'task'       => 'filter',
          'type'       => 'news',
          'app_id'     => '1',
        ];

        $url = $app->jbrouter->addParamsToUrl('/', $urlParams);
        // echo $valtags[] = "<li>  ()</li>";
        echo "<tr>";
        echo "<td>{$mynumadd}</td>";
        echo $valtags[] = "<td><a target='_blank' href=\"{$url}\">{$valtag}</a></td>";
        echo "<td>{$value}</td>";
        echo "</tr>";
        // echo  $valtags[] = '<li><a target="_blank" href="/?e[_itemtag]='.$valtag.'&amp;e[_itemauthor]='.$authorid.'&amp;order[field]=corepublish_up&amp;order[reverse]=1&order[mode]=s&logic=and&amp;send-form=Искать&amp;exact=1&amp;controller=searchjbuniversal&amp;task=filter&amp;type=news&amp;app_id=1">'.$valtag. '</a>   ('. $value.')</li>';

      }
      echo "</tbody>";
      echo "</table>";
      echo "<br>";echo "<br>";
      echo "</div>";
      echo "<hr>";

    }

    echo "<div class='allinfoabout'>";

    echo "<p><b><big>Статистика публикаций:</big></b> </p>";
    echo "<div class='tagsstat mounth'><ul class='zebra'>";

    foreach ($datearraydate as $valtagdate => $valuecount )  {

      echo  $datearraydate[] = '<li>'.$valtagdate. ' ('. $valuecount.')</li>';

    }
    echo "</ul></div>";

    // ksort($tagsArraycounttagsmonthtag);
    // asort($tagsArrayztagsquerymonthtag);

    // jbdump($tagsArraycounttagsmonthtag,0,'Месяцыфывфыв');
    // jbdump($tagsArrayztagsquerymonthtag,0,'Месяцыы');


    if (!empty($tagsArrayztags )) {
      echo "<hr>";
      echo "<h3>".$bigname." использует следующие теги (весь период):</h3>";


      echo "<div class='tagsstat tags'><ul class='zebra'>";


      foreach ($tagsArraycounttags as $valtag => $value )  {

        //$valtags[] = '<a href="' . JRoute::_($app->route->tag($appId, $valtag)) . '">' . $valtag . '</a> - '. $value.', ';

        //echo  $valtags[] = '<li>'.$valtag. ' - '. $value.'</li>';


        $urlParams = [
          'e'          => [
            '_itemtag'    => $valtag,
            '_itemauthor' => $authorid,
          ],
          'order'      => [
            'field'   => 'corepublish_up',
            'reverse' => '1',
            'mode'    => 's'
          ],
          'logic'      => 'and',
          'exact'      => '1',
          'controller' => 'searchjbuniversal',
          'task'       => 'filter',
          'type'       => 'news',
          'app_id'     => '1',
        ];

        $url = $app->jbrouter->addParamsToUrl('/', $urlParams);
        echo $valtags[] = "<li><a target='_blank' href=\"{$url}\">{$valtag}</a>   ({$value})</li>";

        // echo  $valtags[] = '<li><a target="_blank" href="/?e[_itemtag]='.$valtag.'&amp;e[_itemauthor]='.$authorid.'&amp;order[field]=corepublish_up&amp;order[reverse]=1&order[mode]=s&logic=and&amp;send-form=Искать&amp;exact=1&amp;controller=searchjbuniversal&amp;task=filter&amp;type=news&amp;app_id=1">'.$valtag. '</a>   ('. $value.')</li>';

      }
      echo "</ul></div>";

      echo "</div>";

    }

    endif;


?>


</div>
