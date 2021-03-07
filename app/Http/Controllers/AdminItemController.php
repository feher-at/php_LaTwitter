<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IProductService;
use Illuminate\Http\Request;

class AdminItemController extends AbstractItemController{

    public function __construct(IProductService $productService)
    {
        parent::__construct($productService);
        $this->middleware('can:isAdmin');
    }


    public function getIndex(Request $request){
        return view('admin.products');
    }

    public function getNewItemPage(Request $request){
        if($request->query('id') !== null){
            $product = $this->productService->selectProductById($request);

            return view('admin.newItem',compact('product'));
        }
        return view('admin.newItem');
    }

    public function createOrUpdateItem(Request $request){

        $validatedData = $this->productService->validation($request);


        $validatedData && $request->get('id') === null ? $this->productService->createNewItem($request)
                                                            : $this->productService->updateTheItem($request);

        return redirect()->action('AdminItemController@getIndex');
    }

    public function deleteProduct(Request $request){
        $this->productService->deleteProduct($request);
    }
}
