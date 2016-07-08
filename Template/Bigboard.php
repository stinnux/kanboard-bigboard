<?php
    $routerController = $this->app->getRouterController();
    $routerPlugin = $this->app->getPluginName();

    $active = $routerController == 'Bigboard' && $routerPlugin == 'Bigboard';
?>
<li class="<?= $active ? 'active' : '' ?>">
    <i class="fa fa-th fa-fw"></i>
    <?= $this->url->link(
        'Bigboard',
        'Bigboard',
        'index',
        ['plugin' => 'Bigboard', ]
    ) ?>
</li>
