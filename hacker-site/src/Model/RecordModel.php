<?php
namespace App\Model;
use App\Services\DatabaseService;
use App\Entity\Record;
use PDO;

class RecordModel
{
    private PDO $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }

    public function fetchAll(): array
    {
        $request = $this->bdd->prepare('SELECT * FROM record');
        $request->execute();
        $commentsArray = [];

        foreach ($request->fetchAll() as $value)
        {
            $comment = new Record($value["id"],$value["raw"],$value["created_at"]);
            $commentsArray[] = $comment;
        }

        return $commentsArray;

    }

    public function create(Record $record): void
    {
        $request = $this->bdd->prepare('INSERT INTO record(raw) VALUES(:raw)');
        $request->execute(['raw' => $record->getRaw()]);
    }

    public function truncate(){
        $resetRequest = $this->bdd->prepare('TRUNCATE TABLE record');
        $resetRequest->execute();
    }
}