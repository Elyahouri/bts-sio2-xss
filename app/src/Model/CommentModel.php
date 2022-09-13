<?php
namespace App\Model;
use App\Services\DatabaseService;
use App\Entity\Comment;
use PDO;

class CommentModel
{
    private PDO $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }

    public function fetchAll(): array
    {
        $request = $this->bdd->prepare('SELECT * FROM comment');
        $request->execute();
        $commentsArray = [];

        foreach ($request->fetchAll() as $value)
        {
            $comment = new Comment($value["id"],$value["name"],$value["body"]);
            $commentsArray[] = $comment;
        }

        return $commentsArray;

    }

    public function create(Comment $comment): void
    {
        $request = $this->bdd->prepare('INSERT INTO comment(name, body) VALUES(:name, :body)');
        $request->execute(['name' => $comment->getName(), 'body' => $comment->getBody()]);
    }

}