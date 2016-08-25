<?php
/** @var $this MyjbzoostatViewAutors */
defined( '_JEXEC' ) or die; // No direct access
?>
<?php
require_once JPATH_ADMINISTRATOR . '/components/com_myjbzoostat/elements/paramsetc.php';
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/autors.css');
//JUST DO IT   $this->app   ----> $app
 ?>
 <style>
 </style>

<div class="item-page">

<?php

$db     = JFactory::getDBO();

if (!empty($TypeAuthors)) {
  $queryauthors = "SELECT created_by"
      ." FROM " . ZOO_TABLE_ITEM
    	." WHERE type = '".$TypeAuthors."'";
}
else {
  $queryauthors = "SELECT created_by"
      ." FROM " . ZOO_TABLE_ITEM;
}

			$Arrayauthorscount = count($app->table->tag->database->queryResultArray($queryauthors));
			$Arrayauthors = array_unique($app->table->tag->database->queryResultArray($queryauthors));
			ksort($Arrayauthors);

echo '<big><big>Всего авторов: <b>'.$Arrayauthorscount.'</b></big></big>';
echo "<br>";

echo "<br>";


$querynameauth = $db->getQuery(true);

		$querynameauth = "SELECT created_by, name"
		." FROM " . ZOO_TABLE_ITEM
		." WHERE type = 'authors'";



$db->setQuery($querynameauth);
$itemIdsResultnameauth = $db->loadObjectList();

//dump($itemIdsResultnameauth,1,'tagsArrayauthors');

echo "<div class='tagsstat'>";
echo "<ul class='zebra'>";
 foreach ($itemIdsResultnameauth as $created_byas  ) {
// dump($created_byas,1,'tagsArrayauthors');
$created_bycreated = $created_byas->created_by;
$created_byname = $created_byas->name;
$monthdate = date("Y-m");
echo '<li><form style="display:none"  action="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" name="a'.$created_bycreated.'" method="post" >';
 echo  $authcreatedx[] = '
 <input  type="hidden" name="authorids"  value="'.$created_bycreated.'" />
 <input  type="hidden" name="monthdate"  value="'.$monthdate.'" />



 </form> <a class="test-submit" href="/administrator/index.php?option=com_myjbzoostat&view=auhorsprofile" OnClick="a'.$created_bycreated.'.submit();return false;">'.$created_byname.'</a> </li>';
  //   echo  $itemIdsResultnameauth[] = '<option value="'.$created_by.'">'.$name.'</option>';

 }
 echo "</ul>";
 echo "</div>";

 ?>


</div>
