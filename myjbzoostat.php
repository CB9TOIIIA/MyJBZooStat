<?php
defined( '_JEXEC' ) or die; // No direct access
/**
 * Component myjbzoostat
 * @author CB9TOIIIA
 */
$mainframe = JFactory::getApplication();
$namecomponent = $mainframe->scope;
$namecomponent = str_replace('com_','',$namecomponent);
require_once JPATH_COMPONENT.'/helpers/'.$namecomponent.'.php';
$controller = JControllerLegacy::getInstance( $namecomponent );
$controller->execute( JFactory::getApplication()->input->get( 'task' ) );
$controller->redirect();
