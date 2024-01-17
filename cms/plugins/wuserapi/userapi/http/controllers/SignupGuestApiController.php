<?php namespace WUserApi\UserApi\Http\Controllers;

use Illuminate\Support\Facades\Event;
use RainLab\User\Facades\Auth;
use RainLab\User\Models\Settings as UserSettings;
use WUserApi\UserApi\Classes\Services\UserSignupActivationService;
use WUserApi\UserApi\Classes\UserApiHook;
use WUserApi\UserApi\Facades\JWTAuth;
use Exception;
use WUserApi\UserApi\Models\User;

class SignupGuestApiController extends UserApiController
{
    public function handle()
    {
        $data = post();


        $user = $this->registerUser($data);

        if (is_a($user, 'Illuminate\Http\Response')) {
            return $user;
        }

        $token = null;

        Event::fire('wuserapi.userapi.beforeReturnUser', [$user]);
        $userResourceClass = config('wuserapi.userapi::resources.user');
        if (!$user){
            $user = User::find($user->id);
        }
        $response = [
            'token' => $token,
            'user' => new $userResourceClass($user),
        ];


        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'data' => $response,
                'status' => 201
            ], 201);
        });
    }

    protected function registerUser($data)
    {
        Event::fire('rainlab.user.beforeRegister', [&$data]);

        $userActivation = UserSettings::get('activate_mode') == UserSettings::ACTIVATE_USER;

        try {
            $user = Auth::registerGuest($data);
        } catch (Exception $e) {
            $user = User::where('email', $data['email'])->where('is_guest', false)->first();
            if ($user) {
                $userResourceClass = config('wuserapi.userapi::resources.user');
                $response = [
                    'user' => new $userResourceClass($user),
                ];
                return response([
                    'data' => $response,
                    'status' => 201
                ], 200);
            }
            throw $e;
        }

        if (!$user->is_activated && $user->is_guest) {
            (new UserSignupActivationService($user))->sendActivationCode();

        }


        return $user;
    }

    protected function loginAttribute()
    {
        return UserSettings::get('login_attribute', UserSettings::LOGIN_EMAIL);
    }
}
