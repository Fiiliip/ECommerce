<?php namespace WUserApi\UserApi\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Tymon\JWTAuth\Exceptions\JWTException;
use WUserApi\UserApi\Facades\JWTAuth;
use WUserApi\UserApi\Classes\UserApiHook;

class RefreshApiController extends UserApiController
{
    public function handle()
    {
        $forceRefresh = env('JWT_FORCE_REFRESH', false);

        $oldToken = JWTAuth::getToken();
        $newToken = $forceRefresh ? self::generateNewToken($oldToken) : JWTAuth::parseToken()->refresh();

        Event::fire('wuserapi.userapi.afterRefresh', [$oldToken, $newToken]);

        $user = JWTAuth::setToken($newToken)->authenticate();

        Event::fire('wuserapi.userapi.beforeReturnUser', [$user]);

        $userResourceClass = config('wuserapi.userapi::resources.user');
        $response = [
            'success' => true,
            'token' => $newToken,
            'user' => new $userResourceClass($user),
        ];

        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'data' => $response,
                'status' => 200
            ], 200);
        });
    }

    private function generateNewToken($oldToken)
    {
        $newToken = JWTAuth::refresh();
        $user = JWTAuth::setToken($newToken)->toUser();
        JWTAuth::invalidate();

        if (!$user){

            if (env('LOG_USER_NOT_PARSED_FROM_TOKEN', false)) {
                $tokenData = JWTAuth::manager()->decode($oldToken, $checkBlacklist=false);
                $message = 'User ID:'.$tokenData['sub'].' not parsed from token'.PHP_EOL.'Token Data:'.PHP_EOL.json_encode($tokenData,JSON_PRETTY_PRINT);
                logger()->info($message);
            }

            abort(401, 'User not found');
        }

        return JWTAuth::fromUser($user);
    }
}
