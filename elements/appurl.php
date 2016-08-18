<?php
defined('_JEXEC') or die();
jimport('joomla.form.formfield');

class JFormFieldAppUrl extends JFormField
{
    public $type = 'AppUrl';

    protected function getInput()
    {
        $html = '<a target="_blank" href="https://oauth.yandex.ru/client/new">https://oauth.yandex.ru/client/new</a>';
        return $html;
    }
}
