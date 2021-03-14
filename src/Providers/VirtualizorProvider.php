<?php

namespace wickedsoft\Virtualizor\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class VirtualizorProvider implements UserProvider
{
    /**
     * @param array $credentials
     * @return Authenticatable|\wickedsoft\Virtualizor\Authentication\User|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $checkLogin = app('Virtualizor')->users()->checkLogin($credentials);

        if ($checkLogin['status'] != 'error') {
            $user = new \wickedsoft\Virtualizor\Authentication\User();
            $user->forceFill($checkLogin['user']);

            return $user;
        }

        return null;
    }

    /**
     * @param mixed $identifier
     * @return Authenticatable|mixed|null
     * @throws \Exception
     */
    public function retrieveById($identifier)
    {
        return cache()->remember('netbox_user_id_' . $identifier, 60, function () use ($identifier) {
            $response = app('Virtualizor')->users()->show(['Identifier' => $identifier]);

            $user = new \wickedsoft\Virtualizor\Authentication\User();
            $user->forceFill($response['user']);

            return $user;
        });
    }

    public function retrieveByToken($identifier, $token)
    {
        //
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        //
    }

    /**
     * @param Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return true;
    }
}
