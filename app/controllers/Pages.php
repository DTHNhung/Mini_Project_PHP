<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->pageModel = $this->model('Page');
        $this->params = $this->getParams();
    }

    public function index()
    {
        $sql = $this->pageModel->getData();

        $data = [
            'admin' => '',
            'info' => $sql
        ];
        $this->view('pages/index', $data);
    }

    public function edit()
    {
        $tmp = get_object_vars($this->pageModel->getDataByUser($this->params[0]));
        $data = [
            'id' => $tmp['user_id'],
            'username' => $tmp['user_name'],
            'oldPassword' => '',
            'newPassword' => '',
            'confirmPassword' => '',
            'fileName' => $tmp['user_avatar'], 
            'usernameError' => '',
            'oldPasswordError' => '',
            'newPasswordError' => '',
            'confirmPasswordError' => '',
            'fileError' => '',
            'updated' => '',
            'params' => $this->params[0]
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $tmp['user_id'],
                'username' => trim($_POST['username']),
                'oldPassword' => trim($_POST['oldPassword']),
                'newPassword' => trim($_POST['newPassword']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'fileName' => $_FILES['file']['name'], 
                'usernameError' => '',
                'oldPasswordError' => '',
                'newPasswordError' => '',
                'confirmPasswordError' => '',
                'fileError' => '',
                'updated' => ''
            ];

            $data['usernameError'] = $this->username($data['username']);
            if ($data['usernameError'] == '' && $data['username'] != $tmp['user_name']) {
                $result = $this->pageModel->getDataByUser($data['username']);
                if ($result != NULL){
                    $data['usernameError'] = 'Username is already taken.';
                }
            }

            $data['oldPasswordError'] = $this->password($data['oldPassword']);
            if ($data['oldPasswordError'] == '') {
                if (md5(md5($data['oldPassword'])) != $tmp['user_password']) {
                    $data['oldPasswordError'] = 'Password is incorrect. Please try again.';
                }
            }

            if ($data['newPassword'] != '') {
                $data['newPasswordError'] = $this->password($data['newPassword']);

                if ($data['newPasswordError'] == '' && 
                    $data['newPassword'] == $data['oldPassword']) {
                    $data['newPasswordError'] = 'You used old password.';
                } else {
                    $data['confirmPasswordError'] = $this->
                        confirmPassword($data['newPassword'], $data['confirmPassword']);
                }
                
            }
            
            $data['fileError'] = $this->image($_FILES['file']);

            if (empty($data['usernameError']) && empty($data['oldPasswordError']) &&
                empty($data['newPasswordError']) && empty($data['confirmPasswordError']) &&
                empty($data['fileError'])) {

                    if ($data['newPassword'] == '') {
                        $data['newPassword'] = md5(md5($data['oldPassword']));
                    } else {
                        $data['newPassword'] = md5(md5($data['newPassword']));
                    }

                    $fileExt = explode('.', $data['fileName']);
                    $fileActualExt = strtolower(end($fileExt));
                    // generates a unique ID based on the microtime 
                    $data['fileName'] = uniqid('', true) . '.' . $fileActualExt;

                    date_default_timezone_set('Asia/Bangkok');
                    $data['updated'] = date("Y-m-d H:i:s");

                    // print_r($data);
                    //move file new avatar to img/avatar/ 
                    $fileDestination = PUBLICROOT . '/img/avatar/' . $data['fileName'];
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination) &&
                            unlink(PUBLICROOT . '/img/avatar/' . $tmp['user_avatar']) &&
                            $this->pageModel->update($data)) {
                        // $this->pageModel->update($data)
                        header('location: ' . URLROOT . '/pages/index');
                    } else {
                        die('Something went wrong.');
                    }
            }
        }
        $this->view('pages/edit', $data);
    }

    public function delete()
    {
        $data = [
            '' => ''
        ];
        $this->view('pages/index', $data);
    }
}
