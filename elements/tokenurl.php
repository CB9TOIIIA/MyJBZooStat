<?php
defined('_JEXEC') or die();
jimport('joomla.form.formfield');

class JFormFieldTokenUrl extends JFormField
{
    public $type = 'TokenUrl';
    protected function getInput()
    {

        $component = JComponentHelper::getComponent('com_myjbzoostat');
        $params = json_decode($component->params);
        $app_id = isset($params->app_id) ? (string)$params->app_id : '';
        // dump($method,0,'$method');


        if(empty($app_id))
        {
            $html = 'Создайте приложение, вставтье его ID в поле "ID приложения" и сохраните настройки.';
        }
        else
        {
            $html = '<a target="_blank" href="https://oauth.yandex.ru/authorize?response_type=token&client_id='.$app_id.'">https://oauth.yandex.ru/authorize?response_type=token&client_id='.$app_id.'</a>';
        }

        return $html;
    }
}

class JFormFieldDisqusUrl extends JFormField
{
    public $type = 'DisqusUrl';
    protected function getInput()
    {

      $component = JComponentHelper::getComponent('com_myjbzoostat');
      $params = json_decode($component->params);
      $disqus_url = isset($params->disqus_url) ? (string)$params->disqus_url : '';
      // dump($method,0,'$method');

      if(empty($disqus_url))
      {
        $html = 'Создайте приложение <a target="_blank" href="https://disqus.com/api/applications/">https://disqus.com/api/applications/</a>';
      }

      return $html;
    }
}
