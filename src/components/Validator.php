<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 1/29/2019
 * Time: 9:27 AM
 */

namespace App\components;


class Validator
{
    /**
     * check Email
     * @param $email
     * @return bool
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * check Login Login must have 2 - 20 symbols
     * @param $name
     * @return bool
     */
    public static function checkString($name)
    {
        if (strlen($name) >= 2 && strlen($name) <= 20) {
            return true;
        }
        return false;
    }


    /**
     * check password Password must have 6 - 20 symbols
     * @param $password
     * @return bool
     */
    public static function checkLength($password)
    {
        if (strlen($password) >= 6 && strlen($password) <=20) {
            return true;
        }
        return false;
    }

    /**
     * check User data
     * @param $email
     * @param $login
     * @param $password
     * @param $key
     * @return array|bool
     */
    public static function checkUserData($email, $login, $password, $key)
    {
        if (!Validator::checkEmail($email)) {
            $errors[] = 'Incorrect email';
        }
        if (!Validator::checkString($login)) {
            $errors[] = 'Login must have 2 - 20 symbols';
        }
        if (!Validator::checkLength($password)) {
            $errors[] = 'Password must have 6 - 20 symbols';
        }
        if ($errors) {
            header('Content-Type: application/json');
            echo json_encode($errors);
            return false;
        }
        if ($errors == false){
            $param = [
                'login' => $login,
                'password' => $password,
                'api_key' => $key
            ];
        }
        return $param;
    }
}