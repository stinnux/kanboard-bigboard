<div class="filter-box margin-bottom">
    <form method="get" action="<?= $this->url->dir() ?>" class="search">
        <?= $this->form->hidden('controller', array('controller' => 'Bigboard')) ?>
        <?= $this->form->hidden('action', array('action' => 'index')) ?>
        <?= $this->form->hidden('plugin', array('plugin' => 'Bigboard')) ?>
        <div class="input-addon">
            <?= $this->form->text('search', $values, array(), array(empty($values['search']) ? 'autofocus' : '', 'placeholder="'.t('Search').'"'), 'input-addon-field') ?>
            <div class="input-addon-item">
              <?= $this->render('app/filters_helper') ?>
            </div>
        </div>
    </form>
</div>
