<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 1/27/2019
 * Time: 10:22 AM
 */

namespace App\components;

use PDO;

class QueryBuilder
{
    public $pdo;

    function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost; dbname=api_task", "root", "");
    }


    /**
     * get all data in table
     * @param $table
     * @return array
     */
    function all($table)
    {
        $sql = "SELECT * FROM $table";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * get all product in one Category !!!!
     * @param $table
     * @param $data
     * @return array
     */
    function getAllProductInCategory($table, $data)
    {
        $sql = "SELECT * FROM $table WHERE  id IN ($data)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    //-----------------------------------------

    /**
     * get data by category id ?????
     * @param $table
     * @param $anchor
     * @param $id
     * @return array
     */
    function getOne($table, $anchor, $id)
    {
        $sql = "SELECT * FROM $table WHERE $anchor=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    //-----------------------------------------

    /**
     * get id by name
     * @param $table
     * @param $name
     * @return mixed
     */
    function getProductId($table, $name)
    {
        $sql = "SELECT * FROM $table WHERE `name`=?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$name]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * check exist data in table
     * @param $table
     * @param $anchor
     * @param $data
     * @return mixed
     */
    function checkExist($table, $anchor, $data)
    {
        $sql = "SELECT * FROM $table WHERE $anchor=?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$data]);
        if ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
            return true;
        }
        return false;

    }

    /**
     * save data in table
     * @param $table
     * @param $data
     * @return bool
     */
    function store($table, $data)
    {
        // 1. key in array
        $keys = array_keys($data);
        // 2. make string keys
        $stringOfKeys = implode(',', $keys);
        //3. make string values
        $placeholders = ":" . implode(', :', $keys);

        $sql = "INSERT INTO $table ($stringOfKeys) VALUES ($placeholders)";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        $lastId = $this->pdo->lastInsertId();

        return $lastId;
    }


    /**
     * edit data in table
     * @param $table
     * @param $data
     * @return bool
     */
    function update($table, $data)
    {
        $fields = '';

        foreach ($data as $key => $value) {

            $fields .= $key . "=:" . $key . ",";
        }

        $fields = rtrim($fields, ',');

        $sql = "UPDATE $table SET $fields WHERE id=:id";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);

        return true;
    }


    /**
     * remove data in the table
     * @param $table
     * @param $id
     * @return bool
     */
    function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $id);
        if (!$statement->execute()) {
            return false;
        }
        return true;
    }

    /**
     * remove data in relation table on update
     * @param $table
     * @param $anchor
     * @param $id
     * @return bool
     */
    function deleteOnUpdate($table, $anchor, $id)
    {
        $sql = "DELETE FROM $table WHERE $anchor=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();

        return true;
    }

}