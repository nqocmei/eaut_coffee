<?php
namespace App\Repositories\User;

interface UserInterface{
    public function update($request);
    public function getAllUser();
    public function searchUser($data);
    public function getAllAdmin();
}
