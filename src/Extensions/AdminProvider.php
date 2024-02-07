<?php


namespace Cabard\Nimda\Extensions;

use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class AdminProvider implements UserProvider
{
    public function __construct(\Cabard\Nimda\Models\Admin $userModel)
    {
        $this->model = $userModel;
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials)) {
            return;
        }
        $user = $this->model->fetchUserByCredentials(['username' => $credentials['username']]);
        return $user;
    }

    public function validateCredentials(Authenticatable $user, Array $credentials)
    {
        return ($credentials['username'] == $user->getAuthIdentifier() &&
            md5($credentials['password']) == $user->getAuthPassword());
    }
    public function retrieveById($identifier) {}
    public function retrieveByToken($identifier, $token) {}
    public function updateRememberToken(Authenticatable $user, $token) {}
}
