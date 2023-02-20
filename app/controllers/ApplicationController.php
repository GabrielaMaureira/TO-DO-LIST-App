<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */

 require_once(ROOT_PATH . '/app/models/TaskModel.class.php');
 

class ApplicationController extends Controller {

	public function indexAction(){
        $this->taskListAction();
    }
    
    public function taskListAction(){
		$model = new TaskModel();
        $this->view->content = $model->getTasks();
	}

    public function createTaskAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new TaskModel();
            $model->createTask($_POST['task'], 
                                $_POST['status'], 
                                $_POST['startDate'], 
                                $_POST['endDate'] );
        header('Location: ' . $this->_baseUrl());

        }
    }
}
