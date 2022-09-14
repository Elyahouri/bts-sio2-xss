<?php

namespace App\Services;

use App\Entity\CookieRecord;
use App\Repository\CookieRecordRepository;
use DateTimeImmutable;
use DateTimeZone;

class CookieWorkerService
{
    private CookieRecordRepository $cookieRecordRepository;

    /**
     * @param CookieRecordRepository $cookieRecordRepository
     */
    public function __construct(CookieRecordRepository $cookieRecordRepository)
    {
        $this->cookieRecordRepository = $cookieRecordRepository;
    }

    public function proceedCookie(string $cookie, string $output): void
    {
        $result = match($output){
            "text"=>$this->createTextFile($cookie),
            "store"=>$this->createRecord($cookie)
        };
    }

    private function createTextFile(string $cookie): bool
    {
        $timestamp = (new DateTimeImmutable('now',new DateTimeZone('Europe/Paris')))->getTimestamp();
        file_put_contents($_ENV["STORAGE_PATH"]."cookies-$timestamp.json", json_encode($this->formatCookie($cookie)));
        return true;
    }

    private function createRecord(string $cookie): bool
    {
        $record = new CookieRecord($this->formatCookie($cookie));

        $this->cookieRecordRepository->add($record,true);
        return true;
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

}