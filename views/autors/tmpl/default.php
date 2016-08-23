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
$document->addStyleSheet(JUri::root().'administrator/components/com_myjbzoostat/assets/css/autors.css');
//JUST DO IT   $this->app   ----> $app
 ?>
 <style>
 </style>

<div class="item-page">

<?php

$db     = JFactory::getDBO();

$appId  = 1;
		//	$author = $this->_item->created_by_alias;
		//	$user   = $app->user->get($this->item->created_by);
	//		$authorid = $user->id;
	//		$authorname = $user->name;


			$authorid = '501';  //gwinplane
			$authorname = 'gwinplane';
	//	 dump($authorid,0,'Массив');

//	$queryauthors = $db->getQuery(true);

			$queryauthors = "SELECT created_by"
			    ." FROM " . ZOO_TABLE_ITEM
			    ." WHERE type = 'authors'";

			$Arrayauthorscount = count($app->table->tag->database->queryResultArray($queryauthors));
			$Arrayauthors = array_unique($app->table->tag->database->queryResultArray($queryauthors));
			ksort($Arrayauthors);

//SIMPLE FIX
// $tagsArrayauthors = array('75,77,501');
//	 dump($tagsArrayauthors,0,'tagsArrayauthors');

//$tagsArrayauthors - id авторов из типа авторы

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
