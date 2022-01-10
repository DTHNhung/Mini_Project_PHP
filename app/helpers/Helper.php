<?php
session_start();
class Helper extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    function authenToken()
    {
        // if (isset($_SESSION['user_id'])) {
        //     return $_SESSION['user'];
        // }
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
        if (isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
            if (empty($token)) {
                return null;
            }
            $result = $this->userModel->findUserByToken($token);

            if ($result != null) {
                $_SESSION['user_id'] = $result->user_id;

                return $result->user_id;
            }
        }
        return null;
        // $sql    = "select users.* from users, login_tokens where users.id = login_tokens.id_user and login_tokens.token = '$token'";

    }
}
