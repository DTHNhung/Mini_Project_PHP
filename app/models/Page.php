<?php

class Page
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getData() 
    {
        $this->db->query('SELECT * FROM tbl_users');
        $this->db->execute();
        $sql = $this->db->resultSet();
        return $sql;
    }

    public function update($data)
    {
        $this->db->query('UPDATE tbl_users SET user_password = :password, user_name = :username,
            user_avatar = :fileName, updated_at = :update_at WHERE user_email = :email');

        $this->db->bind(':username', $data['username']);
        $this->db->bind(':user_password', $data['newPassword']);
        $this->db->bind(':user_avatar', $data['fileName']);
        $this->db->bind(':updated_at', $data['updated']);
        $this->db->bind(':user_email', $data['email']);
        
        // if ($this->db->execute()) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function delete($username)
    {
        $this->db->query('DELETE FROM tbl_users WHERE user_name = :username');
        $this->db->bind(':username', $username);
        $this->db->execute();
    }

    public function getDataByUser($username)
    {
        $this->db->query('SELECT * FROM tbl_users WHERE user_name = :username');
        $this->db->bind(':username', $username);
        $this->db->execute();
        return $this->db->single();
    }
}
?>