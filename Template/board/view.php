<section id="main">

    <span class='header'><h1><?= $this->text->e($project['name']) ?>
    
    <?php if (! empty($project['description'])): ?>
        <?= $this->app->tooltipMarkdown($project['description']) ?>
    <?php endif ?>
    
    </span>
    </h1></span>
    

    <?= $this->render('bigboard:board/table_container', array(
        'project' => $project,
        'swimlanes' => $swimlanes,
        'board_private_refresh_interval' => $board_private_refresh_interval,
        'board_highlight_period' => $board_highlight_period,
    )) ?>

</section>
