<?php namespace WUserApi\UserApi\Http\Controllers;

use October\Rain\Exception\ApplicationException;
use RainLab\User\Models\User;
use WUserApi\UserApi\Classes\UserApiHook;
use Illuminate\Support\Facades\Event;
use WUserApi\UserApi\Facades\JWTAuth;
use WUserApi\UserApi\Classes\UserResource;
use Illuminate\Support\Facades\Auth;

class VerifyApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $params = [
            'email' => input('email'),
            'code' => input('code')
        ];

        $user =  User::where('email', $params['email'])->firstOrFail();

        Event::fire('wuserapi.userapi.beforeVerify', [$user]);
        
        if (!$user->attemptActivation($params['code'])) {
            throw new ApplicationException('Email Activation code is not valid');
        }
        if ($user->is_guest){
            $user->is_activated = false;
            $user->activated_at = null;
            $user->save();
        }

        $response = [
            'success' => true
        ];
        $userResourceClass = config('wuserapi.userapi::resources.user');

        if ($user->is_guest){
            $user = Auth::loginUsingId($user->id);
            $token = JWTAuth::fromUser($user);
            $response['token'] = $token;
            $response['user'] = new $userResourceClass($user);
        
        }

        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'data' => $response,
                'status' => 200
            ], 200);
        });
    }
}
