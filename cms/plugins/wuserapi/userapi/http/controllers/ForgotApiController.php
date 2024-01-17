<?php namespace WUserApi\UserApi\Http\Controllers;

use October\Rain\Exception\ApplicationException;
use RainLab\User\Models\User;
use WUserApi\UserApi\Classes\Services\UserForgotPasswordService;
use WUserApi\UserApi\Classes\UserApiHook;
use Cache;

class ForgotApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $params = [
            'email' => input('email'),
        ];

        $user = User::where('email', $params['email'])->first();
        
        if (!$user) {
            throw new ApplicationException('User was not found', 404);
        }
        
        if (!$user->is_activated) {
            throw new ApplicationException('User not activated', 403);
        }
        Cache::store('file')->put('reset_code_' . $user->id, $user->reset_password_code, config('wuserapi.userapi::config.password_reset_code_expiration_time'));

        (new UserForgotPasswordService($user))->sendResetCode();
        // dd($user->reset_password_code);
        // $user->reset_password_code = null;
        
        $user->save();
        

        $response = [
            "success" => true,
            'message' => 'If your email address exists in our database, you will receive a password recovery link at your email address in few minutes.'
        ];

        if (config('app.debug')) {
            $response['reset_code'] = Cache::store('file')->get('reset_code_' . $user->id);
        }

        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'data' => $response,
                'status' => 200
            ], 200);
        });
    }
}
