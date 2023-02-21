<?php

class TaskModel extends Model
{
    private $db;
    private $tasks;

    public function __construct() {
        $this->db = file_get_contents(ROOT_PATH . '/web/database.json');
        $this->tasks = json_decode($this->db, true);
    }

    public function getTasks() {
        return $this->tasks;
    }

    public function singleTask($id) {
        foreach ($this->tasks as $i => $task) {
            if ($task['id'] == $id) {
                return ($this->tasks[$i]);
            }
        }
    }

    public function writeJson($newTask){
        file_put_contents(ROOT_PATH . '/web/database.json', json_encode($newTask, JSON_PRETTY_PRINT));
    }

    public function createTask($task, $status, $startDate, $endDate){
        $newTask = array(
			'id' => uniqid(),
			'task' => $task,
			'status' => $status,
			'startDate' => $startDate,
			'endDate' => $endDate,
			'user' => "Gaby"
			);
        $this->tasks[] = $newTask;
        $this->writeJson($this->tasks);
    }

    public function editTask($id, $title, $status, $startDate, $endDate){ 
        foreach($this->tasks as $i => $task){
            if($task['id'] == $id){
                $this->tasks[$i]['task'] = $title;
                $this->tasks[$i]['status'] = $status;
                $this->tasks[$i]['startDate'] = $startDate;
                $this->tasks[$i]['endDate'] = $endDate;

                $this->writeJson($this->tasks);
            }
        }

    }

    public function deleteTask($id){
        foreach ($this->tasks as $i => $task) {
            if ($task['id'] == $id) {
                unset($this->tasks[$i]);
                $this->writeJson($this->tasks);
            }
        }
        return $this->tasks;
       
    }

    


    
}
