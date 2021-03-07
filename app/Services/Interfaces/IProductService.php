<?php


namespace App\Services\Interfaces;


use Illuminate\Http\Request;

interface IProductService
{
    public function getProducts(Request $request, bool $isAdmin = false);
    public function countProducts(Request $request);
    public function selectProductById(Request $request);
    public function deleteProduct(Request $request);
    public function createNewItem(Request $request);
    public function updateTheItem(Request $request);
    public function validation(Request $request);
    public function checkIfProductExist($id);
}
