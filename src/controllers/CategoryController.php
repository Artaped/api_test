<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 1/27/2019
 * Time: 9:04 AM
 */

namespace App\controllers;

use App\components\Validator;
use App\models\Category;
use App\models\User;

class CategoryController extends Controller
{

    /**
     * return array all categories in json formats
     * @return array
     */
    public function all()
    {
        $category = new Category();
        $categories = $category->getAllCategories();
        $this->response($categories);
        return $categories;
    }
    /**
     * create new Category
     * @param array
     * @return string
     */
    public function create()
    {
        $category = new Category();

        $key = $_GET['api_key'];
        if (!User::checkUserKey($key)) {
            $this->response("Access is denied!", 403);
            return false;
        }

        $data = $this->getRequestJsonData();
        $title = htmlspecialchars(strip_tags($data['title']));
        $params = ['title' => $title];

        if (!Validator::checkString($title)) {
            $this->response("String must have 2 - 20 symbols", 400);
            return false;
        }
        //check exist Category in DB
        if ($category->checkCategoryExist($title)) {
            $this->response('Category exist');
        }
        if (!$result = $category->create($params)) {
            $this->response("Category not saved!");
            return false;
        }
        $this->response('Category saved id = ' . $result, 201);
        return $result;


    }
    /**
     * change Category by ID
     * @param array
     * @return string
     */
    public function update()
    {
        $key = $_GET['api_key'];
        if (!User::checkUserKey($key)) {
            $this->response("Access is denied!", 403);
            return false;
        }

        $data = $this->getRequestJsonData();
        $id = intval($data['id']);
        $title = htmlspecialchars(strip_tags($data['title']));
        $params = ['title' => $title, 'id' => $id];

        $category = new Category();
        if (!$category->updateCategory($params)) {
            $this->response('Unable to update', 503);
            return false;
        }

        $this->response('Category was updated', 200);
        return true;
    }
    /**
     *delete Category by ID
     * @param array
     * @return string
     */
    public function delete()
    {
        $key = $_GET['api_key'];
        if (!User::checkUserKey($key)) {
            $this->response("Access is denied!", 403);
            return false;
        }
        $data = $this->getRequestJsonData();
        $id = $data['id'];
        if (empty($id) || !is_numeric($id)) {
            $this->response("Id is empty or no numeric");
            return false;
        }
        $category = new Category();
        if (!$category->remove($id)) {
            $this->response("Unable to delete Category", 503);
        }
        $this->response("Category deleted", 200);
        return true;
    }
}