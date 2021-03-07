<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IProductService;
use Illuminate\Http\Request;

abstract class  AbstractItemController extends Controller
{
    protected IProductService $productService;

    public function __construct(IProductService $productService) {

        $this->productService = $productService;
    }

    public function getData(Request $request){
        $recordsTotal = $this->productService->countProducts($request);

        $data = $this->productService->getProducts($request, true);

        return json_encode([
            'data'              => $data,
            'recordsTotal'      => $recordsTotal->count,
            'recordsFiltered'   => $recordsTotal->count
        ]);

    }

   abstract function getIndex(Request $request);

}
