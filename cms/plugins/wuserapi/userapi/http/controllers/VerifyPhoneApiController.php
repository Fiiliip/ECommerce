<?php namespace WUserApi\UserApi\Http\Controllers;

use October\Rain\Exception\ApplicationException;
use RainLab\User\Models\User;
use WUserApi\UserApi\Classes\UserApiHook;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use WUserApi\UserApi\Facades\JWTAuth;
use Cache;

class VerifyPhoneApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $params = [
            'phone_number_verification_code' => input('phone_number_verification_code'),
        ];

        if (!isset($params['phone_number_verification_code'])) {
            throw new ApplicationException('Phone number verification code is required');
        }

        $user = Auth::user();
        if ($user->is_phone_number_verified == true) {
            throw new ApplicationException('Already verified');
        }

        $phone_number_verification_code = Cache::store('file')->get('phone_verification_' . $user->id);

        if ($phone_number_verification_code != $params['phone_number_verification_code']) {
            throw new ApplicationException('SMS Verification code is not valid');
        }

        $key = 'phone_' . $user->id;
        $verified_number = Cache::store('file')->get($key);
        if (!$verified_number){
            throw new ApplicationException('Time out');
        }
        $user->phone_number = $verified_number;
        $user->is_phone_number_verified = true;
        $user->save();
        $code_key = 'phone_verification_' . $user->id;
        Cache::store('file')->forget($code_key);
        Cache::store('file')->forget($key);

        $userResourceClass = config('wuserapi.userapi::resources.user');

        $response = [
            'message' => 'success',
        ];
        $user->is_guest = false;
        $user->save();
        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'data' => $response,
                'status' => 200
            ], 200);
        });
    }
}
