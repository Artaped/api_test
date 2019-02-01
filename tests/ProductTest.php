<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 2/1/2019
 * Time: 12:54 AM
 */

namespace App\Tests;


use App\models\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public  $id;

    public function testCreateProduct()
    {
        $product = new Product();
        $data = ['name' => 'ponchickk'];
        $categories = [1];
        $this->id = $product->createProduct($data,$categories);
        $this->assertTrue(!empty($this->id));
    }
    public function testUpdateProduct()
    {
        $product = new Product();
        $data = ['name' => 'bublic', 'id' => $this->id];
        $categories = [1,2];
        $this->assertTrue($product->updateProduct($data, $categories));
    }
    public function testDeleteProduct()
    {
        $product = new Product();
        $id = $this->id;
        $this->assertTrue($product->remove($id));
    }
}