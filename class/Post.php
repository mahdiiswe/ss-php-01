<?php

require_once 'User.php';

class Post extends User
{
    private $id, $user_id, $title, $description, $date;

    public function create($id, $user_id, $title, $description): void
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->description = $description;
        $this->date = date('Y-m-d H:i:s');
        $this->email = 'sumon@gmail.com';
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title . ' by ' . $this->email;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }
}

$post1 = new Post();
$post1->setId(1);
$post1->setPassword('123456');
$post1->create(1, 1, 'Post 1', 'Description');
echo 'Title: '.$post1->getTitle().'<br/>';
echo 'Author: '.$post1->getEmail();

