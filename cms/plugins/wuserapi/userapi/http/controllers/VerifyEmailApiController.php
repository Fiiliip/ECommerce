<?php namespace WUserApi\UserApi\Http\Controllers;

use October\Rain\Exception\ApplicationException;
use WUserApi\UserApi\Classes\UserApiHook;
use Illuminate\Support\Facades\Auth;
use Cache;

class VerifyEmailApiController extends UserApiController
{
    public function handle()
    {
        $response = [];
        $params = [
            'email' => input('email'),
            'code' => input('code'),
        ];

        if (!isset($params['email']) || !isset($params['code'])) {
            throw new ApplicationException('Email and code are required');
        }

        $user = Auth::user();
    
        $email_verification_code = Cache::store('file')->get('email_verification_' . $user->id);

        if ($email_verification_code != $params['code']) {
            throw new ApplicationException('Email Verification code is not valid');
        }

        $verified_email = Cache::store('file')->get('email_' . $user->id);
        if (!$verified_email){
            throw new ApplicationException('Time out. Please try again');
        }
        $user->email = $verified_email;
        $user->username = $verified_email;
        $user->save();
        Cache::store('file')->forget('email_verification_' . $user->id);
        Cache::store('file')->forget('email_' . $user->id);

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
}
