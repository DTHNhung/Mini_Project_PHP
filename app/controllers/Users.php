<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->pageModel = $this->model('Page');
    }

    public function index()
    {
        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
            ];
            //Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username.';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }

            //Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);
                if ($loggedInUser) {
                    if (isset($_POST['remember'])) {
                        $token = md5($data['username'] . time());
                        setcookie('token', $token, time() +  7 * 24 * 60 * 60, '/', '');
                        $this->userModel->createToken($loggedInUser->user_id, $token);
                        $this->createUserSession($loggedInUser);
                    } else {
                        $this->createUserSession($loggedInUser);
                    }
                } else {
                    $data['passwordError'] = 'Password or username is incorrect. Please try again.';

                    $this->view('users/index', $data);
                }
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('users/index', $data);
    }

    public function register()
    {
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'fileName' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => '',
            'fileError' => '',
            'created_at' => '',
            'updated_at' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'fileName' => $_FILES['file']['name'],
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
                'fileError' => '',
                'created_at' => '',
                'updated_at' => ''
            ];

            date_default_timezone_set('Asia/Bangkok');
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = $data['created_at'];


            //Validate username on letters/numbers
            $data['usernameError'] = $this->username($data['username']);
            if ($data['usernameError'] == '') {
                $result = $this->pageModel->getDataByUser($data['username']);
                if ($result != NULL) {
                    $data['usernameError'] = 'Username is already taken.';
                }
            }

            //Validate email
            $data['emailError'] = $this->email($data['email']);
            //Check if email exists.
            if (
                $this->userModel->findUserByEmail($data['email']) &&
                $data['emailError'] == ''
            ) {
                $data['emailError'] = 'Email is already taken.';
            }

            // Validate password on length, numeric values,
            $data['passwordError'] = $this->password($data['password']);

            //Validate confirm password
            $data['confirmPasswordError'] = $this->confirmPassword(
                $data['password'],
                $data['confirmPassword']
            );

            //Validate file image
            $data['fileError'] = $this->image($_FILES['file']);

            if (
                empty($data['usernameError']) && empty($data['emailError']) &&
                empty($data['passwordError']) && empty($data['confirmPasswordError']) &&
                empty($data['fileError'])
            ) {

                // Hash password
                // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $data['password'] = md5(md5($data['password']));

                $fileExt = explode('.', $data['fileName']);
                $fileActualExt = strtolower(end($fileExt));
                // generates a unique ID based on the microtime 
                $data['fileName'] = uniqid('', true) . '.' . $fileActualExt;

                //move file new avatar to img/avatar/ 
                $fileDestination = PUBLICROOT . '/img/avatar/' . $data['fileName'];
                if (move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)) {
                    //Register user from model function
                    if ($this->userModel->register($data)) {
                        //Redirect to the login page
                        header('location: ' . URLROOT . '/users/index');
                    } else {
                        die('Something went wrong.');
                    }
                }
            }
        }
        $this->view('users/register', $data);
    }

    public function createUserSession($user)
    {
        session_start();
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['username'] = $user->user_name;
        $_SESSION['email'] = $user->user_email;
        header('location:' . URLROOT . '/pages/index');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        setcookie('token', '', time() - 7 * 24 * 60 * 60, '/');
        session_destroy();
        header('location:' . URLROOT . '/users/index');
    }
}
