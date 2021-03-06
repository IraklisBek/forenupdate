<?php
/**
 * Created by PhpStorm.
 * User: Irakl_000
 * Date: 5/10/2016
 * Time: 3:04 PM
 */

namespace App\Acme\Services;


use App\PasswordReset;

class PasswordResetService
{

    /**
     * Check if user is using the token that had given to him
     *
     * @param $user_real_token
     * @param $browser_token
     * @return bool
     */
    public static function cheating($user_real_token, $browser_token){
        if(strcmp($user_real_token, $browser_token)!=0){
            MessageService::_message('fail', 'Your password could not be updated. Please check your e-mail or click again the link from your e-mail.');
            return true;
        }
    }

    /**
     * Finding password by email
     *
     * @param string $email
     * @return \App\PasswordReset|false
     */
    public static function getPasswordResetByEmail($email) {
        $reset_email = PasswordReset::where('email', $email)->get();
        if($reset_email->count()) {
            return PasswordReset::hasExpired(12, $reset_email);
        }else{
            MessageService::_message('fail', 'You link has expired. Please make a new password reset request.');
            return false;
        }

    }

    /**
     * Deletes password reset model
     *
     * @param PasswordReset $passwordReset
     * @return bool|null
     */
    public static function deletePasswordResetRow(PasswordReset $passwordReset) {
        return $passwordReset->destroy($passwordReset->email);
    }
}