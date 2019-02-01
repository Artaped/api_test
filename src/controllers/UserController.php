<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 1/28/2019
 * Time: 8:39 AM
 */

namespace App\controllers;

use App\components\QueryBuilder;
use App\components\Validator;
use App\models\User;

class UserController extends Controller
{
    /**
     * registration new user and get key on user email
     * @param array
     * @return bool
     */
    public function create()
    {
        $data = $this->getRequestJsonData();

        $login = $data['login'];
        $password = $data['password'];
        $email = $data['email'];
        $key = md5($login . time());

        $userData = Validator::checkUserData($email, $login, $password, $key);

        $user = new User();

        if ($user->checkUserExist($login)) {
            $this->response("User exist");
        }

        if ($user->registration($userData)) {
            User::sendMail($email, $key);
        }

        $this->response('User registered',201);
        return $key;
    }


}