<?php

namespace Kanboard\Plugin\Bigboard;

use DateTime;
use Kanboard\Core\Translator;
use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Security\Role;

class Plugin extends Base
{
    public function initialize()
    {
      $this->template->hook->attach('template:project-list:menu:before', 'bigboard:Bigboard');
    }

    public function getClasses()
    {
      return array(
        'Plugin\Bigboard' => array(
          'UserSession'
        ),
        'Plugin\Bigboard\Controller' => array(
          'Bigboard'
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
        return '0.0.1';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/stinnux/kanboard-bigboard';
    }
}
