<?php namespace WUserApi\UserApi\Http\Controllers;

use October\Rain\Exception\ApplicationException;
use RainLab\User\Models\User;
use WUserApi\UserApi\Classes\Services\UserSignupActivationService;
use WUserApi\UserApi\Classes\UserApiHook;
use Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class VerifyPhoneResendApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $user = Auth::user();

        $key_phone = 'phone_' . $user->id;
        $key_verification = 'phone_verification_' . $user->id;

        

        $phone_number = input('phone_number');
        if (!$phone_number){
            throw new ApplicationException('Phone number is required');
        }

        $user = User::where('phone_number', $phone_number)->first();
        if ($user) {
            throw new ApplicationException('Phone number already exists');
        }
    
        $user = Auth::user();
      
        $phone_number_verification_code = rand(10000,99999);
        Cache::store('file')->put($key_verification, $phone_number_verification_code, config('wuserapi.userapi::phone_verification_code_expiration_time'));
        
        Cache::store('file')->put($key_phone, $phone_number, config('wuserapi.userapi::phone_verification_code_expiration_time'));

        Event::fire('wuserapi.userapi.sendPhoneNumberVerificationCode', [$user , $phone_number,$phone_number_verification_code]);
        
        $response = [
            'success' => true
        ];

        if (config('app.debug')){
            $response['phone_number_verification_code'] = $phone_number_verification_code;
        }

        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'data' => $response,
                'status' => 200
            ], 200);
        });
    }
}
