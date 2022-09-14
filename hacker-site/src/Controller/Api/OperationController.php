<?php

namespace App\Controller\Api;

use App\Entity\Operation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OperationController extends AbstractController
{
    /**
     * @throws \Exception
     */
    public function __invoke(Operation $data): Operation
    {
        dd($data);
        //SET RESPONSE
        $data->setMessage("Je s'appel Groot !");

        return $data;
    }
}