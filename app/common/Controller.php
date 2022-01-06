<?php
    // load the model and the view
    class Controller{
        public function model($model)
        {
            // require model file
            require '../app/models/' . $model . '.php';
            // instantiate model
            return new $model();
        }

        // load the view - checks for the file
        public function view($view, $data=[])
        {
            if(file_exists('../app/views' . $view . '.php')){
                require '../app/views' . $view . '.php';
            } else {
                die("View does not exists.");
            }
        }
    }
?>