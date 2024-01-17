<?php namespace WUserApi\UserApi\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Lang;
use October\Rain\Exception\ValidationException;
use System\Models\File;
use WUserApi\UserApi\Classes\UserApiHook;
use WUserApi\UserApi\Facades\JWTAuth;
use Cache;


use RainLab\User\Models\User;


class InfoUpdateApiController extends UserApiController
{
    public function handle()
    {
        $response = [];

        $data = post();
        $user = JWTAuth::getUser();

        if($user->is_guest){
            return response()->make([
                'error' => 'Guest user cannot update their info, set password first',
            ], 404);
        }
        if (array_key_exists('password', $data) && !$user->checkHashValue('password', array_get($data, 'password_current'))) {
            throw new ValidationException(['password_current' => Lang::get('rainlab.user::lang.account.invalid_current_pass')]);
        }

        
      
        $phone_activation = config('wuserapi.userapi::phone_activation');
        if ($phone_activation) {
            if (array_key_exists('phone_number', $data)){
                if (User::where('phone_number', $data['phone_number'])->first()) {
                    return response()->make([
                        'error' => 'Phone number is identical to the current one',
                        'status' => 400
                    ], 400);
                }
                
                
                if (!preg_match('/^\+?[1-9][0-9]{7,14}$/', $data['phone_number'])) {
                    throw new ValidationException(['phone_number' => 'Invalid phone number']);
                }

                $key = 'phone_' . $user->id;
                if (Cache::store('file')->has($key)) {
                    throw new ValidationException(['phone_number' => 'Please wait few minutes before trying again']);
                }

                $new_phone_number = $data['phone_number'];
                Cache::store('file')->put($key, $new_phone_number, now()->addMinutes(config('wuserapi.userapi::phone_verification_code_expiration_time')));
            
                $key_verification = 'phone_verification_' . $user->id;
                $phone_number_verification_code = rand(10000,99999);
                Cache::store('file')->put($key_verification, $phone_number_verification_code, now()->addMinutes(config('wuserapi.userapi::phone_verification_code_expiration_time')));
                if (!$user->phone_number){
                    $user->is_phone_number_verified = false;
                }
                Event::fire('wuserapi.userapi.sendPhoneNumberVerificationCode', [$user ,$new_phone_number, $phone_number_verification_code]);
            }
        }

        $user->fill($data);
        if (array_key_exists('email', $data)) {
            if (User::where('email', $data['email'])->first()) {
                return response()->make([
                    'error' => 'Email is already taken',
                    'status' => 400
                ], 400);
            }

            $new_email = $data['email'];
            Cache::store('file')->put('email_' . $user->id, $new_email, now()->addMinutes(config('wuserapi.userapi::email_verification_code_expiration_time')));

            $email_verification_code = rand(10000,99999);
            Cache::store('file')->put('email_verification_' . $user->id, $email_verification_code, now()->addMinutes(config('wuserapi.userapi::email_verification_code_expiration_time')));
            $user->email = $user->getOriginal('email');
        }
        
        
        
        

        if (array_has($data, 'avatar') && empty($data['avatar']) && $user->avatar) {
            $user->avatar->delete();
            $user->avatar = null;
        }

        if (request()->hasFile('avatar')) {
            $file = new File();
            $file->fromPost(request()->file('avatar'));
            $file->save();

            $user->avatar = $file;
        }
        
        $user->save();
        

        Event::fire('wuserapi.userapi.beforeReturnUser', [$user]);

        $userResourceClass = config('wuserapi.userapi::resources.user');
        $response = [
            'user' => new $userResourceClass($user),
        ];


        return $afterProcess = UserApiHook::hook('afterProcess', [$this, $response], function () use ($response) {
            return response()->make([
                'data' => $response,
                'status' => 200
            ], 200);
        });
    }
}
