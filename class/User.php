<?php

class User
{
    private $id, $password, $db;
    protected $email;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }


    public function register()
    {
        $this->db->insert();
    }

    public function login()
    {
        $this->db->select();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return sha1($this->password);
    }

    public function setId($id)
    {
        if (is_int($id)) {
            $this->id = $id;
        }
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        if (strlen($password) > 5) {
            $this->password = $password;
        }
    }

    public function getUser()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
        ];
    }
}
