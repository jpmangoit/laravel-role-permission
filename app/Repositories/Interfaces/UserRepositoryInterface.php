<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEmail(string $email);
    public function assignRole($userId, $roleName);
    public function removeRole($userId, $roleName);
    public function syncRoles($userId, array $roleNames);
}
