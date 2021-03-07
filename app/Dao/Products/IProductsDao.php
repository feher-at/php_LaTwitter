<?php


namespace App\Dao\Products;


interface IProductsDao
{
    public function getProducts($limit, $offset);
    public function countProducts();
    public function selectProductById($id);
    public function deleteProduct($id);
    public function searchProduct($searchValue,$limit,$offset);
    public function checkIfProductExist($id);
    public function countFilteredProducts($searchValue);
}
