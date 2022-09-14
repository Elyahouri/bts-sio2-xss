<?php

namespace App\Entity;

use App\Repository\CookieRecordRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CookieRecordRepository::class)]
class CookieRecord
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::JSON)]
    private ?array $data = null;

    public function __construct(array $data)
    {
        $this->createdAt = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'));
        $this->data = $data;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param array|null $data
     * @return CookieRecord
     */
    public function setData(?array $data): CookieRecord
    {
        $this->data = $data;
        return $this;
    }


}
