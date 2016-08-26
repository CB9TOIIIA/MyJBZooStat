<?php
defined( '_JEXEC' ) or die; // No direct access
/**
 * Component myjbzoostat
 * @author CB9TOIIIA
 */

require_once JPATH_COMPONENT.'/helpers/myjbzoostat.php';
$controller = JControllerLegacy::getInstance('myjbzoostat');
$controller->execute( JFactory::getApplication()->input->get( 'task' ) );
$controller->redirect();
