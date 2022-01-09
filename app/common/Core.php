<?php
/*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
class Core
{
    //Nếu không có controller nào trong được lấy từ url thì sẽ default là controller Pages
    protected $currentController = 'users';
    protected $currentMethod = 'login';
    protected $params = [];

    public function __construct()
    {
        //print_r($this->getUrl());

        $url = $this->getUrl();

        // Look in BLL for first value
        if (isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // If exists, set as controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 Index
            unset($url[0]);
        }

        // Gọi đến file controller tương ứng trên url
        require_once '../app/controllers/' . $this->currentController . '.php';

        //Khởi tạo đối tượng controoler
        $this->currentController = new $this->currentController;

        // Check for second part of url
        if (isset($url[1])) {
            // Kiểm tra method (phương thức) $url[1] có tồn tại trong đối tượng $this->currentController không ?
            // Nếu không có method thì mặc định nó sẽ lấy method có tên là index
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // Unset 1 index
                unset($url[1]);
            }
        }

        // Get params
        //Trả về 1 mảng
        $this->params = $url ? array_values($url) : [];

        // // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }


    //trả về mảng dựa trên url phân cách bởi dấu /
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
