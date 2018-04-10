<?php

namespace Kanboard\Plugin\Bigboard\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Formatter\BoardFormatter;
use Kanboard\Model\UserMetadataModel;

/**
  * Bigboard Controller.
  *
  * @author Thomas Stinner
  */
 class Bigboard extends BaseController
 {
     /**
      * Display a Board which contains multiple projects.
      */
     public function index()
     {
         if ($this->userSession->isAdmin()) {
             $project_ids = $this->projectModel->getAllIds();
         } else {
             $project_ids = $this->projectPermissionModel->getActiveProjectIds($this->userSession->getId());
         }

         $nb_projects = count($project_ids);
           // Draw a header First
           $this->response->html($this->helper->layout->app('bigboard:board/show', array(
              'title' => t('Bigboard').' ('.$nb_projects.')',
              'board_selector' => false,
          )));

          echo $this->template->render('bigboard:board/dropdown', array(
            'bigboarddisplaymode' => $this->userSession->isBigboardCollapsed(),
          ));

          $this->showProjects($project_ids);

     }

     /**
      * Show projects.
      *
      * @param $project_ids list of project ids to show
      *
      * @return bool
      */
     private function showProjects($project_ids)
     {
       print "<div id='bigboard'>";

       foreach ($project_ids as $project_id) {
             $project = $this->projectModel->getByIdWithOwner($project_id);
             $search = $this->helper->projectHeader->getSearchQuery($project);

             $this->userMetadataCacheDecorator->set(UserMetadataModel::KEY_BOARD_COLLAPSED.$project_id, $this->userSession->isBigboardCollapsed());

             echo $this->template->render('bigboard:board/view', array(
             'no_layout' => true,
             'board_selector' => false,
             'project' => $project,
             'title' => $project['name'],
             'description' => $this->helper->projectHeader->getDescription($project),
             'board_private_refresh_interval' => $this->configModel->get('board_private_refresh_interval'),
             'board_highlight_period' => $this->configModel->get('board_highlight_period'),
             'swimlanes' => $this->taskLexer
                 ->build($search)
                 ->format(BoardFormatter::getInstance($this->container)->withProjectId($project['id'])),
         ));
         }

         print "</div>";

     }

     public function collapseAll()
     {
         $this->changeDisplayMode(true);
     }

     public function expandAll()
     {
         $this->changeDisplayMode(false);
     }

     private function changeDisplayMode($mode)
     {
         session_set('bigboardCollapsed', $mode);
         
         if ($this->userSession->isAdmin()) {
             $project_ids = $this->projectModel->getAllIds();
         } else {
             $project_ids = $this->projectPermissionModel->getActiveProjectIds(session_get('user')['id']);
         }

         if ($this->request->isAjax()) {
             $this->showProjects($project_ids);
         } else {
             $this->response->redirect($this->helper->url->to('Bigboard', 'index', array('plugin' => 'Bigboard')));
         }
     }
 }
