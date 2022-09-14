<?php

namespace App\Controller\Api;

use App\Entity\Operation;
use App\Services\CookieWorkerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OperationController extends AbstractController
{
    private CookieWorkerService $cookieWorkerService;

    /**
     * @param CookieWorkerService $cookieWorkerService
     */
    public function __construct(CookieWorkerService $cookieWorkerService)
    {
        $this->cookieWorkerService = $cookieWorkerService;
    }


    /**
     * @throws \Exception
     */
    public function __invoke(Operation $data): Operation
    {
        $this->cookieWorkerService->proceedCookie(urldecode($data->getRaw()),$data->getOutput());
        //SET RESPONSE
        $data->setMessage("Je s'appel Groot !");

        return $data;
    }
}