<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeZone;

class Record
{
    private $id;
    private $createdAt;
    private $raw;

    /**
     * @param $id
     * @param $raw
     * @throws \Exception
     */
    public function __construct($id, $raw,$createdAt = null)
    {
        $this->id = $id;
        $this->createdAt = $createdAt ?: new DateTimeImmutable('now',new DateTimeZone(('Europe/Paris')));
        $this->raw = $raw;
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
     * @return Record
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable $createdAt
     * @return Record
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): Record
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRaw()
    {
        return $this->raw;
    }

    /**
     * @param mixed $raw
     * @return Record
     */
    public function setRaw($raw)
    {
        $this->raw = $raw;
        return $this;
    }

}