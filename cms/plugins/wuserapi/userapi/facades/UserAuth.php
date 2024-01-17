<?php namespace WUserApi\UserApi\Facades;

use RainLab\User\Facades\Auth;
use WUserApi\UserApi\Models\User;

class UserAuth extends Auth
{
    /**
     * Authenticate a user
     *
     * @param array $credentials
     * @param boolean $remember
     * @return MyUser|boolean
     */
    public static function authenticate(array $credentials, $remember = false)
    {
        $user = parent::authenticate($credentials, $remember);
        
        if (!$user) {
            return false;
        }

		if ($user instanceof \OFFLINE\Mall\Models\User) {
			$user = User::find($user->id);
		}
        
        return $user;
    }

	/**
     * Register a new user
     *
     * @param array $data
	 * @param boolean $automaticActivation
     * @return User|boolean
     */
    public static function register(array $data, $automaticActivation)
    {
        $user = parent::register($data, $automaticActivation);
        
        if (!$user) {
            return false;
        }

		if ($user instanceof \OFFLINE\Mall\Models\User) {
			$user = User::find($user->id);
		}
        
        return $user;
    }
}