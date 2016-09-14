<div class="project-header">
    <div class="dropdown-component">
      <div class="dropdown">
          <a href="#" class="dropdown-menu action-menu"><?= t('Menu') ?> <i class="fa fa-caret-down"></i></a>
          <ul>
              <li>
                  <span class="filter-display-mode" <?= $bigboarddisplaymode ? '' : 'style="display: none;"' ?>>
                      <i class="fa fa-expand fa-fw"></i>
                      <?= $this->url->link(t('Expand tasks'), 'Bigboard', 'expandAll', array('plugin' => 'Bigboard'), false, 'board-display-mode', t('Keyboard shortcut: "%s"', 's')) ?>
                  </span>
                  <span class="filter-display-mode" <?= $bigboarddisplaymode ? 'style="display: none;"' : '' ?>>
                      <i class="fa fa-compress fa-fw"></i>
                      <?= $this->url->link(t('Collapse tasks'), 'Bigboard', 'collapseAll', array('plugin' => 'Bigboard'), false, 'board-display-mode', t('Keyboard shortcut: "%s"', 's')) ?>
                  </span>
              </li>
              <li>
                  <span class="filter-compact">
                      <i class="fa fa-th fa-fw"></i> <a href="#" class="filter-toggle-scrolling" title="<?= t('Keyboard shortcut: "%s"', 'c') ?>"><?= t('Compact view') ?></a>
                  </span>
                  <span class="filter-wide" style="display: none">
                      <i class="fa fa-arrows-h fa-fw"></i> <a href="#" class="filter-toggle-scrolling" title="<?= t('Keyboard shortcut: "%s"', 'c') ?>"><?= t('Horizontal scrolling') ?></a>
                  </span>
              </li>

              <li>
                  <i class="fa fa-folder fa-fw" aria-hidden="true"></i>
                  <?= $this->url->link(t('Manage projects'), 'ProjectListController', 'show') ?>
              </li>
          </ul>
      </div>
  </div>
</div>
