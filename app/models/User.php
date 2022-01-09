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

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email)
    {
        //Prepared statement
        $this->db->query('SELECT * FROM tbl_users WHERE user_email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if email is already registered
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
