<?php

namespace Kanboard\Plugin\Bigboard;

use DateTime;
use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Core\Security\Role;

class Plugin extends Base
{
    public function initialize()
    {
      $this->template->hook->attach('template:project-list:menu:before', 'bigboard:Bigboard');
      $this->template->setTemplateOverride('board/table_container','bigboard:board/table_container');
      $this->template->setTemplateOverride('board/table_tasks','bigboard:board/table_tasks');
      $this->template->setTemplateOverride('board/table_private','bigboard:board/table_private');
      $this->hook->on('template:layout:js', array('template' => 'plugins/Bigboard/Asset/js/BoardDragAndDrop.js'));
      $this->hook->on('template:layout:js', array('template' => 'plugins/Bigboard/Asset/js/BoardPolling.js'));      
    }

    public function getClasses()
    {
      return array(
        'Plugin\Bigboard' => array(
          'UserSession'
        ),
        'Plugin\Bigboard\Controller' => array(
          'Bigboard',
          'BoardAjaxController'
        )
      );
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'Bigboard';
    }

    public function getPluginDescription()
    {
        return t('Kanboard that displays multiple projects');
    }

    public function getPluginAuthor()
    {
        return 'Thomas Stinner';
    }

    public function getPluginVersion()
    {
        return '1.0.5';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/stinnux/kanboard-bigboard';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.4';
    }

}
