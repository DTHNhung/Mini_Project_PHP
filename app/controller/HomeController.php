<?php
    class HomeController extends Controller {
        public function __construct()
        {
            $this->adminModel = $this->model('Admin');
        }

        public function index()
        {
            $this->view('/home/index');
        }

        public function about()
        {
            echo 'About';
        }
    }
?>