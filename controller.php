<?php
defined( '_JEXEC' ) or die; // No direct access

/**
 * Default Controller
 * @author CB9TOIIIA
 */
class MyjbzoostatController extends JControllerLegacy
{

	/**
	 * Method to display a view.
	 * @param bool $cachable
	 * @param array $urlparams
	 * @return JControllerLegacy
	 */
	function display( $cachable = false, $urlparams = array() )
	{
		$this->default_view = 'index';
		parent::display( $cachable, $urlparams );
		return $this;
	}

	/**
	 * Call AJAX method
	 * @throws Exception
	 */
	public function getAjax()
	{
		$input = JFactory::getApplication()->input;
		$model = $this->getModel( 'ajax' );
		$action = $input->getCmd( 'action' );
		$reflection = new ReflectionClass( $model );
		$methods = $reflection->getMethods( ReflectionMethod::IS_PUBLIC );
		$methodList = array();
		foreach ( $methods as $method ) {
			$methodList[] = $method->name;
		}
		if ( in_array( $action, $methodList ) ) {
			$model->$action();
		}
		exit;
	}


}
