<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('Page');
    }

    public function index()
    {
        $sql = $this->userModel->getData();

        $data = [
            'admin' => '',
            'info' => $sql
        ];
        $this->view('pages/index', $data);
    }
}
