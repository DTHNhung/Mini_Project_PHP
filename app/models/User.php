<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM tbl_users WHERE user_name = :username and user_password=:password');

        //Bind value
        $this->db->bind(':username', $username);
        $this->db->bind(':password', md5(md5($password)));
        $row = $this->db->single();
        // if ($row != null) {
        //     $hashedPassword = $row->user_password;

        //     if (password_verify($password, $hashedPassword)) {
        //         return $row;
        //     } else {
        //         return false;
        //     }
        // }
        if ($row != null) {
            return $row;
        } else {
            return false;
        }
    }
    public function register($data)
    {
        $this->db->query('INSERT INTO tbl_users ( user_email, user_password,user_name) VALUES( :email, :password,:username)');

        //Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function createToken($user_id, $token)
    {
        $this->db->query('INSERT INTO tbl_logins_token (user_id, token) values (:userid,:token)');

        $this->db->bind(':userid', $user_id);
        $this->db->bind(':token', $token);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByToken($token)
    {
        // $this->db->query('SELECT * FROM tbl_logins_token WHERE token = :token');
        // select users.* from users, login_tokens where users.id = login_tokens.id_user and login_tokens.token = '$token'
        // $this->db->query('SELECT tbl_users.* FROM tbl_logins_token,tbl_users WHERE 
        //     tbl_users.user_id = tbl_login_tokens.user_id
        // and token = :token');
        $this->db->query('SELECT tbl_users.* FROM tbl_users,tbl_logins_token where tbl_users.user_id = tbl_logins_token.user_id and tbl_logins_token.token=:token');
        //Bind value
        $this->db->bind(':token', $token);
        $row = $this->db->single();
        // if ($row != null) {
        //     $hashedPassword = $row->user_password;

        //     if (password_verify($password, $hashedPassword)) {
        //         return $row;
        //     } else {
        //         return false;
        //     }
        // }
        if ($row != null) {
            return $row;
        } else {
            return false;
        }
    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email)
    {
        //Prepared statement
        $this->db->query('SELECT * FROM tbl_users WHERE user_email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);


        $row = $this->db->single();
        if ($row != null) {
            return true;
        } else {
            return false;
        }
        //Check if email is already registered
        // if ($this->db->rowCount() > 0) {
        //     return true;
        // } else {
        //     return false;
        // }
    }
}
