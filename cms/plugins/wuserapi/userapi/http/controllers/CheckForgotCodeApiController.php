<?php namespace WUserApi\UserApi\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use October\Rain\Exception\ApplicationException;
use October\Rain\Exception\ValidationException;
use RainLab\User\Models\User;
use WUserApi\UserApi\Classes\UserApiHook;
use WUserApi\UserApi\Facades\JWTAuth;
use WUserApi\UserApi\Classes\UserResource;
use Illuminate\Support\Facades\Auth;
use Cache;

class CheckForgotCodeApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $params = [
            'email' => input('email'),
            'code' => input('code'),
        ];

        $validation = Validator::make($params, [
            'email' => 'required|email',
            'code' => 'required',
        ]);

        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        $user = User::where('email', $params['email'])->first();

        if (!$user) {
            throw new ApplicationException('User was not found', 403);
        }
        // get reset code from cache
        $resetCode = Cache::store('file')->get('reset_code_' . $user->id);
        if (!$resetCode) {
            throw new ApplicationException('Password reset code expired', 403);
        }

        if ($resetCode != $params['code']) {
            throw new ApplicationException('Reset code is invalid', 403);
        }

        $response = [
            'is_valid' => true,
        ];

        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'data' => $response,
                'status' => 200
            ], 200);
        });
    }
}
