<?php
namespace App\Model;
use App\Services\DatabaseService;
use App\Entity\User;
use PDO;

class userModel
{
    private PDO $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }

    public function create(User $user): void
    {
        $request = $this->bdd->prepare('INSERT INTO user(email,name, password) VALUES(:email, :name, :password)');
        $request->execute(['email'=>$user->getEmail(),'name' => $user->getName(), 'password' => $user->getPassword()]);
    }

    public function truncate(){
        $resetRequest = $this->bdd->prepare('TRUNCATE TABLE user');
        $resetRequest->execute();

        $popuplateRequest = $this->bdd->prepare("INSERT INTO `user` (`id`, `email`, `name`, `password`)VALUES (1, 'ela.debonsyeux@mail.dev', 'Ela Debonsyeux', 'password');");
        $popuplateRequest->execute();
    }
}