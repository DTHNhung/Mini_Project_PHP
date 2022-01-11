<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function login()
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

                    $this->view('users/login', $data);
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
        $this->view('users/login', $data);
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

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username.';
            } elseif (strlen($data['username']) < 4 || strlen($data['username']) > 64) {
                $data['usernameError'] = 'Username must be between 4 and 64 characters in length.';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Username can only contain letters and numbers.';
            }

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format.';
            } else {
                //Check if email exists.
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email is already taken.';
                }
            }

            // Validate password on length, numeric values,
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password.';
            } elseif (strlen($data['password']) < 6 || strlen($data['password']) > 100) {
                $data['passwordError'] = 'Password must be between 6 and 100 characters in length.';
            } elseif (preg_match($passwordValidation, $data['password'])) {
                $data['passwordError'] = 'Password must be have at least one non-numeric value.';
            }

            //Validate confirm password
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } elseif ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
            }

            //Validate file image
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'pdf');

            if (!in_array($fileActualExt, $allowed)) {
                $data['fileError'] = 'You cannot upload files of this type.';
            } elseif ($fileError != 0) {
                $data['fileError'] = 'There was an error uploading your file.';
            } elseif ($fileSize > 1000000) {
                $data['fileError'] = 'File is too big.';
            }

            if (
                empty($data['usernameError']) && empty($data['emailError']) &&
                empty($data['passwordError']) && empty($data['confirmPasswordError']) &&
                empty($data['fileError'])
            ) {

                // Hash password
                // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $data['password'] = md5(md5($data['password']));

                // generates a unique ID based on the microtime 
                $data['fileName'] = uniqid('', true) . '.' . $fileActualExt;

                //move file new avatar to img/avatar/ 
                $fileDestination = PUBLICROOT . '/img/avatar/' . $data['fileName'];
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    //Register user from model function
                    if ($this->userModel->register($data)) {
                        //Redirect to the login page
                        header('location: ' . URLROOT . '/users/login');
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
        header('location:' . URLROOT . '/users/login');
    }
}
