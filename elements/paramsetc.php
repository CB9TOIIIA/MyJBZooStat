<?php
/** @var $this MyjbzoostatViewAutors */
defined( '_JEXEC' ) or die; // No direct access
?>
<?php

require_once JPATH_ADMINISTRATOR . '/components/com_zoo/config.php';
require_once JPATH_ROOT . '/media/zoo/applications/jbuniversal/framework/jbzoo.php';
require_once JPATH_ROOT . '/media/zoo/applications/jbuniversal/framework/classes/jbmodulehelper.php';
require_once JPATH_ROOT . '/media/zoo/applications/jbuniversal/framework/classes/jbtemplate.php';

$document = JFactory::getDocument();
$input = JFactory::getApplication()->input;
$db     = JFactory::getDBO();
$domainhttp = JURI::root();
$user   = JFactory::getUser();
$app = App::getInstance('zoo');
$component = JComponentHelper::getComponent('com_myjbzoostat');
$mainframe = JFactory::getApplication();
$namecomponent = $mainframe->scope;
$params = json_decode($component->params);
$comcontent = $params->comcontent;
$csshack = $params->csshack;
$filterpopular = $params->filterpopular;
$perpagepopular = $params->perpagepopular;
$threshold = $params->threshold;
$AppidZoo = $params->appidzoo;
$appId  = $AppidZoo;
$TypeAuthors = $params->typeauthors;
$method = $params->method;

$disqusApiPublic = $params->disqus_api_key;
$disqusApiSecret = $params->disqus_api_secret;
$disqusApiToken = $params->disqus_access_token;
$disqusApiShort = $params->disqus_api_short_name;
$disqusApplication = $params->disqus_api_app;

$authoridmy = $user->get('id');
$authorid = $input->get('authorids', $authoridmy, 'string');
$monthdate = $input->get('monthdate', date('Y-m'), 'string');


define('DISQUS_API_SHORT_NAME', $disqusApiShort);
define('DISQUS_API_KEY', $disqusApiPublic);
define('DISQUS_API_SECRET', $disqusApiSecret);
define('DISQUS_API_APP', $disqusApplication);
define('DISQUS_ACCESS_TOKEN', $disqusApiToken);
define('DISQUS_TTL', 60);
define('DEBUG_URL', 0);

define('URL_LIST_USAGE', 'https://disqus.com/api/3.0/applications/listUsage.json');
define('URL_FORUMS_LISTTHREADS', 'https://disqus.com/api/3.0/forums/listThreads.json');
define('URL_POSTS_LIST', 'https://disqus.com/api/3.0/posts/list.json');
define('URL_USERS_DETAILS', 'https://disqus.com/api/3.0/users/details.json');
define('URL_BLACKLISTS_LIST', 'https://disqus.com/api/3.0/blacklists/list.json?type=user&type=email&type=ip&type=domain');
define('URL_USERS_LISTPOSTS', 'https://disqus.com/api/3.0/users/listPosts.json');




?>
