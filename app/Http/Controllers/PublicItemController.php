<?php


namespace App\Http\Controllers;


use App\Http\Models\ProductModel;
use App\Services\Interfaces\IProductService;
use Illuminate\Http\Request;

class PublicItemController extends AbstractItemController
{


    public function getIndex(Request $request){
        return view('public.products');
    }

    public function getData(Request $request){
        $recordsTotal = $this->productService->countProducts($request);

        $data = $this->productService->getProducts($request);

        return json_encode(['data' =>$data,
                            'recordsTotal' => $recordsTotal->count,
                            "recordsFiltered" => $recordsTotal->count
                            ]);
    }
}
