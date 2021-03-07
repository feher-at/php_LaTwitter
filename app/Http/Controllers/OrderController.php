<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IOrderService;
use App\Services\Interfaces\IProductService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private IOrderService $orderService;
    private IProductService $productService;

    public function __construct(IOrderService $orderService, IProductService $productService){

        $this->orderService   = $orderService;
        $this->productService = $productService;
        $this->middleware('auth');
    }

    public function getOrderPage(Request $request)
    {
        if($request->input('id') !== null && $this->productService->checkIfProductExist($request->input('id'))){

            $input = $request->get('id');
            return view('public.order',compact('input'));
        }
        else if($request->input('first_name')){

            $input = $request->input();
            return view('public.order',compact('input'));
        }

        return redirect()->route('products/public');
        }
    public function getOrderSummaryPage(Request $request){

        $orderSummaryInfo = $this->orderService->createOrderInfo($request);
        return view('public.orderSummary',compact('orderSummaryInfo'));
    }

    public function createOrder(Request $request)
    {
        $this->orderService->createNewOrder($request);
        return redirect()->action('PublicItemController@getIndex');
    }

    public function getOrderListPage(){
        return view('admin.orderList');
    }

    public function getData(Request $request){
        $recordsTotal = $this->orderService->countOrders($request);
        $data = $this->orderService->getOrders($request);

        return json_encode(['data'            =>$data,
                            'recordsTotal'    => $recordsTotal->count,
                            'recordsFiltered' => $recordsTotal->count]);
    }

    public function deleteOrder(Request $request){

        $this->orderService->deleteOrder($request);
    }

    public function changeStatus(Request $request){
        $this->orderService->changeStatus($request);
    }
}
