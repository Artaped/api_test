<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 1/31/2019
 * Time: 9:17 PM
 */

namespace App\models;


use App\components\QueryBuilder;

class Category
{
    /**
     * return array all categories in json formats
     * @return array
     */
    public function getAllCategories()
    {
        $category = new QueryBuilder();
        $categories = $category->all('category');

        return $categories;
    }

    /**
     * create new Category
     * @param array
     * @return string
     */
    public function create($param)
    {

        $category = new QueryBuilder();
        $newCategoryId = $category->store('category', $param);
        if ($newCategoryId) {
            return $newCategoryId;
        }
        return false;

    }

    /**
     * change Category by ID
     * @param array
     * @return string
     */
    public function updateCategory($data)
    {
        $category = new QueryBuilder();
        if (!$category->update('category', $data)) {
            return false;
        }

        return true;
    }

    /**
     *delete Category by ID
     * @param array
     * @return string
     */
    public function remove($id)
    {
        $category = new QueryBuilder();
        if (!$category->delete('category', $id)) {
            return false;
        }

        return true;
    }
    public function checkCategoryExist($param)
    {
        $category = new QueryBuilder();
        if ($category->checkExist('category', 'title', $param)) {
            return true;
        }
        return false;
    }
}