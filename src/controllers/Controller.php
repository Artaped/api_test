<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 1/27/2019
 * Time: 9:09 AM
 */

namespace App\controllers;


class Controller
{
    /**
     * get json data and decode in PHP
     *
     * @return array
     */
    public function getRequestJsonData()
    {
        if($_REQUEST['php']){
            $data = $_REQUEST;
        } else  {
            $postData = file_get_contents('php://input');
            $data = json_decode($postData, true);
        }
        return $data;
    }
    public function response($message, $cod = 200)
    {
        http_response_code($cod);
        header('Content-Type: application/json');
        //header('location:' . $_SERVER['HTTP_REFERER']);
        echo json_encode( array("message" => $message));
    }

}