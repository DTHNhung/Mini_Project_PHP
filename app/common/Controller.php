<?php
//Load the model and the view
class Controller extends Core
{
    public function model($model)
    {
        //Require model file
        require_once '../app/models/' . $model . '.php';
        //Instantiate model
        return new $model();
    }

    //Load the view (checks for the file)
    public function view($view, $data = [])
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View does not exists.");
        }
    }

    public function getParams()
    {
        $this->url = $this->getUrl();
        unset($this->url[0]);
        unset($this->url[1]);
        $this->params = $this->url ? array_values($this->url) : [];
        return $this->params;
    }

    public function username($username)
    {
        $error = '';
        $nameValidation = "/^[a-zA-Z0-9]*$/";// xem lai
        //Validate username on letters/numbers
        if (empty($username)) {
            $error = 'Please enter username.';
        }elseif (strlen($username) < 4 || strlen($username) > 64) {
            $error = 'Username must be between 4 and 64 characters in length.';
        } elseif (!preg_match($nameValidation, $username)) {
            $error = 'Username can only contain letters and numbers.';
        }
        return $error;
    }

    public function password($password)
    {
        $error = '';
        $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
        // Validate password on length, numeric values,
        if (empty($password)) {
            $error = 'Please enter password.';
        } elseif (strlen($password) < 6 || strlen($password) > 100) {
            $error = 'Password must be between 6 and 100 characters in length.';
        } elseif (preg_match($passwordValidation, $password)) {
            $error = 'Password must be have at least one non-numeric value.';
        }
        return $error;
    }

    public function confirmPassword($password, $confirmPassword)
    {
        $error = '';
        //Validate confirm password
        if (empty($confirmPassword)) {
            $error = 'Please enter password.';
        } elseif ($password != $confirmPassword) {
            $error = 'Passwords do not match, please try again.';
        }
        return $error;
    }

    public function email($email)
    {
        $error = '';
        //Validate email
        if (empty($email)) {
            $error = 'Please enter email address.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter the correct format.';
        }
        return $error;
    }

    public function image($file)
    {
        $error = '';
        //Validate file image
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if (!in_array($fileActualExt, $allowed)) {
            $error = 'You cannot upload files of this type.';
        } elseif ($fileError != 0) {
            $error = 'There was an error uploading your file.';
        } elseif ($fileSize > 1000000) {
            $error = 'File is too big.';
        }
        return $error;
    }
}
