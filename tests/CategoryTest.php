<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 1/31/2019
 * Time: 10:37 PM
 */

namespace App\Tests;


use App\models\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public  $id;

    public function testCreateCategory()
    {
        $category = new Category();
        $data = ['title' => 'ponchickk'];
        $this->id = $category->create($data);
        $this->assertTrue(!empty($this->id));
    }
    public function testUpdateCategory()
    {
        $category = new Category();
        $data = ['title' => 'bublic', 'id' => $this->id];
        $this->assertTrue($category->updateCategory($data));
    }
    public function testDeleteCategory()
    {
        $category = new Category();
        $id = $this->id;
        $this->assertTrue($category->remove($id));
    }

}