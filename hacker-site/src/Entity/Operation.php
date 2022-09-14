<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        "post"=>[
            "path"=>"/hack",
            "controller"=>"App\Controller\Api\OperationController",
            'normalization_context' => ['groups' => ['read:Operation']],
            'denormalization_context' => ['groups' => ['post:Operation']],
        ]
    ],
    itemOperations: [
        "get"=>[
            "controller"=>"ApiPlatform\Core\Action\NotFoundAction",
            "read"=>false,
            "output"=>false,
            "openapi_context"=>[
                "summary"=>"hidden"
            ]
        ]
    ]
)]
class Operation
{
    #[ApiProperty(identifier: true)]
    private int $time;

    #[Groups(["post:Operation"])]
    private ?string $raw;

    #[Groups(["post:Operation"])]
    private string $output;

    #[Groups(["read:Operation"])]
    private string $message;


    public function __construct()
    {
        $this->time = (new \DateTimeImmutable('now'))->getTimestamp();
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @param int $time
     * @return Operation
     */
    public function setTime(int $time): Operation
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRaw(): ?string
    {
        return $this->raw;
    }

    /**
     * @param string|null $raw
     * @return Operation
     */
    public function setRaw(?string $raw): Operation
    {
        $this->raw = $raw;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Operation
     */
    public function setMessage(string $message): Operation
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }

    /**
     * @param string $output
     * @return Operation
     */
    public function setOutput(string $output): Operation
    {
        $this->output = $output;
        return $this;
    }

}