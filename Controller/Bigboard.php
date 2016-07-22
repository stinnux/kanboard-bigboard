<?php

namespace Kanboard\Plugin\Bigboard\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Formatter\BoardFormatter;

/**
 * Bigboard Controller
 *
 * @package controller
 * @author Thomas Stinner
 */

 class Bigboard extends BaseController
 {
    /**
     * Display a Board which contains multiple projects
     *
     * @access public
     */

     public function index()
     {
       // Draw a header First
       $this->response->html($this->helper->layout->app('bigboard:board/show', array(
          'title' => t('Bigboard'),
          'board_selector' => false,
      )));


       // First we find all projects the user has access to
       // Then we find all possible columns
       if ($this->userSession->isAdmin()) {
           $project_ids = $this->projectModel->getAllIds();
       } else {
           $project_ids = $this->projectPermissionModel->getActiveProjectIds($this->userSession->getId());
       }

       $nb_projects = count($project_ids);

       foreach ($project_ids as $id ) {
         $project = $this->projectModel->getById($id);
         $this->response->html($this->template->render('bigboard:board/view', array(
             'no_layout' => true,
             'board_selector' => false,
             'project' => $project,
             'title' => $project['name'],
             'description' => $this->helper->projectHeader->getDescription($project),
             'board_private_refresh_interval' => $this->configModel->get('board_private_refresh_interval'),
             'board_highlight_period' => $this->configModel->get('board_highlight_period'),
             'swimlanes' => $this->taskLexer
                 ->build($search)
                 ->format(BoardFormatter::getInstance($this->container)->withProjectId($project['id']))
         )));


        }
     }


 }


 ?>
