<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 1/26/2019
 * Time: 11:33 AM
 */

namespace App\models;

use App\components\QueryBuilder;
use PDO;

class User
{
    /**
     * registration new user
     * @param $data
     * @return bool
     */
    public function registration($data)
    {
        $user = new QueryBuilder();
        $user->store('user', $data);
        return true;
    }

    /**
     * check user key
     * @param $key
     * @return bool
     */
    public static function checkUserKey($key)
    {
        $user = new QueryBuilder();
        $stmt = $user->pdo->query("SELECT * FROM user WHERE api_key = '$key' ");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * check user email
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
     * send User api_key on user email
     * @param $email
     * @param $key
     * @return bool
     */
    public static function sendMail($email, $key)
    {
        $adminEmail = '300175dt@gmail.com';
        $message = "Text: get KEY. from {$email}";
        $subject = "Hello ! Your key : {$key}";
        $result = mail($adminEmail, $subject, $message);

        header('Content-Type: application/json');
        echo json_encode('Your API key has been sent to your email.');

        return $result;
    }

    /**
     * check exist user in Db
     * @param $login
     * @return bool
     */
    public function checkUserExist($login)
    {
        $user = new QueryBuilder();

        if ($user->checkExist('user', 'login', $login)) {
            return true;
        }
        return false;
    }

}