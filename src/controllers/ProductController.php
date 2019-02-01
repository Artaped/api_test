<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 1/27/2019
 * Time: 10:36 AM
 */

namespace App\controllers;

use App\components\Validator;
use App\models\Product;
use App\models\User;

class ProductController extends Controller
{

    /**
     * return array all products in json formats
     * @return array
     */
    public function all()
    {
        $product = new Product();
        $products = $product->getAllProducts();
        $this->response($products);
        return $products;
    }

    /**
     * show product by id
     * @param $id
     * @return array|bool
     */
    public function getOneProductById($id)
    {
        $product = new Product();
        $array = $product->getProductById($id);
        $this->response($array);
        return $array;
    }

    /**
     *return array all product in category by category id
     * @param $id
     * @return array
     */
    public function getProductInCategory($id)
    {
        $product = new Product();
        $allProductInCategory = $product->getProductByCategoryId($id);

        $this->response($allProductInCategory);
        return $allProductInCategory;
    }

    /**
     * create new Product and make relations many to many
     * @param array
     * @return string
     */
    public function create()
    {
        $key = $_GET['api_key'];

        if (!User::checkUserKey($key)) {
            $this->response("Access is denied!", 403);
            return false;
        }

        $data = $this->getRequestJsonData();
        $name = htmlspecialchars(strip_tags($data['name']));
        $categories = $data['category_id'];

        if (!Validator::checkString($name)) {
            $this->response("String must have 2 - 20 symbols", 400);
            return false;
        }

        if (!is_array($categories)) {
            $this->response("Categories must be array", 400);
            return false;
        }
        $params = ['name' => $name];
        if (empty($categories)) {
            $categories = [3];//no category
        }
        $product = new Product();

        if ($product->checkCProductExist($name)) {
            $this->response("Product exist");
            return false;
        }

        if (!$result = $product->createProduct($params, $categories)) {
            return false;
        }
        $this->response('Product saved id = ' . $result, 201);
        return $result;

    }

    /**
     * change Product by ID
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
        $name = htmlspecialchars(strip_tags($data['name']));
        $id = intval($data['id']);
        $categories = $data['category_id'];

        if (!Validator::checkString($name) && !is_numeric($id)) {
            return false;
        }
        $params = [
            'name' => $name,
            'id' => $id
        ];

        $product = new Product();
        $product->updateProduct($params, $categories);

        $this->response('Product updated');
        return true;
    }

    /**
     *delete Product by ID
     * @param array json
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
        $id = intval($data['id']);
        if (empty($id) || !is_numeric($id)) {
            $this->response("Id is invalid ");
            return false;
        }

        $product = new Product();
        if (!$product->remove($id)) {
            $this->response("Product not deleted");
        }

        $this->response("Product deleted");
        return true;

    }

}