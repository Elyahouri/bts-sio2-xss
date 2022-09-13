<?php

namespace App\Entity;

class Comment
{
    private $id;
    private $name;
    private $body;

    /**
     * @param $id
     * @param $name
     * @param $body
     */
    public function __construct($id,$name, $body)
    {
        $this->id = $id;
        $this->name = $name;
        $this->body = $body;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Comment
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Comment
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     * @return Comment
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }



}