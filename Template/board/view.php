<section id="main">

    <span class='header'><h1><?= $this->text->e($project['name']) ?>
    <?php if (! empty($project['description'])): ?>
    <span class="tooltip" title="<?= $this->text->markdownAttribute($project['description']) ?>">
        <i class="fa fa-info-circle"></i>
    </span>
    <?php endif ?>
   </h1></span>


    <?= $this->render('board/table_container', array(
        'project' => $project,
        'swimlanes' => $swimlanes,
        'board_private_refresh_interval' => $board_private_refresh_interval,
        'board_highlight_period' => $board_highlight_period,
    )) ?>

</section>
