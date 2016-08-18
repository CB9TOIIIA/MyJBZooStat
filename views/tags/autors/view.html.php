<?php
defined( '_JEXEC' ) or die; // No direct access

/**
 * View for  current element
 * @author CB9TOIIIA
 */



class MyjbzoostatViewAutors extends JViewLegacy
{

	public function display( $tpl = null )
	{
		$this->_setToolBar();
		parent::display( $tpl );
	}
	/**
     * Method to display the toolbar
     */
    protected function _setToolBar()
    {
        JToolBarHelper::title( JText::_( 'Статистика тегов' ) );
				JToolbarHelper::divider();

$bar = JToolBar::getInstance('toolbar'); //ссылка на объект JToolBar
$title = JText::_('Статьи'); //Надпись на кнопке
$dhtml = "<a href=\"/administrator/index.php?option=com_myjbzoostat&view=articles\" class=\"btn btn-small\"><i class=\"icon-list\" title=\"$title\"></i>$title</a>"; //HTML нашей кнопки
$bar->appendButton('Custom', $dhtml, 'list');//давляем ее на тулбар

JToolBarHelper::divider();

$bar = JToolBar::getInstance('toolbar'); //ссылка на объект JToolBar
$title = JText::_('Авторы'); //Надпись на кнопке
$dhtml = "<a href=\"/administrator/index.php?option=com_myjbzoostat&view=autors\" class=\"btn btn-small\"><i class=\"icon-tags\" title=\"$title\"></i>$title</a>"; //HTML нашей кнопки
$bar->appendButton('Custom', $dhtml, 'list');//давляем ее на тулбар


    }

}
