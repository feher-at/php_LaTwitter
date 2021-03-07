<?php


namespace App\Services;


use App\Dao\Orders\IOrderDao;
use App\Dao\Products\IProductsDao;
use App\Http\Models\OrderItemsModel;
use App\Http\Models\ProductModel;
use App\Services\Interfaces\IEmailService;
use App\Services\Interfaces\IOrderService;
use Illuminate\Http\Request;


class OrderServiceImpl implements IOrderService
{
    private IOrderDao $orderDao;
    private IProductsDao $productDao;
    private IEmailService $emailService;

    public function __construct(IOrderDao $orderDao, IProductsDao $productDao, IEmailService $emailService){
        $this->orderDao = $orderDao;
        $this->productDao = $productDao;
        $this->emailService = $emailService;
    }

    public function createNewOrder(Request $data){

        $orderInfo = $this->createOrderInfo($data);
        $order = new OrderItemsModel($orderInfo);
        $this->emailService->sendEmailFromOrder($order);
        $order->save();
    }

    public function getOrders($request){
        $data = array();
        $ajaxRequest = $request->all();
        $searchValue = $ajaxRequest['search']['value'];
        $limit = $request->get('length');
        $offset = $request->get('start');
        $searchValue === null ? $orders= $this->orderDao->getOrders($limit,$offset)
                              : $orders = $this->orderDao->searchOrder($searchValue,$limit,$offset);
        foreach ($orders as $order)
        {
            array_push($data,$order);
        }
        return $data;
    }

    public function countOrders($request){
        $ajaxRequest = $request->all();
        $searchValue = $ajaxRequest['search']['value'];
        return  $searchValue === null ? $this->orderDao->countOrders()[0]
                                      : $this->orderDao->countFilteredOrders($searchValue);
    }

    public function deleteOrder($request){
        if($request->ajax()){
            $this->orderDao->deleteOrder( $request->get('id'));
        };
    }

    public function changeStatus($request){
        if($request->ajax()){

            $this->orderDao->changeStatus( intval($request->get('id')), $request->get('status'));
        };
    }
    public function createOrderInfo(Request $data){

        $input = array_slice($data->input(),1);
        $validation = $this->validation($data);
        $product = $this->productDao->selectProductById($input['id']);
        return $this->createOrderInput($input, $product);

    }

    public function validation($request){
        return $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'customer_email' => 'required|email',
            'customer_billing_address' => 'required',
            'customer_shipping_address' => 'required',
            'product_quantity' => 'integer|min:0',

        ]);
    }

    private function createOrderInput(array $input, ProductModel $product) : array
    {
        $orderInput = array();
        $orderInput['product_id'] = $product->id;
        $orderInput['product_price_at_order'] = $product->product_sale_price > 0 ? $product->product_sale_price
                                                                                 : $product->product_price;
        $orderInput['product_name'] = $product->product_name;
        $orderInput['customer_first_name'] = $input['first_name'];
        $orderInput['customer_last_name'] = $input['last_name'];
        $orderInput['customer_name'] = $input['first_name']." ".$input['last_name'];
        $orderInput['customer_shipping_address'] = $input['customer_shipping_address'];
        $orderInput['customer_billing_address'] = $input['customer_billing_address'];
        $orderInput['customer_email'] = $input['customer_email'];
        $orderInput['product_quantity'] = $input['product_quantity'];
        $orderInput['final_price'] = intval($orderInput['product_price_at_order']) * intval($orderInput['product_quantity']);
        $orderInput['status'] = 'under process';

        return $orderInput;
    }
}
