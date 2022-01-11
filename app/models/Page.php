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
        $this->db->query("UPDATE `tbl_users` SET `user_password` = :pass, `user_name` = :user,
            `user_avatar` = :avatar, `updated_at` = :updated WHERE `user_id` = :id ");

        $this->db->bind(':user', $data['username']);
        $this->db->bind(':pass', $data['newPassword']);
        $this->db->bind(':avatar', $data['fileName']);
        $this->db->bind(':updated', $data['updated']);
        $this->db->bind(':id', $data['id']);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
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
