<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function assignRole($userId, $roleName)
    {
        $user = $this->find($userId);
        if ($user) {
            $user->assignRole($roleName);
            return true;
        }
        return false;
    }

    public function removeRole($userId, $roleName)
    {
        $user = $this->find($userId);
        if ($user) {
            $user->removeRole($roleName);
            return true;
        }
        return false;
    }

    public function syncRoles($userId, array $roleNames)
    {
        $user = $this->find($userId);
        if ($user) {
            $user->syncRoles($roleNames);
            return true;
        }
        return false;
    }
}
