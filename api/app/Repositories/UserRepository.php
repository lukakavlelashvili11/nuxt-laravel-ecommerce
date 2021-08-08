<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function store(array $userInfo){
        $this->user->create($userInfo);
    }
}