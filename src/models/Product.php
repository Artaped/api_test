<?php

namespace App\models;


use App\components\QueryBuilder;

class Product
{

    /**
     * return array all products in json formats
     * @return array
     */
    public function getAllProducts()
    {
        $product = new QueryBuilder();
        $products = $product->all('product');

        return $products;
    }

    /**
     * show product by id
     * @param $id
     * @return array|bool
     */
    public function getProductById($id)
    {
        $product = new QueryBuilder();
        $products = $product->getOne('product', 'id', $id);
        $categories = $product->getOne('product_category', 'product_id', $id);
        $result = [];

        foreach ($categories as $category) {
            $result[] = $category['category_id'];
        }
        $allCategoriesInProduct = $product->getAllProductInCategory('category', implode(',', $result));

        $array = ['product_info' => $products, 'category_info' => $allCategoriesInProduct];
        return $array;
    }

    /**
     *return array all product in category by category id
     * @param $id
     * @return array
     */
    public function getProductByCategoryId($id)
    {
        $result = [];

        $product = new QueryBuilder();
        $products = $product->getOne('product_category', 'category_id', $id);
        foreach ($products as $production) {
            $result[] = $production['product_id'];
        }
        $array = $product->getAllProductInCategory('product', implode(',', $result));

        return $array;
    }

    /**
     *  create new Product and make relations many to many
     * @param $data
     * @param $categories
     * @return bool
     */
    public function createProduct($data, $categories)
    {
        $product = new Product();

        $id = $product->saveProduct($data, $categories);
        if (!$id) {
            return false;
        }
        return $id;
    }


    /**
     * save new product
     * @param $data
     * @param $categories
     * @param $name
     * @return bool
     */
    public function saveProduct($data, $categories)
    {

        $product = new QueryBuilder();

        $id = $product->store('product', ['name' => $data['name']]);
        foreach ($categories as $category) {
            $product->store('product_category', ['product_id' => $id, 'category_id' => $category]);
        }
        return $id;
    }


    /**
     *update the product and save the relation in the product_category table
     * @param $param
     * @param $categories
     * @return bool
     */
    public function updateProduct($param, $categories)
    {

        $product = new QueryBuilder();

        $product->update('product', $param);
        $product->deleteOnUpdate('product_category', 'product_id', $param['id']);
        foreach ($categories as $category) {
            $product->store('product_category', ['product_id' => $param['id'], 'category_id' => $category]);
        }
        return true;
    }

    /**
     *delete Product by ID
     * @param array json
     * @return string
     */
    public function remove($id)
    {
        $product = new QueryBuilder();
        if (!$product->delete('product', $id)) {
            return false;
        }
        return true;

    }

    /**
     * check exist Product in db
     * @param $param
     * @return bool
     */
    public function checkCProductExist($param)
    {
        $category = new QueryBuilder();
        if ($category->checkExist('category', 'title', $param)) {
            return true;
        }
        return false;
    }
}