<?php namespace WUserApi\UserApi\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;
use October\Rain\Exception\ValidationException;
use System\Models\File;
use WUserApi\UserApi\Classes\UserApiHook;
use WUserApi\UserApi\Facades\JWTAuth;

class CreateGuestPasswordApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $data = post();
        $user = JWTAuth::getUser();

        if ($user->isBanned()) {
            throw new AuthException('rainlab.user::lang.account.banned');
        }
        
        if ($user->is_guest) {
            $user = $this->setNewPassword($data, $user);
        } else {
            return response()->make([
                'error' => 'User has set their password already',
            ], 404);
        }

        $ipAddress = request()->ip();
        if ($ipAddress) {
            $user->touchIpAddress($ipAddress);
        }
        $token = JWTAuth::fromUser($user);

        $userResourceClass = config('wuserapi.userapi::resources.user');
        $response = [
            'message' => 'success',
        ];


        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'data' => $response,
                'status' => 200
            ], 200);
        });
    }

    public function setNewPassword($data, $user)
    {
        $user->password = $data['password'];
        if (isset($data['password_confirmation'])){
            $user->password_confirmation = $data['password_confirmation'];
        }
        else{
            $user->password_confirmation = $data['password'];
        }
        
        $user->is_guest = false;
        $user->is_activated = true;
        $user->activated_at = now();
        $user->save();
        return $user;
    }
}
